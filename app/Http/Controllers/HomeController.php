<?php

namespace App\Http\Controllers;

use App\Models\AllClient;
use App\Models\Article;
use App\Models\Experience;
use App\Models\ExperienceList;
use App\Models\LandingSlider;
use App\Models\LandingVideo;
use App\Models\Map;
use App\Models\ModulProduct;
use App\Models\Product;
use Illuminate\Contracts\View\View;

/**
 * Public home page. Loads each section with a single query and hands the view
 * plain collections/models, so every section can decide how to render 0..n items.
 */
class HomeController extends Controller
{
    /** Max modules listed per product card before collapsing into "+N modul lainnya". */
    public const MODULES_PER_PRODUCT = 5;

    public function __invoke(): View
    {
        $products = Product::query()->orderBy('id')->get();

        $modulesByProduct = ModulProduct::query()
            ->whereIn('productId', $products->modelKeys())
            ->orderBy('id')
            ->get(['id', 'productId', 'title'])
            ->groupBy('productId');

        return view('UserPage.Pages.home', [
            'sliders' => LandingSlider::query()->latest()->limit(8)->get()->sortBy('id')->values(),
            'client' => AllClient::query()->latest('id')->first(),
            'experience' => Experience::query()->latest('id')->first(),
            'experienceItems' => ExperienceList::query()->orderBy('id')->get(),
            'map' => Map::query()->latest('id')->first(),
            'products' => $products,
            'modulesByProduct' => $modulesByProduct,
            'video' => LandingVideo::query()->latest('id')->first(),
            'articles' => Article::query()->latest('id')->limit(12)->get(['id', 'title', 'description', 'image']),
        ]);
    }
}
