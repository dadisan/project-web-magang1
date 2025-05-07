<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Destination::with(['categories', 'reviews'])
            ->where('is_active', true)
            ->withAvg('reviews', 'rating');

        // Search by name or description
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%')
                    ->orWhere('address', 'like', '%' . $searchTerm . '%');
            });
        }

        // Filter by category
        if ($request->has('category') && !empty($request->category)) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        $destinations = $query->latest()->paginate(12)->withQueryString();
        $categories = Category::where('is_active', true)->get();

        return view('destinations.index', compact('destinations', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('destinations.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'opening_hours' => 'nullable|string',
            'entrance_fee' => 'nullable|numeric',
            'contact_number' => 'nullable|string',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'featured_image' => 'required|image|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('destinations', 'public');
            $validated['featured_image'] = $path;
        }

        $destination = Destination::create($validated);
        $destination->categories()->attach($request->categories);

        return redirect()->route('destinations.show', $destination)
            ->with('success', 'Destination created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Destination $destination)
    {
        $destination->load(['categories', 'reviews.user', 'galleries']);
        $destination->loadAvg('reviews', 'rating');

        Log::info('Destination show page loaded', [
            'destination_id' => $destination->id,
            'destination_name' => $destination->name,
            'reviews_count' => $destination->reviews->count(),
            'reviews' => $destination->reviews->map(function ($review) {
                return [
                    'id' => $review->id,
                    'rating' => $review->rating,
                    'comment' => $review->comment,
                    'user_id' => $review->user_id,
                    'created_at' => $review->created_at
                ];
            })
        ]);

        return view('destinations.show', compact('destination'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Destination $destination)
    {
        $categories = Category::where('is_active', true)->get();
        return view('destinations.edit', compact('destination', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Destination $destination)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'opening_hours' => 'nullable|string',
            'entrance_fee' => 'nullable|numeric',
            'contact_number' => 'nullable|string',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'featured_image' => 'nullable|image|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('featured_image')) {
            Storage::disk('public')->delete($destination->featured_image);
            $path = $request->file('featured_image')->store('destinations', 'public');
            $validated['featured_image'] = $path;
        }

        $destination->update($validated);
        $destination->categories()->sync($request->categories);

        return redirect()->route('destinations.show', $destination)
            ->with('success', 'Destination updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {
        Storage::disk('public')->delete($destination->featured_image);
        $destination->delete();

        return redirect()->route('destinations.index')
            ->with('success', 'Destination deleted successfully.');
    }
}
