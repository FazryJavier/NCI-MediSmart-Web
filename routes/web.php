<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AllClientController;
use App\Http\Controllers\LandingSliderController;
use App\Http\Controllers\LandingVideoController;
use App\Http\Controllers\MapController;
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
// Route::get('/', [LandingSliderController::class, 'showContent']);
Route::get('/', function() {
    $sliderController = app()->make(LandingSliderController::class);
    $sliderContent = $sliderController->showContent();

    $videoController = app()->make(LandingVideoController::class);
    $videoContent = $videoController->showContent();

    $clientController = app()->make(AllClientController::class);
    $clientContent = $clientController->showContent();

    $mapController = app()->make(MapController::class);
    $mapContent = $mapController->showContent();

    return view('UserPage/Pages/home', [
        'sliderContent' => $sliderContent,
        'videoContent' => $videoContent,
        'clientContent' => $clientContent,
        'mapContent' => $mapContent,
    ]);
});


Route::get('/Product', function () {
    return view('UserPage/Pages/product');
});

Route::get('/Modul', function () {
    return view('UserPage/Pages/modul');
});

Route::get('/HealthcareSolution', [AboutController::class, 'showContent']);

Route::get('/Testimoni', function () {
    return view('UserPage/Pages/testimoni');
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

// About Us
Route::get('/AboutUs', [AboutController::class, 'index']);
Route::get('/AboutUs/create', [AboutController::class, 'create']);
Route::post('/AboutUs', [AboutController::class, 'store']);
Route::get('/AboutUs/{id}/update', [AboutController::class, 'edit']);
Route::put('/AboutUs/{id}', [AboutController::class, 'update']);
Route::delete('/AboutUs/{id}', [AboutController::class, 'destroy']);

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

// Show Image
Route::get('/storage/file-image/{filename}', function ($filename) {
    $path = storage_path("app/file-image/{$filename}");
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path);
})->where('filename', '.*');