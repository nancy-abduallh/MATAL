@extends('layouts.app')

@section('title', 'المسارات السياحية · مَطَلّ جازان')
@section('meta_description', 'استكشف مسارات جازان السياحية المتكاملة: مسار الجبال، مسار البن السعودي، المسار البحري، ومسار المغامرات.')

@section('content')

<x-mg.page-hero title="المسارات السياحية" subtitle="ما نوع الرحلة التي تريدها؟ ثم نبني لك مساراً كاملاً."
    image="/images/mountain_terraces.jpg" :crumbs="['المسارات السياحية' => null]">
    <div class="mt-8 flex flex-wrap gap-3 mg-reveal" style="--d: .22s">
        <span class="mg-badge"><i class="fa-solid fa-route text-[#38BDF8]"></i> {{ $routes->total() }} مسار متاح</span>
        <span class="mg-badge"><i class="fa-solid fa-bolt text-[#38BDF8]"></i> حجز فوري ومؤكد</span>
        <span class="mg-badge"><i class="fa-solid fa-headset text-[#38BDF8]"></i> دعم سياحي مباشر</span>
    </div>
</x-mg.page-hero>

{{-- ================= FILTER BAR ================= --}}
<section class="relative z-20 -mt-8 sm:-mt-10 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="rounded-3xl bg-white/95 backdrop-blur-xl border border-[#06B6D4]/20 shadow-2xl shadow-[#164E63]/15 p-4 sm:p-5 mg-reveal mg-reveal-scale">
            <div class="flex flex-col lg:flex-row lg:items-center gap-4">
                <div class="flex flex-wrap gap-2 flex-grow">
                    @foreach($categories as $name => $cat)
                        @php $active = request('category') == $cat || (!request('category') && $cat == 'all'); @endphp
                        <a href="{{ route('routes.index', ['category' => $cat]) }}" class="mg-chip {{ $active ? 'is-active' : '' }}">{{ $name }}</a>
                    @endforeach
                </div>
                <form method="GET" action="{{ route('routes.index') }}" class="relative lg:w-72 shrink-0">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <i class="fa-solid fa-magnifying-glass absolute right-4 top-1/2 -translate-y-1/2 text-[#06B6D4] text-sm pointer-events-none"></i>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="ابحث عن مسار..." class="mg-field !pr-11 !py-2.5 text-sm">
                </form>
            </div>
        </div>
    </div>
</section>

{{-- ================= ROUTES GRID ================= --}}
<section class="relative px-4 py-14 sm:py-20 overflow-hidden">
    <div class="mg-orb mg-orb-cyan w-96 h-96 top-20 -left-24" data-speed="0.08"></div>
    <div class="mg-orb mg-orb-sky w-80 h-80 bottom-20 -right-20" data-speed="0.06"></div>

    <div class="relative z-[2] max-w-7xl mx-auto">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-7 mg-perspective" data-stagger="0.1">
            @forelse($routes as $route)
                <article class="mg-card mg-reveal group flex flex-col overflow-hidden">
                    <a href="{{ route('routes.show', $route->slug) }}" class="mg-photo mg-photo-tint block h-60 rounded-t-[1.75rem] rounded-b-none" aria-label="{{ $route->title }}">
                        <img src="{{ $route->image }}" alt="{{ $route->title }}" loading="lazy">
                        <div class="absolute top-4 inset-x-4 z-10 flex items-center justify-between">
                            <span class="mg-badge mg-badge-cyan">{{ $route->badge ?? '0' . $loop->iteration }}</span>
                            <span class="mg-badge">{{ $route->category }}</span>
                        </div>
                        <div class="absolute bottom-4 inset-x-4 z-10 flex items-center justify-between">
                            <span class="mg-badge"><i class="fa-regular fa-clock"></i> {{ $route->duration_text }}</span>
                            <span class="mg-badge"><i class="fa-solid fa-star text-[#38BDF8]"></i> {{ number_format($route->rating, 1) }}</span>
                        </div>
                    </a>

                    <div class="p-6 flex flex-col flex-grow text-right">
                        <h2 class="text-xl font-black text-[#164E63] mb-2 group-hover:text-[#0891B2] transition-colors">{{ $route->title }}</h2>
                        <p class="text-sm text-[#183746]/75 leading-relaxed line-clamp-2 mb-5">{{ $route->subtitle ?? $route->description }}</p>

                        @if(is_array($route->stops) && count($route->stops))
                            <div class="mb-5 p-3.5 rounded-2xl bg-[#E0F2FE]/60 border border-[#06B6D4]/15">
                                <span class="block text-[11px] font-black text-[#06B6D4] mb-2"><i class="fa-solid fa-location-dot"></i> المحطات</span>
                                <div class="flex flex-wrap items-center gap-1.5 text-[11px] font-bold text-[#164E63]">
                                    @foreach(array_slice($route->stops, 0, 3) as $st)
                                        <span class="px-2.5 py-1 rounded-full bg-white border border-[#06B6D4]/20">{{ $st['title'] ?? $st['name'] ?? '' }}</span>
                                        @if(!$loop->last)<i class="fa-solid fa-angles-left text-[#06B6D4] text-[9px]"></i>@endif
                                    @endforeach
                                    @if(count($route->stops) > 3)
                                        <span class="text-[#06B6D4]">+{{ count($route->stops) - 3 }}</span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <div class="mt-auto pt-4 border-t border-[#06B6D4]/15 flex items-center justify-between gap-3">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-[#E0F2FE] text-[#164E63] text-xs font-black">
                                <i class="fa-solid fa-gauge-high text-[#06B6D4]"></i> {{ $route->difficulty }}
                            </span>
                            <a href="{{ route('routes.show', $route->slug) }}" class="inline-flex items-center gap-2 text-[#0891B2] hover:text-[#164E63] font-black text-sm transition">
                                <span>التفاصيل</span>
                                <span class="w-8 h-8 rounded-full bg-gradient-to-br from-[#06B6D4] to-[#38BDF8] text-white flex items-center justify-center text-xs group-hover:-translate-x-1.5 transition-transform duration-300"><i class="fa-solid fa-arrow-left"></i></span>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-20 rounded-[2rem] bg-white border-2 border-dashed border-[#06B6D4]/30 mg-reveal">
                    <span class="mg-icon-tile mx-auto mb-5 mg-float-a"><i class="fa-solid fa-route"></i></span>
                    <p class="text-[#164E63] font-black text-lg">لا توجد مسارات مطابقة للفلتر المحدد.</p>
                    <a href="{{ route('routes.index') }}" class="mg-btn mt-6"><span>عرض كل المسارات</span><i class="fa-solid fa-arrow-left text-xs"></i></a>
                </div>
            @endforelse
        </div>

        <div class="mt-14">
            {{ $routes->links('vendor.pagination.mg') }}
        </div>
    </div>
</section>

@endsection
