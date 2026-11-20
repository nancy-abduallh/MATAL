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

{{-- ===================================================================
     1. STATS · floating 3D glass cards with live counters
     =================================================================== --}}
@php
    $statCards = [
        ['icon' => 'fa-location-dot', 'num' => '500',  'dec' => 0, 'suffix' => '+', 'text' => '500+', 'label' => 'موقع سياحي وطبيعي'],
        ['icon' => 'fa-route',        'num' => '50',   'dec' => 0, 'suffix' => '+', 'text' => '50+',  'label' => 'مسار سياحي متكامل'],
        ['icon' => 'fa-people-group', 'num' => '300',  'dec' => 0, 'suffix' => '+', 'text' => '300+', 'label' => 'مقدم خدمات ومرشد'],
        ['icon' => 'fa-star',         'num' => '4.88', 'dec' => 2, 'suffix' => '',  'text' => '4.88', 'label' => 'تقييم الزوار العام'],
    ];
@endphp
<section class="relative z-20 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 sm:-mt-14 mb-16 sm:mb-24">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6" data-stagger="0.1">
        @foreach($statCards as $s)
            <div class="mg-card mg-reveal mg-reveal-scale group p-5 sm:p-7 text-center bg-white/90 backdrop-blur-xl" data-tilt-max="9">
                <div class="mg-icon-tile mg-pop mx-auto mb-4"><i class="fa-solid {{ $s['icon'] }}"></i></div>
                <div class="mg-stat-num">
                    <span data-counter="{{ $s['num'] }}" data-decimals="{{ $s['dec'] }}" data-suffix="{{ $s['suffix'] }}">{{ $s['text'] }}</span>@if($s['num'] === '4.88')<span class="text-[.55em] mr-1">★</span>@endif
                </div>
                <div class="mt-2 text-xs sm:text-sm font-bold text-[#164E63]/80">{{ $s['label'] }}</div>
            </div>
        @endforeach
    </div>
</section>

{{-- ===================================================================
     2. CATEGORIES · expanding arch gallery (desktop) + snap carousel (mobile)
     =================================================================== --}}
@php
    $cats = [
        ['slug' => 'coastal-beaches',          'name' => 'الساحل',          'sub' => 'شواطئ ومياه صافية',        'title' => 'الساحل',            'text' => 'رمال ذهبية وبحر هادئ ونزهات بحرية ساحرة على مدار العام.',               'img' => '/images/coastal_beach.jpg'],
        ['slug' => 'sea-and-islands',          'name' => 'الجزر',           'sub' => 'أرخبيل فرسان البكر',        'title' => 'الجزر',             'text' => 'أكثر من 80 جزيرة بكر بشعب مرجانية نادرة ومحميات غزلان طبيعية.',          'img' => '/images/farasan_islands.jpg'],
        ['slug' => 'mountains-and-viewpoints', 'name' => 'الجبال',          'sub' => 'قمم ومطلات ضبابية',        'title' => 'الجبال والمطلات',   'text' => 'فيفا والداير وهروب.. قمم خضراء تلامس السحاب بأجواء معتدلة صيفاً.',       'img' => '/images/al_dharb_viewpoint.jpg'],
        ['slug' => 'adventures-and-valleys',   'name' => 'الأودية',         'sub' => 'طبيعة ومجاري مائية',       'title' => 'الأودية والمغامرات', 'text' => 'وادي لجب وشلالات وادي بيش وشقوق صخرية أسطورية للمغامرين.',            'img' => '/images/wadi_lajab.jpg'],
        ['slug' => 'coffee-and-farms',         'name' => 'البن',            'sub' => 'إرث البن الخولاني',        'title' => 'المدرجات والبن',    'text' => 'تذوق أندر أنواع القهوة السعودية في مزارع الأجداد التاريخية.',            'img' => '/images/coffee_terraces.jpg'],
        ['slug' => 'heritage-and-forts',       'name' => 'التراث',          'sub' => 'موروث أصيل وقرى حجرية',    'title' => 'التراث والقرى',     'text' => 'قلاع تاريخية وقرى معمارية فريدة تروي تاريخ أقدم حضارات الجزيرة.',        'img' => '/images/heritage_village.jpg'],
    ];
@endphp
<section class="mg-section mg-bg-white">
    <div class="mg-orb mg-orb-cyan w-96 h-96 -top-32 -right-24" data-speed="0.08"></div>
    <div class="mg-orb mg-orb-sky w-80 h-80 bottom-0 -left-20" data-speed="0.06"></div>
    <div class="mg-wrap">
        <x-mg.section-head eyebrow="تضاريس وطبيعة جازان الخلابة" icon="fa-mountain-sun" title="تنوّع استثنائي في مكان واحد"
            text="الساحل والجزر والجبال والأودية والمدرجات الزراعية والتراث، وهو ما يجعل فكرة المسارات السياحية مناسبة لطبيعة المنطقة." />

        {{-- Desktop: expanding arch panels --}}
        <div class="mg-gallery hidden lg:flex mg-reveal">
            @foreach($cats as $i => $c)
                <a href="{{ route('destinations.index', ['category' => $c['slug']]) }}" class="mg-panel group {{ $i === 0 ? 'is-active' : '' }}" aria-label="{{ $c['title'] }}">
                    <img src="{{ $c['img'] }}" alt="{{ $c['name'] }}" loading="lazy" class="absolute inset-0 w-full h-full object-cover transition-transform duration-[1200ms] group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#072430]/95 via-[#164E63]/35 to-transparent"></div>
                    <div class="mg-collapsed absolute inset-x-0 bottom-8 flex justify-center">
                        <span class="[writing-mode:vertical-rl] rotate-180 text-white font-black text-xl tracking-wide drop-shadow">{{ $c['name'] }}</span>
                    </div>
                    <div class="mg-expanded absolute inset-x-0 bottom-0 p-7 text-right">
                        <span class="mg-badge mg-badge-cyan">{{ $c['sub'] }}</span>
                        <h3 class="mt-3 text-2xl font-black text-white">{{ $c['title'] }}</h3>
                        <p class="mt-2 text-sm text-sky-100/85 leading-relaxed max-w-sm">{{ $c['text'] }}</p>
                        <span class="mt-4 inline-flex items-center gap-2 text-[#38BDF8] font-bold text-sm">استكشف الوجهات <i class="fa-solid fa-arrow-left"></i></span>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Mobile: snap carousel --}}
        <div class="lg:hidden flex gap-4 overflow-x-auto snap-x snap-mandatory no-scrollbar pb-4 -mx-4 px-4">
            @foreach($cats as $c)
                <a href="{{ route('destinations.index', ['category' => $c['slug']]) }}" class="group relative snap-center shrink-0 w-64 h-80 rounded-t-[5rem] rounded-b-3xl overflow-hidden shadow-xl shadow-[#164E63]/25">
                    <img src="{{ $c['img'] }}" alt="{{ $c['name'] }}" loading="lazy" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#072430]/95 via-[#164E63]/30 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-5 text-right">
                        <span class="mg-badge mg-badge-cyan">{{ $c['sub'] }}</span>
                        <h3 class="mt-2 text-xl font-black text-white">{{ $c['title'] }}</h3>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ===================================================================
     3. VALUE PROPS · staggered 3D stepping-stone cards
     =================================================================== --}}
@php
    $values = [
        ['n' => '01', 'icon' => 'fa-calendar-check',    'title' => 'سهولة التخطيط',          'text' => 'جدول زمني متكامل وواضح يوفر وقت وجهد المسافر ويمنع التشتت بين المواقع.'],
        ['n' => '02', 'icon' => 'fa-bullseye',          'title' => 'دقة في الاختيار',        'text' => 'معلومات موثوقة ومحدثة لكل موقع ومسار، مع تفاصيل الأوقات والخدمات المتوفرة.'],
        ['n' => '03', 'icon' => 'fa-handshake-angle',   'title' => 'تجارب أصلية وتفاعلية',   'text' => 'مرشدون محليون، مزارع بن خولاني، ورحلات بحرية فريدة يقودها أهالي جازان.'],
        ['n' => '04', 'icon' => 'fa-location-crosshairs','title' => 'اكتشاف محطات جديدة',    'text' => 'تنبيهات ذكية للمواقع والخدمات القريبة على مسار رحلتك دون تفويت أي متعة.'],
        ['n' => '05', 'icon' => 'fa-shield-heart',      'title' => 'سياحة آمنة',             'text' => 'توجيهات وإرشادات وتنبيهات الطقس وتوافر التغطية ومعلومات السلامة أولاً بأول.'],
    ];
@endphp
<section class="mg-section mg-bg-light mg-grid-pattern">
    <div class="mg-orb mg-orb-cyan w-[28rem] h-[28rem] -top-40 left-1/3" data-speed="0.1"></div>
    <div class="mg-orb mg-orb-deep w-80 h-80 bottom-0 right-0" data-speed="0.07"></div>
    <div class="mg-wrap">
        <x-mg.section-head eyebrow="منصة رقمية موحدة وشاملة" icon="fa-layer-group" title="مَطَلّ يجمع كل ما تحتاجه في رحلة واحدة"
            text="بدل أن تبحث في مصادر متفرقة، يقدم لك مَطَلّ حلولاً متكاملة لتخطيط وتجربة لا تُنسى في كافة أرجاء جازان." />

        <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-5 items-start mg-perspective" data-stagger="0.12">
            @foreach($values as $v)
                <div class="mg-card mg-reveal group p-7 pt-9 lg:even:mt-12 overflow-hidden">
                    <span class="mg-outline-num absolute top-3 left-5 text-6xl">{{ $v['n'] }}</span>
                    <div class="mg-icon-tile mg-pop mb-5"><i class="fa-solid {{ $v['icon'] }}"></i></div>
                    <h3 class="text-lg font-black text-[#164E63] mb-2">{{ $v['title'] }}</h3>
                    <p class="text-sm leading-relaxed text-[#183746]/75">{{ $v['text'] }}</p>
                    <div class="absolute bottom-0 inset-x-0 h-1 bg-gradient-to-r from-[#164E63] via-[#06B6D4] to-[#38BDF8] scale-x-0 group-hover:scale-x-100 origin-right transition-transform duration-500"></div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===================================================================
     4. FEATURED ROUTES · cinematic glass cards
     =================================================================== --}}
@php
    $featured = [
        ['slug' => 'mountains-viewpoints-route', 'img' => '/images/al_dharb_viewpoint.jpg', 'badge' => 'المسار الأيقوني', 'meta' => '3 أيام · 4 محطات',   'rate' => '4.88', 'title' => 'مسار الجبال والمطلات',      'text' => 'استكشف قمم فيفا والداير والريث، وانغمس في أجواء الضباب والمدرجات الزراعية وإطلالات ساحرة فوق السحاب.',        'level' => 'صعوبة المسار: متوسط'],
        ['slug' => 'wadi-lajab-adventure-route', 'img' => '/images/wadi_lajab.jpg',          'badge' => 'مغامرة طبيعية', 'meta' => 'يوم واحد · 3 محطات', 'rate' => '4.90', 'title' => 'مسار المغامرات · وادي لجب',  'text' => 'عش تجربة السير والمشي المائي بين شقوق الصخور الشاهقة، الشلالات المتدفقة، والمياه العذبة في قلب الريث.',       'level' => 'صعوبة المسار: متوسط - متقدم'],
        ['slug' => 'farasan-marine-route',       'img' => '/images/farasan_islands.jpg',     'badge' => 'البحر والجزر',  'meta' => 'يومان · 5 محطات',   'rate' => '4.92', 'title' => 'المسار البحري وجزر فرسان',  'text' => 'إبحار بالعبارات واليخوت، غوص بين الشعب المرجانية الفيروزية، وزيارة قرية القصار وغابات المانجروف الساحرة.',   'level' => 'صعوبة المسار: سهل ومناسب للعائلات'],
    ];
@endphp
<section class="mg-section mg-bg-dark mg-grid-pattern">
    <div class="mg-orb mg-orb-cyan w-[30rem] h-[30rem] -top-32 right-0" data-speed="0.1"></div>
    <div class="mg-orb mg-orb-sky w-96 h-96 bottom-0 -left-20" data-speed="0.08"></div>
    <div class="mg-wrap">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12 sm:mb-16">
            <x-mg.section-head class="!mb-0" align="right" eyebrow="تجارب متكاملة صممت لك" icon="fa-route" title="اكتشف المسارات"
                text="رحلات سياحية متسلسلة تأخذك في قلب الطبيعة وثقافة جازان الأصيلة." />
            <a href="{{ route('routes.index') }}" class="mg-btn-ghost shrink-0 mg-reveal"><span>عرض جميع المسارات</span><i class="fa-solid fa-arrow-left"></i></a>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 mg-perspective" data-stagger="0.15">
            @foreach($featured as $f)
                <article class="mg-card mg-card-glass mg-reveal group flex flex-col overflow-hidden">
                    <div class="mg-photo mg-photo-tint h-64 rounded-t-[1.75rem] rounded-b-none">
                        <img src="{{ $f['img'] }}" alt="{{ $f['title'] }}" loading="lazy">
                        <span class="mg-badge mg-badge-cyan absolute top-4 right-4 z-10">{{ $f['badge'] }}</span>
                        <div class="absolute bottom-4 inset-x-4 z-10 flex items-center justify-between">
                            <span class="mg-badge"><i class="fa-regular fa-clock"></i> {{ $f['meta'] }}</span>
                            <span class="mg-badge"><i class="fa-solid fa-star"></i> {{ $f['rate'] }}</span>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow text-right">
                        <h3 class="text-xl font-black text-white mb-3">{{ $f['title'] }}</h3>
                        <p class="text-sm text-sky-100/80 leading-relaxed mb-6 flex-grow">{{ $f['text'] }}</p>
                        <div class="flex items-center justify-between gap-3 pt-4 border-t border-white/15">
                            <span class="text-xs text-sky-200/80 font-semibold">{{ $f['level'] }}</span>
                            <a href="{{ route('routes.show', $f['slug']) }}" class="inline-flex items-center gap-2 text-[#38BDF8] hover:text-white font-bold text-sm transition shrink-0">
                                <span>تفاصيل المسار</span><i class="fa-solid fa-arrow-left transition group-hover:-translate-x-1.5"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- ===================================================================
     5. SIX ROUTES · asymmetric bento mosaic
     =================================================================== --}}
@php
    $bento = [
        ['slug' => 'mountains-viewpoints-route', 'img' => '/images/al_dharb_viewpoint.jpg', 'tag' => '01 · المسار الأيقوني', 'title' => 'مسار الجبال والمطلات',      'text' => 'قمم فيفا، مطلات الداير، ومطل الريث البانورامي فوق السحاب.',               'rate' => '4.88', 'span' => 'lg:col-span-7'],
        ['slug' => 'saudi-coffee-route',         'img' => '/images/coffee_terraces.jpg',    'tag' => '02 · إرث أصيل',        'title' => 'مسار البن السعودي الخولاني', 'text' => 'مزارع البن في جبال الداير، حصاد الحبوب، وتجربة تحميص القهوة الأصلية.',  'rate' => '4.95', 'span' => 'lg:col-span-5'],
        ['slug' => 'heritage-and-culture-route', 'img' => '/images/heritage_village.jpg',   'tag' => '03 · تاريخ وتراث',     'title' => 'المسار التراثي والثقافي',    'text' => 'القرية التراثية، القلاع التاريخية، ومهرجانات الفنون الشعبية.',           'rate' => null,   'span' => 'lg:col-span-5'],
        ['slug' => 'farasan-marine-route',       'img' => '/images/farasan_islands.jpg',    'tag' => '04 · سحر الجزر',       'title' => 'المسار البحري وجزر فرسان',   'text' => 'رحلات الغوص، شواطئ فرسان البكر، ومحميات الحياة الفطرية.',                'rate' => null,   'span' => 'lg:col-span-7'],
        ['slug' => 'wadi-lajab-adventure-route', 'img' => '/images/wadi_lajab.jpg',         'tag' => '05 · تشويق ومياه',     'title' => 'مسار المغامرات · وادي لجب',  'text' => 'شقوق صخرية شاهقة وشلالات مائية وتحديات المسير الجبلي.',                  'rate' => null,   'span' => 'lg:col-span-6'],
        ['slug' => 'family-entertainment-route', 'img' => '/images/scenic_beach.jpg',       'tag' => '06 · للعائلة',         'title' => 'المسار العائلي الترفيهي',    'text' => 'كورنيش جازان والواجهات البحرية وأنشطة تناسب جميع أفراد الأسرة.',         'rate' => null,   'span' => 'lg:col-span-6'],
    ];
@endphp
<section class="mg-section mg-bg-white">
    <div class="mg-orb mg-orb-cyan w-96 h-96 top-20 -left-24" data-speed="0.08"></div>
    <div class="mg-wrap">
        <x-mg.section-head eyebrow="تنوع الخيارات لتناسب جميع الأذواق" icon="fa-table-cells-large" title="ستة مسارات لكل مسافر"
            text="سواء كنت تبحث عن المغامرة، الاستجمام الساحلي، الثقافة، أو مذاق القهوة الخولانية، صممنا لك مساراً يليق بك." />

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 mg-perspective" data-stagger="0.1">
            @foreach($bento as $b)
                <a href="{{ route('routes.show', $b['slug']) }}" class="mg-card mg-reveal group {{ $b['span'] }} min-h-[18rem] sm:min-h-[22rem] overflow-hidden block">
                    <div class="mg-photo mg-photo-tint absolute inset-0 rounded-[1.75rem]">
                        <img src="{{ $b['img'] }}" alt="{{ $b['title'] }}" loading="lazy">
                    </div>
                    <span class="mg-badge mg-badge-cyan absolute top-5 right-5 z-10">{{ $b['tag'] }}</span>
                    @if($b['rate'])
                        <span class="mg-badge absolute top-5 left-5 z-10"><i class="fa-solid fa-star"></i> {{ $b['rate'] }}</span>
                    @endif
                    <div class="absolute inset-x-0 bottom-0 p-6 sm:p-8 text-right z-10">
                        <h3 class="text-xl sm:text-2xl font-black text-white mb-2">{{ $b['title'] }}</h3>
                        <p class="text-sm text-sky-100/85 leading-relaxed max-w-md mb-4">{{ $b['text'] }}</p>
                        <span class="inline-flex items-center gap-2 text-[#38BDF8] font-bold text-sm">استكشف المسار ومحطاته <i class="fa-solid fa-arrow-left transition group-hover:-translate-x-2"></i></span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ===================================================================
     6. INTEGRATED JOURNEY · interactive 7-station mountain road
     =================================================================== --}}
@php
    $stations = [
        ['step' => 1, 'title' => 'مدينة جازان',          'subtitle' => 'نقطة الانطلاق والتجهيز',        'desc' => 'نقطة الانطلاق والتجمع وتجهيز المركبات والتعريف بالمرشد السياحي ومسار الرحلة اليومية واستلام ضيافة الصباح.',                    'icon' => 'fa-car',            'time' => '07:30 ص', 'elevation' => '40 م',    'tag' => 'تجهيز وانطلاق',   'image' => '/images/jazan_coastal_beach.jpg'],
        ['step' => 2, 'title' => 'صعود فيفا',            'subtitle' => 'عناق السحاب والمدرجات',         'desc' => 'عبور الطرق المعلقة الشاهقة والتمتع بظاهرة بحر الضباب ومشاهدة المدرجات الخضراء المصنفة كأعجوبة معمارية زراعية.',               'icon' => 'fa-mountain',       'time' => '09:00 ص', 'elevation' => '1,800 م', 'tag' => 'بانوراما وضباب',  'image' => '/images/al_dharb_viewpoint.jpg'],
        ['step' => 3, 'title' => 'مزرعة البن الخولاني',  'subtitle' => 'تجربة التراث الزراعي العريق',   'desc' => 'جولة حية بين شجيرات البن الخولاني المعمّرة، والتعرف على مراحل الجني والتجفيف، وتذوق فنجان القهوة السعودية الفاخرة.',          'icon' => 'fa-mug-hot',        'time' => '11:00 ص', 'elevation' => '1,650 م', 'tag' => 'تذوق وضيافة',     'image' => '/images/coffee_terraces.jpg'],
        ['step' => 4, 'title' => 'الغداء الجازاني',      'subtitle' => 'مأدبة شعبية في قلب الطبيعة',    'desc' => 'جلسة تقليدية مع مأدبة غداء شعبية حافلة بخيرات المنطقة: سمك المغش، خبز الميفا الحار، والمرق الجبلي المنعش.',                    'icon' => 'fa-utensils',       'time' => '01:30 م', 'elevation' => '1,500 م', 'tag' => 'مذاقات أصيلة',    'image' => '/images/detail_village.jpg'],
        ['step' => 5, 'title' => 'مطل الريث',            'subtitle' => 'وقفة تأمل واستراحة فوق القمم',  'desc' => 'وقفة تصوير بانورامية فوق السحاب وتأمل تشكيلات الجبال الشاهقة والتقاط صور تذكارية في أعلى شرفة بالمنطقة.',                      'icon' => 'fa-camera',         'time' => '03:30 م', 'elevation' => '2,050 م', 'tag' => 'تصوير استثنائي',  'image' => '/images/jazan_alreeth_viewpoint.jpg'],
        ['step' => 6, 'title' => 'وادي لجب',             'subtitle' => 'مغامرة الشقوق والصخور المائية', 'desc' => 'مغامرة مشي واستكشاف خفيفة بين الشقوق الصخرية الشاهقة، وسماع خرير المياه العذبة والشلالات الجارية.',                            'icon' => 'fa-person-hiking',  'time' => '05:00 م', 'elevation' => '650 م',   'tag' => 'مغامرة واستكشاف', 'image' => '/images/wadi_lajab.jpg'],
        ['step' => 7, 'title' => 'العودة للمدينة',       'subtitle' => 'ختام الرحلة واقتناء الهدايا',   'desc' => 'النزول التدريجي نحو جازان محملين بالذكريات والصور الجميلة واقتناء منتجات البن والعسل الطبيعي من المزارعين.',                    'icon' => 'fa-flag-checkered', 'time' => '07:30 م', 'elevation' => '40 م',    'tag' => 'ذكريات وهدايا',   'image' => '/images/sunset_marine.jpg'],
    ];
    $st0 = $stations[0];
@endphp
<section id="journey" class="mg-section mg-bg-dark mg-grid-pattern">
    <div class="mg-orb mg-orb-cyan w-[32rem] h-[32rem] -top-40 -right-20" data-speed="0.1"></div>
    <div class="mg-orb mg-orb-sky w-96 h-96 bottom-10 -left-24" data-speed="0.08"></div>
    <div class="mg-wrap">
        <x-mg.section-head eyebrow="نموذج رحلة متكاملة · مسار القمم والمطلات" icon="fa-mountain" title="مسار جبال جازان: الرحلة في 7 محطات"
            text="انقر على أي محطة لاستكشاف برنامجها، تفاصيل التوقف، والمذاق الأصيل المعدّ لك من الصباح حتى المساء." />

        {{-- Road + stations --}}
        <div class="relative mb-10 mg-reveal">
            <svg class="hidden lg:block absolute inset-x-0 top-7 w-full h-14 pointer-events-none" viewBox="0 0 1200 60" preserveAspectRatio="none" fill="none" aria-hidden="true">
                <path d="M 0,30 Q 150,5 300,30 T 600,30 T 900,30 T 1200,30" stroke="rgba(255,255,255,.14)" stroke-width="4"/>
                <path class="mg-road" d="M 0,30 Q 150,5 300,30 T 600,30 T 900,30 T 1200,30" stroke="url(#mgRoad)" stroke-width="4"/>
                <defs>
                    <linearGradient id="mgRoad" x1="0" y1="0" x2="1" y2="0">
                        <stop offset="0" stop-color="#164E63"/><stop offset=".5" stop-color="#06B6D4"/><stop offset="1" stop-color="#38BDF8"/>
                    </linearGradient>
                </defs>
            </svg>
            <div class="relative grid grid-cols-4 sm:grid-cols-7 gap-2 sm:gap-3">
                @foreach($stations as $i => $st)
                    <button type="button" data-station="{{ $i }}" aria-label="{{ $st['title'] }}"
                            class="mg-station mg-card-glass rounded-2xl p-2.5 sm:p-3 text-center cursor-pointer {{ $i === 0 ? 'is-active' : '' }}">
                        <div class="w-9 h-9 sm:w-11 sm:h-11 mx-auto mb-2 rounded-full bg-white/10 flex items-center justify-center text-sm sm:text-base"><i class="fa-solid {{ $st['icon'] }}"></i></div>
                        <div class="text-[10px] font-black opacity-70">0{{ $st['step'] }}</div>
                        <div class="text-[11px] sm:text-xs font-bold leading-tight mt-0.5 line-clamp-2">{{ $st['title'] }}</div>
                        <div class="hidden sm:block text-[10px] opacity-70 mt-1">{{ $st['time'] }}</div>
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Detail card --}}
        <div class="max-w-5xl mx-auto mg-perspective mg-reveal mg-reveal-scale">
            <div id="stCard" class="rounded-[2rem] p-1 bg-gradient-to-r from-[#164E63] via-[#06B6D4] to-[#38BDF8] shadow-2xl shadow-[#06B6D4]/20" style="transition: transform .5s cubic-bezier(.16,1,.3,1);">
                <div class="rounded-[1.85rem] overflow-hidden grid md:grid-cols-2 bg-[#072430] text-white">
                    <div class="relative min-h-[17rem] md:min-h-[26rem] overflow-hidden">
                        <img id="stImg" src="{{ $st0['image'] }}" alt="{{ $st0['title'] }}" class="absolute inset-0 w-full h-full object-cover transition-opacity duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#072430] via-[#072430]/30 to-transparent"></div>
                        <div id="stNum" class="mg-outline-num absolute top-4 right-5 text-8xl">01</div>
                        <div class="absolute bottom-4 inset-x-4 flex items-center justify-between">
                            <span class="mg-badge mg-badge-cyan"><i class="fa-solid fa-tag"></i><span id="stTag">{{ $st0['tag'] }}</span></span>
                            <span id="stTime" class="mg-badge">{{ $st0['time'] }}</span>
                        </div>
                    </div>
                    <div class="p-6 sm:p-9 flex flex-col text-right">
                        <div class="flex flex-wrap items-center justify-between gap-2 mb-5">
                            <span class="mg-eyebrow"><i id="stIcon" class="fa-solid {{ $st0['icon'] }}"></i><span id="stBadge">المحطة 1 من 7 · مسار جبال جازان</span></span>
                            <span id="stElev" class="text-xs font-bold text-[#38BDF8]">الارتفاع: {{ $st0['elevation'] }}</span>
                        </div>
                        <h3 id="stTitle" class="text-2xl sm:text-3xl font-black mb-1">{{ $st0['title'] }}</h3>
                        <h4 id="stSub" class="text-[#38BDF8] font-bold mb-4">{{ $st0['subtitle'] }}</h4>
                        <p id="stDesc" class="text-sm sm:text-base text-sky-100/85 leading-relaxed flex-grow">{{ $st0['desc'] }}</p>
                        <div class="mt-6 pt-5 border-t border-white/10 flex items-center justify-between gap-4">
                            <div class="flex items-center gap-1.5" id="stDots">
                                @foreach($stations as $i => $st)
                                    <span class="st-dot h-2 rounded-full transition-all {{ $i === 0 ? 'w-6 bg-[#38BDF8]' : 'w-2 bg-white/30' }}"></span>
                                @endforeach
                            </div>
                            <div class="flex items-center gap-2">
                                <button type="button" id="stPrev" class="w-11 h-11 rounded-xl bg-white/10 hover:bg-white/20 border border-white/15 transition flex items-center justify-center" aria-label="المحطة السابقة"><i class="fa-solid fa-chevron-right"></i></button>
                                <button type="button" id="stNext" class="mg-btn !py-2.5 !px-5" aria-label="المحطة التالية"><span>المحطة التالية</span><i class="fa-solid fa-arrow-left text-xs"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===================================================================
     7. SMART MAP · 3D framed Leaflet map with filter chips
     =================================================================== --}}
@php
    $mapFilters = [
        ['all', 'كل الوجهات', 12, 'fa-layer-group'],
        ['mountains-and-viewpoints', 'الجبال والمطلات', 3, 'fa-mountain'],
        ['sea-and-islands', 'الجزر والشواطئ', 3, 'fa-umbrella-beach'],
        ['adventures-and-valleys', 'الأودية والمغامرات', 3, 'fa-person-hiking'],
        ['coffee-and-farms', 'البن والمزارع', 2, 'fa-mug-hot'],
        ['heritage-and-forts', 'التراث والحصون', 1, 'fa-chess-rook'],
    ];
@endphp
<section class="mg-section mg-bg-light mg-grid-pattern">
    <div class="mg-orb mg-orb-cyan w-96 h-96 top-0 -left-20" data-speed="0.09"></div>
    <div class="mg-wrap">
        <x-mg.section-head eyebrow="استكشاف جغرافي تفاعلي حي" icon="fa-map-location-dot" title="الخريطة السياحية الذكية"
            text="استعرض شبكة الوجهات المتصلة وتعرّف على المعالم القريبة من مسارك في آنٍ واحد مع بيانات الارتفاع والتقييمات." />

        <div class="flex flex-wrap items-center justify-center gap-2.5 mb-8 mg-reveal">
            @foreach($mapFilters as $i => $mf)
                <button type="button" data-map-filter="{{ $mf[0] }}" class="map-filter-btn mg-chip {{ $i === 0 ? 'is-active' : '' }}">
                    <i class="fa-solid {{ $mf[3] }}"></i><span>{{ $mf[1] }}</span><span class="mg-count">{{ $mf[2] }}</span>
                </button>
            @endforeach
        </div>

        <div class="mg-perspective mg-reveal mg-reveal-scale">
            <div class="map-3d-frame rounded-3xl p-1.5 bg-gradient-to-r from-[#164E63] via-[#06B6D4] to-[#38BDF8]">
                <div id="homeInteractiveMap" class="isolate rounded-[1.4rem] overflow-hidden h-[420px] sm:h-[540px] w-full bg-[#E0F2FE]"></div>
            </div>
            <div class="mt-5 flex flex-wrap items-center justify-center gap-3 text-xs font-bold text-[#164E63]/80">
                <span class="inline-flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-[#06B6D4] mg-pulse"></span> نقطة نشطة</span>
                <span class="opacity-40">|</span>
                <span>انقر على أي نقطة لعرض التفاصيل والمسار</span>
            </div>
        </div>
    </div>
</section>

{{-- ===================================================================
     8. AI TRIP PLANNER · animated aurora banner with floating cards
     =================================================================== --}}
<section class="mg-section mg-bg-white !py-12 sm:!py-20">
    <div class="mg-wrap">
        <div class="mg-aurora relative overflow-hidden rounded-[2.5rem] p-8 sm:p-14 text-white shadow-2xl shadow-[#164E63]/40 mg-reveal mg-reveal-scale">
            <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 24px 24px;"></div>
            <div class="mg-orb mg-orb-sky w-72 h-72 -top-20 -right-10"></div>
            <div class="mg-orb mg-orb-cyan w-72 h-72 -bottom-24 left-10"></div>

            <div class="relative grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-right space-y-6">
                    <span class="mg-eyebrow !text-[#38BDF8] !bg-white/10 !border-white/25"><i class="fa-solid fa-wand-magic-sparkles"></i> مساعدك السياحي الذكي الذاتي</span>
                    <h2 class="mg-title !text-white">مخطط الرحلات (AI): صمّم جدول رحلتك في <span class="mg-text-grad">ثوانٍ</span></h2>
                    <p class="text-sky-100/85 leading-loose max-w-xl">حدد عدد أيام إقامتك، اهتماماتك (عائلية، شبابية، استرخاء أو مغامرة)، وسيقوم الذكاء الاصطناعي بإنشاء مسار مخصص بدقة لأجمل محطات جازان مع حساب أوقات القيادة ومواعيد الشمس.</p>
                    <a href="{{ route('map.index') }}#aiPlanner" class="mg-btn" data-magnetic><i class="fa-solid fa-wand-magic-sparkles"></i><span>خطط لرحلتك بالذكاء الاصطناعي مجاناً</span></a>
                </div>

                <div class="relative min-h-[22rem] mg-perspective">
                    <div class="mg-float-a mg-card-glass rounded-3xl p-5 absolute top-0 right-0 w-[88%] sm:w-4/5">
                        <div class="flex items-center justify-between mb-3 text-xs font-bold">
                            <span class="inline-flex items-center gap-1.5 text-[#38BDF8]"><i class="fa-solid fa-mountain"></i> اليوم 1 · مسار القمم</span>
                            <span class="mg-badge mg-badge-cyan">100% مكتمل</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mg-icon-tile !w-11 !h-11 !text-base shrink-0"><i class="fa-solid fa-sun"></i></span>
                            <div>
                                <h4 class="font-black mb-1">صعود فيفا وإقامة النزل الريفي</h4>
                                <p class="text-xs text-sky-100/75 leading-relaxed">08:00 صعود فيفا · 12:30 مأدبة الغداء · 04:00 مطل الريث</p>
                            </div>
                        </div>
                    </div>
                    <div class="mg-float-b mg-card-glass rounded-3xl p-5 absolute bottom-6 left-0 w-[88%] sm:w-4/5">
                        <div class="flex items-center justify-between mb-3 text-xs font-bold">
                            <span class="inline-flex items-center gap-1.5 text-[#38BDF8]"><i class="fa-solid fa-water"></i> اليوم 2 · جزر فرسان</span>
                            <span class="mg-badge">تأكيد فوري</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mg-icon-tile mg-icon-tile-dark !w-11 !h-11 !text-base shrink-0"><i class="fa-solid fa-ship"></i></span>
                            <div>
                                <h4 class="font-black mb-1">إبحار فرسان وسفاري الشعاب</h4>
                                <p class="text-xs text-sky-100/75 leading-relaxed">07:00 انطلاق العبارة · 10:00 غوص الشواطئ · 05:00 غروب فرسان</p>
                            </div>
                        </div>
                    </div>
                    <div class="mg-pulse absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-10 inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#072430] border border-[#38BDF8]/50 text-[11px] font-bold text-[#38BDF8]">
                        <span class="w-2 h-2 rounded-full bg-[#38BDF8] animate-ping"></span> توليد ذكي وموازنة دقيقة بين القيادة والاسترخاء
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===================================================================
     9. AR & 360° · layered 3D photos with laser scanline
     =================================================================== --}}
<section class="mg-section mg-bg-white !pt-6">
    <div class="mg-wrap grid lg:grid-cols-2 gap-14 items-center">
        <div class="relative h-[26rem] sm:h-[34rem] mg-perspective mg-reveal mg-reveal-right">
            <div class="absolute inset-4 rounded-full border-2 border-dashed border-[#06B6D4]/40 mg-spin-slow"></div>
            <div class="absolute top-0 right-0 w-[78%] h-[80%] rounded-[2rem] overflow-hidden shadow-2xl shadow-[#164E63]/40 border-4 border-white" style="transform: rotateY(-9deg) rotateX(4deg);">
                <img src="/images/wadi_lajab.jpg" alt="وادي لجب" loading="lazy" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-[#072430]/60 to-transparent"></div>
                <div class="mg-scanline"></div>
            </div>
            <div class="mg-float-b absolute bottom-0 left-0 w-[58%] h-[55%] rounded-[2rem] overflow-hidden shadow-2xl shadow-[#164E63]/40 border-4 border-white">
                <img src="/images/coastal_beach.jpg" alt="شاطئ جازان" loading="lazy" class="w-full h-full object-cover">
            </div>
            <div class="mg-float-a absolute top-6 left-4 mg-card-glass !bg-[#072430]/85 rounded-2xl px-4 py-2.5 text-xs font-black flex items-center gap-2 z-10">
                <span class="w-2.5 h-2.5 rounded-full bg-[#38BDF8] mg-pulse"></span> 360° جولة حية
            </div>
            <div class="mg-float-b absolute bottom-10 right-2 mg-card-glass !bg-[#072430]/85 rounded-2xl px-4 py-2.5 text-xs font-black flex items-center gap-2 z-10">
                <i class="fa-solid fa-cube text-[#38BDF8]"></i> مجسم ثلاثي الأبعاد 3D
            </div>
        </div>

        <div class="text-right space-y-6 mg-reveal mg-reveal-left">
            <span class="mg-eyebrow"><i class="fa-solid fa-vr-cardboard"></i> تقنيات المستقبل السياحي</span>
            <h2 class="mg-title">الواقع المعزز (AR) والجولات الافتراضية <span class="mg-text-grad">360°</span></h2>
            <p class="text-[#183746]/80 leading-loose">عندما يصل السائح إلى قرية أو حصن أثري، يوجّه كاميرا الهاتف فتظهر مجسمات ومعلومات ثلاثية الأبعاد تحكي تاريخ الموقع وتفاصيل عمارته الأصيلة. كما يمكن للمسافر استكشاف الوجهات افتراضياً قبل بدء الرحلة.</p>
            <div class="flex flex-wrap gap-3">
                @foreach([['fa-street-view','جولات افتراضية 360°'],['fa-cube','مجسمات تفاعلية'],['fa-headphones','إرشاد صوتي مكاني']] as $t)
                    <span class="mg-chip cursor-default"><i class="fa-solid {{ $t[0] }} text-[#06B6D4]"></i>{{ $t[1] }}</span>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ===================================================================
     10. FAQ · two-column animated accordion
     =================================================================== --}}
@php
    $faqs = [
        ['icon' => 'fa-compass',               'tag' => 'الوجهات والمسارات',    'q' => 'أين يذهب السائح في جازان؟', 'a' => 'تتنوع الخيارات بين شواطئ وجزر فرسان الفيروزية، قمم ومطلات جبال فيفا والداير وهروب، أودية وشلالات وادي لجب، وقرى التراث كقرية العشة. توفر منصة «مَطَلّ» مسارات متسلسلة تجمع كل منطقة في خطة واحدة.'],
        ['icon' => 'fa-location-dot',          'tag' => 'القرب الجغرافي',        'q' => 'ما أفضل الأماكن القريبة من بعضها؟', 'a' => 'تربط «مَطَلّ» المواقع المتجاورة جغرافياً تلقائياً؛ فمثلاً يربط "مسار الجبال والمطلات" قمم فيفا والداير ومطل الريث، بينما يربط "المسار الساحلي" كورنيش جازان بميناء رحلات فرسان وجزيرة أحبار.'],
        ['icon' => 'fa-wand-magic-sparkles',   'tag' => 'الذكاء الاصطناعي',      'q' => 'كيف يرتب رحلته ووقته دون تشتت؟', 'a' => 'عبر ميزة "مخطط الرحلات بالذكاء الاصطناعي (AI)" في مَطَلّ؛ يكفي تحديد عدد الأيام وطبيعة المسافرين (عائلة، شباب، أصدقاء) ليتم توليد جدول زمني يومي كامل بالمحطات وأوقات القيادة.'],
        ['icon' => 'fa-people-roof',           'tag' => 'العائلات والأطفال',      'q' => 'ما الأماكن والمسارات المناسبة للعائلات والأطفال؟', 'a' => '"المسار العائلي الترفيهي" والواجهات البحرية بكورنيش جازان الشمالي والجنوبي، إضافة للمنتجعات الريفية في فيفا المزودة بجلسات عائلية مريحة وخدمات متكاملة.'],
        ['icon' => 'fa-person-hiking',         'tag' => 'المغامرات والطقس',      'q' => 'هل زيارة وادي لجب آمنة للجميع؟', 'a' => 'وادي لجب مناسب لمحبي المغامرات، وتؤكد المنصة على أهمية مرافقة مرشد محلي مرخص ومتابعة تنبيهات الطقس وتجنب الدخول أثناء هطول الأمطار وجريان السيول.'],
        ['icon' => 'fa-wallet',                'tag' => 'التكاليف والميزانية',    'q' => 'كم تكلفة الرحلة المتوقعة وكيف يحسب ميزانيته؟', 'a' => 'تتيح مَطَلّ حاسبة ميزانية تفاعلية فورية تحسب تكاليف الإقامة، النقل، رسوم الجولات البحرية، والأنشطة بحسب عدد الأفراد مع باقات اقتصادية وVIP.'],
        ['icon' => 'fa-sun',                   'tag' => 'أفضل أوقات الزيارة',    'q' => 'ما أفضل وقت لزيارة جازان؟', 'a' => 'تعد الفترة من نوفمبر إلى إبريل الأروع للمناطق الساحلية وجزر فرسان لأجوائها المعتدلة، بينما تظل المرتفعات الجبلية (فيفا والداير) وجهة صيفية باردة عليلة طوال العام.'],
        ['icon' => 'fa-car-side',              'tag' => 'المواصلات والتنقل',      'q' => 'كيف يتنقل السائح في المرتفعات والجبال؟', 'a' => 'يُفضل استخدام سيارات الدفع الرباعي في قمم فيفا والريث، وتوفر منصة مَطَلّ خدمة حجز سائقين محليين محترفين يعرفون تضاريس الطرق وأفضل المطلات السرية.'],
        ['icon' => 'fa-mug-hot',               'tag' => 'البن الخولاني والتسوق', 'q' => 'أين يجد أجود أنواع البن الخولاني الأصيل؟', 'a' => 'مباشرة من مزارع الداير وفيفا المعتمدة الشريكة في المنصة، أو عبر مهرجان البن الدولي السنوي، وتتيح «مَطَلّ» شراء محاصيل موثقة ومطابقة لمعايير الهيئة.'],
        ['icon' => 'fa-house-chimney-window',  'tag' => 'الفنادق والنزل',         'q' => 'هل توجد نزل ريفية وأكواخ معلقة للإقامة؟', 'a' => 'نعم، تضم جازان شبكة متنامية من النزل الريفية والأكواخ الخشبية ذات الإطلالات السحابية، بالإضافة إلى فنادق الواجهة البحرية المصنفة 5 نجوم في قلب المدينة.'],
        ['icon' => 'fa-credit-card',           'tag' => 'الحجوزات والدفع',       'q' => 'كيف يحجز السائح رحلاته وتجاربه في مَطَلّ؟', 'a' => 'بخطوات يسيرة: اختر المسار أو الوجهة، حدد تاريخ الزيارة وعدد الأفراد، وأتمم الحجز الآمن عبر وسائل الدفع المعتمدة (مدى، فيزا، ماستركارد، Apple Pay) مع تأكيد فوري عبر الرسائل.'],
        ['icon' => 'fa-handshake',             'tag' => 'الشراكات والانضمام',    'q' => 'كيف ينضم المرشدون والمزارعون لمنظومة مَطَلّ؟', 'a' => 'عبر بوابة "انضم كشريك"؛ يُسجل مقدم الخدمة (مرشد، صاحب نزل، صاحب مزرعة) بياناته وتراخيصه ليتم اعتماده وتدريبه وإدراج خدماته مباشرة أمام آلاف الزوار.'],
    ];
@endphp
<section id="faqSection" class="mg-section mg-bg-light">
    <div class="mg-orb mg-orb-cyan w-96 h-96 -top-24 right-10" data-speed="0.08"></div>
    <div class="mg-wrap">
        <x-mg.section-head eyebrow="إجابات وافية لتخطيط رحلتك في جازان" icon="fa-circle-question" title="أسئلة كل سائح... وإجابة واحدة"
            text="رغم تنوع المقومات الطبيعية والتراثية في جازان، جمعنا لك إجابات دقيقة لأهم 12 تساؤلاً من خبراء منصة «مَطَلّ»:" />

        <div class="grid lg:grid-cols-2 gap-4 items-start" data-acc-single data-stagger="0.06">
            @foreach($faqs as $i => $f)
                <div class="mg-acc mg-reveal rounded-2xl bg-white border border-[#06B6D4]/20 shadow-sm {{ $i === 0 ? 'is-open' : '' }}">
                    <button type="button" class="mg-acc-trigger w-full flex items-center justify-between gap-4 p-5 text-right cursor-pointer" aria-expanded="{{ $i === 0 ? 'true' : 'false' }}">
                        <div class="flex items-center gap-4 min-w-0">
                            <span class="mg-icon-tile !w-11 !h-11 !text-base shrink-0"><i class="fa-solid {{ $f['icon'] }}"></i></span>
                            <div class="min-w-0">
                                <span class="block text-[11px] font-black text-[#06B6D4] mb-0.5">{{ $f['tag'] }}</span>
                                <span class="block font-black text-[#164E63] text-sm sm:text-base leading-snug">{{ $f['q'] }}</span>
                            </div>
                        </div>
                        <span class="mg-acc-chev w-9 h-9 shrink-0 rounded-full bg-[#E0F2FE] text-[#164E63] flex items-center justify-center"><i class="fa-solid fa-chevron-down text-xs"></i></span>
                    </button>
                    <div class="mg-acc-body">
                        <div>
                            <p class="px-5 pb-5 pt-4 mx-5 border-t border-[#06B6D4]/15 text-sm leading-loose text-[#183746]/80">{{ $f['a'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===================================================================
     11. IMPACT + PARTNERS
     =================================================================== --}}
@php
    $impact = [
        ['icon' => 'fa-suitcase-rolling', 'tag' => 'المستفيد الأول',    'title' => 'للسائح',          'foot' => 'استكشاف آمن وموثوق',   'items' => ['سهولة التخطيط وتوفير الوقت', 'معلومات دقيقة وموثوقة', 'اكتشاف مواقع مميزة وغير شائعة', 'حجز موثوق ومسارات واضحة']],
        ['icon' => 'fa-chart-line',       'tag' => 'قطاع الأعمال',      'title' => 'للمستثمر',        'foot' => 'تدفق عملاء مستمر',     'items' => ['وصول مباشر لشريحة سياح مهتمة', 'تسويق مستمر للمرافق والخدمات', 'إدارة الحجوزات بسلاسة واحترافية', 'إحصاءات تدعم توسع المشاريع']],
        ['icon' => 'fa-people-group',     'tag' => 'التنمية المستدامة', 'title' => 'للمجتمع المحلي',  'foot' => 'تمكين اقتصادي محلي',   'items' => ['فرص عمل للمرشدين والسائقين', 'دخل إضافي مستدام للأسر المنتجة', 'تسويق منتجات البن والعسل', 'إشراك أهالي القرى كشركاء تنمية']],
        ['icon' => 'fa-landmark-flag',    'tag' => 'الرؤية الوطنية',    'title' => 'للمنطقة',         'foot' => 'تحقيق رؤية 2030',      'items' => ['زيادة التدفق والحركة السياحية', 'توزيع الزوار على جميع المحافظات', 'إطالة مدة إقامة السائح في جازان', 'إبراز جازان كوجهة طوال العام']],
    ];
    $govs = [
        ['fa-landmark', 'وزارة السياحة', 'شريك استراتيجي'],
        ['fa-bullhorn', 'هيئة السياحة السعودية', 'الترويج الوطني'],
        ['fa-crown', 'إمارة منطقة جازان', 'الرعاية الكريمة'],
        ['fa-city', 'أمانة منطقة جازان', 'تطوير المرافق'],
        ['fa-monument', 'هيئة التراث', 'حفظ المعالم'],
    ];
    $fieldPartners = [
        ['title' => 'أصحاب المزارع',      'desc' => 'مزارع البن والمانجو والفواكه', 'icon' => 'fa-seedling'],
        ['title' => 'أصحاب النزل الريفية', 'desc' => 'أكواخ وسكن فوق السحاب',       'icon' => 'fa-house-chimney-window'],
        ['title' => 'المرشدون السياحيون',  'desc' => 'كوادر محلية مرخصة وخبيرة',     'icon' => 'fa-user-tie'],
        ['title' => 'المطاعم والمقاهي',    'desc' => 'ضيافة جازانية ومذاقات القهوة', 'icon' => 'fa-mug-hot'],
        ['title' => 'الأسر المنتجة',       'desc' => 'عسل ونباتات عطرية وحرف',       'icon' => 'fa-basket-shopping'],
        ['title' => 'أصحاب القوارب',       'desc' => 'رحلات بحرية وغوص فرسان',       'icon' => 'fa-ship'],
        ['title' => 'الحرفيون',            'desc' => 'فخار ونسج وعمارة حجرية',       'icon' => 'fa-hammer'],
    ];
@endphp
<section id="impactSection" class="mg-section mg-bg-white">
    <div class="mg-orb mg-orb-cyan w-96 h-96 top-10 -right-24" data-speed="0.08"></div>
    <div class="mg-orb mg-orb-sky w-80 h-80 bottom-20 -left-24" data-speed="0.06"></div>
    <div class="mg-wrap">
        <x-mg.section-head eyebrow="منظومة الأثر والتنمية المستدامة" icon="fa-seedling" title="الأثر المتوقع على سياحة جازان"
            text="قيمة مضافة وحراك تنموي متسلسل يربط رحلة السائح باقتصاد المستثمر وتمكين المجتمع المحلي." />

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 items-start mg-perspective mb-24" data-stagger="0.12">
            @foreach($impact as $k => $im)
                <div class="mg-card mg-reveal group p-6 sm:p-7 flex flex-col {{ ['', 'lg:mt-8', 'lg:mt-16', 'lg:mt-4'][$k] }}">
                    <div class="flex items-center gap-4 mb-5">
                        <span class="mg-icon-tile mg-pop {{ $k % 2 ? 'mg-icon-tile-dark' : '' }}"><i class="fa-solid {{ $im['icon'] }}"></i></span>
                        <div>
                            <span class="block text-[11px] font-black text-[#06B6D4]">{{ $im['tag'] }}</span>
                            <h3 class="text-xl font-black text-[#164E63]">{{ $im['title'] }}</h3>
                        </div>
                    </div>
                    <ul class="space-y-3 text-sm text-[#183746]/80 flex-grow">
                        @foreach($im['items'] as $it)
                            <li class="flex items-start gap-2.5"><i class="fa-solid fa-circle-check text-[#06B6D4] mt-1 text-xs"></i><span>{{ $it }}</span></li>
                        @endforeach
                    </ul>
                    <div class="mt-6 pt-4 border-t border-[#06B6D4]/15 flex items-center justify-between text-xs font-black text-[#164E63]">
                        <span>{{ $im['foot'] }}</span>
                        <i class="fa-solid fa-arrow-left text-[#06B6D4] transition group-hover:-translate-x-1.5"></i>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Partners --}}
        <div class="text-center mb-10 mg-reveal">
            <span class="mg-eyebrow"><i class="fa-solid fa-building-columns"></i> الجهات الحكومية والمنظومة الاستراتيجية</span>
            <h3 class="mg-title mt-4 !text-3xl sm:!text-4xl">شركاؤنا</h3>
            <div class="mg-divider"></div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-10 mg-perspective" data-stagger="0.08">
            @foreach($govs as $g)
                <div class="mg-card mg-reveal group p-5 text-center {{ $loop->last ? 'col-span-2 md:col-span-1' : '' }}" data-tilt-max="10">
                    <span class="mg-icon-tile mg-icon-tile-dark mg-pop mx-auto mb-3"><i class="fa-solid {{ $g[0] }}"></i></span>
                    <div class="font-black text-[#164E63] text-sm">{{ $g[1] }}</div>
                    <div class="text-[11px] text-[#06B6D4] font-bold mt-1">{{ $g[2] }}</div>
                </div>
            @endforeach
        </div>

        <div class="mg-marquee mb-12" dir="rtl">
            <div class="mg-marquee-track py-3">
                @foreach([false, true] as $dup)
                    @foreach($fieldPartners as $fp)
                        <div class="partner-card group flex items-center gap-4 min-w-[17rem] px-5 py-4 rounded-2xl bg-white border border-[#06B6D4]/20 shadow-sm hover:border-[#06B6D4] hover:-translate-y-1 hover:shadow-xl hover:shadow-[#06B6D4]/20 transition-all duration-300" @if($dup) aria-hidden="true" @endif>
                            <span class="mg-icon-tile !w-12 !h-12 !text-lg"><i class="fa-solid {{ $fp['icon'] }}"></i></span>
                            <div class="text-right">
                                <h5 class="font-black text-[#164E63] text-sm">{{ $fp['title'] }}</h5>
                                <p class="text-xs text-[#183746]/70">{{ $fp['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>

        {{-- Partner CTA --}}
        <div class="mg-aurora relative overflow-hidden rounded-3xl p-8 sm:p-12 text-white flex flex-col md:flex-row items-center justify-between gap-6 shadow-2xl shadow-[#164E63]/30 mg-reveal mg-reveal-scale">
            <div class="mg-orb mg-orb-sky w-64 h-64 -top-20 -left-10"></div>
            <div class="relative text-center md:text-right space-y-3">
                <span class="mg-badge mg-badge-cyan"><i class="fa-solid fa-handshake"></i> دعوة انضمام للشركاء</span>
                <h4 class="text-xl sm:text-2xl font-black">هل أنت صاحب مزرعة، نزل ريفي، أو مرشد سياحي في جازان؟</h4>
                <p class="text-sm text-sky-100/85 max-w-2xl leading-relaxed">انضم إلى شبكة شركاء «مَطَلّ» المعتمدة، وسوّق خدماتك وتجاربك مباشرة لآلاف السياح والزوار بكل موثوقية واحترافية.</p>
            </div>
            <a href="{{ route('about') }}#contact" class="mg-btn shrink-0 relative" data-magnetic><span>انضم كشريك الآن</span><i class="fa-solid fa-arrow-left text-xs"></i></a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {

        // ---------- A. Journey stations ----------
        const stations = @json($stations);
        const btns = document.querySelectorAll('[data-station]');
        const dots = document.querySelectorAll('.st-dot');
        const card = document.getElementById('stCard');
        const $ = id => document.getElementById(id);
        let cur = 0;

        function setStation(i) {
            cur = (i + stations.length) % stations.length;
            const d = stations[cur];
            btns.forEach((b, k) => b.classList.toggle('is-active', k === cur));
            dots.forEach((x, k) => { x.className = 'st-dot h-2 rounded-full transition-all ' + (k === cur ? 'w-6 bg-[#38BDF8]' : 'w-2 bg-white/30'); });

            const img = $('stImg');
            if (img) { img.style.opacity = 0; setTimeout(() => { img.src = d.image; img.alt = d.title; img.style.opacity = 1; }, 200); }
            $('stNum').textContent = '0' + d.step;
            $('stTag').textContent = d.tag;
            $('stTime').textContent = d.time;
            $('stBadge').textContent = 'المحطة ' + d.step + ' من ' + stations.length + ' · مسار جبال جازان';
            $('stIcon').className = 'fa-solid ' + d.icon;
            $('stElev').textContent = 'الارتفاع: ' + d.elevation;
            $('stTitle').textContent = d.title;
            $('stSub').textContent = d.subtitle;
            $('stDesc').textContent = d.desc;

            if (card) {
                card.style.transform = 'perspective(1200px) rotateY(-4deg) scale(.99)';
                setTimeout(() => { card.style.transform = ''; }, 280);
            }
        }
        btns.forEach((b, k) => b.addEventListener('click', () => setStation(k)));
        const prev = $('stPrev'), next = $('stNext');
        if (prev) prev.addEventListener('click', () => setStation(cur - 1));
        if (next) next.addEventListener('click', () => setStation(cur + 1));

        // Arrow keys work only while the journey section is on screen
        const journey = $('journey');
        let journeyVisible = false;
        if (journey && 'IntersectionObserver' in window) {
            new IntersectionObserver(es => { journeyVisible = es[0].isIntersecting; }, { threshold: 0.4 }).observe(journey);
        }
        document.addEventListener('keydown', e => {
            if (!journeyVisible) return;
            if (e.key === 'ArrowRight') setStation(cur - 1);
            if (e.key === 'ArrowLeft') setStation(cur + 1);
        });

        // ---------- B. Home Leaflet map with category filter ----------
        const mapEl = document.getElementById('homeInteractiveMap');
        if (mapEl && typeof L !== 'undefined') {
            const map = L.map('homeInteractiveMap', { center: [17.15, 42.85], zoom: 9, scrollWheelZoom: false });
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18, attribution: '© OpenStreetMap | منصة مَطَلّ'
            }).addTo(map);

            const layer = L.layerGroup().addTo(map);
            let points = [];
            const colors = {
                'mountains-and-viewpoints': '#164E63',
                'sea-and-islands': '#06B6D4',
                'adventures-and-valleys': '#38BDF8',
                'coffee-and-farms': '#0e3b4d'
            };

            function render(filter = 'all') {
                layer.clearLayers();
                points.filter(p => filter === 'all' || p.category_slug === filter).forEach(pt => {
                    const m = L.circleMarker([pt.lat, pt.lng], {
                        radius: 9, fillColor: colors[pt.category_slug] || '#0891B2',
                        color: '#ffffff', weight: 2.5, opacity: 1, fillOpacity: 0.95
                    }).addTo(layer);
                    m.bindPopup(`
                        <div style="direction:rtl;text-align:right;font-family:'Tajawal','Amiri',serif,sans-serif;padding:4px;max-width:200px;">
                            <h4 style="margin:0;color:#164E63;font-weight:800;font-size:14px;">${pt.title}</h4>
                            <div style="color:#0891B2;font-size:11px;margin-top:2px;font-weight:700;">${pt.region} · <i class="fa-solid fa-star"></i> ${pt.rating}</div>
                            <p style="color:#64748b;font-size:10px;margin:4px 0 6px;">${pt.tagline || ''}</p>
                            <a href="${pt.url}" style="color:#06B6D4;font-weight:800;font-size:11px;text-decoration:underline;">عرض التفاصيل والمسار ←</a>
                        </div>`);
                });
            }

            fetch('{{ route("map.points") }}')
                .then(r => r.json())
                .then(res => { if (res.status === 'success' && res.data) { points = res.data; render('all'); } })
                .catch(err => console.error('Map points error:', err));

            const chips = document.querySelectorAll('.map-filter-btn');
            chips.forEach(chip => chip.addEventListener('click', () => {
                chips.forEach(c => c.classList.toggle('is-active', c === chip));
                render(chip.getAttribute('data-map-filter'));
            }));
        }
    });
</script>
@endpush
