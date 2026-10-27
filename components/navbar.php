<!-- 1. Floating Fixed Navbar (Fully Mobile Responsive) -->
<header class="fixed top-3 sm:top-5 md:top-6 left-0 right-0 z-50 px-3 sm:px-6 lg:px-8 pointer-events-none">
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

<script>
    (function() {
        const navBtn = document.getElementById('nav-toggle-btn');
        const navMenu = document.getElementById('nav-mobile-dropdown');
        
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
