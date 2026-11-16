@extends('layouts.app')

@section('title', $route->title . ' · مَطَلّ جازان')
@section('meta_description', $route->subtitle ?? $route->description)

@section('content')

<!-- Hero Header with Image Backdrop -->
<section class="relative min-h-[50vh] flex items-end pb-16 pt-24 bg-cover bg-center text-white" style="background-image: url('{{ $route->image }}');">
    <div class="absolute inset-0 bg-gradient-to-t from-[#164E63] via-[#0e3b4d]/80 to-black/30 backdrop-blur-[2px]"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-right">
        <div class="max-w-3xl space-y-4">
            <div class="flex items-center gap-3">
                <span class="w-9 h-9 rounded-2xl bg-gradient-to-tr from-amber-400 to-amber-300 text-slate-950 font-black text-sm flex items-center justify-center shadow-md">
                    {{ $route->badge ?? '01' }}
                </span>
                <span class="px-3.5 py-1 bg-white/20 backdrop-blur-md text-sky-200 text-xs font-bold rounded-full border border-white/25">
                    {{ $route->category }}
                </span>
                <span class="px-3 py-1 bg-white/10 text-white/90 text-xs font-semibold rounded-full">
                    {{ $route->duration_text }}
                </span>
                <span class="px-3 py-1 bg-white/10 text-white/90 text-xs font-semibold rounded-full">
                    مستوى {{ $route->difficulty }}
                </span>
            </div>

            <h1 class="text-4xl sm:text-6xl font-black text-white tracking-tight font-heading">
                {{ $route->title }}
            </h1>

            <p class="text-xl text-white/90 font-medium leading-relaxed">
                {{ $route->subtitle }}
            </p>

            <div class="flex items-center gap-4 text-amber-400 text-sm font-bold pt-2">
                <div class="flex items-center gap-1.5">
                    <i class="fa-solid fa-star text-amber-400"></i>
                    <span>{{ number_format($route->rating, 2) }}</span>
                    <span class="text-white/60 font-normal">({{ $route->reviews_count }} تقييم)</span>
                </div>
                <span class="text-white/30">·</span>
                <div class="text-white">
                    يبدأ من <span class="text-2xl font-black text-amber-400">{{ number_format($route->price, 0) }}</span> ر.س / للشخص
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Details Layout with Floating Booking Card -->
<section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        
        <!-- Left Column (Desktop Booking Box) -->
        <div class="lg:col-span-4 order-2 lg:order-1">
            <div class="sticky top-28 bg-white rounded-3xl p-6 sm:p-8 shadow-2xl hover:shadow-cyan-500/15 border border-sky-100 text-right space-y-6 transition-all duration-300">
                <div>
                    <span class="text-xs font-bold text-[#06B6D4] bg-cyan-50 border border-cyan-100 px-3 py-1 rounded-full">حجز فوري ومؤكد</span>
                    <h3 class="text-2xl font-black text-[#164E63] mt-3 font-heading">احجز هذا المسار</h3>
                    <p class="text-[#183746]/70 text-xs mt-1">اختر موعد رحلتك وسيتولى فريق مَطَلّ تنسيق كامل المحطات.</p>
                </div>

                <div class="p-4 rounded-2xl bg-sky-50/50 border border-sky-100 space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">سعر التذكرة الأساسية:</span>
                        <span class="font-bold text-[#164E63]">{{ number_format($route->price, 2) }} ر.س</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">المدة الزمنية:</span>
                        <span class="font-bold text-[#164E63]">{{ $route->duration_text }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">درجة الصعوبة:</span>
                        <span class="font-bold text-emerald-600">{{ $route->difficulty }}</span>
                    </div>
                </div>

                <a href="{{ route('booking.create', ['type' => 'route', 'id' => $route->id]) }}" 
                   class="w-full py-4 rounded-2xl bg-gradient-to-r from-[#06B6D4] to-[#38BDF8] hover:from-[#0891b2] hover:to-[#0284c7] text-white font-black text-center text-base shadow-xl shadow-cyan-500/25 transition transform hover:scale-[1.02] flex items-center justify-center gap-2 block">
                    <span>متابعة الحجز الآن</span>
                    <i class="fa-solid fa-arrow-left text-xs card-arrow-icon"></i>
                </a>

                <div class="text-[11px] text-slate-400 text-center space-y-1">
                    <p><i class="fa-solid fa-shield-halved text-emerald-600 ml-1"></i> ضمان أفضل تجربة وإلغاء مرن حتى 48 ساعة</p>
                    <p><i class="fa-solid fa-headset text-[#06B6D4] ml-1"></i> دعم سياحي مباشر طوال فترة المسار</p>
                </div>
            </div>
        </div>

        <!-- Right Column (Content, Timeline & Stops) -->
        <div class="lg:col-span-8 order-1 lg:order-2 space-y-12 text-right">
            
            <!-- Description -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-sky-100 space-y-4">
                <h3 class="text-2xl font-bold text-[#164E63] font-heading">عن هذا المسار</h3>
                <p class="text-[#183746]/80 leading-relaxed text-base">
                    {{ $route->description }}
                </p>
            </div>

            <!-- Route Stations Roadmap / Stops Timeline -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-sky-100 space-y-8">
                <div class="border-b border-sky-100 pb-4">
                    <h3 class="text-2xl font-bold text-[#164E63] font-heading">محطات ومراحل المسار</h3>
                    <p class="text-[#183746]/60 text-xs mt-1">تسلسل محطات الرحلة من لحظة الانطلاق وحتى محطة الختام</p>
                </div>

                <div class="space-y-6 relative">
                    <!-- Vertical Track Line -->
                    <div class="absolute top-4 bottom-4 right-6 w-0.5 bg-gradient-to-b from-[#06B6D4] to-[#38BDF8]"></div>

                    @if(is_array($route->stops))
                        @foreach($route->stops as $index => $stop)
                            <div class="relative flex items-start gap-4 pr-14 group">
                                <!-- Station Number Badge -->
                                <div class="absolute right-0 top-0 w-12 h-12 rounded-2xl bg-[#164E63] group-hover:bg-[#06B6D4] text-white font-black flex items-center justify-center text-sm shadow-md transition-all duration-300">
                                    {{ $stop['step'] ?? ($index + 1) }}
                                </div>
                                
                                <div class="bg-sky-50/40 hover:bg-white rounded-2xl p-5 border border-sky-100 hover:border-[#06B6D4] shadow-xs hover:shadow-lg hover:shadow-cyan-500/10 w-full transition-all duration-300 group card-shimmer card-3d-lift">
                                    <div class="flex items-center justify-between mb-1">
                                        <h4 class="font-bold text-[#164E63] text-lg font-heading group-hover:text-[#06B6D4] transition">{{ $stop['title'] ?? $stop['name'] ?? '' }}</h4>
                                        <span class="text-xs font-semibold text-[#06B6D4] bg-cyan-50 px-2.5 py-0.5 rounded-full border border-cyan-100">المحطة {{ $stop['step'] ?? ($index + 1) }}</span>
                                    </div>
                                    <p class="text-[#183746]/75 text-sm leading-relaxed">{{ $stop['desc'] ?? $stop['description'] ?? '' }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Highlights & Included Services -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Highlights -->
                <div class="bg-white rounded-3xl p-8 shadow-sm hover:shadow-xl hover:shadow-cyan-500/10 border border-sky-100 hover:border-cyan-200 transition-all card-shimmer card-3d-lift space-y-4">
                    <h3 class="text-xl font-bold text-[#164E63] flex items-center gap-2 font-heading">
                        <i class="fa-solid fa-sparkles text-[#06B6D4]"></i>
                        <span>أبرز ما يميز المسار</span>
                    </h3>
                    <ul class="space-y-3 text-sm text-[#183746]/80">
                        @if(is_array($route->highlights))
                            @foreach($route->highlights as $hl)
                                <li class="flex items-start gap-2.5">
                                    <i class="fa-solid fa-circle-check text-emerald-600 text-sm mt-0.5 shrink-0"></i>
                                    <span>{{ $hl }}</span>
                                </li>
                            @endforeach
                        @else
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600"></i> إطلالات بانورامية خلابة</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-emerald-600"></i> ضيافة جازانية وتذوق أكلات أصيلة</li>
                        @endif
                    </ul>
                </div>

                <!-- Included Services -->
                <div class="bg-white rounded-3xl p-8 shadow-sm hover:shadow-xl hover:shadow-cyan-500/10 border border-sky-100 hover:border-cyan-200 transition-all card-shimmer card-3d-lift space-y-4">
                    <h3 class="text-xl font-bold text-[#164E63] flex items-center gap-2 font-heading">
                        <i class="fa-solid fa-box-check text-[#06B6D4]"></i>
                        <span>الخدمات المشمولة</span>
                    </h3>
                    <ul class="space-y-3 text-sm text-[#183746]/80">
                        @if(is_array($route->included_services))
                            @foreach($route->included_services as $srv)
                                <li class="flex items-start gap-2.5">
                                    <i class="fa-solid fa-badge-check text-[#06B6D4] text-sm mt-0.5 shrink-0"></i>
                                    <span>{{ $srv }}</span>
                                </li>
                            @endforeach
                        @else
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#06B6D4]"></i> مواصلات حديثة ومريحة</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#06B6D4]"></i> مرشد سياحي محلي معتمد</li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-sky-100 space-y-6">
                <div class="flex items-center justify-between border-b border-sky-100 pb-4">
                    <div>
                        <h3 class="text-2xl font-bold text-[#164E63] font-heading">تقييمات وتجارب الزوار</h3>
                        <p class="text-[#183746]/60 text-xs mt-1">تجارب حقيقية من أشخاص شاركوا في هذا المسار</p>
                    </div>
                    <div class="text-amber-500 font-bold text-lg flex items-center gap-1">
                        <i class="fa-solid fa-star text-amber-400"></i> {{ number_format($route->rating, 1) }}
                    </div>
                </div>

                <!-- Reviews list -->
                <div class="space-y-4">
                    @forelse($route->reviews as $rev)
                        <div class="p-4 rounded-2xl bg-sky-50/50 border border-sky-100 space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-[#164E63] text-sm">{{ $rev->author_name }}</span>
                                <div class="text-amber-400 text-xs">
                                    @for($i = 0; $i < $rev->rating; $i++) <i class="fa-solid fa-star"></i> @endfor
                                </div>
                            </div>
                            <p class="text-[#183746]/75 text-xs leading-relaxed">{{ $rev->comment }}</p>
                        </div>
                    @empty
                        <p class="text-slate-500 text-sm text-center py-4">كن أول من يقيّم هذا المسار بعد استكمال رحلتك!</p>
                    @endforelse
                </div>

                <!-- Add Review Form -->
                <form action="{{ route('reviews.store') }}" method="POST" class="pt-4 border-t border-sky-100 space-y-3">
                    @csrf
                    <input type="hidden" name="tourist_route_id" value="{{ $route->id }}">
                    <h4 class="font-bold text-sm text-[#164E63] font-heading">أضف تقييمك عن المسار</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <input type="text" name="author_name" placeholder="اسمك الكامل" required class="p-2.5 rounded-xl border border-sky-100 bg-sky-50/50 focus:bg-white text-xs focus:outline-none focus:border-[#06B6D4] transition">
                        <select name="rating" class="p-2.5 rounded-xl border border-sky-100 bg-sky-50/50 focus:bg-white text-xs focus:outline-none focus:border-[#06B6D4] transition">
                            <option value="5">⭐⭐⭐⭐⭐ ممتاز (5 من 5)</option>
                            <option value="4">⭐⭐⭐⭐ جيد جداً (4 من 5)</option>
                            <option value="3">⭐⭐⭐ جيد (3 من 5)</option>
                        </select>
                    </div>
                    <textarea name="comment" rows="2" placeholder="شاركنا تفاصيل تجربتك وما أعجبك في المسار..." required class="w-full p-2.5 rounded-xl border border-sky-100 bg-sky-50/50 focus:bg-white text-xs focus:outline-none focus:border-[#06B6D4] transition"></textarea>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#06B6D4] to-[#38BDF8] hover:from-[#0891b2] hover:to-[#0284c7] text-white font-bold text-xs shadow-md shadow-cyan-500/20 transition">
                        إرسال التقييم
                    </button>
                </form>
            </div>

        </div>

    </div>
</section>

@endsection
