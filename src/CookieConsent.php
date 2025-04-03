<?php

namespace Devrabiul\CookieConsent;

use Illuminate\Session\SessionManager as Session;
use Illuminate\Config\Repository as Config;
use Illuminate\Support\MessageBag;

/**
 * Class CookieConsent
 *
 * This class handles the management of toast notifications in a Laravel application.
 * It provides methods to add flash messages to the session and render the necessary
 * styles and scripts for displaying these messages.
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
     * The Config Handler.
     *
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * The messages stored in the session.
     *
     * @var array
     */
    protected array $messages = [];

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
     * Generate the HTML for the required styles.
     *
     * @return string The HTML link tag for the stylesheet.
     */
    public function styles(): string
    {
        $style = '<link rel="stylesheet" href="' . url('vendor/laravel-cookie-consent/assets/css/laravel-cookie-consent.css') . '">';
        return $style;
    }

    public function content(array $cookieConfig = [])
    {
        return view('laravel-cookie-consent::cookie-consent', compact('cookieConfig'));
    }

    /**
     * Generate the HTML for the required scripts and initialize toast messages.
     *
     * @return mixed The HTML script tags for the JavaScript.
     */
    public function scripts($options = []): mixed
    {
        $config = (array)$this->config->get('laravel-cookie-consent');
        $config = array_merge($config, $options);       
        return self::content(cookieConfig: $config);
    }

    /**
     * Set js type to module for using vite
     *
     * @return void
     */
    public function useVite(): void
    {
        $this->jsType = 'module';
    }
}