<?php

namespace App\Http\Controllers;

use App\Models\Whatsapp;
use Illuminate\Http\Request;

class WhatsappController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $whatsapp = Whatsapp::all();

        return view('AdminPage.Pages.Whatsapp.index', compact('whatsapp'));
    }

    public function showContent()
    {
        $whatsappView = Whatsapp::pluck('phone_number');

        return [
            'whatsappView' => $whatsappView,
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('AdminPage.Pages.Whatsapp.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'phone_number' => 'required',
        ]);

        Whatsapp::create($validatedData);

        return redirect('/Whatsapp');
    }

    /**
     * Display the specified resource.
     */
    public function show(Whatsapp $id)
    {
        $whatsappShow = Whatsapp::find($id);

        return view('AdminPage.Pages.Whatsapp.index', compact('whatsappShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $whatsappUpdate = Whatsapp::where('id', $id)->firstorfail();

        return view('AdminPage.Pages.Whatsapp.update', compact('whatsappUpdate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $content = [
            'phone_number' => 'required',
        ];

        $validatedData = $request->validate($content);

        $whatsapp = Whatsapp::find($id);

        $whatsapp->update($validatedData);

        return redirect('/Whatsapp');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $whatsapp = Whatsapp::findOrFail($id);

        $whatsapp->delete();

        return redirect('/Whatsapp');
    }
}
