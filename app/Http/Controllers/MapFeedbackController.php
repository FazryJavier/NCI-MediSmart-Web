<?php

namespace App\Http\Controllers;

use App\Models\MapFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MapFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mapFeedback = MapFeedback::all();

        return view('AdminPage.Pages.Testimoni.Map.index', compact('mapFeedback'));
    }

    public function showContent()
    {
        $mapFeedback = MapFeedback::latest('id')->first();

        if ($mapFeedback) {
            $title = $mapFeedback->title;
            $image = asset("storage/{$mapFeedback->image}");

            return [
                'titleView' => $title,
                'imageView' => $image,
            ];
        }

        return [
            'titleView' => null,
            'imageView' => null,
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('AdminPage.Pages.Testimoni.Map.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        MapFeedback::create($validatedData);

        return redirect('/MapFeedback')->with('success', 'Data created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(MapFeedback $id)
    {
        $mapfeedbackShow = MapFeedback::find($id);

        return view('AdminPage.Pages.Testimoni.Map.index', compact('mapfeedbackShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mapFeedback = MapFeedback::where('id', $id)->firstorfail();

        return view('AdminPage.Pages.Testimoni.Map.update', compact('mapFeedback'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $content = [
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ];

        $validatedData = $request->validate($content);

        $mapFeedback = MapFeedback::find($id);

        if ($request->hasFile('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        $mapFeedback->update($validatedData);

        return redirect('/MapFeedback')->with('success', 'Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mapFeedback = MapFeedback::findOrFail($id);

        $imagePath = $mapFeedback->image;

        $mapFeedback->delete();

        if ($imagePath && Storage::disk('local')->exists($imagePath)) {
            Storage::disk('local')->delete($imagePath);
        }

        return redirect('/MapFeedback')->with('error', 'Data deleted successfully!');
    }
}
