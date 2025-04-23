<?php

namespace Devrabiul\CookieConsent;

use Exception;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

class CookieConsentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * This method is called after all other service providers have been registered.
     * It is used to perform any actions required to bootstrap the application services.
     *
     * @return void
     * @throws Exception If there is an error during bootstrapping.
     */
    public function boot(): void
    {
        $this->updateProcessingAssetRoutes();
        $this->registerResources();
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }
    }

    /**
     * Register the publishing of configuration files.
     *
     * This method registers the configuration file for publishing to the application's config directory.
     *
     * @return void
     * @throws Exception If there is an error during publishing.
     */
    private function registerPublishing(): void
    {
        // Normal publish
        $this->publishes([
            __DIR__ . '/config/laravel-cookie-consent.php' => config_path('laravel-cookie-consent.php'),
        ]);
    }

    private function registerResources(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/laravel-cookie-consent.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravel-cookie-consent');
        // $this->commands($this->registerCommands());
    }

    /**
     * Register the application services.
     *
     * This method is called to bind services into the service container.
     * It is used to register the CookieConsent service and load the configuration.
     *
     * @return void
     * @throws Exception If the configuration file cannot be loaded.
     */
    public function register(): void
    {

        $configPath = config_path('laravel-cookie-consent.php');

        if (!file_exists($configPath)) {
            config(['laravel-cookie-consent' => require __DIR__ . '/config/laravel-cookie-consent.php']);
        }

        $this->app->singleton('CookieConsent', function ($app) {
            return new CookieConsent($app['session'], $app['config']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * This method returns an array of services that this provider offers.
     *
     * @return array
     * @throws Exception If there is an error retrieving the services.
     */
    public function provides(): array
    {
        return ['CookieConsent'];
    }

    /**
     * Update the routes for processing asset requests.
     *
     * This method defines a route that serves asset files from the package.
     * It handles the retrieval of files based on the provided path and sets the appropriate MIME type.
     *
     * @return void
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If the file does not exist.
     */
    private function updateProcessingAssetRoutes(): void
    {
        Route::get('/vendor/laravel-cookie-consent/assets/{path}', function ($path) {
            $file = __DIR__ . '/../assets/' . $path;

            if (file_exists($file)) {
                // Get file extension
                $extension = pathinfo($file, PATHINFO_EXTENSION);

                // Mime types based on file extension
                $mimeTypes = [
                    'css' => 'text/css',
                    'js' => 'application/javascript',
                    'png' => 'image/png',
                    'jpg' => 'image/jpeg',
                    'jpeg' => 'image/jpeg',
                    'gif' => 'image/gif',
                    'svg' => 'image/svg+xml',
                    'woff' => 'font/woff',
                    'woff2' => 'font/woff2',
                    'ttf' => 'font/ttf',
                    'otf' => 'font/otf',
                    'eot' => 'application/vnd.ms-fontobject',
                    'json' => 'application/json',
                    'ico' => 'image/x-icon',
                ];

                // Default to application/octet-stream if the extension is not recognized
                $mimeType = $mimeTypes[$extension] ?? 'application/octet-stream';

                return Response::file($file, [
                    'Content-Type' => $mimeType,
                    'Access-Control-Allow-Origin' => '*',
                ]);
            }

            abort(404);
        })->where('path', '.*');
    }
}
