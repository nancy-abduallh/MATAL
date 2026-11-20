@props([
    'reviews', 'rating', 'subtitle', 'field', 'id', 'formTitle', 'placeholder', 'empty',
    'submit' => 'إرسال التقييم',
    'labels' => [5 => '⭐⭐⭐⭐⭐ ممتاز (5 من 5)', 4 => '⭐⭐⭐⭐ جيد جداً (4 من 5)', 3 => '⭐⭐⭐ جيد (3 من 5)'],
])

<div class="rounded-[2rem] bg-white border border-[#06B6D4]/15 shadow-xl shadow-[#164E63]/5 p-6 sm:p-9 mg-reveal">
    <div class="flex flex-wrap items-start justify-between gap-4 mb-8">
        <div class="flex items-center gap-4">
            <span class="mg-icon-tile"><i class="fa-solid fa-comments"></i></span>
            <div>
                <h3 class="text-xl sm:text-2xl font-black text-[#164E63]">تقييمات وتجارب الزوار</h3>
                <p class="text-sm text-[#183746]/70 mt-1">{{ $subtitle }}</p>
            </div>
        </div>
        <div class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl bg-gradient-to-r from-[#164E63] to-[#0e3b4d] text-white font-black text-lg shadow-lg shadow-[#164E63]/30">
            <i class="fa-solid fa-star"></i> {{ number_format($rating, 1) }}
        </div>
    </div>

    <div class="space-y-4 mb-10" data-stagger="0.08">
        @forelse($reviews as $rev)
            <div class="mg-reveal flex gap-4 p-5 rounded-2xl bg-[#F8FCFD] border border-[#06B6D4]/15 hover:border-[#06B6D4]/50 hover:shadow-lg hover:shadow-[#06B6D4]/10 hover:-translate-y-0.5 transition-all duration-300">
                <span class="w-11 h-11 shrink-0 rounded-full bg-gradient-to-br from-[#06B6D4] to-[#38BDF8] text-white font-black flex items-center justify-center">{{ mb_substr($rev->author_name, 0, 1) }}</span>
                <div class="flex-grow min-w-0">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-1.5">
                        <span class="font-black text-[#164E63] text-sm">{{ $rev->author_name }}</span>
                        <span class="inline-flex items-center gap-0.5 text-xs whitespace-nowrap">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $rev->rating)
                                    <i class="fa-solid fa-star"></i>
                                @else
                                    <i class="fa-regular fa-star opacity-40"></i>
                                @endif
                            @endfor
                        </span>
                    </div>
                    <p class="text-sm text-[#183746]/80 leading-relaxed">{{ $rev->comment }}</p>
                </div>
            </div>
        @empty
            <div class="text-center py-9 rounded-2xl border-2 border-dashed border-[#06B6D4]/30 text-[#164E63]/70 text-sm font-bold">
                <i class="fa-regular fa-message text-2xl text-[#06B6D4] block mb-2"></i>{{ $empty }}
            </div>
        @endforelse
    </div>

    <form action="{{ route('reviews.store') }}" method="POST" class="rounded-3xl p-6 bg-gradient-to-br from-[#E0F2FE] to-[#F8FCFD] border border-[#06B6D4]/20 space-y-4">
        @csrf
        <input type="hidden" name="{{ $field }}" value="{{ $id }}">
        <h4 class="font-black text-[#164E63] flex items-center gap-2"><i class="fa-solid fa-pen-to-square text-[#06B6D4]"></i> {{ $formTitle }}</h4>
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="mg-label">الاسم</label>
                <input type="text" name="author_name" placeholder="اسمك الكامل" required class="mg-field">
            </div>
            <div>
                <label class="mg-label">التقييم</label>
                <select name="rating" class="mg-field">
                    @foreach($labels as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>
            <label class="mg-label">تجربتك</label>
            <textarea name="comment" rows="3" placeholder="{{ $placeholder }}" required class="mg-field resize-none"></textarea>
        </div>
        <button type="submit" class="mg-btn"><i class="fa-solid fa-paper-plane"></i><span>{{ $submit }}</span></button>
    </form>
</div>
