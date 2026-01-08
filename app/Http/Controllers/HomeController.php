<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{
    $reviews = Review::with('order.user')
        ->latest()
        ->take(4)
        ->get();

    return view('home', compact('reviews'));
}
}
