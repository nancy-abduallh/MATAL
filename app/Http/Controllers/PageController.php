<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display the About Us page with vision, mission, and partners.
     */
    public function about(): View
    {
        $partners = [
            'وزارة السياحة',
            'هيئة السياحة السعودية',
            'إمارة منطقة جازان',
            'أمانة منطقة جازان',
            'هيئة التراث',
            'جمعيات التنمية السياحية',
            'الغرف التجارية',
            'أصحاب المزارع والنزل الريفية',
            'المرشدون السياحيون المعتمدون',
            'أصحاب القوارب والرحلات البحرية',
            'الأسر المنتجة والحرفيون',
        ];

        return view('pages.about', compact('partners'));
    }

    /**
     * Display the Contact page.
     */
    public function contact(): View
    {
        return view('pages.contact');
    }

    /**
     * Submit contact form message.
     */
    public function submitContact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:150',
            'message' => 'required|string|max:2000',
        ]);

        Contact::create($validated);

        return back()->with('success', 'شكراً لتواصلك مع مَطَلّ! استلمنا رسالتك وسنرد عليك في أقرب وقت.');
    }
}
