<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - Cleanergy Battery</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,700;1,800;1,900&family=Playfair+Display:ital,wght@1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/dist/output.css?v=<?= filemtime(__DIR__ . '/dist/output.css') ?>">
</head>
<body class="bg-white font-['Plus_Jakarta_Sans',sans-serif] text-slate-900 min-h-screen flex flex-col justify-between overflow-x-hidden max-w-full">

    <?php
    // Include Fixed Floating Navbar
    include __DIR__ . '/components/navbar.php';
    ?>

    <!-- 1. Hero Banner (Centered Title, Cleanergy Gradient matching site style) -->
    <section class="relative w-full min-h-[460px] sm:min-h-[520px] overflow-hidden flex items-center justify-center text-center"
             style="background: linear-gradient(135deg, #74d5e9 0%, #4ec1db 50%, #30b1cf 100%);">
        
        <!-- Soft Marine / Water Background Overlay -->
        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=2070&q=80" 
             alt="Clean Energy Water Background" 
             class="absolute inset-0 w-full h-full object-cover object-center mix-blend-overlay opacity-30">
        
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 z-10 pt-28 sm:pt-36 pb-16 text-center">
            
            <!-- Category Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/20 backdrop-blur-md text-slate-900 text-xs sm:text-sm font-semibold mb-4 mx-auto">
                Data Protection
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-tight mb-4">
                Privacy <span class="italic font-['Playfair_Display',serif] text-slate-800">Policy</span>
            </h1>

            <p class="text-slate-800 text-sm sm:text-base lg:text-lg max-w-2xl mx-auto leading-relaxed">
                Your privacy is paramount. Learn how Cleanergy LLC collects, uses, protects, and handles your personal information.
            </p>

        </div>
    </section>

    <!-- 2. Centered Content Section -->
    <main class="flex-1 w-full bg-white text-slate-900 py-16 sm:py-24">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            
            <div class="space-y-12 sm:space-y-16">

                <!-- Section 1 -->
                <div class="max-w-3xl mx-auto">
                    <div class="w-12 h-1 bg-[#12b3d6] rounded-full mx-auto mb-4"></div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mb-4 tracking-tight">
                        1. Information We Collect
                    </h2>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                        When you visit our site, submit an inquiry form, or purchase a battery product, we may collect personal details including your name, email address, phone number, shipping address, and product configuration preferences to fulfill your order and provide technical assistance.
                    </p>
                </div>

                <!-- Section 2 -->
                <div class="max-w-3xl mx-auto">
                    <div class="w-12 h-1 bg-[#239B52] rounded-full mx-auto mb-4"></div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mb-4 tracking-tight">
                        2. How We Use Your Information
                    </h2>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                        We use the information we collect to respond to your battery quotes, process product inquiries, provide technical support for sizing and installation, improve our digital platform, and send critical safety updates regarding our power storage products.
                    </p>
                </div>

                <!-- Section 3 -->
                <div class="max-w-3xl mx-auto">
                    <div class="w-12 h-1 bg-[#12b3d6] rounded-full mx-auto mb-4"></div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mb-4 tracking-tight">
                        3. Data Protection &amp; Security
                    </h2>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                        We implement stringent security measures to maintain the safety of your personal data. All sensitive communications and payment information are transmitted via Secure Socket Layer (SSL) technology and encrypted within our secure databases.
                    </p>
                </div>

                <!-- Section 4 -->
                <div class="max-w-3xl mx-auto">
                    <div class="w-12 h-1 bg-[#239B52] rounded-full mx-auto mb-4"></div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mb-4 tracking-tight">
                        4. Cookies &amp; Tracking Technologies
                    </h2>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                        Our website uses essential cookies to understand your browsing preferences and enhance site performance. You may choose to disable cookies through your browser settings, though some interactive features may operate with reduced functionality.
                    </p>
                </div>

                <!-- Section 5 -->
                <div class="max-w-3xl mx-auto">
                    <div class="w-12 h-1 bg-[#12b3d6] rounded-full mx-auto mb-4"></div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mb-4 tracking-tight">
                        5. Third-Party Disclosure
                    </h2>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                        We do not sell, trade, or transfer your personally identifiable information to outside parties. This does not include trusted website hosting partners and freight logistics providers who assist us in delivering our heavy lithium battery systems.
                    </p>
                </div>

                <!-- Section 6: Contact Box -->
                <div class="max-w-xl mx-auto p-8 rounded-3xl bg-[#f0fbfd] border border-[#caeff6] text-center shadow-xs">
                    <h3 class="text-lg sm:text-xl font-bold text-slate-900 mb-2">
                        Privacy Inquiries
                    </h3>
                    <p class="text-slate-600 text-xs sm:text-sm mb-5 leading-relaxed">
                        If you have questions regarding this privacy policy or your stored information, contact our privacy officer.
                    </p>
                    <a href="/contact.php" class="inline-flex items-center justify-center px-8 py-3 rounded-full bg-[#12b3d6] hover:bg-[#0ea5e9] text-white text-sm font-bold shadow-sm transition-all duration-200">
                        Contact Cleanergy
                    </a>
                </div>

            </div>

        </div>
    </main>

    <?php
    // Include Footer
    include __DIR__ . '/components/footer.php';
    ?>

</body>
</html>
