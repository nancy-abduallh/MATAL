@extends('layouts.app')

@section('title', 'تسجيل الدخول وإنشاء حساب · مَطَلّ جازان')
@section('hide_navbar', true)

@push('styles')
<style>
    @keyframes mgFadeUp { from { opacity: 0; transform: translateY(14px); } to { opacity: 1; transform: none; } }
    .mg-fade-up { animation: mgFadeUp .45s cubic-bezier(.16, 1, .3, 1) both; }
    
    @keyframes kenBurnsSlow {
        0% { transform: scale(1.04) translate(0, 0); }
        50% { transform: scale(1.1) translate(-1.5%, -1.5%); }
        100% { transform: scale(1.04) translate(0, 0); }
    }
    .ken-burns-bg {
        animation: kenBurnsSlow 35s ease-in-out infinite alternate;
    }

    @keyframes pulseGlow {
        0%, 100% { opacity: 0.35; transform: scale(1); }
        50% { opacity: 0.65; transform: scale(1.08); }
    }
    .pulse-glow { animation: pulseGlow 8s ease-in-out infinite; }
</style>
@endpush

@section('content')

@php
    $register = old('_form') === 'register';
    $isLocal = app()->environment('local');
    $features = [
        ['fa-mountain-sun', 'استكشف مسارات جازان الأيقونية من الجبال إلى السواحل'],
        ['fa-wand-magic-sparkles', 'خطط رحلاتك المتكاملة بمخطط الذكاء الاصطناعي'],
        ['fa-ticket', 'أدر حجوزاتك وإقامتك السياحية بكل سهولة وأمان'],
    ];
    $demo = [
        ['tourist', 'سائح (عبدالعزيز)', 'fa-suitcase-rolling'],
        ['guide', 'مرشد سياحي (سعيد)', 'fa-user-tie'],
        ['admin', 'مدير المنصة (Admin)', 'fa-user-shield'],
    ];
    $errorText = 'mt-1.5 text-xs font-black text-rose-300 drop-shadow-sm';
@endphp

<div class="relative min-h-screen flex items-center justify-center p-3 sm:p-6 lg:p-10 overflow-hidden bg-[#071d27] selection:bg-[#06B6D4] selection:text-white">

    <!-- Ambient Glowing Tech Background -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-cyan-600/20 blur-[120px] pulse-glow"></div>
        <div class="absolute -bottom-32 -left-32 w-96 h-96 rounded-full bg-sky-600/20 blur-[120px] pulse-glow" style="animation-delay: -4s;"></div>
        <div class="absolute inset-0 opacity-15" style="background-image: radial-gradient(rgba(56, 189, 248, 0.4) 1px, transparent 1px); background-size: 28px 28px;"></div>
    </div>

    <!-- Central Card with Professional Background Image (Mobile & Desktop) -->
    <div class="relative z-10 w-full max-w-5xl rounded-3xl lg:rounded-[2.5rem] overflow-hidden border border-white/30 shadow-[0_30px_90px_rgba(0,0,0,0.65)] grid grid-cols-1 lg:grid-cols-12 my-auto bg-cover bg-center" style="background-image: url('/images/aldarb_viewpoint_hd.jpg');">
        
        <!-- Deep Oceanic Frosted Glass Overlay across the Card -->
        <div class="absolute inset-0 bg-gradient-to-tr from-[#072430]/95 via-[#0e3b4d]/92 to-[#164E63]/88 backdrop-blur-xl"></div>
        <div class="absolute inset-0 bg-black/25"></div>

        <!-- ================= FORM PANEL (7 COLS ON DESKTOP, FULL ON MOBILE) ================= -->
        <div class="relative z-10 lg:col-span-7 p-6 sm:p-10 lg:p-12 flex flex-col justify-between order-1">
            
            <div>
                <!-- Top Brand & Return Link -->
                <div class="flex items-center justify-between mb-6 sm:mb-8">
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5 group" title="الصفحة الرئيسية">
                        <img src="/images/matal_logo_white_text.png" alt="مَطَلّ MATAL" class="h-12 sm:h-14 w-auto drop-shadow-lg transform transition duration-300 group-hover:scale-105">
                    </a>
                    <a href="{{ route('home') }}" class="group inline-flex items-center gap-2 text-xs sm:text-sm font-black text-white bg-white/20 hover:bg-white/30 backdrop-blur-md border border-white/35 transition px-4 py-1.5 rounded-full shadow-sm">
                        <span>العودة للرئيسية</span>
                        <i class="fa-solid fa-arrow-left text-[11px] text-[#38BDF8] transition group-hover:-translate-x-1"></i>
                    </a>
                </div>

                <!-- Headline -->
                <h1 class="text-2xl sm:text-3xl font-black text-white mb-1.5 font-heading drop-shadow-md">
                    مرحباً بك في <span class="text-[#38BDF8] drop-shadow-[0_2px_10px_rgba(56,189,248,0.5)]">مَطَلّ</span>
                </h1>
                <p class="text-xs sm:text-sm text-sky-100/90 leading-relaxed mb-6 font-semibold drop-shadow-sm">
                    سجّل دخولك لحفظ مساراتك، تخطيط رحلاتك، وإدارة حجوزاتك بكل سهولة.
                </p>

                <!-- High-Contrast Segmented Tabs Switcher -->
                <div class="relative grid grid-cols-2 p-1.5 rounded-2xl bg-[#072430]/70 backdrop-blur-xl border border-white/25 mb-6 text-xs sm:text-sm font-black shadow-inner">
                    <span id="tabIndicator" class="absolute top-1.5 bottom-1.5 right-1.5 w-[calc(50%-0.375rem)] rounded-xl bg-gradient-to-r from-[#06B6D4] to-[#38BDF8] shadow-lg shadow-cyan-500/40 transition-transform duration-500 ease-out" style="transform: {{ $register ? 'translateX(-100%)' : 'translateX(0)' }};"></span>
                    <button type="button" id="tabLoginBtn" class="relative z-10 py-2.5 transition-colors duration-300 cursor-pointer {{ $register ? 'text-white/80 font-bold' : 'text-[#072430] font-black' }}">تسجيل الدخول</button>
                    <button type="button" id="tabRegisterBtn" class="relative z-10 py-2.5 transition-colors duration-300 cursor-pointer {{ $register ? 'text-[#072430] font-black' : 'text-white/80 font-bold' }}">إنشاء حساب جديد</button>
                </div>

                <!-- ============ LOGIN FORM ============ -->
                <form id="loginFormBlock" action="{{ route('login.submit') }}" method="POST" class="space-y-4 sm:space-y-5 {{ $register ? 'hidden' : 'mg-fade-up' }}">
                    @csrf
                    <div>
                        <label class="block text-xs sm:text-sm font-black text-white mb-1.5 drop-shadow-sm" for="login_email">
                            البريد الإلكتروني <span class="text-[#38BDF8] font-black">*</span>
                        </label>
                        <div class="relative">
                            <i class="fa-regular fa-envelope absolute right-4 top-1/2 -translate-y-1/2 text-[#0891B2] text-base pointer-events-none z-10"></i>
                            <input id="login_email" type="email" name="email" value="{{ old('email', $isLocal ? 'tourist@matal.sa' : '') }}" required placeholder="yourname@domain.com" class="w-full bg-white/95 focus:bg-white text-[#164E63] font-bold text-sm sm:text-base rounded-2xl border-2 border-white shadow-md focus:border-[#38BDF8] focus:ring-4 focus:ring-[#38BDF8]/25 transition duration-200 !pr-11 !pl-4 py-3 placeholder-[#164E63]/45" dir="ltr" style="text-align: right;">
                        </div>
                        @if(!$register && $errors->has('email'))<p class="{{ $errorText }}">{{ $errors->first('email') }}</p>@endif
                    </div>
                    
                    <div>
                        <label class="block text-xs sm:text-sm font-black text-white mb-1.5 drop-shadow-sm" for="login_password">
                            كلمة المرور <span class="text-[#38BDF8] font-black">*</span>
                        </label>
                        <div class="relative">
                            <i class="fa-solid fa-lock absolute right-4 top-1/2 -translate-y-1/2 text-[#0891B2] text-base pointer-events-none z-10"></i>
                            <input id="login_password" type="password" name="password" @if($isLocal) value="password123" @endif required placeholder="••••••••" class="w-full bg-white/95 focus:bg-white text-[#164E63] font-bold text-sm sm:text-base rounded-2xl border-2 border-white shadow-md focus:border-[#38BDF8] focus:ring-4 focus:ring-[#38BDF8]/25 transition duration-200 !pr-11 !pl-12 py-3 placeholder-[#164E63]/45" dir="ltr" style="text-align: right;">
                            <button type="button" data-toggle-pw="login_password" class="absolute left-3 top-1/2 -translate-y-1/2 w-8 h-8 rounded-xl text-[#164E63]/70 hover:text-[#0891B2] hover:bg-[#E0F2FE] transition flex items-center justify-center cursor-pointer z-10" aria-label="إظهار كلمة المرور">
                                <i class="fa-regular fa-eye text-sm"></i>
                            </button>
                        </div>
                        @if(!$register && $errors->has('password'))<p class="{{ $errorText }}">{{ $errors->first('password') }}</p>@endif
                    </div>

                    <div class="flex items-center justify-between text-xs sm:text-sm pt-1">
                        <label class="inline-flex items-center gap-2 cursor-pointer text-white font-bold select-none drop-shadow-sm">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded accent-[#06B6D4] cursor-pointer">
                            <span>تذكرني على هذا الجهاز</span>
                        </label>
                        <a href="{{ route('contact') }}" class="font-black text-[#38BDF8] hover:text-white transition drop-shadow-sm">نسيت كلمة المرور؟</a>
                    </div>

                    <button type="submit" class="w-full py-3.5 px-6 rounded-2xl bg-gradient-to-r from-[#06B6D4] via-[#0891B2] to-[#38BDF8] hover:from-[#0891B2] hover:to-[#06B6D4] text-white font-black text-sm sm:text-base shadow-xl shadow-cyan-500/40 border border-white/40 transition-all duration-300 transform active:scale-98 flex items-center justify-center gap-2 cursor-pointer">
                        <span>دخول</span>
                        <i class="fa-solid fa-arrow-left text-xs"></i>
                    </button>
                </form>

                <!-- ============ REGISTER FORM ============ -->
                <form id="registerFormBlock" action="{{ route('register.submit') }}" method="POST" class="space-y-4 {{ $register ? 'mg-fade-up' : 'hidden' }}">
                    @csrf
                    <input type="hidden" name="_form" value="register">
                    
                    <div>
                        <label class="block text-xs sm:text-sm font-black text-white mb-1.5 drop-shadow-sm" for="reg_name">
                            الاسم الكامل <span class="text-[#38BDF8] font-black">*</span>
                        </label>
                        <div class="relative">
                            <i class="fa-regular fa-user absolute right-4 top-1/2 -translate-y-1/2 text-[#0891B2] text-base pointer-events-none z-10"></i>
                            <input id="reg_name" type="text" name="name" value="{{ $register ? old('name') : '' }}" required placeholder="الاسم ثلاثي" class="w-full bg-white/95 focus:bg-white text-[#164E63] font-bold text-sm sm:text-base rounded-2xl border-2 border-white shadow-md focus:border-[#38BDF8] focus:ring-4 focus:ring-[#38BDF8]/25 transition duration-200 !pr-11 !pl-4 py-3 placeholder-[#164E63]/45">
                        </div>
                        @if($register && $errors->has('name'))<p class="{{ $errorText }}">{{ $errors->first('name') }}</p>@endif
                    </div>

                    <div>
                        <label class="block text-xs sm:text-sm font-black text-white mb-1.5 drop-shadow-sm" for="reg_email">
                            البريد الإلكتروني <span class="text-[#38BDF8] font-black">*</span>
                        </label>
                        <div class="relative">
                            <i class="fa-regular fa-envelope absolute right-4 top-1/2 -translate-y-1/2 text-[#0891B2] text-base pointer-events-none z-10"></i>
                            <input id="reg_email" type="email" name="email" value="{{ $register ? old('email') : '' }}" required placeholder="example@domain.com" class="w-full bg-white/95 focus:bg-white text-[#164E63] font-bold text-sm sm:text-base rounded-2xl border-2 border-white shadow-md focus:border-[#38BDF8] focus:ring-4 focus:ring-[#38BDF8]/25 transition duration-200 !pr-11 !pl-4 py-3 placeholder-[#164E63]/45" dir="ltr" style="text-align: right;">
                        </div>
                        @if($register && $errors->has('email'))<p class="{{ $errorText }}">{{ $errors->first('email') }}</p>@endif
                    </div>

                    <div>
                        <label class="block text-xs sm:text-sm font-black text-white mb-1.5 drop-shadow-sm" for="reg_phone">
                            رقم الجوال <span class="text-sky-200/70 font-semibold">(اختياري)</span>
                        </label>
                        <div class="relative">
                            <i class="fa-solid fa-mobile-screen absolute right-4 top-1/2 -translate-y-1/2 text-[#0891B2] text-base pointer-events-none z-10"></i>
                            <input id="reg_phone" type="tel" name="phone" value="{{ $register ? old('phone') : '' }}" placeholder="05XXXXXXXX" class="w-full bg-white/95 focus:bg-white text-[#164E63] font-bold text-sm sm:text-base rounded-2xl border-2 border-white shadow-md focus:border-[#38BDF8] focus:ring-4 focus:ring-[#38BDF8]/25 transition duration-200 !pr-11 !pl-4 py-3 placeholder-[#164E63]/45" dir="ltr" style="text-align: right;">
                        </div>
                        @if($register && $errors->has('phone'))<p class="{{ $errorText }}">{{ $errors->first('phone') }}</p>@endif
                    </div>

                    <div class="grid sm:grid-cols-2 gap-3 sm:gap-4">
                        <div>
                            <label class="block text-xs sm:text-sm font-black text-white mb-1.5 drop-shadow-sm" for="reg_password">
                                كلمة المرور <span class="text-[#38BDF8] font-black">*</span>
                            </label>
                            <div class="relative">
                                <input id="reg_password" type="password" name="password" required placeholder="••••••••" class="w-full bg-white/95 focus:bg-white text-[#164E63] font-bold text-sm sm:text-base rounded-2xl border-2 border-white shadow-md focus:border-[#38BDF8] focus:ring-4 focus:ring-[#38BDF8]/25 transition duration-200 !pl-11 !pr-4 py-3 placeholder-[#164E63]/45" dir="ltr" style="text-align: right;">
                                <button type="button" data-toggle-pw="reg_password" class="absolute left-3 top-1/2 -translate-y-1/2 w-8 h-8 rounded-xl text-[#164E63]/70 hover:text-[#0891B2] hover:bg-[#E0F2FE] transition flex items-center justify-center cursor-pointer z-10" aria-label="إظهار كلمة المرور">
                                    <i class="fa-regular fa-eye text-sm"></i>
                                </button>
                            </div>
                            <div id="pwBars" class="mt-2 grid grid-cols-4 gap-1.5" aria-hidden="true">
                                @for($i = 0; $i < 4; $i++)<span class="h-1.5 rounded-full bg-white/20 transition-colors duration-300"></span>@endfor
                            </div>
                            <p id="pwHint" class="mt-1 text-[11px] font-bold text-sky-100/80 drop-shadow-sm">6 أحرف على الأقل</p>
                            @if($register && $errors->has('password'))<p class="{{ $errorText }}">{{ $errors->first('password') }}</p>@endif
                        </div>
                        <div>
                            <label class="block text-xs sm:text-sm font-black text-white mb-1.5 drop-shadow-sm" for="reg_password2">
                                تأكيد كلمة المرور <span class="text-[#38BDF8] font-black">*</span>
                            </label>
                            <input id="reg_password2" type="password" name="password_confirmation" required placeholder="••••••••" class="w-full bg-white/95 focus:bg-white text-[#164E63] font-bold text-sm sm:text-base rounded-2xl border-2 border-white shadow-md focus:border-[#38BDF8] focus:ring-4 focus:ring-[#38BDF8]/25 transition duration-200 px-4 py-3 placeholder-[#164E63]/45" dir="ltr" style="text-align: right;">
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3.5 px-6 rounded-2xl bg-gradient-to-r from-[#06B6D4] via-[#0891B2] to-[#38BDF8] hover:from-[#0891B2] hover:to-[#06B6D4] text-white font-black text-sm sm:text-base shadow-xl shadow-cyan-500/40 border border-white/40 transition-all duration-300 transform active:scale-98 flex items-center justify-center gap-2 cursor-pointer">
                        <span>إنشاء الحساب وبدء الرحلة</span>
                        <i class="fa-solid fa-arrow-left text-xs"></i>
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-5 sm:my-6">
                    <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-white/20"></div></div>
                    <div class="relative flex justify-center"><span class="px-4 py-0.5 rounded-full bg-[#072430]/80 text-xs font-black text-sky-100 border border-white/15 drop-shadow-sm">أو</span></div>
                </div>

                <!-- Google Sign-In -->
                <button type="button" disabled class="w-full flex items-center justify-center gap-3 py-3 rounded-2xl bg-white/95 border-2 border-white text-[#164E63] font-black text-xs sm:text-sm shadow-md cursor-not-allowed">
                    <i class="fa-brands fa-google text-rose-500 text-base"></i>
                    <span>المتابعة عبر Google</span>
                    <span class="px-2 py-0.5 rounded-full bg-[#E0F2FE] text-[#0891B2] text-[10px] font-black border border-[#06B6D4]/30">قريباً</span>
                </button>
            </div>

            <!-- Fast Demo Accounts (Testing Only) -->
            @if($isLocal)
            <div class="mt-6 pt-5 border-t border-white/20">
                <span class="block text-xs font-black text-white mb-2.5 text-center drop-shadow-sm">
                    <i class="fa-solid fa-bolt text-[#38BDF8]"></i> حسابات تجريبية للاختبار السريع (بنقرة واحدة)
                </span>
                <div class="grid grid-cols-3 gap-2">
                    @foreach($demo as $d)
                        <a href="{{ route('auth.demo', $d[0]) }}" class="flex flex-col items-center gap-1.5 p-2.5 rounded-2xl bg-white/95 hover:bg-white border-2 border-white hover:border-[#38BDF8] shadow-md hover:shadow-cyan-500/25 transition-all duration-200 text-center active:scale-95 group">
                            <span class="w-8 h-8 rounded-xl bg-gradient-to-tr from-[#0891B2] to-[#38BDF8] text-white flex items-center justify-center text-xs shadow-sm group-hover:scale-105 transition">
                                <i class="fa-solid {{ $d[2] }}"></i>
                            </span>
                            <span class="text-[11px] font-black text-[#164E63] leading-tight truncate w-full">{{ $d[1] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        <!-- ================= VISUAL SHOWCASE BANNER (5 COLS, DESKTOP) ================= -->
        <div class="hidden lg:flex lg:col-span-5 relative overflow-hidden flex-col justify-between p-10 text-white order-2 border-r border-white/15">
            
            <!-- Backdrop Image inside banner -->
            <div class="absolute inset-0 bg-cover bg-center ken-burns-bg" style="background-image: url('/images/coastal_beach_hd.jpg');"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#072430]/95 via-[#0e3b4d]/85 to-[#164E63]/70"></div>
            
            <!-- Orbs inside banner -->
            <div class="mg-orb mg-orb-cyan w-72 h-72 -top-16 -right-16 opacity-70 pointer-events-none"></div>
            <div class="mg-orb mg-orb-sky w-72 h-72 -bottom-16 -left-16 opacity-70 pointer-events-none"></div>

            <div class="relative z-10 space-y-6">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/20 backdrop-blur-md border border-white/30 text-xs font-bold text-sky-100 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-[#38BDF8] animate-ping"></span>
                    <span>منصة مَطَلّ السياحية · جازان</span>
                </span>

                <h2 class="text-3xl sm:text-4xl font-black leading-tight font-heading">
                    اكتشف الطبيعة..<br>
                    <span class="text-[#38BDF8]">عش التجربة</span>
                </h2>

                <p class="text-sky-100/90 text-sm leading-relaxed font-medium">
                    من أعالي قمم فيفا والداير الخضراء إلى مياه جزر فرسان الفيروزية وشقوق وادي لجب الأسطورية.
                </p>

                <!-- Floating Glass Feature Cards -->
                <div class="space-y-3 pt-2">
                    @foreach($features as $f)
                        <div class="bg-white/15 backdrop-blur-md border border-white/25 rounded-2xl p-3 flex items-center gap-3 shadow-sm hover:bg-white/25 transition">
                            <span class="w-9 h-9 shrink-0 rounded-xl bg-gradient-to-br from-[#06B6D4] to-[#38BDF8] text-white flex items-center justify-center text-sm shadow-sm">
                                <i class="fa-solid {{ $f[0] }}"></i>
                            </span>
                            <span class="font-bold text-xs text-white leading-snug">{{ $f[1] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Footer Badge inside banner -->
            <div class="relative z-10 pt-6 border-t border-white/20 flex items-center justify-between text-xs text-sky-100/80 font-medium">
                <span>رحلة استثنائية متكاملة 100%</span>
                <span class="text-[#38BDF8] font-bold flex items-center gap-1.5">
                    <i class="fa-solid fa-shield-halved"></i>
                    <span>آمنة وموثقة</span>
                </span>
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
        const indicator = document.getElementById('tabIndicator');

        function show(which) {
            const reg = which === 'register';
            indicator.style.transform = reg ? 'translateX(-100%)' : 'translateX(0)';
            if (reg) {
                tabRegister.classList.remove('text-white/80', 'font-bold');
                tabRegister.classList.add('text-[#072430]', 'font-black');
                tabLogin.classList.remove('text-[#072430]', 'font-black');
                tabLogin.classList.add('text-white/80', 'font-bold');
            } else {
                tabLogin.classList.remove('text-white/80', 'font-bold');
                tabLogin.classList.add('text-[#072430]', 'font-black');
                tabRegister.classList.remove('text-[#072430]', 'font-black');
                tabRegister.classList.add('text-white/80', 'font-bold');
            }
            const [shown, hidden] = reg ? [registerBlock, loginBlock] : [loginBlock, registerBlock];
            hidden.classList.add('hidden');
            hidden.classList.remove('mg-fade-up');
            shown.classList.remove('hidden');
            shown.classList.remove('mg-fade-up');
            void shown.offsetWidth; // restart animation
            shown.classList.add('mg-fade-up');
        }
        
        tabLogin.addEventListener('click', () => show('login'));
        tabRegister.addEventListener('click', () => show('register'));

        // Handle URL tab switching (e.g. ?tab=register or #register)
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('tab') === 'register' || window.location.hash === '#register') {
            show('register');
        }

        // Show / hide password
        document.querySelectorAll('[data-toggle-pw]').forEach(btn => btn.addEventListener('click', () => {
            const input = document.getElementById(btn.dataset.togglePw);
            const showing = input.type === 'text';
            input.type = showing ? 'password' : 'text';
            btn.querySelector('i').className = showing ? 'fa-regular fa-eye text-sm' : 'fa-regular fa-eye-slash text-sm';
        }));

        // Password strength meter
        const pw = document.getElementById('reg_password');
        if (pw) {
            const bars = document.querySelectorAll('#pwBars span');
            const hint = document.getElementById('pwHint');
            const levels = [
                ['6 أحرف على الأقل', 'rgba(255, 255, 255, 0.3)'],
                ['ضعيفة', '#F43F5E'],
                ['مقبولة', '#F59E0B'],
                ['جيدة', '#06B6D4'],
                ['قوية', '#38BDF8'],
            ];
            pw.addEventListener('input', () => {
                const v = pw.value;
                let score = 0;
                if (v.length >= 6) score++;
                if (v.length >= 10) score++;
                if (/[A-Za-z]/.test(v) && /\d/.test(v)) score++;
                if (/[^A-Za-z0-9]/.test(v) || (/[a-z]/.test(v) && /[A-Z]/.test(v))) score++;
                if (!v.length) score = 0;
                bars.forEach((b, i) => { b.style.background = i < score ? levels[score][1] : 'rgba(255, 255, 255, 0.2)'; });
                if (hint) hint.textContent = levels[score][0];
            });
        }
    });
</script>
@endpush