<?php

namespace App\Http\Controllers;

use App\Models\LandingSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        return view('UserPage.Pages.home', compact('home', 'imageView'));
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
            // $validatedData['image'] = $request->file('image')->store('');
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
    public function edit($id)
    {
        $slider = LandingSlider::where('id', $id)->firstorfail();

        return view('AdminPage.Pages.Home.Header.update', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $content = [
            'title' => 'required',
            'caption' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ];

        $validatedData = $request->validate($content);

        $slider = LandingSlider::find($id);

        if ($request->hasFile('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        $slider->update($validatedData);

        return redirect('/LandingSlider');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $slider = LandingSlider::findOrFail($id);
        $slider->delete();

        return redirect('/LandingSlider');
    }
}
