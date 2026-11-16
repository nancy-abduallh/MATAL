// MATAL Application Core Interactive Scripts
document.addEventListener('DOMContentLoaded', () => {
    // 1. Mobile Menu Toggle
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // 2. Interactive Hero Image Slider
    const heroSlides = document.querySelectorAll('.hero-slide');
    const heroIndicators = document.querySelectorAll('.hero-indicator');
    const slideNumberEl = document.getElementById('currentSlideNumber');
    let currentSlide = 0;
    let slideInterval = null;

    function showSlide(index) {
        if (!heroSlides.length) return;
        currentSlide = (index + heroSlides.length) % heroSlides.length;

        heroSlides.forEach((slide, idx) => {
            if (idx === currentSlide) {
                slide.classList.remove('opacity-0', 'pointer-events-none', 'scale-105');
                slide.classList.add('opacity-100', 'scale-100');
            } else {
                slide.classList.remove('opacity-100', 'scale-100');
                slide.classList.add('opacity-0', 'pointer-events-none', 'scale-105');
            }
        });

        heroIndicators.forEach((ind, idx) => {
            const bar = ind.querySelector('.indicator-bar');
            if (bar) {
                if (idx === currentSlide) {
                    bar.style.width = '100%';
                    bar.classList.add('bg-amber-500');
                    bar.classList.remove('bg-white/40');
                } else {
                    bar.style.width = '24px';
                    bar.classList.remove('bg-amber-500');
                    bar.classList.add('bg-white/40');
                }
            }
        });

        if (slideNumberEl) {
            slideNumberEl.textContent = `0${currentSlide + 1}`;
        }
    }

    function startSliderAutoPlay() {
        if (heroSlides.length <= 1) return;
        slideInterval = setInterval(() => {
            showSlide(currentSlide + 1);
        }, 5500);
    }

    if (heroSlides.length > 0) {
        showSlide(0);
        startSliderAutoPlay();

        heroIndicators.forEach((ind, idx) => {
            ind.addEventListener('click', () => {
                clearInterval(slideInterval);
                showSlide(idx);
                startSliderAutoPlay();
            });
        });
    }

    // 3. 3D Interactive Tilt & Depth Effect for Modern Luxury Cards
    if (window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
        const tiltElements = document.querySelectorAll('[data-tilt], .tilt-card');
        tiltElements.forEach(el => {
            el.style.willChange = 'transform';
            el.style.transformStyle = 'preserve-3d';

            el.addEventListener('mousemove', (e) => {
                const rect = el.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                // Subtle, elegant tilt angles (+/- 6 degrees max)
                const rotateX = Math.max(-6, Math.min(6, ((y - centerY) / centerY) * -6));
                const rotateY = Math.max(-6, Math.min(6, ((x - centerX) / centerX) * 6));
                el.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-8px) scale3d(1.02, 1.02, 1.02)`;
            });

            el.addEventListener('mouseleave', () => {
                el.style.transform = '';
            });
        });
    }

    // 4. Interactive Timeline Station Preview
    const timelineButtons = document.querySelectorAll('.timeline-station-btn');
    const timelineInfoBox = document.getElementById('timelineStationInfo');
    if (timelineButtons.length && timelineInfoBox) {
        timelineButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const title = btn.getAttribute('data-title') || '';
                const desc = btn.getAttribute('data-desc') || '';
                const icon = btn.getAttribute('data-icon') || '';
                const step = btn.getAttribute('data-step') || '';

                timelineButtons.forEach(b => b.classList.remove('ring-4', 'ring-amber-400', 'scale-110'));
                btn.classList.add('ring-4', 'ring-amber-400', 'scale-110');

                timelineInfoBox.innerHTML = `
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-amber-500/20 text-amber-400 rounded-full text-xs font-bold mb-2">
                        المحطة ${step} من 7
                    </div>
                    <h4 class="text-xl font-bold text-white mb-2">${title}</h4>
                    <p class="text-white/80 text-sm leading-relaxed">${desc}</p>
                `;
            });
        });
    }

    // 5. Global Booking Calculator
    const bookingForm = document.getElementById('bookingForm');
    if (bookingForm) {
        const adultsInput = bookingForm.querySelector('input[name="adults_count"]');
        const childrenInput = bookingForm.querySelector('input[name="children_count"]');
        const pricePerPerson = parseFloat(bookingForm.getAttribute('data-base-price') || '0');
        const totalPriceEl = document.getElementById('bookingTotalDisplay');
        const addonCheckboxes = bookingForm.querySelectorAll('.addon-checkbox');

        function updatePrice() {
            const adults = parseInt(adultsInput ? adultsInput.value : '1') || 1;
            const children = parseInt(childrenInput ? childrenInput.value : '0') || 0;
            let total = (adults * pricePerPerson) + (children * (pricePerPerson * 0.5));

            addonCheckboxes.forEach(cb => {
                if (cb.checked) {
                    const cost = parseFloat(cb.getAttribute('data-addon-price') || '0');
                    const perPerson = cb.getAttribute('data-per-person') === 'true';
                    total += perPerson ? (cost * (adults + children)) : cost;
                }
            });

            if (totalPriceEl) {
                totalPriceEl.textContent = `${total.toFixed(2)} ر.س`;
            }
        }

        if (adultsInput) adultsInput.addEventListener('input', updatePrice);
        if (childrenInput) childrenInput.addEventListener('input', updatePrice);
        addonCheckboxes.forEach(cb => cb.addEventListener('change', updatePrice));
        updatePrice();
    }

    // 6. Scroll Progress Bar & Back to Top Button
    const progressBar = document.getElementById('scrollProgressBar');
    const backToTopBtn = document.getElementById('backToTopBtn');

    window.addEventListener('scroll', () => {
        const scrollTop = window.scrollY || document.documentElement.scrollTop;
        const docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const progress = docHeight > 0 ? scrollTop / docHeight : 0;
        
        if (progressBar) {
            progressBar.style.transform = `scaleX(${progress})`;
        }

        if (backToTopBtn) {
            if (scrollTop > 450) {
                backToTopBtn.classList.remove('opacity-0', 'translate-y-6', 'pointer-events-none');
                backToTopBtn.classList.add('opacity-100', 'translate-y-0');
            } else {
                backToTopBtn.classList.remove('opacity-100', 'translate-y-0');
                backToTopBtn.classList.add('opacity-0', 'translate-y-6', 'pointer-events-none');
            }
        }
    }, { passive: true });

    if (backToTopBtn) {
        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // 7. Live Count-Up Animation for Stats Bar
    const counterElements = document.querySelectorAll('[data-counter]');
    if (counterElements.length && 'IntersectionObserver' in window) {
        const counterObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const targetVal = parseFloat(el.getAttribute('data-counter') || '0');
                    const decimals = parseInt(el.getAttribute('data-decimals') || '0');
                    const prefix = el.getAttribute('data-prefix') || '';
                    const suffix = el.getAttribute('data-suffix') || '';
                    const duration = 1600;
                    const startTime = performance.now();

                    function updateNumber(now) {
                        const elapsed = now - startTime;
                        const progress = Math.min(elapsed / duration, 1);
                        const easeProgress = 1 - Math.pow(1 - progress, 3);
                        const current = targetVal * easeProgress;

                        el.textContent = `${prefix}${decimals > 0 ? current.toFixed(decimals) : Math.floor(current)}${suffix}`;

                        if (progress < 1) {
                            requestAnimationFrame(updateNumber);
                        } else {
                            el.textContent = `${prefix}${decimals > 0 ? targetVal.toFixed(decimals) : targetVal}${suffix}`;
                        }
                    }

                    requestAnimationFrame(updateNumber);
                    observer.unobserve(el);
                }
            });
        }, { threshold: 0.2 });

        counterElements.forEach(el => counterObserver.observe(el));
    }

    // 8. Interactive Expanding Gallery Panels (Diversity Section)
    const expandingPanels = document.querySelectorAll('.expanding-panel');
    if (expandingPanels.length) {
        expandingPanels.forEach(panel => {
            panel.addEventListener('mouseenter', () => {
                expandingPanels.forEach(p => p.classList.remove('is-active'));
                panel.classList.add('is-active');
            });
            panel.addEventListener('click', () => {
                expandingPanels.forEach(p => p.classList.remove('is-active'));
                panel.classList.add('is-active');
            });
        });
    }

    // 9. Mountain Road Waypoint Interactive Nodes (Summit Journey)
    const waypointButtons = document.querySelectorAll('.waypoint-node');
    const summitCard = document.getElementById('summitJourneyDisplay');
    if (waypointButtons.length && summitCard) {
        waypointButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const title = btn.getAttribute('data-title') || '';
                const desc = btn.getAttribute('data-desc') || '';
                const step = btn.getAttribute('data-step') || '';
                const icon = btn.getAttribute('data-icon') || 'fa-mountain';

                waypointButtons.forEach(b => b.classList.remove('is-active'));
                btn.classList.add('is-active');

                summitCard.innerHTML = `
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#2EC4C9]/20 text-[#2EC4C9] text-xs font-bold mb-3 border border-[#2EC4C9]/30">
                        <i class="fa-solid ${icon}"></i>
                        <span>المحطة ${step} من 7</span>
                    </div>
                    <h3 class="text-2xl sm:text-3xl font-black text-white mb-2 font-display">${title}</h3>
                    <p class="text-sky-100/90 text-sm sm:text-base leading-relaxed">${desc}</p>
                `;
            });
        });
    }
});
