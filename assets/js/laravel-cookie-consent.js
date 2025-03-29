document.addEventListener('DOMContentLoaded', function () {
    var consentRoot = document.querySelector('.cookie-consent-root');
    var acceptButton = consentRoot ? consentRoot.querySelector('.cookie-consent-accept') : null;
    var rejectButton = consentRoot ? consentRoot.querySelector('.cookie-consent-reject') : null;

    // Show the consent banner and handle interaction
    if (consentRoot) {
        consentRoot.classList.remove('cookie-consent-hide');

        // Disable interaction if needed
        if (consentRoot.classList.contains('cookie-disable-interaction')) {
            document.querySelector('html').classList.add('cookie-disable-interaction');
        }
    }

    // Check if the user has already made a decision
    var cookieConsent = getCookie('cookieConsent');
    if (cookieConsent === 'accepted' || cookieConsent === 'rejected') {
        hideConsentBanner();
    }

    // Accept all button click handler
    if (acceptButton) {
        acceptButton.addEventListener('click', function () {
            setCookie('cookieConsent', 'accepted', consentRoot.getAttribute('data-cookie-lifetime')); // Store for 7 days
            hideConsentBanner();
        });
    }

    // Reject all button click handler
    if (rejectButton) {
        rejectButton.addEventListener('click', function () {
            setCookie('cookieConsent', 'rejected', consentRoot.getAttribute('data-reject-lifetime')); // Store for 1 day
            hideConsentBanner();
        });
    }

    // Function to hide the consent banner and remove interaction block
    function hideConsentBanner() {
        console.log(getCookie('cookieConsent'));

        if (consentRoot) {
            consentRoot.classList.add('cookie-consent-hide');
            if (consentRoot.classList.contains('cookie-disable-interaction')) {
                document.querySelector('html').classList.remove('cookie-disable-interaction');
            }
        }
    }

    // Function to set a cookie
    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + value + "; path=/; SameSite=Lax" + expires;
    }

    // Function to get a cookie by name
    function getCookie(name) {
        var nameEQ = name + "=";
        var cookies = document.cookie.split(';');
        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i].trim();
            if (cookie.indexOf(nameEQ) === 0) {
                return cookie.substring(nameEQ.length, cookie.length);
            }
        }
        return null;
    }
});

document.addEventListener('DOMContentLoaded', function() {
    // Get elements
    const preferencesBtn = document.querySelector('.preferences-btn');
    const modal = document.querySelector('.cookie-preferences-modal');
    const modalOverlay = document.querySelector('.cookie-preferences-modal-overlay');
    const modalClose = document.querySelector('.cookie-preferences-modal-close');
    const modalCancel = document.querySelector('.cookie-preferences-cancel');
    const modalSave = document.querySelector('.cookie-preferences-save');
    const cookieConsentRoot = document.querySelector('.cookie-consent-root');
    const firstFocusable = modal.querySelector('input:not([disabled]), button');
    const lastFocusable = modal.querySelector('.cookie-preferences-modal-footer .primary-button');
    let previouslyFocusedElement;
    
    // Show modal with smooth animation
    function showModal() {
        // Store currently focused element
        previouslyFocusedElement = document.activeElement;
        
        // Add body class to prevent scrolling
        document.body.classList.add('modal-open');
        
        // Show modal
        modal.classList.add('is-visible');
        
        // Set focus to first focusable element
        setTimeout(() => {
            firstFocusable.focus();
        }, 10);
        
        // Add event listener for keyboard navigation
        modal.addEventListener('keydown', handleTabKey);
    }
    
    // Hide modal with smooth animation
    function hideModal() {
        // Remove body class to allow scrolling
        document.body.classList.remove('modal-open');
        
        // Hide modal
        modal.classList.remove('is-visible');
        
        // Return focus to previously focused element
        if (previouslyFocusedElement) {
            previouslyFocusedElement.focus();
        }
        
        // Remove event listener
        modal.removeEventListener('keydown', handleTabKey);
    }
    
    // Handle tab key navigation within modal
    function handleTabKey(e) {
        if (e.key !== 'Tab') return;
        
        if (e.shiftKey) {
            // Shift + Tab
            if (document.activeElement === firstFocusable) {
                e.preventDefault();
                lastFocusable.focus();
            }
        } else {
            // Tab
            if (document.activeElement === lastFocusable) {
                e.preventDefault();
                firstFocusable.focus();
            }
        }
    }
    
    // Show modal when preferences button is clicked
    preferencesBtn.addEventListener('click', function() {
        showModal();
        
        // Load saved preferences if they exist
        const savedPreferences = getCookiePreferences();
        if (savedPreferences) {
            document.querySelectorAll('.cookie-toggle input:not([disabled])').forEach(toggle => {
                const category = toggle.dataset.category;
                toggle.checked = savedPreferences[category] !== false;
            });
        }
    });
    
    // Close modal when overlay, close button, or cancel button is clicked
    [modalOverlay, modalClose, modalCancel].forEach(el => {
        el.addEventListener('click', function() {
            hideModal();
        });
    });
    
    // Save preferences when save button is clicked
    modalSave.addEventListener('click', function() {
        const preferences = {
            analytics: document.querySelector('input[data-category="analytics"]').checked,
            marketing: document.querySelector('input[data-category="marketing"]').checked,
            preferences: document.querySelector('input[data-category="preferences"]').checked
        };
        
        // Save preferences to cookie
        setCookiePreferences(preferences);
        
        // Hide modal
        hideModal();
        
        // Hide the cookie consent banner if it's visible
        cookieConsentRoot.classList.add('cookie-consent-hide');
        
        // Dispatch event for other scripts to listen to
        document.dispatchEvent(new CustomEvent('cookiePreferencesSaved', {
            detail: preferences
        }));
    });
    
    // Close modal when pressing Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.classList.contains('is-visible')) {
            hideModal();
        }
    });
    
    // Helper function to set cookie preferences
    function setCookiePreferences(preferences) {
        const expires = new Date();
        expires.setTime(expires.getTime() + (365 * 24 * 60 * 60 * 1000)); // 1 year
        document.cookie = `cookie_preferences=${JSON.stringify(preferences)}; expires=${expires.toUTCString()}; path=/; SameSite=Lax; Secure`;
    }
    
    // Helper function to get cookie preferences
    function getCookiePreferences() {
        const name = 'cookie_preferences=';
        const decodedCookie = decodeURIComponent(document.cookie);
        const cookieArray = decodedCookie.split(';');
        
        for(let i = 0; i < cookieArray.length; i++) {
            let cookie = cookieArray[i];
            while (cookie.charAt(0) === ' ') {
                cookie = cookie.substring(1);
            }
            if (cookie.indexOf(name) === 0) {
                return JSON.parse(cookie.substring(name.length, cookie.length));
            }
        }
        return null;
    }
});

// Add to your main stylesheet
document.head.insertAdjacentHTML('beforeend', `
    <style>
        .modal-open {
            overflow: hidden;
            padding-right: var(--scrollbar-width, 0);
        }
    </style>
`);

// Calculate scrollbar width to prevent page jump
document.addEventListener('DOMContentLoaded', function() {
    const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;
    document.documentElement.style.setProperty('--scrollbar-width', `${scrollbarWidth}px`);
});