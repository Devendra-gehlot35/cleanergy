<!-- 1. Floating Fixed Navbar (Fully Mobile Responsive with Smooth Scroll Hide/Show) -->
<header id="site-navbar" class="fixed top-3 sm:top-5 md:top-6 left-0 right-0 z-50 px-3 sm:px-6 lg:px-8 pointer-events-none">
    <div class="max-w-7xl mx-auto bg-white/95 backdrop-blur-md text-slate-800 rounded-xl sm:rounded-2xl shadow-xl shadow-black/10 border border-slate-100 px-4 sm:px-8 md:px-10 lg:px-12 py-2 sm:py-2.5 md:py-3 flex items-center justify-between pointer-events-auto transition-all duration-300">
        
        <!-- Logo -->
        <a href="/" class="flex items-center group">
            <img src="https://cleanergybattery.com/cdn/shop/files/Logo-of-cleanergy-transparent_f56c8e49-d76a-482d-bf49-716e5b7c4da5.png?height=160&v=1784631413" 
                 alt="Cleanergy Battery Logo" 
                 class="h-[52px] sm:h-[66px] md:h-[75px] w-auto object-contain transition-transform group-hover:scale-105">
        </a>

        <!-- Desktop Navigation Links on the Right Side -->
        <nav class="hidden md:flex items-center gap-5 lg:gap-7 text-[15px] font-semibold text-slate-700">
            <a href="/" class="hover:text-cyan-600 transition-colors">Home</a>
            <a href="/about.php" class="hover:text-cyan-600 transition-colors">About Us</a>
            <a href="/shop.php" class="hover:text-cyan-600 transition-colors">Shop</a>
            <a href="/category.php" class="hover:text-cyan-600 transition-colors">Category</a>
            <a href="/blog.php" class="hover:text-cyan-600 transition-colors">Blog</a>
            <a href="/faq.php" class="hover:text-cyan-600 transition-colors">FAQs</a>
            <a href="/contact.php" class="hover:text-cyan-600 transition-colors">Contact Us</a>
        </nav>

        <!-- Mobile Menu Toggle Button (Visible only on mobile/tablet) -->
        <div class="md:hidden flex items-center">
            <button id="nav-toggle-btn" type="button" aria-label="Toggle Navigation" class="text-slate-800 hover:text-cyan-600 p-1.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500/20 active:scale-95 transition-all">
                <svg id="hamburger-icon" class="w-6 h-6 transition-transform" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

    </div>

    <!-- Mobile Dropdown Menu -->
    <div id="nav-mobile-dropdown" class="hidden md:hidden max-w-7xl mx-auto mt-2 bg-white/98 backdrop-blur-lg rounded-2xl shadow-2xl border border-slate-100 p-4 pointer-events-auto transition-all">
        <nav class="flex flex-col gap-1 font-semibold text-slate-700">
            <a href="/" class="py-2.5 px-4 rounded-xl hover:bg-slate-100 hover:text-cyan-600 transition-colors">Home</a>
            <a href="/about.php" class="py-2.5 px-4 rounded-xl hover:bg-slate-100 hover:text-cyan-600 transition-colors">About Us</a>
            <a href="/shop.php" class="py-2.5 px-4 rounded-xl hover:bg-slate-100 hover:text-cyan-600 transition-colors">Shop</a>
            <a href="/category.php" class="py-2.5 px-4 rounded-xl hover:bg-slate-100 hover:text-cyan-600 transition-colors">Category</a>
            <a href="/blog.php" class="py-2.5 px-4 rounded-xl hover:bg-slate-100 hover:text-cyan-600 transition-colors">Blog</a>
            <a href="/faq.php" class="py-2.5 px-4 rounded-xl hover:bg-slate-100 hover:text-cyan-600 transition-colors">FAQs</a>
            <a href="/contact.php" class="py-2.5 px-4 rounded-xl hover:bg-slate-100 hover:text-cyan-600 transition-colors">Contact Us</a>
        </nav>
    </div>
</header>

<!-- Smooth, hardware-accelerated Scroll Hide/Show Styles -->
<style>
    #site-navbar {
        transition: transform 0.3s cubic-bezier(0.2, 0.8, 0.2, 1);
        will-change: transform;
    }
    #site-navbar.navbar--hidden {
        transform: translateY(calc(-100% - 3rem));
    }
</style>

<script>
    (function() {
        const header = document.getElementById('site-navbar');
        const navBtn = document.getElementById('nav-toggle-btn');
        const navMenu = document.getElementById('nav-mobile-dropdown');
        
        let lastScrollY = window.pageYOffset || document.documentElement.scrollTop;
        let ticking = false;

        function updateNavbar() {
            const currentScrollY = window.pageYOffset || document.documentElement.scrollTop;

            // Always keep navbar visible when at the top of the page
            if (currentScrollY <= 20) {
                header?.classList.remove('navbar--hidden');
                lastScrollY = currentScrollY <= 0 ? 0 : currentScrollY;
                ticking = false;
                return;
            }

            // Scroll delta check to avoid micro-jitter
            const delta = currentScrollY - lastScrollY;

            if (Math.abs(delta) > 6) {
                if (delta > 0 && currentScrollY > 80) {
                    // Scrolling DOWN -> Smoothly hide navbar
                    header?.classList.add('navbar--hidden');
                    // Close mobile dropdown if currently open
                    if (navMenu && !navMenu.classList.contains('hidden')) {
                        navMenu.classList.add('hidden');
                    }
                } else if (delta < 0) {
                    // Scrolling UP -> Smoothly reveal navbar
                    header?.classList.remove('navbar--hidden');
                }
                lastScrollY = currentScrollY;
            }

            ticking = false;
        }

        window.addEventListener('scroll', function() {
            if (!ticking) {
                window.requestAnimationFrame(updateNavbar);
                ticking = true;
            }
        }, { passive: true });

        navBtn?.addEventListener('click', function(e) {
            e.stopPropagation();
            navMenu?.classList.toggle('hidden');
        });

        // Close mobile dropdown when a link is tapped
        navMenu?.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.add('hidden');
            });
        });

        // Close dropdown when tapping anywhere outside
        document.addEventListener('click', function(e) {
            if (!navMenu?.contains(e.target) && !navBtn?.contains(e.target)) {
                navMenu?.classList.add('hidden');
            }
        });
    })();
</script>
