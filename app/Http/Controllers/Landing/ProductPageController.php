<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\AdvantageProduct;
use App\Models\ClientProduct;
use App\Models\DetailProduct;
use App\Models\Feedback;
use App\Models\ModulProduct;
use App\Models\Product;
use App\Models\Sparasi;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/** Public product page: /produk/{id}-{slug}. */
class ProductPageController extends Controller
{
    public function show(string $slug): View|RedirectResponse
    {
        $product = Product::query()->findOrFail(Product::idFromSlug($slug));

        if ($slug !== $product->publicSlug()) {
            return redirect()->to($product->publicUrl(), 301);
        }

        return view('UserPage.Pages.product', [
            'product' => $product,
            // A product without a detail record still renders (title/description fallback) instead of 404.
            'detail' => DetailProduct::query()->where('productId', $product->id)->latest('id')->first(),
            'client' => ClientProduct::query()->where('productId', $product->id)->latest('id')->first(),
            'advantages' => AdvantageProduct::query()->with('advantageListProducts')->where('productId', $product->id)->orderBy('id')->get(),
            'sparasi' => Sparasi::query()->where('productId', $product->id)->latest('id')->first(),
            'moduls' => ModulProduct::query()->where('productId', $product->id)->orderBy('id')->get(),
            'testimonials' => Feedback::query()->latest('id')->limit(12)->get(),
        ]);
    }
}
