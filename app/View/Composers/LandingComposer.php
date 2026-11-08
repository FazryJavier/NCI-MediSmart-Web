<?php

namespace App\View\Composers;

use App\Http\Controllers\CTAController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\PopupController;
use App\Http\Controllers\WhatsappController;
use App\Models\Navbar;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Shares the site-wide landing data (navbar, footer, WhatsApp, CTA, popup) with landing views.
 *
 * The data is loaded once per request and memoised on the request, instead of re-running
 * every query for each layout partial that gets rendered.
 */
class LandingComposer
{
    private const KEY = 'landing.shared';

    public function __construct(private readonly Request $request)
    {
    }

    public function compose(View $view): void
    {
        $view->with($this->data());
    }

    /**
     * @return array<string, mixed>
     */
    private function data(): array
    {
        if (! $this->request->attributes->has(self::KEY)) {
            $this->request->attributes->set(self::KEY, [
                'ctaContent' => CTAController::showContent(),
                'whatsappContent' => WhatsappController::showContent(),
                // Eager-load products to avoid one query per menu item.
                'navbarContent' => Navbar::with('products')->get(),
                'footerContent' => FooterController::showContent(),
                'popupContent' => PopupController::showContent(),
            ]);
        }

        return $this->request->attributes->get(self::KEY);
    }
}
