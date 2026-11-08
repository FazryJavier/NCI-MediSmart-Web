<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Contracts\View\View;

/** Public "Tentang Kami" (Healthcare Solution) page: /tentang-kami. */
class AboutPageController extends Controller
{
    public function __invoke(): View
    {
        return view('UserPage.Pages.healthcare', [
            'about' => About::query()->latest('id')->first(),
        ]);
    }
}
