@extends('layouts.app')

@section('title', 'إتمام الحجز · مَطَلّ جازان')
@section('meta_description', 'خطوات بسيطة لحجز رحلتك أو مسارك السياحي في جازان بأمان وسهولة.')

@section('content')

@php
    $basePrice = $item->price ?? 220;
    $addons = [
        ['local_guide', 'fa-user-tie', 'مرشد سياحي محلي معتمد ومرافق', '+150 ر.س', 150, false],
        ['coffee_tasting', 'fa-mug-hot', 'ورشة تذوق البن الخولاني السعودي الفاخر', '+50 ر.س للشخص', 50, true],
    ];
    $payments = [
        ['mada', 'مدى', 'Mada', 'fa-solid fa-credit-card'],
        ['apple_pay', 'Apple Pay', 'دفع سريع', 'fa-brands fa-apple'],
        ['visa', 'بطاقة فيزا', 'Visa', 'fa-brands fa-cc-visa'],
        ['cash', 'عند الوصول', 'نقداً', 'fa-solid fa-money-bill-wave'],
    ];
    $steps = ['التفاصيل', 'الزوار', 'الدفع', 'التأكيد'];
    $dot = 'w-10 h-10 rounded-full bg-white border-2 border-[#06B6D4]/30 text-[#164E63]/60 font-black flex items-center justify-center transition-all duration-500 group-data-[state=active]:bg-gradient-to-br group-data-[state=active]:from-[#06B6D4] group-data-[state=active]:to-[#38BDF8] group-data-[state=active]:text-white group-data-[state=active]:border-transparent group-data-[state=active]:scale-110 group-data-[state=active]:shadow-lg group-data-[state=active]:shadow-[#06B6D4]/40 group-data-[state=done]:bg-[#164E63] group-data-[state=done]:text-white group-data-[state=done]:border-transparent';
@endphp

<x-mg.page-hero title="إتمام الحجز" subtitle="خطوات بسيطة لتجربتك القادمة في جازان."
    :image="$item->image ?? '/images/wadi_lajab.jpg'" :crumbs="['إتمام الحجز' => null]" />

{{-- ================= STEPPER ================= --}}
<div class="relative z-20 max-w-4xl mx-auto px-4 -mt-9">
    <div class="rounded-3xl bg-white/95 backdrop-blur-xl border border-[#06B6D4]/20 shadow-2xl shadow-[#164E63]/15 p-4 sm:p-6 mg-reveal mg-reveal-scale">
        <ol class="relative flex items-start justify-between" id="stepper">
            <div class="absolute top-5 inset-x-8 h-1 rounded-full bg-[#E0F2FE]">
                <div id="stepFill" class="h-full w-0 rounded-full bg-gradient-to-l from-[#164E63] via-[#06B6D4] to-[#38BDF8] transition-all duration-700"></div>
            </div>
            @foreach($steps as $i => $label)
                <li data-step-ind="{{ $i + 1 }}" data-state="{{ $i === 0 ? 'active' : 'idle' }}" class="group relative z-10 flex flex-col items-center gap-2">
                    <span class="step-dot {{ $dot }}">{{ $i + 1 }}</span>
                    <span class="text-[11px] sm:text-xs font-black text-[#164E63]/55 group-data-[state=active]:text-[#164E63] group-data-[state=done]:text-[#164E63]">{{ $label }}</span>
                </li>
            @endforeach
        </ol>
    </div>
</div>

{{-- ================= FORM + SUMMARY ================= --}}
<section class="relative px-4 py-14 sm:py-20 overflow-hidden">
    <div class="mg-orb mg-orb-cyan w-96 h-96 top-20 -left-24" data-speed="0.08"></div>
    <div class="mg-orb mg-orb-sky w-80 h-80 bottom-20 -right-20" data-speed="0.06"></div>

    <div class="relative z-[2] max-w-6xl mx-auto grid lg:grid-cols-3 gap-8 items-start">

        {{-- ============ FORM ============ --}}
        <form id="bookingForm" action="{{ route('booking.store') }}" method="POST" data-base-price="{{ $basePrice }}" class="lg:col-span-2 space-y-6 min-w-0 order-2 lg:order-none">
            @csrf
            <input type="hidden" name="bookable_type" value="{{ $type }}">
            <input type="hidden" name="bookable_id" value="{{ $item->id }}">

            {{-- STEP 1 · Details --}}
            <div data-step="1" class="rounded-[2rem] bg-white border border-[#06B6D4]/15 shadow-xl shadow-[#164E63]/5 p-5 sm:p-9 mg-reveal">
                <div class="flex items-center gap-4 mb-7">
                    <span class="mg-icon-tile"><i class="fa-solid fa-calendar-check"></i></span>
                    <div><h2 class="text-xl font-black text-[#164E63]">تفاصيل الرحلة</h2><p class="text-xs text-[#183746]/65 mt-0.5">اختر الموعد وأضف تجارب مميزة</p></div>
                </div>

                <div class="mb-7">
                    <label class="mg-label" for="trip_date">تاريخ الرحلة <span class="text-[#06B6D4]">*</span></label>
                    <input id="trip_date" type="date" name="trip_date" min="{{ date('Y-m-d') }}" value="{{ old('trip_date', date('Y-m-d', strtotime('+3 days'))) }}" required class="mg-field">
                    @error('trip_date')<p class="mt-1.5 text-xs font-bold text-rose-600">{{ $message }}</p>@enderror
                </div>

                <span class="mg-label">إضافات وتجارب مميزة</span>
                <div class="grid sm:grid-cols-2 gap-3">
                    @foreach($addons as $a)
                        <label class="relative cursor-pointer">
                            <input type="checkbox" name="addons[]" value="{{ $a[0] }}" data-addon-price="{{ $a[4] }}" @if($a[5]) data-per-person="true" @endif
                                   class="addon-checkbox peer sr-only" {{ in_array($a[0], old('addons', [])) ? 'checked' : '' }}>
                            <div class="h-full flex items-start gap-3 rounded-2xl border-2 border-[#06B6D4]/20 bg-[#F8FCFD] p-4 transition-all duration-300 hover:border-[#06B6D4]/60 peer-checked:border-[#06B6D4] peer-checked:bg-gradient-to-br peer-checked:from-[#E0F2FE] peer-checked:to-white peer-checked:shadow-lg peer-checked:shadow-[#06B6D4]/20 peer-checked:-translate-y-0.5 peer-checked:[&_.chk]:opacity-100 peer-checked:[&_.chk]:scale-100">
                                <span class="mg-icon-tile !w-10 !h-10 !text-sm !rounded-xl shrink-0"><i class="fa-solid {{ $a[1] }}"></i></span>
                                <div class="min-w-0">
                                    <div class="font-black text-[#164E63] text-sm leading-snug">{{ $a[2] }}</div>
                                    <div class="text-xs font-bold text-[#0891B2] mt-1">{{ $a[3] }}</div>
                                </div>
                                <span class="chk absolute top-3 left-3 w-6 h-6 rounded-full bg-gradient-to-br from-[#06B6D4] to-[#38BDF8] text-white text-[10px] flex items-center justify-center opacity-0 scale-50 transition-all duration-300"><i class="fa-solid fa-check"></i></span>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- STEP 2 · Guests --}}
            <div data-step="2" class="rounded-[2rem] bg-white border border-[#06B6D4]/15 shadow-xl shadow-[#164E63]/5 p-5 sm:p-9 mg-reveal">
                <div class="flex items-center gap-4 mb-7">
                    <span class="mg-icon-tile mg-icon-tile-dark"><i class="fa-solid fa-user-group"></i></span>
                    <div><h2 class="text-xl font-black text-[#164E63]">بيانات الزوار</h2><p class="text-xs text-[#183746]/65 mt-0.5">عدد المسافرين وبيانات التواصل</p></div>
                </div>

                <div class="grid sm:grid-cols-2 gap-5 mb-6">
                    @foreach([['adults_count', 'عدد البالغين *', 1, 1, 20], ['children_count', 'عدد الأطفال (خصم 50%)', 0, 0, 10]] as $c)
                        <div>
                            <label class="mg-label" for="{{ $c[0] }}">{{ $c[1] }}</label>
                            <div class="flex items-center gap-2 rounded-2xl border-[1.5px] border-[#06B6D4]/22 bg-white p-1.5">
                                <button type="button" data-counter-btn="-1" data-target="{{ $c[0] }}" class="w-10 h-10 rounded-xl bg-[#E0F2FE] text-[#164E63] font-black hover:bg-gradient-to-br hover:from-[#06B6D4] hover:to-[#38BDF8] hover:text-white transition" aria-label="إنقاص"><i class="fa-solid fa-minus text-xs"></i></button>
                                <input id="{{ $c[0] }}" type="number" name="{{ $c[0] }}" value="{{ old($c[0], $c[2]) }}" min="{{ $c[3] }}" max="{{ $c[4] }}" required
                                       class="flex-1 min-w-0 text-center bg-transparent font-black text-lg text-[#164E63] focus:outline-none [appearance:textfield] [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none">
                                <button type="button" data-counter-btn="1" data-target="{{ $c[0] }}" class="w-10 h-10 rounded-xl bg-[#E0F2FE] text-[#164E63] font-black hover:bg-gradient-to-br hover:from-[#06B6D4] hover:to-[#38BDF8] hover:text-white transition" aria-label="زيادة"><i class="fa-solid fa-plus text-xs"></i></button>
                            </div>
                            @error($c[0])<p class="mt-1.5 text-xs font-bold text-rose-600">{{ $message }}</p>@enderror
                        </div>
                    @endforeach
                </div>

                <div class="space-y-5">
                    <div>
                        <label class="mg-label" for="customer_name">الاسم الكامل <span class="text-[#06B6D4]">*</span></label>
                        <input id="customer_name" type="text" name="customer_name" value="{{ old('customer_name', Auth::user()?->name) }}" placeholder="الاسم ثلاثي" required class="mg-field">
                        @error('customer_name')<p class="mt-1.5 text-xs font-bold text-rose-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label class="mg-label" for="customer_phone">رقم الجوال السعودي <span class="text-[#06B6D4]">*</span></label>
                            <input id="customer_phone" type="tel" name="customer_phone" value="{{ old('customer_phone', Auth::user()?->phone ?? '05') }}" placeholder="05XXXXXXXX" required class="mg-field" dir="ltr" style="text-align: right;">
                            @error('customer_phone')<p class="mt-1.5 text-xs font-bold text-rose-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="mg-label" for="customer_email">البريد الإلكتروني <span class="text-[#06B6D4]">*</span></label>
                            <input id="customer_email" type="email" name="customer_email" value="{{ old('customer_email', Auth::user()?->email) }}" placeholder="example@domain.com" required class="mg-field" dir="ltr" style="text-align: right;">
                            @error('customer_email')<p class="mt-1.5 text-xs font-bold text-rose-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div>
                        <label class="mg-label" for="notes">ملاحظات إضافية <span class="text-[#164E63]/50 font-semibold">(اختياري)</span></label>
                        <textarea id="notes" name="notes" rows="2" maxlength="500" placeholder="أي طلبات خاصة أو ملاحظات للمرشد..." class="mg-field resize-none">{{ old('notes') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- STEP 3 · Payment --}}
            <div data-step="3" class="rounded-[2rem] bg-white border border-[#06B6D4]/15 shadow-xl shadow-[#164E63]/5 p-5 sm:p-9 mg-reveal">
                <div class="flex items-center gap-4 mb-7">
                    <span class="mg-icon-tile"><i class="fa-solid fa-wallet"></i></span>
                    <div><h2 class="text-xl font-black text-[#164E63]">طريقة الدفع</h2><p class="text-xs text-[#183746]/65 mt-0.5">اختر الوسيلة الأنسب لك</p></div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-8">
                    @foreach($payments as $p)
                        <label class="relative cursor-pointer">
                            <input type="radio" name="payment_method" value="{{ $p[0] }}" class="peer sr-only" {{ old('payment_method', 'mada') === $p[0] ? 'checked' : '' }}>
                            <div class="rounded-2xl border-2 border-[#06B6D4]/20 bg-[#F8FCFD] p-4 text-center transition-all duration-300 hover:border-[#06B6D4]/60 peer-checked:border-[#06B6D4] peer-checked:bg-gradient-to-br peer-checked:from-[#E0F2FE] peer-checked:to-white peer-checked:shadow-lg peer-checked:shadow-[#06B6D4]/20 peer-checked:-translate-y-1 peer-checked:[&_.chk]:opacity-100 peer-checked:[&_.chk]:scale-100">
                                <i class="{{ $p[3] }} text-2xl text-[#06B6D4] mb-2 block"></i>
                                <div class="font-black text-[#164E63] text-sm">{{ $p[1] }}</div>
                                <div class="text-[11px] text-[#183746]/60">{{ $p[2] }}</div>
                                <span class="chk absolute top-2 left-2 w-5 h-5 rounded-full bg-gradient-to-br from-[#06B6D4] to-[#38BDF8] text-white text-[9px] flex items-center justify-center opacity-0 scale-50 transition-all duration-300"><i class="fa-solid fa-check"></i></span>
                            </div>
                        </label>
                    @endforeach
                </div>
                @error('payment_method')<p class="-mt-5 mb-5 text-xs font-bold text-rose-600">{{ $message }}</p>@enderror

                <button type="submit" id="bookingSubmitBtn" class="mg-btn w-full !py-4 !text-base" data-magnetic>
                    <i class="fa-solid fa-lock"></i><span>متابعة إلى الدفع وتأكيد الحجز</span>
                </button>
                <p class="mt-4 text-center text-xs text-[#183746]/60 flex items-center justify-center gap-2"><i class="fa-solid fa-shield-heart text-[#06B6D4]"></i> حجز رقمي آمن ومعتمد</p>
            </div>
        </form>

        {{-- ============ SUMMARY ============ --}}
        <aside class="order-1 lg:order-none lg:sticky lg:top-28">
            <div class="rounded-[2rem] p-1 bg-gradient-to-br from-[#164E63] via-[#06B6D4] to-[#38BDF8] shadow-2xl shadow-[#06B6D4]/25 mg-reveal mg-reveal-left">
                <div class="rounded-[1.85rem] bg-white overflow-hidden">
                    <div class="mg-photo mg-photo-tint h-48 rounded-none group">
                        <img src="{{ $item->image ?? '/images/wadi_lajab.jpg' }}" alt="{{ $item->title }}">
                        <span class="mg-badge mg-badge-cyan absolute top-4 right-4 z-10">{{ $item->category ?? 'مسار سياحي' }}</span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-black text-[#164E63] mb-2">{{ $item->title }}</h3>
                        <div class="flex flex-wrap items-center gap-x-2 gap-y-1 text-xs font-bold text-[#183746]/70 mb-5">
                            <span>{{ $item->duration_text ?? 'يوم واحد' }}</span><span class="text-[#06B6D4]">·</span>
                            <span>{{ $item->difficulty ?? 'متوسط' }}</span><span class="text-[#06B6D4]">·</span>
                            <span><i class="fa-solid fa-star"></i> {{ number_format($item->rating ?? 4.8, 1) }}</span>
                        </div>

                        <div class="space-y-2.5 text-sm pb-5 mb-5 border-b border-dashed border-[#06B6D4]/30">
                            <div class="flex items-center justify-between"><span class="text-[#183746]/70">البالغون</span><span id="bkAdults" class="font-black text-[#164E63]">—</span></div>
                            <div class="flex items-center justify-between"><span class="text-[#183746]/70">الأطفال (50%)</span><span id="bkChildren" class="font-black text-[#164E63]">—</span></div>
                            <div class="flex items-center justify-between"><span class="text-[#183746]/70">الإضافات</span><span id="bkAddons" class="font-black text-[#164E63]">—</span></div>
                        </div>

                        <div class="rounded-2xl bg-gradient-to-br from-[#164E63] to-[#0e3b4d] p-5 text-white flex items-center justify-between relative overflow-hidden">
                            <div class="mg-orb mg-orb-cyan w-28 h-28 -top-10 -left-10"></div>
                            <span class="relative text-xs font-bold text-sky-100/85">الإجمالي التقديري</span>
                            <span id="bookingTotalDisplay" class="relative text-2xl font-black text-[#38BDF8]">{{ number_format($basePrice, 2) }} ر.س</span>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('bookingForm');
        const base = parseFloat(form.dataset.basePrice || '0');
        const fmt = n => n.toFixed(2) + ' ر.س';
        const $ = id => document.getElementById(id);

        // +/- counters (dispatch "input" so the global price calculator in app.js also updates)
        document.querySelectorAll('[data-counter-btn]').forEach(btn => btn.addEventListener('click', () => {
            const input = document.getElementById(btn.dataset.target);
            const next = (parseInt(input.value) || 0) + parseInt(btn.dataset.counterBtn);
            input.value = Math.min(parseInt(input.max), Math.max(parseInt(input.min), next));
            input.dispatchEvent(new Event('input', { bubbles: true }));
        }));

        // Live price breakdown
        function breakdown() {
            const adults = parseInt(form.adults_count.value) || 1;
            const children = parseInt(form.children_count.value) || 0;
            let addons = 0;
            form.querySelectorAll('.addon-checkbox:checked').forEach(cb => {
                const cost = parseFloat(cb.dataset.addonPrice || '0');
                addons += cb.dataset.perPerson === 'true' ? cost * (adults + children) : cost;
            });
            $('bkAdults').textContent = `${adults} × ${base.toFixed(0)} = ${fmt(adults * base)}`;
            $('bkChildren').textContent = children ? `${children} × ${(base * 0.5).toFixed(0)} = ${fmt(children * base * 0.5)}` : '—';
            $('bkAddons').textContent = addons ? fmt(addons) : '—';
        }
        form.addEventListener('input', breakdown);
        form.addEventListener('change', breakdown);
        breakdown();

        // Live stepper that follows the visible form section
        const sections = [...document.querySelectorAll('[data-step]')];
        const items = [...document.querySelectorAll('[data-step-ind]')];
        const fill = $('stepFill');
        let ticking = false;
        function updateStepper() {
            let active = 1;
            sections.forEach(s => { if (s.getBoundingClientRect().top < window.innerHeight * 0.55) active = parseInt(s.dataset.step); });
            items.forEach(li => {
                const n = parseInt(li.dataset.stepInd);
                const state = n < active ? 'done' : (n === active ? 'active' : 'idle');
                li.dataset.state = state;
                li.querySelector('.step-dot').innerHTML = state === 'done' ? '<i class="fa-solid fa-check text-sm"></i>' : n;
            });
            fill.style.width = ((active - 1) / (items.length - 1) * 100) + '%';
            ticking = false;
        }
        window.addEventListener('scroll', () => { if (!ticking) { requestAnimationFrame(updateStepper); ticking = true; } }, { passive: true });
        updateStepper();

        // Prevent double submit
        form.addEventListener('submit', () => {
            const b = $('bookingSubmitBtn');
            b.disabled = true;
            b.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i><span>جاري تأكيد الحجز...</span>';
        });
    });
</script>
@endpush
