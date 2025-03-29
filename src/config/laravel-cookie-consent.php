<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cookie Consent Enable/Disable
    |--------------------------------------------------------------------------
    | Determines whether the cookie consent banner should be displayed.
    | You can enable or disable it via the .env file using COOKIE_CONSENT_ENABLED.
    */
    'enabled' => env('COOKIE_CONSENT_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Cookie Lifetime
    |--------------------------------------------------------------------------
    | Defines how long the consent cookie should be stored in the user's browser.
    | The value is set in days.
    */
    'cookie_lifetime' => env('COOKIE_CONSENT_LIFETIME', 365), // Days


    'reject_lifetime' => env('COOKIE_REJECT_LIFETIME', 7), // Days

    /*
    |--------------------------------------------------------------------------
    | GUI Options
    |--------------------------------------------------------------------------
    /*
    |--------------------------------------------------------------------------
    | Consent Modal Layout
    |--------------------------------------------------------------------------
    | Determines the layout of the consent modal. Options:
    | 'box'    - A small floating box.
    | 'box-inline'    - A small floating box.
    | 'box-wide'      - A larger floating box.
    | 'cloud'         - A cloud-like floating consent box.
    | 'cloud-inline'  - A compact cloud-style box.
    | 'bar'           - A simple bar at the bottom or top of the screen.
    | 'bar-inline'    - A compact inline bar.
    */
    'consent_modal_layout' => env('COOKIE_CONSENT_MODAL_LAYOUT', 'bar-inline'),

    /*
    |--------------------------------------------------------------------------
    | Preferences Modal Layout
    |--------------------------------------------------------------------------
    | Defines how the preferences modal should be displayed.
    | Options:
    | 'bar'  - A bar-style modal.
    | 'box'  - A popup-style box.
    */
    'preferences_modal_layout' => env('COOKIE_CONSENT_PREFERENCES_LAYOUT', 'bar'),

    /*
    |--------------------------------------------------------------------------
    | Flip Button
    |--------------------------------------------------------------------------
    | If set to true, the consent buttons will be styled with a flip effect.
    */
    'flip_button' => env('COOKIE_CONSENT_FLIP_BUTTON', true),

    /*
    |--------------------------------------------------------------------------
    | Disable Page Interaction
    |--------------------------------------------------------------------------
    | When enabled, the user must interact with the cookie banner before
    | accessing the page content.
    */
    'disable_page_interaction' => env('COOKIE_CONSENT_DISABLE_INTERACTION', true),

    /*
    |--------------------------------------------------------------------------
    | Theme Selection
    |--------------------------------------------------------------------------
    | Allows you to choose different visual themes for the cookie consent banner.
    | Options: 'default', 'dark', 'light', 'custom' (ensure 'custom' is defined properly)
    */
    'theme' => env('COOKIE_CONSENT_THEME', 'default'),

    /*
    |--------------------------------------------------------------------------
    | Cookie Categories
    |--------------------------------------------------------------------------
    | Define different cookie categories for user preferences.
    | Users can enable or disable specific categories.
    */
    'cookie_categories' => [
        'necessary' => [
            'enabled' => true, // Necessary cookies cannot be disabled
            'description' => 'These cookies are essential for the website to function properly.',
        ],
        'analytics' => [
            'enabled' => env('COOKIE_CONSENT_ANALYTICS', false),
            'description' => 'These cookies help us understand how visitors interact with our website.',
        ],
        'marketing' => [
            'enabled' => env('COOKIE_CONSENT_MARKETING', false),
            'description' => 'These cookies are used for advertising and tracking purposes.',
        ],
        'preferences' => [
            'enabled' => env('COOKIE_CONSENT_PREFERENCES', false),
            'description' => 'These cookies allow the website to remember user preferences.',
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Links to Privacy Policy and Terms
    |--------------------------------------------------------------------------
    | You can define links to your Privacy Policy and Terms & Conditions.
    */
    'policy_links' => [
        [
            'text' => 'Privacy Policy',
            'link' => env('COOKIE_CONSENT_PRIVACY_POLICY_URL', url('privacy-policy'))
        ],
        [
            'text' => 'Terms and conditions',
            'link' => env('COOKIE_CONSENT_TERMS_URL', url('terms-and-conditions'))
        ],

    ],
];
