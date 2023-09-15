<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\LandingVideoController;
use App\Http\Controllers\CTAController;
use App\Http\Controllers\WhatsappController;
use App\Models\LandingVideo;

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
        View::composer('*', function ($view) {
            $ctaContent = CTAController::showContent();
            $view->with('ctaContent', $ctaContent);
        });

        View::composer('*', function ($view) {
            $whatsappContent = WhatsappController::showContent();
            $view->with('whatsappContent', $whatsappContent);
        });
    }

    // public function boot2(\Illuminate\Http\Request $request)
    // {
    //     if (!empty(env('NGROK_URL')) && $request->server->has('HTTP_X_ORIGINAL_HOST')) {
    //         $this->app['url']->forceRootUrl(env('NGROK_URL'));
    //     }
    // }
}
