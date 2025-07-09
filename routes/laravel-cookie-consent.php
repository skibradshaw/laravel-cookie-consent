<?php

use Illuminate\Support\Facades\Route;
use Devrabiul\CookieConsent\Http\Controllers\CookieConsentController;

Route::get('/laravel-cookie-consent/script-utils', [CookieConsentController::class, 'scriptUtils'])->name('laravel-cookie-consent.script-utils');


