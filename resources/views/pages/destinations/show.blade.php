@extends('layouts.app')

@section('title', $destination->title . ' · مَطَلّ جازان')
@section('meta_description', $destination->description)

@section('content')

@php
    $gallery = array_slice(array_values(array_unique(array_merge(
        [$destination->image],
        is_array($destination->gallery) ? array_filter($destination->gallery, 'is_string') : [],
        ['/images/mountain_terraces.jpg', '/images/detail_village.jpg']
    ))), 0, 3);

    $infoCards = [
        ['icon' => 'fa-calendar-check', 'label' => 'أفضل وقت للزيارة', 'value' => $destination->best_time],
        ['icon' => 'fa-clock',          'label' => 'مدة الزيارة',       'value' => $destination->duration],
        ['icon' => 'fa-gauge-high',     'label' => 'مستوى الصعوبة',     'value' => $destination->difficulty],
        ['icon' => 'fa-people-roof',    'label' => 'مناسب للعائلة',     'value' => $destination->is_family_friendly ? 'نعم' : 'للبالغين فقط'],
        ['icon' => 'fa-square-parking', 'label' => 'مواقف السيارات',    'value' => $destination->has_parking ? 'متوفرة' : 'غير متوفرة'],
        ['icon' => 'fa-road',           'label' => 'حالة الطريق',       'value' => $destination->road_condition],
    ];
@endphp

<x-mg.page-hero :title="$destination->title" :image="$destination->image"
    :crumbs="['الوجهات والمعالم' => route('destinations.index'), $destination->title => null]">
    <div class="mt-7 mg-reveal" style="--d: .2s">
        <span class="mg-badge mg-badge-cyan">
            @if(is_array($destination->tags)) {{ implode(' · ', $destination->tags) }} @else {{ $destination->tagline }} @endif
        </span>
    </div>
    <div class="mt-5 flex flex-wrap items-center gap-x-4 gap-y-2 text-sm mg-reveal" style="--d: .26s">
        <i class="fa-solid fa-star text-[#38BDF8]"></i>
        <span class="font-black text-lg">{{ number_format($destination->rating, 1) }}</span>
        <span class="text-sky-100/80">({{ $destination->reviews_count }} تقييم)</span>
        <span class="opacity-40">·</span>
        <span class="inline-flex items-center gap-1.5"><i class="fa-solid fa-location-dot text-[#38BDF8]"></i> {{ $destination->region }}</span>
    </div>
</x-mg.page-hero>

<section class="relative px-4 pb-24 -mt-2 overflow-hidden">
    <div class="mg-orb mg-orb-cyan w-96 h-96 top-40 -left-24" data-speed="0.08"></div>
    <div class="mg-orb mg-orb-sky w-80 h-80 bottom-60 -right-20" data-speed="0.06"></div>

    <div class="relative z-[2] max-w-7xl mx-auto grid lg:grid-cols-3 gap-8 items-start">

        {{-- ============ MAIN CONTENT ============ --}}
        <div class="lg:col-span-2 space-y-8 min-w-0">

            {{-- Story --}}
            <div class="rounded-[2rem] bg-white border border-[#06B6D4]/15 shadow-xl shadow-[#164E63]/5 p-7 sm:p-9 mg-reveal">
                <div class="flex items-center gap-4 mb-5">
                    <span class="mg-icon-tile"><i class="fa-solid fa-book-open"></i></span>
                    <h2 class="text-xl sm:text-2xl font-black text-[#164E63]">قصة المكان</h2>
                </div>
                <p class="text-[#183746]/80 leading-loose">{{ $destination->story ?? $destination->description }}</p>
            </div>

            {{-- Gallery --}}
            <div class="grid grid-cols-3 grid-rows-2 gap-4 h-72 sm:h-96 mg-perspective mg-reveal">
                @foreach($gallery as $g)
                    <div class="mg-photo group rounded-3xl shadow-xl shadow-[#164E63]/15 {{ $loop->first ? 'col-span-2 row-span-2' : '' }}">
                        <img src="{{ $g }}" alt="صورة المكان {{ $loop->iteration }}" loading="lazy" class="absolute inset-0">
                    </div>
                @endforeach
            </div>

            {{-- Visit info --}}
            <div>
                <h3 class="flex items-center gap-3 text-xl sm:text-2xl font-black text-[#164E63] mb-6 mg-reveal">
                    <span class="mg-icon-tile mg-icon-tile-dark !w-11 !h-11 !text-base"><i class="fa-solid fa-circle-info"></i></span> معلومات الزيارة
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mg-perspective" data-stagger="0.08">
                    @foreach($infoCards as $ic)
                        <div class="mg-card mg-reveal group p-5 text-right" data-tilt-max="9">
                            <span class="mg-icon-tile mg-pop !w-11 !h-11 !text-base mb-4"><i class="fa-solid {{ $ic['icon'] }}"></i></span>
                            <span class="block text-[11px] font-black text-[#06B6D4] mb-1">{{ $ic['label'] }}</span>
                            <div class="font-black text-[#164E63] text-sm sm:text-base leading-snug">{{ $ic['value'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Facilities --}}
            @if(is_array($destination->facilities) && count(array_filter($destination->facilities, 'is_string')))
                <div class="rounded-[2rem] bg-white border border-[#06B6D4]/15 shadow-xl shadow-[#164E63]/5 p-7 mg-reveal">
                    <h3 class="font-black text-[#164E63] mb-4 flex items-center gap-2"><i class="fa-solid fa-bell-concierge text-[#06B6D4]"></i> المرافق والخدمات</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach(array_filter($destination->facilities, 'is_string') as $fc)
                            <span class="mg-chip cursor-default"><i class="fa-solid fa-check text-[#06B6D4] text-xs"></i>{{ $fc }}</span>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Map --}}
            <div class="mg-reveal">
                <h3 class="flex items-center gap-3 text-xl sm:text-2xl font-black text-[#164E63] mb-6">
                    <span class="mg-icon-tile !w-11 !h-11 !text-base"><i class="fa-solid fa-map-location-dot"></i></span> الموقع على الخريطة
                </h3>
                <div class="rounded-3xl p-1.5 bg-gradient-to-r from-[#164E63] via-[#06B6D4] to-[#38BDF8] shadow-2xl shadow-[#06B6D4]/20">
                    <div id="placeMap" class="isolate rounded-[1.4rem] overflow-hidden h-[22rem] sm:h-[26rem] w-full bg-[#E0F2FE]"></div>
                </div>
            </div>

            {{-- Reviews --}}
            <x-mg.reviews :reviews="$destination->reviews" :rating="$destination->rating" :id="$destination->id" field="destination_id"
                :subtitle="'تجارب حقيقية من أشخاص زاروا ' . $destination->title"
                form-title="أضف تجربتك عن هذا الموقع"
                placeholder="ما رأيك في الطريق والمرافق والإطلالة؟"
                submit="نشر التقييم"
                empty="كن أول من يشارك تقييمه عن هذا المعلم الساحر!"
                :labels="[5 => '⭐⭐⭐⭐⭐ استثنائي (5 من 5)', 4 => '⭐⭐⭐⭐ ممتاز (4 من 5)', 3 => '⭐⭐⭐ جيد (3 من 5)']" />
        </div>

        {{-- ============ BOOKING CARD ============ --}}
        <aside class="order-first lg:order-none lg:sticky lg:top-28">
            <div class="rounded-[2rem] p-1 bg-gradient-to-br from-[#164E63] via-[#06B6D4] to-[#38BDF8] shadow-2xl shadow-[#06B6D4]/25 mg-reveal mg-reveal-left">
                <div class="rounded-[1.85rem] bg-white p-7">
                    <span class="mg-badge mg-badge-cyan"><i class="fa-solid fa-ticket"></i> احجز تجربتك</span>
                    <h3 class="mt-4 text-2xl font-black text-[#164E63]">احجز تجربتك</h3>
                    <p class="mt-2 text-sm text-[#183746]/70 leading-relaxed">اختر التاريخ وعدد الزوار وأضف الموقع إلى مسارك السياحي المخصص.</p>

                    <form action="{{ route('booking.create') }}" method="GET" class="mt-6 space-y-4">
                        <input type="hidden" name="type" value="destination">
                        <input type="hidden" name="id" value="{{ $destination->id }}">
                        <div>
                            <label class="mg-label"><i class="fa-regular fa-calendar text-[#06B6D4] ml-1"></i> التاريخ</label>
                            <input type="date" name="date" value="{{ date('Y-m-d', strtotime('+2 days')) }}" class="mg-field">
                        </div>
                        <div>
                            <label class="mg-label"><i class="fa-solid fa-user-group text-[#06B6D4] ml-1"></i> عدد الزوار</label>
                            <select name="adults_count" class="mg-field">
                                <option value="1">1 زائر</option>
                                <option value="2" selected>2 زوار</option>
                                <option value="3">3 زوار</option>
                                <option value="4">4 زوار</option>
                                <option value="5">5 زوار أو أكثر</option>
                            </select>
                        </div>
                        <div class="space-y-3 pt-2">
                            <button type="submit" class="mg-btn w-full" data-magnetic><span>احجز الآن</span><i class="fa-solid fa-arrow-left text-xs"></i></button>
                            <a href="{{ route('map.index') }}" class="mg-btn-ghost w-full !text-sm"><i class="fa-solid fa-map-pin"></i><span>أضف إلى مساري في الخريطة</span></a>
                        </div>
                    </form>

                    <div class="mt-5 pt-5 border-t border-[#06B6D4]/15 space-y-2 text-xs text-[#183746]/70">
                        <p class="flex items-center gap-2"><i class="fa-solid fa-shield-heart text-[#06B6D4]"></i> حجز رقمي آمن ومعتمد</p>
                        <p class="flex items-center gap-2"><i class="fa-solid fa-cloud-sun text-[#06B6D4]"></i> الطقس المتوقع: {{ $destination->weather_summary }}</p>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</section>

{{-- ================= NEARBY + RELATED ROUTES ================= --}}
@if($nearbyDestinations->count() || $relatedRoutes->count())
<section class="mg-section mg-bg-dark mg-grid-pattern">
    <div class="mg-orb mg-orb-cyan w-[28rem] h-[28rem] -top-32 right-0" data-speed="0.1"></div>
    <div class="mg-orb mg-orb-sky w-80 h-80 bottom-0 -left-20" data-speed="0.08"></div>
    <div class="mg-wrap">
        @if($nearbyDestinations->count())
            <x-mg.section-head eyebrow="بالقرب من هذا المكان" icon="fa-location-crosshairs" title="وجهات قريبة تستحق الزيارة" />
            <div class="grid md:grid-cols-3 gap-6 mg-perspective mb-20" data-stagger="0.12">
                @foreach($nearbyDestinations as $nd)
                    <a href="{{ route('destinations.show', $nd->slug) }}" class="mg-card mg-card-glass mg-reveal group block overflow-hidden">
                        <div class="mg-photo mg-photo-tint h-52 rounded-t-[1.75rem] rounded-b-none">
                            <img src="{{ $nd->image }}" alt="{{ $nd->title }}" loading="lazy">
                            <span class="mg-badge absolute top-4 right-4 z-10">{{ $nd->region }}</span>
                            <span class="mg-badge mg-badge-cyan absolute bottom-4 left-4 z-10"><i class="fa-solid fa-star"></i> {{ number_format($nd->rating, 1) }}</span>
                        </div>
                        <div class="p-6 text-right">
                            <h3 class="font-black text-white text-lg mb-1">{{ $nd->title }}</h3>
                            <p class="text-xs text-sky-100/75 line-clamp-1 mb-4">{{ $nd->tagline }}</p>
                            <span class="inline-flex items-center gap-2 text-[#38BDF8] font-bold text-sm">عرض الوجهة <i class="fa-solid fa-arrow-left transition group-hover:-translate-x-1.5"></i></span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif

        @if($relatedRoutes->count())
            <x-mg.section-head eyebrow="اجعلها جزءاً من رحلة كاملة" icon="fa-route" title="مسارات سياحية مقترحة" />
            <div class="grid md:grid-cols-2 gap-6 mg-perspective" data-stagger="0.12">
                @foreach($relatedRoutes as $rr)
                    <a href="{{ route('routes.show', $rr->slug) }}" class="mg-card mg-card-glass mg-reveal group flex overflow-hidden">
                        <div class="mg-photo mg-photo-tint w-2/5 min-h-[10rem] rounded-s-none rounded-e-[1.75rem]">
                            <img src="{{ $rr->image }}" alt="{{ $rr->title }}" loading="lazy">
                        </div>
                        <div class="p-6 text-right flex-1 flex flex-col justify-center">
                            <span class="mg-badge mg-badge-cyan self-start mb-3">{{ $rr->category }}</span>
                            <h3 class="font-black text-white text-lg mb-1">{{ $rr->title }}</h3>
                            <p class="text-xs text-sky-100/75 mb-3">{{ $rr->duration_text }} · <i class="fa-solid fa-star text-[#38BDF8]"></i> {{ number_format($rr->rating, 1) }}</p>
                            <span class="inline-flex items-center gap-2 text-[#38BDF8] font-bold text-sm">تفاصيل المسار <i class="fa-solid fa-arrow-left transition group-hover:-translate-x-1.5"></i></span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endif

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const placeLat = {{ $destination->latitude }};
        const placeLng = {{ $destination->longitude }};
        const map = L.map('placeMap', { center: [placeLat, placeLng], zoom: 12, scrollWheelZoom: false });
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap'
        }).addTo(map);
        L.circleMarker([placeLat, placeLng], {
            radius: 11, fillColor: '#06B6D4', color: '#164E63', weight: 3, opacity: 1, fillOpacity: 0.95
        }).addTo(map).bindPopup('<b>{{ $destination->title }}</b><br>{{ $destination->region }}').openPopup();
    });
</script>
@endpush
