@extends('layouts.admin')

@section('title', 'لوحة تحكم وتحليلات الإدارة · Power BI Executive Dashboard')

@section('content')

@php
    $statusMap = [
        'confirmed' => ['مؤكد (نشط)', 'bg-cyan-500/15 text-cyan-300 border-cyan-500/30'],
        'pending'   => ['قيد المراجعة', 'bg-amber-500/15 text-amber-300 border-amber-500/30'],
        'completed' => ['مكتمل بنجاح', 'bg-emerald-500/15 text-emerald-300 border-emerald-500/30'],
        'cancelled' => ['ملغي', 'bg-rose-500/15 text-rose-300 border-rose-500/30'],
    ];
@endphp

<!-- ================= EXECUTIVE KPI TILES (POWER BI CARDS) ================= -->
<div id="overview" class="space-y-6">

    <!-- Top Alert & System Throughput Banner -->
    <div class="pbi-card p-4 sm:p-5 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 border-l-4 border-l-cyan-400">
        <div class="flex items-center gap-3.5">
            <div class="w-11 h-11 rounded-2xl bg-cyan-500/15 text-cyan-300 border border-cyan-500/30 flex items-center justify-center shrink-0">
                <i class="fa-solid fa-chart-line text-lg"></i>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <span class="text-sm font-black text-white">مركز الرقابة المباشرة والتحليلات الشاملة لمنطقة جازان</span>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-black bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">مباشر 100%</span>
                </div>
                <p class="text-xs text-slate-400 mt-0.5">تغطية لكافة المسارات الستة، أرخبيل جزر فرسان، قمم فيفا، ومزارع البن الخولاني.</p>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-3 text-xs">
            <span class="px-3 py-1.5 rounded-xl bg-white/5 border border-white/10 text-slate-300 font-bold">
                <i class="fa-solid fa-server text-cyan-400 ml-1"></i> كفاءة الخوادم: 99.98%
            </span>
            <span class="px-3 py-1.5 rounded-xl bg-white/5 border border-white/10 text-slate-300 font-bold">
                <i class="fa-solid fa-users text-sky-400 ml-1"></i> إجمالي المسجلين: {{ $stats['total_users'] }}
            </span>
        </div>
    </div>

    <!-- Power BI KPI Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">

        <!-- KPI 1: Gross Revenue -->
        <div class="pbi-card p-5 relative overflow-hidden flex flex-col justify-between">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-black text-slate-400">إجمالي الإيرادات</span>
                <span class="w-8 h-8 rounded-xl bg-cyan-500/15 text-cyan-300 border border-cyan-500/25 flex items-center justify-center text-xs">
                    <i class="fa-solid fa-sack-dollar"></i>
                </span>
            </div>
            <div>
                <div class="text-2xl font-black text-white tracking-tight">
                    {{ number_format($stats['total_revenue'], 0) }} <span class="text-xs font-bold text-cyan-400">ر.س</span>
                </div>
                <div class="flex items-center gap-1.5 mt-2">
                    <span class="inline-flex items-center gap-1 text-[11px] font-black text-emerald-400 bg-emerald-500/15 px-1.5 py-0.5 rounded-md">
                        <i class="fa-solid fa-arrow-trend-up text-[9px]"></i> +28.4%
                    </span>
                    <span class="text-[10px] text-slate-500">عن الربع الماضي</span>
                </div>
            </div>
            <!-- Sparkline Visual Bar -->
            <div class="w-full h-1 bg-slate-800 rounded-full mt-3 overflow-hidden">
                <div class="h-full bg-gradient-to-r from-cyan-500 to-sky-400 rounded-full" style="width: 78%;"></div>
            </div>
        </div>

        <!-- KPI 2: Total Bookings -->
        <div class="pbi-card p-5 relative overflow-hidden flex flex-col justify-between">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-black text-slate-400">إجمالي الحجوزات</span>
                <span class="w-8 h-8 rounded-xl bg-sky-500/15 text-sky-300 border border-sky-500/25 flex items-center justify-center text-xs">
                    <i class="fa-solid fa-ticket"></i>
                </span>
            </div>
            <div>
                <div class="text-2xl font-black text-white tracking-tight">
                    {{ $stats['total_bookings'] }} <span class="text-xs font-bold text-slate-400">حجز</span>
                </div>
                <div class="flex items-center gap-1.5 mt-2 text-[11px] font-bold text-slate-400">
                    <span class="text-cyan-300">{{ $stats['confirmed_bookings'] }} مؤكد</span> · 
                    <span class="text-emerald-300">{{ $stats['completed_bookings'] }} مكتمل</span>
                </div>
            </div>
            <div class="w-full h-1 bg-slate-800 rounded-full mt-3 overflow-hidden">
                <div class="h-full bg-gradient-to-r from-sky-500 to-cyan-400 rounded-full" style="width: 88%;"></div>
            </div>
        </div>

        <!-- KPI 3: Average Order Value (AOV) -->
        <div class="pbi-card p-5 relative overflow-hidden flex flex-col justify-between">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-black text-slate-400">متوسط قيمة الحجز</span>
                <span class="w-8 h-8 rounded-xl bg-teal-500/15 text-teal-300 border border-teal-500/25 flex items-center justify-center text-xs">
                    <i class="fa-solid fa-receipt"></i>
                </span>
            </div>
            <div>
                <div class="text-2xl font-black text-white tracking-tight">
                    {{ number_format($stats['avg_booking_price'], 0) }} <span class="text-xs font-bold text-teal-400">ر.س</span>
                </div>
                <div class="flex items-center gap-1.5 mt-2">
                    <span class="inline-flex items-center gap-1 text-[11px] font-black text-emerald-400 bg-emerald-500/15 px-1.5 py-0.5 rounded-md">
                        <i class="fa-solid fa-arrow-trend-up text-[9px]"></i> +14.2%
                    </span>
                    <span class="text-[10px] text-slate-500">لكل تجربة</span>
                </div>
            </div>
            <div class="w-full h-1 bg-slate-800 rounded-full mt-3 overflow-hidden">
                <div class="h-full bg-gradient-to-r from-teal-500 to-emerald-400 rounded-full" style="width: 65%;"></div>
            </div>
        </div>

        <!-- KPI 4: Completion Rate -->
        <div class="pbi-card p-5 relative overflow-hidden flex flex-col justify-between">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-black text-slate-400">معدل الإنجاز</span>
                <span class="w-8 h-8 rounded-xl bg-emerald-500/15 text-emerald-300 border border-emerald-500/25 flex items-center justify-center text-xs">
                    <i class="fa-solid fa-circle-check"></i>
                </span>
            </div>
            <div>
                <div class="text-2xl font-black text-white tracking-tight">
                    {{ $stats['completion_rate'] }}%
                </div>
                <div class="text-[11px] font-bold text-emerald-400 mt-2">
                    كفاءة تشغيلية ممتازة
                </div>
            </div>
            <div class="w-full h-1 bg-slate-800 rounded-full mt-3 overflow-hidden">
                <div class="h-full bg-emerald-400 rounded-full" style="width: {{ $stats['completion_rate'] }}%;"></div>
            </div>
        </div>

        <!-- KPI 5: Customer Satisfaction (CSAT) -->
        <div class="pbi-card p-5 relative overflow-hidden flex flex-col justify-between">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-black text-slate-400">رضا الزوار (CSAT)</span>
                <span class="w-8 h-8 rounded-xl bg-amber-500/15 text-amber-300 border border-amber-500/25 flex items-center justify-center text-xs">
                    <i class="fa-solid fa-star"></i>
                </span>
            </div>
            <div>
                <div class="text-2xl font-black text-white tracking-tight flex items-center gap-1.5">
                    <span>{{ number_format($stats['avg_rating'], 2) }}</span>
                    <i class="fa-solid fa-star text-base"></i>
                </div>
                <div class="text-[11px] font-bold text-slate-400 mt-2">
                    من {{ $stats['total_reviews'] }} تقييم موثق
                </div>
            </div>
            <div class="w-full h-1 bg-slate-800 rounded-full mt-3 overflow-hidden">
                <div class="h-full bg-amber-400 rounded-full" style="width: {{ ($stats['avg_rating'] / 5) * 100 }}%;"></div>
            </div>
        </div>

        <!-- KPI 6: Urgent Inquiries -->
        <div class="pbi-card p-5 relative overflow-hidden flex flex-col justify-between">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-black text-slate-400">استفسارات واردة</span>
                <span class="w-8 h-8 rounded-xl bg-rose-500/15 text-rose-300 border border-rose-500/25 flex items-center justify-center text-xs">
                    <i class="fa-solid fa-envelope"></i>
                </span>
            </div>
            <div>
                <div class="text-2xl font-black text-white tracking-tight flex items-center gap-2">
                    <span>{{ $stats['unread_contacts'] }}</span>
                    @if($stats['unread_contacts'] > 0)
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-black bg-rose-500/20 text-rose-300 border border-rose-500/30">جديد</span>
                    @endif
                </div>
                <div class="text-[11px] font-bold text-slate-400 mt-2">
                    طلبات شراكة واستفسار
                </div>
            </div>
            <div class="w-full h-1 bg-slate-800 rounded-full mt-3 overflow-hidden">
                <div class="h-full bg-rose-400 rounded-full" style="width: 45%;"></div>
            </div>
        </div>

    </div>

</div>

<!-- ================= POWER BI PRIMARY CHARTS (2 COLUMNS) ================= -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

    <!-- Chart 1: Revenue & Bookings Multi-Axis Line / Spline Area Chart (8 Cols) -->
    <div id="revenue-analytics" class="lg:col-span-8 pbi-card p-6 sm:p-7">
        
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 pb-4 border-b border-cyan-500/15">
            <div>
                <div class="flex items-center gap-2.5">
                    <span class="w-3 h-3 rounded-full bg-cyan-400"></span>
                    <h3 class="text-base sm:text-lg font-black text-white">مسار الإيرادات الشهرية وتدفق الحجوزات</h3>
                </div>
                <p class="text-xs text-slate-400 mt-1">تتبع مؤشرات النمو المالي وحجم الحجوزات الفعلي على مدار 12 شهراً</p>
            </div>

            <div class="flex items-center gap-3 text-xs font-bold">
                <span class="flex items-center gap-1.5 text-cyan-300">
                    <span class="w-3 h-3 rounded-full bg-cyan-400 inline-block"></span> الإيرادات (ر.س)
                </span>
                <span class="flex items-center gap-1.5 text-sky-300">
                    <span class="w-3 h-3 rounded-full bg-sky-400 inline-block"></span> عدد الحجوزات
                </span>
            </div>
        </div>

        <!-- Canvas Container -->
        <div class="relative w-full h-[320px] sm:h-[380px]">
            <canvas id="revenueTrendChart"></canvas>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-6 pt-5 border-t border-cyan-500/15 text-center">
            <div class="p-3 rounded-xl bg-slate-900/60 border border-cyan-500/10">
                <div class="text-xs text-slate-400 font-bold">ذروة الإيرادات</div>
                <div class="text-base font-black text-cyan-300 mt-0.5">ديسمبر (64.5K ر.س)</div>
            </div>
            <div class="p-3 rounded-xl bg-slate-900/60 border border-cyan-500/10">
                <div class="text-xs text-slate-400 font-bold">أعلى إقبال سياحي</div>
                <div class="text-base font-black text-sky-300 mt-0.5">موسم الشتاء (108 حجوزات)</div>
            </div>
            <div class="p-3 rounded-xl bg-slate-900/60 border border-cyan-500/10">
                <div class="text-xs text-slate-400 font-bold">معدل النمو السنوي</div>
                <div class="text-base font-black text-emerald-400 mt-0.5">+42.6% YoY</div>
            </div>
            <div class="p-3 rounded-xl bg-slate-900/60 border border-cyan-500/10">
                <div class="text-xs text-slate-400 font-bold">إجمالي الزوار المتوقع</div>
                <div class="text-base font-black text-amber-300 mt-0.5">{{ $stats['total_visitors'] * 4 }}+ سائح</div>
            </div>
        </div>

    </div>

    <!-- Chart 2: Terrain & Category Distribution Doughnut (4 Cols) -->
    <div id="terrain-analytics" class="lg:col-span-4 pbi-card p-6 sm:p-7">
        
        <div class="mb-6 pb-4 border-b border-cyan-500/15">
            <div class="flex items-center gap-2.5">
                <span class="w-3 h-3 rounded-full bg-sky-400"></span>
                <h3 class="text-base sm:text-lg font-black text-white">توزيع الحجوزات حسب التضاريس</h3>
            </div>
            <p class="text-xs text-slate-400 mt-1">نسبة إقبال السياح على كل بيئة جغرافية في جازان</p>
        </div>

        <!-- Doughnut Canvas -->
        <div class="relative w-full h-[260px] flex items-center justify-center">
            <canvas id="terrainDoughnutChart"></canvas>
            <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none text-center">
                <span class="text-2xl font-black text-white">100%</span>
                <span class="text-[10px] font-bold text-cyan-400 uppercase tracking-widest">تنوع بيئي</span>
            </div>
        </div>

        <!-- Custom Legend -->
        <div class="space-y-2 mt-6 pt-4 border-t border-cyan-500/15 text-xs font-bold">
            @foreach($terrainCategories['labels'] as $idx => $label)
                <div class="flex items-center justify-between p-2 rounded-xl bg-slate-900/40 hover:bg-slate-900/80 transition">
                    <span class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full shrink-0" style="background-color: {{ $terrainCategories['colors'][$idx] }};"></span>
                        <span class="text-slate-300">{{ $label }}</span>
                    </span>
                    <span class="font-black text-white">{{ $terrainCategories['data'][$idx] }}%</span>
                </div>
            @endforeach
        </div>

    </div>

</div>

<!-- ================= SECONDARY ANALYTICS (2 CHARTS: FUNNEL & PAYMENT) ================= -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

    <!-- Chart 3: Booking Status Funnel (6 Cols) -->
    <div id="conversion-funnel" class="lg:col-span-6 pbi-card p-6 sm:p-7">
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-cyan-500/15">
            <div>
                <div class="flex items-center gap-2.5">
                    <span class="w-3 h-3 rounded-full bg-emerald-400"></span>
                    <h3 class="text-base sm:text-lg font-black text-white">قمع حالات الحجوزات والتحويل</h3>
                </div>
                <p class="text-xs text-slate-400 mt-1">معدل تحول الطلبات من مراجعة إلى تأكيد وإتمام</p>
            </div>
            <span class="px-2.5 py-1 rounded-lg text-xs font-bold bg-emerald-500/15 text-emerald-300 border border-emerald-500/30">
                نسبة النجاح: {{ $stats['completion_rate'] }}%
            </span>
        </div>

        <div class="relative w-full h-[260px]">
            <canvas id="statusFunnelChart"></canvas>
        </div>
    </div>

    <!-- Chart 4: Payment Gateways Breakdown (6 Cols) -->
    <div class="lg:col-span-6 pbi-card p-6 sm:p-7">
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-cyan-500/15">
            <div>
                <div class="flex items-center gap-2.5">
                    <span class="w-3 h-3 rounded-full bg-teal-400"></span>
                    <h3 class="text-base sm:text-lg font-black text-white">بوابات الدفع الإلكتروني المفضلة</h3>
                </div>
                <p class="text-xs text-slate-400 mt-1">توزيع العمليات حسب وسيلة السداد الرقمية</p>
            </div>
            <span class="px-2.5 py-1 rounded-lg text-xs font-bold bg-cyan-500/15 text-cyan-300 border border-cyan-500/30">
                أمان 100%
            </span>
        </div>

        <div class="relative w-full h-[260px]">
            <canvas id="paymentMethodsChart"></canvas>
        </div>
    </div>

</div>

<!-- ================= LIVE OPERATIONAL GRID & INQUIRIES ================= -->
<div class="grid grid-cols-1 xl:grid-cols-12 gap-6 items-start">

    <!-- Live Bookings Management Grid (8 Cols) -->
    <div id="bookings-section" class="xl:col-span-8 pbi-card p-6 sm:p-7">
        
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 pb-4 border-b border-cyan-500/15">
            <div>
                <div class="flex items-center gap-2.5">
                    <span class="w-3 h-3 rounded-full bg-cyan-400 animate-ping"></span>
                    <h3 class="text-base sm:text-lg font-black text-white">جدول الحجوزات والعمليات الحية</h3>
                </div>
                <p class="text-xs text-slate-400 mt-1">إدارة الحجوزات، تحديث الحالات التشغيلية، ومطابقة التذاكر</p>
            </div>

            <!-- Quick Filter Chips -->
            <div class="flex flex-wrap items-center gap-1.5 text-xs font-bold">
                <button type="button" class="px-2.5 py-1 rounded-lg bg-cyan-500/20 text-cyan-300 border border-cyan-500/30">الكل ({{ $stats['total_bookings'] }})</button>
                <button type="button" class="px-2.5 py-1 rounded-lg bg-white/5 text-slate-400 hover:text-white border border-white/10">مؤكد</button>
                <button type="button" class="px-2.5 py-1 rounded-lg bg-white/5 text-slate-400 hover:text-white border border-white/10">قيد المراجعة</button>
                <button type="button" class="px-2.5 py-1 rounded-lg bg-white/5 text-slate-400 hover:text-white border border-white/10">مكتمل</button>
            </div>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto -mx-2 px-2">
            <table class="w-full text-right text-xs">
                <thead>
                    <tr class="border-b border-cyan-500/20 text-slate-400 uppercase tracking-wider font-black">
                        <th class="py-3 px-3">رمز الحجز</th>
                        <th class="py-3 px-3">السائح</th>
                        <th class="py-3 px-3">التجربة / المسار</th>
                        <th class="py-3 px-3">التاريخ</th>
                        <th class="py-3 px-3">المبلغ</th>
                        <th class="py-3 px-3">الحالة</th>
                        <th class="py-3 px-3">الإجراء السريع</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/80">
                    @forelse($recentBookings as $bk)
                        @php $st = $statusMap[$bk->status] ?? [$bk->status, 'bg-slate-700 text-slate-200 border-slate-600']; @endphp
                        <tr class="hover:bg-slate-900/60 transition group">
                            <td class="py-3.5 px-3 font-mono font-black text-cyan-400" dir="ltr">
                                {{ $bk->booking_code }}
                            </td>
                            <td class="py-3.5 px-3">
                                <div class="font-bold text-white">{{ $bk->customer_name }}</div>
                                <div class="text-[10px] text-slate-400" dir="ltr">{{ $bk->customer_phone }}</div>
                            </td>
                            <td class="py-3.5 px-3 max-w-[12rem] truncate text-slate-300 font-medium">
                                {{ $bk->bookable?->title ?? 'مسار سياحي في جازان' }}
                            </td>
                            <td class="py-3.5 px-3 text-slate-400 whitespace-nowrap">
                                {{ $bk->trip_date?->format('Y-m-d') ?? 'قريباً' }}
                            </td>
                            <td class="py-3.5 px-3 font-black text-white whitespace-nowrap">
                                {{ number_format($bk->total_price, 2) }} <span class="text-[10px] text-cyan-400 font-bold">ر.س</span>
                            </td>
                            <td class="py-3.5 px-3 whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-black border {{ $st[1] }}">
                                    {{ $st[0] }}
                                </span>
                            </td>
                            <td class="py-3.5 px-3 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <form action="{{ route('admin.bookings.status', $bk->id) }}" method="POST">
                                        @csrf
                                        <select name="status" onchange="this.form.submit()" class="text-[11px] font-bold rounded-lg border border-cyan-500/30 bg-slate-950 text-cyan-200 px-2 py-1 focus:outline-none focus:border-cyan-400 cursor-pointer" aria-label="تحديث حالة الحجز">
                                            @foreach($statusMap as $val => $s)
                                                <option value="{{ $val }}" {{ $bk->status === $val ? 'selected' : '' }}>{{ $s[0] }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                    <a href="{{ route('booking.show', $bk->booking_code) }}" target="_blank" rel="noopener" class="w-7 h-7 rounded-lg bg-cyan-500/15 border border-cyan-500/30 text-cyan-300 hover:bg-cyan-500 hover:text-white flex items-center justify-center transition" title="معاينة التذكرة الرقمية">
                                        <i class="fa-solid fa-up-right-from-square text-[10px]"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-slate-400 font-bold">
                                لا توجد حجوزات مسجلة حالياً.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <!-- Inquiries & Partner Leads Inbox (4 Cols) -->
    <div id="contacts-section" class="xl:col-span-4 pbi-card p-6 sm:p-7">
        
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-cyan-500/15">
            <div>
                <div class="flex items-center gap-2.5">
                    <span class="w-3 h-3 rounded-full bg-rose-400"></span>
                    <h3 class="text-base sm:text-lg font-black text-white">استفسارات الشركاء والزوار</h3>
                </div>
                <p class="text-xs text-slate-400 mt-1">طلبات الانضمام وشراكات النزل والخدمات</p>
            </div>
            <span class="px-2.5 py-1 rounded-full text-xs font-black bg-rose-500/20 text-rose-300 border border-rose-500/30">
                {{ $stats['unread_contacts'] }} غير مقروء
            </span>
        </div>

        <div class="space-y-3 max-h-[32rem] overflow-y-auto pl-1">
            @forelse($recentContacts as $msg)
                <div class="p-4 rounded-2xl border transition-all duration-300 {{ $msg->is_read ? 'bg-slate-900/40 border-slate-800' : 'bg-gradient-to-br from-cyan-950/40 to-slate-900/90 border-cyan-500/40 shadow-lg shadow-cyan-950/20' }}">
                    <div class="flex items-center justify-between gap-2 mb-2">
                        <span class="flex items-center gap-2 font-black text-white text-xs">
                            @unless($msg->is_read)
                                <span class="w-2 h-2 rounded-full bg-cyan-400 animate-ping"></span>
                            @endunless
                            {{ $msg->name }}
                        </span>
                        <span class="text-[10px] text-slate-400 font-medium whitespace-nowrap">{{ $msg->created_at->diffForHumans() }}</span>
                    </div>

                    <div class="text-[11px] font-bold text-cyan-300 mb-1.5">{{ $msg->subject ?? 'طلب استفسار' }}</div>
                    <p class="text-xs text-slate-300/80 leading-relaxed line-clamp-3">{{ $msg->message }}</p>

                    <div class="flex items-center justify-between gap-2 mt-3 pt-2.5 border-t border-cyan-500/10 text-[11px]">
                        @if($msg->phone)
                            <span class="text-slate-400" dir="ltr"><i class="fa-solid fa-phone text-cyan-400 ml-1"></i> {{ $msg->phone }}</span>
                        @else
                            <span class="text-slate-400" dir="ltr"><i class="fa-solid fa-envelope text-cyan-400 ml-1"></i> {{ $msg->email }}</span>
                        @endif

                        @if(!$msg->is_read)
                            <form action="{{ route('admin.contacts.read', $msg->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-cyan-400 hover:text-white font-black transition flex items-center gap-1">
                                    <i class="fa-solid fa-check-double"></i> <span>تحديد كمقروء</span>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-10 rounded-2xl border border-dashed border-cyan-500/20 text-slate-400 text-xs font-bold">
                    صندوق الرسائل والطلبات فارغ حالياً.
                </div>
            @endforelse
        </div>

    </div>

</div>

<!-- ================= TOP DESTINATIONS PERFORMANCE MATRIX ================= -->
<div id="destinations-section" class="pbi-card p-6 sm:p-7">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 pb-4 border-b border-cyan-500/15">
        <div>
            <div class="flex items-center gap-2.5">
                <span class="w-3 h-3 rounded-full bg-amber-400"></span>
                <h3 class="text-base sm:text-lg font-black text-white">مصفوفة الوجهات السياحية الأعلى تقييماً</h3>
            </div>
            <p class="text-xs text-slate-400 mt-1">أعلى الوجهات في رضا الزوار، الإقبال الميداني، ومعدلات التقييم الإيجابي</p>
        </div>

        <span class="px-3 py-1.5 rounded-xl bg-amber-500/15 text-amber-300 border border-amber-500/30 text-xs font-bold">
            متوسط التقييم الإجمالي: {{ number_format($stats['avg_rating'], 2) }} / 5.0
        </span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
        @foreach($topDestinations as $i => $dest)
            <a href="{{ route('destinations.show', $dest->slug) }}" target="_blank" rel="noopener" class="group p-4 rounded-2xl bg-slate-900/50 border border-cyan-500/15 hover:border-cyan-400/50 hover:bg-slate-900/80 transition-all duration-300 flex flex-col justify-between">
                <div>
                    <div class="relative h-32 rounded-xl overflow-hidden mb-3">
                        <img src="{{ $dest->image }}" alt="{{ $dest->title }}" loading="lazy" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <span class="absolute top-2 right-2 w-7 h-7 rounded-lg bg-black/60 text-white text-xs font-black flex items-center justify-center backdrop-blur-md">
                            #{{ $i + 1 }}
                        </span>
                        <span class="absolute bottom-2 left-2 px-2 py-0.5 rounded-md bg-black/60 text-amber-300 text-[11px] font-black flex items-center gap-1 backdrop-blur-md">
                            <i class="fa-solid fa-star text-[10px]"></i> {{ number_format($dest->rating, 1) }}
                        </span>
                    </div>

                    <h4 class="font-black text-white text-sm group-hover:text-cyan-300 transition truncate">{{ $dest->title }}</h4>
                    <p class="text-[11px] text-slate-400 mt-1 line-clamp-2 leading-relaxed">{{ $dest->subtitle ?? 'معلم سياحي رئيسي في جازان' }}</p>
                </div>

                <div class="mt-4 pt-3 border-t border-slate-800 flex items-center justify-between text-[11px] font-bold">
                    <span class="text-cyan-400 group-hover:translate-x-[-3px] transition inline-flex items-center gap-1">
                        معاينة الوجهة <i class="fa-solid fa-arrow-left text-[9px]"></i>
                    </span>
                    <span class="text-slate-500">{{ $dest->reviews_count ?? 12 }}+ تقييم</span>
                </div>
            </a>
        @endforeach
    </div>

</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Chart.js Global Default Theme Settings for Power BI Dark Canvas
        Chart.defaults.color = '#94A3B8';
        Chart.defaults.font.family = "'Tajawal', sans-serif";

        // ================= CHART 1: REVENUE & BOOKING TRENDS (MULTI-AXIS SPLINE AREA) =================
        const ctxRev = document.getElementById('revenueTrendChart');
        if (ctxRev) {
            const gradRev = ctxRev.getContext('2d').createLinearGradient(0, 0, 0, 350);
            gradRev.addColorStop(0, 'rgba(6, 182, 212, 0.45)');
            gradRev.addColorStop(1, 'rgba(6, 182, 212, 0.02)');

            new Chart(ctxRev, {
                type: 'line',
                data: {
                    labels: @json($months),
                    datasets: [
                        {
                            label: 'الإيرادات التقديرية (ر.س)',
                            data: @json($monthlyRevenue),
                            borderColor: '#06B6D4',
                            borderWidth: 3,
                            backgroundColor: gradRev,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#06B6D4',
                            pointBorderColor: '#FFFFFF',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 7,
                            yAxisID: 'yRevenue'
                        },
                        {
                            label: 'عدد الحجوزات',
                            data: @json($monthlyBookings),
                            borderColor: '#38BDF8',
                            borderWidth: 2,
                            borderDash: [5, 5],
                            backgroundColor: 'transparent',
                            tension: 0.4,
                            pointBackgroundColor: '#38BDF8',
                            pointBorderColor: '#FFFFFF',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 7,
                            yAxisID: 'yBookings'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: { mode: 'index', intersect: false },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#071722',
                            titleColor: '#FFFFFF',
                            bodyColor: '#38BDF8',
                            borderColor: 'rgba(6, 182, 212, 0.4)',
                            borderWidth: 1,
                            padding: 12,
                            boxPadding: 6,
                            callbacks: {
                                label: function(context) {
                                    if (context.datasetIndex === 0) {
                                        return ' الإيرادات: ' + context.parsed.y.toLocaleString('ar-SA') + ' ر.س';
                                    }
                                    return ' الحجوزات: ' + context.parsed.y + ' حجز';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { color: 'rgba(255, 255, 255, 0.05)' },
                            ticks: { font: { size: 11, weight: 'bold' } }
                        },
                        yRevenue: {
                            type: 'linear',
                            position: 'left',
                            grid: { color: 'rgba(255, 255, 255, 0.05)' },
                            ticks: {
                                font: { size: 11, weight: 'bold' },
                                callback: function(val) { return (val / 1000) + 'K ر.س'; }
                            }
                        },
                        yBookings: {
                            type: 'linear',
                            position: 'right',
                            grid: { drawOnChartArea: false },
                            ticks: {
                                font: { size: 11, weight: 'bold' },
                                callback: function(val) { return val + ' حجز'; }
                            }
                        }
                    }
                }
            });
        }

        // ================= CHART 2: TERRAIN DOUGHNUT CHART =================
        const ctxTerrain = document.getElementById('terrainDoughnutChart');
        if (ctxTerrain) {
            new Chart(ctxTerrain, {
                type: 'doughnut',
                data: {
                    labels: @json($terrainCategories['labels']),
                    datasets: [{
                        data: @json($terrainCategories['data']),
                        backgroundColor: @json($terrainCategories['colors']),
                        borderColor: '#071722',
                        borderWidth: 4,
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '72%',
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#071722',
                            borderColor: 'rgba(6, 182, 212, 0.4)',
                            borderWidth: 1,
                            padding: 10,
                            callbacks: {
                                label: function(c) { return ' ' + c.label + ': ' + c.parsed + '% من الطلب'; }
                            }
                        }
                    }
                }
            });
        }

        // ================= CHART 3: BOOKING STATUS FUNNEL (BAR) =================
        const ctxFunnel = document.getElementById('statusFunnelChart');
        if (ctxFunnel) {
            new Chart(ctxFunnel, {
                type: 'bar',
                data: {
                    labels: @json($statusFunnel['labels']),
                    datasets: [{
                        data: @json($statusFunnel['data']),
                        backgroundColor: @json($statusFunnel['colors']),
                        borderRadius: 10,
                        borderSkipped: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#071722',
                            borderColor: 'rgba(6, 182, 212, 0.4)',
                            borderWidth: 1,
                            padding: 10
                        }
                    },
                    scales: {
                        x: {
                            grid: { color: 'rgba(255, 255, 255, 0.05)' },
                            ticks: { font: { size: 11, weight: 'bold' } }
                        },
                        y: {
                            grid: { color: 'rgba(255, 255, 255, 0.05)' },
                            ticks: { font: { size: 11, weight: 'bold' } }
                        }
                    }
                }
            });
        }

        // ================= CHART 4: PAYMENT METHODS (DOUGHNUT) =================
        const ctxPayment = document.getElementById('paymentMethodsChart');
        if (ctxPayment) {
            new Chart(ctxPayment, {
                type: 'doughnut',
                data: {
                    labels: @json($paymentMethods['labels']),
                    datasets: [{
                        data: @json($paymentMethods['data']),
                        backgroundColor: @json($paymentMethods['colors']),
                        borderColor: '#071722',
                        borderWidth: 4,
                        hoverOffset: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '60%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                boxHeight: 12,
                                padding: 16,
                                font: { size: 11, weight: 'bold' },
                                color: '#E2E8F0'
                            }
                        },
                        tooltip: {
                            backgroundColor: '#071722',
                            borderColor: 'rgba(6, 182, 212, 0.4)',
                            borderWidth: 1,
                            padding: 10,
                            callbacks: {
                                label: function(c) { return ' ' + c.label + ': ' + c.parsed + '%'; }
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endpush
