<?php

namespace App\Http\Controllers;

use App\Models\ModulProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModulProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modulProduct = ModulProduct::all();

        return view('AdminPage.Pages.Product.ModulProduct.index', compact('modulProduct'));
    }

    public function showContent($productId)
    {
        $modulProducts = ModulProduct::where('productId', $productId)->get();

        return $modulProducts;
    }

    // public function showContentHome()
    // {
    //     $modul = ModulProduct::latest('id')->get();

    //     $titleView = $modul->pluck('title');
    //     $descriptionView = $modul->pluck('description');
    //     $imageView = $modul->pluck('icon');
    //     $idView = $modul->pluck('id');
    //     return [
    //         'titleView' => $titleView,
    //         'descriptionView' => $descriptionView,
    //         'imageView' => $imageView,
    //         'idView' => $idView,
    //     ];
    // }
    public function showModul($id)
    {
        $modulProduct = ModulProduct::where('id', $id)->first();

        return view('UserPage.Pages.modul', compact('modulProduct'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();

        return view('AdminPage.Pages.Product.ModulProduct.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'productId' => 'required',
            'title' => 'required',
            'description' => 'required',
            'icon' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->file('icon')) {
            $validatedData['icon'] = $request->file('icon')->store('file-image');
        }

        ModulProduct::create($validatedData);

        return redirect('/ModulProduct');
    }

    /**
     * Display the specified resource.
     */
    public function show(ModulProduct $id)
    {
        $modulProductShow = ModulProduct::find($id);

        return view('AdminPage.Pages.Product.ModulProduct.index', compact('modulProductShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $modulProduct = ModulProduct::where('id', $id)->firstorfail();

        $products = Product::all();

        return view('AdminPage.Pages.Product.ModulProduct.update', compact('modulProduct', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $content = [
            'productId' => 'required',
            'title' => 'required',
            'description' => 'required',
            'icon' => 'image|mimes:jpeg,png,jpg,gif',
        ];

        $validatedData = $request->validate($content);

        $modulProduct = ModulProduct::find($id);

        if ($request->hasFile('icon')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['icon'] = $request->file('icon')->store('file-image');
        }

        $modulProduct->update($validatedData);

        return redirect('/ModulProduct');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $modulProduct = ModulProduct::findOrFail($id);

        $imagepath = $modulProduct->image;

        $modulProduct->delete();

        if ($imagepath && Storage::disk('local')->exists($imagepath)) {
            Storage::disk('local')->delete($imagepath);
        }

        return redirect('/ModulProduct');
    }
}
