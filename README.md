### Uses

```php
{!! CookieConsent::scripts(options: [
    'cookie_lifetime' => config('laravel-cookie-consent.cookie_lifetime', 7),
    'reject_lifetime' => config('laravel-cookie-consent.reject_lifetime', 1),
    'disable_page_interaction' => config('laravel-cookie-consent.disable_page_interaction', true),
    'preferences_modal_enabled' => config('laravel-cookie-consent.preferences_modal_enabled', true),
    'consent_modal_layout' => config('laravel-cookie-consent.consent_modal_layout', 'bar-inline'),
    'flip_button' => config('laravel-cookie-consent.flip_button', true),
    'theme' => config('laravel-cookie-consent.theme', 'default'),
    'cookie_prefix' => config('laravel-cookie-consent.cookie_prefix', 'Laravel_App'),
    'policy_links' => config('laravel-cookie-consent.policy_links', [
        ['text' => 'Privacy Policy', 'link' => url('privacy-policy')],
        ['text' => 'Terms & Conditions', 'link' => url('terms-and-conditions')],
    ]),
    'cookie_categories' => config('laravel-cookie-consent.cookie_categories', [
        'necessary' => [
            'enabled' => true,
            'locked' => true,
            'title' => 'Essential Cookies',
            'description' => 'These cookies are essential for the website to function properly.',
        ],
        'analytics' => [
            'enabled' => env('COOKIE_CONSENT_ANALYTICS', false),
            'locked' => false,
            'title' => 'Analytics Cookies',
            'description' => 'These cookies help us understand how visitors interact with our website.',
        ],
        'marketing' => [
            'enabled' => env('COOKIE_CONSENT_MARKETING', false),
            'locked' => false,
            'title' => 'Marketing Cookies',
            'description' => 'These cookies are used for advertising and tracking purposes.',
        ],
        'preferences' => [
            'enabled' => env('COOKIE_CONSENT_PREFERENCES', false),
            'locked' => false,
            'title' => 'Preferences Cookies',
            'description' => 'These cookies allow the website to remember user preferences.',
        ],
    ]),
    'cookie_modal_title' => 'Cookie Preferences',
    'cookie_modal_intro' => 'You can customize your cookie preferences below.',
    'cookie_accept_btn_text' => 'Accept All',
    'cookie_reject_btn_text' => 'Reject All',
    'cookie_preferences_btn_text' => 'Manage Preferences',
    'cookie_preferences_save_text' => 'Save Preferences',
]) !!}
```