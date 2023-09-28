<?php

namespace App\Http\Controllers;

use App\Models\FacilitiesModulProduct;
use App\Models\ModulProduct;
use Illuminate\Http\Request;

class FacilitiesModulProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facilitiesModulProduct = FacilitiesModulProduct::all();

        return view('AdminPage.Pages.Product.FasilitiesModul.index', compact('facilitiesModulProduct'));
    }

    public function showContent($modulId)
    {
        $fasilities1 = FacilitiesModulProduct::where('list', 1)->where('modulId', $modulId)->get();
        $fasilities2 = FacilitiesModulProduct::where('list', 2)->where('modulId', $modulId)->get();

        return [
            'fasilities1' => $fasilities1,
            'fasilities2' => $fasilities2,
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modulProducts = ModulProduct::all();

        return view('AdminPage.Pages.Product.FasilitiesModul.create', compact('modulProducts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'modulId' => 'required',
            'description' => 'required',
            'list' => 'required',
        ]);

        $descriptions = explode(';', $request->input('description'));

        foreach ($descriptions as $description) {
            FacilitiesModulProduct::create([
                'modulId' => $request->input('modulId'),
                'description' => trim($description),
                'list' => $request->input('list'),
            ]);
        }

        return redirect('/FasilitiesModulProduct');
    }

    /**
     * Display the specified resource.
     */
    public function show(FacilitiesModulProduct $id)
    {
        $facilitiesModulProductShow = FacilitiesModulProduct::find($id);

        return view('AdminPage.Pages.Product.FasilitiesModul.index', compact('facilitiesModulProductShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $facilitiesModulProduct = FacilitiesModulProduct::where('id', $id)->firstorfail();

        $modulProducts = ModulProduct::all();

        return view('AdminPage.Pages.Product.FasilitiesModul.update', compact('facilitiesModulProduct', 'modulProducts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $content = [
            'modulId' => 'required',
            'description' => 'required',
            'list' => 'required',
        ];

        $validatedData = $request->validate($content);

        $facilitiesModulProduct = FacilitiesModulProduct::find($id);

        $facilitiesModulProduct->update($validatedData);

        return redirect('/FasilitiesModulProduct');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $facilitiesModulProduct = FacilitiesModulProduct::findOrFail($id);

        $facilitiesModulProduct->delete();

        return redirect('/FasilitiesModulProduct');
    }
}
