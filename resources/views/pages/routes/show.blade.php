@extends('layouts.app')

@section('title', $route->title . ' · مَطَلّ جازان')
@section('meta_description', $route->subtitle ?? $route->description)

@section('content')

<x-mg.page-hero :title="$route->title" :subtitle="$route->subtitle" :image="$route->image"
    :crumbs="['المسارات السياحية' => route('routes.index'), $route->title => null]">
    <div class="mt-7 flex flex-wrap items-center gap-2.5 mg-reveal" style="--d: .2s">
        <span class="mg-badge mg-badge-cyan">{{ $route->badge ?? '01' }}</span>
        <span class="mg-badge">{{ $route->category }}</span>
        <span class="mg-badge"><i class="fa-regular fa-clock"></i> {{ $route->duration_text }}</span>
        <span class="mg-badge"><i class="fa-solid fa-gauge-high"></i> مستوى {{ $route->difficulty }}</span>
    </div>
    <div class="mt-6 flex flex-wrap items-center gap-x-5 gap-y-2 text-sm mg-reveal" style="--d: .26s">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-star text-[#38BDF8]"></i>
            <span class="font-black text-lg">{{ number_format($route->rating, 2) }}</span>
            <span class="text-sky-100/80">({{ $route->reviews_count }} تقييم)</span>
        </div>
        <span class="opacity-40">·</span>
        <div class="text-sky-100/90">يبدأ من <span class="font-black text-[#38BDF8] text-xl">{{ number_format($route->price, 0) }}</span> ر.س / للشخص</div>
    </div>
</x-mg.page-hero>

<section class="relative px-4 pb-24 -mt-2 overflow-hidden">
    <div class="mg-orb mg-orb-cyan w-96 h-96 top-40 -left-24" data-speed="0.08"></div>
    <div class="mg-orb mg-orb-sky w-80 h-80 bottom-40 -right-20" data-speed="0.06"></div>

    <div class="relative z-[2] max-w-7xl mx-auto grid lg:grid-cols-3 gap-8 items-start">

        {{-- ============ MAIN CONTENT ============ --}}
        <div class="lg:col-span-2 space-y-8 min-w-0">

            {{-- About --}}
            <div class="rounded-[2rem] bg-white border border-[#06B6D4]/15 shadow-xl shadow-[#164E63]/5 p-7 sm:p-9 mg-reveal">
                <div class="flex items-center gap-4 mb-5">
                    <span class="mg-icon-tile"><i class="fa-solid fa-compass"></i></span>
                    <h3 class="text-xl sm:text-2xl font-black text-[#164E63]">عن هذا المسار</h3>
                </div>
                <p class="text-[#183746]/80 leading-loose">{{ $route->description }}</p>
            </div>

            {{-- Timeline --}}
            <div class="rounded-[2rem] bg-white border border-[#06B6D4]/15 shadow-xl shadow-[#164E63]/5 p-7 sm:p-9 mg-reveal">
                <div class="flex items-center gap-4 mb-8">
                    <span class="mg-icon-tile mg-icon-tile-dark"><i class="fa-solid fa-location-dot"></i></span>
                    <div>
                        <h3 class="text-xl sm:text-2xl font-black text-[#164E63]">محطات ومراحل المسار</h3>
                        <p class="text-sm text-[#183746]/70 mt-1">تسلسل محطات الرحلة من لحظة الانطلاق وحتى محطة الختام</p>
                    </div>
                </div>

                <div class="relative">
                    <div class="absolute top-3 bottom-3 right-[1.35rem] w-0.5 bg-gradient-to-b from-[#06B6D4] via-[#38BDF8] to-[#164E63]/20 rounded-full"></div>
                    @if(is_array($route->stops))
                        <div class="space-y-5" data-stagger="0.1">
                            @foreach($route->stops as $index => $stop)
                                <div class="mg-reveal mg-reveal-right relative pr-16 group">
                                    <div class="absolute right-0 top-1 w-11 h-11 rounded-full bg-gradient-to-br from-[#06B6D4] to-[#38BDF8] text-white font-black flex items-center justify-center shadow-lg shadow-[#06B6D4]/40 ring-4 ring-white group-hover:scale-110 transition-transform duration-300">
                                        {{ $stop['step'] ?? ($index + 1) }}
                                    </div>
                                    <div class="p-5 rounded-2xl bg-[#F8FCFD] border border-[#06B6D4]/15 group-hover:border-[#06B6D4]/50 group-hover:-translate-x-1 group-hover:shadow-lg group-hover:shadow-[#06B6D4]/10 transition-all duration-300">
                                        <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                                            <h4 class="font-black text-[#164E63]">{{ $stop['title'] ?? $stop['name'] ?? '' }}</h4>
                                            <span class="mg-badge mg-badge-cyan">المحطة {{ $stop['step'] ?? ($index + 1) }}</span>
                                        </div>
                                        <p class="text-sm text-[#183746]/75 leading-relaxed">{{ $stop['desc'] ?? $stop['description'] ?? '' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- Highlights + included --}}
            <div class="grid md:grid-cols-2 gap-6 mg-perspective" data-stagger="0.12">
                <div class="mg-card mg-reveal p-7" data-tilt-max="5">
                    <h3 class="flex items-center gap-3 text-lg font-black text-[#164E63] mb-5">
                        <span class="mg-icon-tile !w-11 !h-11 !text-base"><i class="fa-solid fa-wand-magic-sparkles"></i></span>
                        <span>أبرز ما يميز المسار</span>
                    </h3>
                    <ul class="space-y-3 text-sm text-[#183746]/80">
                        @forelse(is_array($route->highlights) ? $route->highlights : ['إطلالات بانورامية خلابة', 'ضيافة جازانية وتذوق أكلات أصيلة'] as $hl)
                            <li class="flex items-start gap-2.5"><i class="fa-solid fa-circle-check text-[#06B6D4] mt-1 text-xs"></i><span>{{ $hl }}</span></li>
                        @empty
                        @endforelse
                    </ul>
                </div>
                <div class="mg-card mg-reveal p-7" data-tilt-max="5">
                    <h3 class="flex items-center gap-3 text-lg font-black text-[#164E63] mb-5">
                        <span class="mg-icon-tile mg-icon-tile-dark !w-11 !h-11 !text-base"><i class="fa-solid fa-box-open"></i></span>
                        <span>الخدمات المشمولة</span>
                    </h3>
                    <ul class="space-y-3 text-sm text-[#183746]/80">
                        @forelse(is_array($route->included_services) ? $route->included_services : ['مواصلات حديثة ومريحة', 'مرشد سياحي محلي معتمد'] as $srv)
                            <li class="flex items-start gap-2.5"><i class="fa-solid fa-circle-check text-[#06B6D4] mt-1 text-xs"></i><span>{{ $srv }}</span></li>
                        @empty
                        @endforelse
                    </ul>
                </div>
            </div>

            {{-- Reviews --}}
            <x-mg.reviews :reviews="$route->reviews" :rating="$route->rating" :id="$route->id" field="tourist_route_id"
                subtitle="تجارب حقيقية من أشخاص شاركوا في هذا المسار"
                form-title="أضف تقييمك عن المسار"
                placeholder="شاركنا تفاصيل تجربتك وما أعجبك في المسار..."
                empty="كن أول من يقيّم هذا المسار بعد استكمال رحلتك!" />
        </div>

        {{-- ============ BOOKING CARD ============ --}}
        <aside class="order-first lg:order-none lg:sticky lg:top-28">
            <div class="rounded-[2rem] p-1 bg-gradient-to-br from-[#164E63] via-[#06B6D4] to-[#38BDF8] shadow-2xl shadow-[#06B6D4]/25 mg-reveal mg-reveal-left">
                <div class="rounded-[1.85rem] bg-white p-7">
                    <span class="mg-badge mg-badge-cyan"><i class="fa-solid fa-bolt"></i> حجز فوري ومؤكد</span>
                    <h3 class="mt-4 text-2xl font-black text-[#164E63]">احجز هذا المسار</h3>
                    <p class="mt-2 text-sm text-[#183746]/70 leading-relaxed">اختر موعد رحلتك وسيتولى فريق مَطَلّ تنسيق كامل المحطات.</p>

                    <div class="my-6 rounded-2xl bg-gradient-to-br from-[#164E63] to-[#0e3b4d] p-5 text-center text-white relative overflow-hidden">
                        <div class="mg-orb mg-orb-cyan w-32 h-32 -top-10 -left-10"></div>
                        <div class="relative text-xs text-sky-100/80 mb-1">سعر التذكرة الأساسية</div>
                        <div class="relative text-4xl font-black text-[#38BDF8]">{{ number_format($route->price, 2) }} <span class="text-base text-white/80">ر.س</span></div>
                    </div>

                    <div class="space-y-3 text-sm mb-6">
                        <div class="flex items-center justify-between gap-3 pb-3 border-b border-[#06B6D4]/15">
                            <span class="text-[#183746]/70 flex items-center gap-2"><i class="fa-regular fa-clock text-[#06B6D4]"></i> المدة الزمنية</span>
                            <span class="font-black text-[#164E63]">{{ $route->duration_text }}</span>
                        </div>
                        <div class="flex items-center justify-between gap-3">
                            <span class="text-[#183746]/70 flex items-center gap-2"><i class="fa-solid fa-gauge-high text-[#06B6D4]"></i> درجة الصعوبة</span>
                            <span class="font-black text-[#164E63]">{{ $route->difficulty }}</span>
                        </div>
                    </div>

                    <a href="{{ route('booking.create', ['type' => 'route', 'id' => $route->id]) }}" class="mg-btn w-full" data-magnetic>
                        <span>متابعة الحجز الآن</span><i class="fa-solid fa-arrow-left text-xs"></i>
                    </a>

                    <div class="mt-5 space-y-2 text-xs text-[#183746]/70">
                        <p class="flex items-center gap-2"><i class="fa-solid fa-shield-heart text-[#06B6D4]"></i> ضمان أفضل تجربة وإلغاء مرن حتى 48 ساعة</p>
                        <p class="flex items-center gap-2"><i class="fa-solid fa-headset text-[#06B6D4]"></i> دعم سياحي مباشر طوال فترة المسار</p>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</section>

{{-- ================= RELATED ROUTES ================= --}}
@if($relatedRoutes->count())
<section class="mg-section mg-bg-dark mg-grid-pattern">
    <div class="mg-orb mg-orb-cyan w-[28rem] h-[28rem] -top-32 right-0" data-speed="0.1"></div>
    <div class="mg-wrap">
        <x-mg.section-head eyebrow="رحلات أخرى قد تعجبك" icon="fa-route" title="مسارات مشابهة" />
        <div class="grid md:grid-cols-3 gap-6 mg-perspective" data-stagger="0.12">
            @foreach($relatedRoutes as $rel)
                <a href="{{ route('routes.show', $rel->slug) }}" class="mg-card mg-card-glass mg-reveal group block overflow-hidden">
                    <div class="mg-photo mg-photo-tint h-52 rounded-t-[1.75rem] rounded-b-none">
                        <img src="{{ $rel->image }}" alt="{{ $rel->title }}" loading="lazy">
                        <span class="mg-badge absolute top-4 right-4 z-10">{{ $rel->category }}</span>
                        <span class="mg-badge absolute bottom-4 left-4 z-10"><i class="fa-solid fa-star text-[#38BDF8]"></i> {{ number_format($rel->rating, 1) }}</span>
                    </div>
                    <div class="p-6 text-right">
                        <h3 class="font-black text-white text-lg mb-1">{{ $rel->title }}</h3>
                        <p class="text-xs text-sky-100/75 mb-4">{{ $rel->duration_text }} · {{ $rel->difficulty }}</p>
                        <span class="inline-flex items-center gap-2 text-[#38BDF8] font-bold text-sm">عرض المسار <i class="fa-solid fa-arrow-left transition group-hover:-translate-x-1.5"></i></span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
