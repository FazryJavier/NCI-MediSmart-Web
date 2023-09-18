<?php

namespace App\Http\Controllers;

use App\Models\Product;
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

    public function showContent()
    {
        $imageView = Product::pluck('image');
        $titleView = Product::pluck('title');
        $subtitleView = Product::pluck('subTitle');
        $descriptionView = Product::pluck('description');

        return [
            'titleView' => $titleView,
            'subtitleView' => $subtitleView,
            'imageView' => $imageView,
            'descriptionView' => $descriptionView,
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        Product::create($validatedData);

        return redirect('/Product');
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
            'image' => 'image|mimes:jpeg,png,jpg,gif',
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

        return redirect('/Product');
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

        return redirect('/Product');
    }
}
