@extends('layouts.app')

@section('title', 'تواصل معنا · مَطَلّ جازان')
@section('meta_description', 'تواصل مع فريق مَطَلّ للاستفسارات، الشراكات السياحية، ودعم الحجوزات في جازان.')

@section('content')

<x-mg.page-hero title="تواصل معنا" subtitle="نحن هنا للإجابة على تساؤلاتكم، وتنسيق رحلاتكم الاستثنائية في ربوع جازان."
    image="/images/jazan_coastal_beach.jpg" :crumbs="['تواصل معنا' => null]">
    <div class="mt-7 mg-reveal" style="--d: .2s">
        <span class="mg-badge mg-badge-cyan"><i class="fa-solid fa-headset"></i> خدمة الزوار والشركاء</span>
    </div>
</x-mg.page-hero>

<section class="relative px-4 pb-24 -mt-2 overflow-hidden">
    <div class="mg-orb mg-orb-cyan w-96 h-96 top-20 -right-24" data-speed="0.08"></div>
    <div class="mg-orb mg-orb-sky w-80 h-80 bottom-20 -left-20" data-speed="0.06"></div>

    <div class="relative z-[2] max-w-6xl mx-auto">

        {{-- Contact cards --}}
        <div class="grid md:grid-cols-3 gap-5 -mt-16 sm:-mt-20 mb-12 mg-perspective" data-stagger="0.12">
            @foreach([
                ['fa-envelope', 'البريد الإلكتروني', 'info@matal.sa', 'mailto:info@matal.sa'],
                ['fa-phone', 'الهاتف الموحد', '920000000', 'tel:920000000'],
                ['fa-location-dot', 'المقر الرئيسي', 'مدينة جازان، الكورنيش الشمالي', null],
            ] as $c)
                <div class="mg-card mg-reveal group p-7 text-center bg-white/95 backdrop-blur-xl" data-tilt-max="9">
                    <span class="mg-icon-tile mg-pop mx-auto mb-4 {{ $loop->odd ? '' : 'mg-icon-tile-dark' }}"><i class="fa-solid {{ $c[0] }}"></i></span>
                    <h4 class="text-xs font-black text-[#06B6D4] mb-1.5">{{ $c[1] }}</h4>
                    @if($c[3])
                        <a href="{{ $c[3] }}" class="font-black text-[#164E63] text-lg hover:text-[#0891B2] transition">{{ $c[2] }}</a>
                    @else
                        <p class="font-black text-[#164E63]">{{ $c[2] }}</p>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- Form + map --}}
        <div class="grid lg:grid-cols-5 gap-7 items-start">
            <div class="lg:col-span-3 rounded-[2rem] p-1 bg-gradient-to-br from-[#164E63] via-[#06B6D4] to-[#38BDF8] shadow-2xl shadow-[#06B6D4]/20 mg-reveal mg-reveal-right">
                <div class="rounded-[1.85rem] bg-white p-7 sm:p-10">
                    <div class="flex items-center gap-4 mb-7">
                        <span class="mg-icon-tile"><i class="fa-solid fa-paper-plane"></i></span>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-black text-[#164E63]">أرسل لنا رسالة</h2>
                            <p class="text-sm text-[#183746]/70 mt-1">سنرد عليك في أقرب وقت ممكن</p>
                        </div>
                    </div>
                    <x-mg.contact-form />
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6 lg:sticky lg:top-28 mg-reveal mg-reveal-left">
                <div class="rounded-3xl p-1.5 bg-gradient-to-r from-[#164E63] via-[#06B6D4] to-[#38BDF8] shadow-2xl shadow-[#06B6D4]/20">
                    <div id="contactMap" class="isolate rounded-[1.4rem] overflow-hidden h-72 w-full bg-[#E0F2FE]"></div>
                </div>

                <div class="mg-aurora relative overflow-hidden rounded-3xl p-7 text-white shadow-xl shadow-[#164E63]/25">
                    <div class="mg-orb mg-orb-sky w-40 h-40 -top-12 -left-8"></div>
                    <div class="relative">
                        <h3 class="font-black text-lg mb-2">هل لديك سؤال سريع؟</h3>
                        <p class="text-sm text-sky-100/85 leading-relaxed mb-5">قد تجد إجابتك فوراً في الأسئلة الشائعة التي جمعها خبراء المنصة.</p>
                        <a href="{{ route('home') }}#faqSection" class="mg-btn-ghost !text-white !bg-white/10 !border-white/35 !py-2.5 !text-sm"><i class="fa-solid fa-circle-question"></i><span>الأسئلة الشائعة</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const el = document.getElementById('contactMap');
        if (!el || typeof L === 'undefined') return;
        const pos = [16.8892, 42.5511];
        const map = L.map('contactMap', { center: pos, zoom: 12, scrollWheelZoom: false });
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 18, attribution: '© OpenStreetMap' }).addTo(map);
        L.circleMarker(pos, { radius: 11, fillColor: '#06B6D4', color: '#164E63', weight: 3, opacity: 1, fillOpacity: 0.95 })
            .addTo(map).bindPopup('<b>مَطَلّ · المقر الرئيسي</b><br>جازان، الكورنيش الشمالي').openPopup();
    });
</script>
@endpush
