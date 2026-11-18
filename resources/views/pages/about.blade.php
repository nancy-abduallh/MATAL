@extends('layouts.app')

@section('title', 'من نحن وتواصل معنا · مَطَلّ جازان')
@section('meta_description', 'تعرف على رؤية ورسالة منصة مَطَلّ الرقمية لاكتشاف مقومات جازان السياحية، وشبكة الشركاء المعتمدين.')

@section('content')

@php
    $pillars = [
        ['n' => '01', 'icon' => 'fa-eye', 'title' => 'الرؤية',
         'text' => 'أن يصبح تطبيق «مَطَلّ» المنصة الرقمية الأولى لاكتشاف التجارب والمسارات السياحية الأصيلة في منطقة جازان، وربط السائح بالمكان والمجتمع المحلي ومقدمي الخدمات السياحية بكفاءة واستدامة.'],
        ['n' => '02', 'icon' => 'fa-bullseye', 'title' => 'الرسالة',
         'text' => 'تقديم تجربة سياحية رقمية سهلة وآمنة وموثوقة، تساعد الزائر على: اكتشاف جازان، التخطيط لرحلته، حجز تجاربه، والتنقل بين مساراتها السياحية مع دعم المشاريع المحلية وتحقيق الاستدامة الاقتصادية.'],
    ];
    $steps = [
        ['fa-compass', 'اكتشف جازان'],
        ['fa-calendar-days', 'خطط لرحلتك'],
        ['fa-ticket', 'احجز تجاربك'],
        ['fa-route', 'تنقّل بين المسارات'],
    ];
    $partnerIcons = ['fa-landmark', 'fa-bullhorn', 'fa-crown', 'fa-city', 'fa-monument', 'fa-handshake-angle', 'fa-store', 'fa-seedling', 'fa-user-tie', 'fa-ship', 'fa-hands-holding'];
    $half = (int) ceil(count($partners) / 2);
    $rowA = array_slice($partners, 0, $half, true);
    $rowB = array_slice($partners, $half, null, true);
@endphp

{{-- ================= HERO ================= --}}
<x-mg.page-hero title="من نحن" subtitle="منصة رقمية لاكتشاف جازان من أعاليها إلى سواحلها."
    image="/images/mountain_terraces.jpg" :crumbs="['من نحن' => null]">
    <div class="mt-8 flex flex-wrap gap-3 mg-reveal" style="--d: .22s">
        <a href="#contact" class="mg-btn" data-magnetic><span>تواصل معنا</span><i class="fa-solid fa-arrow-left text-xs"></i></a>
        <a href="{{ route('routes.index') }}" class="mg-btn-ghost !text-white !bg-white/10 !border-white/35"><i class="fa-solid fa-route"></i><span>استكشف المسارات</span></a>
    </div>
</x-mg.page-hero>

{{-- ================= VISION & MISSION ================= --}}
<section class="mg-section mg-bg-dark mg-grid-pattern">
    <div class="mg-orb mg-orb-cyan w-[30rem] h-[30rem] -top-32 -right-20" data-speed="0.1"></div>
    <div class="mg-orb mg-orb-sky w-96 h-96 bottom-0 -left-24" data-speed="0.08"></div>
    <div class="mg-wrap">
        <x-mg.section-head eyebrow="هويتنا وتوجهنا" icon="fa-compass" title="رؤيتنا ورسالتنا"
            text="البوصلة التي تقود تجربة السياحة الرقمية المستدامة في جازان" />

        <div class="grid lg:grid-cols-2 gap-7 mg-perspective" data-stagger="0.15">
            @foreach($pillars as $p)
                <div class="mg-card mg-card-glass mg-reveal group p-8 sm:p-10 overflow-hidden" data-tilt-max="6">
                    <span class="mg-outline-num absolute -top-3 left-6 text-[8rem] pointer-events-none select-none">{{ $p['n'] }}</span>
                    <div class="mg-icon-tile mg-pop !w-16 !h-16 !text-2xl mb-6"><i class="fa-solid {{ $p['icon'] }}"></i></div>
                    <h3 class="text-2xl sm:text-3xl font-black mb-4">{{ $p['title'] }}</h3>
                    <p class="text-sky-100/85 leading-loose">{{ $p['text'] }}</p>
                    <div class="absolute bottom-0 inset-x-0 h-1 bg-gradient-to-r from-[#164E63] via-[#06B6D4] to-[#38BDF8]"></div>
                </div>
            @endforeach
        </div>

        {{-- Journey steps taken from the mission statement --}}
        <div class="mt-14 grid grid-cols-2 lg:grid-cols-4 gap-4 relative" data-stagger="0.12">
            @foreach($steps as $i => $s)
                <div class="mg-reveal relative text-center p-5 rounded-3xl bg-white/5 border border-white/15 backdrop-blur hover:bg-white/10 hover:-translate-y-1.5 hover:border-[#38BDF8]/60 transition-all duration-300">
                    <span class="mg-icon-tile mx-auto mb-3"><i class="fa-solid {{ $s[0] }}"></i></span>
                    <div class="text-[11px] font-black text-[#38BDF8] mb-1">الخطوة 0{{ $i + 1 }}</div>
                    <div class="font-black text-sm sm:text-base">{{ $s[1] }}</div>
                    @if(!$loop->last)
                        <i class="fa-solid fa-angles-left hidden lg:block absolute top-1/2 -left-3.5 -translate-y-1/2 text-[#38BDF8]/60 text-sm z-10"></i>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= PARTNERS ================= --}}
<section class="mg-section mg-bg-white">
    <div class="mg-orb mg-orb-cyan w-96 h-96 top-10 -left-24" data-speed="0.08"></div>
    <div class="mg-wrap">
        <x-mg.section-head eyebrow="منظومة متكاملة" icon="fa-handshake" title="شركاؤنا"
            text="شراكات تكاملية بين القطاعين الحكومي والخاص والمجتمع المحلي" />

        <div class="space-y-5">
            <div class="mg-marquee" dir="rtl">
                <div class="mg-marquee-track py-2">
                    @foreach([false, true] as $dup)
                        @foreach($rowA as $k => $partner)
                            <div class="group flex items-center gap-3 px-5 py-3.5 rounded-2xl bg-white border border-[#06B6D4]/20 shadow-sm hover:border-[#06B6D4] hover:-translate-y-1 hover:shadow-xl hover:shadow-[#06B6D4]/20 transition-all duration-300 whitespace-nowrap" @if($dup) aria-hidden="true" @endif>
                                <span class="mg-icon-tile !w-10 !h-10 !text-sm !rounded-xl"><i class="fa-solid {{ $partnerIcons[$k % count($partnerIcons)] }}"></i></span>
                                <span class="font-black text-[#164E63] text-sm">{{ $partner }}</span>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
            <div class="mg-marquee" dir="rtl">
                <div class="mg-marquee-track py-2 [animation-direction:reverse]">
                    @foreach([false, true] as $dup)
                        @foreach($rowB as $k => $partner)
                            <div class="group flex items-center gap-3 px-5 py-3.5 rounded-2xl bg-white border border-[#06B6D4]/20 shadow-sm hover:border-[#06B6D4] hover:-translate-y-1 hover:shadow-xl hover:shadow-[#06B6D4]/20 transition-all duration-300 whitespace-nowrap" @if($dup) aria-hidden="true" @endif>
                                <span class="mg-icon-tile mg-icon-tile-dark !w-10 !h-10 !text-sm !rounded-xl"><i class="fa-solid {{ $partnerIcons[$k % count($partnerIcons)] }}"></i></span>
                                <span class="font-black text-[#164E63] text-sm">{{ $partner }}</span>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ================= CONTACT ================= --}}
<section id="contact" class="mg-section mg-bg-light mg-grid-pattern">
    <div class="mg-orb mg-orb-cyan w-[28rem] h-[28rem] -top-24 right-0" data-speed="0.1"></div>
    <div class="mg-wrap">
        <x-mg.section-head eyebrow="يسعدنا سماعك" icon="fa-envelope-open-text" title="تواصل معنا"
            text="يسعدنا استقبال استفساراتكم واقتراحاتكم وطلبات الانضمام كشركاء" />

        <div class="grid lg:grid-cols-5 gap-7 items-stretch">
            {{-- Info panel --}}
            <div class="lg:col-span-2 mg-aurora relative overflow-hidden rounded-[2rem] p-8 sm:p-10 text-white shadow-2xl shadow-[#164E63]/30 mg-reveal mg-reveal-right">
                <div class="mg-orb mg-orb-sky w-64 h-64 -top-20 -left-16"></div>
                <div class="relative space-y-7">
                    <div>
                        <h3 class="text-2xl font-black mb-2">معلومات التواصل</h3>
                        <p class="text-sm text-sky-100/85 leading-relaxed">فريق مَطَلّ جاهز للإجابة على تساؤلاتكم وتنسيق رحلاتكم في جازان.</p>
                    </div>
                    @foreach([
                        ['fa-envelope', 'البريد الإلكتروني', 'info@matal.sa', 'mailto:info@matal.sa'],
                        ['fa-phone', 'الهاتف الموحد', '920000000', 'tel:920000000'],
                        ['fa-location-dot', 'المقر الرئيسي', 'مدينة جازان، الكورنيش الشمالي', null],
                    ] as $c)
                        <div class="flex items-center gap-4 group">
                            <span class="mg-icon-tile !bg-white/10 !shadow-none border border-white/20"><i class="fa-solid {{ $c[0] }}"></i></span>
                            <div>
                                <div class="text-[11px] font-black text-[#38BDF8]">{{ $c[1] }}</div>
                                @if($c[3])
                                    <a href="{{ $c[3] }}" class="font-bold hover:text-[#38BDF8] transition">{{ $c[2] }}</a>
                                @else
                                    <div class="font-bold">{{ $c[2] }}</div>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <div class="pt-6 border-t border-white/15 flex items-center gap-3">
                        @foreach([['fa-x-twitter', 'https://twitter.com/matal_jazan'], ['fa-instagram', 'https://instagram.com/matal_jazan'], ['fa-tiktok', 'https://tiktok.com/@matal_jazan'], ['fa-youtube', 'https://youtube.com/@matal_jazan']] as $s)
                            <a href="{{ $s[1] }}" target="_blank" rel="noopener" class="w-10 h-10 rounded-full bg-white/10 border border-white/15 hover:bg-gradient-to-br hover:from-[#06B6D4] hover:to-[#38BDF8] hover:-translate-y-1 flex items-center justify-center transition-all duration-300">
                                <i class="fa-brands {{ $s[0] }}"></i>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <div class="lg:col-span-3 rounded-[2rem] p-1 bg-gradient-to-br from-[#164E63] via-[#06B6D4] to-[#38BDF8] shadow-2xl shadow-[#06B6D4]/20 mg-reveal mg-reveal-left">
                <div class="rounded-[1.85rem] bg-white p-7 sm:p-10 h-full">
                    <x-mg.contact-form :subject="false" />
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
