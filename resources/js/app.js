// MATAL Application Core Interactive Scripts
document.addEventListener('DOMContentLoaded', () => {

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

    // 2.1. Mobile 3D Moving Hero Cards Showcase (Professional Living Motion Design)
    const mobileStage = document.getElementById('mobileHeroStage');
    const mobileCards = document.querySelectorAll('.mobile-moving-card');
    const mobilePills = document.querySelectorAll('.mobile-hero-pill');

    if (mobileStage && mobileCards.length === 3) {
        let activeIdx = 0;
        let autoRotateTimer = null;

        function updateCardPositions(newIdx) {
            activeIdx = (newIdx + 3) % 3;

            mobileCards.forEach(card => {
                const cardIdx = parseInt(card.getAttribute('data-card-index'), 10);
                card.classList.remove('mobile-card-pos-center', 'mobile-card-pos-left', 'mobile-card-pos-right');

                if (cardIdx === activeIdx) {
                    card.classList.add('mobile-card-pos-center');
                } else if (cardIdx === (activeIdx + 1) % 3) {
                    card.classList.add('mobile-card-pos-right');
                } else {
                    card.classList.add('mobile-card-pos-left');
                }
            });

            mobilePills.forEach((pill, idx) => {
                const isActive = idx === activeIdx;
                pill.classList.toggle('is-active', isActive);
                if (isActive) {
                    pill.classList.remove('text-sky-100/70', 'bg-white/10', 'border-white/15');
                } else {
                    pill.classList.add('text-sky-100/70', 'bg-white/10', 'border-white/15');
                }
            });
        }

        function startAutoRotate() {
            stopAutoRotate();
            autoRotateTimer = setInterval(() => {
                updateCardPositions(activeIdx + 1);
            }, 4200);
        }

        function stopAutoRotate() {
            if (autoRotateTimer) {
                clearInterval(autoRotateTimer);
                autoRotateTimer = null;
            }
        }

        // Tap interactions
        mobileCards.forEach(card => {
            card.addEventListener('click', (e) => {
                const cardIdx = parseInt(card.getAttribute('data-card-index'), 10);
                if (cardIdx !== activeIdx) {
                    e.preventDefault();
                    stopAutoRotate();
                    updateCardPositions(cardIdx);
                    startAutoRotate();
                } else {
                    const href = card.getAttribute('data-href');
                    if (href) {
                        window.location.href = href;
                    }
                }
            });
        });

        // Pill clicks
        mobilePills.forEach((pill, idx) => {
            pill.addEventListener('click', () => {
                stopAutoRotate();
                updateCardPositions(idx);
                startAutoRotate();
            });
        });

        // Touch Swipe Gestures
        let touchStartX = 0;
        let touchEndX = 0;

        mobileStage.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
            stopAutoRotate();
        }, { passive: true });

        mobileStage.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            const diff = touchEndX - touchStartX;
            if (Math.abs(diff) > 40) {
                // In RTL: swipe right moves to previous, swipe left moves to next
                if (diff > 0) {
                    updateCardPositions(activeIdx - 1);
                } else {
                    updateCardPositions(activeIdx + 1);
                }
            }
            startAutoRotate();
        }, { passive: true });

        // Initialize positions and start ambient rotation
        updateCardPositions(0);
        startAutoRotate();
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
});

/* =====================================================================
   MATAL · UI ENGINE  (append to the END of resources/js/app.js)
   Scroll reveal · 3D tilt + glare · parallax · accordion · gallery · magnetic buttons
   ===================================================================== */
document.addEventListener('DOMContentLoaded', () => {
    const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const canHover = window.matchMedia('(hover: hover) and (pointer: fine)').matches;

    // 1. Auto stagger: children of [data-stagger] get an increasing delay
    document.querySelectorAll('[data-stagger]').forEach(parent => {
        const step = parseFloat(parent.getAttribute('data-stagger')) || 0.09;
        Array.from(parent.children).forEach((child, i) => child.style.setProperty('--d', `${(i * step).toFixed(2)}s`));
    });

    // 2. Scroll reveal
    const revealEls = document.querySelectorAll('.mg-reveal');
    if ('IntersectionObserver' in window && !reduce) {
        const io = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-in');
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' });
        revealEls.forEach(el => io.observe(el));
    } else {
        revealEls.forEach(el => el.classList.add('is-in'));
    }

    // 3. 3D tilt with moving glare for every .mg-card
    if (canHover && !reduce) {
        document.querySelectorAll('.mg-card:not([data-no-tilt])').forEach(card => {
            if (!card.querySelector(':scope > .mg-glare')) {
                const glare = document.createElement('span');
                glare.className = 'mg-glare';
                glare.setAttribute('aria-hidden', 'true');
                card.appendChild(glare);
            }
            const max = parseFloat(card.getAttribute('data-tilt-max')) || 7;
            card.addEventListener('mousemove', e => {
                const r = card.getBoundingClientRect();
                const px = (e.clientX - r.left) / r.width;
                const py = (e.clientY - r.top) / r.height;
                card.style.setProperty('--ry', `${((px - 0.5) * max * 2).toFixed(2)}deg`);
                card.style.setProperty('--rx', `${((0.5 - py) * max * 2).toFixed(2)}deg`);
                card.style.setProperty('--mx', `${(px * 100).toFixed(1)}%`);
                card.style.setProperty('--my', `${(py * 100).toFixed(1)}%`);
            });
            card.addEventListener('mouseleave', () => {
                card.style.setProperty('--rx', '0deg');
                card.style.setProperty('--ry', '0deg');
            });
        });
    }

    // 4. Magnetic buttons
    if (canHover && !reduce) {
        document.querySelectorAll('[data-magnetic]').forEach(btn => {
            btn.addEventListener('mousemove', e => {
                const r = btn.getBoundingClientRect();
                const x = (e.clientX - (r.left + r.width / 2)) * 0.18;
                const y = (e.clientY - (r.top + r.height / 2)) * 0.28;
                btn.style.transform = `translate(${x}px, ${y}px)`;
            });
            btn.addEventListener('mouseleave', () => { btn.style.transform = ''; });
        });
    }

    // 5. Scroll parallax for [data-speed] elements (orbs, floating cards, backgrounds)
    const parallaxEls = Array.from(document.querySelectorAll('[data-speed]'));
    if (parallaxEls.length && !reduce) {
        let ticking = false;
        const update = () => {
            const vh = window.innerHeight;
            parallaxEls.forEach(el => {
                const r = el.parentElement.getBoundingClientRect();
                if (r.bottom < -200 || r.top > vh + 200) return;
                const speed = parseFloat(el.getAttribute('data-speed')) || 0.1;
                const offset = (r.top + r.height / 2 - vh / 2) * speed * -1;
                el.style.translate = `0 ${offset.toFixed(1)}px`;
            });
            ticking = false;
        };
        window.addEventListener('scroll', () => {
            if (!ticking) { requestAnimationFrame(update); ticking = true; }
        }, { passive: true });
        update();
    }

    // 6. Accordion (.mg-acc > .mg-acc-trigger) , optional single-open via [data-acc-single] on a parent
    document.querySelectorAll('.mg-acc').forEach(item => {
        const trigger = item.querySelector('.mg-acc-trigger');
        if (!trigger) return;
        trigger.addEventListener('click', e => {
            e.preventDefault();
            const willOpen = !item.classList.contains('is-open');
            const group = item.closest('[data-acc-single]');
            if (group && willOpen) {
                group.querySelectorAll('.mg-acc.is-open').forEach(o => {
                    o.classList.remove('is-open');
                    const t = o.querySelector('.mg-acc-trigger');
                    if (t) t.setAttribute('aria-expanded', 'false');
                });
            }
            item.classList.toggle('is-open', willOpen);
            trigger.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
        });
    });

    // 7. Expanding gallery panels
    const panels = document.querySelectorAll('.mg-panel');
    panels.forEach(panel => {
        const activate = () => {
            panels.forEach(p => p.classList.remove('is-active'));
            panel.classList.add('is-active');
        };
        panel.addEventListener('mouseenter', activate);
        panel.addEventListener('focus', activate);
    });

    // 8. Generic filter chips: [data-filter-group="<css selector of items>"] > .mg-chip[data-filter]
    //    items need [data-cat="slug1 slug2"]
    document.querySelectorAll('[data-filter-group]').forEach(group => {
        const chips = group.querySelectorAll('.mg-chip[data-filter]');
        const items = document.querySelectorAll(group.getAttribute('data-filter-group'));
        chips.forEach(chip => chip.addEventListener('click', () => {
            const f = chip.getAttribute('data-filter');
            chips.forEach(c => c.classList.toggle('is-active', c === chip));
            items.forEach(it => {
                const show = f === 'all' || (it.getAttribute('data-cat') || '').split(' ').includes(f);
                it.style.display = show ? '' : 'none';
                if (show) { it.classList.remove('is-in'); requestAnimationFrame(() => it.classList.add('is-in')); }
            });
        }));
    });
});
