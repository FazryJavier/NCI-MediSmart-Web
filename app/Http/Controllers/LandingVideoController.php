<?php

namespace App\Http\Controllers;

use App\Models\LandingVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $video = LandingVideo::all();

        return view('AdminPage.Pages.Home.LandingVideo.index', compact('video'));
    }

    public function showContent()
    {
        $titleView = LandingVideo::pluck('title');
        $descriptionView = LandingVideo::pluck('description');
        $videoView = LandingVideo::pluck('video');
    
        return [
            'titleView' => $titleView,
            'descriptionView' => $descriptionView,
            'videoView' => $videoView,
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('AdminPage.Pages.Home.LandingVideo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'video' => 'required',
        ]);

        LandingVideo::create($validatedData);

        return redirect('/LandingVideo');
    }

    /**
     * Display the specified resource.
     */
    public function show(LandingVideo $id)
    {
        $landingShow = LandingVideo::find($id);

        return view('AdminPage.Pages.Home.LandingVideo.index', compact('landingShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $videoUpdate = LandingVideo::where('id', $id)->firstorfail();

        return view('AdminPage.Pages.Home.LandingVideo.update', compact('videoUpdate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $content = [
            'title' => 'required',
            'description' => 'required',
            'video' => 'required',
        ];

        $validatedData = $request->validate($content);

        $video = LandingVideo::find($id);

        $video->update($validatedData);

        return redirect('/LandingVideo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $video = LandingVideo::findOrFail($id);

        $video->delete();

        return redirect('/LandingVideo');
    }
}
