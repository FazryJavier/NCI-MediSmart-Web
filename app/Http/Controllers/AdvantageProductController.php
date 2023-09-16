<?php

namespace App\Http\Controllers;

use App\Models\AdvantageProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdvantageProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $advantageProduct = AdvantageProduct::all();

        return view('AdminPage.Pages.Product.AdvantageProduct.index', compact('advantageProduct'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();

        return view('AdminPage.Pages.Product.AdvantageProduct.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'productId' => 'required',
            'icon' => 'image|mimes:jpeg,png,jpg,gif',
            'title' => 'required',
        ]);

        if ($request->file('image')) {
            $validatedData['icon'] = $request->file('image')->store('file-image');
        }

        AdvantageProduct::create($validatedData);

        return redirect('/AdvantageProduct');
    }

    /**
     * Display the specified resource.
     */
    public function show(AdvantageProduct $id)
    {
        $advantageProductShow = AdvantageProduct::find($id);

        return view('AdminPage.Pages.Product.AdvantageProduct.index', compact('advantageProductShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $advantageProduct = AdvantageProduct::where('id', $id)->firstorfail();

        $products = Product::all();

        return view('AdminPage.Pages.Product.AdvantageProduct.update', compact('advantageProduct', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $content = [
            'productId' => 'required',
            'icon' => 'image|mimes:jpeg,png,jpg,gif',
            'title' => 'required',
        ];

        $validatedData = $request->validate($content);

        $advantageProduct = AdvantageProduct::find($id);

        if ($request->hasFile('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['icon'] = $request->file('image')->store('file-image');
        }

        $advantageProduct->update($validatedData);

        return redirect('/AdvantageProduct');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $advantageProduct = AdvantageProduct::findOrFail($id);

        $imagepath = $advantageProduct->image;

        $advantageProduct->delete();

        if ($imagepath && Storage::disk('local')->exists($imagepath)) {
            Storage::disk('local')->delete($imagepath);
        }

        return redirect('/AdvantageProduct');
    }
}
