@props(['eyebrow', 'icon' => 'fa-compass', 'title', 'text' => null, 'align' => 'center'])

<div {{ $attributes->merge(['class' => 'mg-reveal mb-12 sm:mb-16 ' . ($align === 'center' ? 'text-center' : 'text-right')]) }}>
    <span class="mg-eyebrow"><i class="fa-solid {{ $icon }}"></i>{{ $eyebrow }}</span>
    <h2 class="mg-title mt-5">{{ $title }}</h2>
    @if($align === 'center')
        <div class="mg-divider"></div>
    @endif
    @if($text)
        <p class="mg-lead mt-5" @if($align !== 'center') style="margin-inline: 0;" @endif>{{ $text }}</p>
    @endif
</div>
