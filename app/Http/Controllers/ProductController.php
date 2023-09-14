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
        $titleView = Product::pluck('title');
        $subtitleView = Product::pluck('subTitle');
        $image_titleView = Product::pluck('image_title');
        $image_showView = Product::pluck('image_show');
        $description_showView = Product::pluck('description_show');
        $description_detailView = Product::pluck('description_detail');
        $flyerView = Product::pluck('flyer');
        $videoView = Product::pluck('video');

        return [
            'titleView' => $titleView,
            'subtitleView' => $subtitleView,
            'image_titleView' => $image_titleView,
            'image_showView' => $image_showView,
            'description_showView' => $description_showView,
            'description_detailView' => $description_detailView,
            'flyerView' => $flyerView,
            'videoView' => $videoView,
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
            'image_title' => 'required|image|file',
            'image_show' => 'required|image|file',
            'description_show' => 'required',
            'description_detail' => 'required',
            'flyer' => 'required',
            'video' => 'required',
        ]);

        if ($request->file('image_title')) {
            $validatedData['image_title'] = $request->file('image_title')->store('file-image');
        }

        if ($request->file('image_show')) {
            $validatedData['image_show'] = $request->file('image_show')->store('file-image');
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
            'image_title' => 'image|mimes:jpeg,png,jpg,gif',
            'image_show' => 'image|mimes:jpeg,png,jpg,gif',
            'description_show' => 'required',
            'description_detail' => 'required',
            'flyer' => 'required',
            'video' => 'required',
        ];

        $validatedData = $request->validate($content);

        $product = Product::find($id);

        if ($request->hasFile('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['image_title'] = $request->file('image')->store('file-image');
            $validatedData['image_show'] = $request->file('image')->store('file-image');
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
