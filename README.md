# Laravel Cookie Consent

A GDPR-compliant solution offering enterprise-grade compliance with fully customizable cookie banners for Laravel applications. Simplifies regulatory requirements while maintaining excellent user experience and complete customization capabilities.

## Features

- 🔥 **One-Click Implementation** – Simple installation via Composer with auto-loaded assets
- ⚡ **Zero Performance Impact** – Lightweight with lazy-loaded components
- 🌍 **RTL & i18n Support** – Full right-to-left compatibility + multilingual translations
- 🌙 **Dark Mode Support** – Auto dark/light mode matching system preferences
- 🛡 **Granular Consent Control** – Category-level cookie management (necessary/analytics/marketing)
- 📦 **Complete Customization** – Override every color, text, and layout via config
- 📱 **Responsive Design** – Perfectly adapts to all devices (mobile/tablet/desktop)

## Installation

```bash
composer require devrabiul/laravel-cookie-consent
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
</body>
</html>
```

## Layout Options

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

## Resources

🔗 [GitHub Repository](https://github.com/devrabiul/laravel-cookie-consent)  
🔗 [Documentation Website](https://laravel-cookie-consent.rixetbd.com)  
🔗 [Packagist Page](https://packagist.org/packages/devrabiul/laravel-cookie-consent)

## Contributing

We welcome contributions! Please:
1. Fork the repository
2. Create your feature branch
3. Submit a pull request

## License

MIT License - See [LICENSE.md](LICENSE.md) for details.

## Contact

For support inquiries: [devrabiul@gmail.com](mailto:devrabiul@gmail.com)