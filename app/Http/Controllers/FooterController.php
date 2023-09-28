<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use App\Models\Product;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $footer = Footer::all();

        return view('AdminPage.Pages.Footer.index', compact('footer'));
    }

    public static function showContent()
    {
        $footerContent = Footer::first();

        return $footerContent;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('AdminPage.Pages.Footer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'address_head' => 'nullable',
            'phone_head' => 'nullable',
            'fax_head' => 'nullable',
            'address_branch' => 'nullable',
            'phone_branch' => 'nullable',
            'fax_branch' => 'nullable',
        ]);

        Footer::create($validatedData);

        return redirect('/Footer');
    }

    /**
     * Display the specified resource.
     */
    public function show(Footer $id)
    {
        $footer = Footer::find($id);

        return view('AdminPage.Pages.Footer.index', compact('footer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $footer = Footer::where('id', $id)->firstorfail();

        return view('AdminPage.Pages.Footer.update', compact('footer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $content = [
            'address_head' => 'nullable',
            'phone_head' => 'nullable',
            'fax_head' => 'nullable',
            'address_branch' => 'nullable',
            'phone_branch' => 'nullable',
            'fax_branch' => 'nullable',
        ];

        $validatedData = $request->validate($content);

        $footer = Footer::find($id);

        $footer->update($validatedData);

        return redirect('/Footer');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $footer = Footer::findOrFail($id);

        $footer->delete();

        return redirect('/Footer');
    }
}
