<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\MapFeedback;
use Illuminate\Contracts\View\View;

/** Public testimonials page: /testimoni. */
class TestimonialPageController extends Controller
{
    public function __invoke(): View
    {
        return view('UserPage.Pages.testimoni', [
            'testimonials' => Feedback::query()->latest('id')->get(),
            'map' => MapFeedback::query()->latest('id')->first(),
        ]);
    }
}
