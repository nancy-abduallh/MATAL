@extends('layouts.app')

@section('title', 'دليل الوجهات والمعالم · مَطَلّ جازان')
@section('meta_description', 'استكشف أجمل وجهات ومعالم جازان الطبيعية والتراثية من الجبال والوديان إلى الشواطئ والجزر.')

@section('content')

<!-- Hero Banner matching Destinations.png -->
<section class="relative py-24 bg-cover bg-center text-white" style="background-image: url('/images/coastal_beach.jpg');">
    <div class="absolute inset-0 bg-gradient-to-b from-[#164E63]/85 via-[#0e3b4d]/80 to-[#164E63]/90 backdrop-blur-sm"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <h1 class="text-4xl sm:text-6xl font-black text-white tracking-tight font-heading">
            الوجهات والمعالم
        </h1>
        <p class="text-lg sm:text-xl text-sky-100 max-w-2xl mx-auto font-normal leading-relaxed">
            استكشف مواقع جازان الطبيعية والتراثية من أعاليها إلى سواحلها.
        </p>
    </div>
</section>

<!-- Content with Sidebar Filter matching Destinations.png -->
<section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left Sidebar Filter (matching Destinations.png layout) -->
        <aside class="lg:col-span-3 order-1 lg:order-2">
            <div class="bg-white rounded-3xl p-6 shadow-xl border border-sky-100 text-right sticky top-28 space-y-6">
                <div class="border-b border-sky-100 pb-3 flex items-center justify-between">
                    <h3 class="font-bold text-lg text-[#164E63] font-heading">تصفية الوجهات</h3>
                    <a href="{{ route('destinations.index') }}" class="text-xs text-[#06B6D4] hover:text-[#0891b2] font-bold transition">إعادة ضبط</a>
                </div>

                <form action="{{ route('destinations.index') }}" method="GET" class="space-y-6">
                    
                    <!-- Search Input -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2">بحث بالاسم</label>
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="ابحث عن معلم..." 
                               class="w-full p-2.5 rounded-xl border border-sky-100 bg-sky-50/50 focus:bg-white text-xs focus:outline-none focus:border-[#06B6D4] transition">
                    </div>

                    <!-- Categories Filter Pills -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2.5">النوع والتصنيف</label>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach($categories as $cat)
                                <a href="{{ route('destinations.index', array_merge(request()->query(), ['category' => $cat->slug])) }}" 
                                   class="px-3 py-1.5 rounded-full text-xs font-medium transition {{ request('category') == $cat->slug ? 'bg-gradient-to-r from-[#06B6D4] to-[#38BDF8] text-white font-bold shadow-sm' : 'bg-sky-50/70 text-slate-600 hover:bg-sky-100/70' }}">
                                    {{ $cat->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Difficulty Filter -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2.5">مستوى الصعوبة</label>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('destinations.index', array_merge(request()->query(), ['difficulty' => 'سهل'])) }}"
                               class="px-3.5 py-1.5 rounded-full text-xs font-medium transition {{ request('difficulty') == 'سهل' ? 'bg-emerald-600 text-white font-bold shadow-sm' : 'bg-sky-50/70 text-slate-600 hover:bg-sky-100/70' }}">
                                سهل
                            </a>
                            <a href="{{ route('destinations.index', array_merge(request()->query(), ['difficulty' => 'متوسط'])) }}"
                               class="px-3.5 py-1.5 rounded-full text-xs font-medium transition {{ request('difficulty') == 'متوسط' ? 'bg-amber-500 text-slate-950 font-bold shadow-sm' : 'bg-sky-50/70 text-slate-600 hover:bg-sky-100/70' }}">
                                متوسط
                            </a>
                            <a href="{{ route('destinations.index', array_merge(request()->query(), ['difficulty' => 'صعب'])) }}"
                               class="px-3.5 py-1.5 rounded-full text-xs font-medium transition {{ request('difficulty') == 'صعب' ? 'bg-rose-600 text-white font-bold shadow-sm' : 'bg-sky-50/70 text-slate-600 hover:bg-sky-100/70' }}">
                                صعب
                            </a>
                        </div>
                    </div>

                    <!-- Family Friendly Filter -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2">مناسب للعائلة</label>
                        <a href="{{ route('destinations.index', array_merge(request()->query(), ['family_only' => request('family_only') ? 0 : 1])) }}"
                           class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold transition {{ request('family_only') ? 'bg-gradient-to-r from-[#06B6D4] to-[#38BDF8] text-white shadow-sm' : 'bg-sky-50/70 text-slate-600 hover:bg-sky-100/70' }}">
                            <i class="fa-solid fa-users"></i>
                            <span>نعم، مناسب للعائلات</span>
                        </a>
                    </div>

                    <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-[#06B6D4] to-[#38BDF8] hover:from-[#0891b2] hover:to-[#0284c7] text-white font-bold text-xs shadow-md shadow-cyan-500/25 transition">
                        تطبيق التصفية
                    </button>
                </form>

            </div>
        </aside>

        <!-- Right Grid of Destinations (matching Destinations.png) -->
        <main class="lg:col-span-9 order-2 lg:order-1">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                
                @forelse($destinations as $dest)
                    <a href="{{ route('destinations.show', $dest->slug) }}" class="bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-2xl hover:shadow-cyan-500/15 border border-sky-100 hover:border-cyan-300 group tilt-card card-shimmer flex flex-col text-right block transition-all duration-400">
                        
                        <!-- Image -->
                        <div class="relative h-60 overflow-hidden">
                            <img src="{{ $dest->image }}" alt="{{ $dest->title }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#164E63]/85 via-black/20 to-transparent"></div>
                            
                            <!-- Badges -->
                            <div class="absolute top-3 right-3">
                                <span class="px-3 py-1 rounded-full bg-slate-900/60 backdrop-blur-md text-white text-[11px] font-bold border border-white/20 shadow-sm">
                                    {{ $dest->region }}
                                </span>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 flex-grow flex flex-col justify-between space-y-3">
                            <div>
                                <h3 class="text-xl font-bold text-[#164E63] group-hover:text-[#06B6D4] transition duration-300 font-heading">
                                    {{ $dest->title }}
                                </h3>
                                <p class="text-[#183746]/70 text-xs mt-1">
                                    {{ $dest->tagline ?? $dest->category?->name }}
                                </p>
                            </div>

                            <!-- Footer Badges: Difficulty, Rating, Arrow -->
                            <div class="pt-3 border-t border-sky-100 flex items-center justify-between text-xs">
                                <div class="flex items-center gap-2">
                                    <span class="px-2.5 py-1 bg-sky-50 text-[#164E63] rounded-lg font-medium border border-sky-100">
                                        {{ $dest->difficulty }}
                                    </span>
                                    <span class="text-amber-500 font-bold flex items-center gap-1 group-hover:scale-105 transition">
                                        <i class="fa-solid fa-star text-amber-400"></i> {{ number_format($dest->rating, 1) }}
                                    </span>
                                </div>
                                <span class="w-8 h-8 rounded-full bg-sky-50 group-hover:bg-[#06B6D4] text-[#06B6D4] group-hover:text-white flex items-center justify-center transition-all duration-300 shadow-2xs">
                                    <i class="fa-solid fa-arrow-left text-xs card-arrow-icon"></i>
                                </span>
                            </div>
                        </div>

                    </a>
                @empty
                    <div class="col-span-full py-16 text-center text-slate-500">
                        <i class="fa-solid fa-map-location-dot text-4xl text-slate-300 mb-3"></i>
                        <p>لا توجد وجهات مطابقة للمعايير المحددة.</p>
                    </div>
                @endforelse

            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $destinations->links() }}
            </div>
        </main>

    </div>
</section>

@endsection
