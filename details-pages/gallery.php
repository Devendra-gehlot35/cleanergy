
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Our Gallery - Cleanergy Battery Installations & Setups</title>

    <meta name="description" content="Explore real-world Cleanergy LiFePO4 battery installations across marine yachts, RVs, home solar storage, and off-grid power systems.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,700;1,800;1,900&family=Playfair+Display:ital,wght@1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/dist/output.css?v=<?= filemtime(__DIR__ . '/../dist/output.css') ?>">

    <style>
        /* Blurred, semi-transparent gallery backdrop */
        #gallery-lightbox {
            background: rgba(15, 23, 42, 0.20);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        /* Preview stays within 80% of the viewport */
        .gallery-preview-image {
            display: block;
            width: auto;
            height: auto;
            max-width: 80vw;
            max-height: 80vh;
            object-fit: contain;
            border-radius: 14px;
            background: transparent;
            box-shadow: 0 20px 70px rgba(0, 0, 0, 0.35);
        }

        /* Close button at the top-right of the screen */
        .gallery-close-button {
            position: absolute;
            top: 24px;
            right: 24px;
            z-index: 100;
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: #ffffff;
            color: #0f172a;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.2);
            transition: background 0.2s, color 0.2s, transform 0.2s;
        }

        .gallery-close-button:hover {
            background: #fef2f2;
            color: #dc2626;
            transform: scale(1.06);
        }

        /* Previous / next controls */
        .gallery-nav-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 50;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: rgba(15, 23, 42, 0.65);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s;
        }

        .gallery-nav-button:hover {
            background: rgba(15, 23, 42, 0.9);
        }

        .gallery-nav-prev {
            left: 24px;
        }

        .gallery-nav-next {
            right: 24px;
        }

        .gallery-card:focus-visible,
        .gallery-close-button:focus-visible,
        .gallery-nav-button:focus-visible {
            outline: 3px solid #12b3d6;
            outline-offset: 3px;
        }

        @media (max-width: 640px) {
            .gallery-preview-image {
                max-width: 92vw;
                max-height: 82vh;
                border-radius: 10px;
            }

            .gallery-close-button {
                top: 16px;
                right: 16px;
                width: 42px;
                height: 42px;
            }

            .gallery-nav-button {
                width: 38px;
                height: 38px;
            }

            .gallery-nav-prev {
                left: 5px;
            }

            .gallery-nav-next {
                right: 5px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .gallery-card,
            .gallery-card img,
            .gallery-close-button,
            .gallery-nav-button {
                transition: none !important;
            }
        }
    </style>
</head>

<body class="bg-white font-['Plus_Jakarta_Sans',sans-serif] text-slate-900 min-h-screen flex flex-col justify-between overflow-x-hidden max-w-full">

<?php
// Include fixed floating navbar
include __DIR__ . '/../components/navbar.php';

// Gallery collection loaded dynamically (Google Sheet integration with cache & fallback)
require_once __DIR__ . '/../data/gallery_loader.php';
$gallery_items = load_gallery_items();
?>

    <!-- 1. Hero Banner (Exact Same Size, Image & Layout as Contact Us, About Us & Shop Pages) -->
    <section class="relative w-full min-h-[580px] sm:min-h-[660px] h-[92vh] sm:h-screen max-h-[1000px] overflow-hidden flex items-center justify-center text-center bg-slate-900">
        
        <!-- Clean Background Image -->
        <img src="/assets/img/blog-fishing-boat-trolling.webp" 
             alt="Clean Energy Gallery Banner" 
             class="absolute inset-0 w-full h-full object-cover object-center">
        
        <!-- Subtle Neutral Tint for Clean Text Readability -->
        <div class="absolute inset-0 bg-black/35"></div>

        <!-- Big Centered "Our Gallery" Title (Matching Contact Us / About Us Pages) -->
        <div class="relative z-10 px-4 pt-16">
            <span class="inline-block text-[11px] sm:text-sm font-bold tracking-[0.2em] text-[#38bdf8] uppercase mb-3 drop-shadow">
                CLEANERGY
            </span>
            <h1 class="text-4xl sm:text-6xl md:text-7xl lg:text-8xl font-black text-white italic tracking-wide drop-shadow-[0_4px_16px_rgba(0,0,0,0.5)]">
                Our Gallery
            </h1>
        </div>
    </section>

    <!-- 2. Main Gallery Section -->
    <main class="flex-1 py-14 sm:py-18 lg:py-20 bg-[#f4f6fa] text-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- 4-COLUMN SQUARE IMAGE GRID -->
        <div id="gallery-grid-images" class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3.5 sm:gap-4 lg:gap-5">
            <?php foreach ($gallery_items as $index => $item): ?>
                <button type="button"
                        class="gallery-card group relative block w-full aspect-square bg-slate-200 rounded-md sm:rounded-lg overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 cursor-pointer text-left focus:outline-none focus:ring-2 focus:ring-[#12b3d6]"
                        data-index="<?= $index ?>"
                        aria-label="View <?= htmlspecialchars($item['title'] ?? 'Installation Photo', ENT_QUOTES, 'UTF-8') ?>">
                    <img src="<?= htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8') ?>"
                         alt="<?= htmlspecialchars($item['title'] ?? 'Battery Installation', ENT_QUOTES, 'UTF-8') ?>"
                         loading="lazy"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    
                    <!-- Hover Effect with subtle Cleanergy icon -->
                    <span class="absolute inset-0 bg-slate-950/20 opacity-0 group-hover:opacity-100 group-focus-visible:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <span class="w-11 h-11 rounded-full bg-white/95 text-[#12b3d6] flex items-center justify-center shadow-lg transform scale-90 group-hover:scale-100 transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/>
                            </svg>
                        </span>
                    </span>
                </button>
            <?php endforeach; ?>
        </div>

    </div>
</main>

<!-- CALL TO ACTION -->
<section class="w-full bg-[#EDFAFC] py-16 sm:py-20 px-4 sm:px-6 lg:px-8 text-center border-t border-cyan-100">

    <div class="max-w-4xl mx-auto text-center">

        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/90 text-[#0284c7] text-xs sm:text-sm font-bold tracking-wide uppercase mb-4 border border-cyan-100">
            Custom Energy Engineering
        </div>

        <h3 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight mb-4">
            Ready to Power Your
            <span class="text-[#12b3d6]">Next Installation?</span>
        </h3>

        <p class="text-slate-600 text-sm sm:text-base lg:text-lg leading-relaxed max-w-2xl mx-auto mb-8 font-normal">
            Whether outfitting a 50–foot yacht, an off-grid cabin, or a commercial vehicle fleet, our battery specialists will tailor the ideal LiFePO4 solution for your voltage and capacity needs.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-5">

            <button
                type="button"
                data-open-enquiry="true"
                class="w-full sm:w-auto inline-flex items-center justify-center px-9 sm:px-11 py-3.5 sm:py-4 rounded-full font-bold text-sm sm:text-base text-white bg-[#12b3d6] hover:bg-[#0ea5e9] shadow-md shadow-cyan-500/25 transition-all">
                Get a Quote
            </button>

            <a
                href="/contact.php"
                class="w-full sm:w-auto inline-flex items-center justify-center px-9 sm:px-11 py-3.5 sm:py-4 rounded-full font-bold text-sm sm:text-base text-slate-800 bg-white hover:bg-slate-50 border border-slate-200 transition-all">
                Contact Specialist
            </a>

        </div>
    </div>
</section>

<!-- BLURRED PHOTO LIGHTBOX -->
<div
    id="gallery-lightbox"
    role="dialog"
    aria-modal="true"
    aria-label="Gallery photo preview"
    aria-hidden="true"
    class="fixed inset-0 z-[9999] hidden items-center justify-center p-0">

    <!-- CLOSE BUTTON: TOP RIGHT -->
    <button
        id="lightbox-close-btn"
        type="button"
        aria-label="Close Preview"
        class="gallery-close-button">

        <svg
            width="23"
            height="23"
            fill="none"
            stroke="currentColor"
            stroke-width="2.5"
            viewBox="0 0 24 24">

            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>

    <!-- PREVIOUS BUTTON -->
    <button
        id="lightbox-prev-btn"
        type="button"
        aria-label="Previous Photo"
        class="gallery-nav-button gallery-nav-prev">

        <svg
            width="25"
            height="25"
            fill="none"
            stroke="currentColor"
            stroke-width="2.5"
            viewBox="0 0 24 24">

            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M15 19l-7-7 7-7"/>
        </svg>
    </button>

    <!-- CENTERED IMAGE: MAX 80% VIEWPORT -->
    <div class="relative z-10 flex items-center justify-center w-full mx-auto pointer-events-none">

        <img
            id="lightbox-img"
            src=""
            alt="Enlarged gallery photo"
            class="gallery-preview-image pointer-events-auto">
    </div>

    <!-- NEXT BUTTON -->
    <button
        id="lightbox-next-btn"
        type="button"
        aria-label="Next Photo"
        class="gallery-nav-button gallery-nav-next">

        <svg
            width="25"
            height="25"
            fill="none"
            stroke="currentColor"
            stroke-width="2.5"
            viewBox="0 0 24 24">

            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M9 5l7 7-7 7"/>
        </svg>
    </button>
</div>

<!-- GALLERY INTERACTION SCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const galleryItems = <?= json_encode(
        $gallery_items,
        JSON_HEX_TAG |
        JSON_HEX_AMP |
        JSON_HEX_APOS |
        JSON_HEX_QUOT |
        JSON_UNESCAPED_SLASHES |
        JSON_INVALID_UTF8_SUBSTITUTE
    ) ?>;

    const cards = document.querySelectorAll('.gallery-card');

    const lightbox = document.getElementById('gallery-lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const closeBtn = document.getElementById('lightbox-close-btn');
    const prevBtn = document.getElementById('lightbox-prev-btn');
    const nextBtn = document.getElementById('lightbox-next-btn');

    let currentIndex = 0;
    let activeFilteredIndices = galleryItems.map((_, index) => index);
    let previousFocus = null;
    let previousBodyOverflow = '';

    // OPEN / UPDATE PHOTO
    function showPhoto(index) {

        if (!galleryItems[index]) return;

        const wasClosed = lightbox.classList.contains('hidden');

        if (wasClosed) {
            previousFocus = document.activeElement;
            previousBodyOverflow = document.body.style.overflow;
        }

        currentIndex = index;

        lightboxImg.src = galleryItems[index].image;
        lightboxImg.alt = galleryItems[index].title;

        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        lightbox.setAttribute('aria-hidden', 'false');

        document.body.style.overflow = 'hidden';

        if (wasClosed) {
            closeBtn.focus();
        }
    }

    // CLOSE PHOTO
    function closePhoto() {

        if (lightbox.classList.contains('hidden')) return;

        lightbox.classList.add('hidden');
        lightbox.classList.remove('flex');
        lightbox.setAttribute('aria-hidden', 'true');

        document.body.style.overflow = previousBodyOverflow;
        lightboxImg.removeAttribute('src');

        if (previousFocus && previousFocus.isConnected) {
            previousFocus.focus();
        }

        previousFocus = null;
    }

    // OPEN ON IMAGE CLICK
    cards.forEach(card => {

        card.addEventListener('click', function () {
            showPhoto(Number(this.dataset.index));
        });
    });

    // CLOSE BUTTON
    closeBtn.addEventListener('click', function (event) {
        event.stopPropagation();
        closePhoto();
    });

    // CLOSE WHEN CLICKING OUTSIDE IMAGE
    lightbox.addEventListener('click', function (event) {

        if (event.target === lightbox) {
            closePhoto();
        }
    });

    // NEXT IMAGE
    function showNext() {

        if (activeFilteredIndices.length === 0) return;

        const currentPosition = activeFilteredIndices.indexOf(currentIndex);
        const nextPosition =
            (currentPosition + 1) % activeFilteredIndices.length;

        showPhoto(activeFilteredIndices[nextPosition]);
    }

    // PREVIOUS IMAGE
    function showPrev() {

        if (activeFilteredIndices.length === 0) return;

        const currentPosition = activeFilteredIndices.indexOf(currentIndex);
        const previousPosition =
            (currentPosition - 1 + activeFilteredIndices.length)
            % activeFilteredIndices.length;

        showPhoto(activeFilteredIndices[previousPosition]);
    }

    nextBtn.addEventListener('click', function (event) {
        event.stopPropagation();
        showNext();
    });

    prevBtn.addEventListener('click', function (event) {
        event.stopPropagation();
        showPrev();
    });

    // KEYBOARD NAVIGATION
    document.addEventListener('keydown', function (event) {

        if (lightbox.classList.contains('hidden')) return;

        if (event.key === 'Escape') {
            event.preventDefault();
            closePhoto();
        }

        if (event.key === 'ArrowRight') {
            event.preventDefault();
            showNext();
        }

        if (event.key === 'ArrowLeft') {
            event.preventDefault();
            showPrev();
        }

        if (event.key === 'Tab') {

            const focusable = [closeBtn, prevBtn, nextBtn];
            const currentPosition = focusable.indexOf(document.activeElement);

            event.preventDefault();

            const direction = event.shiftKey ? -1 : 1;

            const nextPosition =
                (currentPosition + direction + focusable.length)
                % focusable.length;

            focusable[nextPosition].focus();
        }
    });
});
</script>

<?php
include __DIR__ . '/../components/footer.php';
?>

</body>
</html>
