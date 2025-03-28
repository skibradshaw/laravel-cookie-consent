document.addEventListener('DOMContentLoaded', function() {
    var consentRoot = document.querySelector('.cookie-consent-root');
    if (consentRoot) {
        consentRoot.classList.remove('cookie-consent-hide');

        if (consentRoot.classList.contains('cookie-disable-interaction')) {
            document.querySelector('html').classList.add('cookie-disable-interaction');
        }
    }
});

document.addEventListener('DOMContentLoaded', function() {
    var consentRoot = document.querySelector('.cookie-consent-root');
    var acceptButton = consentRoot ? consentRoot.querySelector('.cookie-consent-button-action button:nth-of-type(1)') : null;
    var rejectButton = consentRoot ? consentRoot.querySelector('.cookie-consent-button-action button:nth-of-type(2)') : null;
    
    // Show the consent banner and handle interaction
    if (consentRoot) {
        consentRoot.classList.remove('cookie-consent-hide');

        // Disable interaction if needed
        if (consentRoot.classList.contains('cookie-disable-interaction')) {
            document.querySelector('html').classList.add('cookie-disable-interaction');
        }
    }

    // Check if the user has already made a decision
    if (localStorage.getItem('cookieConsent') === 'accepted') {
        hideConsentBanner();
    } else if (localStorage.getItem('cookieConsent') === 'rejected') {
        hideConsentBanner();
    }

    // Accept all button click handler
    if (acceptButton) {
        acceptButton.addEventListener('click', function() {
            localStorage.setItem('cookieConsent', 'accepted');
            hideConsentBanner();
        });
    }

    // Reject all button click handler
    if (rejectButton) {
        rejectButton.addEventListener('click', function() {
            localStorage.setItem('cookieConsent', 'rejected');
            hideConsentBanner();
        });
    }

    // Function to hide the consent banner and remove interaction block
    function hideConsentBanner() {
        if (consentRoot) {
            consentRoot.classList.add('cookie-consent-hide');
            if (consentRoot.classList.contains('cookie-disable-interaction')) {
                document.querySelector('html').classList.remove('cookie-disable-interaction');
            }
        }
    }
});
