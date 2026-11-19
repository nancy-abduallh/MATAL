@extends('layouts.app')

@section('title', 'تأكيد الحجز · ' . $booking->booking_code)

@push('styles')
<style>
    @keyframes mgCheckDraw { to { stroke-dashoffset: 0; } }
    @keyframes mgPopIn { 0% { transform: scale(.4); opacity: 0; } 70% { transform: scale(1.12); } 100% { transform: scale(1); opacity: 1; } }
    .mg-check-circle { stroke-dasharray: 166; stroke-dashoffset: 166; animation: mgCheckDraw .8s .2s ease-out forwards; }
    .mg-check-tick { stroke-dasharray: 48; stroke-dashoffset: 48; animation: mgCheckDraw .5s .9s ease-out forwards; }
    .mg-pop-in { animation: mgPopIn .8s cubic-bezier(.16, 1, .3, 1) both; }
    @media print {
        header, footer, #backToTopBtn, #scrollProgressBar, #mgToasts, .no-print { display: none !important; }
        body { background: #fff !important; }
        .print-wrap { padding: 0 !important; margin: 0 !important; }
        #printableTicket { box-shadow: none !important; margin: 0 auto !important; }
        * { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
    }
</style>
@endpush

@section('content')

@php
    $methodLabels = ['mada' => 'مدى', 'apple_pay' => 'Apple Pay', 'visa' => 'فيزا', 'cash' => 'عند الوصول'];
    $addonLabels = ['local_guide' => 'مرشد سياحي محلي', 'coffee_tasting' => 'ورشة تذوق البن الخولاني', 'transport_4x4' => 'نقل دفع رباعي'];
    $addons = is_array($booking->selected_addons) ? $booking->selected_addons : [];

    // Decorative pass pattern built from the booking code (not a scannable QR)
    $n = 25;
    $finder = fn ($x, $y) => ($x < 8 && $y < 8) || ($x >= $n - 8 && $y < 8) || ($x < 8 && $y >= $n - 8);
    $corners = [[0, 0], [$n - 7, 0], [0, $n - 7]];
@endphp

{{-- ================= SUCCESS BANNER ================= --}}
<section class="mg-aurora relative overflow-hidden pt-32 sm:pt-40 pb-32 px-4 text-center text-white">
    <div class="mg-orb mg-orb-sky w-96 h-96 -top-24 -right-16" data-speed="0.1"></div>
    <div class="mg-orb mg-orb-cyan w-80 h-80 bottom-0 -left-16" data-speed="0.08"></div>
    <span class="mg-float-a absolute top-28 right-[12%] w-3 h-3 rounded-full bg-[#38BDF8]"></span>
    <span class="mg-float-b absolute top-44 left-[16%] w-2.5 h-2.5 rounded-full bg-white/70"></span>
    <span class="mg-float-a absolute bottom-24 right-[22%] w-2 h-2 rounded-full bg-[#06B6D4]"></span>
    <span class="mg-float-b absolute bottom-32 left-[28%] w-3 h-3 rounded-full bg-[#38BDF8]/70"></span>

    <div class="relative z-[2] max-w-2xl mx-auto">
        <div class="mg-pop-in mx-auto mb-6 w-24 h-24 rounded-full bg-white/10 border border-white/25 backdrop-blur flex items-center justify-center shadow-2xl shadow-[#072430]/40 mg-pulse">
            <svg viewBox="0 0 56 56" class="w-14 h-14" fill="none" stroke="#38BDF8" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle class="mg-check-circle" cx="28" cy="28" r="26.5"/>
                <path class="mg-check-tick" d="M16 29.5l8 8 16-17"/>
            </svg>
        </div>
        <h1 class="text-3xl sm:text-5xl font-black mb-4 mg-reveal">تم تأكيد حجزك بنجاح!</h1>
        <p class="text-sky-100/90 leading-loose mg-reveal" style="--d: .1s">شكراً لاختيارك منصة مَطَلّ. احتفظ بهذه التذكرة وأبرز رقم الحجز عند نقطة التجمع.</p>
    </div>

    <div class="mg-wave">
        <svg viewBox="0 0 1440 80" preserveAspectRatio="none" aria-hidden="true">
            <path d="M0,48 C180,96 360,0 600,40 C840,80 1080,8 1260,40 C1350,56 1410,52 1440,44 L1440,80 L0,80 Z" fill="#F8FCFD"/>
        </svg>
    </div>
</section>

{{-- ================= TICKET ================= --}}
<section class="print-wrap relative px-4 pb-24 -mt-20 z-10">
    <div id="printableTicket" class="relative max-w-3xl mx-auto rounded-[2rem] bg-white border border-[#06B6D4]/20 shadow-2xl shadow-[#164E63]/25 overflow-hidden mg-reveal mg-reveal-scale">

        {{-- Header --}}
        <div class="mg-aurora relative overflow-hidden p-6 sm:p-8 flex flex-wrap items-center justify-between gap-5 text-white">
            <div class="mg-orb mg-orb-sky w-48 h-48 -top-16 -left-10"></div>
            <div class="relative">
                <img src="/images/matal_logo_white_text.png" alt="مَطَلّ" class="h-14 w-auto mb-2">
                <div class="text-xs font-bold text-sky-100/85">تذكرة سياحية رقمية معتمدة</div>
            </div>
            <div class="relative text-left">
                <div class="text-[11px] font-black text-[#38BDF8]">رقم الحجز</div>
                <div class="text-2xl sm:text-3xl font-black tracking-widest" dir="ltr">{{ $booking->booking_code }}</div>
            </div>
        </div>

        {{-- Body --}}
        <div class="p-6 sm:p-9">
            <div class="flex flex-wrap items-center gap-2 mb-3">
                <span class="mg-badge mg-badge-cyan"><i class="fa-solid fa-ticket"></i> تفاصيل التجربة</span>
                <span class="mg-badge !bg-[#E0F2FE] !text-[#164E63] !border-[#06B6D4]/30"><i class="fa-solid fa-circle-check text-[#06B6D4]"></i> {{ $booking->status === 'confirmed' ? 'مؤكد' : $booking->status }}</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-black text-[#164E63] mb-7">{{ $booking->bookable?->title ?? 'مسار سياحي متكامل' }}</h2>

            <div class="grid grid-cols-2 gap-4 mb-6">
                @foreach([
                    ['fa-user', 'اسم السائح', $booking->customer_name],
                    ['fa-calendar-days', 'تاريخ الرحلة', $booking->trip_date->format('Y-m-d')],
                    ['fa-user-group', 'عدد الضيوف', $booking->adults_count . ' بالغين' . ($booking->children_count ? ' + ' . $booking->children_count . ' أطفال' : '')],
                    ['fa-sack-dollar', 'المبلغ الإجمالي', number_format($booking->total_price, 2) . ' ر.س'],
                ] as $d)
                    <div class="rounded-2xl bg-[#F8FCFD] border border-[#06B6D4]/15 p-4 hover:border-[#06B6D4]/50 hover:-translate-y-0.5 transition-all duration-300">
                        <div class="flex items-center gap-2 text-[11px] font-black text-[#06B6D4] mb-1"><i class="fa-solid {{ $d[0] }}"></i> {{ $d[1] }}</div>
                        <div class="font-black text-[#164E63] leading-snug">{{ $d[2] }}</div>
                    </div>
                @endforeach
            </div>

            @if(count($addons))
                <div class="mb-6">
                    <div class="text-[11px] font-black text-[#06B6D4] mb-2">الإضافات المحجوزة</div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($addons as $ad)
                            <span class="mg-chip cursor-default !text-xs"><i class="fa-solid fa-circle-check text-[#06B6D4] text-xs"></i>{{ $addonLabels[$ad] ?? $ad }}</span>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($booking->notes)
                <div class="mb-6 rounded-2xl bg-[#E0F2FE]/50 border border-[#06B6D4]/15 p-4 text-sm text-[#183746]/80"><span class="font-black text-[#164E63]">ملاحظاتك:</span> {{ $booking->notes }}</div>
            @endif
        </div>

        {{-- Perforation --}}
        <div class="relative h-0">
            <div class="border-t-2 border-dashed border-[#06B6D4]/35 mx-8"></div>
            <span class="absolute -top-3.5 -right-3.5 w-7 h-7 rounded-full bg-[#F8FCFD] border border-[#06B6D4]/20"></span>
            <span class="absolute -top-3.5 -left-3.5 w-7 h-7 rounded-full bg-[#F8FCFD] border border-[#06B6D4]/20"></span>
        </div>

        {{-- Pass --}}
        <div class="p-6 sm:p-9 flex flex-col-reverse sm:flex-row items-center justify-between gap-7">
            <div class="text-center sm:text-right space-y-3">
                <h3 class="font-black text-[#164E63]">رمز التذكرة السريعة</h3>
                <p class="text-sm text-[#183746]/75 leading-relaxed max-w-sm">يرجى إبراز رقم الحجز عند نقطة التجمع أو للمرشد السياحي المعتمد لبدء المسار وتأكيد الهوية.</p>
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#E0F2FE] text-[#164E63] text-xs font-black">
                    <i class="fa-solid fa-circle-check text-[#06B6D4]"></i>
                    {{ $booking->payment_status === 'paid' ? 'مدفوع بالكامل' : 'بانتظار الدفع' }} · {{ $methodLabels[$booking->payment_method] ?? strtoupper($booking->payment_method) }}
                </div>
                <div class="text-xs text-[#183746]/65 space-y-1 pt-1">
                    <div dir="ltr" class="text-right"><i class="fa-solid fa-phone text-[#06B6D4] ml-1"></i> {{ $booking->customer_phone }}</div>
                    <div dir="ltr" class="text-right"><i class="fa-solid fa-envelope text-[#06B6D4] ml-1"></i> {{ $booking->customer_email }}</div>
                </div>
            </div>

            <div class="shrink-0 text-center">
                <div class="relative w-40 h-40 rounded-2xl p-3 bg-white border-2 border-[#06B6D4]/30 shadow-lg shadow-[#06B6D4]/15 overflow-hidden">
                    <svg viewBox="0 0 {{ $n }} {{ $n }}" class="w-full h-full" shape-rendering="crispEdges" aria-hidden="true">
                        @for($y = 0; $y < $n; $y++)
                            @for($x = 0; $x < $n; $x++)
                                @if(!$finder($x, $y) && (crc32($booking->booking_code . '-' . $x . '-' . $y) & 1))
                                    <rect x="{{ $x }}" y="{{ $y }}" width="1" height="1" fill="#164E63"/>
                                @endif
                            @endfor
                        @endfor
                        @foreach($corners as $c)
                            <rect x="{{ $c[0] }}" y="{{ $c[1] }}" width="7" height="7" fill="#164E63"/>
                            <rect x="{{ $c[0] + 1 }}" y="{{ $c[1] + 1 }}" width="5" height="5" fill="#fff"/>
                            <rect x="{{ $c[0] + 2 }}" y="{{ $c[1] + 2 }}" width="3" height="3" fill="#06B6D4"/>
                        @endforeach
                    </svg>
                    <div class="mg-scanline !h-0.5"></div>
                </div>
                <div class="mt-2 text-xs font-black tracking-widest text-[#164E63]" dir="ltr">{{ $booking->booking_code }}</div>
            </div>
        </div>

        {{-- Footer actions --}}
        <div class="no-print bg-[#E0F2FE]/50 border-t border-[#06B6D4]/15 p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <button type="button" onclick="window.print()" class="mg-btn-dark"><i class="fa-solid fa-print"></i><span>طباعة التذكرة</span></button>
            <div class="flex flex-wrap items-center justify-center gap-5 text-sm font-black">
                <a href="{{ route('account.index') }}" class="text-[#0891B2] hover:text-[#164E63] transition">الانتقال إلى حجوزاتي في حسابي ←</a>
                <a href="{{ route('home') }}" class="text-[#164E63]/70 hover:text-[#164E63] transition">العودة للرئيسية</a>
            </div>
        </div>
    </div>
</section>

@endsection
