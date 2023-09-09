<?php

namespace App\Http\Controllers;

use App\Models\LandingSlider;
use Illuminate\Http\Request;

class LandingSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $landing = LandingSlider::all();

        return view('AdminPage.Pages.Home.Header.index', compact('landing'));
    }

    public function showContent()
    {
        $titleView = LandingSlider::pluck('title');
        $captionView = LandingSlider::pluck('caption');
        $imageView = LandingSlider::pluck('image');

        $home = LandingSlider::all();

        // return view('UserPage.Pages.home', compact('titleView', 'captionView', 'imageView'));
        return view('UserPage.Pages.home', compact('home'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('AdminPage.Pages.Home.Header.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'title' => 'required',
            'caption' => 'required',
            'image' => 'image|file',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        LandingSlider::create($validatedData);

        return redirect('/LandingSlider');
    }

    /**
     * Display the specified resource.
     */
    public function show(LandingSlider $id)
    {
        //
        $landingShow = LandingSlider::find($id);
        return view('AdminPage.Pages.Home.Header.index', compact('landingShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LandingSlider $landingSlider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LandingSlider $landingSlider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LandingSlider $landingSlider)
    {
        //
    }
}
