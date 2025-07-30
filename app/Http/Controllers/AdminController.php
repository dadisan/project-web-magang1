<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\Category;
use App\Models\Review;
use App\Models\User;

class AdminController extends Controller
{
  public function dashboard()
  {
    return view('admin.dashboard', [
      'destinations_count' => Destination::count(),
      'categories_count' => Category::count(),
      'reviews_count' => Review::count(),
      'users_count' => User::count(),
      'average_rating' => number_format(Review::avg('rating') ?? 0, 1)
    ]);
  }
}
