<?php

namespace App\Http\Controllers;

use App\Models\ClientProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientProduct = ClientProduct::all();

        return view('AdminPage.Pages.Product.ClientProduct.index', compact('clientProduct'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();

        return view('AdminPage.Pages.Product.ClientProduct.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'productId' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        ClientProduct::create($validatedData);

        return redirect('/ClientProduct');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClientProduct $id)
    {
        $clientProductShow = ClientProduct::find($id);

        return view('AdminPage.Pages.Product.ClientProduct.index', compact('clientProductShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $clientProduct = ClientProduct::where('id', $id)->firstorfail();

        $products = Product::all();

        return view('AdminPage.Pages.Product.ClientProduct.update', compact('clientProduct', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $content = [
            'productId' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ];

        $validatedData = $request->validate($content);

        $clientProduct = ClientProduct::find($id);

        if ($request->hasFile('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        $clientProduct->update($validatedData);

        return redirect('/ClientProduct');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $clientProduct = ClientProduct::findOrFail($id);

        $imagepath = $clientProduct->image;

        $clientProduct->delete();

        if ($imagepath && Storage::disk('local')->exists($imagepath)) {
            Storage::disk('local')->delete($imagepath);
        }

        return redirect('/ClientProduct');
    }
}
