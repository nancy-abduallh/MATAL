@extends('layouts.app')

@section('title', 'إتمام الحجز · مَطَلّ جازان')
@section('meta_description', 'خطوات بسيطة لحجز رحلتك أو مسارك السياحي في جازان بأمان وسهولة.')

@section('content')

<!-- Hero Banner matching Booking.png -->
<section class="relative py-24 bg-cover bg-center text-white" style="background-image: url('{{ $item->image ?? '/images/wadi_lajab.jpg' }}');">
    <div class="absolute inset-0 bg-gradient-to-b from-[#164E63]/85 via-[#0e3b4d]/80 to-[#164E63]/90 backdrop-blur-sm"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <h1 class="text-4xl sm:text-6xl font-black text-white tracking-tight font-heading">
            إتمام الحجز
        </h1>
        <p class="text-lg sm:text-xl text-sky-100 max-w-2xl mx-auto font-normal leading-relaxed">
            خطوات بسيطة لتجربتك القادمة في جازان.
        </p>
    </div>
</section>

<!-- Stepper Indicator matching Booking.png -->
<section class="relative z-20 -mt-7 max-w-2xl mx-auto px-4">
    <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-xl border border-sky-100 p-2 flex items-center justify-between text-xs font-bold text-[#183746]/70">
        <span class="px-4 py-2 rounded-xl bg-gradient-to-r from-[#06B6D4] to-[#38BDF8] text-white shadow-md shadow-cyan-500/25">1. التفاصيل</span>
        <span class="px-3 py-1">2. الزوار</span>
        <span class="px-3 py-1">3. الدفع</span>
        <span class="px-3 py-1">4. التأكيد</span>
    </div>
</section>

<!-- Main Booking Form Layout matching Booking.png -->
<section class="py-16 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
        
        <!-- Left Column: Summary Card matching Booking.png -->
        <div class="md:col-span-5 order-2 md:order-1">
            <div class="bg-white rounded-3xl p-6 shadow-xl hover:shadow-cyan-500/15 border border-sky-100 text-right space-y-5 transition-all duration-300 group tilt-card card-shimmer">
                <div class="h-48 rounded-2xl overflow-hidden relative">
                    <img src="{{ $item->image ?? '/images/wadi_lajab.jpg' }}" alt="{{ $item->title }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                </div>
                
                <div>
                    <span class="text-xs font-bold text-[#06B6D4] bg-cyan-50 border border-cyan-100 px-3 py-0.5 rounded-full">
                        {{ $item->category ?? 'مسار سياحي' }}
                    </span>
                    <h3 class="text-xl font-bold text-[#164E63] group-hover:text-[#06B6D4] transition duration-300 mt-2 font-heading">
                        {{ $item->title }}
                    </h3>
                    <div class="flex items-center gap-3 text-xs text-[#183746]/70 font-semibold mt-2">
                        <span>{{ $item->duration_text ?? 'يوم واحد' }}</span>
                        <span>·</span>
                        <span>{{ $item->difficulty ?? 'متوسط' }}</span>
                        <span>·</span>
                        <span class="text-amber-500 flex items-center gap-1 font-bold group-hover:scale-105 transition">
                            <i class="fa-solid fa-star text-amber-400"></i> {{ number_format($item->rating ?? 4.8, 1) }}
                        </span>
                    </div>
                </div>

                <div class="pt-4 border-t border-sky-100 flex items-center justify-between">
                    <span class="text-sm font-bold text-[#183746]/70">الإجمالي التقديري:</span>
                    <span id="bookingTotalDisplay" class="text-2xl font-black text-[#06B6D4]">
                        {{ number_format($item->price ?? 220, 2) }} ر.س
                    </span>
                </div>
            </div>
        </div>

        <!-- Right Column: Form Inputs matching Booking.png -->
        <div class="md:col-span-7 order-1 md:order-2">
            <div class="bg-white rounded-3xl p-8 shadow-xl hover:shadow-cyan-500/10 border border-sky-100 text-right space-y-6 transition-all">
                <h2 class="text-2xl font-black text-[#164E63] border-b border-sky-100 pb-3 font-heading">
                    تفاصيل الحجز
                </h2>

                <form id="bookingForm" action="{{ route('booking.store') }}" method="POST" data-base-price="{{ $item->price ?? 220 }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="bookable_type" value="{{ $type }}">
                    <input type="hidden" name="bookable_id" value="{{ $item->id }}">

                    <!-- Trip Date -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">تاريخ الرحلة *</label>
                        <input type="date" name="trip_date" value="{{ date('Y-m-d', strtotime('+3 days')) }}" required
                               class="w-full p-3 rounded-xl border border-sky-100 text-xs focus:outline-none focus:border-[#06B6D4] bg-sky-50/50 focus:bg-white font-semibold transition">
                    </div>

                    <!-- Number of Adults and Children -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">عدد البالغين *</label>
                            <input type="number" name="adults_count" value="1" min="1" max="20" required
                                   class="w-full p-3 rounded-xl border border-sky-100 text-xs focus:outline-none focus:border-[#06B6D4] bg-sky-50/50 focus:bg-white font-semibold transition">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">عدد الأطفال (خصم 50%)</label>
                            <input type="number" name="children_count" value="0" min="0" max="10"
                                   class="w-full p-3 rounded-xl border border-sky-100 text-xs focus:outline-none focus:border-[#06B6D4] bg-sky-50/50 focus:bg-white font-semibold transition">
                        </div>
                    </div>

                    <!-- Customer Name -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">الاسم الكامل *</label>
                        <input type="text" name="customer_name" value="{{ Auth::user()?->name }}" placeholder="الاسم ثلاثي" required
                               class="w-full p-3 rounded-xl border border-sky-100 text-xs focus:outline-none focus:border-[#06B6D4] bg-sky-50/50 focus:bg-white font-semibold transition">
                    </div>

                    <!-- Phone & Email -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">رقم الجوال السعودي *</label>
                            <input type="tel" name="customer_phone" value="{{ Auth::user()?->phone ?? '05' }}" placeholder="05XXXXXXXX" required
                                   class="w-full p-3 rounded-xl border border-sky-100 text-xs focus:outline-none focus:border-[#06B6D4] bg-sky-50/50 focus:bg-white font-semibold transition">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">البريد الإلكتروني *</label>
                            <input type="email" name="customer_email" value="{{ Auth::user()?->email }}" placeholder="example@domain.com" required
                                   class="w-full p-3 rounded-xl border border-sky-100 text-xs focus:outline-none focus:border-[#06B6D4] bg-sky-50/50 focus:bg-white font-semibold transition">
                        </div>
                    </div>

                    <!-- Optional Add-ons -->
                    <div class="pt-2 border-t border-sky-100">
                        <label class="block text-xs font-bold text-slate-700 mb-2">إضافات وتجارب مميزة:</label>
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 p-2.5 rounded-xl border border-sky-100 bg-sky-50/40 hover:bg-sky-50/80 cursor-pointer text-xs transition">
                                <input type="checkbox" name="addons[]" value="local_guide" data-addon-price="150" class="addon-checkbox rounded text-[#06B6D4] focus:ring-0">
                                <span class="font-semibold text-slate-800">مرشد سياحي محلي معتمد ومرافق (+150 ر.س)</span>
                            </label>
                            <label class="flex items-center gap-2 p-2.5 rounded-xl border border-sky-100 bg-sky-50/40 hover:bg-sky-50/80 cursor-pointer text-xs transition">
                                <input type="checkbox" name="addons[]" value="coffee_tasting" data-addon-price="50" data-per-person="true" class="addon-checkbox rounded text-[#06B6D4] focus:ring-0">
                                <span class="font-semibold text-slate-800">ورشة تذوق البن الخولاني السعودي الفاخر (+50 ر.س للشخص)</span>
                            </label>
                        </div>
                    </div>

                    <!-- Payment Method Selection -->
                    <div class="pt-2 border-t border-sky-100">
                        <label class="block text-xs font-bold text-slate-700 mb-2">طريقة الدفع:</label>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 text-center text-xs font-bold">
                            <label class="cursor-pointer">
                                <input type="radio" name="payment_method" value="mada" checked class="peer sr-only">
                                <div class="p-3 rounded-xl border border-sky-100 bg-sky-50/50 peer-checked:bg-gradient-to-r peer-checked:from-[#06B6D4] peer-checked:to-[#38BDF8] peer-checked:text-white peer-checked:border-transparent peer-checked:shadow-md transition">
                                    مدى Mada
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="payment_method" value="apple_pay" class="peer sr-only">
                                <div class="p-3 rounded-xl border border-sky-100 bg-sky-50/50 peer-checked:bg-gradient-to-r peer-checked:from-[#06B6D4] peer-checked:to-[#38BDF8] peer-checked:text-white peer-checked:border-transparent peer-checked:shadow-md transition">
                                    Apple Pay
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="payment_method" value="visa" class="peer sr-only">
                                <div class="p-3 rounded-xl border border-sky-100 bg-sky-50/50 peer-checked:bg-gradient-to-r peer-checked:from-[#06B6D4] peer-checked:to-[#38BDF8] peer-checked:text-white peer-checked:border-transparent peer-checked:shadow-md transition">
                                    بطاقة فيزا
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="payment_method" value="cash" class="peer sr-only">
                                <div class="p-3 rounded-xl border border-sky-100 bg-sky-50/50 peer-checked:bg-gradient-to-r peer-checked:from-[#06B6D4] peer-checked:to-[#38BDF8] peer-checked:text-white peer-checked:border-transparent peer-checked:shadow-md transition">
                                    عند الوصول
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button matching Booking.png: "متابعة إلى الدفع" -->
                    <div class="pt-4">
                        <button type="submit" class="w-full py-4 rounded-2xl bg-gradient-to-r from-[#06B6D4] to-[#38BDF8] hover:from-[#0891b2] hover:to-[#0284c7] text-white font-black text-base shadow-xl shadow-cyan-500/25 transition transform hover:scale-[1.01]">
                            متابعة إلى الدفع وتأكيد الحجز
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</section>

    </div>
</section>

@endsection
