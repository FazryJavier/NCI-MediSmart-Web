<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $experience = Experience::all();

        return view('AdminPage.Pages.Home.Experience.Experience.index', compact('experience'));
    }

    public function showContent()
    {
        $experience = Experience::latest('id')->first();

        if ($experience) {
            $title = $experience->title;
            $description = $experience->description;

            return [
                'titleView' => $title,
                'descriptionView' => $description,
            ];
        }

        return [
            'titleView' => null,
            'descriptionView' => null,
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('AdminPage.Pages.Home.Experience.Experience.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        Experience::create($validatedData);

        return redirect('/Experience')->with('success', 'Data created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Experience $id)
    {
        $experienceShow = Experience::find($id);

        return view('AdminPage.Pages.Home.Experience.Experience.index', compact('experienceShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $experienceUpdate = Experience::where('id', $id)->firstorfail();

        return view('AdminPage.Pages.Home.Experience.Experience.update', compact('experienceUpdate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $content = [
            'title' => 'required',
            'description' => 'required',
        ];

        $validatedData = $request->validate($content);

        $experience = Experience::find($id);

        $experience->update($validatedData);

        return redirect('/Experience')->with('success', 'Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $experience = Experience::findOrFail($id);

        $experience->delete();

        return redirect('/Experience')->with('error', 'Data deleted successfully!');
    }
}
