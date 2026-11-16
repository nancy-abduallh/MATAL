@extends('layouts.app')

@section('title', 'حسابي · مَطَلّ جازان')

@section('content')

<!-- Hero Header matching My Account.png -->
<section class="relative py-24 bg-cover bg-center text-white" style="background-image: url('/images/mountain_terraces.jpg');">
    <div class="absolute inset-0 bg-gradient-to-b from-[#164E63]/85 via-[#0e3b4d]/80 to-[#164E63]/90 backdrop-blur-sm"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <h1 class="text-4xl sm:text-6xl font-black text-white tracking-tight font-heading">
            حسابي
        </h1>
        <p class="text-lg sm:text-xl text-sky-100 max-w-2xl mx-auto font-normal leading-relaxed">
            رحلاتك وحجوزاتك في مكان واحد.
        </p>
    </div>
</section>

<!-- Profile Header Card matching My Account.png -->
<section class="relative z-20 -mt-12 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-3xl shadow-xl hover:shadow-cyan-500/10 border border-sky-100 p-6 sm:p-8 flex flex-col sm:flex-row items-center justify-between gap-6 text-right transition-all">
        
        <!-- Left: Edit Profile Button -->
        <div class="order-2 sm:order-1">
            <button type="button" onclick="document.getElementById('editProfileModal').classList.remove('hidden')" 
                    class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#06B6D4] to-[#38BDF8] hover:from-[#0891b2] hover:to-[#0284c7] text-white font-bold text-xs shadow-md shadow-cyan-500/25 transition">
                تعديل الحساب
            </button>
        </div>

        <!-- Right: User Avatar & Info -->
        <div class="flex items-center gap-5 order-1 sm:order-2">
            <div>
                <h2 class="text-2xl font-black text-[#164E63] font-heading">{{ $user->name }}</h2>
                <div class="text-xs text-[#183746]/70 font-semibold mt-0.5 flex items-center gap-2">
                    <span class="px-2.5 py-0.5 bg-cyan-50 text-[#06B6D4] border border-cyan-100 rounded-full font-bold">عضو في مَطَلّ</span>
                    <span>·</span>
                    <span>{{ $user->email }}</span>
                    @if($user->phone)
                        <span>·</span>
                        <span>{{ $user->phone }}</span>
                    @endif
                </div>
            </div>
            <div class="w-16 h-16 rounded-full bg-gradient-to-tr from-[#06B6D4] to-[#38BDF8] text-white font-black text-2xl flex items-center justify-center shadow-lg shrink-0">
                {{ mb_substr($user->name, 0, 1) }}
            </div>
        </div>

    </div>
</section>

<!-- Tabs Navigation matching My Account.png: [رحلاتي] [حجوزاتي] [المحفوظات] [تقييماتي] -->
<section class="py-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-center gap-2 border-b border-sky-100 pb-4 text-xs sm:text-sm font-bold">
        <button type="button" onclick="switchAccountTab('trips')" id="tabBtn-trips" class="account-tab-btn px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#06B6D4] to-[#38BDF8] text-white shadow-md shadow-cyan-500/25 transition">
            رحلاتي
        </button>
        <button type="button" onclick="switchAccountTab('bookings')" id="tabBtn-bookings" class="account-tab-btn px-5 py-2.5 rounded-xl text-slate-600 hover:bg-sky-50 transition">
            حجوزاتي ({{ $bookings->count() }})
        </button>
        <button type="button" onclick="switchAccountTab('saved')" id="tabBtn-saved" class="account-tab-btn px-5 py-2.5 rounded-xl text-slate-600 hover:bg-sky-50 transition">
            المحفوظات ({{ $savedTrips->count() }})
        </button>
    </div>
</section>

<!-- Tab 1: رحلاتي (My Trips matching My Account.png) -->
<section id="accountTab-trips" class="pb-24 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-right space-y-12">
    
    <!-- User Route Cards matching My Account.png -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Trip 1: مسار الجبال والمطلات -->
        <div class="bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-2xl hover:shadow-cyan-500/15 border border-sky-100 hover:border-cyan-300 tilt-card card-shimmer group transition-all duration-400">
            <div class="h-44 overflow-hidden relative">
                <img src="/images/mountain_terraces.jpg" alt="مسار الجبال والمطلات" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
            </div>
            <div class="p-5 space-y-3">
                <div class="flex items-center justify-between text-xs">
                    <span class="px-2.5 py-0.5 rounded-full bg-amber-50 text-amber-700 font-bold border border-amber-100">محفوظ</span>
                    <span class="text-slate-400 font-semibold">3 أيام</span>
                </div>
                <h3 class="font-bold text-[#164E63] group-hover:text-[#06B6D4] transition text-lg font-heading">مسار الجبال والمطلات</h3>
                <div class="pt-2 border-t border-sky-100 flex items-center justify-between text-xs">
                    <span class="px-2.5 py-0.5 bg-sky-50 text-[#164E63] rounded-lg">متوسط</span>
                    <a href="{{ route('routes.show', 'mountains-viewpoints-route') }}" class="text-[#06B6D4] font-bold hover:underline flex items-center gap-1">
                        <span>عرض المسار</span>
                        <i class="fa-solid fa-arrow-left text-[10px] card-arrow-icon"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Trip 2: المسار البحري -->
        <div class="bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-2xl hover:shadow-cyan-500/15 border border-sky-100 hover:border-cyan-300 tilt-card card-shimmer group transition-all duration-400">
            <div class="h-44 overflow-hidden relative">
                <img src="/images/farasan_islands.jpg" alt="المسار البحري" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
            </div>
            <div class="p-5 space-y-3">
                <div class="flex items-center justify-between text-xs">
                    <span class="px-2.5 py-0.5 rounded-full bg-cyan-50 text-[#06B6D4] font-bold border border-cyan-100">قيد التخطيط</span>
                    <span class="text-slate-400 font-semibold">يومان</span>
                </div>
                <h3 class="font-bold text-[#164E63] group-hover:text-[#06B6D4] transition text-lg font-heading">المسار البحري</h3>
                <div class="pt-2 border-t border-sky-100 flex items-center justify-between text-xs">
                    <span class="px-2.5 py-0.5 bg-sky-50 text-[#164E63] rounded-lg">سهل</span>
                    <a href="{{ route('routes.show', 'farasan-marine-route') }}" class="text-[#06B6D4] font-bold hover:underline flex items-center gap-1">
                        <span>عرض المسار</span>
                        <i class="fa-solid fa-arrow-left text-[10px] card-arrow-icon"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Trip 3: مسار المغامرات -->
        <div class="bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-2xl hover:shadow-cyan-500/15 border border-sky-100 hover:border-cyan-300 tilt-card card-shimmer group transition-all duration-400">
            <div class="h-44 overflow-hidden relative">
                <img src="/images/wadi_lajab.jpg" alt="مسار المغامرات" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
            </div>
            <div class="p-5 space-y-3">
                <div class="flex items-center justify-between text-xs">
                    <span class="px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 font-bold border border-emerald-100">مكتمل</span>
                    <span class="text-slate-400 font-semibold">يوم</span>
                </div>
                <h3 class="font-bold text-[#164E63] group-hover:text-[#06B6D4] transition text-lg font-heading">مسار المغامرات</h3>
                <div class="pt-2 border-t border-sky-100 flex items-center justify-between text-xs">
                    <span class="px-2.5 py-0.5 bg-rose-50 text-rose-700 rounded-lg">صعب</span>
                    <a href="{{ route('routes.show', 'wadi-lajab-adventure-route') }}" class="text-[#06B6D4] font-bold hover:underline flex items-center gap-1">
                        <span>عرض المسار</span>
                        <i class="fa-solid fa-arrow-left text-[10px] card-arrow-icon"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!-- حجوزاتي القادمة Section matching My Account.png -->
    <div class="space-y-6">
        <h3 class="text-2xl font-black text-[#164E63] border-b border-sky-100 pb-3 font-heading">
            حجوزاتي القادمة
        </h3>

        <div class="space-y-4">
            @forelse($bookings as $b)
                <div class="bg-white rounded-3xl p-6 shadow-sm hover:shadow-xl hover:shadow-cyan-500/10 border border-sky-100 hover:border-cyan-200 flex flex-col sm:flex-row items-center justify-between gap-4 card-shimmer transition-all duration-300">
                    <div class="space-y-1 text-right w-full sm:w-auto">
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-lg text-[#164E63] font-heading">{{ $b->bookable?->title ?? 'حجز مسار سياحي' }}</span>
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $b->status == 'confirmed' ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                {{ $b->status == 'confirmed' ? 'مؤكد' : 'ملغي' }}
                            </span>
                        </div>
                        <div class="text-xs text-[#183746]/70 font-semibold">
                            <span>التاريخ: {{ $b->trip_date->format('Y-m-d') }}</span>
                            <span>·</span>
                            <span>عدد الزوار: {{ $b->adults_count }}</span>
                            <span>·</span>
                            <span class="text-emerald-600 font-bold">المبلغ: {{ number_format($b->total_price, 2) }} ر.س</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                        <a href="{{ route('booking.show', $b->booking_code) }}" class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-[#06B6D4] to-[#38BDF8] hover:from-[#0891b2] hover:to-[#0284c7] text-white font-bold text-xs shadow-md shadow-cyan-500/20 transition flex items-center gap-1.5">
                            <span>عرض التذكرة والـ QR</span>
                            <i class="fa-solid fa-arrow-left text-xs card-arrow-icon"></i>
                        </a>
                        @if($b->status == 'confirmed')
                            <form action="{{ route('account.bookings.cancel', $b->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من رغبتك في إلغاء الحجز؟')">
                                @csrf
                                <button type="submit" class="px-3 py-2 rounded-xl bg-rose-50 text-rose-600 hover:bg-rose-100 font-bold text-xs transition">
                                    إلغاء
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-3xl p-8 text-center text-slate-500 border border-sky-100">
                    <i class="fa-solid fa-ticket text-3xl text-slate-300 mb-2"></i>
                    <p>لا توجد حجوزات نشطة حالياً. يمكنك تصفح المسارات وحجز تجربتك القادمة الآن!</p>
                </div>
            @endforelse
        </div>
    </div>

</section>

<!-- Tab 2: حجوزاتي (Detailed List) -->
<section id="accountTab-bookings" class="pb-24 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-right hidden space-y-4">
    @foreach($bookings as $b)
        <div class="bg-white rounded-3xl p-6 shadow-sm hover:shadow-xl hover:shadow-cyan-500/10 border border-sky-100 flex items-center justify-between card-shimmer transition-all duration-300">
            <div class="space-y-1">
                <div class="font-mono text-xs font-bold text-[#06B6D4]">{{ $b->booking_code }}</div>
                <h4 class="font-bold text-lg text-[#164E63] font-heading">{{ $b->bookable?->title ?? 'حجز رحلة' }}</h4>
                <div class="text-xs text-[#183746]/70">بتاريخ: {{ $b->trip_date->format('Y-m-d') }} · الإجمالي: {{ number_format($b->total_price, 2) }} ر.س</div>
            </div>
            <a href="{{ route('booking.show', $b->booking_code) }}" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#06B6D4] to-[#38BDF8] hover:from-[#0891b2] hover:to-[#0284c7] text-white font-bold text-xs shadow-md shadow-cyan-500/20 transition">
                التذكرة
            </a>
        </div>
    @endforeach
</section>

<!-- Tab 3: المحفوظات (Saved Trips by AI) -->
<section id="accountTab-saved" class="pb-24 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-right hidden space-y-4">
    @forelse($savedTrips as $st)
        <div class="bg-white rounded-3xl p-6 shadow-sm hover:shadow-xl hover:shadow-cyan-500/10 border border-sky-100 space-y-3 card-shimmer transition-all duration-300">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-[#06B6D4] bg-cyan-50 border border-cyan-100 px-3 py-1 rounded-full">{{ $st->days_count }} أيام · {{ $st->group_type }}</span>
                <span class="text-xs text-slate-400">{{ $st->created_at->diffForHumans() }}</span>
            </div>
            <h4 class="font-bold text-xl text-[#164E63] font-heading">{{ $st->title }}</h4>
            <div class="text-xs text-slate-600 bg-sky-50/50 border border-sky-100 p-3 rounded-2xl">
                @if(is_array($st->itinerary_data))
                    @foreach($st->itinerary_data as $key => $d)
                        <div class="py-1">
                            <strong class="text-[#164E63]">{{ $d['title'] ?? $key }}:</strong>
                            @if(isset($d['stops']) && is_array($d['stops']))
                                <span>{{ implode(' ← ', array_column($d['stops'], 'title')) }}</span>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="pt-2">
                <a href="{{ route('map.index') }}" class="text-xs font-bold text-[#06B6D4] hover:underline">
                    عرض على الخريطة التفاعلية ←
                </a>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-3xl p-8 text-center text-slate-500 border border-sky-100">
            <p>لا توجد خطط محفوظة بعد. استخدم مخطط الرحلات الذكي بالذكاء الاصطناعي لحفظ مسارك الأول!</p>
        </div>
    @endforelse
</section>

<!-- Edit Profile Modal Dialog -->
<div id="editProfileModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-3xl p-8 max-w-md w-full text-right shadow-2xl space-y-6 border border-sky-100">
        <div class="flex items-center justify-between border-b border-sky-100 pb-3">
            <h3 class="font-black text-xl text-[#164E63] font-heading">تعديل بيانات الحساب</h3>
            <button type="button" onclick="document.getElementById('editProfileModal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <form action="{{ route('account.profile.update') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">الاسم الكامل</label>
                <input type="text" name="name" value="{{ $user->name }}" required class="w-full p-3 rounded-xl border border-sky-100 bg-sky-50/50 focus:bg-white text-xs focus:outline-none focus:border-[#06B6D4] transition">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">رقم الجوال</label>
                <input type="tel" name="phone" value="{{ $user->phone }}" class="w-full p-3 rounded-xl border border-sky-100 bg-sky-50/50 focus:bg-white text-xs focus:outline-none focus:border-[#06B6D4] transition">
            </div>
            <div class="pt-2 flex items-center gap-3">
                <button type="submit" class="flex-grow py-3 rounded-xl bg-gradient-to-r from-[#06B6D4] to-[#38BDF8] hover:from-[#0891b2] hover:to-[#0284c7] text-white font-black text-xs shadow-md shadow-cyan-500/20 transition">
                    حفظ التغييرات
                </button>
                <button type="button" onclick="document.getElementById('editProfileModal').classList.add('hidden')" class="px-5 py-3 rounded-xl bg-sky-50 text-[#164E63] font-bold text-xs hover:bg-sky-100 transition">
                    إلغاء
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function switchAccountTab(tabName) {
        document.querySelectorAll('.account-tab-btn').forEach(btn => {
            btn.className = 'account-tab-btn px-5 py-2.5 rounded-xl text-slate-600 hover:bg-sky-50 transition';
        });
        document.getElementById(`tabBtn-${tabName}`).className = 'account-tab-btn px-5 py-2.5 rounded-xl bg-[#0A3847] text-white shadow transition';

        document.getElementById('accountTab-trips').classList.add('hidden');
        document.getElementById('accountTab-bookings').classList.add('hidden');
        document.getElementById('accountTab-saved').classList.add('hidden');

        document.getElementById(`accountTab-${tabName}`).classList.remove('hidden');
    }
</script>
@endpush
