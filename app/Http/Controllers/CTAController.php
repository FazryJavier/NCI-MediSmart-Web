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
        $latestCTA = CTA::latest('id')->first();

        if ($latestCTA) {
            $image = asset("storage/{$latestCTA->image}");
            $title = $latestCTA->title;
            $description = $latestCTA->description;

            return [
                'imageView' => $image,
                'titleView' => $title,
                'descriptionView' => $description,
            ];
        }

        return [
            'imageView' => null,
            'titleView' => null,
            'descriptionView' => null,
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
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        CTA::create($validatedData);

        return redirect('/CTA')->with('success', 'Data created successfully!');
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
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
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

        return redirect('/CTA')->with('success', 'Data updated successfully!');
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

        return redirect('/CTA')->with('error', 'Data deleted successfully!');
    }
}
