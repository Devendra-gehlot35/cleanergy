<?php
// Floating Quick Contact Widget (Fixed bottom-right, round button with slide-up Call and Mail icons only)
?>

<!-- Floating Quick Contact Widget -->
<div id="floating-contact-widget" class="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 z-[9990] flex flex-col items-center">
    
    <!-- Slide-Up Speed Dial Buttons (Call & Mail Circular Icons Only) -->
    <div id="floating-contact-menu" 
         class="mb-3 flex flex-col items-center gap-3 transform transition-all duration-300 ease-out origin-bottom translate-y-3 opacity-0 pointer-events-none scale-90">
        
        <!-- 1. Call Circular Icon -->
        <a href="tel:+17347875246" 
           title="Call: +1 (734) 787-5246"
           aria-label="Call Us"
           class="w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-[#12b3d6] hover:bg-[#0ea5e9] text-white shadow-lg flex items-center justify-center transition-all duration-200 hover:scale-110 active:scale-95 cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
            </svg>
        </a>

        <!-- 2. Mail Circular Icon -->
        <a href="mailto:customercare@cleanergy.us" 
           title="Mail: customercare@cleanergy.us"
           aria-label="Mail Us"
           class="w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-[#12b3d6] hover:bg-[#0ea5e9] text-white shadow-lg flex items-center justify-center transition-all duration-200 hover:scale-110 active:scale-95 cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </a>

    </div>

    <!-- Main Circular Fixed Trigger Button -->
    <button type="button" 
            id="floating-contact-btn" 
            onclick="toggleFloatingContact()" 
            aria-label="Contact Us Options" 
            class="w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-[#12b3d6] hover:bg-[#0ea5e9] text-white shadow-xl hover:shadow-cyan-500/35 flex items-center justify-center transition-all duration-300 active:scale-95 cursor-pointer focus:outline-none">
        
        <!-- Chat Icon (Default) -->
        <svg id="floating-chat-icon" class="w-5 h-5 sm:w-6 sm:h-6 transition-all duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
        </svg>

        <!-- Close (✕) Icon (Active State) -->
        <svg id="floating-close-icon" class="w-5 h-5 sm:w-6 sm:h-6 hidden transition-all duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>

    </button>

</div>

<!-- Toggle Logic -->
<script>
function toggleFloatingContact() {
    const menu = document.getElementById('floating-contact-menu');
    const chatIcon = document.getElementById('floating-chat-icon');
    const closeIcon = document.getElementById('floating-close-icon');
    const btn = document.getElementById('floating-contact-btn');
    if (!menu) return;

    const isOpen = !menu.classList.contains('pointer-events-none');

    if (isOpen) {
        // Close menu (slide down)
        menu.classList.add('translate-y-3', 'opacity-0', 'pointer-events-none', 'scale-90');
        menu.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto', 'scale-100');
        if (chatIcon) chatIcon.classList.remove('hidden');
        if (closeIcon) closeIcon.classList.add('hidden');
        if (btn) btn.classList.remove('rotate-90');
    } else {
        // Open menu (slide up)
        menu.classList.remove('translate-y-3', 'opacity-0', 'pointer-events-none', 'scale-90');
        menu.classList.add('translate-y-0', 'opacity-100', 'pointer-events-auto', 'scale-100');
        if (chatIcon) chatIcon.classList.add('hidden');
        if (closeIcon) closeIcon.classList.remove('hidden');
        if (btn) btn.classList.add('rotate-90');
    }
}

// Close when clicking outside
document.addEventListener('click', function(e) {
    const widget = document.getElementById('floating-contact-widget');
    const menu = document.getElementById('floating-contact-menu');
    const chatIcon = document.getElementById('floating-chat-icon');
    const closeIcon = document.getElementById('floating-close-icon');
    const btn = document.getElementById('floating-contact-btn');
    
    if (widget && !widget.contains(e.target) && menu && !menu.classList.contains('pointer-events-none')) {
        menu.classList.add('translate-y-3', 'opacity-0', 'pointer-events-none', 'scale-90');
        menu.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto', 'scale-100');
        if (chatIcon) chatIcon.classList.remove('hidden');
        if (closeIcon) closeIcon.classList.add('hidden');
        if (btn) btn.classList.remove('rotate-90');
    }
});

// Close on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const menu = document.getElementById('floating-contact-menu');
        const chatIcon = document.getElementById('floating-chat-icon');
        const closeIcon = document.getElementById('floating-close-icon');
        const btn = document.getElementById('floating-contact-btn');
        if (menu && !menu.classList.contains('pointer-events-none')) {
            menu.classList.add('translate-y-3', 'opacity-0', 'pointer-events-none', 'scale-90');
            menu.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto', 'scale-100');
            if (chatIcon) chatIcon.classList.remove('hidden');
            if (closeIcon) closeIcon.classList.add('hidden');
            if (btn) btn.classList.remove('rotate-90');
        }
    }
});
</script>
