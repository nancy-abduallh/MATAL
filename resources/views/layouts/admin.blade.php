<!DOCTYPE html>
<html lang="ar" dir="rtl" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'لوحة تحكم وتحليلات الإدارة · Power BI Dashboard') | مَطَلّ</title>
    <meta name="robots" content="noindex, nofollow">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Chart.js for Power BI Visualizations -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background-color: #071722;
            color: #E2E8F0;
        }

        /* Power BI Executive Aesthetics */
        .pbi-card {
            background: linear-gradient(135deg, rgba(14, 38, 55, 0.85) 0%, rgba(10, 26, 38, 0.95) 100%);
            border: 1px solid rgba(6, 182, 212, 0.18);
            border-radius: 1.25rem;
            box-shadow: 0 16px 36px -12px rgba(7, 23, 34, 0.8), 0 0 0 1px rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(16px);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .pbi-card:hover {
            border-color: rgba(6, 182, 212, 0.45);
            box-shadow: 0 20px 42px -12px rgba(6, 182, 212, 0.16), 0 0 0 1px rgba(6, 182, 212, 0.25);
            transform: translateY(-2px);
        }

        .pbi-header-glass {
            background: rgba(7, 23, 34, 0.85);
            border-bottom: 1px solid rgba(6, 182, 212, 0.15);
            backdrop-filter: blur(20px);
        }

        .pbi-sidebar {
            background: linear-gradient(180deg, #071722 0%, #0A1E2B 50%, #071520 100%);
            border-left: 1px solid rgba(6, 182, 212, 0.16);
        }

        .pbi-pill {
            background: rgba(6, 182, 212, 0.12);
            border: 1px solid rgba(6, 182, 212, 0.25);
            color: #38BDF8;
        }
        .pbi-pill-active {
            background: linear-gradient(135deg, #0891B2 0%, #0284C7 100%);
            border-color: #38BDF8;
            color: #FFFFFF;
            box-shadow: 0 0 16px rgba(6, 182, 212, 0.4);
        }

        /* Custom Scrollbar for Power BI dashboard */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #071722; }
        ::-webkit-scrollbar-thumb { background: rgba(6, 182, 212, 0.3); border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(6, 182, 212, 0.6); }

        @media print {
            .no-print { display: none !important; }
            body { background: #FFFFFF !important; color: #000000 !important; }
            .pbi-card { background: #FFFFFF !important; border: 1px solid #CBD5E1 !important; box-shadow: none !important; color: #000000 !important; }
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-[#06B6D4] selection:text-white">

    <!-- Notifications Toast Container -->
    @if(session('success') || session('info') || session('error') || $errors->any())
        <div class="fixed top-5 left-5 z-[9999] max-w-md w-full space-y-3 pointer-events-none">
            @if(session('success'))
                <div class="pointer-events-auto flex items-center gap-3 p-4 rounded-2xl bg-gradient-to-r from-emerald-900/95 to-teal-900/95 border border-emerald-500/40 text-emerald-100 shadow-2xl backdrop-blur-xl animate-fade-in">
                    <span class="w-9 h-9 rounded-xl bg-emerald-500/20 text-emerald-300 flex items-center justify-center shrink-0"><i class="fa-solid fa-circle-check text-lg"></i></span>
                    <p class="text-sm font-bold flex-1">{{ session('success') }}</p>
                </div>
            @endif
            @if(session('info'))
                <div class="pointer-events-auto flex items-center gap-3 p-4 rounded-2xl bg-gradient-to-r from-sky-900/95 to-blue-900/95 border border-sky-500/40 text-sky-100 shadow-2xl backdrop-blur-xl animate-fade-in">
                    <span class="w-9 h-9 rounded-xl bg-sky-500/20 text-sky-300 flex items-center justify-center shrink-0"><i class="fa-solid fa-circle-info text-lg"></i></span>
                    <p class="text-sm font-bold flex-1">{{ session('info') }}</p>
                </div>
            @endif
            @if(session('error') || $errors->any())
                <div class="pointer-events-auto flex items-center gap-3 p-4 rounded-2xl bg-gradient-to-r from-rose-900/95 to-red-900/95 border border-rose-500/40 text-rose-100 shadow-2xl backdrop-blur-xl animate-fade-in">
                    <span class="w-9 h-9 rounded-xl bg-rose-500/20 text-rose-300 flex items-center justify-center shrink-0"><i class="fa-solid fa-triangle-exclamation text-lg"></i></span>
                    <p class="text-sm font-bold flex-1">{{ session('error') ?? $errors->first() }}</p>
                </div>
            @endif
        </div>
    @endif

    <div class="flex-1 flex min-h-screen">

        <!-- ================= EXECUTIVE SIDEBAR ================= -->
        <aside id="adminSidebar" class="no-print fixed inset-y-0 right-0 z-50 w-72 pbi-sidebar flex flex-col justify-between transform transition-transform duration-300 ease-in-out lg:translate-x-0 translate-x-full">
            
            <!-- Top Branding -->
            <div>
                <div class="p-6 border-b border-cyan-500/15 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <img src="/images/matal_official_logo.png" alt="مَطَلّ" class="h-10 w-auto">
                        <div>
                            <span class="block text-sm font-black text-white tracking-wide leading-none">مَطَلّ · الإدارة</span>
                            <span class="block text-[10px] font-bold text-[#38BDF8] tracking-widest uppercase mt-1">Power Analytics</span>
                        </div>
                    </div>
                    <button type="button" id="closeSidebarBtn" class="lg:hidden w-8 h-8 rounded-lg bg-white/5 text-gray-400 hover:text-white flex items-center justify-center" aria-label="إغلاق القائمة">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <!-- Navigation Links -->
                <nav class="p-4 space-y-6 overflow-y-auto max-h-[calc(100vh-14rem)]">
                    
                    <!-- Analytics Suite -->
                    <div>
                        <span class="px-3 text-[11px] font-black uppercase text-cyan-400/70 tracking-wider block mb-2">
                            <i class="fa-solid fa-chart-pie ml-1 text-cyan-400"></i> منظومة التحليلات
                        </span>
                        <ul class="space-y-1 text-sm font-bold">
                            <li>
                                <a href="#overview" class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-cyan-500/15 text-[#38BDF8] border border-cyan-500/30 transition">
                                    <i class="fa-solid fa-gauge-high w-5 text-center"></i>
                                    <span>لوحة المؤشرات (KPIs)</span>
                                </a>
                            </li>
                            <li>
                                <a href="#revenue-analytics" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-white/5 transition">
                                    <i class="fa-solid fa-chart-line w-5 text-center text-cyan-400"></i>
                                    <span>تحليل الإيرادات والطلب</span>
                                </a>
                            </li>
                            <li>
                                <a href="#terrain-analytics" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-white/5 transition">
                                    <i class="fa-solid fa-mountain-sun w-5 text-center text-sky-400"></i>
                                    <span>توزيع التضاريس والوجهات</span>
                                </a>
                            </li>
                            <li>
                                <a href="#conversion-funnel" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-white/5 transition">
                                    <i class="fa-solid fa-filter-circle-dollar w-5 text-center text-teal-400"></i>
                                    <span>قمع المبيعات ومعدل الإنجاز</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Operations -->
                    <div>
                        <span class="px-3 text-[11px] font-black uppercase text-cyan-400/70 tracking-wider block mb-2">
                            <i class="fa-solid fa-sliders ml-1 text-cyan-400"></i> إدارة العمليات
                        </span>
                        <ul class="space-y-1 text-sm font-bold">
                            <li>
                                <a href="#bookings-section" class="flex items-center justify-between px-3 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-white/5 transition">
                                    <span class="flex items-center gap-3">
                                        <i class="fa-solid fa-ticket w-5 text-center text-cyan-400"></i>
                                        <span>إدارة الحجوزات الحية</span>
                                    </span>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] bg-cyan-500/20 text-cyan-300 border border-cyan-500/30 font-black">مباشر</span>
                                </a>
                            </li>
                            <li>
                                <a href="#contacts-section" class="flex items-center justify-between px-3 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-white/5 transition">
                                    <span class="flex items-center gap-3">
                                        <i class="fa-solid fa-envelope-open-text w-5 text-center text-sky-400"></i>
                                        <span>استفسارات الشركاء والزوار</span>
                                    </span>
                                    @php $unreadCount = \App\Models\Contact::where('is_read', false)->count(); @endphp
                                    @if($unreadCount > 0)
                                        <span class="w-5 h-5 rounded-full bg-rose-500 text-white text-[10px] flex items-center justify-center font-black animate-pulse">{{ $unreadCount }}</span>
                                    @endif
                                </a>
                            </li>
                            <li>
                                <a href="#destinations-section" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-white/5 transition">
                                    <i class="fa-solid fa-ranking-star w-5 text-center text-amber-400"></i>
                                    <span>الوجهات الأعلى تقييماً</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Platform Link -->
                    <div>
                        <span class="px-3 text-[11px] font-black uppercase text-cyan-400/70 tracking-wider block mb-2">
                            <i class="fa-solid fa-globe ml-1 text-cyan-400"></i> المنصة العامة
                        </span>
                        <ul class="space-y-1 text-sm font-bold">
                            <li>
                                <a href="{{ route('home') }}" target="_blank" rel="noopener" class="flex items-center justify-between px-3 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-white/5 transition group">
                                    <span class="flex items-center gap-3">
                                        <i class="fa-solid fa-up-right-from-square w-5 text-center text-cyan-400 group-hover:scale-110 transition"></i>
                                        <span>معاينة واجهة السياح</span>
                                    </span>
                                    <i class="fa-solid fa-chevron-left text-xs opacity-50"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                </nav>
            </div>

            <!-- Bottom User & Logout Card -->
            <div class="p-4 border-t border-cyan-500/15 bg-black/30">
                <div class="flex items-center justify-between gap-3 mb-3">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#164E63] to-[#06B6D4] text-white font-black text-base flex items-center justify-center shadow-lg shadow-cyan-900/40 border border-cyan-400/30 shrink-0">
                            {{ mb_substr(Auth::user()->name ?? 'A', 0, 1) }}
                        </div>
                        <div class="min-w-0">
                            <span class="block text-sm font-black text-white truncate">{{ Auth::user()->name ?? 'مشرف النظام' }}</span>
                            <span class="inline-flex items-center gap-1.5 text-[10px] font-bold text-emerald-400">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                                مدير معتمد · Admin
                            </span>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 py-2 px-3 rounded-xl bg-rose-500/15 border border-rose-500/30 text-rose-300 hover:bg-rose-500 hover:text-white transition text-xs font-black">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <span>تسجيل الخروج الآمن</span>
                    </button>
                </form>
            </div>

        </aside>

        <!-- Sidebar Backdrop for mobile -->
        <div id="adminSidebarBackdrop" class="no-print fixed inset-0 z-40 bg-black/70 backdrop-blur-sm hidden lg:hidden"></div>

        <!-- ================= MAIN DASHBOARD WRAPPER ================= -->
        <div class="flex-1 flex flex-col min-w-0 lg:mr-72 transition-all duration-300">

            <!-- Top Executive Command Bar -->
            <header class="no-print sticky top-0 z-30 pbi-header-glass px-4 sm:px-8 py-3.5 flex items-center justify-between gap-4">
                
                <div class="flex items-center gap-4">
                    <button type="button" id="openSidebarBtn" class="lg:hidden w-10 h-10 rounded-xl bg-white/5 border border-white/10 text-white flex items-center justify-center hover:bg-white/10 transition" aria-label="فتح القائمة">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                            <h1 class="text-base sm:text-lg font-black text-white">لوحة مؤشرات الأداء والتحليلات التنفيذية</h1>
                            <span class="hidden sm:inline-flex px-2 py-0.5 rounded-md text-[10px] font-black bg-cyan-500/20 text-[#38BDF8] border border-cyan-500/30">Power BI Suite</span>
                        </div>
                        <p class="text-[11px] font-medium text-slate-400 hidden sm:block">منصة مَطَلّ الرقمية للسياحة · تحديث حي ومباشر للمؤشرات المالية والتشغيلية</p>
                    </div>
                </div>

                <!-- Executive Top Actions -->
                <div class="flex items-center gap-2.5 sm:gap-3">
                    
                    <!-- Saudi Time Clock -->
                    <div class="hidden xl:flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-white/5 border border-white/10 text-xs font-bold text-slate-300">
                        <i class="fa-regular fa-clock text-cyan-400"></i>
                        <span id="saudiClock">--:--:--</span>
                        <span class="text-[10px] text-cyan-400 font-bold">مكة المكرمة</span>
                    </div>

                    <!-- Date Slicers (Power BI filter bar) -->
                    <div class="hidden md:flex items-center p-1 rounded-xl bg-white/5 border border-white/10 text-xs font-bold">
                        <button type="button" class="px-2.5 py-1 rounded-lg pbi-pill-active" data-period="today">اليوم</button>
                        <button type="button" class="px-2.5 py-1 rounded-lg text-slate-400 hover:text-white transition" data-period="7d">7 أيام</button>
                        <button type="button" class="px-2.5 py-1 rounded-lg text-slate-400 hover:text-white transition" data-period="30d">30 يوماً</button>
                        <button type="button" class="px-2.5 py-1 rounded-lg text-slate-400 hover:text-white transition" data-period="year">هذا العام</button>
                    </div>

                    <!-- Print / Export Report -->
                    <button type="button" onclick="window.print()" class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-cyan-500/15 border border-cyan-500/30 text-cyan-300 hover:bg-cyan-500 hover:text-white transition text-xs font-bold shadow-sm" title="طباعة أو تصدير التقرير PDF">
                        <i class="fa-solid fa-file-pdf"></i>
                        <span class="hidden sm:inline">تصدير التقرير</span>
                    </button>

                    <!-- Live Refresh -->
                    <button type="button" onclick="window.location.reload()" class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 text-slate-300 hover:text-white hover:border-cyan-400 flex items-center justify-center transition" title="تحديث فوري">
                        <i class="fa-solid fa-arrows-rotate text-sm hover:rotate-180 transition-transform duration-500"></i>
                    </button>

                </div>

            </header>

            <!-- Main Scrollable Canvas -->
            <main class="flex-1 p-4 sm:p-8 space-y-8">
                @yield('content')
            </main>

            <!-- Executive Footer -->
            <footer class="no-print border-t border-cyan-500/10 px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-400">
                <p>جميع الحقوق محفوظة © {{ date('Y') }} لمنظومة <span class="text-cyan-400 font-bold">مَطَلّ (MATAL)</span> · بوابة الإدارة والتحليلات المركزية</p>
                <div class="flex items-center gap-4 text-[11px]">
                    <span class="inline-flex items-center gap-1 text-emerald-400"><i class="fa-solid fa-shield-check"></i> تشفير آمن 256-bit</span>
                    <span>·</span>
                    <span>الإصدار Enterprise 2.4</span>
                </div>
            </footer>

        </div>

    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Clock
            function updateClock() {
                const clock = document.getElementById('saudiClock');
                if (!clock) return;
                const now = new Date();
                clock.textContent = now.toLocaleTimeString('ar-SA', { timeZone: 'Asia/Riyadh', hour12: true });
            }
            setInterval(updateClock, 1000);
            updateClock();

            // Mobile sidebar toggle
            const sidebar = document.getElementById('adminSidebar');
            const backdrop = document.getElementById('adminSidebarBackdrop');
            const openBtn = document.getElementById('openSidebarBtn');
            const closeBtn = document.getElementById('closeSidebarBtn');

            if (openBtn && sidebar && backdrop) {
                openBtn.addEventListener('click', () => {
                    sidebar.classList.remove('translate-x-full');
                    backdrop.classList.remove('hidden');
                });
                const close = () => {
                    sidebar.classList.add('translate-x-full');
                    backdrop.classList.add('hidden');
                };
                closeBtn?.addEventListener('click', close);
                backdrop.addEventListener('click', close);
            }

            // Period Slicer switch active class
            document.querySelectorAll('[data-period]').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.querySelectorAll('[data-period]').forEach(b => {
                        b.className = 'px-2.5 py-1 rounded-lg text-slate-400 hover:text-white transition';
                    });
                    btn.className = 'px-2.5 py-1 rounded-lg pbi-pill-active';
                });
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
