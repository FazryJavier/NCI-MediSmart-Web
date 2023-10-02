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
        $landing = LandingSlider::all();

        return view('AdminPage.Pages.Home.LandingSlider.index', compact('landing'));
    }

    public function showContent()
    {
        $latestSliderIds = LandingSlider::orderBy('created_at', 'desc')
            ->limit(8)
            ->pluck('id');

        $titleView = LandingSlider::whereIn('id', $latestSliderIds)->pluck('title');
        $captionView = LandingSlider::whereIn('id', $latestSliderIds)->pluck('caption');
        $imageView = LandingSlider::whereIn('id', $latestSliderIds)->pluck('image');
        $statusView = LandingSlider::whereIn('id', $latestSliderIds)->pluck('status');

        return [
            'titleView' => $titleView,
            'captionView' => $captionView,
            'imageView' => $imageView,
            'statusView' => $statusView,
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('AdminPage.Pages.Home.LandingSlider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'caption' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'status' => 'nullable|boolean',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        LandingSlider::create($validatedData);

        return redirect('/LandingSlider')->with('success', 'Data created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(LandingSlider $id)
    {
        $landingShow = LandingSlider::find($id);

        return view('AdminPage.Pages.Home.LandingSlider.index', compact('landingShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $slider = LandingSlider::where('id', $id)->firstorfail();

        return view('AdminPage.Pages.Home.LandingSlider.update', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $content = [
            'title' => 'required',
            'caption' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'status' => 'required',
        ];

        $validatedData = $request->validate($content);

        $slider = LandingSlider::find($id);

        if ($request->hasFile('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        if ($request->has('status') && $request->input('status') == '0') {
            $validatedData['status'] = 0;
        } else {
            $validatedData['status'] = 1;
        }
        $slider->update($validatedData);

        return redirect('/LandingSlider')->with('success', 'Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $slider = LandingSlider::findOrFail($id);

        $imagePath = $slider->image;

        $slider->delete();

        if ($imagePath && Storage::disk('local')->exists($imagePath)) {
            Storage::disk('local')->delete($imagePath);
        }

        return redirect('/LandingSlider')->with('error', 'Data deleted successfully!');
    }
}
