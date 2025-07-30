@extends('layouts.app')

@section('content')
<div class="relative">
  <!-- Hero Section -->
  <div class="relative h-screen max-h-[800px] min-h-[600px] overflow-hidden">
    <img
      src="{{ asset('images/semarang-hero.jpg') }}"
      alt="Semarang City"
      class="w-full h-full object-cover object-[center_25%]"
      loading="eager"
      width="3328"
      height="1872">
    <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-black/20 to-black/60"></div>

    <!-- Content -->
    <div class="absolute inset-0 flex items-center">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-4 drop-shadow-lg">
          Jelajahi Keindahan Kota Semarang
        </h1>
        <p class="text-xl text-white mb-8 drop-shadow-md">
          Temukan destinasi wisata menarik dan pengalaman tak terlupakan di Kota Semarang
        </p>
        <a href="{{ route('destinations.index') }}"
          class="inline-block bg-white/95 backdrop-blur-sm text-blue-600 px-8 py-3 rounded-lg text-lg font-semibold hover:bg-white transition duration-300 shadow-lg">
          Mulai Jelajahi
        </a>
      </div>
    </div>
  </div>

  <!-- Featured Categories -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <h2 class="text-3xl font-bold text-gray-900 mb-8">Kategori Populer</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach($featuredCategories as $category)
      <a href="{{ route('categories.show', $category) }}"
        class="group block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
        <div class="relative h-48">
          <div class="absolute inset-0 bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500"></div>
          <div class="absolute inset-0 flex items-center justify-center">
            <i class="{{ $category->icon ?? 'fas fa-map-marker-alt' }} text-6xl text-white opacity-80"></i>
          </div>
          <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition duration-300"></div>
          <div class="absolute inset-0 flex items-center justify-center">
            <h3 class="text-2xl font-bold text-white">{{ $category->name }}</h3>
          </div>
        </div>
        <div class="p-6">
          <p class="text-gray-600">{{ Str::limit($category->description, 100) }}</p>
          <div class="mt-4 flex justify-between items-center">
            <span class="text-sm text-gray-500">{{ $category->destinations_count }} Destinasi</span>
            <span class="text-blue-600 group-hover:text-blue-800">Lihat Destinasi →</span>
          </div>
        </div>
      </a>
      @endforeach
    </div>
  </div>

  <!-- Featured Destinations -->
  <div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-gray-900 mb-8">Destinasi Terpopuler</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($featuredDestinations as $destination)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
          <div class="h-48 bg-gray-200">
            <img src="{{ $destination->image_url }}" alt="{{ $destination->name }}" class="w-full h-full object-cover">
          </div>
          <div class="p-6">
            <div class="flex items-center justify-between mb-2">
              <span class="text-sm text-gray-600">{{ $destination->categories->first()?->name ?? 'Uncategorized' }}</span>
              <div class="flex items-center">
                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <span class="ml-1 text-sm text-gray-600">{{ number_format($destination->reviews_avg_rating ?? 0, 1) }}</span>
              </div>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $destination->name }}</h3>
            <p class="text-gray-600 mb-4">{{ Str::limit($destination->description, 100) }}</p>
            <div class="flex justify-between items-center">
              <span class="text-sm text-gray-600">{{ $destination->address }}</span>
              <a href="{{ route('destinations.show', $destination) }}"
                class="text-blue-600 hover:text-blue-800">Lihat Detail</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="text-center mt-12">
        <a href="{{ route('destinations.index') }}"
          class="inline-block bg-gray-800 text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-gray-900 transition duration-300">
          Lihat Semua Destinasi
        </a>
      </div>
    </div>
  </div>

  <!-- Why Choose Us -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <h2 class="text-3xl font-bold text-gray-900 mb-12 text-center">Mengapa Memilih Kami</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
      <div class="text-center">
        <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
        </div>
        <h3 class="text-xl font-semibold text-gray-900 mb-2">Destinasi Terpercaya</h3>
        <p class="text-gray-600">Kami menyediakan informasi destinasi wisata yang terpercaya dan terverifikasi.</p>
      </div>
      <div class="text-center">
        <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
        <h3 class="text-xl font-semibold text-gray-900 mb-2">Update Terkini</h3>
        <p class="text-gray-600">Informasi destinasi selalu diperbarui secara berkala untuk memastikan keakuratan. <a href="https://pariwisata.semarangkota.go.id/frontend/web/" target="_blank" class="text-blue-600 hover:text-blue-800">Lihat info terbaru di website resmi</a></p>
      </div>
      <div class="text-center">
        <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
          </svg>
        </div>
        <h3 class="text-xl font-semibold text-gray-900 mb-2">Ulasan Pengguna</h3>
        <p class="text-gray-600">Dapatkan informasi dari pengalaman nyata pengunjung sebelumnya.</p>
      </div>
      <div class="text-center">
        <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
          </svg>
        </div>
        <h3 class="text-xl font-semibold text-gray-900 mb-2">Pemesanan Tiket</h3>
        <p class="text-gray-600">Pesan tiket dengan mudah melalui berbagai platform seperti Traveloka, Tiket.com, dan platform lainnya.</p>
      </div>
    </div>
  </div>
</div>
@endsection