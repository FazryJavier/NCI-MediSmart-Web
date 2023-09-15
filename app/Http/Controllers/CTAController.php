<?php

namespace App\Http\Controllers;

use App\Models\CTA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CTAController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cta = CTA::all();

        return view('AdminPage.Pages.CTA.index', compact('cta'));
    }

    public static function showContent()
    {
        $images = CTA::pluck('image')->all();
        $titles = CTA::pluck('title')->all();
        $descriptions = CTA::pluck('description')->all();

        $imageUrls = array_map(function($image) {
            return asset("storage/$image");
        }, $images);

        return [
            'imageView' => $imageUrls,
            'titleView' => $titles,
            'descriptionView' => $descriptions,
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('AdminPage.Pages.CTA.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'image|file',
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        CTA::create($validatedData);

        return redirect('/CTA');
    }

    /**
     * Display the specified resource.
     */
    public function show(CTA $id)
    {
        $ctaShow = CTA::find($id);

        return view('AdminPage.Pages.CTA.index', compact('ctaShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cta = CTA::where('id', $id)->firstorfail();

        return view('AdminPage.Pages.CTA.update', compact('cta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $content = [
            'image' => 'image|mimes:jpeg,png,jpg,gif',
            'title' => 'required',
            'description' => 'required',
        ];

        $validatedData = $request->validate($content);

        $cta = CTA::find($id);

        if ($request->hasFile('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        $cta->update($validatedData);

        return redirect('/CTA');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cta = CTA::findOrFail($id);

        $imagepath = $cta->image;

        $cta->delete();

        if ($imagepath && Storage::disk('local')->exists($imagepath)) {
            Storage::disk('local')->delete($imagepath);
        }

        return redirect('/CTA');
    }
}
