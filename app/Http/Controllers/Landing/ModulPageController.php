<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\AdvantageModulProduct;
use App\Models\FacilitiesModulProduct;
use App\Models\Feedback;
use App\Models\ImageModulProduct;
use App\Models\ModulProduct;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/** Public module (sub-product) page: /modul/{id}-{slug}. */
class ModulPageController extends Controller
{
    public function show(string $slug): View|RedirectResponse
    {
        $modul = ModulProduct::query()->with('products')->findOrFail(ModulProduct::idFromSlug($slug));

        if ($slug !== $modul->publicSlug()) {
            return redirect()->to($modul->publicUrl(), 301);
        }

        $images = ImageModulProduct::query()->where('modulId', $modul->id)->orderBy('id')->get()->keyBy('list');
        $facilities = FacilitiesModulProduct::query()->where('modulId', $modul->id)->orderBy('id')->get()->groupBy('list');

        return view('UserPage.Pages.modul', [
            'modul' => $modul,
            'product' => $modul->products,
            'heroImage' => $images->get(1),
            // Two facility blocks, each paired with its image (list 2 and list 3 in the admin).
            'facilityBlocks' => collect([
                ['items' => $facilities->get(1, collect()), 'image' => $images->get(2)],
                ['items' => $facilities->get(2, collect()), 'image' => $images->get(3)],
            ])->filter(fn ($block) => $block['items']->isNotEmpty() || $block['image'])->values(),
            'advantages' => AdvantageModulProduct::query()->where('modulId', $modul->id)->orderBy('id')->get(),
            'testimonials' => Feedback::query()->latest('id')->limit(12)->get(),
        ]);
    }
}
