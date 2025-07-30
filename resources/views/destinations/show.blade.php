@extends('layouts.app')

@section('title', $destination->name . ' - Wisata Kota Semarang')

@php
use Illuminate\Support\Facades\Log;
$reviews = $destination->reviews()->with('user')->latest()->get();
$imageUrl = $destination->image_url ?? asset('images/default-destination.jpg');
$galleryImages = $destination->gallery_images ?? [];

// Array untuk menyimpan link pemesanan tiket khusus
$specialBookingLinks = [
'sam poo kong' => [
[
'url' => 'https://www.tiket.com/to-do/activity-the-great-temple-of-sam-poo-kong-semarang?utm_page=globalSearch&utm_section=globalSearchTyping&source=global_search',
'platform' => 'Tiket.com',
'color' => 'blue',
'text' => 'Pesan Tiket di Tiket.com'
]
],
'lawang sewu' => [
[
'url' => 'https://www.tiket.com/to-do/tour-1-hari-semarang-lawang-sewu-sam-poo-kong-kota-lama-cimory-by-sheyco-tour?utm_page=toDoSearch&utm_section=recommendedActivities',
'platform' => 'Tiket.com',
'color' => 'blue',
'text' => 'Pesan Tour di Tiket.com'
]
],
'dusun semilir' => [
[
'url' => 'https://www.traveloka.com/id-id/activities/indonesia/product/tiket-dusun-semilir-2001772959632',
'platform' => 'Traveloka',
'color' => 'orange',
'text' => 'Pesan Tiket di Traveloka'
]
],
'saloka theme park' => [
[
'url' => 'https://www.tiket.com/to-do/activity-saloka-theme-park-ticket?utm_page=toDoSearch&utm_section=recommendedActivities',
'platform' => 'Tiket.com',
'color' => 'blue',
'text' => 'Pesan Tiket di Tiket.com'
]
],
'semarang zoo' => [
[
'url' => 'https://www.tiket.com/to-do/semarang-zoo?utm_page=toDoSearchResult',
'platform' => 'Tiket.com',
'color' => 'blue',
'text' => 'Pesan Tiket di Tiket.com'
]
],
'funtopia queen city mall' => [
[
'url' => 'https://www.tiket.com/to-do/funtopia-queen-city-mall-semarang?utm_page=toDoSearchResult',
'platform' => 'Tiket.com',
'color' => 'blue',
'text' => 'Pesan Tiket di Tiket.com'
]
],
'umbul sidomukti' => [
[
'url' => 'https://www.tiket.com/homes/indonesia/camping-umbul-sidomukti-601001675063519949',
'platform' => 'Tiket.com',
'color' => 'blue',
'text' => 'Pesan Tiket di Tiket.com'
]
],
// Tambahkan destinasi lain di sini dengan format yang sama
];

// Array untuk menyimpan link video YouTube khusus
$specialVideoLinks = [
'' => 'https://www.youtube.com/embed/WacVt9vFqRE'
];

// Jika destinasi memiliki video khusus, gunakan itu
if (isset($specialVideoLinks[strtolower($destination->name)])) {
$youtubeEmbedUrl = $specialVideoLinks[strtolower($destination->name)];
} else {
// Jika tidak ada video khusus, gunakan video dari database
$youtubeEmbedUrl = $destination->youtube_url ? 'https://www.youtube.com/embed/' . str_replace(['https://youtu.be/', 'https://www.youtube.com/watch?v='], '', $destination->youtube_url) : null;
}
@endphp

@section('content')
<!-- Hero Section with Swiper -->
<div class="relative h-[500px] bg-gray-900">
  <div class="swiper heroSwiper h-full">
    <div class="swiper-wrapper">
      <!-- Main Image -->
      <div class="swiper-slide">
        <img src="{{ $imageUrl }}" alt="{{ $destination->name }}"
          class="w-full h-full object-cover opacity-75">
      </div>
      <!-- Gallery Images (skip if same as featured) -->
      @foreach($galleryImages as $image)
      @php $galleryUrl = asset('storage/' . ltrim($image, '/')); @endphp
      @if($galleryUrl !== $imageUrl)
      <div class="swiper-slide">
        <img src="{{ $galleryUrl }}" alt="{{ $destination->name }} - Gallery Image {{ $loop->iteration }}"
          class="w-full h-full object-cover opacity-75">
      </div>
      @endif
      @endforeach
    </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
  <div class="absolute inset-0 bg-gradient-to-t from-black/75 to-transparent"></div>
  <div class="absolute bottom-0 left-0 right-0 p-8">
    <div class="container mx-auto">
      <div class="flex flex-wrap items-end justify-between">
        <div class="w-full lg:w-2/3">
          <h1 class="text-4xl font-bold text-white mb-4">{{ $destination->name }}</h1>
          <!-- Quick Info -->
          <div class="flex flex-wrap items-center gap-6 text-white/90">
            <!-- Categories -->
            <div class="flex items-center">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
              </svg>
              <div class="flex flex-wrap gap-2">
                @foreach($destination->categories as $category)
                <span class="inline-flex items-center px-2 py-0.5 rounded text-sm bg-white/20 backdrop-blur-sm">
                  {{ $category->name }}
                </span>
                @endforeach
              </div>
            </div>

            <!-- Rating -->
            <div class="flex items-center">
              <svg class="w-5 h-5 mr-2 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
              <span class="text-lg">{{ number_format($destination->reviews_avg_rating ?? 0, 1) }}</span>
            </div>

            <!-- Price -->
            <div class="flex items-center">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <span>
                @if($destination->entrance_fee > 0)
                Rp {{ number_format($destination->entrance_fee, 0, ',', '.') }}
                @else
                Gratis
                @endif
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Content Section -->
<div class="container mx-auto px-4 py-8">
  <div class="max-w-4xl mx-auto">
    <!-- Description -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
      <h2 class="text-2xl font-semibold mb-4">Deskripsi</h2>
      <div class="prose max-w-none">
        {{ $destination->description }}
      </div>

      <!-- YouTube Video -->
      @if($youtubeEmbedUrl)
      @if(config('app.debug'))
      <div class="text-sm text-gray-500 mb-2">
        Original URL: {{ $destination->youtube_url }}<br>
        Embed URL: {{ $youtubeEmbedUrl }}
      </div>
      @endif
      <div class="mt-8">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Video Destinasi</h3>
        <div class="relative w-full" style="padding-bottom: 56.25%;">
          <iframe
            src="{{ $youtubeEmbedUrl }}"
            title="Video {{ $destination->name }}"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
            class="absolute top-0 left-0 w-full h-full rounded-lg shadow-lg">
          </iframe>
        </div>
      </div>
      @endif

      <!-- Ticket Booking Section -->
      <div class="border-t border-gray-200 pt-6">
        <h3 class="text-xl font-semibold mb-4">Pemesanan Tiket</h3>
        <div class="flex flex-wrap gap-3">
          @if(isset($specialBookingLinks[strtolower($destination->name)]))
          @foreach($specialBookingLinks[strtolower($destination->name)] as $link)
          <a href="{{ $link['url'] }}"
            target="_blank"
            class="inline-flex items-center px-4 py-2 bg-{{ $link['color'] }}-500 text-white rounded-lg hover:bg-{{ $link['color'] }}-600 transition">
            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z" />
            </svg>
            {{ $link['text'] }}
          </a>
          @endforeach
          @else
          <a href="https://www.traveloka.com/id-id/attractions/search?q={{ urlencode($destination->name) }}" target="_blank"
            class="inline-flex items-center px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition">
            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z" />
            </svg>
            Pesan di Traveloka
          </a>
          <a href="https://www.tiket.com/attractions/search?q={{ urlencode($destination->name) }}" target="_blank"
            class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z" />
            </svg>
            Pesan di Tiket.com
          </a>
          <a href="https://www.klook.com/id-id/activity/search/?q={{ urlencode($destination->name) }}" target="_blank"
            class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z" />
            </svg>
            Pesan di Klook
          </a>
          @endif
        </div>
        <p class="text-sm text-gray-500 mt-3">* Harga tiket dapat berubah sewaktu-waktu. Silakan cek harga terbaru di platform pemesanan.</p>
      </div>
    </div>

    <!-- Location Information -->
    @if($destination->latitude && $destination->longitude)
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-semibold">Lokasi</h2>
        <a href="https://www.google.com/maps?q={{ $destination->latitude }},{{ $destination->longitude }}"
          target="_blank"
          class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          Buka di Google Maps
        </a>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <h3 class="text-sm font-medium text-gray-500">Alamat Lengkap</h3>
          <p class="mt-1 text-gray-900">{{ $destination->address }}</p>
        </div>
        <div>
          <h3 class="text-sm font-medium text-gray-500">Koordinat</h3>
          <p class="mt-1 text-gray-900">{{ $destination->latitude }}, {{ $destination->longitude }}</p>
        </div>
      </div>
    </div>
    @endif

    <!-- Reviews Section -->
    <div class="bg-white rounded-lg shadow-md p-6">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Ulasan</h2>
        @auth
        <button onclick="document.getElementById('reviewForm').classList.toggle('hidden')"
          class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
          Tulis Ulasan
        </button>
        @endauth
      </div>

      <!-- Review Form -->
      @auth
      <div id="reviewForm" class="hidden mb-8">
        @if(session('success'))
        <div id="successAlert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 transition-opacity duration-300" role="alert">
          <span class="block sm:inline">{{ session('success') }}</span>
          <button type="button" class="absolute top-0 right-0 px-4 py-3" onclick="dismissAlert('successAlert')">
            <svg class="h-4 w-4 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        @endif

        @if($errors->any())
        <div id="errorAlert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 transition-opacity duration-300" role="alert">
          <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
          <button type="button" class="absolute top-0 right-0 px-4 py-3" onclick="dismissAlert('errorAlert')">
            <svg class="h-4 w-4 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        @endif

        <form action="{{ route('reviews.store', $destination) }}" method="POST" class="bg-gray-50 p-6 rounded-lg">
          @csrf
          <div class="mb-4">
            <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">Rating <span class="text-red-500">*</span></label>
            <div class="flex items-center space-x-2" id="ratingStars">
              @for($i = 1; $i <= 5; $i++)
                <label class="cursor-pointer star-label" data-rating="{{ $i }}">
                <input type="radio" name="rating" value="{{ $i }}" class="hidden rating-input" {{ old('rating') == $i ? 'checked' : '' }} required>
                <svg class="w-8 h-8 {{ old('rating') >= $i ? 'text-yellow-400' : 'text-gray-300' }} transition-colors duration-150" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                </label>
                @endfor
            </div>
            @error('rating')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>
          <div class="mb-4">
            <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">
              Komentar <span class="text-red-500">*</span>
              <span class="text-gray-500 text-xs">(minimal 10 karakter)</span>
            </label>
            <textarea name="comment" id="comment" rows="4" required minlength="10"
              class="w-full rounded-lg border-gray-300 @error('comment') border-red-500 @enderror"
              placeholder="Bagikan pengalaman Anda... (minimal 10 karakter)"
              oninvalid="this.setCustomValidity('Komentar minimal harus 10 karakter.')"
              oninput="this.setCustomValidity('')">{{ old('comment') }}</textarea>
            <div class="mt-1 text-sm">
              <span id="charCount" class="text-gray-500">0</span>
              <span class="text-gray-500">/10 karakter minimum</span>
            </div>
            @error('comment')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            Kirim Ulasan
          </button>
        </form>
      </div>
      @endauth

      <!-- Reviews List -->
      <div class="space-y-6">
        @forelse($reviews as $review)
        <div class="bg-gray-50 p-6 rounded-lg">
          <div class="flex justify-between items-start mb-4">
            <div>
              <h3 class="font-semibold">{{ $review->user->name }}</h3>
              <div class="flex items-center mt-1">
                @for($i = 1; $i <= 5; $i++)
                  <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                  fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                  </svg>
                  @endfor
              </div>
            </div>
            <span class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
          </div>
          <p class="text-gray-600">{{ $review->comment }}</p>
          @if(auth()->check() && (auth()->id() === $review->user_id || auth()->user()->is_admin))
          <div class="mt-4">
            <form action="{{ route('reviews.destroy', ['destination' => $destination, 'review' => $review]) }}"
              method="POST" class="inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-600 hover:text-red-800 text-sm transition">
                Hapus Ulasan
              </button>
            </form>
          </div>
          @endif
        </div>
        @empty
        <p class="text-gray-600 text-center py-4">Belum ada ulasan untuk destinasi ini.</p>
        @endforelse
      </div>
    </div>

    <!-- Admin Actions -->
    @auth
    @if(auth()->user()->is_admin)
    <div class="mt-8 flex gap-4">
      <a href="{{ route('destinations.edit', $destination) }}"
        class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        </svg>
        Edit Destinasi
      </a>
      <form action="{{ route('destinations.destroy', $destination) }}" method="POST" class="flex-1">
        @csrf
        @method('DELETE')
        <button type="submit"
          class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition"
          onclick="return confirm('Apakah Anda yakin ingin menghapus destinasi ini?')">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
          Hapus Destinasi
        </button>
      </form>
    </div>
    @endif
    @endauth
  </div>
</div>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center">
  <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white hover:text-gray-300">
    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
    </svg>
  </button>
  <img id="lightboxImage" src="" alt="" class="max-h-[90vh] max-w-[90vw] object-contain">
</div>

<!-- Add Swiper CSS and JS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

@push('scripts')
<script>
  // ... existing scripts ...

  // Initialize Swiper
  document.addEventListener('DOMContentLoaded', function() {
    new Swiper('.heroSwiper', {
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  });

  // Lightbox functions
  function openLightbox(imageUrl) {
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightboxImage');
    lightboxImage.src = imageUrl;
    lightbox.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
  }

  function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    lightbox.classList.add('hidden');
    document.body.style.overflow = '';
  }

  // Close lightbox with Escape key
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      closeLightbox();
    }
  });

  // Interactive star rating
  document.addEventListener('DOMContentLoaded', function() {
    const ratingContainer = document.getElementById('ratingStars');
    if (!ratingContainer) return;

    const stars = ratingContainer.querySelectorAll('.star-label');

    // Function to update stars color
    function updateStars(selectedRating) {
      stars.forEach(star => {
        const rating = parseInt(star.dataset.rating);
        const starSvg = star.querySelector('svg');
        if (rating <= selectedRating) {
          starSvg.classList.remove('text-gray-300');
          starSvg.classList.add('text-yellow-400');
        } else {
          starSvg.classList.remove('text-yellow-400');
          starSvg.classList.add('text-gray-300');
        }
      });
    }

    // Add hover and click effect
    stars.forEach(star => {
      star.addEventListener('mouseenter', () => {
        const rating = parseInt(star.dataset.rating);
        updateStars(rating);
      });

      star.addEventListener('click', () => {
        const rating = parseInt(star.dataset.rating);
        const input = star.querySelector('input');
        input.checked = true;
        updateStars(rating);
      });
    });

    // Reset stars on mouse leave if no rating is selected
    ratingContainer.addEventListener('mouseleave', () => {
      const selectedInput = ratingContainer.querySelector('input:checked');
      const rating = selectedInput ? parseInt(selectedInput.value) : 0;
      updateStars(rating);
    });

    // Set initial state if there's an old value
    const oldRating = document.querySelector('.rating-input:checked');
    if (oldRating) {
      updateStars(parseInt(oldRating.value));
    }
  });
</script>

<style>
  .swiper-button-next,
  .swiper-button-prev {
    color: white !important;
  }

  .swiper-pagination-bullet {
    background: white !important;
  }

  .swiper-pagination-bullet-active {
    background: white !important;
  }
</style>
@endpush

@endsection