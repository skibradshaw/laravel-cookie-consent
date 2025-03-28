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
     * @return string The HTML script tags for the JavaScript.
     */
    public function scripts(): string
    {
        $config = (array)$this->config->get('laravel-cookie-consent');
        
        return self::content(cookieConfig: $config);

        $messages = $this->session->get('laravel-cookie-consent::messages');

        if (!$messages) $messages = [];

        $config = (array)$this->config->get('laravel-cookie-consent.options');

        $script = '<script src="' . url('vendor/laravel-cookie-consent/assets/js/laravel-cookie-consent.js') . '"></script>';
        $script .= '<script type="' . $this->jsType . '">';

        // Output the config as a global JS object
        $script .= 'window.CookieConsentConfig = ' . json_encode($config, JSON_UNESCAPED_SLASHES) . ';';

        $script .= 'document.addEventListener("DOMContentLoaded", function() {';

        $delay = 0; // Initial delay of 0ms

        foreach ($messages as $message) {

            if (count($message['options'])) {
                $config = array_merge($config, $message['options']);
            }

//            if ($config) {
//                $script .= 'toast.options = ' . json_encode($config) . ';';
//            }

            $description = addslashes($message['description']) ?: null;

            // Add a delay for each message
            $script .= 'setTimeout(function() {
                CookieConsent.' . $message['type'] . '("' . addslashes($message['message']) . '", "' . $description . '", '. (isset($config['closeButton']) && $config['closeButton'] ? 'true' : 'false') .', "'. ($config['customBtnText'] ?? '') .'", "'. ($config['customBtnLink'] ?? '') .'");
            }, ' . $delay . ');';

            // Increase the delay for the next message (500ms for each)
            $delay += 1000;
        }

        $script .= '});'; // End of DOMContentLoaded

        $script .= '</script>';

        return $script;
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