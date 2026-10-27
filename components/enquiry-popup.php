<?php
// Product Enquiry Popup Modal
// Displays only when an "Enquiry" button is clicked
?>

<!-- Product Enquiry Popup Modal -->
<div id="website-enquiry-modal" 
     class="fixed inset-0 z-[9999] hidden items-center justify-center p-3 sm:p-5 md:p-6 bg-slate-950/70 backdrop-blur-sm overflow-y-auto transition-opacity duration-300"
     role="dialog" 
     aria-modal="true" 
     aria-labelledby="enquiry-modal-title">

    <!-- Modal Dialog Box -->
    <div id="enquiry-modal-card" 
         class="relative w-full max-w-lg md:max-w-4xl lg:max-w-5xl my-auto max-h-[92vh] sm:max-h-[90vh] flex flex-col md:block bg-white rounded-2xl sm:rounded-3xl shadow-2xl overflow-hidden border border-slate-100 transform transition-all duration-300 scale-95 opacity-0">
        
        <!-- Close Button (Top-Right) -->
        <button type="button" 
                onclick="closeEnquiryModal()" 
                aria-label="Close Modal" 
                class="absolute top-3 right-3 sm:top-4 sm:right-4 z-30 w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-white/95 sm:bg-slate-100 hover:bg-slate-200 text-slate-700 hover:text-slate-900 flex items-center justify-center transition-all shadow-md sm:shadow-sm focus:outline-none cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <div class="grid grid-cols-1 md:grid-cols-12 items-stretch overflow-y-auto md:overflow-visible max-h-[92vh] sm:max-h-[90vh] md:max-h-none md:min-h-[500px] w-full">
            
            <!-- Left Side: Dynamic Product Battery Image (Responsive banner on mobile/tablet, full column on desktop) -->
            <div class="relative md:col-span-5 w-full h-32 xs:h-36 sm:h-44 md:h-auto md:min-h-full shrink-0 overflow-hidden bg-slate-900">
                <img id="enquiry-modal-img" 
                     src="/assets/img/homestorage.png" 
                     data-default-src="/assets/img/homestorage.png"
                     alt="Cleanergy Lithium Battery" 
                     class="w-full h-full object-cover object-center block">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 to-transparent md:hidden"></div>
            </div>

            <!-- Right Side: Contact Inputs Form -->
            <div class="md:col-span-7 p-4 sm:p-6 md:p-8 lg:p-10 flex flex-col justify-center bg-white">
                
                <!-- Heading & Selected Battery Name -->
                <div class="mb-3.5 sm:mb-5">
                    <h3 id="enquiry-modal-title" class="text-lg sm:text-xl md:text-2xl font-extrabold text-slate-900 tracking-tight leading-snug sm:leading-tight">
                        Get In Touch With Our Specialists
                    </h3>
                    
                    <!-- Battery Name Directly Under Heading -->
                    <div class="mt-2 sm:mt-2.5 inline-flex items-center px-3 py-1 sm:px-3.5 sm:py-1.5 rounded-lg sm:rounded-xl bg-emerald-50 border border-emerald-200/80 text-[#239B52] text-[11px] sm:text-xs md:text-sm font-bold">
                        <span id="enquiry-product-name-text">Cleanergy Battery System</span>
                    </div>
                </div>

                <!-- Form (Only Name, Mobile, Email) -->
                <form id="enquiry-popup-form" onsubmit="handleEnquirySubmit(event)" class="space-y-3 sm:space-y-4">
                    
                    <!-- Hidden input carrying the selected product name -->
                    <input type="hidden" name="product" id="enquiry-product-input" value="">

                    <!-- 1. Name Input -->
                    <div>
                        <label for="enquiry-name" class="block text-[11px] sm:text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 sm:mb-1.5">
                            Your Name <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" 
                                id="enquiry-name" 
                                name="name" 
                                required 
                                placeholder="e.g. John Anderson" 
                                class="w-full px-3.5 py-2 sm:px-4 sm:py-2.5 rounded-lg sm:rounded-xl border border-slate-200 text-slate-900 text-xs sm:text-sm focus:border-[#12b3d6] focus:ring-2 focus:ring-[#12b3d6]/20 outline-none transition-all">
                    </div>

                    <!-- 2. Mobile Number Input -->
                    <div>
                        <label for="enquiry-phone" class="block text-[11px] sm:text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Mobile Number <span class="text-rose-500">*</span>
                        </label>
                        <input type="tel" 
                                id="enquiry-phone" 
                                name="phone" 
                                required 
                                placeholder="e.g. +1 (555) 234-5678" 
                                class="w-full px-3.5 py-2 sm:px-4 sm:py-2.5 rounded-lg sm:rounded-xl border border-slate-200 text-slate-900 text-xs sm:text-sm focus:border-[#12b3d6] focus:ring-2 focus:ring-[#12b3d6]/20 outline-none transition-all">
                    </div>

                    <!-- 3. Email Input -->
                    <div>
                        <label for="enquiry-email" class="block text-[11px] sm:text-xs font-bold text-slate-700 uppercase tracking-wider mb-1 sm:mb-1.5">
                            Email <span class="text-rose-500">*</span>
                        </label>
                        <input type="email" 
                                id="enquiry-email" 
                                name="email" 
                                required 
                                placeholder="e.g. name@gmail.com" 
                                class="w-full px-3.5 py-2 sm:px-4 sm:py-2.5 rounded-lg sm:rounded-xl border border-slate-200 text-slate-900 text-xs sm:text-sm focus:border-[#12b3d6] focus:ring-2 focus:ring-[#12b3d6]/20 outline-none transition-all">
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-1 sm:pt-2">
                        <button type="submit" 
                                id="enquiry-submit-btn" 
                                class="w-full py-2.5 sm:py-3.5 px-5 sm:px-6 rounded-full bg-[#12b3d6] hover:bg-[#0ea5e9] text-white font-bold text-xs sm:text-sm md:text-base shadow-sm hover:shadow-md transition-all active:scale-[0.99] cursor-pointer flex items-center justify-center gap-2">
                            <span>Submit Enquiry</span>
                            <span>→</span>
                        </button>
                    </div>

                    <!-- Success Message Alert (Hidden by default) -->
                    <div id="enquiry-success-msg" class="hidden p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm font-semibold text-center">
                        ✓ Thank you! Your enquiry has been received. Our team will contact you shortly.
                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<!-- Enquiry Modal Control Script -->
<script>
function openEnquiryModal(productName = '', productImg = '') {
    const modal = document.getElementById('website-enquiry-modal');
    const card = document.getElementById('enquiry-modal-card');
    const form = document.getElementById('enquiry-popup-form');
    const btn = document.getElementById('enquiry-submit-btn');
    const successMsg = document.getElementById('enquiry-success-msg');
    const prodTitleEl = document.getElementById('enquiry-product-name-text');
    const prodInput = document.getElementById('enquiry-product-input');
    const modalImg = document.getElementById('enquiry-modal-img');

    if (!modal || !card) return;

    // Reset previous submit state
    if (btn) {
        btn.disabled = false;
        btn.classList.remove('hidden');
        btn.innerHTML = '<span>Submit Enquiry</span><span>→</span>';
    }
    if (successMsg) {
        successMsg.classList.add('hidden');
    }

    // Set Product Name under Heading and in hidden input
    const displayName = (productName || 'Cleanergy Battery System').trim();
    if (prodTitleEl) {
        prodTitleEl.textContent = displayName;
    }
    if (prodInput) {
        prodInput.value = displayName;
    }

    // Set specific product image on left side
    if (modalImg) {
        if (productImg && productImg.trim() !== '') {
            modalImg.src = productImg;
        } else if (modalImg.getAttribute('data-default-src')) {
            modalImg.src = modalImg.getAttribute('data-default-src');
        }
    }

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    // Smooth transition
    requestAnimationFrame(() => {
        card.classList.remove('scale-95', 'opacity-0');
        card.classList.add('scale-100', 'opacity-100');
    });
}

function closeEnquiryModal() {
    const modal = document.getElementById('website-enquiry-modal');
    const card = document.getElementById('enquiry-modal-card');
    if (!modal || !card) return;

    card.classList.remove('scale-100', 'opacity-100');
    card.classList.add('scale-95', 'opacity-0');

    setTimeout(() => {
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }, 250);
}

// Close when clicking outside on backdrop
document.addEventListener('click', function(e) {
    const modal = document.getElementById('website-enquiry-modal');
    if (modal && !modal.classList.contains('hidden') && e.target === modal) {
        closeEnquiryModal();
    }
});

// Close when pressing Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeEnquiryModal();
    }
});

// Global Click Delegation for all Enquiry & Get a Quote buttons across all pages
document.addEventListener('click', function(e) {
    const el = e.target.closest('a, button');
    if (!el) return;

    const text = (el.textContent || '').trim().toLowerCase();
    const href = el.getAttribute('href') || '';
    const isEnquiryOrQuoteBtn = el.hasAttribute('data-enquiry-btn') || 
                                el.hasAttribute('data-quote-btn') ||
                                text === 'enquiry' || 
                                text === 'enquiry now' || 
                                text === 'enquire' || 
                                text === 'enquire now' || 
                                text === 'get a quote' ||
                                text === 'get quote' ||
                                text.includes('get a quote') ||
                                text.includes('get quote') ||
                                href === '#quote' ||
                                href.includes('#quote') ||
                                (href.includes('#contact') && (text.includes('enquiry') || text.includes('quote')));

    if (isEnquiryOrQuoteBtn) {
        e.preventDefault();

        // Extract product name and image if within a card
        let prodName = el.getAttribute('data-product-title') || '';
        let prodImg = el.getAttribute('data-product-image') || '';

        if (!prodName) {
            const card = el.closest('article, .product-card, div.rounded-3xl, div.rounded-2xl, div.border');
            if (card) {
                const titleEl = card.querySelector('h2, h3, h4, .product-title');
                if (titleEl) prodName = titleEl.textContent.trim();

                const imgEl = card.querySelector('img');
                if (imgEl) prodImg = imgEl.src;
            }
        }

        if (!prodName) {
            if (text.includes('quote') || href.includes('quote')) {
                prodName = 'Custom Battery Quote';
            } else {
                prodName = 'Cleanergy Battery System';
            }
        }

        openEnquiryModal(prodName, prodImg);
    }
});

// Form Submission Handler
function handleEnquirySubmit(e) {
    e.preventDefault();
    const btn = document.getElementById('enquiry-submit-btn');
    const successMsg = document.getElementById('enquiry-success-msg');
    
    if (btn) {
        btn.disabled = true;
        btn.innerHTML = 'Sending...';
    }

    setTimeout(() => {
        if (btn) btn.classList.add('hidden');
        if (successMsg) successMsg.classList.remove('hidden');

        // Automatically close after 2.5 seconds
        setTimeout(() => {
            closeEnquiryModal();
        }, 2500);
    }, 700);
}
</script>
