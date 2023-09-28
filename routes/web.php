<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdvantageListProductController;
use App\Http\Controllers\AdvantageModulProductController;
use App\Http\Controllers\AdvantageProductController;
use App\Http\Controllers\AllClientController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ClientProductController;
use App\Http\Controllers\CTAController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\DetailProductController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ExperienceListController;
use App\Http\Controllers\FacilitiesModulProductController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ImageModulProductController;
use App\Http\Controllers\LandingSliderController;
use App\Http\Controllers\LandingVideoController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\MapFeedbackController;
use App\Http\Controllers\ModulProductController;
use App\Http\Controllers\NavbarController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\WhatsappController;
use App\Http\Controllers\UserController;
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

    $clientController = app()->make(AllClientController::class);
    $clientContent = $clientController->showContent();

    $experienceController = app()->make(ExperienceController::class);
    $experienceContent = $experienceController->showContent();

    $experiencelistController = app()->make(ExperienceListController::class);
    $experiencelistContent = $experiencelistController->showContent();

    $mapController = app()->make(MapController::class);
    $mapContent = $mapController->showContent();

    $productController = app()->make(ProductController::class);
    $productContent = $productController->showContent();

    $videoController = app()->make(LandingVideoController::class);
    $videoContent = $videoController->showContent();

    $articleController = app()->make(ArticleController::class);
    $articleContent = $articleController->showContentHome();

    return view('UserPage/Pages/home', [
        'sliderContent' => $sliderContent,
        'clientContent' => $clientContent,
        'experienceContent' => $experienceContent,
        'experiencelistContent' => $experiencelistContent,
        'mapContent' => $mapContent,
        'productContent' => $productContent,
        'videoContent' => $videoContent,
        'articleContent' => $articleContent,
    ]);
});

Route::get('/ProductView/{id}', function ($productId) {
    $detailproductController = app()->make(DetailProductController::class);
    $detailproductContent = $detailproductController->showContent($productId);

    $clientproductController = app()->make(ClientProductController::class);
    $clientproductContent = $clientproductController->showContent($productId);

    $advantageproductController = app()->make(AdvantageProductController::class);
    $advantageproductContent = $advantageproductController->showContent($productId);

    $modulproductController = app()->make(ModulProductController::class);
    $modulproductContent = $modulproductController->showContent($productId);

    $feedbackController = app()->make(FeedbackController::class);
    $feedbackContent = $feedbackController->showContent();

    return view('UserPage/Pages/product', [
        'detailproductContent' => $detailproductContent,
        'clientproductContent' => $clientproductContent,
        'advantageproductContent' => $advantageproductContent,
        'modulproductContent' => $modulproductContent,
        'feedbackContent' => $feedbackContent,
    ]);
});

Route::get('/Modul', [ModulProductController::class, 'showContentHome']);
Route::get('/Modul/{id}', [ModulProductController::class, 'showModul'])->name('modul.show');

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

    $mapfeedbackController = app()->make(MapFeedbackController::class);
    $mapfeedbackContent = $mapfeedbackController->showContent();

    return view('UserPage/Pages/testimoni', [
        'feedbackContent' => $feedbackContent,
        'mapfeedbackContent' => $mapfeedbackContent,
    ]);
});

Route::get('/Blog', [ArticleController::class, 'showContentBlog1']);

Route::get('/DetailBlog/{id}', [ArticleController::class, 'showContentdetailBlog'])->name('detail.show');

Route::get('/Demo', function () {
    return view('UserPage/Pages/demo');
});


Route::get('/Admin', [UserController::class, 'index'])->name('Admin');
Route::post('/Admin', [UserController::class, 'authenticate']);
Route::post('/logout', [UserController::class, 'logout']);

Route::get('/Registration', [RegistrationController::class, 'index']);
Route::post('/Registration', [RegistrationController::class, 'store']);

Route::middleware(['auth'])->group(function () {
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

    // Product List
    Route::get('/ProductList', [ProductListController::class, 'index']);
    Route::get('/ProductList/create', [ProductListController::class, 'create']);
    Route::post('/ProductList', [ProductListController::class, 'store']);
    Route::get('/ProductList/{id}/update', [ProductListController::class, 'edit']);
    Route::put('/ProductList/{id}', [ProductListController::class, 'update']);
    Route::delete('/ProductList/{id}', [ProductListController::class, 'destroy']);

    // Product Detail
    Route::get('/DetailProduct', [DetailProductController::class, 'index']);
    Route::get('/DetailProduct/create', [DetailProductController::class, 'create']);
    Route::post('/DetailProduct', [DetailProductController::class, 'store']);
    Route::get('/DetailProduct/{id}/update', [DetailProductController::class, 'edit']);
    Route::put('/DetailProduct/{id}', [DetailProductController::class, 'update']);
    Route::delete('/DetailProduct/{id}', [DetailProductController::class, 'destroy']);

    // Product Modul
    Route::get('/ModulProduct', [ModulProductController::class, 'index']);
    Route::get('/ModulProduct/create', [ModulProductController::class, 'create']);
    Route::post('/ModulProduct', [ModulProductController::class, 'store']);
    Route::get('/ModulProduct/{id}/update', [ModulProductController::class, 'edit']);
    Route::put('/ModulProduct/{id}', [ModulProductController::class, 'update']);
    Route::delete('/ModulProduct/{id}', [ModulProductController::class, 'destroy']);

    // Product Modul Advantage
    Route::get('/AdvantageModulProduct', [AdvantageModulProductController::class, 'index']);
    Route::get('/AdvantageModulProduct/create', [AdvantageModulProductController::class, 'create']);
    Route::post('/AdvantageModulProduct', [AdvantageModulProductController::class, 'store']);
    Route::get('/AdvantageModulProduct/{id}/update', [AdvantageModulProductController::class, 'edit']);
    Route::put('/AdvantageModulProduct/{id}', [AdvantageModulProductController::class, 'update']);
    Route::delete('/AdvantageModulProduct/{id}', [AdvantageModulProductController::class, 'destroy']);

    // Product Modul Fasilities
    Route::get('/FasilitiesModulProduct', [FacilitiesModulProductController::class, 'index']);
    Route::get('/FasilitiesModulProduct/create', [FacilitiesModulProductController::class, 'create']);
    Route::post('/FasilitiesModulProduct', [FacilitiesModulProductController::class, 'store']);
    Route::get('/FasilitiesModulProduct/{id}/update', [FacilitiesModulProductController::class, 'edit']);
    Route::put('/FasilitiesModulProduct/{id}', [FacilitiesModulProductController::class, 'update']);
    Route::delete('/FasilitiesModulProduct/{id}', [FacilitiesModulProductController::class, 'destroy']);

    // Product Modul Image
    Route::get('/ImageModulProduct', [ImageModulProductController::class, 'index']);
    Route::get('/ImageModulProduct/create', [ImageModulProductController::class, 'create']);
    Route::post('/ImageModulProduct', [ImageModulProductController::class, 'store']);
    Route::get('/ImageModulProduct/{id}/update', [ImageModulProductController::class, 'edit']);
    Route::put('/ImageModulProduct/{id}', [ImageModulProductController::class, 'update']);
    Route::delete('/ImageModulProduct/{id}', [ImageModulProductController::class, 'destroy']);

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

    // Product Advantage List
    Route::get('/AdvantageListProduct', [AdvantageListProductController::class, 'index']);
    Route::get('/AdvantageListProduct/create', [AdvantageListProductController::class, 'create']);
    Route::post('/AdvantageListProduct', [AdvantageListProductController::class, 'store']);
    Route::get('/AdvantageListProduct/{id}/update', [AdvantageListProductController::class, 'edit']);
    Route::put('/AdvantageListProduct/{id}', [AdvantageListProductController::class, 'update']);
    Route::delete('/AdvantageListProduct/{id}', [AdvantageListProductController::class, 'destroy']);

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

    // Map
    Route::get('/MapFeedback', [MapFeedbackController::class, 'index']);
    Route::get('/MapFeedback/create', [MapFeedbackController::class, 'create']);
    Route::post('/MapFeedback', [MapFeedbackController::class, 'store']);
    Route::get('/MapFeedback/{id}/update', [MapFeedbackController::class, 'edit']);
    Route::put('/MapFeedback/{id}', [MapFeedbackController::class, 'update']);
    Route::delete('/MapFeedback/{id}', [MapFeedbackController::class, 'destroy']);

    // Blog 
    Route::get('/Article', [ArticleController::class, 'index']);
    Route::get('/Article/create', [ArticleController::class, 'create']);
    Route::post('/Article', [ArticleController::class, 'store']);
    Route::get('/Article/{id}/update', [ArticleController::class, 'edit']);
    Route::put('/Article/{id}', [ArticleController::class, 'update']);
    Route::delete('/Article/{id}', [ArticleController::class, 'destroy']);

    // Navbar
    Route::get('/Navbar', [NavbarController::class, 'index']);
    Route::get('/Navbar/create', [NavbarController::class, 'create']);
    Route::post('/Navbar', [NavbarController::class, 'store']);
    Route::get('/Navbar/{id}/update', [NavbarController::class, 'edit']);
    Route::put('/Navbar/{id}', [NavbarController::class, 'update']);
    Route::delete('/Navbar/{id}', [NavbarController::class, 'destroy']);

    // Demo 
    Route::get('DemoList', [DemoController::class, 'index']);
    Route::get('/DemoList/create', [DemoController::class, 'create']);
    Route::post('/DemoList', [DemoController::class, 'store']);
    Route::get('/DemoList/{id}/update', [DemoController::class, 'edit']);
    Route::put('/DemoList/{id}', [DemoController::class, 'update']);
    Route::delete('/DemoList/{id}', [DemoController::class, 'destroy']);

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
});

// Show Image
Route::get('/storage/file-image/{filename}', function ($filename) {
    $path = storage_path("app/file-image/{$filename}");
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path);
})->where('filename', '.*');
