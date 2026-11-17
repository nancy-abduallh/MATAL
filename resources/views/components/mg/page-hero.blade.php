@props(['title', 'subtitle' => null, 'image' => '/images/mountain_terraces.jpg', 'crumbs' => [], 'fill' => '#F8FCFD'])

<section {{ $attributes->merge(['class' => 'mg-page-hero']) }}>
    <div class="mg-bgimg" style="background-image: url('{{ $image }}');"></div>
    <div class="mg-orb mg-orb-cyan w-[28rem] h-[28rem] -top-32 -right-16" data-speed="0.1"></div>
    <div class="mg-orb mg-orb-sky w-72 h-72 bottom-0 left-10" data-speed="0.08"></div>
    <div class="absolute inset-0 pointer-events-none opacity-40" style="z-index:1; background-image: radial-gradient(rgba(255,255,255,.3) 1px, transparent 1px); background-size: 28px 28px; -webkit-mask-image: linear-gradient(to bottom, #000, transparent 80%); mask-image: linear-gradient(to bottom, #000, transparent 80%);"></div>

    <div class="relative z-[2] max-w-7xl mx-auto px-2 sm:px-4 text-right">
        <nav class="mg-crumbs mg-reveal" aria-label="breadcrumb">
            <a href="{{ route('home') }}"><i class="fa-solid fa-house text-[10px]"></i> الرئيسية</a>
            @foreach($crumbs as $label => $url)
                <i class="fa-solid fa-chevron-left text-[9px] opacity-60"></i>
                @if($url)
                    <a href="{{ $url }}">{{ $label }}</a>
                @else
                    <span class="text-white line-clamp-1">{{ $label }}</span>
                @endif
            @endforeach
        </nav>

        <h1 class="mt-5 max-w-4xl text-4xl sm:text-5xl lg:text-6xl font-black leading-[1.15] mg-reveal" style="--d: .08s">{{ $title }}</h1>
        <div class="mg-divider !mx-0 !mt-5 mg-reveal" style="--d: .12s"></div>

        @if($subtitle)
            <p class="mt-5 max-w-2xl text-base sm:text-lg text-sky-100/90 leading-loose mg-reveal" style="--d: .16s">{{ $subtitle }}</p>
        @endif

        {{ $slot }}
    </div>

    <div class="mg-wave">
        <svg viewBox="0 0 1440 80" preserveAspectRatio="none" aria-hidden="true">
            <path d="M0,48 C180,96 360,0 600,40 C840,80 1080,8 1260,40 C1350,56 1410,52 1440,44 L1440,80 L0,80 Z" fill="{{ $fill }}"/>
        </svg>
    </div>
</section>
