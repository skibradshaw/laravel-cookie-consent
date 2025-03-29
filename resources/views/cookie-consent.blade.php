<div class="
    cookie-consent-root 
    cookie-consent-hide 
    {{ $cookieConfig['disable_page_interaction'] ? 'cookie-disable-interaction' : '' }} 
    consent-layout-{{ $cookieConfig['consent_modal_layout'] ?? 'bar' }}
" 
data-cookie-lifetime="{{ $cookieConfig['cookie_lifetime'] }}" 
data-reject-lifetime="{{ $cookieConfig['reject_lifetime'] }}"
>
    <div class="cookie-consent-container">
        <div class="cookie-consent-content-container">
            <div class="cookie-consent-content">
                <div class="cookie-consent-content-title">
                    Cookie Disclaimer
                </div>
                <div class="cookie-consent-content-description">
                    This website uses cookies to enhance your browsing experience, analyze site traffic, and personalize content. By continuing to use this site, you consent to our use of cookies. 
                </div>
            </div>
    
            <div class="cookie-consent-button-container">
                <div class="cookie-consent-button-action {{ $cookieConfig['flip_button'] ? 'flip-button' : '' }}">
                    <button class="cookie-consent-accept">
                        Accept all
                    </button>
                    <button class="cookie-consent-reject">
                        Reject all
                    </button>
                </div>
                <button class="preferences-btn">
                    Manage preferences
                </button>
            </div>
        </div>
    </div>

    @if (count($cookieConfig['policy_links']) > 0)
    <div class="cookie-consent-links-container">
        <ul>
            @foreach ($cookieConfig['policy_links'] as $policyLinks)
            <li>
                <a target="_blank" href="{{ $policyLinks['link'] }}">
                    {{ $policyLinks['text'] }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<script src="{{ url('vendor/laravel-cookie-consent/assets/js/laravel-cookie-consent.js') }}"></script>
<script src="{{ route('laravel-cookie-consent.script-utils') }}"></script>