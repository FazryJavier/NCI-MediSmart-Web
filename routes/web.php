<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('UserPage/Pages/home');
});

Route::get('/HealthcareSolution', function () {
    return view('UserPage/Pages/healthcare');
});

Route::get('/Testimoni', function () {
    return view('UserPage/Pages/testimoni');
});

Route::get('/Blog', function () {
    return view('UserPage/Pages/blog');
});

Route::get('/DetailBlog', function () {
    return view('UserPage/Pages/detail');
});

Route::get('/Modul', function () {
    return view('UserPage/Pages/modul');
});