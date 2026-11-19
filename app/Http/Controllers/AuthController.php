<?php

namespace App\Http\Controllers;

use App\Models\TouristRoute;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show the Login and Register page.
     */
    public function showLogin(): View
    {
        if (Auth::check()) {
            return view('pages.account.index', [
                'user' => Auth::user(),
                'bookings' => Auth::user()->bookings()->with('bookable')->latest()->get(),
                'savedTrips' => Auth::user()->savedTrips()->latest()->get(),
                'myRoutes' => TouristRoute::take(3)->get(),
            ]);
        }

        return view('pages.auth.login');
    }

    /**
     * Handle login authentication.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('account.index'))->with('success', 'مرحباً بك مجدداً في مَطَلّ!');
        }

        return back()->withErrors([
            'email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة.',
        ])->onlyInput('email');
    }

    /**
     * Handle new user registration.
     */
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email|max:100',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'role' => 'tourist',
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect()->route('account.index')->with('success', 'أهلاً بك في مَطَلّ! تم إنشاء حسابك بنجاح.');
    }

    /**
     * Fast 1-click Demo Login for testing.
     */
    public function demoLogin(string $role): RedirectResponse
    {
        abort_unless(app()->environment('local', 'testing'), 404);

        $email = match ($role) {
            'admin' => 'admin@matal.sa',
            'guide' => 'guide@matal.sa',
            default => 'tourist@matal.sa',
        };

        $user = User::where('email', $email)->first();
        if ($user) {
            Auth::login($user);

            return redirect()->route('account.index')->with('success', "تم تسجيل الدخول السريع كـ [{$user->name}]");
        }

        return redirect()->route('login');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('info', 'تم تسجيل الخروج بنجاح.');
    }
}
