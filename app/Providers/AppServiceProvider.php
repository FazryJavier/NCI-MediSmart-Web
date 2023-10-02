<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\CTAController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\NavbarController;
use App\Http\Controllers\WhatsappController;
use App\Http\Controllers\PopupController;

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

        View::composer('*', function ($view) {
            $navbarContent = NavbarController::showContent();
            $view->with('navbarContent', $navbarContent);
        });

        View::composer('*', function ($view) {
            $footerContent = FooterController::showContent();
            $view->with('footerContent', $footerContent);
        });

        View::composer('*', function ($view) {
            $popupContent = PopupController::showContent();
            $view->with('popupContent', $popupContent);
        });
    }

    // public function boot2(\Illuminate\Http\Request $request)
    // {
    //     if (!empty(env('NGROK_URL')) && $request->server->has('HTTP_X_ORIGINAL_HOST')) {
    //         $this->app['url']->forceRootUrl(env('NGROK_URL'));
    //     }
    // }
}
