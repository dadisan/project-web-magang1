<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Destination;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index()
  {
    $featuredCategories = Category::withCount('destinations')
      ->where('is_active', true)
      ->take(3)
      ->get();

    $featuredDestinations = Destination::with(['categories', 'reviews'])
      ->where('is_active', true)
      ->withAvg('reviews', 'rating')
      ->take(6)
      ->get();

    return view('home', compact('featuredCategories', 'featuredDestinations'));
  }
}
