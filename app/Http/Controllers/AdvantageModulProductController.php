<?php

namespace App\Http\Controllers;

use App\Models\AdvantageModulProduct;
use App\Models\ModulProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdvantageModulProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $advantageModulProduct = AdvantageModulProduct::all();

        return view('AdminPage.Pages.Product.AdvantageModulProduct.index', compact('advantageModulProduct'));
    }

    public function showContent($modulId)
    {
        $advantageModulProducts = AdvantageModulProduct::where('modulId', $modulId)->get();

        return [
            'advantageModulProducts' => $advantageModulProducts,
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modulProducts = ModulProduct::all();

        return view('AdminPage.Pages.Product.AdvantageModulProduct.create', compact('modulProducts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'modulId' => 'required',
            'icon' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($request->file('icon')) {
            $validatedData['icon'] = $request->file('icon')->store('file-image');
        }

        AdvantageModulProduct::create($validatedData);

        return redirect('/AdvantageModulProduct');
    }

    /**
     * Display the specified resource.
     */
    public function show(AdvantageModulProduct $id)
    {
        $advantageModulProductShow = AdvantageModulProduct::find($id);

        return view('AdminPage.Pages.Product.AdvantageModulProduct.index', compact('advantageModulProductShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $advantageModulProduct = AdvantageModulProduct::where('id', $id)->firstorfail();

        $modulProducts = ModulProduct::all();

        return view('AdminPage.Pages.Product.AdvantageModulProduct.update', compact('advantageModulProduct', 'modulProducts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $content = [
            'modulId' => 'required',
            'icon' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'title' => 'required',
            'description' => 'required',
        ];

        $validatedData = $request->validate($content);

        $advantageModulProduct = AdvantageModulProduct::find($id);

        if ($request->hasFile('icon')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['icon'] = $request->file('icon')->store('file-image');
        }

        $advantageModulProduct->update($validatedData);

        return redirect('/AdvantageModulProduct');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $advantageModulProduct = AdvantageModulProduct::findOrFail($id);

        $imagepath = $advantageModulProduct->image;

        $advantageModulProduct->delete();

        if ($imagepath && Storage::disk('local')->exists($imagepath)) {
            Storage::disk('local')->delete($imagepath);
        }

        return redirect('/AdvantageModulProduct');
    }
}
