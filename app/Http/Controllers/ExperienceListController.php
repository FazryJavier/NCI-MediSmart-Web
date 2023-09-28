<?php

namespace App\Http\Controllers;

use App\Models\ExperienceList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExperienceListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $experienceList = ExperienceList::all();

        return view('AdminPage.Pages.Home.Experience.ExperienceList.index', compact('experienceList'));
    }

    public function showContent()
    {
        $imageView = ExperienceList::pluck('image');
        $nameView = ExperienceList::pluck('name');
        $descriptionView = ExperienceList::pluck('description');

        return [
            'imageView' => $imageView,
            'nameView' => $nameView,
            'descriptionView' => $descriptionView,
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('AdminPage.Pages.Home.Experience.ExperienceList.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        ExperienceList::create($validatedData);

        return redirect('/ExperienceList');
    }

    /**
     * Display the specified resource.
     */
    public function show(ExperienceList $id)
    {
        $experiencelistShow = ExperienceList::find($id);

        return view('AdminPage.Pages.Home.Experience.ExperienceList.index', compact('experiencelistShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $experiencelistUpdate = ExperienceList::where('id', $id)->firstorfail();

        return view('AdminPage.Pages.Home.Experience.ExperienceList.update', compact('experiencelistUpdate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $content = [
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'name' => 'required',
            'description' => 'required',
        ];

        $validatedData = $request->validate($content);

        $experienceList = ExperienceList::find($id);

        if ($request->hasFile('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        $experienceList->update($validatedData);

        return redirect('/ExperienceList');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $experienceList = ExperienceList::findOrFail($id);

        $imagePath = $experienceList->image;

        $experienceList->delete();

        if ($imagePath && Storage::disk('local')->exists($imagePath)) {
            Storage::disk('local')->delete($imagePath);
        }

        return redirect('/ExperienceList');
    }
}
