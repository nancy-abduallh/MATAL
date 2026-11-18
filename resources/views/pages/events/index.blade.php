@extends('layouts.app')

@section('title', 'الفعاليات والمهرجانات · مَطَلّ جازان')
@section('meta_description', 'تجارب موسمية تعيشها في جازان: مهرجان البن الخولاني الدولي، شتاء جازان، وموسم غوص فرسان.')

@section('content')

@php
    $months = ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'];
    $eventFilters = [
        'all' => 'كل الفعاليات', 'تراثية' => 'تراثية وزراعية', 'عائلية' => 'عائلية وترفيهية',
        'بحرية' => 'بحرية', 'مغامرات' => 'رياضية ومغامرات',
    ];
@endphp

<x-mg.page-hero title="الفعاليات والمهرجانات" subtitle="تجارب موسمية تعيشها في جازان بين البحر والجبل."
    image="/images/farasan_islands.jpg" :crumbs="['الفعاليات والمهرجانات' => null]">
    <div class="mt-8 flex flex-wrap gap-3 mg-reveal" style="--d: .22s">
        <span class="mg-badge"><i class="fa-solid fa-calendar-days text-[#38BDF8]"></i> مواسم وفعاليات طوال العام</span>
        <span class="mg-badge"><i class="fa-solid fa-ticket text-[#38BDF8]"></i> حجز مقاعد فوري</span>
    </div>
</x-mg.page-hero>

{{-- ================= FEATURED EVENT ================= --}}
@if($featuredEvent)
<section class="relative px-4 pt-4 pb-16 sm:pb-24 overflow-hidden">
    <div class="mg-orb mg-orb-cyan w-96 h-96 top-0 -right-24" data-speed="0.08"></div>
    <div class="relative z-[2] max-w-7xl mx-auto">
        <div class="mg-aurora relative overflow-hidden rounded-[2.5rem] text-white shadow-2xl shadow-[#164E63]/40 grid lg:grid-cols-2 mg-reveal mg-reveal-scale">
            <div class="mg-orb mg-orb-sky w-72 h-72 -top-20 -right-10"></div>
            <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 24px 24px;"></div>

            {{-- Content (right in RTL) --}}
            <div class="relative p-8 sm:p-12 flex flex-col justify-center text-right">
                <span class="mg-badge mg-badge-cyan self-start mb-5"><i class="fa-solid fa-fire"></i> فعالية مميزة</span>
                <h2 class="text-3xl sm:text-4xl font-black leading-tight mb-4">{{ $featuredEvent->title }}</h2>
                <p class="text-sky-100/85 leading-loose mb-6">{{ $featuredEvent->description }}</p>

                <div class="flex flex-wrap gap-3 mb-6">
                    <span class="mg-badge !text-xs !py-2 !px-4"><i class="fa-regular fa-calendar text-[#38BDF8]"></i> {{ $featuredEvent->date_text }}</span>
                    <span class="mg-badge !text-xs !py-2 !px-4"><i class="fa-solid fa-location-dot text-[#38BDF8]"></i> {{ $featuredEvent->location }}</span>
                </div>

                {{-- Live countdown (hidden by JS if the date has passed) --}}
                @if($featuredEvent->date_start)
                    <div id="evCountdown" data-date="{{ \Carbon\Carbon::parse($featuredEvent->date_start)->toIso8601String() }}" class="grid grid-cols-4 gap-2.5 max-w-sm mb-7">
                        @foreach([['d', 'يوم'], ['h', 'ساعة'], ['m', 'دقيقة'], ['s', 'ثانية']] as $u)
                            <div class="mg-card-glass rounded-2xl py-3 text-center">
                                <div class="text-2xl sm:text-3xl font-black text-[#38BDF8] tabular-nums" data-cd="{{ $u[0] }}">00</div>
                                <div class="text-[10px] font-bold text-sky-100/70">{{ $u[1] }}</div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ route('booking.create', ['type' => 'event', 'id' => $featuredEvent->id]) }}" class="mg-btn" data-magnetic><i class="fa-solid fa-ticket"></i><span>احجز مقعدك</span></a>
                    <a href="{{ route('events.show', $featuredEvent->slug) }}" class="mg-btn-ghost !text-white !bg-white/10 !border-white/35"><span>تفاصيل الفعالية</span><i class="fa-solid fa-arrow-left text-xs"></i></a>
                </div>
            </div>

            {{-- Image (left in RTL) --}}
            <div class="relative min-h-[18rem] lg:min-h-full mg-perspective">
                <div class="mg-photo mg-photo-tint absolute inset-0 group lg:rounded-none">
                    <img src="{{ $featuredEvent->image }}" alt="{{ $featuredEvent->title }}">
                </div>
                <div class="absolute inset-0 bg-gradient-to-l from-transparent to-[#164E63]/70 hidden lg:block pointer-events-none"></div>
                <div class="absolute top-6 left-6 mg-float-a mg-card-glass !bg-[#072430]/80 rounded-2xl px-4 py-3 text-xs font-black z-10 flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#38BDF8] mg-pulse"></span>
                    @if($featuredEvent->price > 0) {{ number_format($featuredEvent->price, 0) }} ر.س @else دخول مجاني @endif
                </div>
                @if($featuredEvent->tickets_available)
                    <div class="absolute bottom-6 right-6 mg-float-b mg-card-glass !bg-[#072430]/80 rounded-2xl px-4 py-3 text-xs font-black z-10 flex items-center gap-2">
                        <i class="fa-solid fa-chair text-[#38BDF8]"></i> متبقي {{ $featuredEvent->tickets_available }} مقعد
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endif

{{-- ================= UPCOMING EVENTS ================= --}}
<section class="mg-section mg-bg-light mg-grid-pattern !pt-16">
    <div class="mg-orb mg-orb-cyan w-96 h-96 top-10 -left-24" data-speed="0.08"></div>
    <div class="mg-orb mg-orb-sky w-80 h-80 bottom-10 -right-20" data-speed="0.06"></div>
    <div class="mg-wrap">
        <x-mg.section-head eyebrow="مواسم وفعاليات جازان طوال العام" icon="fa-calendar-days" title="الفعاليات القادمة" />

        <div class="flex flex-wrap items-center justify-center gap-2.5 mb-12 mg-reveal">
            @foreach($eventFilters as $key => $label)
                @php $on = request('category', 'all') == $key; @endphp
                <a href="{{ route('events.index', ['category' => $key]) }}" class="mg-chip {{ $on ? 'is-active' : '' }}">{{ $label }}</a>
            @endforeach
        </div>

        <div class="grid md:grid-cols-2 gap-7 mg-perspective" data-stagger="0.1">
            @forelse($upcomingEvents as $evt)
                @php $d = $evt->date_start ? \Carbon\Carbon::parse($evt->date_start) : null; @endphp
                <article class="mg-card mg-reveal group flex flex-col overflow-hidden">
                    <a href="{{ route('events.show', $evt->slug) }}" class="mg-photo mg-photo-tint block h-60 rounded-t-[1.75rem] rounded-b-none" aria-label="{{ $evt->title }}">
                        <img src="{{ $evt->image }}" alt="{{ $evt->title }}" loading="lazy">
                        <span class="mg-badge mg-badge-cyan absolute top-4 right-4 z-10">{{ $evt->category }}</span>
                        @if($d)
                            <div class="absolute top-4 left-4 z-10 w-16 rounded-2xl overflow-hidden bg-white text-center shadow-xl shadow-[#072430]/40 group-hover:-rotate-3 group-hover:scale-105 transition-transform duration-300">
                                <div class="bg-gradient-to-r from-[#164E63] to-[#0e3b4d] text-[#38BDF8] text-[10px] font-black py-1">{{ $months[$d->month - 1] }}</div>
                                <div class="text-2xl font-black text-[#164E63] py-1.5 leading-none">{{ $d->day }}</div>
                            </div>
                        @endif
                    </a>

                    <div class="p-6 flex flex-col flex-grow text-right">
                        <h4 class="text-xl font-black text-[#164E63] mb-3 group-hover:text-[#0891B2] transition-colors">
                            <a href="{{ route('events.show', $evt->slug) }}">{{ $evt->title }}</a>
                        </h4>
                        <div class="flex flex-wrap gap-2 mb-4 text-xs font-bold text-[#164E63]">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-[#E0F2FE]"><i class="fa-regular fa-calendar text-[#06B6D4]"></i> {{ $evt->date_text }}</span>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-[#E0F2FE]"><i class="fa-solid fa-location-dot text-[#06B6D4]"></i> {{ $evt->location }}</span>
                        </div>
                        <p class="text-sm text-[#183746]/75 leading-relaxed line-clamp-3 mb-5">{{ $evt->description }}</p>

                        <div class="mt-auto pt-4 border-t border-[#06B6D4]/15 flex items-center justify-between gap-3">
                            <div>
                                @if($evt->price > 0)
                                    <span class="text-xl font-black text-[#164E63]">{{ number_format($evt->price, 0) }}</span> <span class="text-xs font-bold text-[#164E63]/70">ر.س</span>
                                @else
                                    <span class="mg-badge mg-badge-cyan">دخول مجاني</span>
                                @endif
                            </div>
                            <a href="{{ route('booking.create', ['type' => 'event', 'id' => $evt->id]) }}" class="mg-btn !py-2.5 !px-5 !text-sm">
                                <span>احجز الآن</span><i class="fa-solid fa-arrow-left text-xs"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-20 rounded-[2rem] bg-white border-2 border-dashed border-[#06B6D4]/30 mg-reveal">
                    <span class="mg-icon-tile mx-auto mb-5 mg-float-a"><i class="fa-solid fa-calendar-xmark"></i></span>
                    <p class="text-[#164E63] font-black text-lg">لا توجد فعاليات في هذا التصنيف حالياً.</p>
                    <a href="{{ route('events.index') }}" class="mg-btn mt-6"><span>عرض كل الفعاليات</span><i class="fa-solid fa-arrow-left text-xs"></i></a>
                </div>
            @endforelse
        </div>

        <div class="mt-14">
            {{ $upcomingEvents->links('vendor.pagination.mg') }}
        </div>

        {{-- Organiser CTA --}}
        <div class="mt-20 mg-aurora relative overflow-hidden rounded-3xl p-8 sm:p-12 text-white flex flex-col md:flex-row items-center justify-between gap-6 shadow-2xl shadow-[#164E63]/30 mg-reveal mg-reveal-scale">
            <div class="mg-orb mg-orb-sky w-64 h-64 -top-20 -left-10"></div>
            <div class="relative text-center md:text-right space-y-3">
                <span class="mg-badge mg-badge-cyan"><i class="fa-solid fa-handshake"></i> للمنظمين والشركاء</span>
                <h4 class="text-xl sm:text-2xl font-black">هل تنظم فعالية أو مهرجاناً في جازان؟</h4>
                <p class="text-sm text-sky-100/85 max-w-2xl leading-relaxed">تواصل معنا لإدراج فعاليتك على منصة «مَطَلّ» والوصول إلى آلاف الزوار.</p>
            </div>
            <a href="{{ route('about') }}#contact" class="mg-btn shrink-0 relative" data-magnetic><span>تواصل معنا</span><i class="fa-solid fa-arrow-left text-xs"></i></a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const box = document.getElementById('evCountdown');
        if (!box) return;
        const target = new Date(box.dataset.date).getTime();
        const pad = n => String(n).padStart(2, '0');
        const set = (k, v) => { const el = box.querySelector(`[data-cd="${k}"]`); if (el) el.textContent = pad(v); };

        function tick() {
            const diff = target - Date.now();
            if (isNaN(target) || diff <= 0) { box.classList.add('hidden'); return false; }
            set('d', Math.floor(diff / 864e5));
            set('h', Math.floor(diff % 864e5 / 36e5));
            set('m', Math.floor(diff % 36e5 / 6e4));
            set('s', Math.floor(diff % 6e4 / 1e3));
            return true;
        }
        if (tick()) setInterval(tick, 1000);
    });
</script>
@endpush
