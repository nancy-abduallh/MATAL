@extends('layouts.app')

@section('title', $event->title . ' · مَطَلّ جازان')
@section('meta_description', \Illuminate\Support\Str::limit($event->description, 155))

@section('content')

@php
    $months = ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'];
    $infoCards = [
        ['icon' => 'fa-calendar-days', 'label' => 'موعد الفعالية', 'value' => $event->date_text],
        ['icon' => 'fa-location-dot',  'label' => 'الموقع',        'value' => $event->location],
        ['icon' => 'fa-tag',           'label' => 'التصنيف',       'value' => $event->category],
        ['icon' => 'fa-ticket',        'label' => 'سعر الدخول',    'value' => $event->price > 0 ? number_format($event->price, 0) . ' ر.س' : 'دخول مجاني'],
    ];
@endphp

<x-mg.page-hero :title="$event->title" :image="$event->image"
    :crumbs="['الفعاليات والمهرجانات' => route('events.index'), $event->title => null]">
    <div class="mt-7 flex flex-wrap items-center gap-2.5 mg-reveal" style="--d: .2s">
        <span class="mg-badge mg-badge-cyan">{{ $event->category }}</span>
        <span class="mg-badge"><i class="fa-regular fa-calendar"></i> {{ $event->date_text }}</span>
        <span class="mg-badge"><i class="fa-solid fa-location-dot"></i> {{ $event->location }}</span>
    </div>
</x-mg.page-hero>

<section class="relative px-4 pb-24 -mt-2 overflow-hidden">
    <div class="mg-orb mg-orb-cyan w-96 h-96 top-40 -left-24" data-speed="0.08"></div>
    <div class="mg-orb mg-orb-sky w-80 h-80 bottom-40 -right-20" data-speed="0.06"></div>

    <div class="relative z-[2] max-w-7xl mx-auto grid lg:grid-cols-3 gap-8 items-start">

        {{-- Main --}}
        <div class="lg:col-span-2 space-y-8 min-w-0">
            <div class="rounded-[2rem] bg-white border border-[#06B6D4]/15 shadow-xl shadow-[#164E63]/5 p-7 sm:p-9 mg-reveal">
                <div class="flex items-center gap-4 mb-5">
                    <span class="mg-icon-tile"><i class="fa-solid fa-masks-theater"></i></span>
                    <h2 class="text-xl sm:text-2xl font-black text-[#164E63]">عن الفعالية</h2>
                </div>
                <p class="text-[#183746]/80 leading-loose">{{ $event->description }}</p>
            </div>

            <div class="grid grid-cols-2 gap-4 mg-perspective" data-stagger="0.08">
                @foreach($infoCards as $ic)
                    <div class="mg-card mg-reveal group p-5 text-right" data-tilt-max="8">
                        <span class="mg-icon-tile mg-pop !w-11 !h-11 !text-base mb-4 {{ $loop->even ? 'mg-icon-tile-dark' : '' }}"><i class="fa-solid {{ $ic['icon'] }}"></i></span>
                        <span class="block text-[11px] font-black text-[#06B6D4] mb-1">{{ $ic['label'] }}</span>
                        <div class="font-black text-[#164E63] leading-snug">{{ $ic['value'] }}</div>
                    </div>
                @endforeach
            </div>

            <div class="mg-reveal">
                <div class="mg-photo h-72 sm:h-96 rounded-[2rem] shadow-2xl shadow-[#164E63]/20 group">
                    <img src="{{ $event->image }}" alt="{{ $event->title }}" loading="lazy">
                </div>
            </div>
        </div>

        {{-- Booking card --}}
        <aside class="order-first lg:order-none lg:sticky lg:top-28">
            <div class="rounded-[2rem] p-1 bg-gradient-to-br from-[#164E63] via-[#06B6D4] to-[#38BDF8] shadow-2xl shadow-[#06B6D4]/25 mg-reveal mg-reveal-left">
                <div class="rounded-[1.85rem] bg-white p-7">
                    <span class="mg-badge mg-badge-cyan"><i class="fa-solid fa-bolt"></i> حجز فوري ومؤكد</span>
                    <h3 class="mt-4 text-2xl font-black text-[#164E63]">احجز مقعدك</h3>
                    <p class="mt-2 text-sm text-[#183746]/70 leading-relaxed">أكمل حجزك الآن واحصل على تأكيد فوري للفعالية.</p>

                    <div class="my-6 rounded-2xl bg-gradient-to-br from-[#164E63] to-[#0e3b4d] p-5 text-center text-white relative overflow-hidden">
                        <div class="mg-orb mg-orb-cyan w-32 h-32 -top-10 -left-10"></div>
                        <div class="relative text-xs text-sky-100/80 mb-1">سعر التذكرة</div>
                        <div class="relative text-4xl font-black text-[#38BDF8]">
                            @if($event->price > 0) {{ number_format($event->price, 0) }} <span class="text-base text-white/80">ر.س</span> @else مجاني @endif
                        </div>
                    </div>

                    <div class="space-y-3 text-sm mb-6">
                        <div class="flex items-center justify-between gap-3 pb-3 border-b border-[#06B6D4]/15">
                            <span class="text-[#183746]/70 flex items-center gap-2"><i class="fa-regular fa-calendar text-[#06B6D4]"></i> الموعد</span>
                            <span class="font-black text-[#164E63] text-left">{{ $event->date_text }}</span>
                        </div>
                        @if($event->tickets_available)
                            <div class="flex items-center justify-between gap-3">
                                <span class="text-[#183746]/70 flex items-center gap-2"><i class="fa-solid fa-chair text-[#06B6D4]"></i> المقاعد المتاحة</span>
                                <span class="font-black text-[#164E63]">{{ $event->tickets_available }}</span>
                            </div>
                        @endif
                    </div>

                    <a href="{{ route('booking.create', ['type' => 'event', 'id' => $event->id]) }}" class="mg-btn w-full" data-magnetic>
                        <span>متابعة الحجز</span><i class="fa-solid fa-arrow-left text-xs"></i>
                    </a>
                </div>
            </div>
        </aside>
    </div>
</section>

{{-- Related events --}}
@if($relatedEvents->count())
<section class="mg-section mg-bg-dark mg-grid-pattern">
    <div class="mg-orb mg-orb-cyan w-[28rem] h-[28rem] -top-32 right-0" data-speed="0.1"></div>
    <div class="mg-wrap">
        <x-mg.section-head eyebrow="لا تفوّت" icon="fa-calendar-days" title="فعاليات أخرى في جازان" />
        <div class="grid md:grid-cols-3 gap-6 mg-perspective" data-stagger="0.12">
            @foreach($relatedEvents as $rel)
                <a href="{{ route('events.show', $rel->slug) }}" class="mg-card mg-card-glass mg-reveal group block overflow-hidden">
                    <div class="mg-photo mg-photo-tint h-52 rounded-t-[1.75rem] rounded-b-none">
                        <img src="{{ $rel->image }}" alt="{{ $rel->title }}" loading="lazy">
                        <span class="mg-badge mg-badge-cyan absolute top-4 right-4 z-10">{{ $rel->category }}</span>
                    </div>
                    <div class="p-6 text-right">
                        <h3 class="font-black text-white text-lg mb-2">{{ $rel->title }}</h3>
                        <p class="text-xs text-sky-100/75 mb-4"><i class="fa-regular fa-calendar text-[#38BDF8]"></i> {{ $rel->date_text }}</p>
                        <span class="inline-flex items-center gap-2 text-[#38BDF8] font-bold text-sm">عرض التفاصيل <i class="fa-solid fa-arrow-left transition group-hover:-translate-x-1.5"></i></span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
