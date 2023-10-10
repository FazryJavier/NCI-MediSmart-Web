<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModulProduct;
use App\Models\Product;
use App\Models\Article;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class SitemapController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Sesuaikan dengan model dan data yang sesuai
        $moduls = ModulProduct::all(); // Sesuaikan dengan model dan data yang sesuai
        $articles = Article::all(); // Sesuaikan dengan model dan data yang sesuai

        $view = View::make('UserPage.Layouts.sitemap-xml', compact('products', 'moduls', 'articles'));
        $content = $view->render();

        return Response::make($content)->header('Content-Type', 'text/xml');
    }
}
