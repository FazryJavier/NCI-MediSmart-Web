<?php

namespace App\Http\Controllers;

use App\Models\Navbar;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NavbarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $navbar = Navbar::all();

        return view('AdminPage.Pages.Navbar.index', compact('navbar'));
    }

    public static function showContent()
    {
        $navbarContent = Navbar::all();

        return $navbarContent;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();

        return view('AdminPage.Pages.Navbar.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'productId' => 'required',
            'icon' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        if ($request->file('icon')) {
            $validatedData['icon'] = $request->file('icon')->store('file-image');
        }

        Navbar::create($validatedData);

        return redirect('/Navbar')->with('success', 'Data created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Navbar $id)
    {
        $navbar = Navbar::find($id);

        return view('AdminPage.Pages.Navbar.index', compact('navbar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $navbar = Navbar::where('id', $id)->firstorfail();

        $products = Product::all();

        return view('AdminPage.Pages.Navbar.update', compact('navbar', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $content = [
            'productId' => 'required',
            'icon' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ];

        $validatedData = $request->validate($content);

        $navbar = Navbar::find($id);

        if ($request->hasFile('icon')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['icon'] = $request->file('icon')->store('file-image');
        }

        $navbar->update($validatedData);

        return redirect('/Navbar')->with('success', 'Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $navbar = Navbar::findOrFail($id);

        $imagepath = $navbar->image;

        $navbar->delete();

        if ($imagepath && Storage::disk('local')->exists($imagepath)) {
            Storage::disk('local')->delete($imagepath);
        }

        return redirect('/Navbar')->with('error', 'Data deleted successfully!');
    }
}
