# Laravel Cookie Consent

A GDPR-compliant solution offering enterprise-grade compliance with fully customizable cookie banners for Laravel applications. Simplifies regulatory requirements while maintaining excellent user experience and complete customization capabilities.

[![Latest Stable Version](https://poser.pugx.org/devrabiul/laravel-cookie-consent/v/stable)](https://packagist.org/packages/devrabiul/laravel-cookie-consent)
[![Total Downloads](https://poser.pugx.org/devrabiul/laravel-cookie-consent/downloads)](https://packagist.org/packages/devrabiul/laravel-cookie-consent)
![GitHub license](https://img.shields.io/github/license/devrabiul/laravel-cookie-consent)
![GitHub Repo stars](https://img.shields.io/github/stars/devrabiul/laravel-cookie-consent?style=social)

## Features

- 🔥 **One-Click Implementation** – Simple installation via Composer with auto-loaded assets
- ⚡ **Zero Performance Impact** – Lightweight with lazy-loaded components
- 🌍 **RTL & i18n Support** – Full right-to-left compatibility + multilingual translations
- 🌙 **Dark Mode Support** – Auto dark/light mode matching system preferences
- 🛡 **Granular Consent Control** – Category-level cookie management (necessary/analytics/marketing)
- 📦 **Complete Customization** – Override every color, text, and layout via config
- 📱 **Responsive Design** – Perfectly adapts to all devices (mobile/tablet/desktop)

## Installation

To get started with Cookie Consent, follow these simple steps:

1. Install the package via Composer:

```bash
composer require devrabiul/laravel-cookie-consent
```

2. Publish the package resources by running:

```bash
php artisan vendor:publish --provider="Devrabiul\CookieConsent\CookieConsentServiceProvider"
```


## Basic Usage

Include these components in your Blade templates:

1. Add styles in the `<head>` section:
```php
{!! CookieConsent::styles() !!}
```

2. Add scripts before closing `</body>`:
```php
{!! CookieConsent::scripts() !!}
```

### Complete Example

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page</title>
    {!! CookieConsent::styles() !!}
</head>
<body>

    <!-- Your content -->
    
    {!! CookieConsent::scripts() !!}
</body>
</html>
```

## Advanced Configuration

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page</title>
    {!! CookieConsent::styles() !!}
</head>
<body>

    <!-- Your content -->
    
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
               'js_action' => 'loadGoogleAnalytics',
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
               'js_action' => 'loadFacebookPixel',
               'title' => 'Marketing Cookies',
               'description' => 'These cookies are used for advertising and tracking purposes.',
           ],
           'preferences' => [
               'enabled' => env('COOKIE_CONSENT_PREFERENCES', false),
               'locked' => false,
               'js_action' => 'loadPreferencesFunc',
               'title' => 'Preferences Cookies',
               'description' => 'These cookies allow the website to remember user preferences.',
           ],
       ]),
       'cookie_title' => 'Cookie Disclaimer',
       'cookie_description' => 'This website uses cookies to enhance your browsing experience, analyze site traffic, and personalize content. By continuing to use this site, you consent to our use of cookies.',
       'cookie_modal_title' => 'Cookie Preferences',
       'cookie_modal_intro' => 'You can customize your cookie preferences below.',
       'cookie_accept_btn_text' => 'Accept All',
       'cookie_reject_btn_text' => 'Reject All',
       'cookie_preferences_btn_text' => 'Manage Preferences',
       'cookie_preferences_save_text' => 'Save Preferences',
   ]) !!}
</body>
</html>
```

### Enable Dark Mode
You need to use theme="dark" in your body tag.

```html
<body theme="dark">
```

## Layout Options

### Config Status Control

```bash
COOKIE_CONSENT_ENABLED=true
COOKIE_CONSENT_PREFERENCES_ENABLED=true

COOKIE_CONSENT_ANALYTICS=true
COOKIE_CONSENT_MARKETING=true
COOKIE_CONSENT_PREFERENCES=true
```

### Consent Modal Styles
- **`box`** - Compact floating dialog
- **`box-inline`** - Inline positioned box
- **`box-wide`** - Expanded floating dialog
- **`cloud`** - Modern floating design
- **`cloud-inline`** - Compact cloud variant
- **`bar`** - Top/bottom banner
- **`bar-inline`** - Compact banner

*Default: `box-wide`*

### Preferences Modal Styles
- **`bar`** - Full-width layout
- **`box`** - Centered popup

*Default: `bar`*

## Configuration

Edit `config/cookie-consent.php` to modify:
- Cookie lifetimes
- Visual styles
- Text content
- Category settings

### Example service loader (replace with your actual implementation)

```javascript
function loadGoogleAnalytics() {
    // Please put your GA script in loadGoogleAnalytics()
    // You can define function name from - {!! CookieConsent::scripts() !!}

    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'YOUR_GA_ID');

    // Load the GA script
    const script = document.createElement('script');
    script.src = 'https://www.googletagmanager.com/gtag/js?id=YOUR_GA_ID';
    script.async = true;
    document.head.appendChild(script);
}

function loadFacebookPixel() {
    // Please put your marketing script in loadFacebookPixel()
    // You can define function name from - {!! CookieConsent::scripts() !!}

    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', 'YOUR_PIXEL_ID');
    fbq('track', 'PageView');
}
```

### 🎯 Get Started Today!
Experience the magic of CookieConsent and enhance your Laravel applications with Cookie Consent.

🔗 **GitHub:** [Laravel Cookie Consent](https://github.com/devrabiul/laravel-cookie-consent)  
🔗 **Packagist:** [https://packagist.org/packages/devrabiul/laravel-cookie-consent](https://packagist.org/packages/devrabiul/laravel-cookie-consent)  

## Contributing

We welcome contributions to CookieConsent! If you would like to contribute, please fork the repository and submit a pull request. For any issues or feature requests, please open an issue on GitHub.

Please:
1. Fork the repository
2. Create your feature branch
3. Submit a pull request

## License

This package is open-sourced software licensed under the [MIT license](LICENSE).

## Contact

For support or inquiries, please reach out to us at [Send Mail](mailto:devrabiul@gmail.com).
