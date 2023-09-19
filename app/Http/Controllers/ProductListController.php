<?php

namespace App\Http\Controllers;

use App\Models\ProductList;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productList = ProductList::all();

        return view('AdminPage.Pages.Product.ProductList.index', compact('productList'));
    }

    public function showContent()
    {
        $products = Product::all();

        $listView = [];

        foreach ($products as $product) {
            $productLists = ProductList::where('productId', $product->id)->get();
            
            $listView[$product->id] = $productLists;
        }

        return [
            'listView' => $listView,
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();

        return view('AdminPage.Pages.Product.ProductList.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'productId' => 'required',
            'list' => 'required',
        ]);

        ProductList::create($validatedData);

        return redirect('/ProductList');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductList $id)
    {
        $productListShow = ProductList::find($id);

        return view('AdminPage.Pages.Product.ProductList.index', compact('productListShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $productList = ProductList::where('id', $id)->firstorfail();

        $products = Product::all();

        return view('AdminPage.Pages.Product.ProductList.update', compact('productList', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $content = [
            'productId' => 'required',
            'list' => 'required',
        ];

        $validatedData = $request->validate($content);

        $productList = ProductList::find($id);

        $productList->update($validatedData);

        return redirect('/ProductList');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $productList = ProductList::findOrFail($id);

        $productList->delete();

        return redirect('/ProductList');
    }
}
