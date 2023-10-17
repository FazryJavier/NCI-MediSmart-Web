<?php

namespace App\Http\Controllers;

use App\Models\Sparasi;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SparasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sparasi = Sparasi::all();

        return view('AdminPage.Pages.Product.SparasiProduct.index', compact('sparasi'));
    }

    public function showContent($productId)
    {
        $sparasi = Sparasi::where('productId', $productId)->first();

        $imageView = $sparasi ? $sparasi->image : 'path_to_default_image.jpg';

        return [
            'imageView' => $imageView,
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();

        return view('AdminPage.Pages.Product.SparasiProduct.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'productId' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        Sparasi::create($validatedData);

        return redirect('/Sparasi')->with('success', 'Data created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sparasi $id)
    {
        $sparasiShow = Sparasi::find($id);

        return view('AdminPage.Pages.Product.SparasiProduct.index', compact('sparasiShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sparasi = Sparasi::where('id', $id)->firstorfail();

        $products = Product::all();

        return view('AdminPage.Pages.Product.SparasiProduct.update', compact('sparasi', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $content = [
            'productId' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ];

        $validatedData = $request->validate($content);

        $sparasi = Sparasi::find($id);

        if ($request->hasFile('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        $sparasi->update($validatedData);

        return redirect('/Sparasi')->with('success', 'Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sparasi = Sparasi::findOrFail($id);

        $imagepath = $sparasi->image;

        $sparasi->delete();

        if ($imagepath && Storage::disk('local')->exists($imagepath)) {
            Storage::disk('local')->delete($imagepath);
        }

        return redirect('/Sparasi')->with('error', 'Data deleted successfully!');
    }
}
