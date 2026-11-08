<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ModulProduct;
use App\Models\Product;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /** XML sitemap (https://www.sitemaps.org/protocol.html) with canonical, SEO-friendly URLs. */
    public function index(): Response
    {
        $content = view('UserPage.Layouts.sitemap-xml', [
            'products' => Product::query()->orderBy('id')->get(['id', 'title', 'updated_at']),
            'moduls' => ModulProduct::query()->orderBy('id')->get(['id', 'title', 'updated_at']),
            'articles' => Article::query()->latest('id')->get(['id', 'title', 'updated_at']),
        ])->render();

        return response($content, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }
}
