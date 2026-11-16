@extends('layouts.app')

@section('title', 'الفعاليات والمهرجانات · مَطَلّ جازان')
@section('meta_description', 'تجارب موسمية تعيشها في جازان: مهرجان البن الخولاني الدولي، شتاء جازان، وموسم غوص فرسان.')

@section('content')

<!-- Hero Banner matching Events.png -->
<section class="relative py-24 bg-cover bg-center text-white" style="background-image: url('/images/farasan_islands.jpg');">
    <div class="absolute inset-0 bg-gradient-to-b from-[#164E63]/85 via-[#0e3b4d]/80 to-[#164E63]/90 backdrop-blur-sm"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <h1 class="text-4xl sm:text-6xl font-black text-white tracking-tight font-heading">
            الفعاليات والمهرجانات
        </h1>
        <p class="text-lg sm:text-xl text-sky-100 max-w-2xl mx-auto font-normal leading-relaxed">
            تجارب موسمية تعيشها في جازان بين البحر والجبل.
        </p>
    </div>
</section>

<!-- Featured Festival Highlight Card matching Events.png -->
@if($featuredEvent)
<section class="relative z-20 -mt-12 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-3xl shadow-2xl hover:shadow-cyan-500/20 border border-sky-100 overflow-hidden flex flex-col md:flex-row items-center text-right group card-shimmer transition-all duration-400">
        
        <!-- Content on Right -->
        <div class="p-8 sm:p-12 md:w-1/2 space-y-4 order-2 md:order-1">
            <span class="px-3.5 py-1 rounded-full bg-gradient-to-r from-amber-400 to-amber-500 text-slate-950 text-xs font-black shadow-sm">
                فعالية مميزة
            </span>
            <h2 class="text-2xl sm:text-3xl font-black text-[#164E63] group-hover:text-[#06B6D4] transition duration-300 font-heading">
                {{ $featuredEvent->title }}
            </h2>
            <p class="text-[#183746]/75 text-sm leading-relaxed">
                {{ $featuredEvent->description }}
            </p>
            <div class="text-xs text-[#183746]/70 font-semibold space-y-1.5">
                <div class="flex items-center gap-1.5"><i class="fa-solid fa-calendar-day text-[#06B6D4]"></i> <span>{{ $featuredEvent->date_text }}</span></div>
                <div class="flex items-center gap-1.5"><i class="fa-solid fa-location-dot text-[#06B6D4]"></i> <span>{{ $featuredEvent->location }}</span></div>
            </div>
            <div class="pt-4">
                <a href="{{ route('booking.create', ['type' => 'event', 'id' => $featuredEvent->id]) }}" class="px-8 py-3.5 rounded-2xl bg-gradient-to-r from-[#06B6D4] to-[#38BDF8] hover:from-[#0891b2] hover:to-[#0284c7] text-white font-black text-sm shadow-xl shadow-cyan-500/25 transition transform hover:scale-105 inline-block">
                    احجز مقعدك
                </a>
            </div>
        </div>

        <!-- Image on Left -->
        <div class="md:w-1/2 h-64 md:h-96 w-full order-1 md:order-2 overflow-hidden relative">
            <img src="{{ $featuredEvent->image }}" alt="{{ $featuredEvent->title }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
        </div>

    </div>
</section>
@endif

<!-- Upcoming Events Section matching Events.png -->
<section class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-right">
    
    <div class="border-b border-sky-100 pb-4 mb-12 flex items-center justify-between">
        <h3 class="text-3xl font-black text-[#164E63] font-heading">
            الفعاليات القادمة
        </h3>
        <span class="text-[#183746]/60 text-sm">مواسم وفعاليات جازان طوال العام</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($upcomingEvents as $evt)
            <div class="bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-2xl hover:shadow-cyan-500/15 border border-sky-100 hover:border-cyan-300 tilt-card card-shimmer flex flex-col group transition-all duration-400">
                <div class="relative h-60 overflow-hidden">
                    <img src="{{ $evt->image }}" alt="{{ $evt->title }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#164E63]/85 via-black/20 to-transparent"></div>
                    <div class="absolute top-4 right-4">
                        <span class="px-3.5 py-1 rounded-full bg-slate-900/60 border border-white/20 backdrop-blur-md text-white text-xs font-bold shadow-sm">
                            {{ $evt->category }}
                        </span>
                    </div>
                </div>

                <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                    <div>
                        <h4 class="text-xl font-bold text-[#164E63] group-hover:text-[#06B6D4] transition duration-300 mb-2 font-heading">
                            {{ $evt->title }}
                        </h4>
                        <div class="text-xs text-[#183746]/70 font-medium space-y-1 mb-2">
                            <div><i class="fa-solid fa-calendar-day text-[#06B6D4] ml-1"></i> {{ $evt->date_text }}</div>
                            <div><i class="fa-solid fa-location-dot text-[#06B6D4] ml-1"></i> {{ $evt->location }}</div>
                        </div>
                        <p class="text-[#183746]/70 text-xs line-clamp-2 leading-relaxed">
                            {{ $evt->description }}
                        </p>
                    </div>

                    <div class="pt-4 border-t border-sky-100 flex items-center justify-between">
                        <div class="text-xs font-bold text-[#164E63]">
                            @if($evt->price > 0)
                                {{ number_format($evt->price, 0) }} ر.س
                            @else
                                <span class="text-emerald-600 font-bold">دخول مجاني</span>
                            @endif
                        </div>
                        <a href="{{ route('booking.create', ['type' => 'event', 'id' => $evt->id]) }}" class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-[#06B6D4] to-[#38BDF8] hover:from-[#0891b2] hover:to-[#0284c7] text-white font-bold text-xs shadow-md shadow-cyan-500/20 group-hover:shadow-lg transition-all flex items-center gap-1.5">
                            <span>احجز الآن</span>
                            <i class="fa-solid fa-arrow-left text-xs card-arrow-icon"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</section>

@endsection
