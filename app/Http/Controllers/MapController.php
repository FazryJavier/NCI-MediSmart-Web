<?php

namespace App\Http\Controllers;

use App\Models\Map;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $map = Map::all();

        return view('AdminPage.Pages.Home.LandingMap.index', compact('map'));
    }

    public function showContent()
    {
        $map = Map::latest('id')->first();

        if ($map) {
            $title = $map->title;
            $image = asset("storage/{$map->image}");

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
        return view('AdminPage.Pages.Home.LandingMap.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        Map::create($validatedData);

        return redirect('/LandingMap')->with('success', 'Data created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Map $id)
    {
        $mapShow = Map::find($id);

        return view('AdminPage.Pages.Home.LandingMap.index', compact('mapShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $map = Map::where('id', $id)->firstorfail();

        return view('AdminPage.Pages.Home.LandingMap.update', compact('map'));
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

        $map = Map::find($id);

        if ($request->hasFile('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        $map->update($validatedData);

        return redirect('/LandingMap')->with('success', 'Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $map = Map::findOrFail($id);

        $imagePath = $map->image;

        $map->delete();

        if ($imagePath && Storage::disk('local')->exists($imagePath)) {
            Storage::disk('local')->delete($imagePath);
        }

        return redirect('/LandingMap')->with('error', 'Data deleted successfully!');
    }
}
