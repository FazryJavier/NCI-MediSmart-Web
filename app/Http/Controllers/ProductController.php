<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ModulProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();

        return view('AdminPage.Pages.Product.Product.index', compact('product'));
    }

    public function showModul($id)
    {
        $modulProduct = ModulProduct::where('productId', $id)->get();

        return view('AdminPage.Pages.modul', compact('modulProduct'));
    }
    public function showContent()
    {

        $idView = Product::pluck('id');
        $imageView = Product::pluck('image');
        $titleView = Product::pluck('title');
        $subtitleView = Product::pluck('subTitle');
        $descriptionView = Product::pluck('description');
        $productsWithModulProducts = Product::join('modul_products', 'products.id', '=', 'modul_products.productId')
            ->select('products.*', 'modul_products.*')
            ->latest('products.created_at')
            ->get()
            ->groupBy('productId')
            ->map(function ($group) {
                return $group->take(10);
            })
            ->flatten();

        return [
            'idView' => $idView,
            'titleView' => $titleView,
            'subtitleView' => $subtitleView,
            'descriptionView' => $descriptionView,
            'imageView' => $imageView,
            'modulView' => $productsWithModulProducts,
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('AdminPage.Pages.Product.Product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'subTitle' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        Product::create($validatedData);

        return redirect('/Product')->with('success', 'Data created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $id)
    {
        $productShow = Product::find($id);

        return view('AdminPage.Pages.Product.Product.index', compact('productShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $productUpdate = Product::where('id', $id)->firstorfail();

        return view('AdminPage.Pages.Product.Product.update', compact('productUpdate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $content = [
            'title' => 'required',
            'subTitle' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ];

        $validatedData = $request->validate($content);

        $product = Product::find($id);

        if ($request->hasFile('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        $product->update($validatedData);

        return redirect('/Product')->with('success', 'Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $imagePath = $product->image;

        $product->delete();

        if ($imagePath && Storage::disk('local')->exists($imagePath)) {
            Storage::disk('local')->delete($imagePath);
        }

        return redirect('/Product')->with('error', 'Data deleted successfully!');
    }
}
