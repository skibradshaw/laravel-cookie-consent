"use strict";

document.addEventListener('DOMContentLoaded', function () {
    // DOM Elements
    const consentRoot = document.querySelector('.cookie-consent-root');
    const acceptButtons = document.querySelectorAll('.cookie-consent-accept');
    const rejectButtons = document.querySelectorAll('.cookie-consent-reject');
    const cookieConsentPrefix = consentRoot?.getAttribute('data-cookie-prefix') || 'cookie_consent';
    
    // Modal Elements
    const preferencesBtn = document.querySelector('.preferences-btn');
    const modal = document.querySelector('.cookie-preferences-modal');
    const modalOverlay = document.querySelector('.cookie-preferences-modal-overlay');
    const modalClose = document.querySelector('.cookie-preferences-modal-close');
    const modalSave = document.querySelector('.cookie-preferences-save');
    
    // Initialize banner
    if (consentRoot) {
        consentRoot.classList.remove('cookie-consent-hide');
        
        if (consentRoot.classList.contains('cookie-disable-interaction')) {
            document.documentElement.classList.add('cookie-disable-interaction');
        }
    }
    
    // Check existing consent
    const cookieConsent = getCookie(cookieConsentPrefix);
    if (cookieConsent === 'accepted' || cookieConsent === 'rejected') {
        hideConsentBanner();
    }
    
    // Handle accept buttons (both in banner and modal)
    acceptButtons.forEach(button => {
        button.addEventListener('click', function() {
            setCookie(cookieConsentPrefix, 'accepted', consentRoot?.getAttribute('data-cookie-lifetime') || 7);
            setAllPreferences(true); // Accept all categories
            hideConsentBanner();
            document.dispatchEvent(new CustomEvent('cookieConsentAccepted'));

            // Check if function exists before calling
            if (typeof loadCookieCategoriesEnabledServices === 'function') {
                try {
                    loadCookieCategoriesEnabledServices();
                } catch (e) {
                    console.info(e);
                }
            }
        });
    });
    
    // Handle reject buttons (both in banner and modal)
    rejectButtons.forEach(button => {
        button.addEventListener('click', function() {
            setCookie(cookieConsentPrefix, 'rejected', consentRoot?.getAttribute('data-reject-lifetime') || 1);
            setAllPreferences(false); // Reject all non-essential categories
            hideConsentBanner();
            document.dispatchEvent(new CustomEvent('cookieConsentRejected'));
        });
    });
    
    // Modal functions
    function showModal() {
        if (!modal) return;
        
        document.body.classList.add('modal-open');
        modal.setAttribute('aria-hidden', 'false');
        modal.classList.add('is-visible');
        
        // Set initial toggle states
        const savedPreferences = getCookiePreferences();
        document.querySelectorAll('.cookie-toggle input:not([disabled])').forEach(toggle => {
            const category = toggle.dataset.category;
            toggle.checked = savedPreferences ? savedPreferences[category] !== false : true;
        });
    }
    
    function hideModal() {
        if (!modal) return;
        
        modal.setAttribute('aria-hidden', 'true');
        modal.classList.remove('is-visible');
        document.body.classList.remove('modal-open');
    }
    
    // Preferences management
    function setAllPreferences(accept) {
        const preferences = {};
        document.querySelectorAll('.cookie-toggle input[data-category]').forEach(toggle => {
            preferences[toggle.dataset.category] = toggle.disabled ? true : accept;
        });
        setCookiePreferences(preferences);
    }
    
    // Event listeners for modal
    if (preferencesBtn) {
        preferencesBtn.addEventListener('click', showModal);
    }
    
    if (modalOverlay) modalOverlay.addEventListener('click', hideModal);
    if (modalClose) modalClose.addEventListener('click', hideModal);
    
    if (modalSave) {
        modalSave.addEventListener('click', function() {
            const preferences = {};
            document.querySelectorAll('.cookie-toggle input[data-category]').forEach(toggle => {
                preferences[toggle.dataset.category] = toggle.checked;
            });
            
            setCookiePreferences(preferences);
            setCookie(cookieConsentPrefix, 'custom', consentRoot?.getAttribute('data-cookie-lifetime') || 7);
            hideModal();
            document.dispatchEvent(new CustomEvent('cookiePreferencesSaved', { detail: preferences }));

            // Action Accept
            setCookie(cookieConsentPrefix, 'accepted', consentRoot?.getAttribute('data-cookie-lifetime') || 7);
            hideConsentBanner();
            document.dispatchEvent(new CustomEvent('cookieConsentAccepted'));

            // Check if function exists before calling
            if (typeof loadCookieCategoriesEnabledServices === 'function') {
                try {
                    loadCookieCategoriesEnabledServices();
                } catch (e) {
                    console.info(e);
                }
            }
        });
    }
    
    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal?.classList.contains('is-visible')) {
            hideModal();
        }
    });
    
    // Cookie helper functions
    function setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        const expires = "; expires=" + date.toUTCString();
        const secureFlag = location.protocol === 'https:' ? "; Secure" : "";
        document.cookie = `${name}=${value}; path=/; SameSite=Lax${expires}${secureFlag}`;
    }
    
    function getCookie(name) {
        const nameEQ = name + "=";
        const cookies = document.cookie.split(';');
        for (let i = 0; i < cookies.length; i++) {
            let cookie = cookies[i].trim();
            if (cookie.indexOf(nameEQ) === 0) {
                return cookie.substring(nameEQ.length, cookie.length);
            }
        }
        return null;
    }
    
    function setCookiePreferences(preferences) {
        const expires = new Date();
        expires.setTime(expires.getTime() + (365 * 24 * 60 * 60 * 1000));
        const secureFlag = location.protocol === 'https:' ? "; Secure" : "";
        document.cookie = `cookie_preferences=${JSON.stringify(preferences)}; expires=${expires.toUTCString()}; path=/; SameSite=Lax${secureFlag}`;
    }
    
    function getCookiePreferences() {
        const name = 'cookie_preferences=';
        const decodedCookie = decodeURIComponent(document.cookie);
        const cookieArray = decodedCookie.split(';');
        
        for(let i = 0; i < cookieArray.length; i++) {
            let cookie = cookieArray[i].trim();
            if (cookie.indexOf(name) === 0) {
                return JSON.parse(cookie.substring(name.length, cookie.length));
            }
        }
        return null;
    }

    // Make them available globally
    window.getCookie = getCookie;
    window.getCookiePreferences = getCookiePreferences;
    
    function hideConsentBanner() {
        if (consentRoot) {
            consentRoot.classList.add('cookie-consent-hide');
            document.documentElement.classList.remove('cookie-disable-interaction');
        }
        hideModal();
    }
});

// Handle scrollbar width to prevent page shift
document.head.insertAdjacentHTML('beforeend', `
    <style>
        .modal-open {
            overflow: hidden;
            padding-right: var(--scrollbar-width, 0);
        }
    </style>
`);