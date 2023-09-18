<?php

namespace App\Http\Controllers;

use App\Models\DetailProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DetailProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detailProduct = DetailProduct::all();

        return view('AdminPage.Pages.Product.DetailProduct.index', compact('detailProduct'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();

        return view('AdminPage.Pages.Product.DetailProduct.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'productId' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif',
            'description' => 'required',
            'flyer' => 'required',
            'video' => 'required',
        ]);

        if ($request->file('logo')) {
            $validatedData['logo'] = $request->file('logo')->store('file-image');
        }

        DetailProduct::create($validatedData);

        return redirect('/DetailProduct');
    }

    /**
     * Display the specified resource.
     */
    public function show(DetailProduct $id)
    {
        $detailProductShow = DetailProduct::find($id);

        return view('AdminPage.Pages.Product.DetailProduct.index', compact('detailProductShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $detailProduct = DetailProduct::where('id', $id)->firstorfail();

        $products = Product::all();

        return view('AdminPage.Pages.Product.DetailProduct.update', compact('detailProduct', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $content = [
            'productId' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif',
            'description' => 'required',
            'flyer' => 'required',
            'video' => 'required',
        ];

        $validatedData = $request->validate($content);

        $detailProduct = DetailProduct::find($id);

        if ($request->hasFile('logo')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['logo'] = $request->file('logo')->store('file-image');
        }

        $detailProduct->update($validatedData);

        return redirect('/DetailProduct');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $detailProduct = DetailProduct::findOrFail($id);

        $imagepath = $detailProduct->logo;

        $detailProduct->delete();

        if ($imagepath && Storage::disk('local')->exists($imagepath)) {
            Storage::disk('local')->delete($imagepath);
        }

        return redirect('/DetailProduct');
    }
}
