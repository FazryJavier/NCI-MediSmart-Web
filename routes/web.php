<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdvantageProductController;
use App\Http\Controllers\AllClientController;
use App\Http\Controllers\ClientProductController;
use App\Http\Controllers\CTAController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ExperienceListController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\LandingSliderController;
use App\Http\Controllers\LandingVideoController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ModulProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WhatsappController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Landing Page
Route::get('/', function () {
    $sliderController = app()->make(LandingSliderController::class);
    $sliderContent = $sliderController->showContent();

    $videoController = app()->make(LandingVideoController::class);
    $videoContent = $videoController->showContent();

    $clientController = app()->make(AllClientController::class);
    $clientContent = $clientController->showContent();

    $experienceController = app()->make(ExperienceController::class);
    $experienceContent = $experienceController->showContent();

    $experiencelistController = app()->make(ExperienceListController::class);
    $experiencelistContent = $experiencelistController->showContent();

    $mapController = app()->make(MapController::class);
    $mapContent = $mapController->showContent();

    return view('UserPage/Pages/home', [
        'sliderContent' => $sliderContent,
        'videoContent' => $videoContent,
        'clientContent' => $clientContent,
        'experienceContent' => $experienceContent,
        'experiencelistContent' => $experiencelistContent,
        'mapContent' => $mapContent,
    ]);
});

Route::get('/ProductView/{id}', function () {
    $feedbackController = app()->make(FeedbackController::class);
    $feedbackContent = $feedbackController->showContent();

    return view('UserPage/Pages/product', [
        'feedbackContent' => $feedbackContent,
    ]);
});

Route::get('/Modul', function () {
    return view('UserPage/Pages/modul');
});

Route::get('/HealthcareSolution', function () {
    $aboutController = app()->make(AboutController::class);
    $aboutContent = $aboutController->showContent();

    return view('UserPage/Pages/healthcare', [
        'aboutContent' => $aboutContent,
    ]);
});

Route::get('/Testimoni', function () {
    $feedbackController = app()->make(FeedbackController::class);
    $feedbackContent = $feedbackController->showContent();

    $mapController = app()->make(MapController::class);
    $mapContent = $mapController->showContent();

    return view('UserPage/Pages/testimoni', [
        'feedbackContent' => $feedbackContent,
        'mapContent' => $mapContent,
    ]);
});

Route::get('/Blog', function () {
    return view('UserPage/Pages/blog');
});

Route::get('/DetailBlog', function () {
    return view('UserPage/Pages/detail');
});

Route::get('/Demo', function () {
    return view('UserPage/Pages/demo');
});

// Admin Page
Route::get('/Admin', function () {
    return view('AdminPage/Pages/login');
});

// Landing Slider
Route::get('/LandingSlider', [LandingSliderController::class, 'index']);
Route::get('/LandingSlider/create', [LandingSliderController::class, 'create']);
Route::post('/LandingSlider', [LandingSliderController::class, 'store']);
Route::get('/LandingSlider/{id}/update', [LandingSliderController::class, 'edit']);
Route::put('/LandingSlider/{id}', [LandingSliderController::class, 'update']);
Route::delete('/LandingSlider/{id}', [LandingSliderController::class, 'destroy']);

// Landing Video
Route::get('/LandingVideo', [LandingVideoController::class, 'index']);
Route::get('/LandingVideo/create', [LandingVideoController::class, 'create']);
Route::post('/LandingVideo', [LandingVideoController::class, 'store']);
Route::get('/LandingVideo/{id}/update', [LandingVideoController::class, 'edit']);
Route::put('/LandingVideo/{id}', [LandingVideoController::class, 'update']);
Route::delete('/LandingVideo/{id}', [LandingVideoController::class, 'destroy']);

// Landing Client
Route::get('/LandingClient', [AllClientController::class, 'index']);
Route::get('/LandingClient/create', [AllClientController::class, 'create']);
Route::post('/LandingClient', [AllClientController::class, 'store']);
Route::get('/LandingClient/{id}/update', [AllClientController::class, 'edit']);
Route::put('/LandingClient/{id}', [AllClientController::class, 'update']);
Route::delete('/LandingClient/{id}', [AllClientController::class, 'destroy']);

// Landing Map
Route::get('/LandingMap', [MapController::class, 'index']);
Route::get('/LandingMap/create', [MapController::class, 'create']);
Route::post('/LandingMap', [MapController::class, 'store']);
Route::get('/LandingMap/{id}/update', [MapController::class, 'edit']);
Route::put('/LandingMap/{id}', [MapController::class, 'update']);
Route::delete('/LandingMap/{id}', [MapController::class, 'destroy']);

// Landing Experience
Route::get('/Experience', [ExperienceController::class, 'index']);
Route::get('/Experience/create', [ExperienceController::class, 'create']);
Route::post('/Experience', [ExperienceController::class, 'store']);
Route::get('/Experience/{id}/update', [ExperienceController::class, 'edit']);
Route::put('/Experience/{id}', [ExperienceController::class, 'update']);
Route::delete('/Experience/{id}', [ExperienceController::class, 'destroy']);

// Landing Experience List
Route::get('/ExperienceList', [ExperienceListController::class, 'index']);
Route::get('/ExperienceList/create', [ExperienceListController::class, 'create']);
Route::post('/ExperienceList', [ExperienceListController::class, 'store']);
Route::get('/ExperienceList/{id}/update', [ExperienceListController::class, 'edit']);
Route::put('/ExperienceList/{id}', [ExperienceListController::class, 'update']);
Route::delete('/ExperienceList/{id}', [ExperienceListController::class, 'destroy']);

// Product
Route::get('/Product', [ProductController::class, 'index']);
Route::get('/Product/create', [ProductController::class, 'create']);
Route::post('/Product', [ProductController::class, 'store']);
Route::get('/Product/{id}/update', [ProductController::class, 'edit']);
Route::put('/Product/{id}', [ProductController::class, 'update']);
Route::delete('/Product/{id}', [ProductController::class, 'destroy']);

// Product Modul
Route::get('/ModulProduct', [ModulProductController::class, 'index']);
Route::get('/ModulProduct/create', [ModulProductController::class, 'create']);
Route::post('/ModulProduct', [ModulProductController::class, 'store']);
Route::get('/ModulProduct/{id}/update', [ModulProductController::class, 'edit']);
Route::put('/ModulProduct/{id}', [ModulProductController::class, 'update']);
Route::delete('/ModulProduct/{id}', [ModulProductController::class, 'destroy']);

// Product Client
Route::get('/ClientProduct', [ClientProductController::class, 'index']);
Route::get('/ClientProduct/create', [ClientProductController::class, 'create']);
Route::post('/ClientProduct', [ClientProductController::class, 'store']);
Route::get('/ClientProduct/{id}/update', [ClientProductController::class, 'edit']);
Route::put('/ClientProduct/{id}', [ClientProductController::class, 'update']);
Route::delete('/ClientProduct/{id}', [ClientProductController::class, 'destroy']);

// Product Advantage
Route::get('/AdvantageProduct', [AdvantageProductController::class, 'index']);
Route::get('/AdvantageProduct/create', [AdvantageProductController::class, 'create']);
Route::post('/AdvantageProduct', [AdvantageProductController::class, 'store']);
Route::get('/AdvantageProduct/{id}/update', [AdvantageProductController::class, 'edit']);
Route::put('/AdvantageProduct/{id}', [AdvantageProductController::class, 'update']);
Route::delete('/AdvantageProduct/{id}', [AdvantageProductController::class, 'destroy']);

// About Us
Route::get('/AboutUs', [AboutController::class, 'index']);
Route::get('/AboutUs/create', [AboutController::class, 'create']);
Route::post('/AboutUs', [AboutController::class, 'store']);
Route::get('/AboutUs/{id}/update', [AboutController::class, 'edit']);
Route::put('/AboutUs/{id}', [AboutController::class, 'update']);
Route::delete('/AboutUs/{id}', [AboutController::class, 'destroy']);

// Feedback
Route::get('/Feedback', [FeedbackController::class, 'index']);
Route::get('/Feedback/create', [FeedbackController::class, 'create']);
Route::post('/Feedback', [FeedbackController::class, 'store']);
Route::get('/Feedback/{id}/update', [FeedbackController::class, 'edit']);
Route::put('/Feedback/{id}', [FeedbackController::class, 'update']);
Route::delete('/Feedback/{id}', [FeedbackController::class, 'destroy']);

// CTA 
Route::get('CTA', [CTAController::class, 'index']);
Route::get('/CTA/create', [CTAController::class, 'create']);
Route::post('/CTA', [CTAController::class, 'store']);
Route::get('/CTA/{id}/update', [CTAController::class, 'edit']);
Route::put('/CTA/{id}', [CTAController::class, 'update']);
Route::delete('/CTA/{id}', [CTAController::class, 'destroy']);

// Whatsapp
Route::get('/Whatsapp', [WhatsappController::class, 'index']);
Route::get('/Whatsapp/create', [WhatsappController::class, 'create']);
Route::post('/Whatsapp', [WhatsappController::class, 'store']);
Route::get('/Whatsapp/{id}/update', [WhatsappController::class, 'edit']);
Route::put('/Whatsapp/{id}', [WhatsappController::class, 'update']);
Route::delete('/Whatsapp/{id}', [WhatsappController::class, 'destroy']);

// Show Image
Route::get('/storage/file-image/{filename}', function ($filename) {
    $path = storage_path("app/file-image/{$filename}");
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path);
})->where('filename', '.*');
