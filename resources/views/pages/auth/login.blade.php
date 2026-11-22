@extends('layouts.app')

@section('title', 'تسجيل الدخول وإنشاء حساب · مَطَلّ جازان')
@section('hide_navbar', true)

@push('styles')
<style>
    @keyframes mgFadeUp { from { opacity: 0; transform: translateY(14px); } to { opacity: 1; transform: none; } }
    .mg-fade-up { animation: mgFadeUp .55s cubic-bezier(.16, 1, .3, 1) both; }
</style>
@endpush

@section('content')

@php
    $register = old('_form') === 'register';
    $isLocal = app()->environment('local');
    $features = [
        ['fa-bookmark', 'احفظ مساراتك المفضلة'],
        ['fa-wand-magic-sparkles', 'خطط رحلاتك بالذكاء الاصطناعي'],
        ['fa-ticket', 'أدر حجوزاتك بكل سهولة'],
    ];
    $demo = [
        ['tourist', 'سائح (عبدالعزيز)', 'fa-suitcase-rolling'],
        ['guide', 'مرشد سياحي (سعيد)', 'fa-user-tie'],
        ['admin', 'مدير المنصة (Admin)', 'fa-user-shield'],
    ];
    $errorText = 'mt-1.5 text-xs font-bold text-rose-600';
@endphp

<div class="min-h-screen flex flex-col md:flex-row bg-[#F8FCFD]">

    {{-- ================= BANNER ================= --}}
    <div class="md:w-1/2 relative min-h-[360px] md:min-h-screen overflow-hidden flex items-end p-8 sm:p-14 text-white order-2 md:order-1">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('/images/coastal_beach.jpg'); transform: scale(1.08); animation: mgKen 22s ease-in-out infinite alternate;"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-[#164E63]/90 via-[#0e3b4d]/80 to-[#06B6D4]/30"></div>
        <div class="mg-orb mg-orb-cyan w-96 h-96 -top-24 -right-20"></div>
        <div class="mg-orb mg-orb-sky w-72 h-72 bottom-10 -left-16"></div>

        <div class="relative z-[2] max-w-lg space-y-6">
            <span class="mg-badge mg-badge-cyan"><i class="fa-solid fa-mountain-sun"></i> منصة مَطَلّ الرقمية للسياحة</span>
            <h2 class="text-4xl sm:text-5xl font-black leading-tight">اكتشف الطبيعة.. <span class="mg-text-grad">عش التجربة</span></h2>
            <p class="text-sky-100/90 leading-loose">كل رحلة أجمل مع مَطَلّ · من أعالي جازان إلى سواحلها</p>
            <div class="hidden sm:grid gap-3 pt-2">
                @foreach($features as $i => $f)
                    <div class="mg-card-glass rounded-2xl px-4 py-3 flex items-center gap-3 {{ $i % 2 ? 'mg-float-b' : 'mg-float-a' }} w-fit">
                        <span class="mg-icon-tile !w-9 !h-9 !text-sm !rounded-xl"><i class="fa-solid {{ $f[0] }}"></i></span>
                        <span class="font-bold text-sm">{{ $f[1] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ================= FORM PANEL ================= --}}
    <div class="md:w-1/2 relative flex items-center justify-center p-6 sm:p-12 overflow-hidden order-1 md:order-2">
        <div class="mg-orb mg-orb-cyan w-80 h-80 -top-24 -left-24"></div>
        <div class="mg-orb mg-orb-sky w-72 h-72 -bottom-24 -right-20"></div>

        <div class="relative z-[2] w-full max-w-md py-6">
            <div class="flex items-center justify-between mb-8">
                <a href="{{ route('home') }}" title="الصفحة الرئيسية"><img src="/images/matal_official_logo.png" alt="مَطَلّ MATAL" class="h-16 w-auto"></a>
                <a href="{{ route('home') }}" class="group inline-flex items-center gap-2 text-sm font-black text-[#0891B2] hover:text-[#164E63] transition">
                    <span>العودة للرئيسية</span><i class="fa-solid fa-arrow-left text-xs transition group-hover:-translate-x-1"></i>
                </a>
            </div>

            <h1 class="text-3xl font-black text-[#164E63] mb-2">مرحباً بك في جازان</h1>
            <p class="text-sm text-[#183746]/70 leading-relaxed mb-7">سجّل دخولك لحفظ مساراتك، تخطيط رحلاتك، وإدارة حجوزاتك بكل سهولة.</p>

            {{-- Tabs with sliding pill --}}
            <div class="relative grid grid-cols-2 p-1.5 rounded-2xl bg-[#E0F2FE] mb-7 text-sm font-black">
                <span id="tabIndicator" class="absolute top-1.5 bottom-1.5 right-1.5 w-[calc(50%-0.375rem)] rounded-xl bg-gradient-to-r from-[#164E63] to-[#0e3b4d] shadow-lg shadow-[#164E63]/30 transition-transform duration-500 ease-out" style="transform: {{ $register ? 'translateX(-100%)' : 'translateX(0)' }};"></span>
                <button type="button" id="tabLoginBtn" class="relative z-10 py-2.5 transition-colors duration-300 {{ $register ? 'text-[#164E63]' : 'text-white' }}">تسجيل الدخول</button>
                <button type="button" id="tabRegisterBtn" class="relative z-10 py-2.5 transition-colors duration-300 {{ $register ? 'text-white' : 'text-[#164E63]' }}">إنشاء حساب جديد</button>
            </div>

            {{-- ============ LOGIN ============ --}}
            <form id="loginFormBlock" action="{{ route('login.submit') }}" method="POST" class="space-y-5 {{ $register ? 'hidden' : 'mg-fade-up' }}">
                @csrf
                <div>
                    <label class="mg-label" for="login_email">البريد الإلكتروني <span class="text-[#06B6D4]">*</span></label>
                    <div class="relative">
                        <i class="fa-regular fa-envelope absolute right-4 top-1/2 -translate-y-1/2 text-[#06B6D4] text-sm pointer-events-none"></i>
                        <input id="login_email" type="email" name="email" value="{{ old('email', $isLocal ? 'tourist@matal.sa' : '') }}" required placeholder="yourname@domain.com" class="mg-field !pr-11" dir="ltr" style="text-align: right;">
                    </div>
                    @if(!$register && $errors->has('email'))<p class="{{ $errorText }}">{{ $errors->first('email') }}</p>@endif
                </div>
                <div>
                    <label class="mg-label" for="login_password">كلمة المرور <span class="text-[#06B6D4]">*</span></label>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute right-4 top-1/2 -translate-y-1/2 text-[#06B6D4] text-sm pointer-events-none"></i>
                        <input id="login_password" type="password" name="password" @if($isLocal) value="password123" @endif required placeholder="••••••••" class="mg-field !pr-11 !pl-11" dir="ltr" style="text-align: right;">
                        <button type="button" data-toggle-pw="login_password" class="absolute left-3 top-1/2 -translate-y-1/2 w-8 h-8 rounded-lg text-[#164E63]/60 hover:text-[#06B6D4] hover:bg-[#E0F2FE] transition" aria-label="إظهار كلمة المرور"><i class="fa-regular fa-eye text-sm"></i></button>
                    </div>
                    @if(!$register && $errors->has('password'))<p class="{{ $errorText }}">{{ $errors->first('password') }}</p>@endif
                </div>
                <div class="flex items-center justify-between text-sm">
                    <label class="inline-flex items-center gap-2 cursor-pointer text-[#183746]/80 font-semibold">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded accent-[#06B6D4]">
                        <span>تذكرني على هذا الجهاز</span>
                    </label>
                    <a href="{{ route('contact') }}" class="font-black text-[#0891B2] hover:text-[#164E63] transition">نسيت كلمة المرور؟</a>
                </div>
                <button type="submit" class="mg-btn w-full !py-3.5" data-magnetic><span>دخول</span><i class="fa-solid fa-arrow-left text-xs"></i></button>
            </form>

            {{-- ============ REGISTER ============ --}}
            <form id="registerFormBlock" action="{{ route('register.submit') }}" method="POST" class="space-y-5 {{ $register ? 'mg-fade-up' : 'hidden' }}">
                @csrf
                <input type="hidden" name="_form" value="register">
                <div>
                    <label class="mg-label" for="reg_name">الاسم الكامل <span class="text-[#06B6D4]">*</span></label>
                    <div class="relative">
                        <i class="fa-regular fa-user absolute right-4 top-1/2 -translate-y-1/2 text-[#06B6D4] text-sm pointer-events-none"></i>
                        <input id="reg_name" type="text" name="name" value="{{ $register ? old('name') : '' }}" required placeholder="الاسم ثلاثي" class="mg-field !pr-11">
                    </div>
                    @if($register && $errors->has('name'))<p class="{{ $errorText }}">{{ $errors->first('name') }}</p>@endif
                </div>
                <div>
                    <label class="mg-label" for="reg_email">البريد الإلكتروني <span class="text-[#06B6D4]">*</span></label>
                    <div class="relative">
                        <i class="fa-regular fa-envelope absolute right-4 top-1/2 -translate-y-1/2 text-[#06B6D4] text-sm pointer-events-none"></i>
                        <input id="reg_email" type="email" name="email" value="{{ $register ? old('email') : '' }}" required placeholder="example@domain.com" class="mg-field !pr-11" dir="ltr" style="text-align: right;">
                    </div>
                    @if($register && $errors->has('email'))<p class="{{ $errorText }}">{{ $errors->first('email') }}</p>@endif
                </div>
                <div>
                    <label class="mg-label" for="reg_phone">رقم الجوال <span class="text-[#164E63]/50 font-semibold">(اختياري)</span></label>
                    <div class="relative">
                        <i class="fa-solid fa-mobile-screen absolute right-4 top-1/2 -translate-y-1/2 text-[#06B6D4] text-sm pointer-events-none"></i>
                        <input id="reg_phone" type="tel" name="phone" value="{{ $register ? old('phone') : '' }}" placeholder="05XXXXXXXX" class="mg-field !pr-11" dir="ltr" style="text-align: right;">
                    </div>
                    @if($register && $errors->has('phone'))<p class="{{ $errorText }}">{{ $errors->first('phone') }}</p>@endif
                </div>
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="mg-label" for="reg_password">كلمة المرور <span class="text-[#06B6D4]">*</span></label>
                        <div class="relative">
                            <input id="reg_password" type="password" name="password" required placeholder="••••••••" class="mg-field !pl-11" dir="ltr" style="text-align: right;">
                            <button type="button" data-toggle-pw="reg_password" class="absolute left-3 top-1/2 -translate-y-1/2 w-8 h-8 rounded-lg text-[#164E63]/60 hover:text-[#06B6D4] hover:bg-[#E0F2FE] transition" aria-label="إظهار كلمة المرور"><i class="fa-regular fa-eye text-sm"></i></button>
                        </div>
                        <div id="pwBars" class="mt-2 grid grid-cols-4 gap-1.5" aria-hidden="true">
                            @for($i = 0; $i < 4; $i++)<span class="h-1.5 rounded-full bg-[#E0F2FE] transition-colors duration-300"></span>@endfor
                        </div>
                        <p id="pwHint" class="mt-1 text-[11px] font-bold text-[#164E63]/60">6 أحرف على الأقل</p>
                        @if($register && $errors->has('password'))<p class="{{ $errorText }}">{{ $errors->first('password') }}</p>@endif
                    </div>
                    <div>
                        <label class="mg-label" for="reg_password2">تأكيد كلمة المرور <span class="text-[#06B6D4]">*</span></label>
                        <input id="reg_password2" type="password" name="password_confirmation" required placeholder="••••••••" class="mg-field" dir="ltr" style="text-align: right;">
                    </div>
                </div>
                <button type="submit" class="mg-btn w-full !py-3.5" data-magnetic><span>إنشاء الحساب وبدء الرحلة</span><i class="fa-solid fa-arrow-left text-xs"></i></button>
            </form>

            {{-- Divider --}}
            <div class="relative my-7">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-[#06B6D4]/20"></div></div>
                <div class="relative flex justify-center"><span class="px-4 bg-[#F8FCFD] text-xs font-black text-[#164E63]/60">أو</span></div>
            </div>

            <button type="button" disabled class="w-full flex items-center justify-center gap-3 py-3 rounded-2xl bg-white border-[1.5px] border-[#06B6D4]/20 text-[#164E63]/55 font-bold text-sm cursor-not-allowed">
                <i class="fa-brands fa-google"></i><span>المتابعة عبر Google</span>
                <span class="mg-badge !bg-[#E0F2FE] !text-[#0891B2] !border-[#06B6D4]/25 !text-[10px]">قريباً</span>
            </button>

            {{-- Demo accounts --}}
            @if($isLocal)
            <div class="mt-8 rounded-2xl bg-gradient-to-br from-[#E0F2FE] to-white border border-[#06B6D4]/20 p-4">
                <span class="block text-[11px] font-black text-[#164E63] mb-3 text-center"><i class="fa-solid fa-bolt text-[#06B6D4]"></i> حسابات تجريبية للاختبار السريع</span>
                <div class="grid sm:grid-cols-3 gap-2">
                    @foreach($demo as $d)
                        <a href="{{ route('auth.demo', $d[0]) }}" class="flex flex-col items-center gap-1.5 px-2 py-3 rounded-xl bg-white border border-[#06B6D4]/20 hover:border-[#06B6D4] hover:-translate-y-1 hover:shadow-lg hover:shadow-[#06B6D4]/15 transition-all duration-300 text-center">
                            <i class="fa-solid {{ $d[2] }} text-[#06B6D4]"></i>
                            <span class="text-[11px] font-black text-[#164E63] leading-tight">{{ $d[1] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif
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
            tabLogin.classList.toggle('text-white', !reg);
            tabLogin.classList.toggle('text-[#164E63]', reg);
            tabRegister.classList.toggle('text-white', reg);
            tabRegister.classList.toggle('text-[#164E63]', !reg);
            const [shown, hidden] = reg ? [registerBlock, loginBlock] : [loginBlock, registerBlock];
            hidden.classList.add('hidden');
            hidden.classList.remove('mg-fade-up');
            shown.classList.remove('hidden');
            shown.classList.remove('mg-fade-up');
            void shown.offsetWidth; // restart the animation
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
        const bars = document.querySelectorAll('#pwBars span');
        const hint = document.getElementById('pwHint');
        const levels = [
            ['6 أحرف على الأقل', '#E0F2FE'],
            ['ضعيفة', '#164E63'],
            ['مقبولة', '#0e3b4d'],
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
            bars.forEach((b, i) => { b.style.background = i < score ? levels[score][1] : '#E0F2FE'; });
            hint.textContent = levels[score][0];
        });
    });
</script>
@endpush
