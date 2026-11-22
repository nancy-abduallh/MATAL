@extends('layouts.app')

@section('title', 'الخريطة السياحية ومخطط الرحلات الذكي · مَطَلّ')
@section('meta_description', 'استكشف معالم جازان عبر الخريطة التفاعلية الذكية وأنشئ خطة رحلتك المخصصة بالذكاء الاصطناعي.')

@section('content')

@php
    $mapCats = [
        ['all', 'الكل', '#ffffff'],
        ['mountains-and-viewpoints', 'الجبال', '#164E63'],
        ['coffee-and-farms', 'المزارع والبن', '#0e3b4d'],
        ['sea-and-islands', 'البحر والجزر', '#06B6D4'],
        ['adventures-and-valleys', 'الأودية', '#38BDF8'],
    ];
    $interestChips = [['الجبال', 'fa-mountain'], ['المزارع', 'fa-seedling'], ['العائلة', 'fa-people-roof'], ['البحر', 'fa-umbrella-beach']];
    $chipBase = 'mg-chip !text-xs !px-3.5 !py-2 !bg-white/10 !text-white !border-white/20 peer-checked:!bg-gradient-to-r peer-checked:!from-[#06B6D4] peer-checked:!to-[#38BDF8] peer-checked:!border-transparent peer-checked:!text-[#072430]';
@endphp

<div id="aiPlanner" class="mg-bg-dark mg-grid-pattern relative overflow-hidden pt-24 md:pt-32 pb-10 px-3 sm:px-5">
    <div class="mg-orb mg-orb-cyan w-[30rem] h-[30rem] -top-32 -right-20" data-speed="0.1"></div>
    <div class="mg-orb mg-orb-sky w-96 h-96 bottom-0 -left-24" data-speed="0.08"></div>

    <div class="relative z-[2] max-w-[96rem] mx-auto">

        <div class="text-center mb-6 sm:mb-8 mg-reveal">
            <span class="mg-eyebrow"><i class="fa-solid fa-wand-magic-sparkles"></i> الخريطة الذكية ومخطط الرحلات</span>
            <h1 class="mg-title mt-3 sm:mt-4 !text-2xl sm:!text-3xl lg:!text-4xl">استكشف جازان على الخريطة، وصمّم رحلتك في ثوانٍ</h1>
        </div>

        {{-- Mobile Panel Switcher (Native App Tabs) --}}
        <div class="lg:hidden flex items-center p-1 rounded-2xl bg-white/10 border border-white/15 mb-4 text-xs font-bold gap-1 text-white">
            <a href="#mapSection" class="flex-1 py-2.5 text-center rounded-xl bg-gradient-to-r from-[#06B6D4] to-[#38BDF8] text-[#072430] font-black shadow-sm flex items-center justify-center gap-1.5 active:scale-95 transition">
                <i class="fa-solid fa-map"></i><span>الخريطة</span>
            </a>
            <a href="#aiPlannerPanel" class="flex-1 py-2.5 text-center rounded-xl bg-white/5 hover:bg-white/10 transition flex items-center justify-center gap-1.5 active:scale-95">
                <i class="fa-solid fa-wand-magic-sparkles text-[#38BDF8]"></i><span>المخطط</span>
            </a>
            <a href="#planPanel" class="flex-1 py-2.5 text-center rounded-xl bg-white/5 hover:bg-white/10 transition flex items-center justify-center gap-1.5 active:scale-95">
                <i class="fa-solid fa-list-check text-[#38BDF8]"></i><span>الخطة</span>
            </a>
        </div>

        <div class="grid lg:grid-cols-[21rem_minmax(0,1fr)_21rem] gap-4 lg:h-[calc(100vh-15rem)] lg:min-h-[660px]">

            {{-- ============ AI PLANNER (right in RTL) ============ --}}
            <aside id="aiPlannerPanel" class="mg-card-glass rounded-3xl p-5 flex flex-col gap-4 lg:overflow-y-auto order-2 lg:order-none mg-reveal mg-reveal-left scroll-mt-24">
                <div class="flex items-center gap-3">
                    <span class="mg-icon-tile !w-11 !h-11 !text-base"><i class="fa-solid fa-wand-magic-sparkles"></i></span>
                    <div>
                        <h2 class="font-black text-lg">مخطط الرحلات الذكي</h2>
                        <p class="text-[11px] text-sky-100/75">اصنع رحلتك في ثوانٍ بحسب تفضيلاتك ووقتك.</p>
                    </div>
                </div>

                <div>
                    <label class="mg-label !text-[#38BDF8]" for="aiUserPrompt">طلبك للذكاء الاصطناعي</label>
                    <textarea id="aiUserPrompt" rows="3" class="mg-field resize-none !text-sm">لدي عائلة من 5 أشخاص، معنا أطفال، ونريد رحلة يومين في جازان، ونفضل الجبال والطبيعة والمزارع.</textarea>
                </div>

                <div>
                    <span class="mg-label !text-[#38BDF8]">اهتمامات الرحلة</span>
                    <div class="flex flex-wrap gap-2">
                        @foreach($interestChips as $k => $ic)
                            <label class="cursor-pointer">
                                <input type="checkbox" name="interest" value="{{ $ic[0] }}" class="peer sr-only" {{ $k < 3 ? 'checked' : '' }}>
                                <span class="{{ $chipBase }}"><i class="fa-solid {{ $ic[1] }} text-[11px]"></i>{{ $ic[0] === 'البحر' ? 'البحر والجزر' : $ic[0] }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="mg-label !text-[#38BDF8]" for="aiGroupSelect">المسافرون</label>
                        <select id="aiGroupSelect" class="mg-field !text-sm !py-2.5">
                            <option value="عائلة" selected>عائلة</option>
                            <option value="أصدقاء">أصدقاء</option>
                            <option value="زوجان">زوجان</option>
                            <option value="مغامرون">مغامرون</option>
                        </select>
                    </div>
                    <div>
                        <label class="mg-label !text-[#38BDF8]" for="aiDaysSelect">مدة الرحلة</label>
                        <select id="aiDaysSelect" class="mg-field !text-sm !py-2.5">
                            <option value="1">يوم واحد</option>
                            <option value="2" selected>يومان</option>
                            <option value="3">3 أيام</option>
                        </select>
                    </div>
                </div>

                {{-- AI response bubble --}}
                <div class="rounded-2xl bg-white/10 border border-white/15 p-4">
                    <div class="flex items-center gap-2 mb-2 text-xs font-black text-[#38BDF8]">
                        <span class="w-7 h-7 rounded-full bg-gradient-to-br from-[#06B6D4] to-[#38BDF8] text-white flex items-center justify-center text-[11px]"><i class="fa-solid fa-robot"></i></span>
                        مساعد مَطَلّ الذكي
                    </div>
                    <p id="aiResponseText" class="text-sm leading-relaxed text-sky-50 min-h-[3.5rem]">جهزت لك خطة من يومين تجمع المطلات البانورامية، مزارع البن الخولاني، والقرى التراثية بتسلسل مريح ومناسب للأطفال!</p>
                </div>

                <button type="button" id="generateAiPlanBtn" class="mg-btn w-full mt-auto" data-magnetic>
                    <i class="fa-solid fa-wand-magic-sparkles"></i><span>أنشئ الخطة الآن</span>
                </button>
            </aside>

            {{-- ============ MAP (center) ============ --}}
            <main id="mapSection" class="relative order-1 lg:order-none h-[30rem] lg:h-auto rounded-3xl p-1.5 bg-gradient-to-r from-[#164E63] via-[#06B6D4] to-[#38BDF8] shadow-2xl shadow-[#06B6D4]/20 mg-reveal mg-reveal-scale scroll-mt-24">
                <div class="relative h-full rounded-[1.4rem] overflow-hidden isolate bg-[#E0F2FE]">
                    <div id="fullSmartMap" class="absolute inset-0"></div>

                    {{-- Search + filters --}}
                    <div class="absolute top-3 inset-x-3 z-[1000] space-y-2">
                        <div class="flex items-center gap-2 rounded-2xl bg-white/95 backdrop-blur-xl border border-[#06B6D4]/25 shadow-xl shadow-[#072430]/20 p-1.5">
                            <i class="fa-solid fa-magnifying-glass text-[#06B6D4] mr-3 text-sm"></i>
                            <input type="text" id="mapSearchInput" placeholder="ابحث عن موقع، أو اضغط «موقعي» لعرض ما حولك (20 كم)..." class="flex-1 min-w-0 bg-transparent text-sm text-[#183746] placeholder:text-[#164E63]/50 focus:outline-none py-2">
                            <button type="button" id="locateNearMeBtn" class="mg-btn !py-2 !px-4 !text-xs !rounded-xl shrink-0"><i class="fa-solid fa-location-crosshairs"></i><span>موقعي</span></button>
                        </div>
                        <div class="flex items-center overflow-x-auto no-scrollbar gap-1.5 pb-1">
                            @foreach($mapCats as $i => $c)
                                <button type="button" data-cat="{{ $c[0] }}" class="map-cat-filter mg-chip !text-xs !px-3 !py-1.5 shadow-md shadow-[#072430]/15 {{ $i === 0 ? 'is-active' : '' }}">
                                    <span class="w-2.5 h-2.5 rounded-full border border-[#164E63]/30" style="background: {{ $c[2] }};"></span>{{ $c[1] }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Selected place card --}}
                    <div id="selectedPlaceCard" class="absolute bottom-3 inset-x-3 sm:inset-x-auto sm:right-3 sm:w-80 z-[1000] rounded-2xl overflow-hidden bg-[#072430]/90 backdrop-blur-xl border border-white/20 shadow-2xl text-white opacity-0 translate-y-6 pointer-events-none transition-all duration-500">
                        <button type="button" id="spClose" class="absolute top-2 left-2 z-10 w-7 h-7 rounded-full bg-black/40 hover:bg-black/60 text-xs flex items-center justify-center transition" aria-label="إغلاق"><i class="fa-solid fa-xmark"></i></button>
                        <div class="flex gap-3 p-3">
                            <img id="spImage" src="/images/wadi_lajab.jpg" alt="" class="w-24 h-24 rounded-xl object-cover shrink-0">
                            <div class="min-w-0 text-right flex flex-col">
                                <span id="spBadge" class="mg-badge mg-badge-cyan self-start !text-[10px]">معلم</span>
                                <h4 id="spTitle" class="font-black mt-1.5 leading-snug truncate">وادي لجب</h4>
                                <div class="text-[11px] text-sky-100/80 mt-0.5"><i class="fa-solid fa-star"></i> <span id="spRating">4.8</span> · <span id="spRegion"></span></div>
                                <a id="spLink" href="#" class="mt-auto text-[#38BDF8] hover:text-white font-black text-xs transition">عرض تفاصيل المعلم والقصة ←</a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            {{-- ============ YOUR PLAN (left in RTL) ============ --}}
            <aside id="planPanel" class="mg-card-glass rounded-3xl p-5 flex flex-col gap-4 order-3 lg:order-none lg:min-h-0 mg-reveal mg-reveal-right scroll-mt-24">
                <div class="flex items-center justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <span class="mg-icon-tile mg-icon-tile-dark !w-11 !h-11 !text-base"><i class="fa-solid fa-list-check"></i></span>
                        <h2 class="font-black text-lg">خطتك المخصصة</h2>
                    </div>
                    <span id="planDaysBadge" class="mg-badge mg-badge-cyan">2 أيام</span>
                </div>

                <div id="itineraryContainer" class="flex-1 min-h-[12rem] lg:overflow-y-auto space-y-3 pl-1">
                    <div class="rounded-2xl bg-white/10 border border-white/15 p-5 text-center text-sm text-sky-100/80">
                        <i class="fa-solid fa-spinner fa-spin text-[#38BDF8] text-xl mb-2 block"></i>جاري تجهيز خطتك...
                    </div>
                </div>

                <div class="space-y-2.5">
                    <button type="button" id="saveTripBtn" class="mg-btn-ghost w-full !text-white !bg-white/10 !border-white/30 !py-3 !text-sm">
                        <i class="fa-regular fa-bookmark"></i><span>احفظ الخطة</span>
                    </button>
                    <a href="{{ route('booking.create') }}" class="mg-btn w-full !py-3 !text-sm"><span>متابعة حجز الخطة كاملة</span><i class="fa-solid fa-arrow-left text-xs"></i></a>
                </div>
            </aside>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const $ = id => document.getElementById(id);
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const esc = s => String(s ?? '').replace(/[&<>"']/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));

        // ---------- Toast ----------
        function toast(msg, type = 'ok') {
            let box = $('mapToasts');
            if (!box) {
                box = document.createElement('div');
                box.id = 'mapToasts';
                box.className = 'fixed top-24 inset-x-4 z-[60] flex flex-col items-center gap-3 pointer-events-none';
                document.body.appendChild(box);
            }
            const t = document.createElement('div');
            t.className = 'mg-toast pointer-events-auto flex items-center gap-3 px-5 py-3.5 rounded-2xl text-white text-sm font-bold shadow-2xl border border-white/20 bg-gradient-to-r ' + (type === 'ok' ? 'from-[#164E63] to-[#06B6D4]' : 'from-rose-700 to-rose-500');
            t.innerHTML = `<i class="fa-solid ${type === 'ok' ? 'fa-circle-check' : 'fa-triangle-exclamation'}"></i><span>${esc(msg)}</span>`;
            box.appendChild(t);
            setTimeout(() => { t.classList.add('is-leaving'); setTimeout(() => t.remove(), 500); }, 4500);
        }

        // ---------- Typewriter for AI replies ----------
        let typer;
        function typeText(el, text) {
            clearInterval(typer);
            el.textContent = '';
            let i = 0;
            typer = setInterval(() => {
                el.textContent = text.slice(0, ++i);
                if (i >= text.length) clearInterval(typer);
            }, 18);
        }

        // =====================================================
        // 1. MAP
        // =====================================================
        const colors = {
            'mountains-and-viewpoints': '#164E63',
            'sea-and-islands': '#06B6D4',
            'adventures-and-valleys': '#38BDF8',
            'coffee-and-farms': '#0e3b4d'
        };
        const map = L.map('fullSmartMap', { center: [17.15, 42.85], zoom: 9, zoomControl: false });
        L.control.zoom({ position: 'bottomleft' }).addTo(map);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 18, attribution: '© OpenStreetMap | منصة مَطَلّ' }).addTo(map);

        const markersLayer = L.layerGroup().addTo(map);
        const userLayer = L.layerGroup().addTo(map);
        let points = [], currentCat = 'all', query = '', nearOrigin = null;
        const RADIUS_KM = 20;

        function distKm(a, b) {
            const R = 6371, rad = d => d * Math.PI / 180;
            const dLat = rad(b[0] - a[0]), dLng = rad(b[1] - a[1]);
            const h = Math.sin(dLat / 2) ** 2 + Math.cos(rad(a[0])) * Math.cos(rad(b[0])) * Math.sin(dLng / 2) ** 2;
            return 2 * R * Math.asin(Math.sqrt(h));
        }

        function showPlace(pt) {
            $('spTitle').textContent = pt.title;
            $('spBadge').textContent = pt.category_name;
            $('spRating').textContent = pt.rating;
            $('spRegion').textContent = pt.region;
            $('spLink').href = pt.url;
            $('spImage').src = pt.image;
            $('selectedPlaceCard').classList.remove('opacity-0', 'translate-y-6', 'pointer-events-none');
        }
        $('spClose').addEventListener('click', () => $('selectedPlaceCard').classList.add('opacity-0', 'translate-y-6', 'pointer-events-none'));

        function render(fit = false) {
            markersLayer.clearLayers();
            const q = query.trim();
            const visible = points.filter(p =>
                (currentCat === 'all' || p.category_slug === currentCat) &&
                (!q || (p.title + ' ' + p.region + ' ' + p.category_name).includes(q)) &&
                (!nearOrigin || distKm(nearOrigin, [p.lat, p.lng]) <= RADIUS_KM)
            );
            visible.forEach(pt => {
                const m = L.circleMarker([pt.lat, pt.lng], {
                    radius: 10, fillColor: colors[pt.category_slug] || '#0891B2',
                    color: '#ffffff', weight: 3, opacity: 1, fillOpacity: 0.95
                }).addTo(markersLayer);
                m.bindTooltip(pt.title, { direction: 'top', offset: [0, -8] });
                m.on('click', () => showPlace(pt));
            });
            if (fit && visible.length) map.flyToBounds(L.latLngBounds(visible.map(p => [p.lat, p.lng])).pad(0.25), { duration: 0.8 });
            return visible;
        }

        fetch('{{ route("map.points") }}')
            .then(r => r.json())
            .then(res => { if (res.status === 'success' && res.data) { points = res.data; render(); } })
            .catch(() => toast('تعذر تحميل نقاط الخريطة', 'err'));

        document.querySelectorAll('.map-cat-filter').forEach(btn => btn.addEventListener('click', () => {
            document.querySelectorAll('.map-cat-filter').forEach(b => b.classList.toggle('is-active', b === btn));
            currentCat = btn.getAttribute('data-cat');
            render(currentCat !== 'all');
        }));

        $('mapSearchInput').addEventListener('input', e => { query = e.target.value; render(); });

        // Near me (20 km)
        const locateBtn = $('locateNearMeBtn');
        function setNear(pos, usedFallback) {
            nearOrigin = pos;
            userLayer.clearLayers();
            L.circle(pos, { radius: RADIUS_KM * 1000, color: '#38BDF8', weight: 1.5, fillColor: '#06B6D4', fillOpacity: 0.08 }).addTo(userLayer);
            L.circleMarker(pos, { radius: 8, fillColor: '#ffffff', color: '#06B6D4', weight: 4, fillOpacity: 1 }).addTo(userLayer);
            const found = render(false);
            map.flyTo(pos, 11, { duration: 0.8 });
            locateBtn.innerHTML = '<i class="fa-solid fa-xmark"></i><span>إلغاء</span>';
            toast((usedFallback ? 'تعذر تحديد موقعك، تم استخدام مركز مدينة جازان. ' : '') + `وجدنا ${found.length} موقعاً خلال ${RADIUS_KM} كم`);
        }
        locateBtn.addEventListener('click', () => {
            if (nearOrigin) {
                nearOrigin = null; userLayer.clearLayers(); render();
                locateBtn.innerHTML = '<i class="fa-solid fa-location-crosshairs"></i><span>موقعي</span>';
                return;
            }
            const fallback = [16.8892, 42.5511];
            if (!navigator.geolocation) return setNear(fallback, true);
            navigator.geolocation.getCurrentPosition(
                p => setNear([p.coords.latitude, p.coords.longitude], false),
                () => setNear(fallback, true),
                { timeout: 8000 }
            );
        });

        // =====================================================
        // 2. AI PLANNER
        // =====================================================
        const iconMap = { mountain: 'fa-mountain', coffee: 'fa-mug-hot', utensils: 'fa-utensils', camera: 'fa-camera', home: 'fa-house', landmark: 'fa-landmark', 'shopping-bag': 'fa-bag-shopping', anchor: 'fa-anchor', sun: 'fa-sun', eye: 'fa-eye' };
        const genBtn = $('generateAiPlanBtn');
        const container = $('itineraryContainer');
        let currentPlan = null, currentMeta = { group_type: 'عائلة', interests: [] };

        function renderItinerary(it) {
            container.innerHTML = Object.values(it).map((day, i) => {
                const title = (day.title || '').split(':').slice(1).join(':').trim() || day.title;
                const stops = (day.stops || []).map(s => `
                    <li class="relative pr-9 pb-4 last:pb-0">
                        <span class="absolute right-0 top-0 w-7 h-7 rounded-full bg-gradient-to-br from-[#06B6D4] to-[#38BDF8] text-white text-[11px] flex items-center justify-center shadow shadow-[#06B6D4]/40"><i class="fa-solid ${iconMap[s.icon] || 'fa-location-dot'}"></i></span>
                        <div class="flex items-center justify-between gap-2 mb-0.5">
                            <span class="text-[11px] font-black text-[#38BDF8]">${esc(s.time)}</span>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-white/10 border border-white/15">${esc(s.tag)}</span>
                        </div>
                        <h5 class="font-black text-[13px] leading-snug">${esc(s.title)}</h5>
                        <p class="text-[11px] text-sky-100/70 leading-relaxed mt-0.5">${esc(s.desc)}</p>
                    </li>`).join('');
                return `
                    <details class="group rounded-2xl bg-white/10 border border-white/15 open:border-[#38BDF8]/50 transition" ${i === 0 ? 'open' : ''}>
                        <summary class="flex items-center gap-2.5 p-3.5 cursor-pointer list-none [&::-webkit-details-marker]:hidden">
                            <span class="mg-badge mg-badge-cyan shrink-0">اليوم ${esc(day.day_number)}</span>
                            <span class="flex-1 text-xs font-black leading-snug text-right">${esc(title)}</span>
                            <i class="fa-solid fa-chevron-down text-[10px] text-[#38BDF8] transition-transform group-open:rotate-180"></i>
                        </summary>
                        <div class="px-3.5 pb-4">
                            <p class="text-[11px] text-sky-100/75 leading-relaxed mb-4">${esc(day.summary)}</p>
                            <div class="relative"><div class="absolute top-2 bottom-2 right-3.5 w-px bg-gradient-to-b from-[#06B6D4] to-[#38BDF8]/20"></div><ol>${stops}</ol></div>
                        </div>
                    </details>`;
            }).join('');
        }

        async function generatePlan() {
            genBtn.disabled = true;
            genBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i><span>جاري إعداد خطتك...</span>';
            const interests = [...document.querySelectorAll('input[name="interest"]:checked')].map(c => c.value);
            const group = $('aiGroupSelect').value;
            try {
                const r = await fetch('{{ route("map.ai-plan") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrf },
                    body: JSON.stringify({ prompt: $('aiUserPrompt').value, days: parseInt($('aiDaysSelect').value), group_type: group, interests })
                });
                const res = await r.json();
                if (!r.ok || res.status !== 'success') throw new Error(res.message || 'تعذر إنشاء الخطة');
                currentPlan = res.itinerary;
                currentMeta = { group_type: group, interests };
                $('planDaysBadge').textContent = `${res.days_count} أيام`;
                renderItinerary(res.itinerary);
                typeText($('aiResponseText'), res.message);
            } catch (err) {
                toast(err.message || 'حدث خطأ غير متوقع', 'err');
                if (!currentPlan) container.innerHTML = '<div class="rounded-2xl bg-white/10 border border-white/15 p-5 text-center text-sm text-sky-100/80">تعذر تجهيز الخطة. اضغط «أنشئ الخطة الآن» للمحاولة مرة أخرى.</div>';
            } finally {
                genBtn.disabled = false;
                genBtn.innerHTML = '<i class="fa-solid fa-wand-magic-sparkles"></i><span>أنشئ الخطة الآن</span>';
            }
        }
        genBtn.addEventListener('click', generatePlan);
        generatePlan(); // build the first plan automatically so "save" always has real data

        // =====================================================
        // 3. SAVE TRIP
        // =====================================================
        const saveBtn = $('saveTripBtn');
        saveBtn.addEventListener('click', async () => {
            if (!currentPlan) return toast('أنشئ الخطة أولاً ثم احفظها', 'err');
            saveBtn.disabled = true;
            saveBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i><span>جاري الحفظ...</span>';
            try {
                const r = await fetch('{{ route("map.save-trip") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrf },
                    body: JSON.stringify({
                        title: 'رحلة جازان المخصصة بالذكاء الاصطناعي',
                        days_count: Object.keys(currentPlan).length,
                        group_type: currentMeta.group_type,
                        interests: currentMeta.interests,
                        itinerary: currentPlan
                    })
                });
                const res = await r.json();
                if (!r.ok) throw new Error(res.message || 'تعذر حفظ الخطة');
                saveBtn.innerHTML = '<i class="fa-solid fa-bookmark"></i><span>تم الحفظ!</span>';
                toast(res.message);
            } catch (err) {
                saveBtn.innerHTML = '<i class="fa-regular fa-bookmark"></i><span>احفظ الخطة</span>';
                toast(err.message, 'err');
            } finally {
                saveBtn.disabled = false;
                setTimeout(() => { saveBtn.innerHTML = '<i class="fa-regular fa-bookmark"></i><span>احفظ الخطة</span>'; }, 3000);
            }
        });
    });
</script>
@endpush
