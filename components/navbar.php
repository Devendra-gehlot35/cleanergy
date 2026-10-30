<?php
// Determine current path for active link highlighting
$currentUri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
function isNavActive($path, $current) {
    if ($path === '/' && ($current === '/' || $current === '/index.php')) return true;
    if ($path !== '/' && strpos($current, $path) === 0) return true;
    return false;
}
?>
<!-- 1. Floating Fixed Navbar (Fully Mobile Responsive with Smooth Scroll Hide/Show) -->
<header id="site-navbar" class="fixed top-2.5 sm:top-5 md:top-6 left-0 right-0 z-50 px-3 sm:px-6 lg:px-8 pointer-events-none">
    <div class="max-w-7xl mx-auto bg-white/95 backdrop-blur-md text-slate-800 rounded-xl sm:rounded-2xl shadow-xl shadow-black/10 border border-slate-100 px-3.5 sm:px-8 md:px-10 lg:px-12 py-2 sm:py-2.5 md:py-3 flex items-center justify-between pointer-events-auto transition-all duration-300">
        
        <!-- Logo -->
        <a href="/" class="flex items-center group shrink-0">
            <img src="/assets/img/logo.png" 
                 alt="Cleanergy Battery Logo" 
                 width="320"
                 height="160"
                 class="h-[46px] sm:h-[64px] md:h-[72px] w-auto object-contain transition-transform group-hover:scale-105"
                 loading="eager"
                 fetchpriority="high">
        </a>

        <!-- Desktop Navigation Links on the Right Side -->
        <nav class="hidden md:flex items-center gap-5 lg:gap-7 text-[15px] font-semibold text-slate-700">
            <a href="/" class="transition-colors <?= isNavActive('/', $currentUri) ? 'text-cyan-600 font-bold' : 'hover:text-cyan-600' ?>">Home</a>
            <a href="/about.php" class="transition-colors <?= isNavActive('/about', $currentUri) ? 'text-cyan-600 font-bold' : 'hover:text-cyan-600' ?>">About Us</a>
            <a href="/shop.php" class="transition-colors <?= isNavActive('/shop', $currentUri) ? 'text-cyan-600 font-bold' : 'hover:text-cyan-600' ?>">Shop</a>
            <a href="/category.php" class="transition-colors <?= isNavActive('/category', $currentUri) ? 'text-cyan-600 font-bold' : 'hover:text-cyan-600' ?>">Category</a>
            <a href="/blog.php" class="transition-colors <?= isNavActive('/blog', $currentUri) ? 'text-cyan-600 font-bold' : 'hover:text-cyan-600' ?>">Blog</a>
            <a href="/faq.php" class="transition-colors <?= isNavActive('/faq', $currentUri) ? 'text-cyan-600 font-bold' : 'hover:text-cyan-600' ?>">FAQs</a>
            <a href="/contact.php" class="transition-colors <?= isNavActive('/contact', $currentUri) ? 'text-cyan-600 font-bold' : 'hover:text-cyan-600' ?>">Contact Us</a>
        </nav>

        <!-- Mobile Menu Toggle Button (Visible only on mobile/tablet) -->
        <div class="md:hidden flex items-center">
            <button id="nav-toggle-btn" type="button" aria-label="Toggle Navigation" class="text-slate-800 hover:text-cyan-600 p-2 rounded-xl bg-slate-50 border border-slate-100 focus:outline-none focus:ring-2 focus:ring-cyan-500/20 active:scale-95 transition-all">
                <!-- Hamburger Icon -->
                <svg id="hamburger-icon" class="w-6 h-6 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <!-- Close (X) Icon -->
                <svg id="close-icon" class="w-6 h-6 hidden transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

    </div>

    <!-- Mobile Dropdown Menu -->
    <div id="nav-mobile-dropdown" class="hidden md:hidden max-w-7xl mx-auto mt-2 bg-white/98 backdrop-blur-lg rounded-2xl shadow-2xl border border-slate-100 p-4 pointer-events-auto transition-all max-h-[82vh] overflow-y-auto">
        <nav class="flex flex-col gap-1 text-[15px] font-semibold text-slate-700">
            <a href="/" class="py-2.5 px-4 rounded-xl transition-colors <?= isNavActive('/', $currentUri) ? 'bg-[#d7f3fb] text-[#0e7490] font-bold' : 'hover:bg-slate-100 hover:text-cyan-600' ?>">Home</a>
            <a href="/about.php" class="py-2.5 px-4 rounded-xl transition-colors <?= isNavActive('/about', $currentUri) ? 'bg-[#d7f3fb] text-[#0e7490] font-bold' : 'hover:bg-slate-100 hover:text-cyan-600' ?>">About Us</a>
            <a href="/shop.php" class="py-2.5 px-4 rounded-xl transition-colors <?= isNavActive('/shop', $currentUri) ? 'bg-[#d7f3fb] text-[#0e7490] font-bold' : 'hover:bg-slate-100 hover:text-cyan-600' ?>">Shop</a>
            <a href="/category.php" class="py-2.5 px-4 rounded-xl transition-colors <?= isNavActive('/category', $currentUri) ? 'bg-[#d7f3fb] text-[#0e7490] font-bold' : 'hover:bg-slate-100 hover:text-cyan-600' ?>">Category</a>
            <a href="/blog.php" class="py-2.5 px-4 rounded-xl transition-colors <?= isNavActive('/blog', $currentUri) ? 'bg-[#d7f3fb] text-[#0e7490] font-bold' : 'hover:bg-slate-100 hover:text-cyan-600' ?>">Blog</a>
            <a href="/faq.php" class="py-2.5 px-4 rounded-xl transition-colors <?= isNavActive('/faq', $currentUri) ? 'bg-[#d7f3fb] text-[#0e7490] font-bold' : 'hover:bg-slate-100 hover:text-cyan-600' ?>">FAQs</a>
            <a href="/contact.php" class="py-2.5 px-4 rounded-xl transition-colors <?= isNavActive('/contact', $currentUri) ? 'bg-[#d7f3fb] text-[#0e7490] font-bold' : 'hover:bg-slate-100 hover:text-cyan-600' ?>">Contact Us</a>
        </nav>

        <!-- Quick Actions Row inside Mobile Menu -->
        <div class="mt-4 pt-3.5 border-t border-slate-100 flex flex-col gap-2">
            <a href="tel:+17347875246" class="flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 text-sm font-semibold transition-colors">
                <svg class="w-4 h-4 text-cyan-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                <span>Call: +1 (734) 787-5246</span>
            </a>
            <a href="/contact.php" class="flex items-center justify-center py-2.5 px-4 rounded-xl bg-[#12b3d6] hover:bg-[#0ea5e9] text-white text-sm font-bold shadow-sm transition-colors text-center">
                Get a Fast Quote
            </a>
        </div>
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
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const closeIcon = document.getElementById('close-icon');
        
        let lastScrollY = window.pageYOffset || document.documentElement.scrollTop;
        let ticking = false;

        function setMobileMenuOpen(open) {
            if (!navMenu) return;
            if (open) {
                navMenu.classList.remove('hidden');
                hamburgerIcon?.classList.add('hidden');
                closeIcon?.classList.remove('hidden');
            } else {
                navMenu.classList.add('hidden');
                hamburgerIcon?.classList.remove('hidden');
                closeIcon?.classList.add('hidden');
            }
        }

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
                    setMobileMenuOpen(false);
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
            const isCurrentlyHidden = navMenu?.classList.contains('hidden');
            setMobileMenuOpen(isCurrentlyHidden);
        });

        // Close mobile dropdown when a link is tapped
        navMenu?.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                setMobileMenuOpen(false);
            });
        });

        // Close dropdown when tapping anywhere outside
        document.addEventListener('click', function(e) {
            if (!navMenu?.contains(e.target) && !navBtn?.contains(e.target)) {
                setMobileMenuOpen(false);
            }
        });

        // Close dropdown on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                setMobileMenuOpen(false);
            }
        });
    })();
</script>

