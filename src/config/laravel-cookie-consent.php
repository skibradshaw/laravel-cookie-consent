<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cookie Consent Enable/Disable
    |--------------------------------------------------------------------------
    | This setting determines whether the cookie consent banner should be displayed.
    | Set this value to 'true' to show the banner or 'false' to disable it.
    | You can control this via the .env file using COOKIE_CONSENT_ENABLED.
    */
    'enabled' => env('COOKIE_CONSENT_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Cookie Lifetime
    |--------------------------------------------------------------------------
    | Defines how long the consent cookie should be stored in the user's browser.
    | The value is specified in days. Default is 365 days (1 year).
    */
    'cookie_lifetime' => env('COOKIE_CONSENT_LIFETIME', 365),

    /*
    |--------------------------------------------------------------------------
    | Rejection Lifetime
    |--------------------------------------------------------------------------
    | Specifies how long the rejection cookie should be stored in the user's browser.
    | The value is in days. Default is 7 days.
    */
    'reject_lifetime' => env('COOKIE_REJECT_LIFETIME', 7),

    /*
    |--------------------------------------------------------------------------
    | Consent Modal Layout
    |--------------------------------------------------------------------------
    | Determines the layout style of the consent modal. The options available are:
    | - 'box'         : A small floating box.
    | - 'box-inline'  : A small floating box positioned inline.
    | - 'box-wide'    : A larger floating box.
    | - 'cloud'       : A cloud-like floating consent box.
    | - 'cloud-inline': A compact cloud-style box.
    | - 'bar'         : A simple bar at the top or bottom of the screen.
    | - 'bar-inline'  : A compact inline bar.
    | Default is 'bar-inline'.
    */
    'consent_modal_layout' => env('COOKIE_CONSENT_MODAL_LAYOUT', 'bar-inline'),

    /*
    |--------------------------------------------------------------------------
    | Preferences Modal Layout
    |--------------------------------------------------------------------------
    | Defines the layout of the preferences modal where users can manage their consent settings.
    | Options:
    | - 'bar' : A bar-style modal.
    | - 'box' : A popup-style box.
    | Default is 'bar'.
    */
    'preferences_modal_layout' => env('COOKIE_CONSENT_PREFERENCES_LAYOUT', 'bar'),

    /*
    |--------------------------------------------------------------------------
    | Flip Button Animation
    |--------------------------------------------------------------------------
    | If enabled, the consent buttons will have a flip animation effect for better UI interaction.
    | Set this to 'true' to enable the effect or 'false' to disable it.
    */
    'flip_button' => env('COOKIE_CONSENT_FLIP_BUTTON', true),

    /*
    |--------------------------------------------------------------------------
    | Disable Page Interaction
    |--------------------------------------------------------------------------
    | When enabled, the user must interact with the cookie banner before accessing the page content.
    | This is useful for compliance with stricter regulations.
    | Set this to 'true' to enforce interaction or 'false' to allow normal page access.
    */
    'disable_page_interaction' => env('COOKIE_CONSENT_DISABLE_INTERACTION', true),

    /*
    |--------------------------------------------------------------------------
    | Theme Selection
    |--------------------------------------------------------------------------
    | Allows the selection of different visual themes for the cookie consent banner.
    | Available options:
    | - 'default' : Standard theme.
    | - 'dark'    : Dark mode theme.
    | - 'light'   : Light mode theme.
    | - 'custom'  : Use custom styles (must be defined separately).
    | Default is 'default'.
    */
    'theme' => env('COOKIE_CONSENT_THEME', 'default'),

    /*
    |--------------------------------------------------------------------------
    | Cookie Categories
    |--------------------------------------------------------------------------
    | Define different cookie categories that users can enable or disable based on their preferences.
    | The available categories are:
    | - Necessary    : Essential cookies that cannot be disabled.
    | - Analytics    : Cookies used for tracking and website analytics.
    | - Marketing    : Cookies used for advertising and remarketing purposes.
    | - Preferences  : Cookies used to store user preferences.
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
    | Policy Links
    |--------------------------------------------------------------------------
    | Define links to important legal documents such as the Privacy Policy and Terms & Conditions.
    | These links are displayed in the consent banner for transparency.
    */
    'policy_links' => [
        [
            'text' => 'Privacy Policy',
            'link' => env('COOKIE_CONSENT_PRIVACY_POLICY_URL', url('privacy-policy'))
        ],
        [
            'text' => 'Terms and Conditions',
            'link' => env('COOKIE_CONSENT_TERMS_URL', url('terms-and-conditions'))
        ],
    ],
];
