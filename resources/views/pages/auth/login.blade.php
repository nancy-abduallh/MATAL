@extends('layouts.app')

@section('title', 'تسجيل الدخول وإنشاء حساب · مَطَلّ جازان')
@section('hide_navbar', true)

@section('content')

<div class="min-h-screen flex flex-col md:flex-row bg-[#FAF8F5]">
    
    <!-- Left Half: Scenic Coastal Banner matching Login Register.png -->
    <div class="md:w-1/2 relative min-h-[350px] md:min-h-screen bg-cover bg-center flex items-end p-8 sm:p-14 text-white order-2 md:order-1" 
         style="background-image: url('/images/coastal_beach.jpg');">
        <div class="absolute inset-0 bg-gradient-to-t from-[#164E63]/95 via-[#164E63]/40 to-black/20"></div>
        
        <div class="relative z-10 space-y-2 text-right">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-white text-xs font-bold mb-2">
                <i class="fa-solid fa-sparkles text-cyan-300"></i>
                <span>منصة مَطَلّ الرقمية للسياحة</span>
            </div>
            <h2 class="text-3xl sm:text-5xl font-black text-white tracking-tight font-heading">
                اكتشف الطبيعة.. عش التجربة
            </h2>
            <p class="text-sky-100 text-base sm:text-lg font-medium">
                كل رحلة أجمل مع مَطَلّ · من أعالي جازان إلى سواحلها
            </p>
        </div>
    </div>

    <!-- Right Half: Form Container matching Login Register.png -->
    <div class="md:w-1/2 flex items-center justify-center p-6 sm:p-12 order-1 md:order-2">
        <div class="w-full max-w-md space-y-6 text-right">
            
            <!-- Logo & Greeting -->
            <div class="text-center md:text-right space-y-3">
                <div class="flex items-center justify-between">
                    <a href="{{ route('home') }}" class="inline-block group" title="الصفحة الرئيسية">
                        <img src="/images/matal_official_logo.png" alt="مَطَلّ MATAL" class="h-14 sm:h-16 w-auto group-hover:scale-105 transition duration-300">
                    </a>
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#06B6D4] hover:text-[#0891B2] transition bg-cyan-50/80 hover:bg-cyan-100 px-3.5 py-1.5 rounded-full border border-cyan-200/80 shadow-2xs">
                        <span>العودة للرئيسية</span>
                        <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    </a>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black text-[#164E63] tracking-tight font-heading">
                    مرحباً بك في جازان
                </h1>
                <p class="text-slate-500 text-xs sm:text-sm">
                    سجّل دخولك لحفظ مساراتك، تخطيط رحلاتك، وإدارة حجوزاتك بكل سهولة.
                </p>
            </div>

            <!-- Tab Switcher: [تسجيل الدخول] [إنشاء حساب] -->
            <div class="bg-slate-200/80 p-1.5 rounded-2xl flex items-center text-xs font-bold text-slate-700">
                <button type="button" id="tabLoginBtn" class="w-1/2 py-2.5 rounded-xl bg-[#0A3847] text-white shadow-md transition">
                    تسجيل الدخول
                </button>
                <button type="button" id="tabRegisterBtn" class="w-1/2 py-2.5 rounded-xl text-slate-600 hover:text-slate-900 transition">
                    إنشاء حساب جديد
                </button>
            </div>

            <!-- Login Form -->
            <form id="loginFormBlock" action="{{ route('login.submit') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">البريد الإلكتروني *</label>
                    <input type="email" name="email" value="{{ old('email', 'tourist@matal.sa') }}" required placeholder="yourname@domain.com" 
                           class="w-full p-3.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-amber-500 bg-white">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">كلمة المرور *</label>
                    <input type="password" name="password" value="password123" required placeholder="••••••••" 
                           class="w-full p-3.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-amber-500 bg-white">
                </div>

                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center gap-2 cursor-pointer text-slate-600">
                        <input type="checkbox" name="remember" class="rounded text-amber-500 focus:ring-0">
                        <span>تذكرني على هذا الجهاز</span>
                    </label>
                    <a href="#" class="text-teal-700 font-bold hover:underline">نسيت كلمة المرور؟</a>
                </div>

                <button type="submit" class="w-full py-4 rounded-2xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-black text-sm shadow-xl transition transform hover:scale-[1.01]">
                    دخول
                </button>
            </form>

            <!-- Register Form (Hidden by default) -->
            <form id="registerFormBlock" action="{{ route('register.submit') }}" method="POST" class="space-y-4 hidden">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">الاسم الكامل *</label>
                    <input type="text" name="name" required placeholder="الاسم ثلاثي" 
                           class="w-full p-3.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-amber-500 bg-white">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">البريد الإلكتروني *</label>
                    <input type="email" name="email" required placeholder="example@domain.com" 
                           class="w-full p-3.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-amber-500 bg-white">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">رقم الجوال</label>
                    <input type="tel" name="phone" placeholder="05XXXXXXXX" 
                           class="w-full p-3.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-amber-500 bg-white">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">كلمة المرور *</label>
                        <input type="password" name="password" required placeholder="••••••••" 
                               class="w-full p-3.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-amber-500 bg-white">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">تأكيد كلمة المرور *</label>
                        <input type="password" name="password_confirmation" required placeholder="••••••••" 
                               class="w-full p-3.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-amber-500 bg-white">
                    </div>
                </div>

                <button type="submit" class="w-full py-4 rounded-2xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-black text-sm shadow-xl transition transform hover:scale-[1.01]">
                    إنشاء الحساب وبدء الرحلة
                </button>
            </form>

            <!-- Divider -->
            <div class="relative text-center my-4">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-200"></div></div>
                <span class="relative bg-[#FAF8F5] px-4 text-xs text-slate-400 font-bold">أو</span>
            </div>

            <!-- Social Login Button matching Login Register.png -->
            <button type="button" class="w-full py-3.5 rounded-2xl bg-white border border-slate-200 text-slate-800 text-xs font-bold hover:bg-slate-50 transition flex items-center justify-center gap-3 shadow-sm">
                <i class="fa-brands fa-google text-rose-500 text-base"></i>
                <span>المتابعة عبر Google</span>
            </button>

            <!-- Fast Demo Login Buttons for Evaluators -->
            <div class="pt-4 border-t border-slate-200 text-center space-y-2">
                <span class="text-[11px] font-bold text-slate-400">حسابات تجريبية للاختبار السريع:</span>
                <div class="flex items-center justify-center gap-2">
                    <a href="{{ route('auth.demo', 'tourist') }}" class="px-3 py-1.5 rounded-xl bg-teal-50 border border-teal-200 text-teal-800 text-xs font-bold hover:bg-teal-100 transition">
                        سائح (عبدالعزيز)
                    </a>
                    <a href="{{ route('auth.demo', 'guide') }}" class="px-3 py-1.5 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 text-xs font-bold hover:bg-amber-100 transition">
                        مرشد سياحي (سعيد)
                    </a>
                    <a href="{{ route('auth.demo', 'admin') }}" class="px-3 py-1.5 rounded-xl bg-purple-50 border border-purple-200 text-purple-800 text-xs font-bold hover:bg-purple-100 transition">
                        مدير المنصة (Admin)
                    </a>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tabLogin = document.getElementById('tabLoginBtn');
        const tabRegister = document.getElementById('tabRegisterBtn');
        const loginBlock = document.getElementById('loginFormBlock');
        const registerBlock = document.getElementById('registerFormBlock');

        tabLogin.addEventListener('click', () => {
            tabLogin.className = 'w-1/2 py-2.5 rounded-xl bg-[#0A3847] text-white shadow-md transition';
            tabRegister.className = 'w-1/2 py-2.5 rounded-xl text-slate-600 hover:text-slate-900 transition';
            loginBlock.classList.remove('hidden');
            registerBlock.classList.add('hidden');
        });

        tabRegister.addEventListener('click', () => {
            tabRegister.className = 'w-1/2 py-2.5 rounded-xl bg-[#0A3847] text-white shadow-md transition';
            tabLogin.className = 'w-1/2 py-2.5 rounded-xl text-slate-600 hover:text-slate-900 transition';
            registerBlock.classList.remove('hidden');
            loginBlock.classList.add('hidden');
        });
    });
</script>
@endpush
