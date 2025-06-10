<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CheckSettingProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Prevent database queries during Artisan commands like config:clear
        if ($this->app->runningInConsole()) {
            return;
        }

        try {
            $getSettings = Setting::firstOr(function () {
                return Setting::create([
                    'site_name' => 'news',
                    'logo' => '/img/logo.png',
                    'favicon' => 'default',
                    'instagram' => 'https://www.instagram.com/',
                    'twitter' => 'https://www.twitter.com/',
                    'youtube' => 'https://www.youtube.com/',
                    'facebook' => 'https://www.facebook.com/',
                    'street' => 'bader narges 127',
                    'city' => 'cairo',
                    'country' => 'Egypt',
                    'email' => 'news@email.com',
                    'phone' => '01060688891'
                ]);
            });

            View::share(['getSettings' => $getSettings]);
        } catch (\Exception $e) {
            Log::error('Error loading settings in CheckSettingProvider: ' . $e->getMessage());
            View::share(['getSettings' => null]); // Optional fallback
        }
    }
}
