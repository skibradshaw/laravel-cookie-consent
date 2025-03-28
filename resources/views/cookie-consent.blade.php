<div class="
    cookie-consent-root 
    cookie-consent-hide 
    {{ $cookieConfig['disable_page_interaction'] ? 'cookie-disable-interaction' : '' }} 
    consent-layout-{{ $cookieConfig['consent_modal_layout'] ?? 'bar' }}
">
    <div class="cookie-consent-container">
        <div class="cookie-consent-content-container">
            <div class="cookie-consent-content">
    
                <div class="cookie-consent-content-title">
                    Cookie Disclaimer
                </div>
                <div class="cookie-consent-content-description">
                    We use cookies (and other similar technologies) to collect data to improve your experience on 10015 Tools. By using 10015.io, you’re agreeing to the collection of data as described in our Privacy Policy.
                </div>
            </div>
    
            <div class="cookie-consent-button-container">
                <div class="cookie-consent-button-action {{ $cookieConfig['flip_button'] ? 'flip-button' : '' }}">
                    <button class="">
                        Accept all
                    </button>
                    <button>
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