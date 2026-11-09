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
use App\Http\Controllers\FooterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Landing\AboutPageController;
use App\Http\Controllers\Landing\BlogController;
use App\Http\Controllers\Landing\ModulPageController;
use App\Http\Controllers\Landing\ProductPageController;
use App\Http\Controllers\Landing\TestimonialPageController;
use App\Http\Controllers\Landing\TestimonialSubmissionController;
use App\Models\Article;
use App\Models\ModulProduct;
use App\Models\Product;
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
use App\Http\Controllers\PopupController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SparasiController;
use Illuminate\Http\Request;
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

// Landing Page (public). SEO-friendly lowercase URLs; "{id}-{slug}" pages 301 to their canonical slug.
$slug = '[0-9]+(?:-[a-z0-9-]*)?';

Route::get('/', HomeController::class)->name('home');
Route::get('/produk/{slug}', [ProductPageController::class, 'show'])->where('slug', $slug)->name('produk.show');
Route::get('/modul/{slug}', [ModulPageController::class, 'show'])->where('slug', $slug)->name('modul.show');
Route::get('/tentang-kami', AboutPageController::class)->name('about');
Route::get('/testimoni', TestimonialPageController::class)->name('testimoni');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->where('slug', $slug)->name('blog.show');
Route::view('/demo', 'UserPage.Pages.demo')->name('demo');
Route::post('/demo', [DemoController::class, 'store'])->middleware('throttle:10,1')->name('demo.store');
Route::get('/testimoni/form', [TestimonialSubmissionController::class, 'create'])->name('testimoni.form');
Route::post('/testimoni/form', [TestimonialSubmissionController::class, 'store'])->middleware('throttle:5,1')->name('testimoni.store');
Route::get('/sitemap', [UserController::class, 'showAll'])->name('sitemap');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.xml');

// Legacy URLs (already indexed by Google / shared links): permanent redirects to the new URLs.
Route::get('/ProductView/{id}', fn (int $id) => redirect()->to(Product::query()->findOrFail($id)->publicUrl(), 301))->whereNumber('id');
Route::get('/Modul/{id}', fn (int $id) => redirect()->to(ModulProduct::query()->findOrFail($id)->publicUrl(), 301))->whereNumber('id');
Route::get('/DetailBlog/{id}', fn (int $id) => redirect()->to(Article::query()->findOrFail($id)->publicUrl(), 301))->whereNumber('id');
Route::permanentRedirect('/Modul', '/');
Route::permanentRedirect('/HealthcareSolution', '/tentang-kami');
Route::permanentRedirect('/Testimoni', '/testimoni');
Route::permanentRedirect('/Blog', '/blog');
Route::get('/Demo', fn () => redirect()->route('demo', status: 301)); // GET only: POST /Demo stays the old form endpoint
Route::permanentRedirect('/Sitemap', '/sitemap');
Route::permanentRedirect('/Sitemap.xml', '/sitemap.xml');
// Old demo form posts (cached pages) keep working.
Route::post('/Demo', [DemoController::class, 'store'])->middleware('throttle:10,1');

Route::get('/Admin', [UserController::class, 'index'])->name('Admin');
Route::post('/Admin', [UserController::class, 'authenticate'])->middleware('throttle:5,1');
Route::post('/logout', [UserController::class, 'logout']);

// Creating CMS accounts is restricted to logged-in users with the Admin level.
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/RegistrationJustForAdmin', [RegistrationController::class, 'index']);
    Route::post('/RegistrationJustForAdmin', [RegistrationController::class, 'store']);
});

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
    // Route::get('/ProductList', [ProductListController::class, 'index']);
    // Route::get('/ProductList/create', [ProductListController::class, 'create']);
    // Route::post('/ProductList', [ProductListController::class, 'store']);
    // Route::get('/ProductList/{id}/update', [ProductListController::class, 'edit']);
    // Route::put('/ProductList/{id}', [ProductListController::class, 'update']);
    // Route::delete('/ProductList/{id}', [ProductListController::class, 'destroy']);

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

    // Product Sparasi
    Route::get('/Sparasi', [SparasiController::class, 'index']);
    Route::get('/Sparasi/create', [SparasiController::class, 'create']);
    Route::post('/Sparasi', [SparasiController::class, 'store']);
    Route::get('/Sparasi/{id}/update', [SparasiController::class, 'edit']);
    Route::put('/Sparasi/{id}', [SparasiController::class, 'update']);
    Route::delete('/Sparasi/{id}', [SparasiController::class, 'destroy']);

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

    // Footer
    Route::get('/Footer', [FooterController::class, 'index']);
    Route::get('/Footer/create', [FooterController::class, 'create']);
    Route::post('/Footer', [FooterController::class, 'store']);
    Route::get('/Footer/{id}/update', [FooterController::class, 'edit']);
    Route::put('/Footer/{id}', [FooterController::class, 'update']);
    Route::delete('/Footer/{id}', [FooterController::class, 'destroy']);

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

    // Testimonials sent through the public form (review before copying into Feedback)
    Route::get('/TestimoniMasuk', [TestimonialSubmissionController::class, 'index'])->name('testimoni.submissions');

    // Pop up
    Route::get('/Popup', [PopupController::class, 'index']);
    Route::get('/Popup/create', [PopupController::class, 'create']);
    Route::post('/Popup', [PopupController::class, 'store']);
    Route::get('/Popup/{id}/update', [PopupController::class, 'edit']);
    Route::put('/Popup/{id}', [PopupController::class, 'update']);
    Route::delete('/Popup/{id}', [PopupController::class, 'destroy']);
});

// Show uploaded image.
// Uploaded file names are random hashes, so the response can be cached for a year. Session, cookie
// and CSRF middleware are skipped: every image used to boot a session and set cookies (slow on shared hosting).
Route::get('/storage/file-image/{filename}', function (Request $request, string $filename) {
    $path = storage_path('app/file-image/' . $filename);
    abort_unless(is_file($path), 404);

    $response = response()->file($path, ['Cache-Control' => 'public, max-age=31536000, immutable']);
    $response->setEtag(md5($filename . filemtime($path)));
    $response->isNotModified($request);

    return $response;
})
    // Flat file names only (e.g. "abc123.webp"): blocks "../" path traversal.
    ->where('filename', '[A-Za-z0-9][A-Za-z0-9._-]*')
    ->withoutMiddleware([
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
    ]);
