<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()) {
            return redirect()->route('admin.login')->with('info', 'يرجى تسجيل الدخول للوصول إلى لوحة التحكم الإدارية.');
        }

        abort_unless($request->user()->role === 'admin', 403, 'غير مصرح لك بالوصول إلى هذه اللوحة الإدارية.');

        return $next($request);
    }
}
