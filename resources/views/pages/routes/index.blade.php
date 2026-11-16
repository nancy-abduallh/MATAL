@extends('layouts.app')

@section('title', 'المسارات السياحية · مَطَلّ جازان')
@section('meta_description', 'استكشف مسارات جازان السياحية المتكاملة: مسار الجبال، مسار البن السعودي، المسار البحري، ومسار المغامرات.')

@section('content')

<!-- Hero Banner matching Routes.png -->
<section class="relative py-24 bg-cover bg-center text-white" style="background-image: url('/images/mountain_terraces.jpg');">
    <div class="absolute inset-0 bg-gradient-to-b from-[#164E63]/85 via-[#0e3b4d]/80 to-[#164E63]/90 backdrop-blur-sm"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <h1 class="text-4xl sm:text-6xl font-black text-white tracking-tight font-heading">
            المسارات السياحية
        </h1>
        <p class="text-lg sm:text-xl text-sky-100 max-w-2xl mx-auto font-normal leading-relaxed">
            ما نوع الرحلة التي تريدها؟ ثم نبني لك مساراً كاملاً.
        </p>
    </div>
</section>

<!-- Filter Navigation Bar matching Routes.png -->
<section class="relative z-20 -mt-7 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-xl border border-sky-100 p-2.5 sm:p-3">
        <div class="flex flex-wrap items-center justify-center gap-2">
            @foreach($categories as $name => $cat)
                <a href="{{ route('routes.index', ['category' => $cat]) }}" 
                   class="px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition {{ (request('category') == $cat || (!request('category') && $cat == 'all')) ? 'bg-gradient-to-r from-[#06B6D4] to-[#38BDF8] text-white shadow-md shadow-cyan-500/25 font-bold' : 'bg-sky-50/60 text-slate-700 hover:bg-sky-100/70 hover:text-[#06B6D4]' }}">
                    {{ $name }}
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Routes Grid matching Routes.png -->
<section class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        @forelse($routes as $route)
            <div class="bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-2xl hover:shadow-cyan-500/15 border border-sky-100 hover:border-cyan-300 group tilt-card card-shimmer flex flex-col transition-all duration-400">
                
                <!-- Image & Badge -->
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ $route->image }}" alt="{{ $route->title }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#164E63]/85 via-black/20 to-transparent"></div>
                    <div class="absolute top-4 right-4 flex items-center gap-2">
                        <span class="w-9 h-9 rounded-2xl bg-gradient-to-tr from-amber-400 to-amber-300 text-slate-950 font-black text-xs flex items-center justify-center shadow-md group-hover:rotate-6 transition-transform duration-300">
                            {{ $route->badge ?? '0' . $loop->iteration }}
                        </span>
                        <span class="px-3.5 py-1 bg-slate-900/60 border border-white/20 text-white text-xs font-bold rounded-full backdrop-blur-md shadow-sm">
                            {{ $route->category }}
                        </span>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-6 flex-grow flex flex-col justify-between text-right space-y-4">
                    <div>
                        <h2 class="text-2xl font-bold text-[#164E63] group-hover:text-[#06B6D4] transition duration-300 mb-2 font-heading">
                            {{ $route->title }}
                        </h2>
                        <p class="text-[#183746]/70 text-sm leading-relaxed line-clamp-2">
                            {{ $route->subtitle ?? $route->description }}
                        </p>
                    </div>

                    <!-- Stops Waypoint Preview -->
                    @if(is_array($route->stops))
                        <div class="pt-3 border-t border-sky-100 text-xs text-[#164E63] flex items-center gap-1.5 flex-wrap">
                            <span class="font-bold text-slate-400 text-[11px]">المحطات:</span>
                            @foreach(array_slice($route->stops, 0, 3) as $st)
                                <span class="font-semibold">{{ $st['title'] ?? $st['name'] ?? '' }}</span>
                                @if(!$loop->last)
                                    <i class="fa-solid fa-arrow-left text-[9px] text-[#06B6D4]"></i>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    <!-- Card Footer: Duration, Difficulty, Rating, CTA -->
                    <div class="pt-4 border-t border-sky-100 flex items-center justify-between">
                        <div class="flex items-center gap-2 text-xs font-semibold">
                            <span class="px-2.5 py-1 bg-sky-50 text-[#164E63] rounded-lg border border-sky-100">{{ $route->duration_text }}</span>
                            <span class="px-2.5 py-1 {{ $route->difficulty == 'صعب' ? 'bg-rose-50 text-rose-700' : ($route->difficulty == 'متوسط' ? 'bg-amber-50 text-amber-700' : 'bg-emerald-50 text-emerald-700') }} rounded-lg">
                                {{ $route->difficulty }}
                            </span>
                            <span class="text-amber-500 flex items-center gap-1 font-bold group-hover:scale-105 transition">
                                <i class="fa-solid fa-star text-amber-400"></i> {{ number_format($route->rating, 1) }}
                            </span>
                        </div>
                        <a href="{{ route('routes.show', $route->slug) }}" class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-[#06B6D4] to-[#38BDF8] hover:from-[#0891b2] hover:to-[#0284c7] text-white font-bold text-xs shadow-md shadow-cyan-500/20 group-hover:shadow-lg transition-all flex items-center gap-1.5">
                            <span>التفاصيل</span>
                            <i class="fa-solid fa-arrow-left text-xs card-arrow-icon"></i>
                        </a>
                    </div>
                </div>

            </div>
        @empty
            <div class="col-span-full py-16 text-center text-slate-500">
                <i class="fa-solid fa-route text-4xl text-slate-300 mb-3"></i>
                <p>لا توجد مسارات مطابقة للفلتر المحدد.</p>
            </div>
        @endforelse

    </div>

    <!-- Pagination -->
    <div class="mt-12 flex justify-center">
        {{ $routes->links() }}
    </div>

</section>

@endsection
