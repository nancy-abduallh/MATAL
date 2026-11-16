@extends('layouts.app')

@section('title', 'تأكيد الحجز · ' . $booking->booking_code)

@section('content')

<section class="py-16 max-w-3xl mx-auto px-4 sm:px-6 text-right">
    
    <!-- Success Banner -->
    <div class="text-center space-y-3 mb-8">
        <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-2xl mx-auto shadow-md">
            <i class="fa-solid fa-check"></i>
        </div>
        <h1 class="text-3xl font-black text-[#164E63] font-heading">
            تم تأكيد حجزك بنجاح!
        </h1>
        <p class="text-[#183746]/70 text-sm">
            شكراً لاختيارك منصة مَطَلّ. تم إرسال تفاصيل التذكرة إلى بريدك الإلكتروني ورقم الجوال.
        </p>
    </div>

    <!-- Printable Travel Pass / Ticket Card -->
    <div id="printableTicket" class="bg-white rounded-3xl shadow-2xl hover:shadow-cyan-500/15 border border-sky-100 overflow-hidden transition-all">
        
        <!-- Ticket Header -->
        <div class="bg-gradient-to-r from-[#164E63] via-[#0e3b4d] to-[#0891b2] text-white p-6 sm:p-8 flex items-center justify-between">
            <div>
                <img src="/images/matal_logo_white_text.png" alt="مَطَلّ" class="h-10 sm:h-12 w-auto mb-2 object-contain">
                <div class="text-xs text-cyan-200 font-bold">تذكرة سياحية رقمية معتمدة</div>
            </div>
            <div class="text-left">
                <div class="text-xs text-white/70">رقم الحجز</div>
                <div class="text-xl sm:text-2xl font-black tracking-wider text-amber-300 font-mono">{{ $booking->booking_code }}</div>
            </div>
        </div>

        <!-- Ticket Body -->
        <div class="p-6 sm:p-8 space-y-6">
            
            <div class="border-b border-sky-100 pb-4">
                <span class="text-xs font-bold text-[#06B6D4] bg-cyan-50 border border-cyan-100 px-3 py-0.5 rounded-full">
                    تفاصيل التجربة
                </span>
                <h3 class="text-2xl font-black text-[#164E63] font-heading mt-2">
                    {{ $booking->bookable?->title ?? 'مسار سياحي متكامل' }}
                </h3>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs">
                <div class="space-y-1">
                    <span class="text-slate-400 font-semibold">اسم السائح:</span>
                    <div class="font-bold text-[#164E63] text-sm">{{ $booking->customer_name }}</div>
                </div>
                <div class="space-y-1">
                    <span class="text-slate-400 font-semibold">تاريخ الرحلة:</span>
                    <div class="font-bold text-[#164E63] text-sm">{{ $booking->trip_date->format('Y-m-d') }}</div>
                </div>
                <div class="space-y-1">
                    <span class="text-slate-400 font-semibold">عدد الضيوف:</span>
                    <div class="font-bold text-[#164E63] text-sm">{{ $booking->adults_count }} بالغين @if($booking->children_count) + {{ $booking->children_count }} أطفال @endif</div>
                </div>
                <div class="space-y-1">
                    <span class="text-slate-400 font-semibold">المبلغ الإجمالي:</span>
                    <div class="font-bold text-emerald-600 text-sm">{{ number_format($booking->total_price, 2) }} ر.س</div>
                </div>
            </div>

            <!-- Simulated QR Code & Instructions -->
            <div class="p-6 rounded-2xl bg-sky-50/50 border border-sky-100 flex flex-col sm:flex-row items-center justify-between gap-6 text-center sm:text-right">
                <div class="space-y-2">
                    <h4 class="font-bold text-sm text-[#164E63] font-heading">رمز التذكرة السريعة (QR Code)</h4>
                    <p class="text-[#183746]/70 text-xs max-w-sm leading-relaxed">
                        يرجى إبراز هذا الرمز عند نقطة التجمع أو للمرشد السياحي المعتمد لبدء المسار وتأكيد الهوية.
                    </p>
                    <div class="text-[11px] text-emerald-700 font-semibold">
                        <i class="fa-solid fa-circle-check"></i> حالة الدفع: مدفوع بالكامل ({{ strtoupper($booking->payment_method) }})
                    </div>
                </div>
                <!-- SVG QR Code Icon Simulation -->
                <div class="p-3 bg-white rounded-2xl border border-sky-200 shadow-sm shrink-0">
                    <div class="w-28 h-28 bg-gradient-to-br from-[#164E63] to-[#0891b2] text-white flex flex-col items-center justify-center p-2 rounded-xl text-center">
                        <i class="fa-solid fa-qrcode text-5xl text-amber-300"></i>
                        <span class="text-[9px] font-mono mt-1 text-white/90">{{ $booking->booking_code }}</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Ticket Footer Buttons -->
        <div class="bg-sky-50/40 p-6 border-t border-sky-100 flex flex-wrap items-center justify-between gap-4">
            <button type="button" onclick="window.print()" class="px-5 py-2.5 rounded-xl bg-white border border-sky-200 hover:border-[#06B6D4] text-[#164E63] hover:text-[#06B6D4] text-xs font-bold transition flex items-center gap-2 shadow-2xs">
                <i class="fa-solid fa-print"></i>
                <span>طباعة التذكرة</span>
            </button>
            <div class="flex items-center gap-3">
                <a href="{{ route('account.index') }}" class="text-xs font-bold text-[#06B6D4] hover:underline">
                    الانتقال إلى حجوزاتي في حسابي ←
                </a>
                <a href="{{ route('home') }}" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#06B6D4] to-[#38BDF8] hover:from-[#0891b2] hover:to-[#0284c7] text-white text-xs font-bold shadow-md shadow-cyan-500/20 transition">
                    العودة للرئيسية
                </a>
            </div>
        </div>

    </div>

</section>

@endsection
