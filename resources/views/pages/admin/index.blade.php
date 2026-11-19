@extends('layouts.app')

@section('title', 'لوحة تحكم المنصة · مَطَلّ')

@section('content')

@php
    $kpis = [
        ['fa-ticket',      'إجمالي الحجوزات',    $stats['total_bookings'],      0, '',      'نمو مستمر +40%'],
        ['fa-sack-dollar', 'الإيرادات التقديرية', (float) $stats['total_revenue'], 2, ' ر.س', 'عمولات ومبيعات مباشرة'],
        ['fa-location-dot', 'المواقع المسجلة',    $stats['total_destinations'],  0, '',      'من أصل 500+ مستهدف'],
        ['fa-route',       'المسارات النشطة',     $stats['total_routes'],        0, '',      'تغطي 6 تصنيفات رئيسية'],
    ];
    $mini = [
        ['fa-users', 'المستخدمون', $stats['total_users']],
        ['fa-calendar-days', 'الفعاليات', $stats['total_events']],
        ['fa-comments', 'التقييمات', $stats['total_reviews']],
        ['fa-envelope', 'رسائل غير مقروءة', $stats['unread_contacts']],
    ];
    $statusMap = [
        'confirmed' => ['مؤكد', 'bg-[#06B6D4]/15 text-[#0891B2]'],
        'pending'   => ['قيد المراجعة', 'bg-[#38BDF8]/15 text-[#0e3b4d]'],
        'completed' => ['مكتمل', 'bg-[#164E63] text-white'],
        'cancelled' => ['ملغي', 'bg-[#164E63]/10 text-[#164E63]/55'],
    ];
    $quick = [
        ['routes.index', 'fa-route', 'المسارات'], ['destinations.index', 'fa-mountain-sun', 'الوجهات'],
        ['events.index', 'fa-calendar-days', 'الفعاليات'], ['map.index', 'fa-map-location-dot', 'الخريطة'],
    ];
@endphp

{{-- ================= HEADER ================= --}}
<section class="mg-aurora relative overflow-hidden pt-32 sm:pt-40 pb-32 px-4 text-white">
    <div class="mg-orb mg-orb-sky w-96 h-96 -top-24 -right-16" data-speed="0.1"></div>
    <div class="mg-orb mg-orb-cyan w-80 h-80 bottom-0 -left-16" data-speed="0.08"></div>
    <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 26px 26px;"></div>

    <div class="relative z-[2] max-w-7xl mx-auto flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="text-right">
            <span class="mg-badge mg-badge-cyan mg-reveal"><i class="fa-solid fa-shield-halved"></i> لوحة الإدارة والتحكم</span>
            <h1 class="mt-4 text-3xl sm:text-5xl font-black leading-tight mg-reveal" style="--d: .08s">مؤشرات أداء منصة مَطَلّ <span class="mg-text-grad">(KPIs)</span></h1>
        </div>
        <div class="flex flex-wrap items-center gap-3 mg-reveal" style="--d: .16s">
            <span class="mg-badge !text-xs !py-2 !px-4"><i class="fa-solid fa-user-shield text-[#38BDF8]"></i> حساب الإدارة: {{ Auth::user()->name }}</span>
            <a href="{{ route('home') }}" class="mg-btn-ghost !text-white !bg-white/10 !border-white/35 !py-2.5 !text-sm"><i class="fa-solid fa-eye"></i><span>معاينة الواجهة الأمامية</span></a>
        </div>
    </div>

    <div class="mg-wave">
        <svg viewBox="0 0 1440 80" preserveAspectRatio="none" aria-hidden="true">
            <path d="M0,48 C180,96 360,0 600,40 C840,80 1080,8 1260,40 C1350,56 1410,52 1440,44 L1440,80 L0,80 Z" fill="#F8FCFD"/>
        </svg>
    </div>
</section>

<section class="relative px-4 pb-24 -mt-20 z-10 overflow-hidden">
    <div class="mg-orb mg-orb-cyan w-96 h-96 top-40 -left-24" data-speed="0.08"></div>

    <div class="relative z-[2] max-w-7xl mx-auto space-y-8">

        {{-- ================= KPI CARDS ================= --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mg-perspective" data-stagger="0.1">
            @foreach($kpis as $k)
                <div class="mg-card mg-reveal mg-reveal-scale group p-5 sm:p-7 bg-white/95 backdrop-blur-xl" data-tilt-max="9">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs sm:text-sm font-black text-[#164E63]/75">{{ $k[1] }}</span>
                        <span class="mg-icon-tile mg-pop !w-11 !h-11 !text-base {{ $loop->even ? 'mg-icon-tile-dark' : '' }}"><i class="fa-solid {{ $k[0] }}"></i></span>
                    </div>
                    <div class="mg-stat-num !text-3xl sm:!text-4xl">
                        <span data-counter="{{ $k[2] }}" data-decimals="{{ $k[3] }}" data-suffix="{{ $k[4] }}">{{ number_format($k[2], $k[3]) }}{{ $k[4] }}</span>
                    </div>
                    <div class="mt-3 text-[11px] font-bold text-[#0891B2]">{{ $k[5] }}</div>
                </div>
            @endforeach
        </div>

        {{-- Secondary stats --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4" data-stagger="0.08">
            @foreach($mini as $m)
                <div class="mg-reveal flex items-center gap-3 rounded-2xl bg-white border border-[#06B6D4]/15 px-4 py-3.5 shadow-sm hover:border-[#06B6D4]/50 hover:-translate-y-0.5 transition-all duration-300">
                    <span class="w-10 h-10 rounded-xl bg-[#E0F2FE] text-[#06B6D4] flex items-center justify-center text-sm"><i class="fa-solid {{ $m[0] }}"></i></span>
                    <div>
                        <div class="text-xl font-black text-[#164E63] leading-none"><span data-counter="{{ $m[2] }}">{{ $m[2] }}</span></div>
                        <div class="text-[11px] font-bold text-[#183746]/65 mt-1">{{ $m[1] }}</div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- ================= BOOKINGS + CONTACTS ================= --}}
        <div class="grid xl:grid-cols-3 gap-6 items-start">

            {{-- Bookings table --}}
            <div class="xl:col-span-2 rounded-[2rem] bg-white border border-[#06B6D4]/15 shadow-xl shadow-[#164E63]/5 p-6 sm:p-8 mg-reveal">
                <div class="flex items-center gap-3 mb-6">
                    <span class="mg-icon-tile !w-11 !h-11 !text-base"><i class="fa-solid fa-ticket"></i></span>
                    <h3 class="text-lg sm:text-xl font-black text-[#164E63]">أحدث الحجوزات الواردة</h3>
                </div>
                <div class="overflow-x-auto -mx-2 px-2">
                    <table class="mg-table min-w-[46rem] text-sm">
                        <thead>
                            <tr>
                                <th>رمز الحجز</th><th>اسم السائح</th><th>التجربة / المسار</th><th>المبلغ</th><th>الحالة</th><th>الإجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentBookings as $bk)
                                @php $st = $statusMap[$bk->status] ?? [$bk->status, 'bg-[#164E63]/10 text-[#164E63]']; @endphp
                                <tr class="hover:[&>td]:bg-[#E0F2FE]/50 transition">
                                    <td class="font-black text-[#0891B2]" dir="ltr">{{ $bk->booking_code }}</td>
                                    <td class="font-bold text-[#164E63]">{{ $bk->customer_name }}</td>
                                    <td class="text-[#183746]/80 max-w-[10rem] truncate">{{ $bk->bookable?->title ?? 'مسار' }}</td>
                                    <td class="font-black text-[#164E63] whitespace-nowrap">{{ number_format($bk->total_price, 2) }} ر.س</td>
                                    <td><span class="px-3 py-1 rounded-full text-[11px] font-black whitespace-nowrap {{ $st[1] }}">{{ $st[0] }}</span></td>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <form action="{{ route('admin.bookings.status', $bk->id) }}" method="POST">
                                                @csrf
                                                <select name="status" onchange="this.form.submit()" class="text-xs font-bold rounded-lg border border-[#06B6D4]/30 bg-[#F8FCFD] text-[#164E63] px-2 py-1.5 focus:outline-none focus:border-[#06B6D4]" aria-label="تغيير حالة الحجز">
                                                    @foreach($statusMap as $value => $s)
                                                        <option value="{{ $value }}" {{ $bk->status === $value ? 'selected' : '' }}>{{ $s[0] }}</option>
                                                    @endforeach
                                                </select>
                                            </form>
                                            <a href="{{ route('booking.show', $bk->booking_code) }}" target="_blank" rel="noopener" class="w-8 h-8 rounded-lg bg-[#E0F2FE] text-[#0891B2] hover:bg-gradient-to-br hover:from-[#06B6D4] hover:to-[#38BDF8] hover:text-white flex items-center justify-center transition" title="التذكرة"><i class="fa-solid fa-up-right-from-square text-xs"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="text-center !py-10 font-bold text-[#164E63]/60">لا توجد حجوزات مسجلة حالياً.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Contact messages --}}
            <div class="rounded-[2rem] bg-white border border-[#06B6D4]/15 shadow-xl shadow-[#164E63]/5 p-6 sm:p-8 mg-reveal mg-reveal-left">
                <div class="flex items-center justify-between gap-3 mb-6">
                    <div class="flex items-center gap-3">
                        <span class="mg-icon-tile mg-icon-tile-dark !w-11 !h-11 !text-base"><i class="fa-solid fa-envelope-open-text"></i></span>
                        <h3 class="text-lg sm:text-xl font-black text-[#164E63]">طلبات التواصل</h3>
                    </div>
                    <span class="mg-badge {{ $stats['unread_contacts'] ? 'mg-badge-cyan' : '!bg-[#E0F2FE] !text-[#164E63] !border-[#06B6D4]/25' }} whitespace-nowrap">{{ $stats['unread_contacts'] }} غير مقروء</span>
                </div>
                <div class="space-y-3 max-h-[28rem] overflow-y-auto pl-1">
                    @forelse($recentContacts as $msg)
                        <div class="rounded-2xl border p-4 transition-all duration-300 hover:-translate-y-0.5 {{ $msg->is_read ? 'bg-[#F8FCFD] border-[#06B6D4]/15' : 'bg-gradient-to-br from-[#E0F2FE] to-white border-[#06B6D4]/40 shadow-md shadow-[#06B6D4]/10' }}">
                            <div class="flex items-center justify-between gap-2 mb-1.5">
                                <span class="flex items-center gap-2 font-black text-[#164E63] text-sm">
                                    @unless($msg->is_read)<span class="w-2 h-2 rounded-full bg-[#06B6D4] mg-pulse"></span>@endunless
                                    {{ $msg->name }}
                                </span>
                                <span class="text-[10px] font-bold text-[#183746]/55 whitespace-nowrap">{{ $msg->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="text-xs font-black text-[#0891B2] mb-1">{{ $msg->subject ?? 'طلب استفسار' }}</div>
                            <p class="text-xs text-[#183746]/80 leading-relaxed line-clamp-3">{{ $msg->message }}</p>
                            @if(!$msg->is_read)
                                <form action="{{ route('admin.contacts.read', $msg->id) }}" method="POST" class="mt-3">
                                    @csrf
                                    <button type="submit" class="text-[11px] font-black text-[#0891B2] hover:text-[#164E63] transition">تحديد كمقروء ✓</button>
                                </form>
                            @endif
                        </div>
                    @empty
                        <div class="text-center py-10 rounded-2xl border-2 border-dashed border-[#06B6D4]/30 text-sm font-bold text-[#164E63]/60">صندوق الرسائل فارغ.</div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- ================= TOP DESTINATIONS + QUICK LINKS ================= --}}
        <div class="grid lg:grid-cols-3 gap-6 items-start">
            <div class="lg:col-span-2 rounded-[2rem] bg-white border border-[#06B6D4]/15 shadow-xl shadow-[#164E63]/5 p-6 sm:p-8 mg-reveal">
                <div class="flex items-center gap-3 mb-6">
                    <span class="mg-icon-tile !w-11 !h-11 !text-base"><i class="fa-solid fa-ranking-star"></i></span>
                    <h3 class="text-lg sm:text-xl font-black text-[#164E63]">أعلى الوجهات تقييماً</h3>
                </div>
                <div class="space-y-4">
                    @foreach($topDestinations as $i => $dest)
                        <a href="{{ route('destinations.show', $dest->slug) }}" class="group flex items-center gap-4 rounded-2xl p-2 hover:bg-[#E0F2FE]/50 transition">
                            <span class="w-8 h-8 shrink-0 rounded-full bg-gradient-to-br from-[#164E63] to-[#06B6D4] text-white text-xs font-black flex items-center justify-center">{{ $i + 1 }}</span>
                            <img src="{{ $dest->image }}" alt="{{ $dest->title }}" loading="lazy" class="w-14 h-14 rounded-xl object-cover shrink-0">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-3 mb-1.5">
                                    <span class="font-black text-[#164E63] text-sm truncate group-hover:text-[#0891B2] transition">{{ $dest->title }}</span>
                                    <span class="text-xs font-black text-[#164E63] whitespace-nowrap"><i class="fa-solid fa-star text-[#38BDF8]"></i> {{ number_format($dest->rating, 1) }}</span>
                                </div>
                                <div class="h-2 rounded-full bg-[#E0F2FE] overflow-hidden">
                                    <div class="h-full rounded-full bg-gradient-to-l from-[#164E63] via-[#06B6D4] to-[#38BDF8]" style="width: {{ min(100, max(0, $dest->rating / 5 * 100)) }}%;"></div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="mg-aurora relative overflow-hidden rounded-[2rem] p-6 sm:p-8 text-white shadow-2xl shadow-[#164E63]/30 mg-reveal mg-reveal-left">
                <div class="mg-orb mg-orb-sky w-52 h-52 -top-16 -left-12"></div>
                <div class="relative">
                    <h3 class="text-lg font-black mb-1">روابط سريعة</h3>
                    <p class="text-xs text-sky-100/80 mb-5">انتقل بسرعة إلى صفحات المنصة</p>
                    <div class="grid grid-cols-2 gap-3">
                        @foreach($quick as $q)
                            <a href="{{ route($q[0]) }}" class="mg-card-glass rounded-2xl p-4 text-center hover:-translate-y-1 transition-all duration-300">
                                <i class="fa-solid {{ $q[1] }} text-[#38BDF8] text-xl mb-2 block"></i>
                                <span class="text-xs font-black">{{ $q[2] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
