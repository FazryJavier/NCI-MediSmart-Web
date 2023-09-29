<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ModulProduct;
use Illuminate\Http\Request;
use App\Models\AdvantageModulProduct;
use App\Models\FacilitiesModulProduct;
use App\Models\Feedback;
use App\Models\ImageModulProduct;
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

    public function showContentHome()
    {
        $modulProducts = ModulProduct::all();

        return view('UserPage.Pages.modul', compact('modulProducts'));
    }

    public function showModul($id)
    {
        $modulProduct = ModulProduct::where('id', $id)->get();
        $modul = ModulProduct::where('id', $id)->first();
        $advantageModulProducts = AdvantageModulProduct::where('modulId', $id)->get();
        $imageModul1 = ImageModulProduct::where('list', 1)->where('modulId', $id)->first();
        $imageModul2 = ImageModulProduct::where('list', 2)->where('modulId', $id)->first();
        $listfasilitasModulProducts1 = FacilitiesModulProduct::where('list', 1)->where('modulId', $id)->get();
        $listfasilitasModulProducts2 = FacilitiesModulProduct::where('list', 2)->where('modulId', $id)->get();
        $feedback = Feedback::latest()->limit(12)->get();

        return view('UserPage.Pages.modul', compact('modulProduct', 'advantageModulProducts', 'listfasilitasModulProducts1', 'listfasilitasModulProducts2', 'modul', 'feedback', 'imageModul1', 'imageModul2'));
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
            'icon' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
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
            'icon' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
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
