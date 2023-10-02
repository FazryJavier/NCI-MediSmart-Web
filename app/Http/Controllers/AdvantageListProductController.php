<?php

namespace App\Http\Controllers;

use App\Models\AdvantageListProduct;
use App\Models\AdvantageProduct;
use Illuminate\Http\Request;

class AdvantageListProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $advantageListProduct = AdvantageListProduct::all();

        return view('AdminPage.Pages.Product.AdvantageListProduct.index', compact('advantageListProduct'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $advantageProducts = AdvantageProduct::all();

        return view('AdminPage.Pages.Product.AdvantageListProduct.create', compact('advantageProducts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'advantageId' => 'required',
            'name' => 'required',
        ]);

        $names = explode(';', $validatedData['name']);

        foreach ($names as $name) {
            AdvantageListProduct::create([
                'advantageId' => $validatedData['advantageId'],
                'name' => trim($name),
            ]);
        }

        return redirect('/AdvantageListProduct')->with('success', 'Data created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(AdvantageListProduct $id)
    {
        $advantageListProductShow = AdvantageListProduct::find($id);

        return view('AdminPage.Pages.Product.AdvantageListProduct.index', compact('advantageListProductShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $advantageListProduct = AdvantageListProduct::where('id', $id)->firstorfail();

        $advantageProducts = AdvantageProduct::all();

        return view('AdminPage.Pages.Product.AdvantageListProduct.update', compact('advantageListProduct', 'advantageProducts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $content = [
            'advantageId' => 'required',
            'name' => 'required',
        ];

        $validatedData = $request->validate($content);

        $advantageListProduct = AdvantageListProduct::find($id);

        $advantageListProduct->update($validatedData);

        return redirect('/AdvantageListProduct')->with('success', 'Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $advantageListProduct = AdvantageListProduct::findOrFail($id);

        $advantageListProduct->delete();

        return redirect('/AdvantageListProduct')->with('error', 'Data deleted successfully!');
    }
}
