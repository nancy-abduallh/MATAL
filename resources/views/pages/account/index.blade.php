@extends('layouts.app')

@section('title', 'حسابي · مَطَلّ جازان')

@push('styles')
<style>
    @keyframes mgFadeUp { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: none; } }
    @keyframes mgModalIn { from { opacity: 0; transform: translateY(24px) scale(.96); } to { opacity: 1; transform: none; } }
    .mg-fade-up { animation: mgFadeUp .55s cubic-bezier(.16, 1, .3, 1) both; }
    .mg-modal-in { animation: mgModalIn .45s cubic-bezier(.16, 1, .3, 1) both; }
</style>
@endpush

@section('content')

@php
    $months = ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'];
    $statusMap = [
        'confirmed' => ['مؤكد', 'bg-[#06B6D4]/15 text-[#0891B2]'],
        'pending'   => ['قيد المراجعة', 'bg-[#38BDF8]/15 text-[#0e3b4d]'],
        'completed' => ['مكتمل', 'bg-[#164E63] text-white'],
        'cancelled' => ['ملغي', 'bg-[#164E63]/10 text-[#164E63]/55'],
    ];
    $today = now()->startOfDay();
    $upcoming = $bookings->filter(fn ($b) => $b->status === 'confirmed' && $b->trip_date->copy()->startOfDay()->gte($today))->sortBy('trip_date');
    $tabs = [['trips', 'رحلاتي', 'fa-route', null], ['bookings', 'حجوزاتي', 'fa-ticket', $bookings->count()], ['saved', 'المحفوظات', 'fa-bookmark', $savedTrips->count()]];
    $openModal = $errors->has('name') || $errors->has('phone');
    $statCards = [
        ['fa-ticket', 'حجوزاتي', $bookings->count()],
        ['fa-calendar-check', 'رحلات قادمة', $upcoming->count()],
        ['fa-bookmark', 'خطط محفوظة', $savedTrips->count()],
    ];
@endphp

<x-mg.page-hero title="حسابي" subtitle="رحلاتك وحجوزاتك في مكان واحد."
    image="/images/mountain_terraces.jpg" :crumbs="['حسابي' => null]" />

{{-- ================= PROFILE CARD ================= --}}
<section class="relative z-20 max-w-6xl mx-auto px-4 -mt-12 sm:-mt-16">
    <div class="mg-card mg-reveal mg-reveal-scale bg-white/95 backdrop-blur-xl p-6 sm:p-8" data-tilt-max="3">
        <div class="flex flex-col lg:flex-row items-center lg:items-center justify-between gap-7">
            <div class="flex flex-col sm:flex-row items-center gap-6 text-center sm:text-right">
                <div class="relative shrink-0">
                    <div class="absolute -inset-2 rounded-[1.75rem] border-2 border-dashed border-[#06B6D4]/40 mg-spin-slow"></div>
                    <div class="relative w-24 h-24 rounded-3xl bg-gradient-to-br from-[#164E63] via-[#0e3b4d] to-[#06B6D4] text-white text-4xl font-black flex items-center justify-center shadow-xl shadow-[#164E63]/30 ring-4 ring-white">{{ mb_substr($user->name, 0, 1) }}</div>
                </div>
                <div>
                    <h2 class="text-2xl sm:text-3xl font-black text-[#164E63]">{{ $user->name }}</h2>
                    <div class="mt-2 flex flex-wrap items-center justify-center sm:justify-start gap-x-3 gap-y-1 text-sm text-[#183746]/70 font-semibold">
                        <span class="mg-badge mg-badge-cyan">عضو في مَطَلّ</span>
                        <span dir="ltr">{{ $user->email }}</span>
                        @if($user->phone)<span class="opacity-40">·</span><span dir="ltr">{{ $user->phone }}</span>@endif
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-5">
                <div class="grid grid-cols-3 gap-3">
                    @foreach($statCards as $s)
                        <div class="text-center rounded-2xl bg-[#E0F2FE]/60 border border-[#06B6D4]/15 px-4 py-3">
                            <i class="fa-solid {{ $s[0] }} text-[#06B6D4] text-sm"></i>
                            <div class="mg-stat-num !text-2xl mt-1"><span data-counter="{{ $s[2] }}">{{ $s[2] }}</span></div>
                            <div class="text-[10px] font-black text-[#164E63]/70 mt-0.5">{{ $s[1] }}</div>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="openProfileModal" class="mg-btn-ghost shrink-0"><i class="fa-solid fa-user-pen"></i><span>تعديل الحساب</span></button>
            </div>
        </div>
    </div>
</section>

{{-- ================= TABS ================= --}}
<section class="relative px-4 pt-10 pb-24 overflow-hidden">
    <div class="mg-orb mg-orb-cyan w-96 h-96 top-40 -left-24" data-speed="0.08"></div>
    <div class="mg-orb mg-orb-sky w-80 h-80 bottom-20 -right-20" data-speed="0.06"></div>

    <div class="relative z-[2] max-w-6xl mx-auto">
        <div class="flex gap-2 overflow-x-auto pb-2 mb-8 mg-reveal" role="tablist">
            @foreach($tabs as $i => $t)
                <button type="button" role="tab" data-tab="{{ $t[0] }}" class="account-tab mg-chip !px-5 !py-3 !text-sm shrink-0 {{ $i === 0 ? 'is-active' : '' }}">
                    <i class="fa-solid {{ $t[2] }}"></i><span>{{ $t[1] }}</span>
                    @if($t[3] !== null)<span class="mg-count">{{ $t[3] }}</span>@endif
                </button>
            @endforeach
        </div>

        {{-- ========== TAB: TRIPS ========== --}}
        <div id="accountTab-trips" data-panel class="space-y-12">
            <div>
                <h3 class="flex items-center gap-3 text-xl sm:text-2xl font-black text-[#164E63] mb-6"><span class="mg-icon-tile !w-11 !h-11 !text-base"><i class="fa-solid fa-calendar-check"></i></span> رحلاتك القادمة</h3>
                <div class="space-y-4">
                    @forelse($upcoming as $b)
                        @php
                            $d = $b->trip_date;
                            $left = (int) $today->diffInDays($d->copy()->startOfDay(), false);
                        @endphp
                        <div class="group flex flex-col sm:flex-row sm:items-center gap-5 rounded-3xl bg-white border border-[#06B6D4]/15 p-5 shadow-lg shadow-[#164E63]/5 hover:border-[#06B6D4]/50 hover:-translate-y-1 hover:shadow-xl hover:shadow-[#06B6D4]/15 transition-all duration-300">
                            <div class="w-20 shrink-0 rounded-2xl overflow-hidden bg-white text-center shadow-lg shadow-[#164E63]/15 border border-[#06B6D4]/20 group-hover:-rotate-3 transition-transform duration-300">
                                <div class="bg-gradient-to-r from-[#164E63] to-[#0e3b4d] text-[#38BDF8] text-[11px] font-black py-1.5">{{ $months[$d->month - 1] }}</div>
                                <div class="text-3xl font-black text-[#164E63] py-2 leading-none">{{ $d->day }}</div>
                            </div>
                            <div class="flex-1 min-w-0 text-right">
                                <div class="flex flex-wrap items-center gap-2 mb-1.5">
                                    <span class="mg-badge mg-badge-cyan">{{ $left <= 0 ? 'اليوم' : 'بعد ' . $left . ' يوم' }}</span>
                                    <span class="text-[11px] font-black text-[#06B6D4]" dir="ltr">{{ $b->booking_code }}</span>
                                </div>
                                <h4 class="text-lg font-black text-[#164E63] truncate">{{ $b->bookable?->title ?? 'حجز مسار سياحي' }}</h4>
                                <p class="text-xs font-bold text-[#183746]/65 mt-1">{{ $b->adults_count }} زوار · {{ number_format($b->total_price, 2) }} ر.س</p>
                            </div>
                            <div class="flex items-center gap-3 shrink-0">
                                <a href="{{ route('booking.show', $b->booking_code) }}" class="mg-btn !py-2.5 !px-5 !text-sm"><i class="fa-solid fa-ticket"></i><span>التذكرة</span></a>
                                <form action="{{ route('account.bookings.cancel', $b->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من رغبتك في إلغاء الحجز؟')">
                                    @csrf
                                    <button type="submit" class="px-4 py-2.5 rounded-xl text-xs font-black text-[#164E63]/70 border border-[#164E63]/20 hover:bg-[#164E63] hover:text-white transition">إلغاء</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-14 rounded-[2rem] bg-white border-2 border-dashed border-[#06B6D4]/30">
                            <span class="mg-icon-tile mx-auto mb-4 mg-float-a"><i class="fa-solid fa-suitcase-rolling"></i></span>
                            <p class="text-[#164E63] font-black max-w-md mx-auto leading-relaxed">لا توجد حجوزات نشطة حالياً. يمكنك تصفح المسارات وحجز تجربتك القادمة الآن!</p>
                            <a href="{{ route('routes.index') }}" class="mg-btn mt-6"><span>تصفح المسارات</span><i class="fa-solid fa-arrow-left text-xs"></i></a>
                        </div>
                    @endforelse
                </div>
            </div>

            @if($myRoutes->count())
                <div>
                    <h3 class="flex items-center gap-3 text-xl sm:text-2xl font-black text-[#164E63] mb-6"><span class="mg-icon-tile mg-icon-tile-dark !w-11 !h-11 !text-base"><i class="fa-solid fa-wand-magic-sparkles"></i></span> مسارات مقترحة لك</h3>
                    <div class="grid md:grid-cols-3 gap-6 mg-perspective" data-stagger="0.1">
                        @foreach($myRoutes as $r)
                            <a href="{{ route('routes.show', $r->slug) }}" class="mg-card mg-reveal group block overflow-hidden">
                                <div class="mg-photo mg-photo-tint h-48 rounded-t-[1.75rem] rounded-b-none">
                                    <img src="{{ $r->image }}" alt="{{ $r->title }}" loading="lazy">
                                    <span class="mg-badge mg-badge-cyan absolute top-4 right-4 z-10">مقترح</span>
                                    <span class="mg-badge absolute bottom-4 left-4 z-10"><i class="fa-regular fa-clock"></i> {{ $r->duration_text }}</span>
                                </div>
                                <div class="p-5 text-right">
                                    <h4 class="font-black text-[#164E63] text-lg mb-3 group-hover:text-[#0891B2] transition-colors">{{ $r->title }}</h4>
                                    <div class="flex items-center justify-between">
                                        <span class="px-3 py-1 rounded-lg bg-[#E0F2FE] text-[#164E63] text-xs font-black">{{ $r->difficulty }}</span>
                                        <span class="inline-flex items-center gap-2 text-[#0891B2] font-black text-sm">عرض المسار <i class="fa-solid fa-arrow-left transition group-hover:-translate-x-1.5"></i></span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        {{-- ========== TAB: BOOKINGS ========== --}}
        <div id="accountTab-bookings" data-panel class="hidden space-y-4">
            @forelse($bookings as $b)
                @php $st = $statusMap[$b->status] ?? [$b->status, 'bg-[#164E63]/10 text-[#164E63]']; @endphp
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 rounded-3xl bg-white border border-[#06B6D4]/15 p-5 shadow-lg shadow-[#164E63]/5 hover:border-[#06B6D4]/50 hover:-translate-y-0.5 transition-all duration-300">
                    <div class="text-right min-w-0">
                        <div class="flex flex-wrap items-center gap-2 mb-1.5">
                            <span class="text-xs font-black text-[#06B6D4]" dir="ltr">{{ $b->booking_code }}</span>
                            <span class="px-3 py-1 rounded-full text-[11px] font-black {{ $st[1] }}">{{ $st[0] }}</span>
                        </div>
                        <h4 class="font-black text-[#164E63] text-lg truncate">{{ $b->bookable?->title ?? 'حجز رحلة' }}</h4>
                        <div class="text-xs font-bold text-[#183746]/65 mt-1">بتاريخ: {{ $b->trip_date->format('Y-m-d') }} · الإجمالي: {{ number_format($b->total_price, 2) }} ر.س</div>
                    </div>
                    <div class="flex items-center gap-3 shrink-0">
                        <a href="{{ route('booking.show', $b->booking_code) }}" class="mg-btn-ghost !py-2.5 !px-5 !text-sm"><i class="fa-solid fa-ticket"></i><span>التذكرة</span></a>
                        @if($b->status === 'confirmed')
                            <form action="{{ route('account.bookings.cancel', $b->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من رغبتك في إلغاء الحجز؟')">
                                @csrf
                                <button type="submit" class="px-4 py-2.5 rounded-xl text-xs font-black text-[#164E63]/70 border border-[#164E63]/20 hover:bg-[#164E63] hover:text-white transition">إلغاء</button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-16 rounded-[2rem] bg-white border-2 border-dashed border-[#06B6D4]/30">
                    <span class="mg-icon-tile mx-auto mb-4 mg-float-a"><i class="fa-solid fa-ticket"></i></span>
                    <p class="text-[#164E63] font-black">لا توجد حجوزات بعد.</p>
                    <a href="{{ route('routes.index') }}" class="mg-btn mt-6"><span>ابدأ أول رحلة</span><i class="fa-solid fa-arrow-left text-xs"></i></a>
                </div>
            @endforelse
        </div>

        {{-- ========== TAB: SAVED ========== --}}
        <div id="accountTab-saved" data-panel class="hidden">
            <div class="grid md:grid-cols-2 gap-6">
                @forelse($savedTrips as $st)
                    <div class="rounded-[2rem] bg-white border border-[#06B6D4]/15 p-6 shadow-lg shadow-[#164E63]/5 hover:border-[#06B6D4]/50 hover:-translate-y-1 hover:shadow-xl hover:shadow-[#06B6D4]/15 transition-all duration-300 flex flex-col">
                        <div class="flex flex-wrap items-center justify-between gap-2 mb-4">
                            <span class="mg-badge mg-badge-cyan"><i class="fa-solid fa-wand-magic-sparkles"></i> {{ $st->days_count }} أيام · {{ $st->group_type }}</span>
                            <span class="text-[11px] font-bold text-[#183746]/55">{{ $st->created_at->diffForHumans() }}</span>
                        </div>
                        <h4 class="text-lg font-black text-[#164E63] mb-4">{{ $st->title }}</h4>
                        <div class="space-y-3 mb-6 flex-grow">
                            @if(is_array($st->itinerary_data))
                                @foreach($st->itinerary_data as $key => $d)
                                    <div class="rounded-2xl bg-[#F8FCFD] border border-[#06B6D4]/15 p-3.5">
                                        <div class="text-xs font-black text-[#0891B2] mb-1">{{ is_array($d) ? ($d['title'] ?? $key) : $key }}</div>
                                        @if(is_array($d) && isset($d['stops']) && is_array($d['stops']))
                                            <p class="text-xs leading-relaxed text-[#183746]/75">{{ implode(' ← ', array_column($d['stops'], 'title')) }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <a href="{{ route('map.index') }}" class="mg-btn-ghost !py-2.5 !text-sm self-start"><i class="fa-solid fa-map-location-dot"></i><span>عرض على الخريطة التفاعلية</span></a>
                    </div>
                @empty
                    <div class="md:col-span-2 text-center py-16 rounded-[2rem] bg-white border-2 border-dashed border-[#06B6D4]/30">
                        <span class="mg-icon-tile mx-auto mb-4 mg-float-a"><i class="fa-solid fa-bookmark"></i></span>
                        <p class="text-[#164E63] font-black max-w-md mx-auto leading-relaxed">لا توجد خطط محفوظة بعد. استخدم مخطط الرحلات الذكي بالذكاء الاصطناعي لحفظ مسارك الأول!</p>
                        <a href="{{ route('map.index') }}#aiPlanner" class="mg-btn mt-6"><i class="fa-solid fa-wand-magic-sparkles"></i><span>افتح مخطط الرحلات</span></a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

{{-- ================= EDIT PROFILE MODAL ================= --}}
<div id="editProfileModal" class="fixed inset-0 z-[70] {{ $openModal ? 'flex' : 'hidden' }} items-center justify-center p-4 bg-[#072430]/70 backdrop-blur-sm" role="dialog" aria-modal="true" aria-labelledby="profileModalTitle">
    <div class="mg-modal-in relative w-full max-w-md rounded-[2rem] p-1 bg-gradient-to-br from-[#164E63] via-[#06B6D4] to-[#38BDF8] shadow-2xl">
        <div class="rounded-[1.85rem] bg-white p-7">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <span class="mg-icon-tile !w-11 !h-11 !text-base"><i class="fa-solid fa-user-pen"></i></span>
                    <h3 id="profileModalTitle" class="text-xl font-black text-[#164E63]">تعديل بيانات الحساب</h3>
                </div>
                <button type="button" data-close-modal class="w-9 h-9 rounded-xl bg-[#E0F2FE] text-[#164E63] hover:bg-[#164E63] hover:text-white transition flex items-center justify-center" aria-label="إغلاق"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="{{ route('account.profile.update') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="mg-label" for="pf_name">الاسم الكامل</label>
                    <input id="pf_name" type="text" name="name" value="{{ old('name', $user->name) }}" required class="mg-field">
                    @error('name')<p class="mt-1.5 text-xs font-bold text-rose-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="mg-label" for="pf_phone">رقم الجوال</label>
                    <input id="pf_phone" type="tel" name="phone" value="{{ old('phone', $user->phone) }}" class="mg-field" dir="ltr" style="text-align: right;">
                    @error('phone')<p class="mt-1.5 text-xs font-bold text-rose-600">{{ $message }}</p>@enderror
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="mg-btn flex-1"><i class="fa-solid fa-check"></i><span>حفظ التغييرات</span></button>
                    <button type="button" data-close-modal class="mg-btn-ghost flex-1"><span>إلغاء</span></button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // ---------- Tabs (deep-linkable via #trips / #bookings / #saved) ----------
        const tabs = document.querySelectorAll('.account-tab');
        const panels = document.querySelectorAll('[data-panel]');
        function switchTab(name) {
            if (!document.getElementById('accountTab-' + name)) name = 'trips';
            tabs.forEach(t => t.classList.toggle('is-active', t.dataset.tab === name));
            panels.forEach(p => {
                const on = p.id === 'accountTab-' + name;
                p.classList.toggle('hidden', !on);
                if (on) { p.classList.remove('mg-fade-up'); void p.offsetWidth; p.classList.add('mg-fade-up'); }
            });
            history.replaceState(null, '', '#' + name);
        }
        tabs.forEach(t => t.addEventListener('click', () => switchTab(t.dataset.tab)));
        switchTab(location.hash.replace('#', '') || 'trips');

        // ---------- Edit profile modal ----------
        const modal = document.getElementById('editProfileModal');
        const open = () => { modal.classList.remove('hidden'); modal.classList.add('flex'); document.body.style.overflow = 'hidden'; };
        const close = () => { modal.classList.add('hidden'); modal.classList.remove('flex'); document.body.style.overflow = ''; };
        document.getElementById('openProfileModal').addEventListener('click', open);
        modal.querySelectorAll('[data-close-modal]').forEach(b => b.addEventListener('click', close));
        modal.addEventListener('click', e => { if (e.target === modal) close(); });
        document.addEventListener('keydown', e => { if (e.key === 'Escape') close(); });
        if (!modal.classList.contains('hidden')) document.body.style.overflow = 'hidden';
    });
</script>
@endpush
