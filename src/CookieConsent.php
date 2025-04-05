<?php

namespace Devrabiul\CookieConsent;

use Illuminate\Session\SessionManager as Session;
use Illuminate\Config\Repository as Config;

/**
 * Class CookieConsent
 *
 * Handles the display and management of cookie consent UI components in a Laravel application.
 */
class CookieConsent
{
    /**
     * The session manager.
     *
     * @var \Illuminate\Session\SessionManager
     */
    protected $session;

    /**
     * The Config handler instance.
     *
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * The JavaScript type for script tags.
     *
     * @var string
     */
    protected string $jsType = 'text/javascript';

    /**
    * CookieConsent constructor.
    *
    * @param Session $session The session manager instance.
    * @param Config $config The configuration repository instance.
    */
    function __construct(Session $session, Config $config)
    {
        $this->session = $session;
        $this->config = $config;
    }

    /**
     * Generate the HTML for the required stylesheet.
     *
     * @return string The HTML link tag for the stylesheet.
     */
    public function styles(): string
    {
        $style = '<link rel="stylesheet" type="text/css" href="' . url('vendor/laravel-cookie-consent/assets/css/style.css') . '">';
        return $style;
    }

    /**
     * Render the cookie consent view with the given configuration.
     *
     * @param array $cookieConfig Optional cookie configuration overrides.
     * @return \Illuminate\Contracts\View\View The cookie consent view.
     */
    public function content(array $cookieConfig = [])
    {
        return view('laravel-cookie-consent::cookie-consent', compact('cookieConfig'));
    }

    /**
     * Generate the HTML for the required JavaScript with optional configuration overrides.
     *
     * @param array $options Optional configuration overrides.
     * @return \Illuminate\Contracts\View\View The cookie consent script view.
     */
    public function scripts($options = []): mixed
    {
        $config = (array)$this->config->get('laravel-cookie-consent');
        $config = array_merge($config, $options);
        return self::content(cookieConfig: $config);
    }

    /**
     * Set the JavaScript type to 'module', used for Vite-based builds.
     *
     * @return void
     */
    public function useVite(): void
    {
        $this->jsType = 'module';
    }
}