@extends('layouts.app')

@section('title', $destination->name . ' - Wisata Kota Semarang')

@php
use Illuminate\Support\Facades\Log;
@endphp

@section('content')
<!-- Hero Section -->
<div class="relative h-[500px] bg-gray-900">
  <img src="{{ $destination->image_url }}"
    alt="{{ $destination->name }}"
    class="w-full h-full object-cover opacity-75"
    onerror="this.src='{{ asset('images/default-destination.jpg') }}'">
  <div class="absolute inset-0 bg-gradient-to-t from-black/75 to-transparent"></div>
  <div class="absolute bottom-0 left-0 right-0 p-8">
    <div class="container mx-auto">
      <div class="flex flex-wrap items-center justify-between">
        <div class="w-full lg:w-2/3">
          <h1 class="text-4xl font-bold text-white mb-4">{{ $destination->name }}</h1>
          <div class="flex items-center text-white/90 mb-4">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span>{{ $destination->address }}</span>
          </div>
          <div class="flex flex-wrap gap-2">
            @foreach($destination->categories as $category)
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
              {{ $category->name }}
            </span>
            @endforeach
          </div>
        </div>
        <div class="w-full lg:w-1/3 mt-4 lg:mt-0">
          <div class="bg-white/10 backdrop-blur-md rounded-lg p-6 text-white">
            <div class="flex items-center justify-between mb-4">
              <span class="text-sm font-medium">Rating</span>
              <div class="flex items-center">
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <span class="ml-1 text-lg font-semibold">{{ number_format($destination->reviews_avg_rating ?? 0, 1) }}</span>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-sm font-medium">Harga Tiket</span>
              <span class="text-lg font-semibold">
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
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-2">
      <!-- Description -->
      <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-2xl font-semibold mb-4">Deskripsi</h2>
        <p class="text-gray-600">{{ $destination->description }}</p>
      </div>

      <!-- Reviews -->
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

          <script>
            // Character counter for comment
            document.getElementById('comment').addEventListener('input', function() {
              const charCount = this.value.length;
              document.getElementById('charCount').textContent = charCount;
            });

            // Auto dismiss alerts after 5 seconds
            function dismissAlert(alertId) {
              const alert = document.getElementById(alertId);
              if (alert) {
                alert.style.opacity = '0';
                setTimeout(() => {
                  alert.style.display = 'none';
                }, 300);
              }
            }

            // Auto dismiss all alerts
            document.addEventListener('DOMContentLoaded', function() {
              const alerts = document.querySelectorAll('[role="alert"]');
              alerts.forEach(alert => {
                setTimeout(() => {
                  alert.style.opacity = '0';
                  setTimeout(() => {
                    alert.style.display = 'none';
                  }, 300);
                }, 5000);
              });
            });

            // Interactive star rating
            document.addEventListener('DOMContentLoaded', function() {
              const ratingContainer = document.getElementById('ratingStars');
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

              // Add hover effect
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
        </div>
        @endauth

        <!-- Reviews List -->
        <div class="space-y-6">
          @php
          $reviews = $destination->reviews()->with('user')->latest()->get();
          @endphp
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
    </div>

    <!-- Sidebar -->
    <div class="lg:col-span-1">
      <!-- Information -->
      <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold mb-4">Informasi</h2>
        <div class="space-y-4">
          @if($destination->opening_hours)
          <div>
            <h3 class="text-sm font-medium text-gray-500">Jam Buka</h3>
            <p class="mt-1 text-gray-900">{{ $destination->opening_hours }}</p>
          </div>
          @endif

          @if($destination->entrance_fee !== null)
          <div>
            <h3 class="text-sm font-medium text-gray-500">Tiket Masuk</h3>
            <p class="mt-1 text-gray-900">
              @if($destination->entrance_fee > 0)
              Rp {{ number_format($destination->entrance_fee, 0, ',', '.') }}
              @else
              Gratis
              @endif
            </p>
          </div>
          @endif

          @if($destination->contact_number)
          <div>
            <h3 class="text-sm font-medium text-gray-500">Kontak</h3>
            <p class="mt-1 text-gray-900">{{ $destination->contact_number }}</p>
          </div>
          @endif

          @if($destination->email)
          <div>
            <h3 class="text-sm font-medium text-gray-500">Email</h3>
            <p class="mt-1 text-gray-900">{{ $destination->email }}</p>
          </div>
          @endif

          @if($destination->website)
          <div>
            <h3 class="text-sm font-medium text-gray-500">Website</h3>
            <a href="{{ $destination->website }}" target="_blank"
              class="mt-1 text-blue-600 hover:text-blue-800 transition block">
              {{ $destination->website }}
            </a>
          </div>
          @endif
        </div>
      </div>

      <!-- Admin Actions -->
      @auth
      @if(auth()->user()->is_admin)
      <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4">Admin Actions</h2>
        <div class="space-y-4">
          <a href="{{ route('destinations.edit', $destination) }}"
            class="w-full inline-flex items-center justify-center px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            Edit Destinasi
          </a>
          <form action="{{ route('destinations.destroy', $destination) }}" method="POST">
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
      </div>
      @endif
      @endauth
    </div>
  </div>
</div>
@endsection