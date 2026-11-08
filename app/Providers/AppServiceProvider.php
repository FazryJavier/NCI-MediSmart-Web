<?php

namespace App\Providers;

use App\View\Composers\LandingComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Only landing views need the shared navbar/footer/WhatsApp/CTA/popup data; it is loaded once per request.
        View::composer('UserPage.*', LandingComposer::class);
    }

    // public function boot2(\Illuminate\Http\Request $request)
    // {
    //     if (!empty(env('NGROK_URL')) && $request->server->has('HTTP_X_ORIGINAL_HOST')) {
    //         $this->app['url']->forceRootUrl(env('NGROK_URL'));
    //     }
    // }
}
