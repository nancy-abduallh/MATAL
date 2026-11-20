@extends('layouts.app')

@section('title', 'دليل الوجهات والمعالم · مَطَلّ جازان')
@section('meta_description', 'استكشف أجمل وجهات ومعالم جازان الطبيعية والتراثية من الجبال والوديان إلى الشواطئ والجزر.')

@section('content')

@php $keep = request()->except('page'); @endphp

<x-mg.page-hero title="الوجهات والمعالم" subtitle="استكشف مواقع جازان الطبيعية والتراثية من أعاليها إلى سواحلها."
    image="/images/jazan_alreeth_viewpoint.jpg" :crumbs="['الوجهات والمعالم' => null]">
    <div class="mt-8 flex flex-wrap gap-3 mg-reveal" style="--d: .22s">
        <span class="mg-badge"><i class="fa-solid fa-location-dot text-[#38BDF8]"></i> {{ $destinations->total() }} وجهة</span>
        <span class="mg-badge"><i class="fa-solid fa-star"></i> مرتبة حسب أعلى تقييم</span>
    </div>
</x-mg.page-hero>

<section class="relative px-4 pb-24 -mt-2 overflow-hidden">
    <div class="mg-orb mg-orb-cyan w-96 h-96 top-20 -right-24" data-speed="0.08"></div>
    <div class="mg-orb mg-orb-sky w-80 h-80 bottom-20 -left-20" data-speed="0.06"></div>

    <div class="relative z-[2] max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8">

        {{-- ============ FILTER SIDEBAR ============ --}}
        <aside class="lg:col-span-3 order-1 lg:order-2">
            <details id="filterBox" class="group rounded-3xl bg-white border border-[#06B6D4]/20 shadow-xl shadow-[#164E63]/10 lg:sticky lg:top-28 overflow-hidden mg-reveal mg-reveal-left">
                <summary class="lg:hidden flex items-center justify-between p-5 font-black text-[#164E63] cursor-pointer list-none">
                    <span class="flex items-center gap-2"><i class="fa-solid fa-sliders text-[#06B6D4]"></i> تصفية الوجهات</span>
                    <i class="fa-solid fa-chevron-down text-xs transition-transform group-open:rotate-180"></i>
                </summary>

                <div class="h-1.5 hidden lg:block bg-gradient-to-r from-[#164E63] via-[#06B6D4] to-[#38BDF8]"></div>

                <div class="p-6 pt-3 lg:pt-6 space-y-6 text-right">
                    <div class="hidden lg:flex items-center justify-between pb-3 border-b border-[#06B6D4]/15">
                        <h3 class="font-black text-[#164E63] flex items-center gap-2"><i class="fa-solid fa-sliders text-[#06B6D4]"></i> تصفية الوجهات</h3>
                        <a href="{{ route('destinations.index') }}" class="text-xs font-bold text-[#0891B2] hover:text-[#164E63] transition">إعادة ضبط</a>
                    </div>

                    <form action="{{ route('destinations.index') }}" method="GET" class="space-y-6">
                        @foreach(['category', 'difficulty', 'family_only'] as $k)
                            @if(request($k))
                                <input type="hidden" name="{{ $k }}" value="{{ request($k) }}">
                            @endif
                        @endforeach

                        <div>
                            <label class="mg-label">بحث بالاسم</label>
                            <div class="relative">
                                <i class="fa-solid fa-magnifying-glass absolute right-4 top-1/2 -translate-y-1/2 text-[#06B6D4] text-sm pointer-events-none"></i>
                                <input type="text" name="q" value="{{ request('q') }}" placeholder="ابحث عن معلم..." class="mg-field !pr-11 !py-2.5 text-sm">
                            </div>
                        </div>

                        <div>
                            <label class="mg-label">النوع والتصنيف</label>
                            <div class="flex flex-wrap gap-2">
                                @foreach($categories as $cat)
                                    @php $on = request('category') == $cat->slug; @endphp
                                    <a href="{{ route('destinations.index', array_merge($keep, ['category' => $on ? null : $cat->slug])) }}"
                                       class="mg-chip !px-3.5 !py-1.5 !text-xs {{ $on ? 'is-active' : '' }}">{{ $cat->name }}</a>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label class="mg-label">مستوى الصعوبة</label>
                            <div class="grid grid-cols-3 gap-2">
                                @foreach(['سهل', 'متوسط', 'صعب'] as $lvl)
                                    @php $on = request('difficulty') == $lvl; @endphp
                                    <a href="{{ route('destinations.index', array_merge($keep, ['difficulty' => $on ? null : $lvl])) }}"
                                       class="mg-chip !justify-center !px-2 !py-2 !text-xs {{ $on ? 'is-active' : '' }}">{{ $lvl }}</a>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label class="mg-label">مناسب للعائلة</label>
                            @php $fam = (bool) request('family_only'); @endphp
                            <a href="{{ route('destinations.index', array_merge($keep, ['family_only' => $fam ? null : 1])) }}"
                               class="flex items-center justify-between gap-3 p-3 rounded-2xl border transition-all duration-300 {{ $fam ? 'bg-gradient-to-r from-[#164E63] to-[#0e3b4d] text-white border-transparent shadow-lg shadow-[#164E63]/30' : 'bg-[#F8FCFD] text-[#164E63] border-[#06B6D4]/20 hover:border-[#06B6D4]' }}">
                                <span class="flex items-center gap-2 text-xs font-bold"><i class="fa-solid fa-people-roof {{ $fam ? 'text-[#38BDF8]' : 'text-[#06B6D4]' }}"></i> نعم، مناسب للعائلات</span>
                                <span class="w-10 h-6 rounded-full p-0.5 flex {{ $fam ? 'bg-[#06B6D4] justify-start' : 'bg-[#164E63]/20 justify-end' }}"><span class="w-5 h-5 rounded-full bg-white shadow"></span></span>
                            </a>
                        </div>

                        <button type="submit" class="mg-btn w-full"><i class="fa-solid fa-filter"></i><span>تطبيق التصفية</span></button>
                    </form>
                </div>
            </details>
        </aside>

        {{-- ============ DESTINATIONS GRID ============ --}}
        <main class="lg:col-span-9 order-2 lg:order-1 min-w-0">
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 mg-perspective" data-stagger="0.08">
                @forelse($destinations as $dest)
                    <a href="{{ route('destinations.show', $dest->slug) }}" class="mg-card mg-reveal group flex flex-col overflow-hidden">
                        <div class="mg-photo mg-photo-tint h-56 rounded-t-[1.75rem] rounded-b-none">
                            <img src="{{ $dest->image }}" alt="{{ $dest->title }}" loading="lazy">
                            <span class="mg-badge absolute top-4 right-4 z-10"><i class="fa-solid fa-location-dot text-[#38BDF8]"></i> {{ $dest->region }}</span>
                            <span class="mg-badge mg-badge-cyan absolute bottom-4 left-4 z-10"><i class="fa-solid fa-star"></i> {{ number_format($dest->rating, 1) }}</span>
                        </div>
                        <div class="p-5 flex flex-col flex-grow text-right">
                            <h3 class="text-lg font-black text-[#164E63] mb-1.5 group-hover:text-[#0891B2] transition-colors">{{ $dest->title }}</h3>
                            <p class="text-sm text-[#183746]/70 leading-relaxed line-clamp-2 mb-4">{{ $dest->tagline ?? $dest->category?->name }}</p>
                            <div class="mt-auto pt-4 border-t border-[#06B6D4]/15 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-[#E0F2FE] text-[#164E63] text-[11px] font-black"><i class="fa-solid fa-gauge-high text-[#06B6D4]"></i> {{ $dest->difficulty }}</span>
                                    @if($dest->is_family_friendly)
                                        <span class="w-7 h-7 rounded-lg bg-[#E0F2FE] text-[#06B6D4] flex items-center justify-center text-xs" title="مناسب للعائلة"><i class="fa-solid fa-people-roof"></i></span>
                                    @endif
                                </div>
                                <span class="w-9 h-9 rounded-full bg-gradient-to-br from-[#06B6D4] to-[#38BDF8] text-white flex items-center justify-center text-xs shadow-md shadow-[#06B6D4]/40 group-hover:-translate-x-1.5 transition-transform duration-300"><i class="fa-solid fa-arrow-left"></i></span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-20 rounded-[2rem] bg-white border-2 border-dashed border-[#06B6D4]/30 mg-reveal">
                        <span class="mg-icon-tile mx-auto mb-5 mg-float-a"><i class="fa-solid fa-mountain-sun"></i></span>
                        <p class="text-[#164E63] font-black text-lg">لا توجد وجهات مطابقة للمعايير المحددة.</p>
                        <a href="{{ route('destinations.index') }}" class="mg-btn mt-6"><span>إعادة ضبط التصفية</span><i class="fa-solid fa-arrow-left text-xs"></i></a>
                    </div>
                @endforelse
            </div>

            <div class="mt-14">
                {{ $destinations->links('vendor.pagination.mg') }}
            </div>
        </main>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Filter panel: always open on desktop, collapsible on mobile
    document.addEventListener('DOMContentLoaded', () => {
        const box = document.getElementById('filterBox');
        if (box && window.matchMedia('(min-width: 1024px)').matches) box.open = true;
    });
</script>
@endpush
