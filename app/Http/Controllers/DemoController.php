<?php

namespace App\Http\Controllers;

use App\Models\Demo;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $demo = Demo::all();

        return view('AdminPage.Pages.Demo.index', compact('demo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('UserPage.Pages.demo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'position' => 'required',
            'instance_name' => 'required',
            'instance_address' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
        ]);

        Demo::create($validatedData);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Demo $id)
    {
        $demoShow = Demo::find($id);
        return view('AdminPage.Pages.Demo.index', compact('demoShow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $demoUpdate = Demo::where('id', $id)->firstorfail();

        return view('AdminPage.Pages.Demo.update', compact('demoUpdate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $content = [
            'name' => 'required',
            'position' => 'required',
            'instance_name' => 'required',
            'instance_address' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
        ];

        $validatedData = $request->validate($content);

        $demo = Demo::find($id);

        $demo->update($validatedData);

        return redirect('/DemoList');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $demo = Demo::findOrFail($id);

        $demo->delete();

        return redirect('/DemoList');
    }
}
