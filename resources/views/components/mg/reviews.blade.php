@props([
    'reviews', 'rating', 'subtitle', 'field', 'id', 'formTitle', 'placeholder', 'empty',
    'submit' => 'إرسال التقييم',
    'labels' => [
        5 => 'ممتاز (5 من 5)',
        4 => 'جيد جداً (4 من 5)',
        3 => 'جيد (3 من 5)',
        2 => 'مقبول (2 من 5)',
        1 => 'يحتاج تحسين (1 من 5)',
    ],
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
            <div class="relative" id="ratingPicker_{{ $id }}">
                <label class="mg-label" for="ratingBtn_{{ $id }}">التقييم</label>
                <input type="hidden" name="rating" id="ratingInput_{{ $id }}" value="5" required>

                <!-- Custom Luxury Star Rating Trigger -->
                <button type="button" id="ratingBtn_{{ $id }}"
                        class="mg-field !py-2.5 !px-3.5 flex items-center justify-between gap-3 text-right cursor-pointer bg-white"
                        aria-haspopup="listbox" aria-expanded="false">
                    <div class="flex items-center gap-2.5 min-w-0">
                        <span id="ratingStarsView_{{ $id }}" class="flex items-center gap-1 text-sm shrink-0">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </span>
                        <span id="ratingTextView_{{ $id }}" class="font-bold text-xs sm:text-sm text-[#164E63] truncate">
                            ممتاز (5 من 5)
                        </span>
                    </div>
                    <i id="ratingChev_{{ $id }}" class="fa-solid fa-chevron-down text-xs text-[#06B6D4] transition-transform duration-300 shrink-0"></i>
                </button>

                <!-- Custom Dropdown Menu with 3D Gold Stars -->
                <div id="ratingDropdown_{{ $id }}"
                     class="absolute top-full mt-2 inset-x-0 z-50 bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl shadow-[#164E63]/25 border border-[#06B6D4]/30 p-1.5 space-y-1 opacity-0 invisible translate-y-2 transition-all duration-200"
                     role="listbox">
                    @foreach($labels as $val => $text)
                        <div class="rating-option-item flex items-center justify-between gap-3 p-2.5 rounded-xl cursor-pointer hover:bg-gradient-to-r hover:from-[#E0F2FE] hover:to-white transition-all duration-200 {{ $val == 5 ? 'is-selected bg-[#E0F2FE]/70 font-bold' : '' }}"
                             data-val="{{ $val }}" data-text="{{ $text }}" role="option" aria-selected="{{ $val == 5 ? 'true' : 'false' }}">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <span class="flex items-center gap-1 text-sm shrink-0">
                                    @for($s = 1; $s <= 5; $s++)
                                        @if($s <= $val)
                                            <i class="fa-solid fa-star"></i>
                                        @else
                                            <i class="fa-regular fa-star opacity-35"></i>
                                        @endif
                                    @endfor
                                </span>
                                <span class="text-xs sm:text-sm text-[#164E63] font-bold truncate">{{ $text }}</span>
                            </div>
                            <i class="fa-solid fa-check text-xs text-[#06B6D4] opacity-0 transition-opacity {{ $val == 5 ? '!opacity-100' : '' }}"></i>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div>
            <label class="mg-label">تجربتك</label>
            <textarea name="comment" rows="3" placeholder="{{ $placeholder }}" required class="mg-field resize-none"></textarea>
        </div>
        <button type="submit" class="mg-btn"><i class="fa-solid fa-paper-plane"></i><span>{{ $submit }}</span></button>
    </form>
</div>

<script>
    (function() {
        const picker = document.getElementById('ratingPicker_{{ $id }}');
        if (!picker) return;
        const btn = document.getElementById('ratingBtn_{{ $id }}');
        const menu = document.getElementById('ratingDropdown_{{ $id }}');
        const chev = document.getElementById('ratingChev_{{ $id }}');
        const input = document.getElementById('ratingInput_{{ $id }}');
        const starsView = document.getElementById('ratingStarsView_{{ $id }}');
        const textView = document.getElementById('ratingTextView_{{ $id }}');
        const options = picker.querySelectorAll('.rating-option-item');

        function toggleMenu(show) {
            const open = show ?? menu.classList.contains('invisible');
            if (open) {
                menu.classList.remove('invisible', 'opacity-0', 'translate-y-2');
                chev.classList.add('rotate-180');
                btn.setAttribute('aria-expanded', 'true');
            } else {
                menu.classList.add('invisible', 'opacity-0', 'translate-y-2');
                chev.classList.remove('rotate-180');
                btn.setAttribute('aria-expanded', 'false');
            }
        }

        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleMenu();
        });

        options.forEach(opt => {
            opt.addEventListener('click', (e) => {
                e.stopPropagation();
                const val = parseInt(opt.getAttribute('data-val'), 10);
                const text = opt.getAttribute('data-text');
                input.value = val;
                textView.textContent = text;

                let starsHtml = '';
                for (let s = 1; s <= 5; s++) {
                    if (s <= val) {
                        starsHtml += '<i class="fa-solid fa-star"></i>';
                    } else {
                        starsHtml += '<i class="fa-regular fa-star opacity-35"></i>';
                    }
                }
                starsView.innerHTML = starsHtml;

                options.forEach(o => {
                    const isCur = o === opt;
                    o.classList.toggle('is-selected', isCur);
                    o.classList.toggle('bg-[#E0F2FE]/70', isCur);
                    o.classList.toggle('font-bold', isCur);
                    o.setAttribute('aria-selected', isCur ? 'true' : 'false');
                    const check = o.querySelector('.fa-check');
                    if (check) check.classList.toggle('!opacity-100', isCur);
                });

                toggleMenu(false);
            });
        });

        document.addEventListener('click', (e) => {
            if (!picker.contains(e.target)) {
                toggleMenu(false);
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') toggleMenu(false);
        });
    })();
</script>
