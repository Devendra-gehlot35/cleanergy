<!-- 14. Get in Touch / Contact Us Section (Matching FAQ Width max-w-7xl) -->
<section id="contact" class="bg-white py-12 sm:py-16 lg:py-20 text-slate-900 border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-center">
            
            <!-- Left Column: Quick Contact Form (6 cols) -->
            <div class="lg:col-span-6 bg-white rounded-3xl p-5 sm:p-7 shadow-sm"
                 style="border: 1.5px solid #a5d6aa;">
                
                <!-- Form Header -->
                <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight leading-tight mb-5">
                    Quick <span class="text-[#82b89a]">Contact Form</span>
                </h3>

                <!-- Form Inputs -->
                <form action="#submit" method="POST" class="space-y-3.5" onsubmit="event.preventDefault(); alert('Thank you for reaching out! A Cleanergy expert will get back to you shortly.');">
                    
                    <!-- Name Input -->
                    <div>
                        <input type="text" 
                               name="name" 
                               placeholder="Name" 
                               required
                               class="w-full px-4 py-3 sm:py-3.5 rounded-xl bg-white text-slate-900 placeholder-slate-400 text-sm transition-colors focus:outline-none focus:ring-2 focus:ring-[#41aa57]"
                               style="border: 1.5px solid #a5d6aa;">
                    </div>

                    <!-- Email Input -->
                    <div>
                        <input type="email" 
                               name="email" 
                               placeholder="Email" 
                               required
                               class="w-full px-4 py-3 sm:py-3.5 rounded-xl bg-white text-slate-900 placeholder-slate-400 text-sm transition-colors focus:outline-none focus:ring-2 focus:ring-[#41aa57]"
                               style="border: 1.5px solid #a5d6aa;">
                    </div>

                    <!-- Phone Number Input -->
                    <div>
                        <input type="tel" 
                               name="phone" 
                               placeholder="Phone Number" 
                               class="w-full px-4 py-3 sm:py-3.5 rounded-xl bg-white text-slate-900 placeholder-slate-400 text-sm transition-colors focus:outline-none focus:ring-2 focus:ring-[#41aa57]"
                               style="border: 1.5px solid #a5d6aa;">
                    </div>

                    <!-- Message Textarea -->
                    <div>
                        <textarea name="message" 
                                  rows="3" 
                                  placeholder="Message" 
                                  required
                                  class="w-full px-4 py-3 sm:py-3.5 rounded-xl bg-white text-slate-900 placeholder-slate-400 text-sm transition-colors focus:outline-none focus:ring-2 focus:ring-[#41aa57] resize-none"
                                  style="border: 1.5px solid #a5d6aa;"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-1">
                        <button type="submit" 
                                class="w-full py-3.5 rounded-xl bg-[#41aa57] hover:bg-[#36954b] text-white font-bold text-base shadow-sm transition-all duration-200 cursor-pointer">
                            Submit
                        </button>
                    </div>

                </form>

            </div>

            <!-- Right Column: Info & Details (6 cols) -->
            <div class="lg:col-span-6 flex flex-col justify-center">
                
                <!-- Pill Badge -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#cbf4d8] text-slate-800 text-xs font-medium w-fit mb-3">
                    Get in Touch
                </div>

                <!-- Main Heading -->
                <h2 class="text-xl sm:text-2xl lg:text-[28px] font-extrabold text-slate-900 leading-[1.25] tracking-tight mb-2">
                    Talk to a Battery <span class="text-[#82b89a]">Expert Today</span>
                </h2>

                <!-- Subtitle Description -->
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed mb-6 max-w-lg">
                    Tell us your application, voltage and runtime needs. Our battery experts will recommend the best option and send you a quote.
                </p>

                <!-- 3 Contact Cards Stacked -->
                <div class="space-y-3">
                    
                    <!-- Card 1: Address -->
                    <div class="bg-white rounded-2xl p-3.5 sm:p-4 flex items-center gap-4 transition-all duration-300 hover:shadow-md"
                         style="border: 1.5px solid #a5d6aa;">
                        <!-- Soft Green Icon Box -->
                        <div class="w-12 h-12 rounded-xl bg-[#cbf4d8] shrink-0 flex items-center justify-center">
                            <svg class="w-5 h-5 text-[#2f855a]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm sm:text-base mb-0.5">Address</h4>
                            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                                4750 Venture Drive, Suite 400, Ann Arbor, MI 48108
                            </p>
                        </div>
                    </div>

                    <!-- Card 2: Contact -->
                    <a href="tel:+17347875246" 
                       class="bg-white rounded-2xl p-3.5 sm:p-4 flex items-center gap-4 transition-all duration-300 hover:shadow-md group block cursor-pointer"
                       style="border: 1.5px solid #a5d6aa;">
                        <!-- Soft Green Icon Box -->
                        <div class="w-12 h-12 rounded-xl bg-[#cbf4d8] group-hover:bg-[#b2eac2] shrink-0 flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5 text-[#2f855a]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm sm:text-base mb-0.5">Contact</h4>
                            <span class="text-slate-600 text-xs sm:text-sm group-hover:text-[#41aa57] transition-colors">
                                +1 (734) 787-5246
                            </span>
                        </div>
                    </a>

                    <!-- Card 3: Email -->
                    <a href="mailto:customercare@cleanergy.us" 
                       class="bg-white rounded-2xl p-3.5 sm:p-4 flex items-center gap-4 transition-all duration-300 hover:shadow-md group block cursor-pointer"
                       style="border: 1.5px solid #a5d6aa;">
                        <!-- Soft Green Icon Box -->
                        <div class="w-12 h-12 rounded-xl bg-[#cbf4d8] group-hover:bg-[#b2eac2] shrink-0 flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5 text-[#2f855a]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm sm:text-base mb-0.5">Email</h4>
                            <span class="text-slate-600 text-xs sm:text-sm group-hover:text-[#41aa57] transition-colors">
                                customercare@cleanergy.us
                            </span>
                        </div>
                    </a>

                </div>

            </div>

        </div>

    </div>
</section>
