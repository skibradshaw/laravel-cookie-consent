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
