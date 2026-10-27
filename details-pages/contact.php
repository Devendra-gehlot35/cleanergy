<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Battery Installation and Repair Experts – Cleanergy Battery</title>
    <meta name="description" content="Get in touch with the Cleanergy Battery team. We supply LiFePO4 and sodium-ion batteries for RV, marine, solar, and off-grid applications. Contact us today.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,700;1,800;1,900&family=Playfair+Display:ital,wght@1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/dist/output.css?v=<?= filemtime(__DIR__ . '/../dist/output.css') ?>">
</head>
<body class="bg-white font-['Plus_Jakarta_Sans',sans-serif] text-slate-900 min-h-screen flex flex-col justify-between">

    <?php
    // Include Fixed Floating Navbar
    include __DIR__ . '/../components/navbar.php';
    ?>

    <!-- 1. Hero Banner (Natural Image without Blue Overlay) -->
    <section class="relative w-full min-h-[580px] sm:min-h-[660px] h-[92vh] sm:h-screen max-h-[1000px] overflow-hidden flex items-center justify-center text-center bg-slate-900">
        
        <!-- Clean Background Image (No blue tint / overlay) -->
        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=2070&q=80" 
             alt="Clean Energy Water Background" 
             class="absolute inset-0 w-full h-full object-cover object-center">
        
        <!-- Subtle Neutral Tint for Clean Text Readability (No blue) -->
        <div class="absolute inset-0 bg-black/25"></div>

        <!-- Big Centered "Contact Us" Title (Exact PDF Match) -->
        <div class="relative z-10 px-4 pt-16">
            <h1 class="text-5xl sm:text-7xl lg:text-8xl font-black text-white italic tracking-wide drop-shadow-[0_4px_16px_rgba(0,0,0,0.5)]">
                Contact Us
            </h1>
        </div>
    </section>

    <!-- 2. Main Contact Form & Details Section (Exact PDF Match) -->
    <main class="flex-1 py-16 sm:py-20 lg:py-24 bg-white text-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start mb-16 sm:mb-20">
                
                <!-- Left Column: Form Section (7 cols on lg) -->
                <div class="lg:col-span-7 flex flex-col">
                    
                    <!-- Pill Badge -->
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#d7f3fb] text-slate-800 text-xs sm:text-sm font-semibold w-fit mb-4">
                        Get in touch
                    </div>

                    <!-- Main Heading -->
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 leading-tight tracking-tight mb-8">
                        We're Here to Help You <span style="color: #12b3d6;">Choose the Right Battery</span>
                    </h2>

                    <!-- Contact Form -->
                    <form action="#submit" method="POST" class="space-y-4" onsubmit="event.preventDefault(); alert('Thank you for contacting Cleanergy! Our battery specialists will get back to you shortly.');">
                        
                        <!-- Name Input -->
                        <div>
                            <input type="text" 
                                   name="name" 
                                   placeholder="Name" 
                                   required
                                   class="w-full px-5 py-4 rounded-xl sm:rounded-2xl bg-white text-slate-900 placeholder-slate-400 text-sm sm:text-base border border-slate-200 focus:outline-none focus:border-[#12b3d6] focus:ring-2 focus:ring-[#12b3d6]/20 transition-all shadow-xs">
                        </div>

                        <!-- Email Input -->
                        <div>
                            <input type="email" 
                                   name="email" 
                                   placeholder="Email" 
                                   required
                                   class="w-full px-5 py-4 rounded-xl sm:rounded-2xl bg-white text-slate-900 placeholder-slate-400 text-sm sm:text-base border border-slate-200 focus:outline-none focus:border-[#12b3d6] focus:ring-2 focus:ring-[#12b3d6]/20 transition-all shadow-xs">
                        </div>

                        <!-- Phone Input -->
                        <div>
                            <input type="tel" 
                                   name="phone" 
                                   placeholder="Phone" 
                                   class="w-full px-5 py-4 rounded-xl sm:rounded-2xl bg-white text-slate-900 placeholder-slate-400 text-sm sm:text-base border border-slate-200 focus:outline-none focus:border-[#12b3d6] focus:ring-2 focus:ring-[#12b3d6]/20 transition-all shadow-xs">
                        </div>

                        <!-- Message Textarea -->
                        <div>
                            <textarea name="message" 
                                      rows="4" 
                                      placeholder="Message" 
                                      required
                                      class="w-full px-5 py-4 rounded-xl sm:rounded-2xl bg-white text-slate-900 placeholder-slate-400 text-sm sm:text-base border border-slate-200 focus:outline-none focus:border-[#12b3d6] focus:ring-2 focus:ring-[#12b3d6]/20 transition-all shadow-xs resize-none"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button type="submit" 
                                    class="w-full py-4 rounded-full text-white font-bold text-base shadow-md hover:shadow-lg transition-all cursor-pointer"
                                    style="background-color: #12b3d6;">
                                Submit
                            </button>
                        </div>

                    </form>

                </div>

                <!-- Right Column: 3 Contact Info Cards (5 cols on lg) -->
                <div class="lg:col-span-5 flex flex-col space-y-5 lg:pt-14">
                    
                    <!-- Card 1: Address (Soft Cyan Background matching PDF) -->
                    <div class="rounded-2xl sm:rounded-3xl p-5 sm:p-6 flex items-center gap-5 shadow-xs transition-all hover:shadow-md"
                         style="background-color: #EDFAFC;">
                        <!-- Cyan Icon Square -->
                        <div class="w-14 h-14 rounded-2xl bg-[#a2d2df] flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 text-[#0369a1]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-extrabold text-base sm:text-lg mb-1" style="color: #12b3d6;">Address</h4>
                            <p class="text-slate-800 font-semibold text-xs sm:text-sm leading-snug">
                                4750 Venture Drive, Suite 400,<br>Ann Arbor, MI 48108
                            </p>
                        </div>
                    </div>

                    <!-- Card 2: Contact (Soft Cyan Background matching Address & Email) -->
                    <a href="tel:+17347875246" 
                       class="rounded-2xl sm:rounded-3xl p-5 sm:p-6 flex items-center gap-5 shadow-xs transition-all hover:shadow-md group block cursor-pointer"
                       style="background-color: #EDFAFC;">
                        <!-- Cyan Icon Square -->
                        <div class="w-14 h-14 rounded-2xl bg-[#a2d2df] group-hover:bg-[#8ec7d6] flex items-center justify-center shrink-0 transition-colors">
                            <svg class="w-6 h-6 text-[#0369a1]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-extrabold text-base sm:text-lg mb-1" style="color: #12b3d6;">Contact</h4>
                            <span class="text-slate-800 font-semibold text-xs sm:text-sm group-hover:text-cyan-700 transition-colors">
                                +1 (734) 787-5246
                            </span>
                        </div>
                    </a>

                    <!-- Card 3: Email (Soft Cyan Background matching PDF) -->
                    <a href="mailto:customercare@cleanergy.us" 
                       class="rounded-2xl sm:rounded-3xl p-5 sm:p-6 flex items-center gap-5 shadow-xs transition-all hover:shadow-md group block cursor-pointer"
                       style="background-color: #EDFAFC;">
                        <!-- Cyan Icon Square -->
                        <div class="w-14 h-14 rounded-2xl bg-[#a2d2df] group-hover:bg-[#8ec7d6] flex items-center justify-center shrink-0 transition-colors">
                            <svg class="w-6 h-6 text-[#0369a1]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-extrabold text-base sm:text-lg mb-1" style="color: #12b3d6;">Email</h4>
                            <span class="text-slate-800 font-semibold text-xs sm:text-sm group-hover:text-cyan-700 transition-colors">
                                customercare@cleanergy.us
                            </span>
                        </div>
                    </a>

                </div>

            </div>

            <!-- 3. Map Section (Exact PDF Match) -->
            <div class="w-full">
                <!-- Section Subtitle / Header -->
                <div class="mb-6 text-center">
                    <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">
                        Map
                    </h3>
                </div>

                <!-- Google Map Responsive Iframe Container -->
                <div class="w-full h-[380px] sm:h-[460px] rounded-3xl overflow-hidden shadow-lg border border-slate-100">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2954.1085352349787!2d-83.74317922378906!3d42.22283084310547!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x883cae2292f74151%3A0xe5417e0892095f36!2s4750%20Venture%20Dr%20%23400%2C%20Ann%20Arbor%2C%20MI%2048108!5e0!3m2!1sen!2sus!4v1700000000000!5m2!1sen!2sus" 
                        class="w-full h-full border-0" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

        </div>
    </main>

    <?php
    // Include Footer
    include __DIR__ . '/../components/footer.php';
    ?>

</body>
</html>
