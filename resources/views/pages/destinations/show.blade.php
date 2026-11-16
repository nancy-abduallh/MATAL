@extends('layouts.app')

@section('title', $destination->title . ' · مَطَلّ جازان')
@section('meta_description', $destination->description)

@section('content')

<!-- Hero Header matching Place Detail.png -->
<section class="relative min-h-[50vh] flex items-end pb-16 pt-28 bg-cover bg-center text-white" style="background-image: url('{{ $destination->image }}');">
    <div class="absolute inset-0 bg-gradient-to-t from-[#164E63] via-[#0e3b4d]/80 to-black/30 backdrop-blur-[2px]"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-right">
        <div class="max-w-2xl space-y-4">
            
            <!-- Tags pill -->
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-white/20 backdrop-blur-md border border-white/25 text-xs font-bold text-white shadow-sm">
                @if(is_array($destination->tags))
                    {{ implode(' · ', $destination->tags) }}
                @else
                    {{ $destination->tagline }}
                @endif
            </div>

            <!-- Title -->
            <h1 class="text-4xl sm:text-6xl font-black text-white tracking-tight font-heading">
                {{ $destination->title }}
            </h1>

            <!-- Rating from Place Detail.png: ★ 4.8 (256 تقييم) -->
            <div class="flex items-center gap-2 text-amber-400 text-sm font-bold pt-1">
                <i class="fa-solid fa-star"></i>
                <span class="text-white">{{ number_format($destination->rating, 1) }}</span>
                <span class="text-white/70 font-normal">({{ $destination->reviews_count }} تقييم)</span>
                <span class="text-white/40">·</span>
                <span class="text-white/80 font-medium">{{ $destination->region }}</span>
            </div>

        </div>
    </div>
</section>

<!-- Main Details Layout matching Place Detail.png -->
<section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        
        <!-- Left Column: Floating Booking Card matching Place Detail.png -->
        <div class="lg:col-span-4 order-2 lg:order-1">
            <div class="sticky top-28 bg-white rounded-3xl p-6 sm:p-8 shadow-2xl hover:shadow-cyan-500/15 border border-sky-100 text-right space-y-6 transition-all duration-300">
                <div>
                    <h3 class="text-2xl font-black text-[#164E63] font-heading">احجز تجربتك</h3>
                    <p class="text-[#183746]/70 text-xs mt-1 leading-relaxed">
                        اختر التاريخ وعدد الزوار وأضف الموقع إلى مسارك السياحي المخصص.
                    </p>
                </div>

                <form action="{{ route('booking.create') }}" method="GET" class="space-y-4">
                    <input type="hidden" name="type" value="destination">
                    <input type="hidden" name="id" value="{{ $destination->id }}">

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">التاريخ</label>
                        <input type="date" name="date" value="{{ date('Y-m-d', strtotime('+2 days')) }}" 
                               class="w-full p-3 rounded-xl border border-sky-100 text-xs focus:outline-none focus:border-[#06B6D4] bg-sky-50/50 focus:bg-white transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">عدد الزوار</label>
                        <select name="adults_count" class="w-full p-3 rounded-xl border border-sky-100 text-xs focus:outline-none focus:border-[#06B6D4] bg-sky-50/50 focus:bg-white transition">
                            <option value="1">1 زائر</option>
                            <option value="2" selected>2 زوار</option>
                            <option value="3">3 زوار</option>
                            <option value="4">4 زوار</option>
                            <option value="5">5 زوار أو أكثر</option>
                        </select>
                    </div>

                    <div class="pt-2 space-y-3">
                        <button type="submit" class="w-full py-3.5 rounded-2xl bg-gradient-to-r from-[#06B6D4] to-[#38BDF8] hover:from-[#0891b2] hover:to-[#0284c7] text-white font-black text-sm shadow-xl shadow-cyan-500/25 transition transform hover:scale-[1.02]">
                            احجز الآن
                        </button>
                        <a href="{{ route('map.index') }}" class="w-full py-3 rounded-2xl bg-transparent border-2 border-sky-200 hover:border-[#06B6D4] text-[#164E63] hover:text-[#06B6D4] font-bold text-xs text-center transition block">
                            أضف إلى مساري في الخريطة
                        </a>
                    </div>
                </form>

                <div class="text-[11px] text-slate-400 text-center border-t border-sky-100 pt-4 space-y-1">
                    <p><i class="fa-solid fa-lock text-emerald-600 ml-1"></i> حجز رقمي آمن ومعتمد</p>
                    <p><i class="fa-solid fa-cloud-sun text-amber-500 ml-1"></i> الطقس المتوقع: {{ $destination->weather_summary }}</p>
                </div>
            </div>
        </div>

        <!-- Right Column: Story, Gallery, Info Cards & Map matching Place Detail.png -->
        <div class="lg:col-span-8 order-1 lg:order-2 space-y-10 text-right">
            
            <!-- Story of the Place ("قصة المكان") -->
            <div class="space-y-4">
                <h2 class="text-2xl font-black text-[#164E63] border-b border-sky-100 pb-3 font-heading">
                    قصة المكان
                </h2>
                <p class="text-[#183746]/80 leading-relaxed text-base">
                    {{ $destination->story ?? $destination->description }}
                </p>
            </div>

            <!-- Mini Photo Gallery matching Place Detail.png -->
            <div class="grid grid-cols-3 gap-4">
                <div class="h-44 rounded-3xl overflow-hidden shadow-md hover:shadow-xl border border-sky-100 tilt-card card-shimmer group transition-all">
                    <img src="{{ $destination->image }}" alt="صورة المكان 1" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                </div>
                <div class="h-44 rounded-3xl overflow-hidden shadow-md hover:shadow-xl border border-sky-100 tilt-card card-shimmer group transition-all">
                    <img src="/images/mountain_terraces.jpg" alt="صورة المكان 2" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                </div>
                <div class="h-44 rounded-3xl overflow-hidden shadow-md hover:shadow-xl border border-sky-100 tilt-card card-shimmer group transition-all">
                    <img src="/images/detail_village.jpg" alt="صورة المكان 3" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                </div>
            </div>

            <!-- Visit Information Cards matching Place Detail.png (6 cards grid) -->
            <div class="space-y-4">
                <h3 class="text-2xl font-black text-[#164E63] border-b border-sky-100 pb-3 font-heading">
                    معلومات الزيارة
                </h3>
                
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    <!-- 1. Best Time -->
                    <div class="bg-white rounded-2xl p-4 shadow-sm hover:shadow-xl hover:shadow-cyan-500/15 border border-sky-100 hover:border-cyan-300 text-center transition-all duration-300 group card-shimmer card-3d-lift">
                        <span class="text-slate-400 text-xs font-semibold">أفضل وقت للزيارة</span>
                        <div class="font-bold text-[#164E63] text-sm mt-1 group-hover:text-[#06B6D4] transition">{{ $destination->best_time }}</div>
                    </div>
                    <!-- 2. Duration -->
                    <div class="bg-white rounded-2xl p-4 shadow-sm hover:shadow-xl hover:shadow-cyan-500/15 border border-sky-100 hover:border-cyan-300 text-center transition-all duration-300 group card-shimmer card-3d-lift">
                        <span class="text-slate-400 text-xs font-semibold">مدة الزيارة</span>
                        <div class="font-bold text-[#164E63] text-sm mt-1 group-hover:text-[#06B6D4] transition">{{ $destination->duration }}</div>
                    </div>
                    <!-- 3. Difficulty -->
                    <div class="bg-white rounded-2xl p-4 shadow-sm hover:shadow-xl hover:shadow-cyan-500/15 border border-sky-100 hover:border-cyan-300 text-center transition-all duration-300 group card-shimmer card-3d-lift">
                        <span class="text-slate-400 text-xs font-semibold">مستوى الصعوبة</span>
                        <div class="font-bold text-amber-600 text-sm mt-1">{{ $destination->difficulty }}</div>
                    </div>
                    <!-- 4. Family Friendly -->
                    <div class="bg-white rounded-2xl p-4 shadow-sm hover:shadow-xl hover:shadow-cyan-500/15 border border-sky-100 hover:border-cyan-300 text-center transition-all duration-300 group card-shimmer card-3d-lift">
                        <span class="text-slate-400 text-xs font-semibold">مناسب للعائلة</span>
                        <div class="font-bold text-emerald-600 text-sm mt-1">{{ $destination->is_family_friendly ? 'نعم' : 'للبالغين فقط' }}</div>
                    </div>
                    <!-- 5. Parking -->
                    <div class="bg-white rounded-2xl p-4 shadow-sm hover:shadow-xl hover:shadow-cyan-500/15 border border-sky-100 hover:border-cyan-300 text-center transition-all duration-300 group card-shimmer card-3d-lift">
                        <span class="text-slate-400 text-xs font-semibold">مواقف السيارات</span>
                        <div class="font-bold text-[#164E63] text-sm mt-1 group-hover:text-[#06B6D4] transition">{{ $destination->has_parking ? 'متوفرة' : 'غير متوفرة' }}</div>
                    </div>
                    <!-- 6. Road Condition -->
                    <div class="bg-white rounded-2xl p-4 shadow-sm hover:shadow-xl hover:shadow-cyan-500/15 border border-sky-100 hover:border-cyan-300 text-center transition-all duration-300 group card-shimmer card-3d-lift">
                        <span class="text-slate-400 text-xs font-semibold">حالة الطريق</span>
                        <div class="font-bold text-[#06B6D4] text-sm mt-1">{{ $destination->road_condition }}</div>
                    </div>
                </div>
            </div>

            <!-- Location on Map matching Place Detail.png -->
            <div class="space-y-4">
                <h3 class="text-2xl font-black text-[#0A3847] border-b border-slate-100 pb-3">
                    الموقع على الخريطة
                </h3>
                <div class="relative bg-white rounded-3xl overflow-hidden shadow-xl border border-slate-200 h-72">
                    <div id="placeMap" class="w-full h-full"></div>
                </div>
            </div>

            <!-- Reviews -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-200/80 space-y-6">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div>
                        <h3 class="text-2xl font-bold text-[#0A3847]">تقييمات وتجارب الزوار</h3>
                        <p class="text-slate-500 text-xs">تجارب حقيقية من أشخاص زاروا {{ $destination->title }}</p>
                    </div>
                    <div class="text-amber-500 font-bold text-lg flex items-center gap-1">
                        <i class="fa-solid fa-star"></i> {{ number_format($destination->rating, 1) }}
                    </div>
                </div>

                <div class="space-y-4">
                    @forelse($destination->reviews as $rev)
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-[#0A3847] text-sm">{{ $rev->author_name }}</span>
                                <div class="text-amber-400 text-xs">
                                    @for($i = 0; $i < $rev->rating; $i++) <i class="fa-solid fa-star"></i> @endfor
                                </div>
                            </div>
                            <p class="text-slate-600 text-xs leading-relaxed">{{ $rev->comment }}</p>
                        </div>
                    @empty
                        <p class="text-slate-500 text-sm text-center py-4">كن أول من يشارك تقييمه عن هذا المعلم الساحر!</p>
                    @endforelse
                </div>

                <!-- Add Review Form -->
                <form action="{{ route('reviews.store') }}" method="POST" class="pt-4 border-t border-slate-100 space-y-3">
                    @csrf
                    <input type="hidden" name="destination_id" value="{{ $destination->id }}">
                    <h4 class="font-bold text-sm text-[#0A3847]">أضف تجربتك عن هذا الموقع</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <input type="text" name="author_name" placeholder="اسمك الكامل" required class="p-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-amber-500">
                        <select name="rating" class="p-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-amber-500">
                            <option value="5">⭐⭐⭐⭐⭐ استثنائي (5 من 5)</option>
                            <option value="4">⭐⭐⭐⭐ ممتاز (4 من 5)</option>
                            <option value="3">⭐⭐⭐ جيد (3 من 5)</option>
                        </select>
                    </div>
                    <textarea name="comment" rows="2" placeholder="ما رأيك في الطريق والمرافق والإطلالة؟" required class="w-full p-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-amber-500"></textarea>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-[#0A3847] text-white font-bold text-xs hover:bg-teal-900 transition">
                        نشر التقييم
                    </button>
                </form>
            </div>

        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const placeLat = {{ $destination->latitude }};
        const placeLng = {{ $destination->longitude }};
        const map = L.map('placeMap', {
            center: [placeLat, placeLng],
            zoom: 12,
            scrollWheelZoom: false,
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        L.circleMarker([placeLat, placeLng], {
            radius: 10,
            fillColor: '#E59638',
            color: '#0A3847',
            weight: 3,
            opacity: 1,
            fillOpacity: 0.95
        }).addTo(map).bindPopup('<b>{{ $destination->title }}</b><br>{{ $destination->region }}').openPopup();
    });
</script>
@endpush
