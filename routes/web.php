<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\LandingSliderController;
use App\Models\LandingSlider;
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
Route::get('/', [LandingSliderController::class, 'showContent']);

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

// Route::get('/LandingPage-Header', function () {
//     return view('AdminPage/Pages/Home/Header/index');
// });
// Route::get('/LandingPage-Header/create', function () {
//     return view('AdminPage/Pages/Home/Header/create');
// });
// Route::get('/Home', [LandingSliderController::class, 'showContent']);
Route::get('/LandingPage-Header/update', function () {
    return view('AdminPage/Pages/Home/Header/update');
});

Route::get('/LandingPage-Client', function () {
    return view('AdminPage/Pages/Home/Client/index');
});
Route::get('/LandingPage-Client/update', function () {
    return view('AdminPage/Pages/Home/Client/update');
});

Route::get('/LandingPage-Map', function () {
    return view('AdminPage/Pages/Home/Map/index');
});
Route::get('/LandingPage-Map/update', function () {
    return view('AdminPage/Pages/Home/Map/update');
});

// About Us
Route::get('/AboutUs', [AboutController::class, 'index']);
Route::get('/AboutUs/create', [AboutController::class, 'create']);
Route::post('/AboutUs', [AboutController::class, 'store']);
Route::get('/AboutUs/{id}/update', [AboutController::class, 'edit']);
Route::put('/AboutUs/{id}', [AboutController::class, 'update']);
Route::delete('/AboutUs/{id}', [AboutController::class, 'destroy']);

// Show Image
Route::get('/storage/file-image/{filename}', function ($filename) {
    $path = storage_path("app/file-image/{$filename}");
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path);
})->where('filename', '.*');

// Landing Slider

Route::get('/LandingSlider', [LandingSliderController::class, 'index']);
Route::get('/LandingSlider/create', [LandingSliderController::class, 'create']);
Route::post('/LandingSlider', [LandingSliderController::class, 'store']);


// Show Image
Route::get('/storage/file-image/{filename}', function ($filename) {
    $path = storage_path("app/file-image/{$filename}");
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path);
})->where('filename', '.*');
