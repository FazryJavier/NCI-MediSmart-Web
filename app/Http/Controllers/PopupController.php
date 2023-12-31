<?php

namespace App\Http\Controllers;

use App\Models\Popup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PopupController extends Controller
{
    public function index()
    {
        $popup = Popup::all();

        return view('AdminPage.Pages.PopUp.index', compact('popup'));
    }

    public static function showContent()
    { {
            $latestPopup = Popup::latest('id')->first();

            if ($latestPopup) {
                $image = asset("storage/{$latestPopup->image}");
                $status = $latestPopup->status;
                $tanggalawal = $latestPopup->start_date;
                $tanggalakhir = $latestPopup->end_date;
                $link = $latestPopup->link;

                return [
                    'imageView' => $image,
                    'statusView' => $status,
                    'startdateView' => $tanggalawal,
                    'enddateView' => $tanggalakhir,
                    'linkView' => $link,
                ];
            }

            return [
                'imageView' => null,
                'statusView' => null,
                'startdateView' => null,
                'enddateView' => null,
                'linkView' => null,
            ];
        }
    }

    public function create()
    {
        return view('AdminPage.Pages.PopUp.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'status' => 'required|boolean',
            'start_date' => 'date',
            'end_date' => 'date',
            'link' => 'required',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        Popup::create($validatedData);

        return redirect('/Popup')->with('success', 'Data created successfully!');
    }

    public function show(Popup $id)
    {
        $popupShow = Popup::find($id);

        return view('AdminPage.Pages.PopUp.index', compact('popupShow'));
    }

    public function edit($id)
    {
        $popup = Popup::where('id', $id)->firstorfail();

        return view('AdminPage.Pages.PopUp.update', compact('popup'));
    }

    public function update(Request $request, $id)
    {
        $content = [
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'status' => 'required',
            'start_date' => 'date', // Validasi untuk tanggal awal yang dapat bernilai NULL
            'end_date' => 'date',   // Validasi untuk tanggal akhir yang dapat bernilai NULL
            'link' => 'required',   // Validasi untuk tanggal akhir yang dapat bernilai NULL
        ];

        $validatedData = $request->validate($content);

        $popup = Popup::find($id);

        if ($request->hasFile('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('file-image');
        }

        $popup->update($validatedData);

        return redirect('/Popup')->with('success', 'Data updated successfully!');
    }

    public function destroy($id)
    {
        $popup = Popup::findOrFail($id);

        $imagepath = $popup->image;

        $popup->delete();

        if ($imagepath && Storage::disk('local')->exists($imagepath)) {
            Storage::disk('local')->delete($imagepath);
        }

        return redirect('/Popup')->with('error', 'Data deleted successfully!');
    }
}
