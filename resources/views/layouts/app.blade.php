<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'مَطَلّ · المنصة السياحية الرائدة لاكتشاف جازان من أعاليها إلى سواحلها')</title>
    <meta name="description" content="@yield('meta_description', 'الدليل الذكي والمنصة السياحية الأولى لاكتشاف جازان من خلال المسارات والتجارب المحلية الأصيلة')">
    <meta name="theme-color" content="#164E63">

    <!-- Enables the scroll-reveal animations only when JavaScript is available -->
    <script>document.documentElement.classList.add('js');</script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Allura&family=Amiri:ital,wght@0,400;0,700;1,400;1,700&family=Dancing+Script:wght@400..700&family=Readex+Pro:wght@400;500;600;700;800;900&family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/favicon-192x192.png">
    <link rel="icon" type="image/png" href="/favicon.png">
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/favicon-192x192.png">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes mgToastIn { from { opacity: 0; transform: translateY(-18px) scale(.96); } to { opacity: 1; transform: none; } }
        .mg-toast { animation: mgToastIn .55s cubic-bezier(.16, 1, .3, 1) both; transition: opacity .5s ease, transform .5s ease; }
        .mg-toast.is-leaving { opacity: 0; transform: translateY(-14px) scale(.96); }
    </style>
    @stack('styles')
</head>
<body class="bg-[#F8FCFD] text-[#183746] antialiased selection:bg-[#06B6D4] selection:text-white flex flex-col min-h-screen">

@php
    // Single source of truth for the navigation (desktop + mobile drawer)
    $nav = [
        ['route' => 'home',                'match' => 'home',           'label' => 'الرئيسية',       'full' => 'الرئيسية',              'icon' => 'fa-house'],
        ['route' => 'routes.index',        'match' => 'routes.*',       'label' => 'المسارات',       'full' => 'المسارات السياحية',     'icon' => 'fa-route'],
        ['route' => 'destinations.index',  'match' => 'destinations.*', 'label' => 'الوجهات',        'full' => 'الوجهات والمعالم',      'icon' => 'fa-mountain-sun'],
        ['route' => 'map.index',           'match' => 'map.*',          'label' => 'الخريطة الذكية', 'full' => 'الخريطة الذكية',        'icon' => 'fa-map-location-dot'],
        ['route' => 'events.index',        'match' => 'events.*',       'label' => 'الفعاليات',      'full' => 'الفعاليات والمهرجانات', 'icon' => 'fa-calendar-days'],
        ['route' => 'about',               'match' => 'about',          'label' => 'من نحن',         'full' => 'من نحن',                'icon' => 'fa-circle-info'],
        ['route' => 'contact',             'match' => 'contact',        'label' => 'تواصل معنا',     'full' => 'تواصل معنا',            'icon' => 'fa-envelope', 'desktop' => false],
    ];
    $footRoutes = [
        ['mountains-viewpoints-route', 'مسار الجبال والمطلات'],
        ['saudi-coffee-route', 'مسار البن السعودي الخولاني'],
        ['heritage-and-culture-route', 'المسار التراثي والثقافي'],
        ['farasan-marine-route', 'المسار البحري وجزر فرسان'],
        ['wadi-lajab-adventure-route', 'مسار المغامرات · وادي لجب'],
        ['family-entertainment-route', 'المسار العائلي الترفيهي'],
    ];
    $footLinks = [
        [route('destinations.index'), 'دليل الوجهات والمعالم'],
        [route('map.index'), 'الخريطة السياحية التفاعلية'],
        [route('map.index') . '#aiPlanner', 'مخطط الرحلات الذكي (AI)'],
        [route('events.index'), 'الفعاليات والمهرجانات'],
        [route('about'), 'عن منصة مَطَلّ'],
        [route('contact'), 'تواصل معنا والشراكات'],
    ];
    $toasts = [];
    if (session('success')) { $toasts[] = ['msg' => session('success'), 'icon' => 'fa-circle-check', 'cls' => 'from-[#164E63] to-[#06B6D4]']; }
    if (session('info')) { $toasts[] = ['msg' => session('info'), 'icon' => 'fa-circle-info', 'cls' => 'from-[#0e3b4d] to-[#38BDF8]']; }
    if (session('error') || $errors->any()) { $toasts[] = ['msg' => session('error') ?? $errors->first(), 'icon' => 'fa-triangle-exclamation', 'cls' => 'from-rose-700 to-rose-500']; }
@endphp

    <!-- Scroll progress bar -->
    <div id="scrollProgressBar" class="fixed top-0 inset-x-0 h-1 z-50 origin-right pointer-events-none bg-gradient-to-r from-[#164E63] via-[#06B6D4] to-[#38BDF8] shadow-[0_0_12px_rgba(6,182,212,.7)]" style="transform: scaleX(0);"></div>

    @unless(View::hasSection('hide_navbar') || request()->routeIs('login*'))
    <!-- ================= HEADER ================= -->
    <header id="mainHeader" class="fixed top-0 inset-x-0 z-40 transition-all duration-300 nav-transparent">

        <!-- Announcement bar -->
        <div id="topAnnouncementBar" class="text-xs py-2 px-4 transition-all duration-300 hidden md:block">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center gap-1.5 font-bold px-2.5 py-0.5 rounded-full announcement-badge transition">
                        <span class="w-2 h-2 rounded-full bg-[#38BDF8] animate-ping"></span>
                        موسم جازان السياحي متاح الآن
                    </span>
                    <span class="announcement-divider opacity-40">|</span>
                    <span class="announcement-text font-medium truncate">اكتشف مزارع البن الخولاني، جزر فرسان الفيروزية، وشقوق وادي لجب الأسطورية</span>
                </div>
                <div class="flex items-center gap-4 shrink-0">
                    @if(app()->environment('local'))
                    <a href="{{ route('auth.demo', 'tourist') }}" class="announcement-link transition flex items-center gap-1 font-semibold">
                        <i class="fa-solid fa-bolt text-[#38BDF8]"></i> دخول تجريبي سريع
                    </a>
                    <span class="announcement-divider opacity-40">·</span>
                    @endif
                    <span class="announcement-brand font-bold">www.matal.sa</span>
                </div>
            </div>
        </div>

        <!-- Main bar -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">

                <a href="{{ route('home') }}" class="flex items-center gap-3 group shrink-0">
                    <img src="/images/matal_logo_white_text.png" alt="مَطَلّ MATAL" class="nav-logo-white h-12 sm:h-14 w-auto transform transition duration-300 group-hover:scale-105">
                    <img src="/images/matal_official_logo.png" alt="مَطَلّ MATAL" class="nav-logo-dark h-12 sm:h-14 w-auto transform transition duration-300 group-hover:scale-105">
                </a>

                <!-- Desktop links -->
                <nav class="hidden lg:flex items-center gap-6 xl:gap-7 text-sm font-semibold">
                    @foreach($nav as $item)
                        @continue(($item['desktop'] ?? true) === false)
                        <a href="{{ route($item['route']) }}" class="transition pb-1 nav-link-item {{ request()->routeIs($item['match']) ? 'nav-link-active font-bold' : '' }}">{{ $item['label'] }}</a>
                        @if($item['route'] === 'map.index')
                            <a href="{{ route('map.index') }}#aiPlanner" class="transition nav-ai-btn flex items-center gap-1.5 px-3 py-1.5 rounded-xl border text-xs sm:text-sm font-bold">
                                <i class="fa-solid fa-wand-magic-sparkles text-[#38BDF8]"></i>
                                <span>مخطط الرحلات (AI)</span>
                            </a>
                        @endif
                    @endforeach
                </nav>

                <!-- Actions -->
                <div class="flex items-center gap-2 sm:gap-4">
                    @auth
                        <div class="relative group hidden sm:block">
                            <a href="{{ route('account.index') }}" class="nav-pill-btn flex items-center gap-2 px-3 py-1.5 rounded-full text-sm border transition">
                                <span class="w-7 h-7 rounded-full bg-gradient-to-br from-[#06B6D4] to-[#38BDF8] text-white font-bold flex items-center justify-center text-xs">{{ mb_substr(Auth::user()->name, 0, 1) }}</span>
                                <span class="max-w-[90px] truncate font-medium">{{ Auth::user()->name }}</span>
                                <i class="fa-solid fa-chevron-down text-xs opacity-75"></i>
                            </a>
                            <div class="absolute left-0 mt-2 w-52 bg-white rounded-2xl shadow-2xl shadow-[#164E63]/20 border border-[#06B6D4]/20 py-2 opacity-0 invisible translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 text-[#183746] text-sm z-50">
                                <a href="{{ route('account.index') }}" class="flex items-center gap-2 px-4 py-2.5 hover:bg-[#E0F2FE] transition"><i class="fa-solid fa-user text-[#06B6D4]"></i> حسابي</a>
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.index') }}" class="flex items-center gap-2 px-4 py-2.5 hover:bg-[#E0F2FE] text-[#164E63] font-bold transition"><i class="fa-solid fa-chart-line text-[#06B6D4]"></i> لوحة التحكم</a>
                                @endif
                                <form action="{{ route('logout') }}" method="POST" class="border-t border-[#06B6D4]/15 mt-1">
                                    @csrf
                                    <button type="submit" class="w-full text-right flex items-center gap-2 px-4 py-2.5 text-[#164E63] hover:bg-[#E0F2FE] transition"><i class="fa-solid fa-arrow-right-from-bracket text-[#06B6D4]"></i> تسجيل الخروج</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="nav-login-link hidden sm:inline-block text-sm font-semibold transition px-2">تسجيل الدخول</a>
                    @endauth

                    <a href="{{ route('booking.create') }}" class="mg-btn hidden sm:inline-flex !py-2 !px-4 sm:!py-2.5 sm:!px-5 !text-xs sm:!text-sm shrink-0">
                        <span>ابدأ رحلتك</span>
                        <i class="fa-solid fa-arrow-left text-xs"></i>
                    </a>

                    <button type="button" id="mobileMenuBtn" class="nav-hamburger-btn lg:hidden w-11 h-11 rounded-xl flex items-center justify-center transition border" aria-label="فتح القائمة الرئيسية">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- ================= MOBILE DRAWER (NATIVE APP SHEET) ================= -->
    <div id="mobileDrawerOverlay" class="fixed inset-0 bg-[#072430]/75 backdrop-blur-md z-50 transition-opacity duration-300 opacity-0 pointer-events-none lg:hidden"></div>

    <div id="mobileDrawer" class="fixed top-0 right-0 bottom-0 w-84 max-w-[88vw] bg-white z-50 shadow-2xl rounded-l-[2rem] flex flex-col justify-between transition-transform duration-300 ease-in-out transform translate-x-full lg:hidden border-l border-[#06B6D4]/30 overflow-hidden">
        
        <!-- Header & Profile Card -->
        <div class="p-5 border-b border-[#06B6D4]/15 bg-gradient-to-br from-[#E0F2FE] via-white to-[#F0F9FF]">
            <div class="flex items-center justify-between mb-4">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <img src="/images/matal_official_logo.png" alt="مَطَلّ MATAL" class="h-10 w-auto">
                    <span class="text-xs font-black text-[#164E63] tracking-wider font-heading">مَطَلّ جازان</span>
                </a>
                <button type="button" id="mobileDrawerCloseBtn" class="w-9 h-9 rounded-xl bg-white/90 text-[#164E63] hover:bg-[#E0F2FE] hover:text-[#0891B2] flex items-center justify-center transition shadow-sm border border-[#06B6D4]/20 active:scale-95" aria-label="إغلاق القائمة">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>

            @auth
                <!-- Authenticated User Card -->
                <div class="p-3.5 rounded-2xl bg-white/90 border border-[#06B6D4]/25 shadow-sm flex items-center gap-3">
                    <span class="w-11 h-11 shrink-0 rounded-full bg-gradient-to-br from-[#06B6D4] to-[#38BDF8] text-white font-black flex items-center justify-center text-sm shadow-md shadow-[#06B6D4]/30 ring-2 ring-white">
                        {{ mb_substr(Auth::user()->name, 0, 1) }}
                    </span>
                    <div class="min-w-0 flex-1 text-right">
                        <div class="flex items-center justify-between">
                            <span class="font-black text-sm text-[#164E63] truncate">{{ Auth::user()->name }}</span>
                            @if(Auth::user()->role === 'admin')
                                <span class="text-[10px] font-black px-2 py-0.5 rounded-full bg-cyan-500/15 text-cyan-700 border border-cyan-500/25">إدارة</span>
                            @else
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-500/15 text-emerald-700">سائح</span>
                            @endif
                        </div>
                        <span class="text-[11px] text-[#164E63]/60 truncate block">{{ Auth::user()->email }}</span>
                    </div>
                </div>
            @else
                <!-- Guest Welcome Card -->
                <div class="p-3.5 rounded-2xl bg-white/90 border border-[#06B6D4]/20 shadow-sm text-right">
                    <p class="text-xs font-black text-[#164E63] mb-1">مرحباً بك في منصة مَطَلّ</p>
                    <p class="text-[11px] text-[#183746]/70 leading-relaxed mb-3">سجّل دخولك لحفظ مساراتك وحجز تجاربك السياحية الذكية.</p>
                    <div class="grid grid-cols-2 gap-2">
                        <a href="{{ route('login') }}" class="py-2 px-3 rounded-xl bg-gradient-to-r from-[#164E63] to-[#0e3b4d] text-white font-bold text-center text-xs shadow-sm active:scale-95 transition">تسجيل الدخول</a>
                        <a href="{{ route('auth.demo', 'tourist') }}" class="py-2 px-3 rounded-xl bg-[#06B6D4]/15 border border-[#06B6D4]/35 text-[#0891B2] font-black text-center text-xs flex items-center justify-center gap-1 active:scale-95 transition">
                            <i class="fa-solid fa-bolt text-[#06B6D4]"></i> تجربة سريعة
                        </a>
                    </div>
                </div>
            @endauth
        </div>

        <!-- Navigation Links (App Menu Style) -->
        <div class="flex-grow overflow-y-auto p-4 space-y-1.5 text-sm font-semibold">
            <span class="block text-[11px] font-extrabold uppercase tracking-wider text-[#0891B2] px-2 mb-2">الأقسام والاستكشاف</span>
            
            @foreach($nav as $item)
                @php $active = request()->routeIs($item['match']); @endphp
                <a href="{{ route($item['route']) }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl transition-all duration-200 active:scale-98 {{ $active ? 'bg-gradient-to-r from-[#164E63] to-[#0e3b4d] text-white font-bold shadow-md shadow-[#164E63]/25' : 'text-[#183746] hover:bg-[#E0F2FE]/70' }}">
                    <div class="flex items-center gap-3">
                        <span class="w-8 h-8 rounded-xl flex items-center justify-center text-xs {{ $active ? 'bg-white/15 text-[#38BDF8]' : 'bg-[#E0F2FE] text-[#06B6D4]' }}">
                            <i class="fa-solid {{ $item['icon'] }}"></i>
                        </span>
                        <span>{{ $item['full'] }}</span>
                    </div>
                    <i class="fa-solid fa-chevron-left text-[10px] {{ $active ? 'text-[#38BDF8]' : 'opacity-30' }}"></i>
                </a>
                @if($item['route'] === 'map.index')
                    <a href="{{ route('map.index') }}#aiPlanner" class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-[#0891B2] bg-[#06B6D4]/10 hover:bg-[#06B6D4]/20 border border-[#06B6D4]/25 transition font-bold active:scale-98">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-xl bg-gradient-to-br from-[#06B6D4] to-[#38BDF8] text-white flex items-center justify-center text-xs shadow-sm">
                                <i class="fa-solid fa-wand-magic-sparkles"></i>
                            </span>
                            <span>مخطط الرحلات بالذكاء الاصطناعي</span>
                        </div>
                        <span class="px-2 py-0.5 rounded-full bg-[#06B6D4] text-white text-[9px] font-black">جديد</span>
                    </a>
                @endif
            @endforeach

            @auth
                <div class="pt-3 border-t border-[#06B6D4]/15 mt-3">
                    <span class="block text-[11px] font-extrabold uppercase tracking-wider text-[#0891B2] px-2 mb-2">إدارة الحساب</span>
                    <a href="{{ route('account.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-[#164E63] hover:bg-[#E0F2FE]/70 transition font-bold">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-xl bg-[#E0F2FE] text-[#06B6D4] flex items-center justify-center text-xs"><i class="fa-solid fa-user"></i></span>
                            <span>لوحة حسابي والحجوزات</span>
                        </div>
                        <i class="fa-solid fa-chevron-left text-[10px] opacity-30"></i>
                    </a>
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-[#164E63] hover:bg-[#E0F2FE]/70 transition font-black">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-xl bg-cyan-500/20 text-cyan-700 flex items-center justify-center text-xs"><i class="fa-solid fa-chart-line"></i></span>
                                <span>لوحة القيادة والتحليلات</span>
                            </div>
                            <i class="fa-solid fa-chevron-left text-[10px] opacity-30"></i>
                        </a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="mt-1">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-rose-600 hover:bg-rose-50 transition text-right font-bold text-xs">
                            <span class="w-8 h-8 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center text-xs"><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
                            <span>تسجيل الخروج</span>
                        </button>
                    </form>
                </div>
            @endauth
        </div>

        <!-- Quick Action & Footer -->
        <div class="p-4 border-t border-[#06B6D4]/15 space-y-2.5 bg-gradient-to-t from-[#E0F2FE]/60 to-white pb-[max(1rem,env(safe-area-inset-bottom))]">
            <a href="{{ route('booking.create') }}" class="mg-btn w-full !py-3 !text-sm shadow-lg shadow-[#06B6D4]/25">
                <span>ابدأ رحلتك الآن</span><i class="fa-solid fa-arrow-left text-xs"></i>
            </a>
            <div class="pt-2 flex items-center justify-between text-[11px] text-[#164E63]/60 px-1 font-bold">
                <span>منصة مَطَلّ للسياحة</span>
                <span class="text-[#0891B2]">الإصدار 2.4 · 2026</span>
            </div>
        </div>
    </div>
    @endunless

    <!-- ================= TOASTS ================= -->
    @if(count($toasts))
        <div id="mgToasts" class="fixed top-24 inset-x-4 z-[60] flex flex-col items-center gap-3 pointer-events-none">
            @foreach($toasts as $t)
                <div class="mg-toast pointer-events-auto flex items-center gap-3 px-5 py-3.5 rounded-2xl text-white text-sm font-bold shadow-2xl bg-gradient-to-r {{ $t['cls'] }} border border-white/20">
                    <i class="fa-solid {{ $t['icon'] }} text-base"></i>
                    <span>{{ $t['msg'] }}</span>
                    <button type="button" data-close-toast class="mr-2 opacity-70 hover:opacity-100 transition" aria-label="إغلاق"><i class="fa-solid fa-xmark"></i></button>
                </div>
            @endforeach
        </div>
    @endif

    <!-- ================= PAGE CONTENT ================= -->
    <main class="flex-grow pb-20 lg:pb-0">
        @yield('content')
    </main>

    @unless(View::hasSection('hide_navbar') || request()->routeIs('login*'))
    <!-- ================= FOOTER ================= -->
    <footer class="relative bg-cover bg-center overflow-hidden text-white" style="background-image: url('/images/sunset_marine.jpg');">
        <div class="absolute inset-0 bg-gradient-to-b from-[#164E63]/92 via-[#0e3b4d]/94 to-[#072430]/98"></div>
        <div class="mg-orb mg-orb-cyan w-96 h-96 -top-24 right-1/4" data-speed="0.06"></div>
        <div class="mg-orb mg-orb-sky w-96 h-96 -bottom-24 left-1/4" data-speed="0.05"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-8">

            <!-- CTA strip -->
            <div class="mg-card mg-card-glass mg-reveal mg-reveal-scale p-6 sm:p-9 mb-14 flex flex-col lg:flex-row items-center justify-between gap-6 text-center lg:text-right" data-tilt-max="3">
                <div>
                    <h3 class="text-xl sm:text-2xl font-black font-heading">جاهز لاكتشاف جازان من أعاليها إلى سواحلها؟</h3>
                    <p class="mt-2 text-sm text-sky-100/80">خطّط رحلتك في ثوانٍ مع مخطط الرحلات الذكي، أو احجز مسارك المفضل الآن.</p>
                </div>
                <div class="flex flex-wrap items-center justify-center gap-3 shrink-0">
                    <a href="{{ route('booking.create') }}" class="mg-btn" data-magnetic><span>ابدأ رحلتك</span><i class="fa-solid fa-arrow-left text-xs"></i></a>
                    <a href="{{ route('map.index') }}#aiPlanner" class="mg-btn-ghost"><i class="fa-solid fa-wand-magic-sparkles"></i><span>مخطط الرحلات (AI)</span></a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12" data-stagger="0.1">
                <!-- Brand -->
                <div class="space-y-4 mg-reveal">
                    <img src="/images/matal_logo_white_text.png" alt="مَطَلّ MATAL" class="h-16 sm:h-20 w-auto drop-shadow-md">
                    <p class="text-sky-100/80 text-sm leading-relaxed">منصة رقمية لاكتشاف جازان من أعاليها إلى سواحلها. نجمع المسارات السياحية والتجارب الثقافية الأصيلة في تجربة فريدة تلهمك في كل خطوة.</p>
                    <div class="pt-2 flex items-center gap-3 text-sky-200 text-lg">
                        @foreach([['https://twitter.com/matal_jazan','fa-x-twitter','X / Twitter'],['https://instagram.com/matal_jazan','fa-instagram','Instagram'],['https://tiktok.com/@matal_jazan','fa-tiktok','TikTok'],['https://youtube.com/@matal_jazan','fa-youtube','YouTube']] as $s)
                            <a href="{{ $s[0] }}" target="_blank" rel="noopener" aria-label="{{ $s[2] }}" class="w-10 h-10 rounded-full bg-white/10 border border-white/10 hover:bg-gradient-to-br hover:from-[#06B6D4] hover:to-[#38BDF8] hover:text-white hover:-translate-y-1 hover:shadow-lg hover:shadow-cyan-500/40 flex items-center justify-center transition-all duration-300">
                                <i class="fa-brands {{ $s[1] }}"></i>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Routes -->
                <div class="mg-reveal">
                    <h3 class="text-base font-bold text-[#38BDF8] mb-5 flex items-center gap-2 font-heading"><i class="fa-solid fa-route text-[#06B6D4]"></i> المسارات السياحية</h3>
                    <ul class="space-y-3 text-sm text-sky-100/85">
                        @foreach($footRoutes as $r)
                            <li><a href="{{ route('routes.show', $r[0]) }}" class="group hover:text-[#38BDF8] hover:-translate-x-1 transition-all duration-300 flex items-center gap-2"><i class="fa-solid fa-chevron-left text-[10px] text-[#06B6D4] group-hover:translate-x-[-3px] transition"></i> {{ $r[1] }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <!-- Explore -->
                <div class="mg-reveal">
                    <h3 class="text-base font-bold text-[#38BDF8] mb-5 flex items-center gap-2 font-heading"><i class="fa-solid fa-compass text-[#06B6D4]"></i> استكشف جازان</h3>
                    <ul class="space-y-3 text-sm text-sky-100/85">
                        @foreach($footLinks as $l)
                            <li><a href="{{ $l[0] }}" class="group hover:text-[#38BDF8] hover:-translate-x-1 transition-all duration-300 flex items-center gap-2"><i class="fa-solid fa-chevron-left text-[10px] text-[#06B6D4]"></i> {{ $l[1] }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <!-- App -->
                <div class="mg-reveal">
                    <h3 class="text-base font-bold text-[#38BDF8] mb-5 flex items-center gap-2 font-heading"><i class="fa-solid fa-mobile-screen text-[#06B6D4]"></i> تطبيق الجوال</h3>
                    <p class="text-sky-100/80 text-sm leading-relaxed mb-4">حمّل تطبيق مَطَلّ واستمتع بالإرشاد الصوتي ثلاثي الأبعاد والواقع المعزز في كل مسار.</p>
                    <div class="flex flex-col gap-3">
                        <a href="#" class="group flex items-center gap-3 px-4 py-3 rounded-2xl bg-white/10 hover:bg-white/20 border border-white/15 hover:border-[#38BDF8]/60 hover:-translate-y-1 transition-all duration-300">
                            <i class="fa-brands fa-apple text-2xl group-hover:scale-110 transition text-sky-200"></i>
                            <div class="text-right"><div class="text-[10px] text-sky-200/70">تحميل من</div><div class="text-xs font-bold text-white">App Store</div></div>
                        </a>
                        <a href="#" class="group flex items-center gap-3 px-4 py-3 rounded-2xl bg-white/10 hover:bg-white/20 border border-white/15 hover:border-[#38BDF8]/60 hover:-translate-y-1 transition-all duration-300">
                            <i class="fa-brands fa-google-play text-xl group-hover:scale-110 transition text-sky-200"></i>
                            <div class="text-right"><div class="text-[10px] text-sky-200/70">متاح على</div><div class="text-xs font-bold text-white">Google Play</div></div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="pt-8 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between text-xs text-sky-200/70 gap-4">
                <p>جميع الحقوق محفوظة © {{ date('Y') }} لمنصة <span class="text-[#38BDF8] font-bold">مَطَلّ (MATAL)</span> · المملكة العربية السعودية</p>
                <div class="flex items-center gap-6">
                    <span class="hidden md:inline">اكتشف جازان بطريقتك... كل رحلة استثنائية مع مَطَلّ</span>
                    <a href="{{ route('about') }}" class="hover:text-[#38BDF8] transition">الشروط والأحكام</a>
                    <a href="{{ route('about') }}" class="hover:text-[#38BDF8] transition">سياسة الخصوصية</a>
                </div>
            </div>
        </div>
    </footer>
    @endunless

    <!-- Back to top -->
    <button type="button" id="backToTopBtn" class="fixed bottom-20 left-4 sm:bottom-24 sm:left-6 lg:bottom-6 lg:left-6 z-40 w-12 h-12 rounded-2xl bg-gradient-to-br from-[#164E63] to-[#0e3b4d] text-[#38BDF8] border border-[#38BDF8]/40 shadow-xl shadow-[#072430]/40 flex items-center justify-center text-base opacity-0 translate-y-6 pointer-events-none transition-all duration-300 hover:scale-110 hover:border-[#38BDF8] hover:text-white cursor-pointer" aria-label="العودة لأعلى الصفحة">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    @unless(View::hasSection('hide_navbar') || request()->routeIs('login*') || request()->routeIs('admin*'))
    <!-- ================= NATIVE MOBILE BOTTOM APP BAR (DOCK) ================= -->
    <nav id="mobileBottomNav" class="fixed bottom-0 inset-x-0 z-40 lg:hidden bg-white/95 backdrop-blur-xl border-t border-[#06B6D4]/25 shadow-[0_-8px_25px_rgba(7,36,48,0.08)] pb-[max(0.25rem,env(safe-area-inset-bottom))] transition-all duration-300">
        <div class="grid grid-cols-5 h-16 items-center px-1 max-w-md mx-auto relative">

            <!-- Tab 1: Home -->
            <a href="{{ route('home') }}" class="flex flex-col items-center justify-center gap-1 py-1 text-center transition-all duration-200 active:scale-90 {{ request()->routeIs('home') ? 'text-[#0891B2] font-black' : 'text-[#183746]/65 hover:text-[#0891B2]' }}">
                <span class="relative flex items-center justify-center w-6 h-6">
                    <i class="fa-solid fa-house text-lg"></i>
                    @if(request()->routeIs('home'))
                        <span class="absolute -bottom-1 w-1.5 h-1.5 rounded-full bg-[#06B6D4]"></span>
                    @endif
                </span>
                <span class="text-[10px] tracking-tight">الرئيسية</span>
            </a>

            <!-- Tab 2: Routes -->
            <a href="{{ route('routes.index') }}" class="flex flex-col items-center justify-center gap-1 py-1 text-center transition-all duration-200 active:scale-90 {{ request()->routeIs('routes.*') ? 'text-[#0891B2] font-black' : 'text-[#183746]/65 hover:text-[#0891B2]' }}">
                <span class="relative flex items-center justify-center w-6 h-6">
                    <i class="fa-solid fa-route text-lg"></i>
                    @if(request()->routeIs('routes.*'))
                        <span class="absolute -bottom-1 w-1.5 h-1.5 rounded-full bg-[#06B6D4]"></span>
                    @endif
                </span>
                <span class="text-[10px] tracking-tight">المسارات</span>
            </a>

            <!-- Tab 3: Center Elevated Action (Smart Map & AI Planner) -->
            <div class="flex flex-col items-center justify-center relative -top-3">
                <a href="{{ route('map.index') }}" class="relative group flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-tr from-[#164E63] via-[#0891B2] to-[#06B6D4] text-white shadow-lg shadow-cyan-500/40 border-[3px] border-white transition-all duration-300 active:scale-90 ring-2 ring-[#06B6D4]/30">
                    <i class="fa-solid fa-wand-magic-sparkles text-lg animate-pulse"></i>
                </a>
                <span class="text-[9px] font-black text-[#164E63] mt-0.5">الخريطة والـ AI</span>
            </div>

            <!-- Tab 4: Destinations -->
            <a href="{{ route('destinations.index') }}" class="flex flex-col items-center justify-center gap-1 py-1 text-center transition-all duration-200 active:scale-90 {{ request()->routeIs('destinations.*') ? 'text-[#0891B2] font-black' : 'text-[#183746]/65 hover:text-[#0891B2]' }}">
                <span class="relative flex items-center justify-center w-6 h-6">
                    <i class="fa-solid fa-mountain-sun text-lg"></i>
                    @if(request()->routeIs('destinations.*'))
                        <span class="absolute -bottom-1 w-1.5 h-1.5 rounded-full bg-[#06B6D4]"></span>
                    @endif
                </span>
                <span class="text-[10px] tracking-tight">الوجهات</span>
            </a>

            <!-- Tab 5: Profile / Login -->
            @auth
                <a href="{{ route('account.index') }}" class="flex flex-col items-center justify-center gap-1 py-1 text-center transition-all duration-200 active:scale-90 {{ request()->routeIs('account.*') ? 'text-[#0891B2] font-black' : 'text-[#183746]/65 hover:text-[#0891B2]' }}">
                    <span class="relative flex items-center justify-center w-6 h-6">
                        <span class="w-5 h-5 rounded-full bg-gradient-to-br from-[#06B6D4] to-[#38BDF8] text-white font-bold flex items-center justify-center text-[9px]">{{ mb_substr(Auth::user()->name, 0, 1) }}</span>
                        @if(request()->routeIs('account.*'))
                            <span class="absolute -bottom-1 w-1.5 h-1.5 rounded-full bg-[#06B6D4]"></span>
                        @endif
                    </span>
                    <span class="text-[10px] tracking-tight">حسابي</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="flex flex-col items-center justify-center gap-1 py-1 text-center transition-all duration-200 active:scale-90 {{ request()->routeIs('login*') ? 'text-[#0891B2] font-black' : 'text-[#183746]/65 hover:text-[#0891B2]' }}">
                    <span class="relative flex items-center justify-center w-6 h-6">
                        <i class="fa-regular fa-user text-lg"></i>
                    </span>
                    <span class="text-[10px] tracking-tight">دخول</span>
                </a>
            @endauth

        </div>
    </nav>
    @endunless

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- Navbar scroll, mobile drawer, toasts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const mainHeader = document.getElementById('mainHeader');
            function handleNavbarScroll() {
                if (!mainHeader) return;
                const scrolled = window.scrollY > 25;
                mainHeader.classList.toggle('nav-scrolled', scrolled);
                mainHeader.classList.toggle('nav-transparent', !scrolled);
            }
            window.addEventListener('scroll', handleNavbarScroll, { passive: true });
            handleNavbarScroll();

            const btn = document.getElementById('mobileMenuBtn');
            const closeBtn = document.getElementById('mobileDrawerCloseBtn');
            const drawer = document.getElementById('mobileDrawer');
            const overlay = document.getElementById('mobileDrawerOverlay');

            function openDrawer() {
                if (!drawer || !overlay) return;
                overlay.classList.remove('opacity-0', 'pointer-events-none');
                overlay.classList.add('opacity-100');
                drawer.classList.remove('translate-x-full');
                drawer.classList.add('translate-x-0');
                document.body.style.overflow = 'hidden';
            }
            function closeDrawer() {
                if (!drawer || !overlay) return;
                overlay.classList.remove('opacity-100');
                overlay.classList.add('opacity-0', 'pointer-events-none');
                drawer.classList.remove('translate-x-0');
                drawer.classList.add('translate-x-full');
                document.body.style.overflow = '';
            }
            if (btn) btn.addEventListener('click', openDrawer);
            if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
            if (overlay) overlay.addEventListener('click', closeDrawer);
            document.addEventListener('keydown', e => { if (e.key === 'Escape') closeDrawer(); });
            if (drawer) drawer.querySelectorAll('a').forEach(a => a.addEventListener('click', closeDrawer));

            // Toasts: auto-dismiss + manual close
            const dismiss = el => { el.classList.add('is-leaving'); setTimeout(() => el.remove(), 500); };
            document.querySelectorAll('.mg-toast').forEach((t, i) => {
                setTimeout(() => dismiss(t), 6500 + i * 600);
                const c = t.querySelector('[data-close-toast]');
                if (c) c.addEventListener('click', () => dismiss(t));
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
