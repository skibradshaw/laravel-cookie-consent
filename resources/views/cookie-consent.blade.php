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

<!-- Cookie Consent Modal -->
<div class="cookie-preferences-modal" aria-hidden="true">
    <div class="cookie-preferences-modal-overlay"></div>
    <div class="cookie-preferences-modal-content" role="dialog" aria-modal="true" aria-labelledby="cookie-modal-title">
        <div class="cookie-preferences-modal-header">
            <h2 id="cookie-modal-title">Cookie Preferences</h2>
            <button class="cookie-preferences-modal-close" aria-label="Close cookie preferences">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 4L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M4 4L12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>
        </div>
        <div class="cookie-preferences-modal-body">
            <p class="cookie-preferences-intro">You can manage your cookie preferences below. Please note that disabling certain cookies may affect your browsing experience.</p>
            
            <div class="cookie-categories">
                <div class="cookie-category">
                    <div class="cookie-category-header">
                        <h3>Essential Cookies</h3>
                        <label class="cookie-toggle">
                            <input type="checkbox" checked disabled>
                            <span class="cookie-toggle-slider"></span>
                        </label>
                    </div>
                    <p class="cookie-category-description">These cookies are necessary for the website to function and cannot be switched off.</p>
                </div>
                
                <div class="cookie-category">
                    <div class="cookie-category-header">
                        <h3>Analytics Cookies</h3>
                        <label class="cookie-toggle">
                            <input type="checkbox" checked data-category="analytics">
                            <span class="cookie-toggle-slider"></span>
                        </label>
                    </div>
                    <p class="cookie-category-description">Allow us to analyze website usage to improve performance.</p>
                </div>
                
                <div class="cookie-category">
                    <div class="cookie-category-header">
                        <h3>Marketing Cookies</h3>
                        <label class="cookie-toggle">
                            <input type="checkbox" checked data-category="marketing">
                            <span class="cookie-toggle-slider"></span>
                        </label>
                    </div>
                    <p class="cookie-category-description">Used to track visitors across websites for advertising purposes.</p>
                </div>
                
                <div class="cookie-category">
                    <div class="cookie-category-header">
                        <h3>Preferences Cookies</h3>
                        <label class="cookie-toggle">
                            <input type="checkbox" checked data-category="preferences">
                            <span class="cookie-toggle-slider"></span>
                        </label>
                    </div>
                    <p class="cookie-category-description">These remember your preferences like language or region.</p>
                </div>
            </div>
        </div>
        <div class="cookie-preferences-modal-footer">
            <button class="cookie-preferences-save primary-button">Save Preferences</button>
            <button class="cookie-preferences-cancel secondary-button">Cancel</button>
        </div>
    </div>
</div>


<script src="{{ url('vendor/laravel-cookie-consent/assets/js/laravel-cookie-consent.js') }}"></script>
<script src="{{ route('laravel-cookie-consent.script-utils') }}"></script>