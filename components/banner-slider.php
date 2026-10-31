<!-- 2. Hero Banner Slider (Fully Mobile Responsive) -->
<style>
    /* Bulletproof slider sizing — ensures each slide = exactly viewport width */
    #banner { overflow: hidden; }
    #hero-slider-track { display: flex; }
    #hero-slider-track > .hero-slide {
        width: 100vw;
        min-width: 100vw;
        max-width: 100vw;
        flex: 0 0 100vw;
    }
</style>

<section id="banner" class="relative w-full h-[70vh] min-h-[400px] sm:min-h-[560px] sm:h-[85vh] lg:h-screen max-h-[1000px] overflow-hidden bg-slate-900">
    
    <!-- Slides Track -->
    <div id="hero-slider-track" class="h-full transition-transform duration-700 ease-in-out will-change-transform">
        
        <!-- Slide 1: Advanced Battery Solutions -->
        <div class="hero-slide h-full relative flex items-end sm:items-center">
            <!-- Background Image -->
            <img src="./assets/img/banner1.jpg" 
                 alt="LiFePO4 and Sodium-Ion Batteries" 
                 class="absolute inset-0 w-full h-full object-cover object-center"
                 loading="eager">
            
            <!-- Dark Gradient Overlay — bottom-heavy on mobile for readability -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-black/10 sm:bg-gradient-to-r sm:from-slate-950/85 sm:via-slate-900/50 sm:to-transparent"></div>
            <div class="absolute inset-0 bg-black/15"></div>

            <!-- Slide Content -->
            <div class="relative w-full z-10 px-4 sm:px-6 lg:px-8 pb-14 pt-20 sm:pt-28 sm:pb-20 lg:pt-32 lg:pb-24 mx-auto" style="max-width: 80rem;">
                <div class="w-full sm:max-w-2xl lg:max-w-3xl">
                    <span class="inline-block text-[10px] sm:text-xs lg:text-sm font-bold tracking-[0.15em] sm:tracking-[0.2em] text-white/90 uppercase mb-1.5 sm:mb-3 drop-shadow">
                        ADVANCED BATTERY SOLUTIONS
                    </span>
                    
                    <h1 class="text-xl sm:text-4xl md:text-5xl lg:text-[62px] text-white leading-snug sm:leading-[1.1] lg:leading-[1.08] tracking-tight mb-2.5 sm:mb-5 drop-shadow-md">
                        <span class="italic font-extrabold block">LiFePO4 & Sodium-Ion</span>
                        <span class="italic font-['Playfair_Display',serif] font-semibold block text-slate-100 mt-0.5 sm:mt-1 text-[17px] sm:text-3xl md:text-[40px] lg:text-[54px] leading-snug sm:leading-[1.15]">Batteries for Marine, RV, Solar and Off-Grid Power</span>
                    </h1>

                    <p class="text-xs leading-relaxed sm:text-base lg:text-lg text-white/85 sm:text-white/95 sm:max-w-xl lg:max-w-2xl font-normal sm:leading-relaxed mb-4 sm:mb-8 drop-shadow">
                        Explore long-lasting battery systems engineered for marine boats, RVs, golf carts, solar storage, home backup and off-grid applications. Selected models include advanced BMS protection and self-heating technology.
                    </p>

                    <div class="flex flex-row items-center gap-2.5 sm:gap-4">
                        <a href="#quote" class="px-4 sm:px-8 py-2 sm:py-3.5 rounded-full text-white font-semibold text-xs sm:text-base bg-[#12b3d6] hover:bg-[#0ea5e9] shadow-lg shadow-cyan-500/25 transition-all text-center whitespace-nowrap">
                            Get a Quote
                        </a>
                        <a href="#learn-more" class="px-4 sm:px-8 py-2 sm:py-3.5 rounded-full text-white font-semibold text-xs sm:text-base border-2 border-white/80 hover:bg-white/15 transition-all text-center whitespace-nowrap">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2: Fishing Boat -->
        <div class="hero-slide h-full relative flex items-end sm:items-center">
            <img src="./assets/img/banner2.jpg" 
                 alt="24V Lithium Batteries for Fishing Boats" 
                 class="absolute inset-0 w-full h-full object-cover object-center"
                 loading="lazy">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-black/10 sm:bg-gradient-to-r sm:from-slate-950/85 sm:via-slate-900/50 sm:to-transparent"></div>
            <div class="absolute inset-0 bg-black/15"></div>

            <div class="relative w-full z-10 px-4 sm:px-6 lg:px-8 pb-14 pt-20 sm:pt-28 sm:pb-20 lg:pt-32 lg:pb-24 mx-auto" style="max-width: 80rem;">
                <div class="w-full sm:max-w-2xl lg:max-w-3xl">
                    <span class="inline-block text-[10px] sm:text-xs lg:text-sm font-bold tracking-[0.15em] sm:tracking-[0.2em] text-white/90 uppercase mb-1.5 sm:mb-3 drop-shadow">
                        FISHING BOAT
                    </span>
                    
                    <h2 class="text-xl sm:text-4xl md:text-5xl lg:text-[62px] text-white leading-snug sm:leading-[1.1] lg:leading-[1.08] tracking-tight mb-2.5 sm:mb-5 drop-shadow-md">
                        <span class="italic font-extrabold block">24V Lithium Batteries</span>
                        <span class="italic font-['Playfair_Display',serif] font-semibold block text-slate-100 mt-0.5 sm:mt-1 text-[17px] sm:text-3xl md:text-[40px] lg:text-[54px] leading-snug sm:leading-[1.15]">for Fishing Boats</span>
                    </h2>

                    <p class="text-xs leading-relaxed sm:text-base lg:text-lg text-white/85 sm:text-white/95 sm:max-w-xl lg:max-w-2xl font-normal sm:leading-relaxed mb-4 sm:mb-8 drop-shadow">
                        Dependable deep-cycle power for trolling motors, onboard electronics and extended fishing trips, with reduced weight and low maintenance.
                    </p>

                    <div class="flex flex-row items-center gap-2.5 sm:gap-4">
                        <a href="#quote" class="px-4 sm:px-8 py-2 sm:py-3.5 rounded-full text-white font-semibold text-xs sm:text-base bg-[#12b3d6] hover:bg-[#0ea5e9] shadow-lg shadow-cyan-500/25 transition-all text-center whitespace-nowrap">
                            Get a Quote
                        </a>
                        <a href="#learn-more" class="px-4 sm:px-8 py-2 sm:py-3.5 rounded-full text-white font-semibold text-xs sm:text-base border-2 border-white/80 hover:bg-white/15 transition-all text-center whitespace-nowrap">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3: Marine Batteries -->
        <div class="hero-slide h-full relative flex items-end sm:items-center">
            <img src="./assets/img/banner3.jpg" 
                 alt="Marine Batteries for Boats and Watercraft" 
                 class="absolute inset-0 w-full h-full object-cover object-center"
                 loading="lazy">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-black/10 sm:bg-gradient-to-r sm:from-slate-950/85 sm:via-slate-900/50 sm:to-transparent"></div>
            <div class="absolute inset-0 bg-black/15"></div>

            <div class="relative w-full z-10 px-4 sm:px-6 lg:px-8 pb-14 pt-20 sm:pt-28 sm:pb-20 lg:pt-32 lg:pb-24 mx-auto" style="max-width: 80rem;">
                <div class="w-full sm:max-w-2xl lg:max-w-3xl">
                    <span class="inline-block text-[10px] sm:text-xs lg:text-sm font-bold tracking-[0.15em] sm:tracking-[0.2em] text-white/90 uppercase mb-1.5 sm:mb-3 drop-shadow">
                        MARINE BATTERIES
                    </span>
                    
                    <h2 class="text-xl sm:text-4xl md:text-5xl lg:text-[62px] text-white leading-snug sm:leading-[1.1] lg:leading-[1.08] tracking-tight mb-2.5 sm:mb-5 drop-shadow-md">
                        <span class="italic font-extrabold block">Marine Batteries for</span>
                        <span class="italic font-['Playfair_Display',serif] font-semibold block text-slate-100 mt-0.5 sm:mt-1 text-[17px] sm:text-3xl md:text-[40px] lg:text-[54px] leading-snug sm:leading-[1.15]">Boats and Watercraft</span>
                    </h2>

                    <p class="text-xs leading-relaxed sm:text-base lg:text-lg text-white/85 sm:text-white/95 sm:max-w-xl lg:max-w-2xl font-normal sm:leading-relaxed mb-4 sm:mb-8 drop-shadow">
                        Reliable starting and auxiliary power for marine engines, navigation systems and onboard equipment in demanding marine environments.
                    </p>

                    <div class="flex flex-row items-center gap-2.5 sm:gap-4">
                        <a href="#quote" class="px-4 sm:px-8 py-2 sm:py-3.5 rounded-full text-white font-semibold text-xs sm:text-base bg-[#12b3d6] hover:bg-[#0ea5e9] shadow-lg shadow-cyan-500/25 transition-all text-center whitespace-nowrap">
                            Get a Quote
                        </a>
                        <a href="#learn-more" class="px-4 sm:px-8 py-2 sm:py-3.5 rounded-full text-white font-semibold text-xs sm:text-base border-2 border-white/80 hover:bg-white/15 transition-all text-center whitespace-nowrap">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bottom Slider Dots / Indicators -->
    <div class="absolute bottom-3 sm:bottom-10 left-1/2 -translate-x-1/2 flex items-center gap-2 sm:gap-2.5 z-20">
        <button type="button" class="hero-dot w-6 sm:w-7 h-1.5 sm:h-2 rounded-full bg-white transition-all duration-300" data-slide="0" aria-label="Go to slide 1"></button>
        <button type="button" class="hero-dot w-1.5 sm:w-2 h-1.5 sm:h-2 rounded-full bg-white/70 hover:bg-white transition-all duration-300" data-slide="1" aria-label="Go to slide 2"></button>
        <button type="button" class="hero-dot w-1.5 sm:w-2 h-1.5 sm:h-2 rounded-full bg-white/70 hover:bg-white transition-all duration-300" data-slide="2" aria-label="Go to slide 3"></button>
    </div>

</section>

<script>
    (function() {
        const track = document.getElementById('hero-slider-track');
        const dots = document.querySelectorAll('.hero-dot');
        const total = 3;
        let activeIdx = 0;
        let timer = null;

        // Responsive dot sizes
        const isSmall = window.matchMedia('(max-width: 639px)').matches;
        const activeDotW = isSmall ? 'w-6' : 'w-7';
        const inactiveDotW = isSmall ? 'w-1.5' : 'w-2';

        function goToSlide(idx) {
            activeIdx = (idx + total) % total;
            if (track) {
                track.style.transform = `translateX(-${activeIdx * 100}vw)`;
            }
            dots.forEach((dot, i) => {
                if (i === activeIdx) {
                    dot.classList.remove(inactiveDotW, 'bg-white/70');
                    dot.classList.add(activeDotW, 'bg-white');
                } else {
                    dot.classList.remove(activeDotW, 'bg-white');
                    dot.classList.add(inactiveDotW, 'bg-white/70');
                }
            });
        }

        function startTimer() {
            timer = setInterval(() => {
                goToSlide(activeIdx + 1);
            }, 5500);
        }

        function resetTimer() {
            clearInterval(timer);
            startTimer();
        }

        // Mobile Touch Swipe Handling
        let touchStartX = 0;
        let touchEndX = 0;
        let touchStartY = 0;
        let touchEndY = 0;

        track?.addEventListener('touchstart', function(e) {
            touchStartX = e.touches[0].clientX;
            touchStartY = e.touches[0].clientY;
        }, { passive: true });

        track?.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].clientX;
            touchEndY = e.changedTouches[0].clientY;
            const diffX = touchStartX - touchEndX;
            const diffY = touchStartY - touchEndY;

            // Only trigger horizontal swipe if horizontal movement > vertical
            if (Math.abs(diffX) > 40 && Math.abs(diffX) > Math.abs(diffY)) {
                if (diffX > 0) {
                    goToSlide(activeIdx + 1); // Swipe left -> Next
                } else {
                    goToSlide(activeIdx - 1); // Swipe right -> Previous
                }
                resetTimer();
            }
        }, { passive: true });

        dots.forEach(dot => {
            dot.addEventListener('click', () => {
                const idx = parseInt(dot.getAttribute('data-slide') || '0', 10);
                goToSlide(idx);
                resetTimer();
            });
        });

        startTimer();
    })();
</script>
