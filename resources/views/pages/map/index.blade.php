@extends('layouts.app')

@section('title', 'الخريطة السياحية ومخطط الرحلات الذكي · مَطَلّ')
@section('meta_description', 'استكشف معالم جازان عبر الخريطة التفاعلية الذكية وأنشئ خطة رحلتك المخصصة بالذكاء الاصطناعي.')

@section('content')

<div class="h-[calc(100vh-80px)] min-h-[700px] flex flex-col lg:flex-row bg-[#FAF8F5] overflow-hidden" id="aiPlanner">
    
    <!-- ============================================== -->
    <!-- LEFT PANEL: "خطتك" (Itinerary Schedule) matching Smart Map.png -->
    <!-- ============================================== -->
    <aside class="w-full lg:w-80 bg-white border-l border-slate-200 p-5 flex flex-col justify-between shrink-0 shadow-lg z-20 overflow-y-auto order-3 lg:order-1 text-right">
        <div class="space-y-4">
            <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
                <h2 class="text-xl font-black text-[#0A3847] flex items-center gap-2">
                    <i class="fa-solid fa-calendar-check text-amber-500"></i>
                    <span>خطتك المخصصة</span>
                </h2>
                <span id="planDaysBadge" class="text-xs font-bold bg-amber-50 text-amber-700 px-2.5 py-0.5 rounded-full border border-amber-200">
                    2 أيام
                </span>
            </div>

            <!-- Dynamic Itinerary Container -->
            <div id="itineraryContainer" class="space-y-4">
                
                <!-- Day 1 Card -->
                <div class="bg-[#FAF8F5] rounded-2xl p-4 border border-slate-200 text-right space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-black text-amber-600 bg-amber-100/60 px-2 py-0.5 rounded">اليوم الأول</span>
                        <span class="text-[11px] text-slate-400">الجبال والمزارع</span>
                    </div>
                    <p class="text-xs font-semibold text-[#0A3847] leading-relaxed" id="day1Stops">
                        مطل جبل حبس · الغداء الشعبي · مزرعة البن الخولاني · مطل الدرب · إقامة ريفية
                    </p>
                </div>

                <!-- Day 2 Card -->
                <div class="bg-[#FAF8F5] rounded-2xl p-4 border border-slate-200 text-right space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-black text-amber-600 bg-amber-100/60 px-2 py-0.5 rounded">اليوم الثاني</span>
                        <span class="text-[11px] text-slate-400">التراث والوديان</span>
                    </div>
                    <p class="text-xs font-semibold text-[#0A3847] leading-relaxed" id="day2Stops">
                        قرية العشة التراثية · تذوق القهوة السعودية · مطعم محلي · وادي لجب · العودة
                    </p>
                </div>

            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 space-y-2">
            <button type="button" id="saveTripBtn" class="w-full py-3.5 rounded-2xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-black text-sm shadow-xl transition transform hover:scale-[1.02] flex items-center justify-center gap-2">
                <i class="fa-solid fa-bookmark"></i>
                <span>احفظ الخطة</span>
            </button>
            <a href="{{ route('booking.create') }}" class="w-full py-2.5 rounded-2xl bg-[#0A3847] hover:bg-teal-900 text-white font-bold text-xs text-center transition block">
                متابعة حجز الخطة كاملة
            </a>
        </div>
    </aside>

    <!-- ============================================== -->
    <!-- CENTER: Full Interactive Leaflet Map -->
    <!-- ============================================== -->
    <main class="flex-grow relative h-full order-1 lg:order-2">
        
        <!-- Search & Quick 20km Filter matching Smart Map.png -->
        <div class="absolute top-4 inset-x-4 sm:inset-x-8 z-10 flex flex-col sm:flex-row items-center gap-3">
            <div class="w-full max-w-lg bg-white/95 backdrop-blur-md rounded-2xl shadow-xl border border-slate-200 p-2 flex items-center gap-2">
                <i class="fa-solid fa-location-dot text-amber-500 mr-2"></i>
                <input type="text" id="mapSearchInput" placeholder="اعرض لي كل المواقع السياحية خلال 20 كم من موقعي..." 
                       class="w-full bg-transparent text-xs sm:text-sm text-slate-800 placeholder-slate-500 focus:outline-none px-2">
                <button type="button" id="locateNearMeBtn" class="px-4 py-2 rounded-xl bg-[#0A3847] hover:bg-teal-900 text-white font-bold text-xs shrink-0 transition">
                    تحديد
                </button>
            </div>
            
            <!-- Category Filter Buttons on Top of Map -->
            <div class="hidden sm:flex items-center gap-2 overflow-x-auto py-1">
                <button type="button" class="map-cat-filter px-3 py-1.5 rounded-xl bg-white/90 backdrop-blur text-xs font-bold text-slate-700 shadow border border-slate-200 hover:bg-amber-500 hover:text-slate-950 transition active" data-cat="all">الكل</button>
                <button type="button" class="map-cat-filter px-3 py-1.5 rounded-xl bg-white/90 backdrop-blur text-xs font-bold text-slate-700 shadow border border-slate-200 hover:bg-amber-500 hover:text-slate-950 transition" data-cat="mountains-and-viewpoints">الجبال</button>
                <button type="button" class="map-cat-filter px-3 py-1.5 rounded-xl bg-white/90 backdrop-blur text-xs font-bold text-slate-700 shadow border border-slate-200 hover:bg-amber-500 hover:text-slate-950 transition" data-cat="coffee-and-farms">المزارع والبن</button>
                <button type="button" class="map-cat-filter px-3 py-1.5 rounded-xl bg-white/90 backdrop-blur text-xs font-bold text-slate-700 shadow border border-slate-200 hover:bg-amber-500 hover:text-slate-950 transition" data-cat="sea-and-islands">البحر والجزر</button>
                <button type="button" class="map-cat-filter px-3 py-1.5 rounded-xl bg-white/90 backdrop-blur text-xs font-bold text-slate-700 shadow border border-slate-200 hover:bg-amber-500 hover:text-slate-950 transition" data-cat="adventures-and-valleys">الأودية</button>
            </div>
        </div>

        <!-- The Leaflet Map Canvas -->
        <div id="fullSmartMap" class="w-full h-full z-0"></div>

        <!-- Selected Place Preview Floating Card (matching Smart Map.png) -->
        <div id="selectedPlaceCard" class="absolute bottom-6 left-6 z-10 max-w-sm bg-white/95 backdrop-blur-md rounded-2xl p-4 shadow-2xl border border-slate-200 flex items-center gap-4 transition-all duration-300">
            <img id="spImage" src="/images/wadi_lajab.jpg" alt="وادي لجب" class="w-20 h-20 rounded-xl object-cover shrink-0">
            <div class="text-right">
                <span id="spBadge" class="text-[11px] font-bold text-amber-600 bg-amber-50 px-2 py-0.5 rounded">مسار المغامرات</span>
                <h4 id="spTitle" class="font-bold text-[#0A3847] text-base mt-1">وادي لجب</h4>
                <div class="text-amber-500 text-xs flex items-center gap-1 mt-0.5 font-bold">
                    <i class="fa-solid fa-star"></i> <span id="spRating">4.8</span>
                </div>
                <a id="spLink" href="{{ route('destinations.show', 'wadi-lajab-canyon') }}" class="text-xs text-teal-700 font-bold hover:underline block mt-1">
                    عرض تفاصيل المعلم والقصة ←
                </a>
            </div>
        </div>

    </main>

    <!-- ============================================== -->
    <!-- RIGHT PANEL: "مخطط الرحلات الذكي" (AI Chat / Prompt Panel) matching Smart Map.png -->
    <!-- ============================================== -->
    <aside class="w-full lg:w-96 bg-white border-r border-slate-200 p-5 flex flex-col justify-between shrink-0 shadow-lg z-20 overflow-y-auto order-2 lg:order-3 text-right">
        
        <div class="space-y-4">
            <div class="border-b border-slate-100 pb-3">
                <h2 class="text-xl font-black text-[#0A3847] flex items-center gap-2">
                    <i class="fa-solid fa-wand-magic-sparkles text-amber-500"></i>
                    <span>مخطط الرحلات الذكي</span>
                </h2>
                <p class="text-slate-500 text-xs mt-1">اصنع رحلتك في ثوانٍ بحسب تفضيلاتك ووقتك.</p>
            </div>

            <!-- User Question Prompt Bubble matching Smart Map.png -->
            <div class="p-3.5 rounded-2xl bg-slate-100 border border-slate-200 text-xs text-slate-700 leading-relaxed text-right">
                <span class="text-slate-400 font-bold text-[10px] block mb-1">طلبك للذكاء الاصطناعي:</span>
                <textarea id="aiUserPrompt" rows="3" class="w-full bg-white p-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-amber-500 font-medium">لدي عائلة من 5 أشخاص، معنا أطفال، ونريد رحلة يومين في جازان، ونفضل الجبال والطبيعة والمزارع.</textarea>
            </div>

            <!-- Filter Tags matching Smart Map.png: [الجبال] [المزارع] [العائلة] -->
            <div>
                <span class="text-xs font-bold text-slate-700 block mb-2">اهتمامات الرحلة:</span>
                <div class="flex flex-wrap gap-2">
                    <label class="cursor-pointer">
                        <input type="checkbox" name="interest" value="الجبال" checked class="peer sr-only">
                        <span class="px-3 py-1.5 rounded-full border border-slate-200 text-xs font-semibold text-slate-700 peer-checked:bg-[#0A3847] peer-checked:text-white peer-checked:border-[#0A3847] transition inline-block">الجبال</span>
                    </label>
                    <label class="cursor-pointer">
                        <input type="checkbox" name="interest" value="المزارع" checked class="peer sr-only">
                        <span class="px-3 py-1.5 rounded-full border border-slate-200 text-xs font-semibold text-slate-700 peer-checked:bg-[#0A3847] peer-checked:text-white peer-checked:border-[#0A3847] transition inline-block">المزارع</span>
                    </label>
                    <label class="cursor-pointer">
                        <input type="checkbox" name="interest" value="العائلة" checked class="peer sr-only">
                        <span class="px-3 py-1.5 rounded-full border border-slate-200 text-xs font-semibold text-slate-700 peer-checked:bg-[#0A3847] peer-checked:text-white peer-checked:border-[#0A3847] transition inline-block">العائلة</span>
                    </label>
                    <label class="cursor-pointer">
                        <input type="checkbox" name="interest" value="البحر" class="peer sr-only">
                        <span class="px-3 py-1.5 rounded-full border border-slate-200 text-xs font-semibold text-slate-700 peer-checked:bg-[#0A3847] peer-checked:text-white peer-checked:border-[#0A3847] transition inline-block">البحر والجزر</span>
                    </label>
                </div>
            </div>

            <!-- Days & Duration Selector -->
            <div>
                <span class="text-xs font-bold text-slate-700 block mb-2">مدة الرحلة:</span>
                <select id="aiDaysSelect" class="w-full p-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-amber-500 bg-slate-50 font-semibold">
                    <option value="1">يوم واحد (جولة مكثفة)</option>
                    <option value="2" selected>يومان (عطلة نهاية أسبوع مثالية)</option>
                    <option value="3">3 أيام (استكشاف كامل من القمم للجزر)</option>
                </select>
            </div>

            <!-- AI Response Message Bubble matching Smart Map.png -->
            <div id="aiResponseBubble" class="p-4 rounded-2xl bg-[#0A3847] text-white text-xs leading-relaxed text-right space-y-2 border border-white/10 shadow-md">
                <div class="flex items-center gap-1.5 text-amber-400 font-bold text-[11px]">
                    <i class="fa-solid fa-sparkles"></i>
                    <span>مساعد مَطَلّ الذكي:</span>
                </div>
                <p id="aiResponseText">
                    جهزت لك خطة من يومين تجمع المطلات البانورامية، مزارع البن الخولاني، والقرى التراثية بتسلسل مريح ومناسب للأطفال!
                </p>
            </div>

        </div>

        <div class="pt-4 border-t border-slate-100">
            <button type="button" id="generateAiPlanBtn" class="w-full py-3.5 rounded-2xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-black text-sm shadow-xl transition transform hover:scale-[1.02] flex items-center justify-center gap-2">
                <i class="fa-solid fa-wand-magic-sparkles"></i>
                <span>أنشئ الخطة الآن</span>
            </button>
        </div>

    </aside>

</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // 1. Initialize Main Leaflet Map
        const map = L.map('fullSmartMap', {
            center: [17.15, 42.85],
            zoom: 9,
            zoomControl: false,
        });
        L.control.zoom({ position: 'bottomright' }).addTo(map);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap | منصة مَطَلّ'
        }).addTo(map);

        let markersLayer = L.layerGroup().addTo(map);

        function loadMapPoints(category = 'all') {
            markersLayer.clearLayers();
            fetch(`{{ route("map.points") }}?category=${category}`)
                .then(r => r.json())
                .then(res => {
                    if (res.status === 'success' && res.data) {
                        res.data.forEach(pt => {
                            const marker = L.circleMarker([pt.lat, pt.lng], {
                                radius: 10,
                                fillColor: '#E59638',
                                color: '#0A3847',
                                weight: 3,
                                opacity: 1,
                                fillOpacity: 0.95
                            }).addTo(markersLayer);

                            marker.on('click', () => {
                                document.getElementById('spTitle').textContent = pt.title;
                                document.getElementById('spBadge').textContent = pt.category_name;
                                document.getElementById('spRating').textContent = pt.rating;
                                document.getElementById('spLink').href = pt.url;
                                document.getElementById('spImage').src = pt.image;
                            });

                            const popupHtml = `
                                <div style="direction: rtl; text-align: right; font-family: 'Cairo', sans-serif;">
                                    <h4 style="margin: 0; color: #0A3847; font-weight: bold; font-size: 14px;">${pt.title}</h4>
                                    <div style="color: #64748b; font-size: 11px; margin-top: 2px;">${pt.region} · ⭐ ${pt.rating}</div>
                                </div>
                            `;
                            marker.bindPopup(popupHtml);
                        });
                    }
                });
        }

        loadMapPoints('all');

        // Category Filter buttons
        document.querySelectorAll('.map-cat-filter').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.map-cat-filter').forEach(b => b.classList.remove('bg-amber-500', 'text-slate-950'));
                btn.classList.add('bg-amber-500', 'text-slate-950');
                const cat = btn.getAttribute('data-cat');
                loadMapPoints(cat);
            });
        });

        // 2. AI Plan Generator
        const generateBtn = document.getElementById('generateAiPlanBtn');
        const aiPrompt = document.getElementById('aiUserPrompt');
        const daysSelect = document.getElementById('aiDaysSelect');
        const responseText = document.getElementById('aiResponseText');
        const planDaysBadge = document.getElementById('planDaysBadge');
        const itineraryContainer = document.getElementById('itineraryContainer');
        let currentItineraryData = null;

        generateBtn.addEventListener('click', () => {
            generateBtn.disabled = true;
            generateBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> جاري المعالجة...';

            const interests = Array.from(document.querySelectorAll('input[name="interest"]:checked')).map(cb => cb.value);

            fetch('{{ route("map.ai-plan") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    prompt: aiPrompt.value,
                    days: parseInt(daysSelect.value),
                    interests: interests
                })
            })
            .then(r => r.json())
            .then(res => {
                generateBtn.disabled = false;
                generateBtn.innerHTML = '<i class="fa-solid fa-wand-magic-sparkles"></i> أنشئ الخطة الآن';

                if (res.status === 'success') {
                    responseText.textContent = res.message;
                    planDaysBadge.textContent = `${res.days_count} أيام`;
                    currentItineraryData = res.itinerary;

                    // Rebuild Itinerary Cards
                    itineraryContainer.innerHTML = '';
                    Object.keys(res.itinerary).forEach((key, idx) => {
                        const day = res.itinerary[key];
                        const stopsList = day.stops.map(s => s.title).join(' · ');
                        
                        const dayCard = document.createElement('div');
                        dayCard.className = 'bg-[#FAF8F5] rounded-2xl p-4 border border-slate-200 text-right space-y-2';
                        dayCard.innerHTML = `
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-black text-amber-600 bg-amber-100/60 px-2 py-0.5 rounded">اليوم ${day.day_number}</span>
                                <span class="text-[11px] text-slate-400 font-semibold">${day.title}</span>
                            </div>
                            <p class="text-xs font-semibold text-[#0A3847] leading-relaxed">
                                ${stopsList}
                            </p>
                        `;
                        itineraryContainer.appendChild(dayCard);
                    });
                }
            })
            .catch(err => {
                generateBtn.disabled = false;
                generateBtn.innerHTML = '<i class="fa-solid fa-wand-magic-sparkles"></i> أنشئ الخطة الآن';
                console.error(err);
            });
        });

        // 3. Save Trip Button
        const saveTripBtn = document.getElementById('saveTripBtn');
        saveTripBtn.addEventListener('click', () => {
            saveTripBtn.disabled = true;
            saveTripBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> جاري الحفظ...';

            fetch('{{ route("map.save-trip") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    title: 'رحلة جازان المخصصة بالذكاء الاصطناعي',
                    days_count: parseInt(daysSelect.value),
                    itinerary: currentItineraryData || {
                        day_1: ['مطل جبل حبس', 'مزرعة البن الخولاني', 'إقامة ريفية'],
                        day_2: ['قرية العشة التراثية', 'وادي لجب']
                    }
                })
            })
            .then(r => r.json())
            .then(res => {
                saveTripBtn.disabled = false;
                saveTripBtn.innerHTML = '<i class="fa-solid fa-check"></i> تم الحفظ!';
                setTimeout(() => {
                    saveTripBtn.innerHTML = '<i class="fa-solid fa-bookmark"></i> احفظ الخطة';
                }, 3000);
                alert(res.message);
            })
            .catch(err => {
                saveTripBtn.disabled = false;
                saveTripBtn.innerHTML = '<i class="fa-solid fa-bookmark"></i> احفظ الخطة';
                console.error(err);
            });
        });

        // 4. Locate Near Me button
        document.getElementById('locateNearMeBtn').addEventListener('click', () => {
            map.flyTo([17.3, 43.0], 11);
        });
    });
</script>
@endpush
