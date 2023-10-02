<?php

namespace App\Http\Controllers;

use App\Models\AllClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AllClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = AllClient::all();

        return view('AdminPage.Pages.Home.LandingClient.index', compact('client'));
    }

    public function showContent()
    {
        $client = AllClient::latest('id')->first();

        if ($client) {
            $title = $client->title;
            $image = asset("storage/{$client->image}");

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
        return view('AdminPage.Pages.Home.LandingClient.create');
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

        AllClient::create($validatedData);

        return redirect('/LandingClient')->with('success', 'Data created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(AllClient $id)
    {
        $clientShow = AllClient::find($id);

        return view('AdminPage.Pages.Home.LandingClient.index', compact('clientShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $client = AllClient::where('id', $id)->firstorfail();

        return view('AdminPage.Pages.Home.LandingClient.update', compact('client'));
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

        $client = AllClient::find($id);

        if ($request->hasFile('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        $client->update($validatedData);

        return redirect('/LandingClient')->with('success', 'Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $client = AllClient::findOrFail($id);

        $imagePath = $client->image;

        $client->delete();

        if ($imagePath && Storage::disk('local')->exists($imagePath)) {
            Storage::disk('local')->delete($imagePath);
        }

        return redirect('/LandingClient')->with('error', 'Data deleted successfully!');
    }
}
