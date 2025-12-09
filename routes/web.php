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
    return view('home');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/layout', function () {
    return view('components/layout');
});

Route::get('/menu', function () {
    return view('menu');
})->name('menu');

Route::get('/keranjang', function () {
    return view('keranjang');
})->name('keranjang');


Route::get('/pesanan', function () {
    return view('pesanan');
})->name('pesanan');