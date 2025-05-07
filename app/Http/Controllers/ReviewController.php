<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\Review;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Destination $destination)
    {
        if (!Auth::check()) {
            Log::warning('Unauthenticated review attempt');
            return redirect()->route('login')
                ->with('error', 'Anda harus login terlebih dahulu untuk memberikan ulasan.');
        }

        Log::info('Review submission attempt', [
            'destination_id' => $destination->id,
            'destination_name' => $destination->name,
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'request_data' => $request->all()
        ]);

        try {
            $validated = $request->validate([
                'rating' => 'required|integer|min:1|max:5',
                'comment' => 'required|string|min:10',
            ], [
                'rating.required' => 'Rating harus diisi.',
                'rating.integer' => 'Rating harus berupa angka.',
                'rating.min' => 'Rating minimal 1.',
                'rating.max' => 'Rating maksimal 5.',
                'comment.required' => 'Komentar harus diisi.',
                'comment.min' => 'Komentar minimal harus 10 karakter.',
            ]);

            Log::info('Validation passed', [
                'validated_data' => $validated
            ]);

            // Create and save the review
            $review = Review::create([
                'destination_id' => $destination->id,
                'user_id' => Auth::id(),
                'rating' => $validated['rating'],
                'comment' => $validated['comment'],
                'is_verified' => true
            ]);

            Log::info('Review created successfully', [
                'review_id' => $review->id,
                'destination_id' => $destination->id,
                'user_id' => Auth::id()
            ]);

            return redirect()->route('destinations.show', $destination)
                ->with('success', 'Ulasan berhasil dikirim.');
        } catch (\Exception $e) {
            Log::error('Error creating review', [
                'error' => $e->getMessage(),
                'destination_id' => $destination->id,
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan ulasan. Silakan coba lagi.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination, Review $review)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Anda harus login terlebih dahulu.');
        }

        if ($review->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus ulasan ini.');
        }

        try {
            $review->delete();
            Log::info('Review deleted successfully', [
                'destination' => $destination->name,
                'user' => Auth::user()->name,
                'review_id' => $review->id
            ]);

            return redirect()->route('destinations.show', $destination)
                ->with('success', 'Ulasan berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting review', [
                'error' => $e->getMessage(),
                'destination' => $destination->name,
                'user' => Auth::user()->name,
                'review_id' => $review->id
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menghapus ulasan.']);
        }
    }
}
