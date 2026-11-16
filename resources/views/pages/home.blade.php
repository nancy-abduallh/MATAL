@extends('layouts.app')

@section('title', 'مَطَلّ · المنصة السياحية الرائدة لاكتشاف جازان من أعاليها إلى سواحلها')

@section('content')

<!-- ========================================== -->
<!-- 1. HERO SECTION WITH IMAGE SLIDER & 3D CARDS -->
<!-- ========================================== -->
<section class="relative min-h-[90vh] lg:min-h-screen flex flex-col justify-between overflow-hidden text-white bg-[#0e3b4d]">
    
    <!-- Background Image Slider with Authentic Jazan Coastal & Mountain Visuals -->
    <div id="heroSlider" class="absolute inset-0 z-0">
        <!-- Slide 1: Coastal Beach & Turquoise Water -->
        <div class="hero-slide absolute inset-0 transition-all duration-1000 ease-in-out opacity-100 scale-100 bg-cover bg-center" style="background-image: url('/images/coastal_beach.jpg');">
            <div class="absolute inset-0 bg-gradient-to-r from-[#164E63]/95 via-[#0e3b4d]/85 to-[#06B6D4]/30"></div>
            <div class="absolute inset-0 bg-sky-950/20 backdrop-brightness-95"></div>
        </div>
        <!-- Slide 2: Farasan Islands Turquoise Sea -->
        <div class="hero-slide absolute inset-0 transition-all duration-1000 ease-in-out opacity-0 pointer-events-none scale-105 bg-cover bg-center" style="background-image: url('/images/farasan_islands.jpg');">
            <div class="absolute inset-0 bg-gradient-to-r from-[#164E63]/95 via-[#0e3b4d]/85 to-[#06B6D4]/30"></div>
            <div class="absolute inset-0 bg-sky-950/20 backdrop-brightness-95"></div>
        </div>
        <!-- Slide 3: Mountain Terraces & Cloud Viewpoints -->
        <div class="hero-slide absolute inset-0 transition-all duration-1000 ease-in-out opacity-0 pointer-events-none scale-105 bg-cover bg-center" style="background-image: url('/images/al_dharb_viewpoint.jpg');">
            <div class="absolute inset-0 bg-gradient-to-r from-[#164E63]/95 via-[#0e3b4d]/85 to-[#06B6D4]/30"></div>
            <div class="absolute inset-0 bg-sky-950/20 backdrop-brightness-95"></div>
        </div>
        <!-- Slide 4: Wadi Lajab Canyon & Waterways -->
        <div class="hero-slide absolute inset-0 transition-all duration-1000 ease-in-out opacity-0 pointer-events-none scale-105 bg-cover bg-center" style="background-image: url('/images/wadi_lajab.jpg');">
            <div class="absolute inset-0 bg-gradient-to-r from-[#164E63]/95 via-[#0e3b4d]/85 to-[#06B6D4]/30"></div>
            <div class="absolute inset-0 bg-sky-950/20 backdrop-brightness-95"></div>
        </div>
    </div>

    <!-- Decorative Soft Aqua Radial Highlights -->
    <div class="absolute -top-24 right-5 sm:right-10 w-72 sm:w-96 h-72 sm:h-96 bg-[#38BDF8]/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 left-5 sm:left-10 w-64 sm:w-80 h-64 sm:h-80 bg-[#06B6D4]/25 rounded-full blur-3xl pointer-events-none"></div>

    <!-- Hero Content Container (with Top Padding for Transparent Floating Navbar) -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 sm:pt-36 lg:pt-40 pb-12 sm:pb-20 w-full flex-grow flex items-center">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center w-full">
            
            <!-- Right Column: Slogan, Search & Actions -->
            <div class="lg:col-span-7 space-y-4 sm:space-y-6 text-right">
                
                <!-- Region Badge in Soft Aqua & White -->
                <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 rounded-full bg-white/15 backdrop-blur-md border border-white/25 text-xs sm:text-sm font-semibold text-sky-100 shadow-sm animate-pulse-turquoise">
                    <span class="w-2 h-2 rounded-full bg-[#38BDF8] animate-ping"></span>
                    <span>جازان · درة الساحل وجنان الجبال</span>
                </div>

                <!-- Main Slogan with Responsive Fluid Typography -->
                <h1 class="fluid-hero-title font-black text-white tracking-tight font-heading">
                    اكتشف جازان <br>
                    من <span class="text-[#38BDF8] relative inline-block">
                        أعاليها
                        <svg class="absolute -bottom-1.5 sm:-bottom-2 right-0 w-full text-[#38BDF8]/60 h-2.5 sm:h-3" viewBox="0 0 100 12" preserveAspectRatio="none">
                            <path d="M0,8 Q50,0 100,8" stroke="currentColor" stroke-width="4" fill="none" />
                        </svg>
                    </span> إلى سواحلها
                </h1>

                <!-- Subtitle from PDF -->
                <p class="text-sm sm:text-base lg:text-lg text-sky-100/90 max-w-2xl leading-relaxed font-normal">
                    منصة رقمية تجمع المسارات السياحية والتجارب المحلية الأصيلة في رحلة متكاملة: اكتشف الطبيعة.. عش التجربة.
                </p>

                <!-- Search Bar with Mobile-First Responsive Layout -->
                <form action="{{ route('destinations.index') }}" method="GET" class="relative max-w-xl pt-1 sm:pt-2">
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center bg-white/20 backdrop-blur-xl rounded-2xl p-1.5 sm:p-2 border border-white/35 shadow-2xl focus-within:border-[#38BDF8] focus-within:bg-white/25 gap-2 sm:gap-0 transition">
                        <div class="flex items-center flex-grow">
                            <div class="p-2.5 sm:p-3 text-sky-200">
                                <i class="fa-solid fa-magnifying-glass text-base sm:text-lg"></i>
                            </div>
                            <input type="text" name="q" placeholder="ابحث عن وجهة، شاطئ، مزرعة بن، أو مسار..." class="w-full bg-transparent text-white placeholder-sky-100/70 focus:outline-none text-xs sm:text-sm px-1 py-1">
                        </div>
                        <button type="submit" class="w-full sm:w-auto px-5 sm:px-6 py-2.5 sm:py-3 rounded-xl bg-gradient-to-r from-[#06B6D4] to-[#38BDF8] hover:from-[#0891B2] hover:to-[#0284C7] text-white font-bold text-xs sm:text-sm shadow-md shadow-cyan-500/30 transition transform hover:scale-105 shrink-0 flex items-center justify-center gap-2">
                            <span>ابحث الآن</span>
                            <i class="fa-solid fa-arrow-left text-xs"></i>
                        </button>
                    </div>
                </form>

                <!-- Quick Search Tags -->
                <div class="flex flex-wrap items-center gap-1.5 sm:gap-2 pt-1 text-xs text-sky-100/80">
                    <span class="text-sky-200/70 font-medium">الأكثر بحثاً:</span>
                    <a href="{{ route('routes.show', 'mountains-viewpoints-route') }}" class="px-2.5 py-1 rounded-full bg-white/10 hover:bg-[#06B6D4] hover:text-white transition border border-white/15">الجبال والمطلات</a>
                    <a href="{{ route('routes.show', 'saudi-coffee-route') }}" class="px-2.5 py-1 rounded-full bg-white/10 hover:bg-[#06B6D4] hover:text-white transition border border-white/15">البن الخولاني</a>
                    <a href="{{ route('destinations.show', 'wadi-lajab-canyon') }}" class="px-2.5 py-1 rounded-full bg-white/10 hover:bg-[#06B6D4] hover:text-white transition border border-white/15">وادي لجب</a>
                    <a href="{{ route('destinations.show', 'farasan-islands-beaches') }}" class="px-2.5 py-1 rounded-full bg-white/10 hover:bg-[#06B6D4] hover:text-white transition border border-white/15">جزر فرسان</a>
                </div>

                <!-- Slider Controls & Numbering -->
                <div class="pt-3 sm:pt-6 flex items-center gap-4 sm:gap-6">
                    <div class="text-xs sm:text-sm font-bold tracking-widest text-sky-200 font-mono">
                        <span id="currentSlideNumber" class="text-[#38BDF8] text-base sm:text-lg font-bold">01</span> / 04
                    </div>
                    <!-- Indicator Bars -->
                    <div class="flex items-center gap-2">
                        <button class="hero-indicator group py-2" data-slide="0" aria-label="Slide 1">
                            <div class="indicator-bar h-1.5 w-8 sm:w-10 bg-[#38BDF8] rounded-full transition-all duration-300"></div>
                        </button>
                        <button class="hero-indicator group py-2" data-slide="1" aria-label="Slide 2">
                            <div class="indicator-bar h-1.5 w-4 sm:w-6 bg-white/40 group-hover:bg-white/70 rounded-full transition-all duration-300"></div>
                        </button>
                        <button class="hero-indicator group py-2" data-slide="2" aria-label="Slide 3">
                            <div class="indicator-bar h-1.5 w-4 sm:w-6 bg-white/40 group-hover:bg-white/70 rounded-full transition-all duration-300"></div>
                        </button>
                        <button class="hero-indicator group py-2" data-slide="3" aria-label="Slide 4">
                            <div class="indicator-bar h-1.5 w-4 sm:w-6 bg-white/40 group-hover:bg-white/70 rounded-full transition-all duration-300"></div>
                        </button>
                    </div>
                </div>

            </div>

            <!-- Left Column: 3D Floating Perspective Showcase Cards (Desktop Only) -->
            <div class="lg:col-span-5 hidden lg:block perspective-1500">
                <div class="relative w-full h-[480px] flex items-center justify-center">
                    
                    <!-- 3D Card 1: وادي لجب (Left Tilt) -->
                    <a href="{{ route('destinations.show', 'wadi-lajab-canyon') }}" class="hero-3d-card-left absolute -right-2 top-8 w-48 h-80 rounded-3xl overflow-hidden glass-ocean-overlay border border-white/30 group cursor-pointer" data-tilt>
                        <img src="/images/wadi_lajab.jpg" alt="وادي لجب" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#164E63]/95 via-transparent to-black/20"></div>
                        <div class="absolute bottom-4 inset-x-4 text-center">
                            <span class="inline-block px-3 py-0.5 bg-[#06B6D4] text-white text-xs font-bold rounded-full mb-1">مسار المغامرات</span>
                            <h3 class="text-white font-bold text-lg font-heading">وادي لجب</h3>
                            <div class="text-amber-300 text-xs flex items-center justify-center gap-1 mt-1 font-semibold">
                                <i class="fa-solid fa-star text-amber-400"></i>
                                <span>4.90</span>
                            </div>
                        </div>
                    </a>

                    <!-- 3D Card 2: الجبال والمطلات (Center Elevated) -->
                    <a href="{{ route('routes.show', 'mountains-viewpoints-route') }}" class="hero-3d-card-center absolute z-20 w-52 h-96 rounded-3xl overflow-hidden glass-ocean-overlay border border-white/40 group cursor-pointer shadow-2xl" data-tilt>
                        <img src="/images/al_dharb_viewpoint.jpg" alt="الجبال والمطلات" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#164E63]/95 via-transparent to-black/20"></div>
                        <div class="absolute top-4 right-4">
                            <span class="px-2.5 py-1 bg-cyan-600/90 text-white text-[11px] font-bold rounded-lg backdrop-blur-md shadow-xs">
                                <i class="fa-solid fa-cloud"></i> فوق السحاب
                            </span>
                        </div>
                        <div class="absolute bottom-5 inset-x-4 text-center">
                            <span class="inline-block px-3 py-0.5 bg-[#38BDF8] text-[#164E63] text-xs font-black rounded-full mb-1">المسار الأيقوني</span>
                            <h3 class="text-white font-black text-xl font-heading">الجبال والمطلات</h3>
                            <p class="text-sky-100/90 text-xs mt-1">فيفا والداير والريث</p>
                            <div class="text-amber-300 text-xs flex items-center justify-center gap-1 mt-1 font-bold">
                                <i class="fa-solid fa-star text-amber-400"></i>
                                <span>4.88 (184 تقييم)</span>
                            </div>
                        </div>
                    </a>

                    <!-- 3D Card 3: جزر فرسان (Right Tilt) -->
                    <a href="{{ route('destinations.show', 'farasan-islands-beaches') }}" class="hero-3d-card-right absolute -left-2 top-12 w-48 h-80 rounded-3xl overflow-hidden glass-ocean-overlay border border-white/30 group cursor-pointer" data-tilt>
                        <img src="/images/farasan_islands.jpg" alt="جزر فرسان" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#164E63]/95 via-transparent to-black/20"></div>
                        <div class="absolute bottom-4 inset-x-4 text-center">
                            <span class="inline-block px-3 py-0.5 bg-[#06B6D4] text-white text-xs font-bold rounded-full mb-1">البحر والجزر</span>
                            <h3 class="text-white font-bold text-lg font-heading">جزر فرسان</h3>
                            <div class="text-amber-300 text-xs flex items-center justify-center gap-1 mt-1 font-semibold">
                                <i class="fa-solid fa-star text-amber-400"></i>
                                <span>4.92</span>
                            </div>
                        </div>
                    </a>

                </div>
            </div>

        </div>
    </div>

    <!-- Organic Smooth Wave Separator (Flows cleanly into #F8FCFD without cuts or disconnected areas) -->
    <div class="relative w-full overflow-hidden leading-none z-10 -mt-1 pointer-events-none">
        <svg viewBox="0 0 1440 96" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" class="w-full h-10 sm:h-14 lg:h-20 text-[#F8FCFD] fill-current block">
            <path d="M0,32 C240,75 480,95 720,64 C960,32 1200,45 1440,55 L1440,96 L0,96 Z"></path>
        </svg>
    </div>

</section>
<!-- ========================================== -->
<!-- 1. STATS BAR: FLOATING GLASS PEBBLES -->
<!-- (حصى زجاجية طافية متداخلة مع أسفل الهيرو مع عدادات حية) -->
<!-- ========================================== -->
<section class="relative z-20 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 sm:-mt-14 mb-12 sm:mb-20">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 text-center">
        
        <!-- Pebble 1: 500+ Sites (Turquoise Theme) -->
        <div class="glass-pebble rounded-3xl p-5 sm:p-7 relative overflow-hidden group cursor-default">
            <div class="absolute -top-10 -right-10 w-24 h-24 bg-[#2EC4C9]/15 rounded-full blur-xl group-hover:scale-150 transition duration-500"></div>
            <div class="w-12 h-12 rounded-2xl bg-[#2EC4C9]/15 text-[#0E7C86] flex items-center justify-center text-xl mx-auto mb-3 shadow-xs group-hover:scale-110 group-hover:rotate-6 transition duration-300">
                <i class="fa-solid fa-map-location-dot"></i>
            </div>
            <div class="text-3xl sm:text-4xl lg:text-5xl font-black text-[#071E2F] font-display" data-counter="500" data-suffix="+">
                500+
            </div>
            <div class="text-xs sm:text-sm font-bold text-[#0E7C86] mt-1.5 font-heading">
                موقع سياحي وطبيعي
            </div>
        </div>

        <!-- Pebble 2: 50+ Routes (Emerald Theme) -->
        <div class="glass-pebble rounded-3xl p-5 sm:p-7 relative overflow-hidden group cursor-default">
            <div class="absolute -top-10 -right-10 w-24 h-24 bg-[#1F8A5B]/15 rounded-full blur-xl group-hover:scale-150 transition duration-500"></div>
            <div class="w-12 h-12 rounded-2xl bg-[#1F8A5B]/15 text-[#1F8A5B] flex items-center justify-center text-xl mx-auto mb-3 shadow-xs group-hover:scale-110 group-hover:rotate-6 transition duration-300">
                <i class="fa-solid fa-route"></i>
            </div>
            <div class="text-3xl sm:text-4xl lg:text-5xl font-black text-[#1F8A5B] font-display" data-counter="50" data-suffix="+">
                50+
            </div>
            <div class="text-xs sm:text-sm font-bold text-[#071E2F]/80 mt-1.5 font-heading">
                مسار سياحي متكامل
            </div>
        </div>

        <!-- Pebble 3: 300+ Guides & Providers (Coral Theme) -->
        <div class="glass-pebble rounded-3xl p-5 sm:p-7 relative overflow-hidden group cursor-default">
            <div class="absolute -top-10 -right-10 w-24 h-24 bg-[#FF7A59]/15 rounded-full blur-xl group-hover:scale-150 transition duration-500"></div>
            <div class="w-12 h-12 rounded-2xl bg-[#FF7A59]/15 text-[#FF7A59] flex items-center justify-center text-xl mx-auto mb-3 shadow-xs group-hover:scale-110 group-hover:rotate-6 transition duration-300">
                <i class="fa-solid fa-user-check"></i>
            </div>
            <div class="text-3xl sm:text-4xl lg:text-5xl font-black text-[#071E2F] font-display" data-counter="300" data-suffix="+">
                300+
            </div>
            <div class="text-xs sm:text-sm font-bold text-[#FF7A59] mt-1.5 font-heading">
                مقدم خدمات ومرشد
            </div>
        </div>

        <!-- Pebble 4: 4.88 Rating (Gold Sand Theme with Gradient Ring) -->
        <div class="glass-pebble rounded-3xl p-5 sm:p-7 relative overflow-hidden group cursor-default ring-2 ring-[#F2B84B]/40">
            <div class="absolute -top-10 -right-10 w-24 h-24 bg-[#F2B84B]/20 rounded-full blur-xl group-hover:scale-150 transition duration-500"></div>
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-[#F2B84B] to-[#FF7A59] text-white flex items-center justify-center text-xl mx-auto mb-3 shadow-md shadow-amber-500/25 group-hover:scale-110 group-hover:rotate-6 transition duration-300">
                <i class="fa-solid fa-star"></i>
            </div>
            <div class="text-3xl sm:text-4xl lg:text-5xl font-black text-[#D97706] font-display flex items-center justify-center gap-1">
                <span data-counter="4.88" data-decimals="2">4.88</span>
                <span class="text-xl text-[#F2B84B]">★</span>
            </div>
            <div class="text-xs sm:text-sm font-bold text-[#071E2F]/80 mt-1.5 font-heading">
                تقييم الزوار العام
            </div>
        </div>

    </div>
</section>

<!-- ========================================== -->
<!-- 2. CATEGORIES: تنوّع استثنائي في مكان واحد -->
<!-- (معرض تفاعلي بألواح مقوسة تتمدد باللمس والتمرير) -->
<!-- ========================================== -->
<section class="py-16 sm:py-24 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto text-center">
    
    <div class="space-y-3 mb-12 sm:mb-16">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#0E7C86]/10 text-[#0E7C86] text-xs font-bold border border-[#0E7C86]/20">
            <i class="fa-solid fa-compass-drafting text-[#2EC4C9]"></i>
            <span>تضاريس وطبيعة جازان الخلابة</span>
        </div>
        <h2 class="text-3xl sm:text-5xl font-black text-[#071E2F] tracking-tight font-display">
            تنوّع استثنائي في مكان واحد
        </h2>
        <p class="text-[#071E2F]/75 max-w-2xl mx-auto text-xs sm:text-base leading-relaxed">
            الساحل والجزر والجبال والأودية والمدرجات الزراعية والتراث، وهو ما يجعل فكرة المسارات السياحية مناسبة لطبيعة المنطقة.
        </p>
    </div>

    <!-- Desktop: Interactive Expanding Arch Panels Gallery -->
    <div class="hidden lg:block expanding-gallery-wrap">
        
        <!-- Panel 1: الساحل (Aqua Theme) -->
        <a href="{{ route('destinations.index', ['category' => 'coastal-beaches']) }}" 
           class="expanding-panel group relative is-active border border-[#2EC4C9]/40 shadow-xl"
           data-panel="coast">
            <img src="/images/coastal_beach.jpg" alt="الساحل" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-[#071E2F]/95 via-[#0E7C86]/40 to-transparent"></div>
            
            <div class="panel-collapsed-label absolute bottom-8 inset-x-0 text-center font-display font-black text-white text-xl tracking-wider">
                الساحل
            </div>
            
            <div class="panel-expanded-content absolute inset-x-6 bottom-8 text-right space-y-2">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-[#2EC4C9] text-[#071E2F]">شواطئ ومياه صافية</span>
                <h3 class="text-3xl font-black text-white font-display">الساحل</h3>
                <p class="text-sky-100 text-sm max-w-sm leading-relaxed">رمال ذهبية وبحر هادئ ونزهات بحرية ساحرة على مدار العام.</p>
                <div class="pt-2">
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white text-[#071E2F] font-bold text-xs shadow-md">
                        <span>استكشف الوجهات</span>
                        <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    </span>
                </div>
            </div>
        </a>

        <!-- Panel 2: الجزر (Turquoise Theme) -->
        <a href="{{ route('destinations.index', ['category' => 'sea-and-islands']) }}" 
           class="expanding-panel group relative border border-[#06B6D4]/40 shadow-xl"
           data-panel="islands">
            <img src="/images/farasan_islands.jpg" alt="الجزر" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-[#071E2F]/95 via-[#06B6D4]/40 to-transparent"></div>
            
            <div class="panel-collapsed-label absolute bottom-8 inset-x-0 text-center font-display font-black text-white text-xl tracking-wider">
                الجزر
            </div>
            
            <div class="panel-expanded-content absolute inset-x-6 bottom-8 text-right space-y-2">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-[#06B6D4] text-white">أرخبيل فرسان البكر</span>
                <h3 class="text-3xl font-black text-white font-display">الجزر</h3>
                <p class="text-sky-100 text-sm max-w-sm leading-relaxed">أكثر من 80 جزيرة بكر بشعب مرجانية نادرة ومحميات غزلان طبيعية.</p>
                <div class="pt-2">
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white text-[#071E2F] font-bold text-xs shadow-md">
                        <span>استكشف الوجهات</span>
                        <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    </span>
                </div>
            </div>
        </a>

        <!-- Panel 3: الجبال والمطلات (Emerald Theme) -->
        <a href="{{ route('destinations.index', ['category' => 'mountains-and-viewpoints']) }}" 
           class="expanding-panel group relative border border-[#1F8A5B]/40 shadow-xl"
           data-panel="mountains">
            <img src="/images/al_dharb_viewpoint.jpg" alt="الجبال" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-[#071E2F]/95 via-[#1F8A5B]/40 to-transparent"></div>
            
            <div class="panel-collapsed-label absolute bottom-8 inset-x-0 text-center font-display font-black text-white text-xl tracking-wider">
                الجبال
            </div>
            
            <div class="panel-expanded-content absolute inset-x-6 bottom-8 text-right space-y-2">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-[#1F8A5B] text-white">قمم ومطلات ضبابية</span>
                <h3 class="text-3xl font-black text-white font-display">الجبال والمطلات</h3>
                <p class="text-emerald-100 text-sm max-w-sm leading-relaxed">فيفا والداير وهروب.. قمم خضراء تلامس السحاب بأجواء معتدلة صيفاً.</p>
                <div class="pt-2">
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white text-[#071E2F] font-bold text-xs shadow-md">
                        <span>استكشف الوجهات</span>
                        <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    </span>
                </div>
            </div>
        </a>

        <!-- Panel 4: الأودية (Deep Teal Theme) -->
        <a href="{{ route('destinations.index', ['category' => 'adventures-and-valleys']) }}" 
           class="expanding-panel group relative border border-[#0E7C86]/40 shadow-xl"
           data-panel="valleys">
            <img src="/images/wadi_lajab.jpg" alt="الأودية" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-[#071E2F]/95 via-[#0E7C86]/40 to-transparent"></div>
            
            <div class="panel-collapsed-label absolute bottom-8 inset-x-0 text-center font-display font-black text-white text-xl tracking-wider">
                الأودية
            </div>
            
            <div class="panel-expanded-content absolute inset-x-6 bottom-8 text-right space-y-2">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-[#0E7C86] text-white">طبيعة ومجاري مائية</span>
                <h3 class="text-3xl font-black text-white font-display">الأودية والمغامرات</h3>
                <p class="text-teal-100 text-sm max-w-sm leading-relaxed">وادي لجب وشلالات وادي بيش وشقوق صخرية أسطورية للمغامرين.</p>
                <div class="pt-2">
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white text-[#071E2F] font-bold text-xs shadow-md">
                        <span>استكشف الوجهات</span>
                        <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    </span>
                </div>
            </div>
        </a>

        <!-- Panel 5: المدرجات والبن (Gold Theme) -->
        <a href="{{ route('destinations.index', ['category' => 'coffee-and-farms']) }}" 
           class="expanding-panel group relative border border-[#F2B84B]/40 shadow-xl"
           data-panel="coffee">
            <img src="/images/coffee_terraces.jpg" alt="المدرجات والبن" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-[#071E2F]/95 via-[#F2B84B]/40 to-transparent"></div>
            
            <div class="panel-collapsed-label absolute bottom-8 inset-x-0 text-center font-display font-black text-white text-xl tracking-wider">
                البن
            </div>
            
            <div class="panel-expanded-content absolute inset-x-6 bottom-8 text-right space-y-2">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-[#F2B84B] text-[#071E2F]">إرث البن الخولاني</span>
                <h3 class="text-3xl font-black text-white font-display">المدرجات والبن</h3>
                <p class="text-amber-100 text-sm max-w-sm leading-relaxed">تذوق أندر أنواع القهوة السعودية في مزارع الأجداد التاريخية.</p>
                <div class="pt-2">
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white text-[#071E2F] font-bold text-xs shadow-md">
                        <span>استكشف الوجهات</span>
                        <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    </span>
                </div>
            </div>
        </a>

        <!-- Panel 6: التراث (Coral Theme) -->
        <a href="{{ route('destinations.index', ['category' => 'heritage-and-forts']) }}" 
           class="expanding-panel group relative border border-[#FF7A59]/40 shadow-xl"
           data-panel="heritage">
            <img src="/images/heritage_village.jpg" alt="التراث" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-[#071E2F]/95 via-[#FF7A59]/40 to-transparent"></div>
            
            <div class="panel-collapsed-label absolute bottom-8 inset-x-0 text-center font-display font-black text-white text-xl tracking-wider">
                التراث
            </div>
            
            <div class="panel-expanded-content absolute inset-x-6 bottom-8 text-right space-y-2">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-[#FF7A59] text-white">موروث أصيل وقرى حجرية</span>
                <h3 class="text-3xl font-black text-white font-display">التراث والقرى</h3>
                <p class="text-rose-100 text-sm max-w-sm leading-relaxed">قلاع تاريخية وقرى معمارية فريدة تروي تاريخ أقدم حضارات الجزيرة.</p>
                <div class="pt-2">
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white text-[#071E2F] font-bold text-xs shadow-md">
                        <span>استكشف الوجهات</span>
                        <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    </span>
                </div>
            </div>
        </a>

    </div>

    <!-- Mobile Touch-Friendly Snap Carousel -->
    <div class="lg:hidden flex overflow-x-auto snap-x snap-mandatory gap-4 pb-4 px-2 no-scrollbar">
        <!-- 6 Mobile Cards with Arch Masks -->
        @php
            $mobileCats = [
                ['name' => 'الساحل', 'sub' => 'شواطئ ومياه صافية', 'img' => '/images/coastal_beach.jpg', 'slug' => 'coastal-beaches', 'color' => '#2EC4C9'],
                ['name' => 'الجزر', 'sub' => 'أرخبيل فرسان البكر', 'img' => '/images/farasan_islands.jpg', 'slug' => 'sea-and-islands', 'color' => '#06B6D4'],
                ['name' => 'الجبال والمطلات', 'sub' => 'قمم ومطلات ضبابية', 'img' => '/images/al_dharb_viewpoint.jpg', 'slug' => 'mountains-and-viewpoints', 'color' => '#1F8A5B'],
                ['name' => 'الأودية', 'sub' => 'طبيعة ومجاري مائية', 'img' => '/images/wadi_lajab.jpg', 'slug' => 'adventures-and-valleys', 'color' => '#0E7C86'],
                ['name' => 'المدرجات والبن', 'sub' => 'إرث البن وفنون مستدامة', 'img' => '/images/coffee_terraces.jpg', 'slug' => 'coffee-and-farms', 'color' => '#F2B84B'],
                ['name' => 'التراث', 'sub' => 'موروث أصيل وقرى حجرية', 'img' => '/images/heritage_village.jpg', 'slug' => 'heritage-and-forts', 'color' => '#FF7A59']
            ];
        @endphp
        @foreach($mobileCats as $mCat)
            <a href="{{ route('destinations.index', ['category' => $mCat['slug']]) }}" class="w-[260px] shrink-0 snap-center relative h-80 mask-arch-tall overflow-hidden shadow-lg border border-white/40 block">
                <img src="{{ $mCat['img'] }}" alt="{{ $mCat['name'] }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-[#071E2F]/95 via-[#071E2F]/40 to-transparent"></div>
                <div class="absolute bottom-5 inset-x-4 text-center">
                    <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold text-white mb-1" style="background-color: {{ $mCat['color'] }}">{{ $mCat['sub'] }}</span>
                    <h3 class="text-white text-xl font-bold font-display">{{ $mCat['name'] }}</h3>
                </div>
            </a>
        @endforeach
    </div>

</section>

<!-- ========================================== -->
<!-- 3. VALUE PROPS: مَطَلّ يجمع كل ما تحتاجه في رحلة واحدة -->
<!-- (مسار متعرج متبادل على خلفية رملية دافئة مع أرقام محفورة ضخمة) -->
<!-- ========================================== -->
<section class="py-20 sm:py-32 bg-topo-cream text-[#071E2F] relative overflow-hidden border-y border-[#F2B84B]/20">
    
    <!-- Floating Ambient Color Bubbles -->
    <div class="absolute top-10 right-10 w-96 h-96 bg-[#2EC4C9]/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 left-10 w-96 h-96 bg-[#FF7A59]/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="text-center space-y-3 mb-16 sm:mb-24">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white shadow-xs border border-[#F2B84B]/30 text-[#0E7C86] text-xs font-bold">
                <i class="fa-solid fa-shapes text-[#FF7A59]"></i>
                <span>منصة رقمية موحدة وشاملة</span>
            </div>
            <h2 class="text-3xl sm:text-5xl font-black text-[#071E2F] tracking-tight font-display">
                مَطَلّ يجمع كل ما تحتاجه في رحلة واحدة
            </h2>
            <p class="text-[#071E2F]/70 max-w-2xl mx-auto text-xs sm:text-base leading-relaxed">
                بدل أن تبحث في مصادر متفرقة، يقدم لك مَطَلّ حلولاً متكاملة لتخطيط وتجربة لا تُنسى في كافة أرجاء جازان.
            </p>
        </div>

        <!-- 5 Stepping Stones Staggered Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 sm:gap-8 items-start">
            
            <!-- Stone 1 -->
            <div class="bg-white/90 backdrop-blur-xl rounded-3xl p-6 sm:p-7 border border-[#2EC4C9]/30 shadow-lg shadow-teal-900/5 hover:-translate-y-3 transition duration-300 relative group">
                <div class="outline-giant-num text-5xl sm:text-6xl mb-2">01</div>
                <div class="w-12 h-12 rounded-2xl bg-[#2EC4C9]/15 text-[#0E7C86] flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <h3 class="font-display font-bold text-lg text-[#071E2F] mb-2 group-hover:text-[#0E7C86] transition">سهولة التخطيط</h3>
                <p class="text-[#071E2F]/75 text-xs sm:text-sm leading-relaxed">جدول زمني متكامل وواضح يوفر وقت وجهد المسافر ويمنع التشتت بين المواقع.</p>
            </div>

            <!-- Stone 2 (Shifted down on desktop) -->
            <div class="bg-white/90 backdrop-blur-xl rounded-3xl p-6 sm:p-7 border border-[#1F8A5B]/30 shadow-lg shadow-teal-900/5 hover:-translate-y-3 transition duration-300 relative group lg:translate-y-8">
                <div class="outline-giant-num text-5xl sm:text-6xl mb-2">02</div>
                <div class="w-12 h-12 rounded-2xl bg-[#1F8A5B]/15 text-[#1F8A5B] flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <h3 class="font-display font-bold text-lg text-[#071E2F] mb-2 group-hover:text-[#1F8A5B] transition">دقة في الاختيار</h3>
                <p class="text-[#071E2F]/75 text-xs sm:text-sm leading-relaxed">معلومات موثوقة ومحدثة لكل موقع ومسار، مع تفاصيل الأوقات والخدمات المتوفرة.</p>
            </div>

            <!-- Stone 3 -->
            <div class="bg-white/90 backdrop-blur-xl rounded-3xl p-6 sm:p-7 border border-[#F2B84B]/40 shadow-lg shadow-teal-900/5 hover:-translate-y-3 transition duration-300 relative group">
                <div class="outline-giant-num text-5xl sm:text-6xl mb-2">03</div>
                <div class="w-12 h-12 rounded-2xl bg-[#F2B84B]/15 text-[#D97706] flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition">
                    <i class="fa-solid fa-people-roof"></i>
                </div>
                <h3 class="font-display font-bold text-lg text-[#071E2F] mb-2 group-hover:text-[#D97706] transition">تجارب أصلية وتفاعلية</h3>
                <p class="text-[#071E2F]/75 text-xs sm:text-sm leading-relaxed">مرشدون محليون، مزارع بن خولاني، ورحلات بحرية فريدة يقودها أهالي جازان.</p>
            </div>

            <!-- Stone 4 (Shifted down on desktop) -->
            <div class="bg-white/90 backdrop-blur-xl rounded-3xl p-6 sm:p-7 border border-[#FF7A59]/30 shadow-lg shadow-teal-900/5 hover:-translate-y-3 transition duration-300 relative group lg:translate-y-8">
                <div class="outline-giant-num text-5xl sm:text-6xl mb-2">04</div>
                <div class="w-12 h-12 rounded-2xl bg-[#FF7A59]/15 text-[#FF7A59] flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition">
                    <i class="fa-solid fa-compass"></i>
                </div>
                <h3 class="font-display font-bold text-lg text-[#071E2F] mb-2 group-hover:text-[#FF7A59] transition">اكتشاف محطات جديدة</h3>
                <p class="text-[#071E2F]/75 text-xs sm:text-sm leading-relaxed">تنبيهات ذكية للمواقع والخدمات القريبة على مسار رحلتك دون تفويت أي متعة.</p>
            </div>

            <!-- Stone 5 -->
            <div class="bg-white/90 backdrop-blur-xl rounded-3xl p-6 sm:p-7 border border-[#0E7C86]/30 shadow-lg shadow-teal-900/5 hover:-translate-y-3 transition duration-300 relative group">
                <div class="outline-giant-num text-5xl sm:text-6xl mb-2">05</div>
                <div class="w-12 h-12 rounded-2xl bg-[#0E7C86]/15 text-[#0E7C86] flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition">
                    <i class="fa-solid fa-shield-heart"></i>
                </div>
                <h3 class="font-display font-bold text-lg text-[#071E2F] mb-2 group-hover:text-[#0E7C86] transition">سياحة آمنة</h3>
                <p class="text-[#071E2F]/75 text-xs sm:text-sm leading-relaxed">توجيهات وإرشادات وتنبيهات الطقس وتوافر التغطية ومعلومات السلامة أولاً بأول.</p>
            </div>

        </div>

    </div>
</section>

<!-- ========================================== -->
<!-- 4. FEATURED ROUTES: اكتشف المسارات -->
<!-- (عارض سينمائي فاخر بثلاث بطاقات أيقونية على خلفية محيطية داكنة) -->
<!-- ========================================== -->
<section class="py-20 sm:py-32 bg-gradient-to-b from-[#071E2F] via-[#0E7C86]/95 to-[#071E2F] text-white relative overflow-hidden">
    
    <!-- Light Rays & Ambient Orbs -->
    <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[800px] h-96 bg-[#2EC4C9]/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="flex flex-col md:flex-row items-center justify-between mb-12 sm:mb-16 gap-4 text-center md:text-right">
            <div>
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 text-[#2EC4C9] text-xs font-bold border border-white/15 mb-3">
                    <i class="fa-solid fa-star text-[#F2B84B]"></i>
                    <span>تجارب متكاملة صممت لك</span>
                </div>
                <h2 class="text-3xl sm:text-5xl font-black text-white tracking-tight font-display">
                    اكتشف المسارات
                </h2>
                <p class="text-sky-100/80 max-w-xl text-xs sm:text-base leading-relaxed mt-1">
                    رحلات سياحية متسلسلة تأخذك في قلب الطبيعة وثقافة جازان الأصيلة.
                </p>
            </div>
            <a href="{{ route('routes.index') }}" class="px-6 py-3.5 rounded-2xl bg-white/15 hover:bg-white text-white hover:text-[#071E2F] border border-white/20 font-bold text-xs sm:text-sm transition flex items-center gap-2 shrink-0">
                <span>عرض جميع المسارات</span>
                <i class="fa-solid fa-arrow-left text-xs"></i>
            </a>
        </div>

        <!-- 3 Prominent Cinematic Cards with Ken Burns Zoom & Glass Telemetry -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Route 1: الجبال والمطلات (Featured Hero Card) -->
            <div class="bg-white/10 backdrop-blur-xl rounded-3xl overflow-hidden border border-white/20 shadow-2xl group hover:-translate-y-2 transition-all duration-400 flex flex-col justify-between">
                <div class="relative h-72 sm:h-80 overflow-hidden">
                    <img src="/images/al_dharb_viewpoint.jpg" alt="مسار الجبال والمطلات" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#071E2F] via-[#071E2F]/30 to-transparent"></div>
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 rounded-full text-xs font-black bg-[#2EC4C9] text-[#071E2F] shadow-md">
                            المسار الأيقوني
                        </span>
                    </div>
                    <div class="absolute bottom-4 inset-x-4 flex items-center justify-between text-xs font-semibold text-white/90">
                        <span class="bg-black/40 backdrop-blur-md px-3 py-1 rounded-lg border border-white/10">3 أيام · 4 محطات</span>
                        <span class="bg-black/40 backdrop-blur-md px-3 py-1 rounded-lg border border-white/10 text-[#F2B84B]"><i class="fa-solid fa-star"></i> 4.88</span>
                    </div>
                </div>
                <div class="p-6 sm:p-7 space-y-4">
                    <h3 class="text-2xl font-black text-white font-display group-hover:text-[#2EC4C9] transition">
                        مسار الجبال والمطلات
                    </h3>
                    <p class="text-sky-100/80 text-xs sm:text-sm leading-relaxed">
                        استكشف قمم فيفا والداير والريث، وانغمس في أجواء الضباب والمدرجات الزراعية وإطلالات ساحرة فوق السحاب.
                    </p>
                    <div class="pt-2 border-t border-white/15 flex items-center justify-between">
                        <span class="text-xs text-sky-200">صعوبة المسار: متوسط</span>
                        <a href="{{ route('routes.show', 'mountains-viewpoints-route') }}" class="inline-flex items-center gap-2 text-xs font-bold text-[#2EC4C9] hover:text-white transition">
                            <span>عرض تفاصيل المسار</span>
                            <i class="fa-solid fa-arrow-left text-[10px]"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Route 2: مسار المغامرات · وادي لجب -->
            <div class="bg-white/10 backdrop-blur-xl rounded-3xl overflow-hidden border border-white/20 shadow-2xl group hover:-translate-y-2 transition-all duration-400 flex flex-col justify-between">
                <div class="relative h-72 sm:h-80 overflow-hidden">
                    <img src="/images/wadi_lajab.jpg" alt="مسار وادي لجب" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#071E2F] via-[#071E2F]/30 to-transparent"></div>
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 rounded-full text-xs font-black bg-[#1F8A5B] text-white shadow-md">
                            مغامرة طبيعية
                        </span>
                    </div>
                    <div class="absolute bottom-4 inset-x-4 flex items-center justify-between text-xs font-semibold text-white/90">
                        <span class="bg-black/40 backdrop-blur-md px-3 py-1 rounded-lg border border-white/10">يوم واحد · 3 محطات</span>
                        <span class="bg-black/40 backdrop-blur-md px-3 py-1 rounded-lg border border-white/10 text-[#F2B84B]"><i class="fa-solid fa-star"></i> 4.90</span>
                    </div>
                </div>
                <div class="p-6 sm:p-7 space-y-4">
                    <h3 class="text-2xl font-black text-white font-display group-hover:text-[#1F8A5B] transition">
                        مسار المغامرات · وادي لجب
                    </h3>
                    <p class="text-sky-100/80 text-xs sm:text-sm leading-relaxed">
                        عش تجربة السير والمشي المائي بين شقوق الصخور الشاهقة، الشلالات المتدفقة، والمياه العذبة في قلب الريث.
                    </p>
                    <div class="pt-2 border-t border-white/15 flex items-center justify-between">
                        <span class="text-xs text-sky-200">صعوبة المسار: متوسط - متقدم</span>
                        <a href="{{ route('routes.show', 'wadi-lajab-adventure-route') }}" class="inline-flex items-center gap-2 text-xs font-bold text-[#2EC4C9] hover:text-white transition">
                            <span>عرض تفاصيل المسار</span>
                            <i class="fa-solid fa-arrow-left text-[10px]"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Route 3: المسار البحري · جزر فرسان -->
            <div class="bg-white/10 backdrop-blur-xl rounded-3xl overflow-hidden border border-white/20 shadow-2xl group hover:-translate-y-2 transition-all duration-400 flex flex-col justify-between">
                <div class="relative h-72 sm:h-80 overflow-hidden">
                    <img src="/images/farasan_islands.jpg" alt="المسار البحري فرسان" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#071E2F] via-[#071E2F]/30 to-transparent"></div>
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 rounded-full text-xs font-black bg-[#FF7A59] text-white shadow-md">
                            البحر والجزر
                        </span>
                    </div>
                    <div class="absolute bottom-4 inset-x-4 flex items-center justify-between text-xs font-semibold text-white/90">
                        <span class="bg-black/40 backdrop-blur-md px-3 py-1 rounded-lg border border-white/10">يومان · 5 محطات</span>
                        <span class="bg-black/40 backdrop-blur-md px-3 py-1 rounded-lg border border-white/10 text-[#F2B84B]"><i class="fa-solid fa-star"></i> 4.92</span>
                    </div>
                </div>
                <div class="p-6 sm:p-7 space-y-4">
                    <h3 class="text-2xl font-black text-white font-display group-hover:text-[#FF7A59] transition">
                        المسار البحري وجزر فرسان
                    </h3>
                    <p class="text-sky-100/80 text-xs sm:text-sm leading-relaxed">
                        إبحار بالعبارات واليخوت، غوص بين الشعب المرجانية الفيروزية، وزيارة قرية القصار وغابات المانجروف الساحرة.
                    </p>
                    <div class="pt-2 border-t border-white/15 flex items-center justify-between">
                        <span class="text-xs text-sky-200">صعوبة المسار: سهل ومناسب للعائلات</span>
                        <a href="{{ route('routes.show', 'farasan-marine-route') }}" class="inline-flex items-center gap-2 text-xs font-bold text-[#2EC4C9] hover:text-white transition">
                            <span>عرض تفاصيل المسار</span>
                            <i class="fa-solid fa-arrow-left text-[10px]"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- ========================================== -->
<!-- 5. SIX ROUTES: ستة مسارات لكل مسافر -->
<!-- (شبكة بينتو غير متناظرة بألوان وهوية بصرية متباينة) -->
<!-- ========================================== -->
<section class="py-20 sm:py-32 bg-topo-cream text-[#071E2F] relative overflow-hidden">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="text-center space-y-3 mb-16 sm:mb-20">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white shadow-xs border border-[#F2B84B]/30 text-[#0E7C86] text-xs font-bold">
                <i class="fa-solid fa-map-pin text-[#FF7A59]"></i>
                <span>تنوع الخيارات لتناسب جميع الأذواق</span>
            </div>
            <h2 class="text-3xl sm:text-5xl font-black text-[#071E2F] tracking-tight font-display">
                ستة مسارات لكل مسافر
            </h2>
            <p class="text-[#071E2F]/75 max-w-2xl mx-auto text-xs sm:text-base leading-relaxed">
                سواء كنت تبحث عن المغامرة، الاستجمام الساحلي، الثقافة، أو مذاق القهوة الخولانية، صممنا لك مساراً يليق بك.
            </p>
        </div>

        <!-- Bento Mosaic Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-6 sm:gap-8">
            
            <!-- Route 1: الجبال والمطلات (Hero Bento Card - spans 6 cols on lg) -->
            <a href="{{ route('routes.show', 'mountains-viewpoints-route') }}" 
               class="lg:col-span-6 bg-white rounded-3xl overflow-hidden border border-[#2EC4C9]/40 shadow-xl group hover:shadow-2xl transition duration-400 flex flex-col justify-between">
                <div class="relative h-64 sm:h-72 overflow-hidden">
                    <img src="/images/al_dharb_viewpoint.jpg" alt="مسار الجبال والمطلات" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#071E2F]/90 via-transparent to-transparent"></div>
                    <span class="absolute top-4 right-4 px-3 py-1 rounded-full text-xs font-bold bg-[#2EC4C9] text-[#071E2F]">01 · المسار الأيقوني</span>
                </div>
                <div class="p-6 sm:p-8 space-y-3">
                    <h3 class="text-2xl font-black text-[#071E2F] font-display group-hover:text-[#0E7C86] transition">مسار الجبال والمطلات</h3>
                    <p class="text-[#071E2F]/75 text-sm leading-relaxed">قمم فيفا، مطلات الداير، ومطل الريث البانورامي فوق السحاب.</p>
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-[#0E7C86]">
                        <span>استكشف المسار ومحطاته ←</span>
                        <span class="text-amber-500">⭐ 4.88</span>
                    </div>
                </div>
            </a>

            <!-- Route 2: البن الخولاني (Spans 6 cols on lg) -->
            <a href="{{ route('routes.show', 'saudi-coffee-route') }}" 
               class="lg:col-span-6 bg-white rounded-3xl overflow-hidden border border-[#F2B84B]/40 shadow-xl group hover:shadow-2xl transition duration-400 flex flex-col justify-between">
                <div class="relative h-64 sm:h-72 overflow-hidden">
                    <img src="/images/coffee_terraces.jpg" alt="مسار البن الخولاني" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#071E2F]/90 via-transparent to-transparent"></div>
                    <span class="absolute top-4 right-4 px-3 py-1 rounded-full text-xs font-bold bg-[#F2B84B] text-[#071E2F]">02 · إرث أصيل</span>
                </div>
                <div class="p-6 sm:p-8 space-y-3">
                    <h3 class="text-2xl font-black text-[#071E2F] font-display group-hover:text-[#D97706] transition">مسار البن السعودي الخولاني</h3>
                    <p class="text-[#071E2F]/75 text-sm leading-relaxed">مزارع البن في جبال الداير، حصاد الحبوب، وتجربة تحميص القهوة الأصلية.</p>
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-[#D97706]">
                        <span>استكشف المسار ومحطاته ←</span>
                        <span class="text-amber-500">⭐ 4.95</span>
                    </div>
                </div>
            </a>

            <!-- Route 3: التراث والثقافة (Spans 4 cols on lg) -->
            <a href="{{ route('routes.show', 'heritage-and-culture-route') }}" 
               class="lg:col-span-4 bg-white rounded-3xl overflow-hidden border border-[#FF7A59]/40 shadow-xl group hover:shadow-2xl transition duration-400 flex flex-col justify-between">
                <div class="relative h-56 overflow-hidden">
                    <img src="/images/heritage_village.jpg" alt="المسار التراثي" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#071E2F]/90 via-transparent to-transparent"></div>
                    <span class="absolute top-4 right-4 px-3 py-1 rounded-full text-xs font-bold bg-[#FF7A59] text-white">03 · تاريخ وتراث</span>
                </div>
                <div class="p-6 space-y-2">
                    <h3 class="text-xl font-black text-[#071E2F] font-display group-hover:text-[#FF7A59] transition">المسار التراثي والثقافي</h3>
                    <p class="text-[#071E2F]/75 text-xs leading-relaxed">القرية التراثية، القلاع التاريخية، ومهرجانات الفنون الشعبية.</p>
                </div>
            </a>

            <!-- Route 4: المسار البحري (Spans 4 cols on lg) -->
            <a href="{{ route('routes.show', 'farasan-marine-route') }}" 
               class="lg:col-span-4 bg-white rounded-3xl overflow-hidden border border-[#06B6D4]/40 shadow-xl group hover:shadow-2xl transition duration-400 flex flex-col justify-between">
                <div class="relative h-56 overflow-hidden">
                    <img src="/images/farasan_islands.jpg" alt="المسار البحري" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#071E2F]/90 via-transparent to-transparent"></div>
                    <span class="absolute top-4 right-4 px-3 py-1 rounded-full text-xs font-bold bg-[#06B6D4] text-white">04 · سحر الجزر</span>
                </div>
                <div class="p-6 space-y-2">
                    <h3 class="text-xl font-black text-[#071E2F] font-display group-hover:text-[#06B6D4] transition">المسار البحري وجزر فرسان</h3>
                    <p class="text-[#071E2F]/75 text-xs leading-relaxed">رحلات الغوص، شواطئ فرسان البكر، ومحميات الحياة الفطرية.</p>
                </div>
            </a>

            <!-- Route 5: مسار المغامرات (Spans 4 cols on lg) -->
            <a href="{{ route('routes.show', 'wadi-lajab-adventure-route') }}" 
               class="lg:col-span-4 bg-white rounded-3xl overflow-hidden border border-[#1F8A5B]/40 shadow-xl group hover:shadow-2xl transition duration-400 flex flex-col justify-between">
                <div class="relative h-56 overflow-hidden">
                    <img src="/images/wadi_lajab.jpg" alt="مسار المغامرات" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#071E2F]/90 via-transparent to-transparent"></div>
                    <span class="absolute top-4 right-4 px-3 py-1 rounded-full text-xs font-bold bg-[#1F8A5B] text-white">05 · تشويق ومياه</span>
                </div>
                <div class="p-6 space-y-2">
                    <h3 class="text-xl font-black text-[#071E2F] font-display group-hover:text-[#1F8A5B] transition">مسار المغامرات · وادي لجب</h3>
                    <p class="text-[#071E2F]/75 text-xs leading-relaxed">شقوق صخرية شاهقة وشلالات مائية وتحديات المسير الجبلي.</p>
                </div>
            </a>

        </div>

    </div>
</section>

<!-- ========================================== -->
<!-- 6. INTEGRATED JOURNEY: مسار جبال جازان المتكامل -->
<!-- (مسار ليلي داكن تفاعلي بطريق جبلي متعرج وبطاقة قمة زجاجية ثلاثية الأبعاد) -->
<!-- ========================================== -->
<section class="py-24 sm:py-36 bg-[#071E2F] text-white relative overflow-hidden">
    
    <!-- Ambient Stars & Aurora Light Blooms -->
    <div class="absolute top-0 right-1/4 w-[480px] h-[480px] bg-[#2EC4C9]/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-1/4 w-[500px] h-[500px] bg-[#1F8A5B]/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[300px] bg-[#FF7A59]/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Section Header -->
        <div class="text-center space-y-3 mb-16 sm:mb-20">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 text-[#2EC4C9] text-xs font-bold border border-white/15 backdrop-blur-md">
                <i class="fa-solid fa-route"></i>
                <span>نموذج رحلة متكاملة · مسار القمم والمطلات</span>
            </div>
            <h2 class="text-3xl sm:text-5xl font-black text-white tracking-tight font-display">
                مسار جبال جازان: الرحلة في 7 محطات
            </h2>
            <p class="text-sky-100/80 max-w-2xl mx-auto text-xs sm:text-base leading-relaxed">
                انقر على أي محطة لاستكشاف برنامجها، تفاصيل التوقف، والمذاق الأصيل المعدّ لك من الصباح حتى المساء.
            </p>
        </div>

        @php
            $stations = [
                [
                    'step' => 1,
                    'title' => 'مدينة جازان',
                    'subtitle' => 'نقطة الانطلاق والتجهيز',
                    'desc' => 'نقطة الانطلاق والتجمع وتجهيز المركبات والتعريف بالمرشد السياحي ومسار الرحلة اليومية واستلام ضيافة الصباح.',
                    'icon' => 'fa-car',
                    'time' => '07:30 ص',
                    'elevation' => '40 م',
                    'tag' => 'تجهيز وانطلاق',
                    'image' => '/images/jazan_coastal_beach.jpg'
                ],
                [
                    'step' => 2,
                    'title' => 'صعود فيفا',
                    'subtitle' => 'عناق السحاب والمدرجات',
                    'desc' => 'عبور الطرق المعلقة الشاهقة والتمتع بظاهرة بحر الضباب ومشاهدة المدرجات الخضراء المصنفة كأعجوبة معمارية زراعية.',
                    'icon' => 'fa-mountain',
                    'time' => '09:00 ص',
                    'elevation' => '1,800 م',
                    'tag' => 'بانوراما وضباب',
                    'image' => '/images/al_dharb_viewpoint.jpg'
                ],
                [
                    'step' => 3,
                    'title' => 'مزرعة البن الخولاني',
                    'subtitle' => 'تجربة التراث الزراعي العريق',
                    'desc' => 'جولة حية بين شجيرات البن الخولاني المعمّرة، والتعرف على مراحل الجني والتجفيف، وتذوق فنجان القهوة السعودية الفاخرة.',
                    'icon' => 'fa-mug-hot',
                    'time' => '11:00 ص',
                    'elevation' => '1,650 م',
                    'tag' => 'تذوق وضيافة',
                    'image' => '/images/coffee_terraces.jpg'
                ],
                [
                    'step' => 4,
                    'title' => 'الغداء الجازاني',
                    'subtitle' => 'مأدبة شعبية في قلب الطبيعة',
                    'desc' => 'جلسة تقليدية مع مأدبة غداء شعبية حافلة بخيرات المنطقة: سمك المغش، خبز الميفا الحار، والمرق الجبلي المنعش.',
                    'icon' => 'fa-utensils',
                    'time' => '01:30 م',
                    'elevation' => '1,500 م',
                    'tag' => 'مذاقات أصيلة',
                    'image' => '/images/detail_village.jpg'
                ],
                [
                    'step' => 5,
                    'title' => 'مطل الريث',
                    'subtitle' => 'وقفة تأمل واستراحة فوق القمم',
                    'desc' => 'وقفة تصوير بانورامية فوق السحاب وتأمل تشكيلات الجبال الشاهقة والتقاط صور تذكارية في أعلى شرفة بالمنطقة.',
                    'icon' => 'fa-camera',
                    'time' => '03:30 م',
                    'elevation' => '2,050 م',
                    'tag' => 'تصوير استثنائي',
                    'image' => '/images/jazan_alreeth_viewpoint.jpg'
                ],
                [
                    'step' => 6,
                    'title' => 'وادي لجب',
                    'subtitle' => 'مغامرة الشقوق والصخور المائية',
                    'desc' => 'مغامرة مشي واستكشاف خفيفة بين الشقوق الصخرية الشاهقة، وسماع خرير المياه العذبة والشلالات الجارية.',
                    'icon' => 'fa-person-hiking',
                    'time' => '05:00 م',
                    'elevation' => '650 م',
                    'tag' => 'مغامرة واستكشاف',
                    'image' => '/images/wadi_lajab.jpg'
                ],
                [
                    'step' => 7,
                    'title' => 'العودة للمدينة',
                    'subtitle' => 'ختام الرحلة واقتناء الهدايا',
                    'desc' => 'النزول التدريجي نحو جازان محملين بالذكريات والصور الجميلة واقتناء منتجات البن والعسل الطبيعي من المزارعين.',
                    'icon' => 'fa-flag-checkered',
                    'time' => '07:30 م',
                    'elevation' => '40 م',
                    'tag' => 'ذكريات وهدايا',
                    'image' => '/images/sunset_marine.jpg'
                ]
            ];
        @endphp

        <!-- 3D Mountain Road Pathway with Glowing Waypoint Nodes -->
        <div class="relative mb-14">
            <!-- Road Track SVG Line -->
            <div class="hidden lg:block absolute top-1/2 left-0 right-0 -translate-y-1/2 h-16 pointer-events-none z-0">
                <svg class="w-full h-full" viewBox="0 0 1200 60" fill="none" preserveAspectRatio="none">
                    <path d="M 0,30 Q 150,5 300,30 T 600,30 T 900,30 T 1200,30" stroke="rgba(255,255,255,0.15)" stroke-width="4" fill="none" />
                    <path class="sinuous-road-svg" d="M 0,30 Q 150,5 300,30 T 600,30 T 900,30 T 1200,30" stroke="url(#roadGradient)" stroke-width="4" fill="none" />
                    <defs>
                        <linearGradient id="roadGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="#2EC4C9" />
                            <stop offset="50%" stop-color="#F2B84B" />
                            <stop offset="100%" stop-color="#FF7A59" />
                        </linearGradient>
                    </defs>
                </svg>
            </div>

            <!-- 7 Interactive Waypoint Nodes Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-3 sm:gap-4 relative z-10">
                @foreach($stations as $idx => $st)
                    <button type="button" 
                            class="waypoint-node group p-4 sm:p-5 rounded-2xl bg-white/10 hover:bg-white/20 border border-white/15 text-center transition-all duration-300 cursor-pointer relative overflow-hidden {{ $idx === 0 ? 'is-active ring-2 ring-[#2EC4C9] shadow-lg shadow-cyan-500/30' : '' }}"
                            data-step="{{ $st['step'] }}"
                            data-title="{{ $st['title'] }}"
                            data-subtitle="{{ $st['subtitle'] }}"
                            data-desc="{{ $st['desc'] }}"
                            data-icon="{{ $st['icon'] }}"
                            data-time="{{ $st['time'] }}"
                            data-elevation="{{ $st['elevation'] }}"
                            data-tag="{{ $st['tag'] }}"
                            data-image="{{ $st['image'] }}">
                        
                        <div class="w-10 h-10 mx-auto rounded-full bg-white/15 text-[#2EC4C9] group-hover:text-white group-hover:bg-[#0E7C86] flex items-center justify-center text-base mb-2 transition shadow-inner">
                            <i class="fa-solid {{ $st['icon'] }}"></i>
                        </div>
                        <div class="text-[11px] font-mono font-black text-[#2EC4C9] mb-0.5">0{{ $st['step'] }}</div>
                        <div class="text-xs sm:text-sm font-bold text-white font-display truncate">{{ $st['title'] }}</div>
                        <div class="text-[10px] text-sky-200/70 mt-1 truncate">{{ $st['time'] }}</div>
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Summit Highlight 3D Glass Detail Card -->
        <div class="max-w-4xl mx-auto rounded-3xl p-1 bg-gradient-to-r from-[#2EC4C9] via-[#F2B84B] to-[#FF7A59] shadow-2xl perspective-1200">
            <div id="summitJourneyDisplay" class="bg-[#071E2F]/95 backdrop-blur-2xl rounded-[22px] p-6 sm:p-10 text-right relative overflow-hidden tilt-3d preserve-3d">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
                    
                    <!-- Left: Authentic Photo Panel with Giant Outlined Number -->
                    <div class="md:col-span-5 relative rounded-2xl overflow-hidden shadow-xl border border-white/20 group h-64 sm:h-72">
                        <img id="summitCardImage" src="/images/jazan_coastal_beach.jpg" alt="مدينة جازان" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#071E2F]/90 via-transparent to-black/30"></div>
                        
                        <!-- Floating Giant Outlined Numeral -->
                        <div id="summitCardNumber" class="outline-giant-num absolute top-3 left-4 text-6xl sm:text-7xl font-black pointer-events-none">
                            01
                        </div>

                        <!-- Telemetry Pill Tag -->
                        <div class="absolute bottom-3 inset-x-3 flex items-center justify-between text-[11px] font-bold text-white bg-black/50 backdrop-blur-md px-3 py-1.5 rounded-xl border border-white/20">
                            <span id="summitCardTag"><i class="fa-solid fa-flag text-[#2EC4C9] ml-1"></i> تجهيز وانطلاق</span>
                            <span id="summitCardTime" class="text-amber-300 font-mono">07:30 ص</span>
                        </div>
                    </div>

                    <!-- Right: Station Information & Interactive Telemetry -->
                    <div class="md:col-span-7 space-y-4">
                        <div class="flex items-center justify-between flex-wrap gap-2">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#2EC4C9]/20 text-[#2EC4C9] text-xs font-bold border border-[#2EC4C9]/30">
                                <i id="summitCardIcon" class="fa-solid fa-car"></i>
                                <span id="summitCardBadge">المحطة 1 من 7 · مسار جبال جازان</span>
                            </div>
                            <span id="summitCardElevation" class="text-xs text-sky-200/80 font-mono bg-white/10 px-2.5 py-0.5 rounded-md">
                                الارتفاع: 40 م
                            </span>
                        </div>

                        <div>
                            <h3 id="summitCardTitle" class="text-2xl sm:text-3xl font-black text-white font-display">مدينة جازان</h3>
                            <h4 id="summitCardSubtitle" class="text-sm font-semibold text-[#F2B84B] mt-0.5">نقطة الانطلاق والتجهيز</h4>
                        </div>

                        <p id="summitCardDesc" class="text-sky-100/90 text-xs sm:text-sm leading-relaxed">
                            نقطة الانطلاق والتجمع وتجهيز المركبات والتعريف بالمرشد السياحي ومسار الرحلة اليومية واستلام ضيافة الصباح.
                        </p>

                        <!-- Telemetry Info Chips -->
                        <div class="grid grid-cols-3 gap-2 pt-2 border-t border-white/10 text-center">
                            <div class="p-2 rounded-xl bg-white/5 border border-white/10">
                                <div class="text-[10px] text-sky-200/70">الوقت الموصى به</div>
                                <div class="text-xs font-bold text-white mt-0.5">45 دقيقة</div>
                            </div>
                            <div class="p-2 rounded-xl bg-white/5 border border-white/10">
                                <div class="text-[10px] text-sky-200/70">وسيلة التنقل</div>
                                <div class="text-xs font-bold text-[#2EC4C9] mt-0.5">مركبة دفع رباعي</div>
                            </div>
                            <div class="p-2 rounded-xl bg-white/5 border border-white/10">
                                <div class="text-[10px] text-sky-200/70">مستوى النشاط</div>
                                <div class="text-xs font-bold text-amber-300 mt-0.5">مريح للجميع</div>
                            </div>
                        </div>

                        <!-- Station Navigation Controls (Prev / Next Buttons) -->
                        <div class="flex items-center justify-between pt-2">
                            <button type="button" id="prevStationBtn" class="px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-bold border border-white/15 transition flex items-center gap-1.5 cursor-pointer">
                                <i class="fa-solid fa-arrow-right"></i>
                                <span>المحطة السابقة</span>
                            </button>

                            <!-- Dot indicators -->
                            <div class="flex items-center gap-1.5">
                                @for($i = 1; $i <= 7; $i++)
                                    <span class="station-dot w-2 h-2 rounded-full {{ $i === 1 ? 'bg-[#2EC4C9] w-5' : 'bg-white/30' }} transition-all"></span>
                                @endfor
                            </div>

                            <button type="button" id="nextStationBtn" class="px-4 py-2 rounded-xl bg-gradient-to-r from-[#2EC4C9] to-[#0E7C86] hover:from-[#2EC4C9] hover:to-[#1F8A5B] text-[#071E2F] text-xs font-black transition flex items-center gap-1.5 cursor-pointer shadow-md">
                                <span>المحطة التالية</span>
                                <i class="fa-solid fa-arrow-left"></i>
                            </button>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
</section>

<!-- ========================================== -->
<!-- 7. SMART TOURISM MAP: الخريطة السياحية الذكية -->
<!-- (إطار زجاجي ثلاثي الأبعاد مع بطاقات وأزرار تصفية ملونة) -->
<!-- ========================================== -->
<section class="py-20 sm:py-32 bg-gradient-to-b from-[#F8FCFD] via-white to-[#F1F9FA] text-[#071E2F] relative overflow-hidden">
    
    <!-- Topographic Contour Lines SVG Watermark -->
    <div class="absolute inset-0 opacity-[0.035] pointer-events-none bg-[radial-gradient(#071E2F_1px,transparent_1px)] [background-size:20px_20px]"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="text-center space-y-3 mb-10 sm:mb-14">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#0E7C86]/10 text-[#0E7C86] text-xs font-bold border border-[#0E7C86]/20">
                <i class="fa-solid fa-map-location text-[#2EC4C9]"></i>
                <span>استكشاف جغرافي تفاعلي حي</span>
            </div>
            <h2 class="text-3xl sm:text-5xl font-black text-[#071E2F] tracking-tight font-display">
                الخريطة السياحية الذكية
            </h2>
            <p class="text-[#071E2F]/75 max-w-2xl mx-auto text-xs sm:text-base leading-relaxed">
                استعرض شبكة الوجهات المتصلة وتعرّف على المعالم القريبة من مسارك في آنٍ واحد مع بيانات الارتفاع والتقييمات.
            </p>
        </div>

        <!-- Filter Pill Chips with Category Colors & Counts -->
        <div class="flex flex-wrap items-center justify-center gap-2.5 mb-8">
            <button type="button" data-map-filter="all" class="map-filter-btn px-4 py-2 rounded-full text-xs font-bold bg-[#071E2F] text-white shadow-md transition transform hover:scale-105 cursor-pointer">
                <span>كل الوجهات</span>
                <span class="inline-block bg-white/20 text-white rounded-full px-2 py-0.2 mr-1.5 text-[10px]">12</span>
            </button>
            <button type="button" data-map-filter="mountains-and-viewpoints" class="map-filter-btn px-4 py-2 rounded-full text-xs font-bold bg-white hover:bg-emerald-50 text-[#071E2F] border border-slate-200 transition transform hover:scale-105 cursor-pointer">
                <i class="fa-solid fa-mountain text-[#1F8A5B] ml-1"></i>
                <span>الجبال والمطلات</span>
                <span class="inline-block bg-emerald-100 text-[#1F8A5B] rounded-full px-2 py-0.2 mr-1.5 text-[10px]">3</span>
            </button>
            <button type="button" data-map-filter="sea-and-islands" class="map-filter-btn px-4 py-2 rounded-full text-xs font-bold bg-white hover:bg-cyan-50 text-[#071E2F] border border-slate-200 transition transform hover:scale-105 cursor-pointer">
                <i class="fa-solid fa-water text-[#06B6D4] ml-1"></i>
                <span>الجزر والشواطئ</span>
                <span class="inline-block bg-cyan-100 text-[#06B6D4] rounded-full px-2 py-0.2 mr-1.5 text-[10px]">3</span>
            </button>
            <button type="button" data-map-filter="adventures-and-valleys" class="map-filter-btn px-4 py-2 rounded-full text-xs font-bold bg-white hover:bg-coral-50 text-[#071E2F] border border-slate-200 transition transform hover:scale-105 cursor-pointer">
                <i class="fa-solid fa-person-hiking text-[#FF7A59] ml-1"></i>
                <span>الأودية والمغامرات</span>
                <span class="inline-block bg-orange-100 text-[#FF7A59] rounded-full px-2 py-0.2 mr-1.5 text-[10px]">3</span>
            </button>
            <button type="button" data-map-filter="coffee-and-farms" class="map-filter-btn px-4 py-2 rounded-full text-xs font-bold bg-white hover:bg-amber-50 text-[#071E2F] border border-slate-200 transition transform hover:scale-105 cursor-pointer">
                <i class="fa-solid fa-mug-hot text-[#F2B84B] ml-1"></i>
                <span>البن والمزارع</span>
                <span class="inline-block bg-amber-100 text-[#D97706] rounded-full px-2 py-0.2 mr-1.5 text-[10px]">2</span>
            </button>
            <button type="button" data-map-filter="heritage-and-forts" class="map-filter-btn px-4 py-2 rounded-full text-xs font-bold bg-white hover:bg-purple-50 text-[#071E2F] border border-slate-200 transition transform hover:scale-105 cursor-pointer">
                <i class="fa-solid fa-landmark text-purple-600 ml-1"></i>
                <span>التراث والحصون</span>
                <span class="inline-block bg-purple-100 text-purple-800 rounded-full px-2 py-0.2 mr-1.5 text-[10px]">1</span>
            </button>
        </div>

        <!-- 3D Perspective Bezel Map Container -->
        <div class="map-3d-frame rounded-3xl p-1.5 bg-gradient-to-r from-[#2EC4C9] via-[#0E7C86] to-[#FF7A59] relative">
            <div class="bg-white/80 backdrop-blur-xl rounded-[22px] overflow-hidden p-1 border border-white/60">
                <div id="homeInteractiveMap" class="w-full h-[450px] sm:h-[550px] rounded-[20px] overflow-hidden z-10"></div>
            </div>
            
            <!-- Map Legend Tag -->
            <div class="absolute bottom-6 right-6 z-20 hidden sm:flex items-center gap-3 bg-[#071E2F]/90 backdrop-blur-md px-4 py-2 rounded-xl border border-white/20 text-white text-xs shadow-lg">
                <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-[#2EC4C9]"></span> نقطة نشطة</span>
                <span class="opacity-30">|</span>
                <span class="text-sky-200/80">انقر على أي نقطة لعرض التفاصيل والمسار</span>
            </div>
        </div>

    </div>
</section>

<!-- ========================================== -->
<!-- 8. SMART TRIP PLANNER: مخطط الرحلات بالذكاء الاصطناعي -->
<!-- (بانر أورورا ليلي عريض مع بطاقات عائمة وزر جاذب متوهج) -->
<!-- ========================================== -->
<section class="py-16 sm:py-24 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    <div class="bg-aurora-glow rounded-3xl p-8 sm:p-14 text-white relative overflow-hidden shadow-2xl border border-white/15">
        
        <!-- Decorative Ambient Blurred Shapes & Neural Grid -->
        <div class="absolute -top-20 -left-20 w-80 h-80 bg-[#2EC4C9]/30 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-20 -right-20 w-80 h-80 bg-[#FF7A59]/30 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute inset-0 opacity-10 pointer-events-none bg-[radial-gradient(white_1px,transparent_1px)] [background-size:24px_24px]"></div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 sm:gap-12 items-center relative z-10">
            
            <!-- Right Column: Pitch & Shimmer CTA -->
            <div class="lg:col-span-7 space-y-5 text-center sm:text-right">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/20 text-[#2EC4C9] text-xs font-bold border border-white/25 backdrop-blur-md">
                    <i class="fa-solid fa-wand-magic-sparkles text-amber-300"></i>
                    <span>مساعدك السياحي الذكي الذاتي</span>
                </div>
                <h2 class="text-3xl sm:text-5xl font-black text-white font-display tracking-tight leading-tight">
                    مخطط الرحلات (AI): صمّم جدول رحلتك في ثوانٍ
                </h2>
                <p class="text-sky-100 text-sm sm:text-base leading-relaxed max-w-xl">
                    حدد عدد أيام إقامتك، اهتماماتك (عائلية، شبابية، استرخاء أو مغامرة)، وسيقوم الذكاء الاصطناعي بإنشاء مسار مخصص بدقة لأجمل محطات جازان مع حساب أوقات القيادة ومواعيد الشمس.
                </p>
                <div class="pt-3">
                    <a href="{{ route('map.index') }}#aiPlanner" class="btn-shimmer-glow inline-flex items-center gap-3 px-8 py-4 rounded-2xl bg-gradient-to-r from-[#2EC4C9] to-[#0E7C86] hover:from-[#2EC4C9] hover:to-[#1F8A5B] text-[#071E2F] font-black text-sm sm:text-base shadow-xl shadow-cyan-950/50 transition transform hover:scale-105">
                        <span>خطط لرحلتك بالذكاء الاصطناعي مجاناً</span>
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                </div>
            </div>

            <!-- Left Column: Floating 3D Itinerary Mini Cards Drifting at Different Depths -->
            <div class="lg:col-span-5 hidden sm:flex flex-col gap-3.5 perspective-1200 preserve-3d">
                
                <!-- Drifting Card 1 -->
                <div class="animate-float-card-a glass-orb bg-white/15 backdrop-blur-xl p-5 rounded-2xl border border-white/30 text-right transform rotate-1 hover:rotate-0 transition duration-300 shadow-xl">
                    <div class="flex items-center justify-between mb-2">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-[#2EC4C9]/25 text-[#2EC4C9] border border-[#2EC4C9]/40">
                            <i class="fa-solid fa-calendar-check text-[9px]"></i> اليوم 1 · مسار القمم
                        </span>
                        <span class="text-[10px] text-amber-300 font-bold font-mono">100% مكتمل</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="w-11 h-11 rounded-xl bg-[#2EC4C9]/25 text-[#2EC4C9] flex items-center justify-center text-xl shrink-0"><i class="fa-solid fa-hotel"></i></span>
                        <div>
                            <h4 class="font-bold text-sm text-white font-display">صعود فيفا وإقامة النزل الريفي</h4>
                            <p class="text-sky-100/70 text-xs mt-0.5">08:00 صعود فيفا · 12:30 مأدبة الغداء · 04:00 مطل الريث</p>
                        </div>
                    </div>
                </div>

                <!-- Drifting Card 2 -->
                <div class="animate-float-card-b glass-orb bg-white/15 backdrop-blur-xl p-5 rounded-2xl border border-white/30 text-right transform -rotate-2 hover:rotate-0 transition duration-300 mr-8 shadow-xl">
                    <div class="flex items-center justify-between mb-2">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-[#F2B84B]/25 text-[#F2B84B] border border-[#F2B84B]/40">
                            <i class="fa-solid fa-water text-[9px]"></i> اليوم 2 · جزر فرسان
                        </span>
                        <span class="text-[10px] text-emerald-300 font-bold font-mono">تأكيد فوري</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="w-11 h-11 rounded-xl bg-[#F2B84B]/25 text-[#F2B84B] flex items-center justify-center text-xl shrink-0"><i class="fa-solid fa-ship"></i></span>
                        <div>
                            <h4 class="font-bold text-sm text-white font-display">إبحار فرسان وسفاري الشعاب</h4>
                            <p class="text-sky-100/70 text-xs mt-0.5">07:00 انطلاق العبارة · 10:00 غوص الشواطئ · 05:00 غروب فرسان</p>
                        </div>
                    </div>
                </div>

                <!-- Floating Neural Chip -->
                <div class="self-start mr-4 px-3 py-1.5 rounded-xl bg-black/40 backdrop-blur-md border border-white/20 text-[11px] text-sky-200 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                    <span>توليد ذكي وموازنة دقيقة بين القيادة والاسترخاء</span>
                </div>

            </div>

        </div>

    </div>
</section>

<!-- ========================================== -->
<!-- 9. AR & 360: الواقع المعزز والجولات الافتراضية -->
<!-- (طبقات صور ثلاثية الأبعاد مع خط مسح ليزري ومدار دوار) -->
<!-- ========================================== -->
<section class="py-20 sm:py-32 bg-white text-[#071E2F] relative overflow-hidden">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 sm:gap-16 items-center">
            
            <!-- Left Column: Layered Images with Laser Scanline in 3D Space -->
            <div class="lg:col-span-6 relative flex items-center justify-center perspective-1200 preserve-3d py-8">
                <!-- Rotating Celestial Orbit Ring -->
                <div class="orbit-ring-360"></div>

                <!-- Overlapping Image 1 (Wadi Lajab) with Laser Scanline -->
                <div class="relative w-64 sm:w-76 h-84 sm:h-96 mask-arch-tall overflow-hidden shadow-2xl border-4 border-white tilt-card z-10">
                    <img src="/images/wadi_lajab.jpg" alt="وادي لجب" class="w-full h-full object-cover">
                    <!-- Laser Scanline -->
                    <div class="ar-scanline"></div>
                </div>

                <!-- Overlapping Image 2 (Coastal Beach) in Front -->
                <div class="absolute -bottom-6 -left-2 sm:left-4 w-48 sm:w-56 h-64 sm:h-72 rounded-3xl overflow-hidden shadow-2xl border-4 border-white tilt-card z-20">
                    <img src="/images/coastal_beach.jpg" alt="شاطئ جازان" class="w-full h-full object-cover">
                </div>

                <!-- Floating 360° Badge -->
                <div class="absolute top-4 -right-2 sm:right-6 z-30 px-4 py-2.5 rounded-2xl bg-[#071E2F] text-white shadow-2xl border border-[#2EC4C9]/40 flex items-center gap-2.5 backdrop-blur-md">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#2EC4C9] animate-ping"></span>
                    <span class="font-black text-xs sm:text-sm font-display tracking-wide">360° جولة حية</span>
                </div>

                <!-- Floating 3D Model Depth Tag -->
                <div class="absolute bottom-4 right-0 z-30 px-3.5 py-2 rounded-xl bg-white/90 text-[#071E2F] shadow-lg border border-slate-200 text-xs font-bold flex items-center gap-2">
                    <i class="fa-solid fa-cube text-[#0E7C86]"></i>
                    <span>مجسم ثلاثي الأبعاد 3D</span>
                </div>
            </div>

            <!-- Right Column: Story & Tech Highlights -->
            <div class="lg:col-span-6 space-y-6 text-right">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#0E7C86]/10 text-[#0E7C86] text-xs font-bold border border-[#0E7C86]/20">
                    <i class="fa-solid fa-glasses text-[#FF7A59]"></i>
                    <span>تقنيات المستقبل السياحي</span>
                </div>
                <h2 class="text-3xl sm:text-5xl font-black text-[#071E2F] tracking-tight font-display">
                    الواقع المعزز (AR) والجولات الافتراضية 360°
                </h2>
                <p class="text-[#071E2F]/80 text-sm sm:text-base leading-relaxed">
                    عندما يصل السائح إلى قرية أو حصن أثري، يوجّه كاميرا الهاتف فتظهر مجسمات ومعلومات ثلاثية الأبعاد تحكي تاريخ الموقع وتفاصيل عمارته الأصيلة. كما يمكن للمسافر استكشاف الوجهات افتراضياً قبل بدء الرحلة.
                </p>
                <div class="flex flex-wrap items-center gap-3 pt-2">
                    <span class="px-4 py-2.5 rounded-xl bg-sky-50 border border-sky-100 text-xs font-bold text-[#071E2F] shadow-xs flex items-center gap-2">
                        <i class="fa-solid fa-street-view text-[#2EC4C9]"></i> جولات افتراضية 360°
                    </span>
                    <span class="px-4 py-2.5 rounded-xl bg-emerald-50 border border-emerald-100 text-xs font-bold text-[#071E2F] shadow-xs flex items-center gap-2">
                        <i class="fa-solid fa-cube text-[#1F8A5B]"></i> مجسمات تفاعلية
                    </span>
                    <span class="px-4 py-2.5 rounded-xl bg-amber-50 border border-amber-100 text-xs font-bold text-[#071E2F] shadow-xs flex items-center gap-2">
                        <i class="fa-solid fa-route text-[#F2B84B]"></i> إرشاد صوتي مكاني
                    </span>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ========================================== -->
<!-- 10. FAQ: أسئلة كل سائح... وإجابة واحدة -->
<!-- (أكورديون تحريري فاخر بعمودين مع شارات تصنيف ملونة) -->
<!-- ========================================== -->
<section id="faqSection" class="py-20 sm:py-32 bg-[#F8FCFD] text-[#071E2F] relative overflow-hidden">
    
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="text-center space-y-3 mb-16 sm:mb-20">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#0E7C86]/10 text-[#0E7C86] text-xs font-bold border border-[#0E7C86]/20">
                <i class="fa-solid fa-circle-question text-[#2EC4C9]"></i>
                <span>إجابات وافية لتخطيط رحلتك في جازان</span>
            </div>
            <h2 class="text-3xl sm:text-5xl font-black text-[#071E2F] tracking-tight font-display">
                أسئلة كل سائح... وإجابة واحدة
            </h2>
            <p class="text-[#071E2F]/75 max-w-2xl mx-auto text-xs sm:text-base leading-relaxed">
                رغم تنوع المقومات الطبيعية والتراثية في جازان، جمعنا لك إجابات دقيقة لأهم 12 تساؤلاً من خبراء منصة «مَطَلّ»:
            </p>
        </div>

        <!-- 12 FAQ Accordions Grid (2 Columns of 6) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-5 text-right">
            
            <!-- FAQ 1 -->
            <div class="faq-accordion-item is-open bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
                <button type="button" class="faq-accordion-trigger w-full p-5 sm:p-6 text-right flex items-center justify-between gap-4 font-bold text-[#071E2F] cursor-pointer select-none group" aria-expanded="true">
                    <div class="space-y-1">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-cyan-50 text-[#0E7C86] border border-cyan-100">
                            <i class="fa-solid fa-compass text-[9px]"></i> الوجهات والمسارات
                        </span>
                        <div class="font-display text-sm sm:text-base font-bold text-[#071E2F] group-hover:text-[#0E7C86] transition">
                            أين يذهب السائح في جازان؟
                        </div>
                    </div>
                    <div class="faq-accordion-chevron w-9 h-9 rounded-full bg-sky-50 text-[#0E7C86] flex items-center justify-center shrink-0 shadow-2xs group-hover:bg-[#0E7C86] group-hover:text-white transition-all duration-300">
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </div>
                </button>
                <div class="faq-accordion-body">
                    <div class="faq-accordion-inner">
                        <div class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-[#071E2F]/80 leading-relaxed border-t border-slate-100 pt-4 bg-gradient-to-b from-sky-50/20 to-white">
                            تتنوع الخيارات بين شواطئ وجزر فرسان الفيروزية، قمم ومطلات جبال فيفا والداير وهروب، أودية وشلالات وادي لجب، وقرى التراث كقرية العشة. توفر منصة «مَطَلّ» مسارات متسلسلة تجمع كل منطقة في خطة واحدة.
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="faq-accordion-item bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
                <button type="button" class="faq-accordion-trigger w-full p-5 sm:p-6 text-right flex items-center justify-between gap-4 font-bold text-[#071E2F] cursor-pointer select-none group" aria-expanded="false">
                    <div class="space-y-1">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-sky-50 text-sky-800 border border-sky-100">
                            <i class="fa-solid fa-route text-[9px]"></i> القرب الجغرافي
                        </span>
                        <div class="font-display text-sm sm:text-base font-bold text-[#071E2F] group-hover:text-[#0E7C86] transition">
                            ما أفضل الأماكن القريبة من بعضها؟
                        </div>
                    </div>
                    <div class="faq-accordion-chevron w-9 h-9 rounded-full bg-sky-50 text-[#0E7C86] flex items-center justify-center shrink-0 shadow-2xs group-hover:bg-[#0E7C86] group-hover:text-white transition-all duration-300">
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </div>
                </button>
                <div class="faq-accordion-body">
                    <div class="faq-accordion-inner">
                        <div class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-[#071E2F]/80 leading-relaxed border-t border-slate-100 pt-4 bg-gradient-to-b from-sky-50/20 to-white">
                            تربط «مَطَلّ» المواقع المتجاورة جغرافياً تلقائياً؛ فمثلاً يربط "مسار الجبال والمطلات" قمم فيفا والداير ومطل الريث، بينما يربط "المسار الساحلي" كورنيش جازان بميناء رحلات فرسان وجزيرة أحبار.
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="faq-accordion-item bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
                <button type="button" class="faq-accordion-trigger w-full p-5 sm:p-6 text-right flex items-center justify-between gap-4 font-bold text-[#071E2F] cursor-pointer select-none group" aria-expanded="false">
                    <div class="space-y-1">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-teal-50 text-teal-800 border border-teal-100">
                            <i class="fa-solid fa-wand-magic-sparkles text-[9px]"></i> الذكاء الاصطناعي
                        </span>
                        <div class="font-display text-sm sm:text-base font-bold text-[#071E2F] group-hover:text-[#0E7C86] transition">
                            كيف يرتب رحلته ووقته دون تشتت؟
                        </div>
                    </div>
                    <div class="faq-accordion-chevron w-9 h-9 rounded-full bg-sky-50 text-[#0E7C86] flex items-center justify-center shrink-0 shadow-2xs group-hover:bg-[#0E7C86] group-hover:text-white transition-all duration-300">
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </div>
                </button>
                <div class="faq-accordion-body">
                    <div class="faq-accordion-inner">
                        <div class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-[#071E2F]/80 leading-relaxed border-t border-slate-100 pt-4 bg-gradient-to-b from-sky-50/20 to-white">
                            عبر ميزة "مخطط الرحلات بالذكاء الاصطناعي (AI)" في مَطَلّ؛ يكفي تحديد عدد الأيام وطبيعة المسافرين (عائلة، شباب، أصدقاء) ليتم توليد جدول زمني يومي كامل بالمحطات وأوقات القيادة.
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="faq-accordion-item bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
                <button type="button" class="faq-accordion-trigger w-full p-5 sm:p-6 text-right flex items-center justify-between gap-4 font-bold text-[#071E2F] cursor-pointer select-none group" aria-expanded="false">
                    <div class="space-y-1">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-100">
                            <i class="fa-solid fa-people-roof text-[9px]"></i> العائلات والأطفال
                        </span>
                        <div class="font-display text-sm sm:text-base font-bold text-[#071E2F] group-hover:text-[#0E7C86] transition">
                            ما الأماكن والمسارات المناسبة للعائلات والأطفال؟
                        </div>
                    </div>
                    <div class="faq-accordion-chevron w-9 h-9 rounded-full bg-sky-50 text-[#0E7C86] flex items-center justify-center shrink-0 shadow-2xs group-hover:bg-[#0E7C86] group-hover:text-white transition-all duration-300">
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </div>
                </button>
                <div class="faq-accordion-body">
                    <div class="faq-accordion-inner">
                        <div class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-[#071E2F]/80 leading-relaxed border-t border-slate-100 pt-4 bg-gradient-to-b from-sky-50/20 to-white">
                            "المسار العائلي الترفيهي" والواجهات البحرية بكورنيش جازان الشمالي والجنوبي، إضافة للمنتجعات الريفية في فيفا المزودة بجلسات عائلية مريحة وخدمات متكاملة.
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ 5 -->
            <div class="faq-accordion-item bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
                <button type="button" class="faq-accordion-trigger w-full p-5 sm:p-6 text-right flex items-center justify-between gap-4 font-bold text-[#071E2F] cursor-pointer select-none group" aria-expanded="false">
                    <div class="space-y-1">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-800 border border-amber-100">
                            <i class="fa-solid fa-triangle-exclamation text-[9px]"></i> المغامرات والطقس
                        </span>
                        <div class="font-display text-sm sm:text-base font-bold text-[#071E2F] group-hover:text-[#0E7C86] transition">
                            هل زيارة وادي لجب آمنة للجميع؟
                        </div>
                    </div>
                    <div class="faq-accordion-chevron w-9 h-9 rounded-full bg-sky-50 text-[#0E7C86] flex items-center justify-center shrink-0 shadow-2xs group-hover:bg-[#0E7C86] group-hover:text-white transition-all duration-300">
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </div>
                </button>
                <div class="faq-accordion-body">
                    <div class="faq-accordion-inner">
                        <div class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-[#071E2F]/80 leading-relaxed border-t border-slate-100 pt-4 bg-gradient-to-b from-sky-50/20 to-white">
                            وادي لجب مناسب لمحبي المغامرات، وتؤكد المنصة على أهمية مرافقة مرشد محلي مرخص ومتابعة تنبيهات الطقس وتجنب الدخول أثناء هطول الأمطار وجريان السيول.
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ 6 -->
            <div class="faq-accordion-item bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
                <button type="button" class="faq-accordion-trigger w-full p-5 sm:p-6 text-right flex items-center justify-between gap-4 font-bold text-[#071E2F] cursor-pointer select-none group" aria-expanded="false">
                    <div class="space-y-1">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-orange-50 text-orange-800 border border-orange-100">
                            <i class="fa-solid fa-coins text-[9px]"></i> التكاليف والميزانية
                        </span>
                        <div class="font-display text-sm sm:text-base font-bold text-[#071E2F] group-hover:text-[#0E7C86] transition">
                            كم تكلفة الرحلة المتوقعة وكيف يحسب ميزانيته؟
                        </div>
                    </div>
                    <div class="faq-accordion-chevron w-9 h-9 rounded-full bg-sky-50 text-[#0E7C86] flex items-center justify-center shrink-0 shadow-2xs group-hover:bg-[#0E7C86] group-hover:text-white transition-all duration-300">
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </div>
                </button>
                <div class="faq-accordion-body">
                    <div class="faq-accordion-inner">
                        <div class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-[#071E2F]/80 leading-relaxed border-t border-slate-100 pt-4 bg-gradient-to-b from-sky-50/20 to-white">
                            تتيح مَطَلّ حاسبة ميزانية تفاعلية فورية تحسب تكاليف الإقامة، النقل، رسوم الجولات البحرية، والأنشطة بحسب عدد الأفراد مع باقات اقتصادية وVIP.
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ 7 -->
            <div class="faq-accordion-item bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
                <button type="button" class="faq-accordion-trigger w-full p-5 sm:p-6 text-right flex items-center justify-between gap-4 font-bold text-[#071E2F] cursor-pointer select-none group" aria-expanded="false">
                    <div class="space-y-1">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-sky-50 text-sky-800 border border-sky-100">
                            <i class="fa-solid fa-cloud-sun text-[9px]"></i> أفضل أوقات الزيارة
                        </span>
                        <div class="font-display text-sm sm:text-base font-bold text-[#071E2F] group-hover:text-[#0E7C86] transition">
                            ما أفضل وقت لزيارة جازان؟
                        </div>
                    </div>
                    <div class="faq-accordion-chevron w-9 h-9 rounded-full bg-sky-50 text-[#0E7C86] flex items-center justify-center shrink-0 shadow-2xs group-hover:bg-[#0E7C86] group-hover:text-white transition-all duration-300">
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </div>
                </button>
                <div class="faq-accordion-body">
                    <div class="faq-accordion-inner">
                        <div class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-[#071E2F]/80 leading-relaxed border-t border-slate-100 pt-4 bg-gradient-to-b from-sky-50/20 to-white">
                            تعد الفترة من نوفمبر إلى إبريل الأروع للمناطق الساحلية وجزر فرسان لأجوائها المعتدلة، بينما تظل المرتفعات الجبلية (فيفا والداير) وجهة صيفية باردة عليلة طوال العام.
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ 8 -->
            <div class="faq-accordion-item bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
                <button type="button" class="faq-accordion-trigger w-full p-5 sm:p-6 text-right flex items-center justify-between gap-4 font-bold text-[#071E2F] cursor-pointer select-none group" aria-expanded="false">
                    <div class="space-y-1">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-800 border border-indigo-100">
                            <i class="fa-solid fa-car-side text-[9px]"></i> المواصلات والتنقل
                        </span>
                        <div class="font-display text-sm sm:text-base font-bold text-[#071E2F] group-hover:text-[#0E7C86] transition">
                            كيف يتنقل السائح في المرتفعات والجبال؟
                        </div>
                    </div>
                    <div class="faq-accordion-chevron w-9 h-9 rounded-full bg-sky-50 text-[#0E7C86] flex items-center justify-center shrink-0 shadow-2xs group-hover:bg-[#0E7C86] group-hover:text-white transition-all duration-300">
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </div>
                </button>
                <div class="faq-accordion-body">
                    <div class="faq-accordion-inner">
                        <div class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-[#071E2F]/80 leading-relaxed border-t border-slate-100 pt-4 bg-gradient-to-b from-sky-50/20 to-white">
                            يُفضل استخدام سيارات الدفع الرباعي في قمم فيفا والريث، وتوفر منصة مَطَلّ خدمة حجز سائقين محليين محترفين يعرفون تضاريس الطرق وأفضل المطلات السرية.
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ 9 -->
            <div class="faq-accordion-item bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
                <button type="button" class="faq-accordion-trigger w-full p-5 sm:p-6 text-right flex items-center justify-between gap-4 font-bold text-[#071E2F] cursor-pointer select-none group" aria-expanded="false">
                    <div class="space-y-1">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-800 border border-amber-100">
                            <i class="fa-solid fa-mug-saucer text-[9px]"></i> البن الخولاني والتسوق
                        </span>
                        <div class="font-display text-sm sm:text-base font-bold text-[#071E2F] group-hover:text-[#0E7C86] transition">
                            أين يجد أجود أنواع البن الخولاني الأصيل؟
                        </div>
                    </div>
                    <div class="faq-accordion-chevron w-9 h-9 rounded-full bg-sky-50 text-[#0E7C86] flex items-center justify-center shrink-0 shadow-2xs group-hover:bg-[#0E7C86] group-hover:text-white transition-all duration-300">
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </div>
                </button>
                <div class="faq-accordion-body">
                    <div class="faq-accordion-inner">
                        <div class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-[#071E2F]/80 leading-relaxed border-t border-slate-100 pt-4 bg-gradient-to-b from-sky-50/20 to-white">
                            مباشرة من مزارع الداير وفيفا المعتمدة الشريكة في المنصة، أو عبر مهرجان البن الدولي السنوي، وتتيح «مَطَلّ» شراء محاصيل موثقة ومطابقة لمعايير الهيئة.
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ 10 -->
            <div class="faq-accordion-item bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
                <button type="button" class="faq-accordion-trigger w-full p-5 sm:p-6 text-right flex items-center justify-between gap-4 font-bold text-[#071E2F] cursor-pointer select-none group" aria-expanded="false">
                    <div class="space-y-1">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-100">
                            <i class="fa-solid fa-bed text-[9px]"></i> الفنادق والنزل
                        </span>
                        <div class="font-display text-sm sm:text-base font-bold text-[#071E2F] group-hover:text-[#0E7C86] transition">
                            هل توجد نزل ريفية وأكواخ معلقة للإقامة؟
                        </div>
                    </div>
                    <div class="faq-accordion-chevron w-9 h-9 rounded-full bg-sky-50 text-[#0E7C86] flex items-center justify-center shrink-0 shadow-2xs group-hover:bg-[#0E7C86] group-hover:text-white transition-all duration-300">
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </div>
                </button>
                <div class="faq-accordion-body">
                    <div class="faq-accordion-inner">
                        <div class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-[#071E2F]/80 leading-relaxed border-t border-slate-100 pt-4 bg-gradient-to-b from-sky-50/20 to-white">
                            نعم، تضم جازان شبكة متنامية من النزل الريفية والأكواخ الخشبية ذات الإطلالات السحابية، بالإضافة إلى فنادق الواجهة البحرية المصنفة 5 نجوم في قلب المدينة.
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ 11 -->
            <div class="faq-accordion-item bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
                <button type="button" class="faq-accordion-trigger w-full p-5 sm:p-6 text-right flex items-center justify-between gap-4 font-bold text-[#071E2F] cursor-pointer select-none group" aria-expanded="false">
                    <div class="space-y-1">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-cyan-50 text-[#0E7C86] border border-cyan-100">
                            <i class="fa-solid fa-credit-card text-[9px]"></i> الحجوزات والدفع
                        </span>
                        <div class="font-display text-sm sm:text-base font-bold text-[#071E2F] group-hover:text-[#0E7C86] transition">
                            كيف يحجز السائح رحلاته وتجاربه في مَطَلّ؟
                        </div>
                    </div>
                    <div class="faq-accordion-chevron w-9 h-9 rounded-full bg-sky-50 text-[#0E7C86] flex items-center justify-center shrink-0 shadow-2xs group-hover:bg-[#0E7C86] group-hover:text-white transition-all duration-300">
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </div>
                </button>
                <div class="faq-accordion-body">
                    <div class="faq-accordion-inner">
                        <div class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-[#071E2F]/80 leading-relaxed border-t border-slate-100 pt-4 bg-gradient-to-b from-sky-50/20 to-white">
                            بخطوات يسيرة: اختر المسار أو الوجهة، حدد تاريخ الزيارة وعدد الأفراد، وأتمم الحجز الآمن عبر وسائل الدفع المعتمدة (مدى، فيزا، ماستركارد، Apple Pay) مع تأكيد فوري عبر الرسائل.
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ 12 -->
            <div class="faq-accordion-item bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
                <button type="button" class="faq-accordion-trigger w-full p-5 sm:p-6 text-right flex items-center justify-between gap-4 font-bold text-[#071E2F] cursor-pointer select-none group" aria-expanded="false">
                    <div class="space-y-1">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-rose-50 text-rose-800 border border-rose-100">
                            <i class="fa-solid fa-handshake text-[9px]"></i> الشراكات والانضمام
                        </span>
                        <div class="font-display text-sm sm:text-base font-bold text-[#071E2F] group-hover:text-[#0E7C86] transition">
                            كيف ينضم المرشدون والمزارعون لمنظومة مَطَلّ؟
                        </div>
                    </div>
                    <div class="faq-accordion-chevron w-9 h-9 rounded-full bg-sky-50 text-[#0E7C86] flex items-center justify-center shrink-0 shadow-2xs group-hover:bg-[#0E7C86] group-hover:text-white transition-all duration-300">
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </div>
                </button>
                <div class="faq-accordion-body">
                    <div class="faq-accordion-inner">
                        <div class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-[#071E2F]/80 leading-relaxed border-t border-slate-100 pt-4 bg-gradient-to-b from-sky-50/20 to-white">
                            عبر بوابة "انضم كشريك"؛ يُسجل مقدم الخدمة (مرشد، صاحب نزل، صاحب مزرعة) بياناته وتراخيصه ليتم اعتماده وتدريبه وإدراج خدماته مباشرة أمام آلاف الزوار.
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- ========================================== -->
<!-- 11. TOURISM IMPACT & STRATEGIC PARTNERS -->
<!-- ========================================== -->
<section id="impactSection" class="py-20 sm:py-28 bg-white text-[#071E2F] relative overflow-hidden border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="text-center space-y-3 mb-16 sm:mb-20">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#0E7C86]/10 text-[#0E7C86] text-xs font-bold border border-[#0E7C86]/20">
                <i class="fa-solid fa-circle-nodes text-[#2EC4C9]"></i>
                <span>منظومة الأثر والتنمية المستدامة</span>
            </div>
            <h2 class="text-3xl sm:text-5xl font-black text-[#071E2F] tracking-tight font-display">
                الأثر المتوقع على سياحة جازان
            </h2>
            <p class="text-[#071E2F]/70 max-w-2xl mx-auto text-xs sm:text-base leading-relaxed">
                قيمة مضافة وحراك تنموي متسلسل يربط رحلة السائح باقتصاد المستثمر وتمكين المجتمع المحلي.
            </p>
        </div>

        <!-- 4 Distinct 3D Editorial Impact Cards Grid (Staggered Arc Layout) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8 text-right perspective-1200 items-start">
            
            <!-- Col 1: للسائح (Aqua / Turquoise) -->
            <div class="tilt-3d lg:translate-y-0 bg-gradient-to-b from-[#2EC4C9]/10 via-white to-white rounded-3xl p-6 sm:p-8 border border-[#2EC4C9]/35 shadow-lg flex flex-col justify-between group hover:border-[#2EC4C9] transition-all duration-300">
                <div class="space-y-4">
                    <div class="w-13 h-13 rounded-2xl glass-orb bg-[#2EC4C9]/20 text-[#0E7C86] flex items-center justify-center text-2xl group-hover:scale-110 transition shadow-sm">
                        <i class="fa-solid fa-person-walking-luggage"></i>
                    </div>
                    <div>
                        <span class="text-[11px] font-bold text-[#0E7C86] uppercase tracking-wider">المستفيد الأول</span>
                        <h3 class="text-xl sm:text-2xl font-black text-[#071E2F] font-display">للسائح</h3>
                    </div>
                    <ul class="space-y-2.5 text-xs sm:text-sm text-[#071E2F]/80 pt-2 border-t border-slate-100">
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#0E7C86]"></i> سهولة التخطيط وتوفير الوقت</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#0E7C86]"></i> معلومات دقيقة وموثوقة</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#0E7C86]"></i> اكتشاف مواقع مميزة وغير شائعة</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#0E7C86]"></i> حجز موثوق ومسارات واضحة</li>
                    </ul>
                </div>
                <div class="mt-6 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-[#0E7C86] bg-cyan-50/50 px-3 py-2 rounded-xl">
                    <span>استكشاف آمن وموثوق</span>
                    <i class="fa-solid fa-shield-halved text-cyan-600"></i>
                </div>
            </div>

            <!-- Col 2: للمستثمر (Emerald) -->
            <div class="tilt-3d lg:-translate-y-4 bg-gradient-to-b from-[#1F8A5B]/10 via-white to-white rounded-3xl p-6 sm:p-8 border border-[#1F8A5B]/35 shadow-lg flex flex-col justify-between group hover:border-[#1F8A5B] transition-all duration-300">
                <div class="space-y-4">
                    <div class="w-13 h-13 rounded-2xl glass-orb bg-[#1F8A5B]/20 text-[#1F8A5B] flex items-center justify-center text-2xl group-hover:scale-110 transition shadow-sm">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <div>
                        <span class="text-[11px] font-bold text-[#1F8A5B] uppercase tracking-wider">قطاع الأعمال</span>
                        <h3 class="text-xl sm:text-2xl font-black text-[#071E2F] font-display">للمستثمر</h3>
                    </div>
                    <ul class="space-y-2.5 text-xs sm:text-sm text-[#071E2F]/80 pt-2 border-t border-slate-100">
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#1F8A5B]"></i> وصول مباشر لشريحة سياح مهتمة</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#1F8A5B]"></i> تسويق مستمر للمرافق والخدمات</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#1F8A5B]"></i> إدارة الحجوزات بسلاسة واحترافية</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#1F8A5B]"></i> إحصاءات تدعم توسع المشاريع</li>
                    </ul>
                </div>
                <div class="mt-6 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-[#1F8A5B] bg-emerald-50/50 px-3 py-2 rounded-xl">
                    <span>تدفق عملاء مستمر</span>
                    <i class="fa-solid fa-arrow-trend-up text-emerald-600"></i>
                </div>
            </div>

            <!-- Col 3: للمجتمع المحلي (Gold) -->
            <div class="tilt-3d lg:-translate-y-8 bg-gradient-to-b from-[#F2B84B]/12 via-white to-white rounded-3xl p-6 sm:p-8 border border-[#F2B84B]/45 shadow-lg flex flex-col justify-between group hover:border-[#F2B84B] transition-all duration-300">
                <div class="space-y-4">
                    <div class="w-13 h-13 rounded-2xl glass-orb bg-[#F2B84B]/20 text-[#D97706] flex items-center justify-center text-2xl group-hover:scale-110 transition shadow-sm">
                        <i class="fa-solid fa-hand-holding-heart"></i>
                    </div>
                    <div>
                        <span class="text-[11px] font-bold text-[#D97706] uppercase tracking-wider">التنمية المستدامة</span>
                        <h3 class="text-xl sm:text-2xl font-black text-[#071E2F] font-display">للمجتمع المحلي</h3>
                    </div>
                    <ul class="space-y-2.5 text-xs sm:text-sm text-[#071E2F]/80 pt-2 border-t border-slate-100">
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#D97706]"></i> فرص عمل للمرشدين والسائقين</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#D97706]"></i> دخل إضافي مستدام للأسر المنتجة</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#D97706]"></i> تسويق منتجات البن والعسل</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#D97706]"></i> إشراك أهالي القرى كشركاء تنمية</li>
                    </ul>
                </div>
                <div class="mt-6 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-[#D97706] bg-amber-50/50 px-3 py-2 rounded-xl">
                    <span>تمكين اقتصادي محلي</span>
                    <i class="fa-solid fa-people-carry-box text-amber-600"></i>
                </div>
            </div>

            <!-- Col 4: للمنطقة (Coral) -->
            <div class="tilt-3d lg:-translate-y-2 bg-gradient-to-b from-[#FF7A59]/10 via-white to-white rounded-3xl p-6 sm:p-8 border border-[#FF7A59]/35 shadow-lg flex flex-col justify-between group hover:border-[#FF7A59] transition-all duration-300">
                <div class="space-y-4">
                    <div class="w-13 h-13 rounded-2xl glass-orb bg-[#FF7A59]/20 text-[#FF7A59] flex items-center justify-center text-2xl group-hover:scale-110 transition shadow-sm">
                        <i class="fa-solid fa-earth-americas"></i>
                    </div>
                    <div>
                        <span class="text-[11px] font-bold text-[#FF7A59] uppercase tracking-wider">الرؤية الوطنية</span>
                        <h3 class="text-xl sm:text-2xl font-black text-[#071E2F] font-display">للمنطقة</h3>
                    </div>
                    <ul class="space-y-2.5 text-xs sm:text-sm text-[#071E2F]/80 pt-2 border-t border-slate-100">
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#FF7A59]"></i> زيادة التدفق والحركة السياحية</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#FF7A59]"></i> توزيع الزوار على جميع المحافظات</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#FF7A59]"></i> إطالة مدة إقامة السائح في جازان</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#FF7A59]"></i> إبراز جازان كوجهة طوال العام</li>
                    </ul>
                </div>
                <div class="mt-6 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-[#FF7A59] bg-rose-50/50 px-3 py-2 rounded-xl">
                    <span>تحقيق رؤية 2030</span>
                    <i class="fa-solid fa-award text-rose-500"></i>
                </div>
            </div>

        </div>

        <!-- Strategic Partners Prestige Showcase -->
        <div class="mt-20 sm:mt-28">
            <div class="text-center space-y-3 mb-12">
                <span class="text-xs sm:text-sm font-bold text-[#0E7C86] uppercase tracking-wider bg-sky-50 px-4 py-1.5 rounded-full border border-sky-100">
                    الجهات الحكومية والمنظومة الاستراتيجية
                </span>
                <h3 class="text-2xl sm:text-3xl font-black text-[#071E2F] font-display">شركاؤنا</h3>
            </div>

            <!-- Tier 1: 5 Government Entities (3D Glass Nameplates) -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 mb-12 text-center perspective-1200">
                <div class="tilt-3d p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:border-[#2EC4C9] hover:shadow-md transition">
                    <div class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-700 flex items-center justify-center mx-auto mb-3 text-lg">
                        <i class="fa-solid fa-building-columns"></i>
                    </div>
                    <div class="font-display font-black text-[#071E2F] text-sm sm:text-base">وزارة السياحة</div>
                    <div class="text-[11px] text-slate-500 mt-1 font-medium">شريك استراتيجي</div>
                </div>
                <div class="tilt-3d p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:border-[#2EC4C9] hover:shadow-md transition">
                    <div class="w-10 h-10 rounded-full bg-cyan-50 text-[#0E7C86] flex items-center justify-center mx-auto mb-3 text-lg">
                        <i class="fa-solid fa-compass"></i>
                    </div>
                    <div class="font-display font-black text-[#071E2F] text-sm sm:text-base">هيئة السياحة السعودية</div>
                    <div class="text-[11px] text-slate-500 mt-1 font-medium">الترويج الوطني</div>
                </div>
                <div class="tilt-3d p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:border-[#2EC4C9] hover:shadow-md transition">
                    <div class="w-10 h-10 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center mx-auto mb-3 text-lg">
                        <i class="fa-solid fa-crown"></i>
                    </div>
                    <div class="font-display font-black text-[#071E2F] text-sm sm:text-base">إمارة منطقة جازان</div>
                    <div class="text-[11px] text-slate-500 mt-1 font-medium">الرعاية الكريمة</div>
                </div>
                <div class="tilt-3d p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:border-[#2EC4C9] hover:shadow-md transition">
                    <div class="w-10 h-10 rounded-full bg-sky-50 text-sky-700 flex items-center justify-center mx-auto mb-3 text-lg">
                        <i class="fa-solid fa-city"></i>
                    </div>
                    <div class="font-display font-black text-[#071E2F] text-sm sm:text-base">أمانة منطقة جازان</div>
                    <div class="text-[11px] text-slate-500 mt-1 font-medium">تطوير المرافق</div>
                </div>
                <div class="tilt-3d p-6 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:border-[#2EC4C9] hover:shadow-md transition">
                    <div class="w-10 h-10 rounded-full bg-purple-50 text-purple-700 flex items-center justify-center mx-auto mb-3 text-lg">
                        <i class="fa-solid fa-landmark-dome"></i>
                    </div>
                    <div class="font-display font-black text-[#071E2F] text-sm sm:text-base">هيئة التراث</div>
                    <div class="text-[11px] text-slate-500 mt-1 font-medium">حفظ المعالم</div>
                </div>
            </div>

            <!-- Tier 2: Field Partners Marquee Track (Smooth Infinite Drift) -->
            <div class="marquee-container py-3 relative mb-12 overflow-hidden">
                <div class="marquee-track-rtl flex items-center gap-4 sm:gap-6">
                    @php
                        $fieldPartners = [
                            ['title' => 'أصحاب المزارع', 'desc' => 'مزارع البن والمانجو والفواكه', 'icon' => 'fa-seedling', 'color' => '#1F8A5B'],
                            ['title' => 'أصحاب النزل الريفية', 'desc' => 'أكواخ وسكن فوق السحاب', 'icon' => 'fa-house-chimney-window', 'color' => '#0E7C86'],
                            ['title' => 'المرشدون السياحيون', 'desc' => 'كوادر محلية مرخصة وخبيرة', 'icon' => 'fa-user-tie', 'color' => '#2EC4C9'],
                            ['title' => 'المطاعم والمقاهي', 'desc' => 'ضيافة جازانية ومذاقات القهوة', 'icon' => 'fa-mug-hot', 'color' => '#F2B84B'],
                            ['title' => 'الأسر المنتجة', 'desc' => 'عسل ونباتات عطرية وحرف', 'icon' => 'fa-basket-shopping', 'color' => '#FF7A59'],
                            ['title' => 'أصحاب القوارب', 'desc' => 'رحلات بحرية وغوص فرسان', 'icon' => 'fa-ship', 'color' => '#06B6D4'],
                            ['title' => 'الحرفيون', 'desc' => 'فخار ونسج وعمارة حجرية', 'icon' => 'fa-hammer', 'color' => '#D97706']
                        ];
                    @endphp
                    @foreach($fieldPartners as $fp)
                        <div class="shrink-0 w-64 sm:w-72 bg-white rounded-2xl p-4 sm:p-5 border border-slate-200 shadow-sm flex items-center gap-3.5 text-right hover:border-[#2EC4C9] transition">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl shrink-0" style="background-color: {{ $fp['color'] }}15; color: {{ $fp['color'] }};">
                                <i class="fa-solid {{ $fp['icon'] }}"></i>
                            </div>
                            <div>
                                <h5 class="font-bold text-sm text-[#071E2F] font-display">{{ $fp['title'] }}</h5>
                                <p class="text-[11px] text-slate-500 mt-0.5 leading-snug">{{ $fp['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                    <!-- Duplicate for seamless loop -->
                    @foreach($fieldPartners as $fp)
                        <div class="shrink-0 w-64 sm:w-72 bg-white rounded-2xl p-4 sm:p-5 border border-slate-200 shadow-sm flex items-center gap-3.5 text-right hover:border-[#2EC4C9] transition" aria-hidden="true">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl shrink-0" style="background-color: {{ $fp['color'] }}15; color: {{ $fp['color'] }};">
                                <i class="fa-solid {{ $fp['icon'] }}"></i>
                            </div>
                            <div>
                                <h5 class="font-bold text-sm text-[#071E2F] font-display">{{ $fp['title'] }}</h5>
                                <p class="text-[11px] text-slate-500 mt-0.5 leading-snug">{{ $fp['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Partner CTA Banner (3D Raised Card Look with Seamless Flush Bottom) -->
            <div class="tilt-3d p-6 sm:p-10 rounded-3xl bg-gradient-to-r from-sky-50 via-[#FFF6E8] to-[#CCFBF1] border border-slate-200/90 max-w-4xl mx-auto shadow-md flex flex-col sm:flex-row items-center justify-between gap-6 text-right mb-0">
                <div class="space-y-1.5">
                    <span class="text-xs font-bold text-[#0E7C86] uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fa-solid fa-handshake"></i>
                        <span>دعوة انضمام للشركاء</span>
                    </span>
                    <h4 class="font-display font-black text-lg sm:text-xl text-[#071E2F]">
                        هل أنت صاحب مزرعة، نزل ريفي، أو مرشد سياحي في جازان؟
                    </h4>
                    <p class="text-xs sm:text-sm text-[#071E2F]/70 leading-relaxed max-w-xl">
                        انضم إلى شبكة شركاء «مَطَلّ» المعتمدة، وسوّق خدماتك وتجاربك مباشرة لآلاف السياح والزوار بكل موثوقية واحترافية.
                    </p>
                </div>
                <a href="{{ route('about') }}#contact" class="btn-shimmer-glow shrink-0 px-7 py-3.5 rounded-2xl bg-gradient-to-r from-[#0E7C86] to-[#2EC4C9] hover:from-[#071E2F] hover:to-[#0E7C86] text-white font-bold text-xs sm:text-sm shadow-md transition flex items-center gap-2.5">
                    <span>انضم كشريك الآن</span>
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                </a>
            </div>

        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // 1. Professional FAQ Accordion Interaction
        const faqItems = document.querySelectorAll('.faq-accordion-item');
        faqItems.forEach(item => {
            const trigger = item.querySelector('.faq-accordion-trigger');
            if (!trigger) return;
            
            trigger.addEventListener('click', (e) => {
                e.preventDefault();
                const isOpen = item.classList.contains('is-open');
                
                if (isOpen) {
                    item.classList.remove('is-open');
                    trigger.setAttribute('aria-expanded', 'false');
                } else {
                    item.classList.add('is-open');
                    trigger.setAttribute('aria-expanded', 'true');
                }
            });
        });

        // 2. Mountain Road Journey Stations Controller
        const stationsData = [
            {
                step: 1,
                title: 'مدينة جازان',
                subtitle: 'نقطة الانطلاق والتجهيز',
                desc: 'نقطة الانطلاق والتجمع وتجهيز المركبات والتعريف بالمرشد السياحي ومسار الرحلة اليومية واستلام ضيافة الصباح.',
                icon: 'fa-car',
                time: '07:30 ص',
                elevation: '40 م',
                tag: 'تجهيز وانطلاق',
                image: '/images/jazan_coastal_beach.jpg'
            },
            {
                step: 2,
                title: 'صعود فيفا',
                subtitle: 'عناق السحاب والمدرجات',
                desc: 'عبور الطرق المعلقة الشاهقة والتمتع بظاهرة بحر الضباب ومشاهدة المدرجات الخضراء المصنفة كأعجوبة معمارية زراعية.',
                icon: 'fa-mountain',
                time: '09:00 ص',
                elevation: '1,800 م',
                tag: 'بانوراما وضباب',
                image: '/images/al_dharb_viewpoint.jpg'
            },
            {
                step: 3,
                title: 'مزرعة البن الخولاني',
                subtitle: 'تجربة التراث الزراعي العريق',
                desc: 'جولة حية بين شجيرات البن الخولاني المعمّرة، والتعرف على مراحل الجني والتجفيف، وتذوق فنجان القهوة السعودية الفاخرة.',
                icon: 'fa-mug-hot',
                time: '11:00 ص',
                elevation: '1,650 م',
                tag: 'تذوق وضيافة',
                image: '/images/coffee_terraces.jpg'
            },
            {
                step: 4,
                title: 'الغداء الجازاني',
                subtitle: 'مأدبة شعبية في قلب الطبيعة',
                desc: 'جلسة تقليدية مع مأدبة غداء شعبية حافلة بخيرات المنطقة: سمك المغش، خبز الميفا الحار، والمرق الجبلي المنعش.',
                icon: 'fa-utensils',
                time: '01:30 م',
                elevation: '1,500 م',
                tag: 'مذاقات أصيلة',
                image: '/images/detail_village.jpg'
            },
            {
                step: 5,
                title: 'مطل الريث',
                subtitle: 'وقفة تأمل واستراحة فوق القمم',
                desc: 'وقفة تصوير بانورامية فوق السحاب وتأمل تشكيلات الجبال الشاهقة والتقاط صور تذكارية في أعلى شرفة بالمنطقة.',
                icon: 'fa-camera',
                time: '03:30 م',
                elevation: '2,050 م',
                tag: 'تصوير استثنائي',
                image: '/images/jazan_alreeth_viewpoint.jpg'
            },
            {
                step: 6,
                title: 'وادي لجب',
                subtitle: 'مغامرة الشقوق والصخور المائية',
                desc: 'مغامرة مشي واستكشاف خفيفة بين الشقوق الصخرية الشاهقة، وسماع خرير المياه العذبة والشلالات الجارية.',
                icon: 'fa-person-hiking',
                time: '05:00 م',
                elevation: '650 م',
                tag: 'مغامرة واستكشاف',
                image: '/images/wadi_lajab.jpg'
            },
            {
                step: 7,
                title: 'العودة للمدينة',
                subtitle: 'ختام الرحلة واقتناء الهدايا',
                desc: 'النزول التدريجي نحو جازان محملين بالذكريات والصور الجميلة واقتناء منتجات البن والعسل الطبيعي من المزارعين.',
                icon: 'fa-flag-checkered',
                time: '07:30 م',
                elevation: '40 م',
                tag: 'ذكريات وهدايا',
                image: '/images/sunset_marine.jpg'
            }
        ];

        let currentStationIdx = 0;
        const waypointNodes = document.querySelectorAll('.waypoint-node');
        const stationDots = document.querySelectorAll('.station-dot');
        const summitDisplay = document.getElementById('summitJourneyDisplay');

        function updateStationView(index) {
            currentStationIdx = (index + stationsData.length) % stationsData.length;
            const data = stationsData[currentStationIdx];

            // Update Waypoint Nodes Active State
            waypointNodes.forEach((node, i) => {
                if (i === currentStationIdx) {
                    node.classList.add('is-active', 'ring-2', 'ring-[#2EC4C9]', 'shadow-lg', 'shadow-cyan-500/30');
                } else {
                    node.classList.remove('is-active', 'ring-2', 'ring-[#2EC4C9]', 'shadow-lg', 'shadow-cyan-500/30');
                }
            });

            // Update Dots
            stationDots.forEach((dot, i) => {
                if (i === currentStationIdx) {
                    dot.className = 'station-dot w-5 h-2 rounded-full bg-[#2EC4C9] transition-all';
                } else {
                    dot.className = 'station-dot w-2 h-2 rounded-full bg-white/30 transition-all';
                }
            });

            // Update Card Details
            const imgEl = document.getElementById('summitCardImage');
            const numEl = document.getElementById('summitCardNumber');
            const tagEl = document.getElementById('summitCardTag');
            const timeEl = document.getElementById('summitCardTime');
            const badgeEl = document.getElementById('summitCardBadge');
            const iconEl = document.getElementById('summitCardIcon');
            const elevEl = document.getElementById('summitCardElevation');
            const titleEl = document.getElementById('summitCardTitle');
            const subEl = document.getElementById('summitCardSubtitle');
            const descEl = document.getElementById('summitCardDesc');

            if (imgEl) imgEl.src = data.image;
            if (numEl) numEl.textContent = `0${data.step}`;
            if (tagEl) tagEl.innerHTML = `<i class="fa-solid fa-flag text-[#2EC4C9] ml-1"></i> ${data.tag}`;
            if (timeEl) timeEl.textContent = data.time;
            if (badgeEl) badgeEl.textContent = `المحطة ${data.step} من 7 · مسار جبال جازان`;
            if (iconEl) iconEl.className = `fa-solid ${data.icon}`;
            if (elevEl) elevEl.textContent = `الارتفاع: ${data.elevation}`;
            if (titleEl) titleEl.textContent = data.title;
            if (subEl) subEl.textContent = data.subtitle;
            if (descEl) descEl.textContent = data.desc;

            // Subtle card transition
            if (summitDisplay) {
                summitDisplay.style.transform = 'perspective(1200px) rotateY(-4deg)';
                setTimeout(() => {
                    summitDisplay.style.transform = '';
                }, 250);
            }
        }

        waypointNodes.forEach((node, i) => {
            node.addEventListener('click', () => updateStationView(i));
        });

        const prevBtn = document.getElementById('prevStationBtn');
        const nextBtn = document.getElementById('nextStationBtn');
        if (prevBtn) prevBtn.addEventListener('click', () => updateStationView(currentStationIdx - 1));
        if (nextBtn) nextBtn.addEventListener('click', () => updateStationView(currentStationIdx + 1));

        // Keyboard arrow navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight') {
                updateStationView(currentStationIdx - 1);
            } else if (e.key === 'ArrowLeft') {
                updateStationView(currentStationIdx + 1);
            }
        });

        // 3. Initialize Home Leaflet Map with Category Filtering
        const mapContainer = document.getElementById('homeInteractiveMap');
        if (mapContainer && typeof L !== 'undefined') {
            const map = L.map('homeInteractiveMap', {
                center: [17.15, 42.85],
                zoom: 9,
                scrollWheelZoom: false,
            });

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: '© OpenStreetMap | منصة مَطَلّ'
            }).addTo(map);

            const markersLayer = L.layerGroup().addTo(map);
            let allPoints = [];

            function renderMarkers(filterCategory = 'all') {
                markersLayer.clearLayers();
                const filtered = filterCategory === 'all' 
                    ? allPoints 
                    : allPoints.filter(pt => pt.category_slug === filterCategory);

                filtered.forEach(pt => {
                    const markerColor = pt.category_slug === 'mountains-and-viewpoints' ? '#1F8A5B'
                                      : pt.category_slug === 'sea-and-islands' ? '#06B6D4'
                                      : pt.category_slug === 'adventures-and-valleys' ? '#FF7A59'
                                      : pt.category_slug === 'coffee-and-farms' ? '#F2B84B'
                                      : '#2EC4C9';

                    const marker = L.circleMarker([pt.lat, pt.lng], {
                        radius: 9,
                        fillColor: markerColor,
                        color: '#071E2F',
                        weight: 2.5,
                        opacity: 1,
                        fillOpacity: 0.95
                    }).addTo(markersLayer);

                    const popupHtml = `
                        <div style="direction: rtl; text-align: right; font-family: 'Tajawal', 'Amiri', serif, sans-serif; padding: 4px; max-width: 200px;">
                            <h4 style="margin: 0; color: #071E2F; font-weight: bold; font-size: 14px;">${pt.title}</h4>
                            <div style="color: #0E7C86; font-size: 11px; margin-top: 2px; font-weight: bold;">${pt.region} · ⭐ ${pt.rating}</div>
                            <p style="color: #64748b; font-size: 10px; margin: 4px 0 6px 0;">${pt.tagline || ''}</p>
                            <a href="${pt.url}" style="color: #2EC4C9; font-weight: bold; font-size: 11px; text-decoration: underline; display: inline-block;">عرض التفاصيل والمسار ←</a>
                        </div>
                    `;
                    marker.bindPopup(popupHtml);
                });
            }

            // Fetch API points
            fetch('{{ route("map.points") }}')
                .then(res => res.json())
                .then(res => {
                    if (res.status === 'success' && res.data) {
                        allPoints = res.data;
                        renderMarkers('all');
                    }
                })
                .catch(err => console.error('Map points error:', err));

            // Map Filter Buttons
            const mapFilterButtons = document.querySelectorAll('.map-filter-btn');
            mapFilterButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    const filter = btn.getAttribute('data-map-filter');
                    mapFilterButtons.forEach(b => {
                        b.classList.remove('bg-[#071E2F]', 'text-white', 'shadow-md');
                        b.classList.add('bg-white', 'text-[#071E2F]');
                    });
                    btn.classList.add('bg-[#071E2F]', 'text-white', 'shadow-md');
                    btn.classList.remove('bg-white', 'text-[#071E2F]');
                    renderMarkers(filter);
                });
            });
        }
    });
</script>
@endpush
