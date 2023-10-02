<?php

namespace App\Http\Controllers;

use App\Models\ImageModulProduct;
use App\Models\ModulProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageModulProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $imageModulProduct = ImageModulProduct::all();

        return view('AdminPage.Pages.Product.ImageModul.index', compact('imageModulProduct'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modulProducts = ModulProduct::all();

        return view('AdminPage.Pages.Product.ImageModul.create', compact('modulProducts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'modulId' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'list' => 'required',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        ImageModulProduct::create($validatedData);

        return redirect('/ImageModulProduct')->with('success', 'Data created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ImageModulProduct $id)
    {
        $imageModulProductShow = ImageModulProduct::find($id);

        return view('AdminPage.Pages.Product.ImageModul.index', compact('imageModulProductShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $imageModulProduct = ImageModulProduct::where('id', $id)->firstorfail();

        $modulProducts = ModulProduct::all();

        return view('AdminPage.Pages.Product.ImageModul.update', compact('imageModulProduct', 'modulProducts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $content = [
            'modulId' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'list' => 'required',
        ];

        $validatedData = $request->validate($content);

        $imageModulProduct = ImageModulProduct::find($id);

        if ($request->hasFile('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        $imageModulProduct->update($validatedData);

        return redirect('/ImageModulProduct')->with('success', 'Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $imageModulProduct = ImageModulProduct::findOrFail($id);

        $imagepath = $imageModulProduct->image;

        $imageModulProduct->delete();

        if ($imagepath && Storage::disk('local')->exists($imagepath)) {
            Storage::disk('local')->delete($imagepath);
        }

        return redirect('/ImageModulProduct')->with('error', 'Data deleted successfully!');
    }
}
