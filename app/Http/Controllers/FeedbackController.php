<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedback = Feedback::all();

        return view('AdminPage.Pages.Testimoni.Feedback.index', compact('feedback'));
    }

    public function showContent()
    {
        $imageView = Feedback::pluck('image');
        $nameView = Feedback::pluck('name');
        $descriptionView = Feedback::pluck('description');

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
        return view('AdminPage.Pages.Testimoni.Feedback.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        Feedback::create($validatedData);

        return redirect('/Feedback');
    }

    /**
     * Display the specified resource.
     */
    public function show(Feedback $id)
    {
        $feedbackShow = Feedback::find($id);

        return view('AdminPage.Pages.Testimoni.Feedback.index', compact('feedbackShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $feedbackUpdate = Feedback::where('id', $id)->firstorfail();

        return view('AdminPage.Pages.Testimoni.Feedback.update', compact('feedbackUpdate'));
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

        $feedback = Feedback::find($id);

        if ($request->hasFile('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        $feedback->update($validatedData);

        return redirect('/Feedback');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);

        $imagePath = $feedback->image;

        $feedback->delete();

        if ($imagePath && Storage::disk('local')->exists($imagePath)) {
            Storage::disk('local')->delete($imagePath);
        }

        return redirect('/Feedback');
    }
}
