<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'مَطَلّ · المنصة السياحية الرائدة لاكتشاف جازان من أعاليها إلى سواحلها')</title>
    <meta name="description" content="@yield('meta_description', 'الدليل الذكي والمنصة السياحية الأولى لاكتشاف جازان من خلال المسارات والتجارب المحلية الأصيلة')">

    <!-- Google Fonts: Allura, Amiri, Dancing Script, Readex Pro, Tajawal -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Allura&family=Amiri:ital,wght@0,400;0,700;1,400;1,700&family=Dancing+Script:wght@400..700&family=Readex+Pro:wght@400;500;600;700;800;900&family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/favicon-192x192.png">
    <link rel="icon" type="image/png" href="/favicon.png">
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/favicon-192x192.png">

    <!-- Font Awesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Leaflet CSS for Interactive Maps -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

    <!-- Compiled Assets via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="bg-[#F8FCFD] text-[#183746] antialiased selection:bg-[#06B6D4] selection:text-white flex flex-col min-h-screen">

    <!-- Top Reading / Scroll Progress Bar -->
    <div id="scrollProgressBar" class="fixed top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#2EC4C9] via-[#F2B84B] to-[#FF7A59] z-50 transform origin-right scale-x-0 transition-transform duration-75 pointer-events-none"></div>

    <!-- Main Navigation Header (Fixed: Starts Transparent, Transitions to Solid on Scroll) -->
    @unless(View::hasSection('hide_navbar') || request()->routeIs('login*'))
    <header id="mainHeader" class="fixed top-0 inset-x-0 z-40 transition-all duration-300 nav-transparent">
        
        <!-- Top Announcement Bar (Vision 2030 & Authentic Jazan Tourism) -->
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
                    <a href="{{ route('auth.demo', 'tourist') }}" class="announcement-link transition flex items-center gap-1 font-semibold">
                        <i class="fa-solid fa-bolt text-amber-400"></i> دخول تجريبي سريع
                    </a>
                    <span class="announcement-divider opacity-40">·</span>
                    <span class="announcement-brand font-bold">www.matal.sa</span>
                </div>
            </div>
        </div>

        <!-- Main Navigation Bar -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">
                
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group shrink-0">
                    <img src="/images/matal_logo_white_text.png" alt="مَطَلّ MATAL" class="nav-logo-white h-12 sm:h-14 w-auto transform transition duration-300 group-hover:scale-105">
                    <img src="/images/matal_official_logo.png" alt="مَطَلّ MATAL" class="nav-logo-dark h-12 sm:h-14 w-auto transform transition duration-300 group-hover:scale-105">
                </a>

                <!-- Desktop Nav Links -->
                <nav class="hidden lg:flex items-center gap-6 xl:gap-7 text-sm font-semibold">
                    <a href="{{ route('home') }}" class="transition pb-1 nav-link-item {{ request()->routeIs('home') ? 'nav-link-active font-bold' : '' }}">
                        الرئيسية
                    </a>
                    <a href="{{ route('routes.index') }}" class="transition pb-1 nav-link-item {{ request()->routeIs('routes.*') ? 'nav-link-active font-bold' : '' }}">
                        المسارات
                    </a>
                    <a href="{{ route('destinations.index') }}" class="transition pb-1 nav-link-item {{ request()->routeIs('destinations.*') ? 'nav-link-active font-bold' : '' }}">
                        الوجهات
                    </a>
                    <a href="{{ route('map.index') }}" class="transition pb-1 nav-link-item {{ request()->routeIs('map.*') ? 'nav-link-active font-bold' : '' }}">
                        الخريطة الذكية
                    </a>
                    <a href="{{ route('map.index') }}#aiPlanner" class="transition nav-ai-btn flex items-center gap-1.5 px-3 py-1.5 rounded-xl border text-xs sm:text-sm font-bold">
                        <i class="fa-solid fa-wand-magic-sparkles text-cyan-400"></i>
                        <span>مخطط الرحلات (AI)</span>
                    </a>
                    <a href="{{ route('events.index') }}" class="transition pb-1 nav-link-item {{ request()->routeIs('events.*') ? 'nav-link-active font-bold' : '' }}">
                        الفعاليات
                    </a>
                    <a href="{{ route('about') }}" class="transition pb-1 nav-link-item {{ request()->routeIs('about') ? 'nav-link-active font-bold' : '' }}">
                        من نحن
                    </a>
                </nav>

                <!-- Action CTA & User Links -->
                <div class="flex items-center gap-2 sm:gap-4">
                    <span class="nav-pill-btn hidden sm:inline-block text-xs font-bold px-2.5 py-1 rounded-lg border cursor-pointer transition">
                        EN
                    </span>

                    @auth
                        <div class="relative group hidden sm:block">
                            <a href="{{ route('account.index') }}" class="nav-pill-btn flex items-center gap-2 px-3 py-1.5 rounded-full text-sm border transition">
                                <span class="w-7 h-7 rounded-full bg-cyan-500 text-white font-bold flex items-center justify-center text-xs shadow-xs">
                                    {{ mb_substr(Auth::user()->name, 0, 1) }}
                                </span>
                                <span class="max-w-[90px] truncate font-medium">{{ Auth::user()->name }}</span>
                                <i class="fa-solid fa-chevron-down text-xs opacity-75"></i>
                            </a>
                            <!-- Dropdown -->
                            <div class="absolute left-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-sky-100 py-2 hidden group-hover:block text-[#183746] text-sm z-50">
                                <a href="{{ route('account.index') }}" class="flex items-center gap-2 px-4 py-2 hover:bg-sky-50 transition">
                                    <i class="fa-solid fa-user text-cyan-600"></i> حسابي
                                </a>
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.index') }}" class="flex items-center gap-2 px-4 py-2 hover:bg-sky-50 text-emerald-700 font-bold transition">
                                        <i class="fa-solid fa-chart-line"></i> لوحة التحكم
                                    </a>
                                @endif
                                <form action="{{ route('logout') }}" method="POST" class="border-t border-sky-100 mt-1">
                                    @csrf
                                    <button type="submit" class="w-full text-right flex items-center gap-2 px-4 py-2 text-rose-600 hover:bg-rose-50 transition">
                                        <i class="fa-solid fa-arrow-right-from-bracket"></i> تسجيل الخروج
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="nav-login-link hidden sm:inline-block text-sm font-semibold transition px-2">
                            تسجيل الدخول
                        </a>
                    @endauth

                    <a href="{{ route('booking.create') }}" class="hidden sm:inline-flex px-4 sm:px-5 py-2 sm:py-2.5 rounded-xl bg-gradient-to-r from-[#06B6D4] to-[#38BDF8] hover:from-[#0891B2] hover:to-[#0284C7] text-white font-bold text-xs sm:text-sm shadow-md shadow-cyan-500/25 hover:shadow-cyan-500/40 transition transform hover:-translate-y-0.5 items-center gap-2">
                        <span>ابدأ رحلتك</span>
                        <i class="fa-solid fa-arrow-left text-xs"></i>
                    </a>

                    <!-- Mobile menu button (Prominent Hamburger with Touch Target) -->
                    <button type="button" id="mobileMenuBtn" class="nav-hamburger-btn lg:hidden w-11 h-11 rounded-xl flex items-center justify-center transition border" aria-label="فتح القائمة الرئيسية">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Professional Off-Canvas Mobile Navigation Drawer -->
    <div id="mobileDrawerOverlay" class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-50 transition-opacity duration-300 opacity-0 pointer-events-none lg:hidden"></div>

    <div id="mobileDrawer" class="fixed top-0 right-0 bottom-0 w-80 max-w-[85vw] bg-white z-50 shadow-2xl flex flex-col justify-between transition-transform duration-300 ease-in-out transform translate-x-full lg:hidden border-l border-sky-100">
        <!-- Drawer Header -->
        <div class="p-5 border-b border-sky-100 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <img src="/images/matal_official_logo.png" alt="مَطَلّ MATAL" class="h-11 w-auto">
            </a>
            <button type="button" id="mobileDrawerCloseBtn" class="w-10 h-10 rounded-xl bg-sky-50 text-[#164E63] hover:bg-sky-100 flex items-center justify-center transition" aria-label="إغلاق القائمة">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <!-- Drawer Links (Scrollable with generous touch targets) -->
        <div class="flex-grow overflow-y-auto p-4 space-y-1 text-sm font-semibold">
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('home') ? 'bg-cyan-50 text-[#06B6D4] font-bold' : 'text-[#183746] hover:bg-sky-50' }}">
                <i class="fa-solid fa-house w-5 text-center text-[#06B6D4]"></i>
                <span>الرئيسية</span>
            </a>
            <a href="{{ route('routes.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('routes.*') ? 'bg-cyan-50 text-[#06B6D4] font-bold' : 'text-[#183746] hover:bg-sky-50' }}">
                <i class="fa-solid fa-route w-5 text-center text-[#06B6D4]"></i>
                <span>المسارات السياحية</span>
            </a>
            <a href="{{ route('destinations.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('destinations.*') ? 'bg-cyan-50 text-[#06B6D4] font-bold' : 'text-[#183746] hover:bg-sky-50' }}">
                <i class="fa-solid fa-mountain-sun w-5 text-center text-[#06B6D4]"></i>
                <span>الوجهات والمعالم</span>
            </a>
            <a href="{{ route('map.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('map.*') ? 'bg-cyan-50 text-[#06B6D4] font-bold' : 'text-[#183746] hover:bg-sky-50' }}">
                <i class="fa-solid fa-map-location-dot w-5 text-center text-[#06B6D4]"></i>
                <span>الخريطة الذكية</span>
            </a>
            <a href="{{ route('map.index') }}#aiPlanner" class="flex items-center gap-3 px-4 py-3 rounded-xl text-[#0891B2] hover:bg-cyan-50/70 transition">
                <i class="fa-solid fa-wand-magic-sparkles w-5 text-center text-cyan-600"></i>
                <span>مخطط الرحلات (AI)</span>
            </a>
            <a href="{{ route('events.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('events.*') ? 'bg-cyan-50 text-[#06B6D4] font-bold' : 'text-[#183746] hover:bg-sky-50' }}">
                <i class="fa-solid fa-calendar-star w-5 text-center text-[#06B6D4]"></i>
                <span>الفعاليات والمهرجانات</span>
            </a>
            <a href="{{ route('about') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('about') ? 'bg-cyan-50 text-[#06B6D4] font-bold' : 'text-[#183746] hover:bg-sky-50' }}">
                <i class="fa-solid fa-circle-info w-5 text-center text-[#06B6D4]"></i>
                <span>من نحن</span>
            </a>
            <a href="{{ route('contact') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('contact') ? 'bg-cyan-50 text-[#06B6D4] font-bold' : 'text-[#183746] hover:bg-sky-50' }}">
                <i class="fa-solid fa-envelope w-5 text-center text-[#06B6D4]"></i>
                <span>تواصل معنا</span>
            </a>
        </div>

        <!-- Drawer Bottom Actions -->
        <div class="p-4 border-t border-sky-100 space-y-2.5 bg-sky-50/40">
            <a href="{{ route('booking.create') }}" class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-[#06B6D4] to-[#38BDF8] text-white font-bold text-center flex items-center justify-center gap-2 shadow-md shadow-cyan-500/25">
                <span>ابدأ رحلتك الآن</span>
                <i class="fa-solid fa-arrow-left text-xs"></i>
            </a>
            @auth
                <a href="{{ route('account.index') }}" class="w-full py-2.5 px-4 rounded-xl bg-white border border-sky-200 text-[#164E63] font-bold text-center flex items-center justify-center gap-2">
                    <i class="fa-solid fa-user text-cyan-600"></i>
                    <span>لوحة حسابي ({{ Auth::user()->name }})</span>
                </a>
            @else
                <div class="grid grid-cols-2 gap-2">
                    <a href="{{ route('login') }}" class="py-2.5 px-3 rounded-xl bg-white border border-sky-200 text-[#164E63] font-semibold text-center text-xs">
                        تسجيل الدخول
                    </a>
                    <a href="{{ route('auth.demo', 'tourist') }}" class="py-2.5 px-3 rounded-xl bg-amber-500/10 border border-amber-300 text-amber-800 font-semibold text-center text-xs flex items-center justify-center gap-1">
                        <i class="fa-solid fa-bolt text-amber-500"></i> تجربة سريعة
                    </a>
                </div>
            @endauth
        </div>
    </div>
    @endunless

    <!-- Global Toast Notifications -->
    @if(session('success'))
        <div class="bg-emerald-600 text-white px-4 py-3 text-center text-sm font-semibold shadow-md flex items-center justify-center gap-2">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if(session('info'))
        <div class="bg-cyan-700 text-white px-4 py-3 text-center text-sm font-semibold shadow-md flex items-center justify-center gap-2">
            <i class="fa-solid fa-circle-info"></i>
            <span>{{ session('info') }}</span>
        </div>
    @endif
    @if(session('error') || $errors->any())
        <div class="bg-rose-600 text-white px-4 py-3 text-center text-sm font-semibold shadow-md flex items-center justify-center gap-2">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <span>{{ session('error') ?? $errors->first() }}</span>
        </div>
    @endif

    <!-- Main Page Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Premium Nature Image-Backed Footer -->
    <footer class="relative bg-cover bg-center overflow-hidden text-white" style="background-image: url('/images/sunset_marine.jpg');">
        <!-- Professional Blue/Turquoise Translucent Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-[#164E63]/92 via-[#0e3b4d]/94 to-[#072430]/98 backdrop-blur-[2px]"></div>
        
        <!-- Decorative Ambient Light Orbs -->
        <div class="absolute -top-24 right-1/4 w-96 h-96 bg-[#06B6D4]/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 left-1/4 w-96 h-96 bg-[#38BDF8]/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                
                <!-- Col 1: Brand & Slogan -->
                <div class="space-y-4">
                    <img src="/images/matal_logo_white_text.png" alt="مَطَلّ MATAL" class="h-16 sm:h-20 w-auto filter drop-shadow-md">
                    <p class="text-sky-100/80 text-sm leading-relaxed">
                        منصة رقمية لاكتشاف جازان من أعاليها إلى سواحلها. نجمع المسارات السياحية والتجارب الثقافية الأصيلة في تجربة فريدة تلهمك في كل خطوة.
                    </p>
                    <div class="pt-2 flex items-center gap-3 text-sky-300 text-lg">
                        <a href="https://twitter.com/matal_jazan" target="_blank" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#06B6D4] hover:text-white flex items-center justify-center transition" aria-label="X / Twitter">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>
                        <a href="https://instagram.com/matal_jazan" target="_blank" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#06B6D4] hover:text-white flex items-center justify-center transition" aria-label="Instagram">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="https://tiktok.com/@matal_jazan" target="_blank" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#06B6D4] hover:text-white flex items-center justify-center transition" aria-label="TikTok">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                        <a href="https://youtube.com/@matal_jazan" target="_blank" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#06B6D4] hover:text-white flex items-center justify-center transition" aria-label="YouTube">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Col 2: Tourist Routes Links -->
                <div>
                    <h3 class="text-base font-bold text-[#38BDF8] mb-4 flex items-center gap-2 font-heading">
                        <i class="fa-solid fa-route text-[#06B6D4]"></i> المسارات السياحية
                    </h3>
                    <ul class="space-y-2.5 text-sm text-sky-100/85">
                        <li><a href="{{ route('routes.show', 'mountains-viewpoints-route') }}" class="hover:text-[#38BDF8] transition flex items-center gap-1.5"><i class="fa-solid fa-chevron-left text-[10px] text-cyan-400"></i> مسار الجبال والمطلات</a></li>
                        <li><a href="{{ route('routes.show', 'saudi-coffee-route') }}" class="hover:text-[#38BDF8] transition flex items-center gap-1.5"><i class="fa-solid fa-chevron-left text-[10px] text-cyan-400"></i> مسار البن السعودي الخولاني</a></li>
                        <li><a href="{{ route('routes.show', 'heritage-and-culture-route') }}" class="hover:text-[#38BDF8] transition flex items-center gap-1.5"><i class="fa-solid fa-chevron-left text-[10px] text-cyan-400"></i> المسار التراثي والثقافي</a></li>
                        <li><a href="{{ route('routes.show', 'farasan-marine-route') }}" class="hover:text-[#38BDF8] transition flex items-center gap-1.5"><i class="fa-solid fa-chevron-left text-[10px] text-cyan-400"></i> المسار البحري وجزر فرسان</a></li>
                        <li><a href="{{ route('routes.show', 'wadi-lajab-adventure-route') }}" class="hover:text-[#38BDF8] transition flex items-center gap-1.5"><i class="fa-solid fa-chevron-left text-[10px] text-cyan-400"></i> مسار المغامرات · وادي لجب</a></li>
                        <li><a href="{{ route('routes.show', 'family-entertainment-route') }}" class="hover:text-[#38BDF8] transition flex items-center gap-1.5"><i class="fa-solid fa-chevron-left text-[10px] text-cyan-400"></i> المسار العائلي الترفيهي</a></li>
                    </ul>
                </div>

                <!-- Col 3: Quick Navigation -->
                <div>
                    <h3 class="text-base font-bold text-[#38BDF8] mb-4 flex items-center gap-2 font-heading">
                        <i class="fa-solid fa-compass text-[#06B6D4]"></i> استكشف جازان
                    </h3>
                    <ul class="space-y-2.5 text-sm text-sky-100/85">
                        <li><a href="{{ route('destinations.index') }}" class="hover:text-[#38BDF8] transition flex items-center gap-1.5"><i class="fa-solid fa-chevron-left text-[10px] text-cyan-400"></i> دليل الوجهات والمعالم</a></li>
                        <li><a href="{{ route('map.index') }}" class="hover:text-[#38BDF8] transition flex items-center gap-1.5"><i class="fa-solid fa-chevron-left text-[10px] text-cyan-400"></i> الخريطة السياحية التفاعلية</a></li>
                        <li><a href="{{ route('map.index') }}#aiPlanner" class="hover:text-[#38BDF8] transition flex items-center gap-1.5"><i class="fa-solid fa-chevron-left text-[10px] text-cyan-400"></i> مخطط الرحلات الذكي (AI)</a></li>
                        <li><a href="{{ route('events.index') }}" class="hover:text-[#38BDF8] transition flex items-center gap-1.5"><i class="fa-solid fa-chevron-left text-[10px] text-cyan-400"></i> الفعاليات والمهرجانات</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-[#38BDF8] transition flex items-center gap-1.5"><i class="fa-solid fa-chevron-left text-[10px] text-cyan-400"></i> عن منصة مَطَلّ</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-[#38BDF8] transition flex items-center gap-1.5"><i class="fa-solid fa-chevron-left text-[10px] text-cyan-400"></i> تواصل معنا والشراكات</a></li>
                    </ul>
                </div>

                <!-- Col 4: App Download & Contact Info -->
                <div>
                    <h3 class="text-base font-bold text-[#38BDF8] mb-4 flex items-center gap-2 font-heading">
                        <i class="fa-solid fa-mobile-screen text-[#06B6D4]"></i> تطبيق الجوال
                    </h3>
                    <p class="text-sky-100/80 text-sm leading-relaxed mb-4">
                        حمّل تطبيق مَطَلّ واستمتع بالإرشاد الصوتي ثلاثي الأبعاد والواقع المعزز في كل مسار.
                    </p>
                    <div class="flex flex-col gap-2.5">
                        <a href="#" class="flex items-center gap-3 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/15 transition group">
                            <i class="fa-brands fa-apple text-2xl group-hover:scale-110 transition text-sky-200"></i>
                            <div class="text-right">
                                <div class="text-[10px] text-sky-200/70">تحميل من</div>
                                <div class="text-xs font-bold text-white">App Store</div>
                            </div>
                        </a>
                        <a href="#" class="flex items-center gap-3 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/15 transition group">
                            <i class="fa-brands fa-google-play text-xl group-hover:scale-110 transition text-sky-200"></i>
                            <div class="text-right">
                                <div class="text-[10px] text-sky-200/70">متاح على</div>
                                <div class="text-xs font-bold text-white">Google Play</div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Bottom Copyright Bar -->
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

    <!-- Leaflet JS for Maps -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- Navbar Scroll & Mobile Drawer Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Dynamic Navbar Transition: Transparent at Top -> Solid on Scroll
            const mainHeader = document.getElementById('mainHeader');
            function handleNavbarScroll() {
                if (!mainHeader) return;
                if (window.scrollY > 25) {
                    mainHeader.classList.remove('nav-transparent');
                    mainHeader.classList.add('nav-scrolled');
                } else {
                    mainHeader.classList.add('nav-transparent');
                    mainHeader.classList.remove('nav-scrolled');
                }
            }
            window.addEventListener('scroll', handleNavbarScroll, { passive: true });
            handleNavbarScroll();

            // Mobile Drawer Toggle
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileDrawerCloseBtn = document.getElementById('mobileDrawerCloseBtn');
            const mobileDrawer = document.getElementById('mobileDrawer');
            const mobileDrawerOverlay = document.getElementById('mobileDrawerOverlay');

            function openDrawer() {
                if (!mobileDrawer || !mobileDrawerOverlay) return;
                mobileDrawerOverlay.classList.remove('opacity-0', 'pointer-events-none');
                mobileDrawerOverlay.classList.add('opacity-100');
                mobileDrawer.classList.remove('translate-x-full');
                mobileDrawer.classList.add('translate-x-0');
                document.body.style.overflow = 'hidden';
            }

            function closeDrawer() {
                if (!mobileDrawer || !mobileDrawerOverlay) return;
                mobileDrawerOverlay.classList.remove('opacity-100');
                mobileDrawerOverlay.classList.add('opacity-0', 'pointer-events-none');
                mobileDrawer.classList.remove('translate-x-0');
                mobileDrawer.classList.add('translate-x-full');
                document.body.style.overflow = '';
            }

            if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', openDrawer);
            if (mobileDrawerCloseBtn) mobileDrawerCloseBtn.addEventListener('click', closeDrawer);
            if (mobileDrawerOverlay) mobileDrawerOverlay.addEventListener('click', closeDrawer);

            // Close on escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeDrawer();
            });

            // Close on drawer link click
            if (mobileDrawer) {
                mobileDrawer.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', closeDrawer);
                });
            }
        });
    </script>

    <!-- Floating Back to Top Button -->
    <button type="button" id="backToTopBtn" class="fixed bottom-6 left-6 z-40 w-12 h-12 rounded-2xl bg-gradient-to-br from-[#0E7C86] to-[#071E2F] text-[#2EC4C9] border border-[#2EC4C9]/40 shadow-xl shadow-teal-950/30 flex items-center justify-center text-base opacity-0 translate-y-6 pointer-events-none transition-all duration-300 hover:scale-110 hover:border-[#2EC4C9] hover:text-white cursor-pointer" aria-label="العودة لأعلى الصفحة">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    @stack('scripts')
</body>
</html>