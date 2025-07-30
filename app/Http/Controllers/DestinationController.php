<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use App\Jobs\ProcessDestinationImage;

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
        try {
            DB::beginTransaction();

            // Format entrance fee - remove currency formatting
            $entrance_fee = null;
            if ($request->has('entrance_fee') && !empty($request->entrance_fee)) {
                $entrance_fee = str_replace(['Rp', '.', ' '], '', $request->entrance_fee);
                $request->merge(['entrance_fee' => $entrance_fee]);
            }

            // Format opening hours
            $opening_hours = null;
            if (
                $request->has('opening_time') && $request->has('closing_time') &&
                !empty($request->opening_time) && !empty($request->closing_time)
            ) {
                $opening_hours = $request->opening_time . ' - ' . $request->closing_time;
                $request->merge(['opening_hours' => $opening_hours]);
            }

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'address' => 'required|string',
                'categories' => 'required|array',
                'categories.*' => 'exists:categories,id',
                'featured_image' => 'required|image|max:5120',
                'youtube_url' => 'nullable|url',
            ]);

            $validated['slug'] = Str::slug($validated['name']);

            // Save image
            if ($request->hasFile('featured_image')) {
                $image = $request->file('featured_image');
                $filename = 'destinations/' . Str::uuid() . '.' . $image->getClientOriginalExtension();

                // Store the original image
                Storage::disk('public')->put($filename, file_get_contents($image->getRealPath()));

                $validated['featured_image'] = $filename;
            }

            // Create destination with basic info first
            $destination = Destination::create($validated);

            // Attach categories
            $destination->categories()->attach($request->categories);

            // Update additional info (handle null values)
            $destination->update([
                'latitude' => $request->latitude ?: null,
                'longitude' => $request->longitude ?: null,
                'opening_hours' => $opening_hours,
                'entrance_fee' => $entrance_fee,
                'contact_number' => $request->contact_number ?: null,
                'email' => $request->email ?: null,
                'website' => $request->website ?: null,
                'youtube_url' => $request->youtube_url ?: null,
            ]);

            DB::commit();

            return redirect()->route('destinations.show', $destination)
                ->with('success', 'Destinasi berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error creating destination', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan destinasi. Silakan coba lagi: ' . $e->getMessage()]);
        }
    }

    /**
     * Convert YouTube URL to embed format
     */
    private function getYoutubeEmbedUrl($url)
    {
        if (empty($url)) {
            return null;
        }

        // Handle youtu.be short URLs
        if (strpos($url, 'youtu.be') !== false) {
            $videoId = substr($url, strrpos($url, '/') + 1);
            return 'https://www.youtube.com/embed/' . $videoId;
        }

        // Handle youtube.com URLs
        if (strpos($url, 'youtube.com') !== false) {
            parse_str(parse_url($url, PHP_URL_QUERY), $params);
            if (isset($params['v'])) {
                return 'https://www.youtube.com/embed/' . $params['v'];
            }
        }

        return null;
    }

    /**
     * Display the specified resource.
     */
    public function show(Destination $destination)
    {
        $destination->load(['categories', 'reviews.user', 'galleries']);
        $destination->loadAvg('reviews', 'rating');

        // Convert YouTube URL to embed format
        $youtubeEmbedUrl = $this->getYoutubeEmbedUrl($destination->youtube_url);

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

        return view('destinations.show', compact('destination', 'youtubeEmbedUrl'));
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
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string',
                'description' => 'required|string',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'featured_image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
                'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
                'existing_gallery_images' => 'nullable|array',
                'existing_gallery_images.*' => 'string',
                'youtube_url' => 'nullable|url',
            ]);

            // Update basic info
            $destination->update([
                'name' => $validated['name'],
                'address' => $validated['address'],
                'description' => $validated['description'],
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
                'youtube_url' => $validated['youtube_url'],
            ]);

            // Handle featured image
            if ($request->hasFile('featured_image')) {
                // Delete old image if exists
                if ($destination->featured_image) {
                    Storage::disk('public')->delete($destination->featured_image);
                }

                $image = $request->file('featured_image');
                $filename = 'destinations/' . Str::uuid() . '.' . $image->getClientOriginalExtension();
                Storage::disk('public')->put($filename, file_get_contents($image->getRealPath()));
                $destination->update(['featured_image' => $filename]);
            }

            // Handle gallery images
            $galleryImages = $request->existing_gallery_images ?? [];

            // Add new gallery images
            if ($request->hasFile('gallery_images')) {
                foreach ($request->file('gallery_images') as $image) {
                    $filename = 'destinations/gallery/' . Str::uuid() . '.' . $image->getClientOriginalExtension();
                    Storage::disk('public')->put($filename, file_get_contents($image->getRealPath()));
                    $galleryImages[] = $filename;
                }
            }

            // Update gallery_images column
            $destination->update(['gallery_images' => $galleryImages]);

            DB::commit();

            return redirect()
                ->route('destinations.show', $destination)
                ->with('success', 'Destinasi berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating destination', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui destinasi. Silakan coba lagi: ' . $e->getMessage()]);
        }
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
