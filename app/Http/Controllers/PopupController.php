<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PopupController extends Controller
{
    // app/Http/Controllers/HomeController.php
use App\Popup;

    public function index()
    {
        $popup = Popup::where('waktu_tayang', '<=', now())->first();

        return view('home', compact('popup'));
    }

}
