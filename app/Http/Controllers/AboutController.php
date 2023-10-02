<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = About::all();

        return view('AdminPage.Pages.About.index', compact('about'));
    }

    public function showContent()
    {
        $about = About::latest('id')->first();

        if ($about) {
            $video = $about->video;
            $image = asset("storage/{$about->image}");
            $description = $about->description;
            $visi = $about->visi;
            $misi = $about->misi;

            return [
                'videoView' => $video,
                'imageView' => $image,
                'descriptionView' => $description,
                'visiView' => $visi,
                'misiView' => $misi,
            ];
        }

        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('AdminPage.Pages.About.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'video' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'description' => 'required',
            'visi' => 'required',
            'misi' => 'required',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        About::create($validatedData);

        return redirect('/AboutUs')->with('success', 'Data created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(About $id)
    {
        $aboutShow = About::find($id);
        return view('AdminPage.Pages.About.index', compact('aboutShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $aboutUpdate = About::where('id', $id)->firstorfail();

        return view('AdminPage.Pages.About.update', compact('aboutUpdate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $content = [
            'video' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'description' => 'required',
            'visi' => 'required',
            'misi' => 'required',
        ];

        $validatedData = $request->validate($content);

        $about = About::find($id);

        if ($request->hasFile('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        $about->update($validatedData);

        return redirect('/AboutUs')->with('success', 'Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $about = About::findOrFail($id);

        $imagePath = $about->image;

        $about->delete();

        if ($imagePath && Storage::disk('local')->exists($imagePath)) {
            Storage::disk('local')->delete($imagePath);
        }

        return redirect('/AboutUs')->with('error', 'Data deleted successfully!');
    }
}
