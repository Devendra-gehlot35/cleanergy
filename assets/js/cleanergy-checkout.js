/**
 * Cleanergy Frontend Checkout Helper
 * Directly integrates with Cleanergy Admin Backend APIs & Stripe:
 * 1. POST https://mcp-admin-7pwd.vercel.app/api/cart
 * 2. POST https://mcp-admin-7pwd.vercel.app/api/stripe/checkout with { cartId, source: "WEB" }
 * 3. Redirects to Stripe Checkout
 */

const CLEANERGY_ADMIN_API_BASE = 'https://mcp-admin-7pwd.vercel.app';

// Mapping from CLEANERGY product code & local IDs to Admin Backend Prisma DB IDs
const CLEANERGY_BACKEND_MAP = {
    'CLEANERGY-01': 'cmuzcw90g0000no7kud73tjpa',
    'CLEANERGY-02': 'cmv0uehki0000m87kb7ydvm79',
    'CLEANERGY-03': 'cmv0wbvgv0002m87k5k3ypjin',
    'CLEANERGY-04': 'cmv0wd1d60003m87kzkg6usd5',
    'CLEANERGY-05': 'cmv0we7n00004m87kb80rl0hz',
    '1': 'cmuzcw90g0000no7kud73tjpa',
    '2': 'cmv0uehki0000m87kb7ydvm79',
    '3': 'cmv0wbvgv0002m87k5k3ypjin',
    '4': 'cmv0wd1d60003m87kzkg6usd5',
    '5': 'cmv0we7n00004m87kb80rl0hz',
};

async function buyProduct(productCode, quantity = 1, btn = null) {
    let originalHtml = '';
    if (btn) {
        originalHtml = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = `<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg> <span>Opening Stripe...</span>`;
    }

    try {
        // Resolve backend database ID
        const resolvedId = CLEANERGY_BACKEND_MAP[productCode] || productCode;

        // Step 1: Create Cart in Cleanergy Admin Backend
        const cartResponse = await fetch(`${CLEANERGY_ADMIN_API_BASE}/api/cart`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                productId: resolvedId,
                quantity: parseInt(quantity, 10) || 1
            })
        });

        const cartData = await cartResponse.json();
        if (!cartData.success || !cartData.cart?.id) {
            throw new Error(cartData.message || cartData.error || "Unable to add product to cart");
        }

        // Step 2: Create Stripe Checkout Session with source = "WEB"
        const checkoutResponse = await fetch(`${CLEANERGY_ADMIN_API_BASE}/api/stripe/checkout`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                cartId: cartData.cart.id,
                source: "WEB"
            })
        });

        const checkoutData = await checkoutResponse.json();
        if (!checkoutData.success || !checkoutData.url) {
            throw new Error(checkoutData.error || checkoutData.message || "Unable to create Stripe checkout session");
        }

        // Step 3: Redirect to Stripe Checkout page
        window.location.href = checkoutData.url;

    } catch (err) {
        console.warn("Direct admin API failed, falling back to server-side checkout handler:", err);

        // Resilient Fallback: use server-side route
        try {
            const fallbackRes = await fetch('/api/create-checkout-session.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    product_code: productCode,
                    quantity: quantity
                })
            });
            const fallbackData = await fallbackRes.json();
            if (fallbackData.success && fallbackData.url) {
                window.location.href = fallbackData.url;
                return;
            }
        } catch (fallbackErr) {
            console.error("Fallback failed:", fallbackErr);
        }

        // Direct server-side 302 redirect fallback
        window.location.href = `/buy-now.php?code=${encodeURIComponent(productCode)}&qty=${encodeURIComponent(quantity)}`;
    }
}

// Global alias for compatibility
window.buyProduct = buyProduct;

// Universal Direct Mailbox Opener (Mobile app / Desktop webmail fallback)
if (!window.openDirectMail) {
    window.openDirectMail = function(e, email) {
        if (e && typeof e.preventDefault === 'function') {
            e.preventDefault();
        }
        const targetEmail = email || 'customercare@cleanergy.us';
        const subject = encodeURIComponent("Cleanergy Battery Inquiry");
        const mailtoUrl = `mailto:${targetEmail}?subject=${subject}`;
        const gmailUrl = `https://mail.google.com/mail/?view=cm&fs=1&to=${encodeURIComponent(targetEmail)}&su=${subject}`;

        const isMobile = /Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

        if (isMobile) {
            window.location.href = mailtoUrl;
            return;
        }

        let appOpened = false;
        const blurHandler = () => { appOpened = true; };
        window.addEventListener('blur', blurHandler, { once: true });

        window.location.href = mailtoUrl;

        setTimeout(() => {
            window.removeEventListener('blur', blurHandler);
            if (!appOpened && !document.hidden) {
                window.open(gmailUrl, '_blank', 'noopener,noreferrer');
            }
        }, 600);
    };
}

