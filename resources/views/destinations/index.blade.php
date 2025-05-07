@extends('layouts.app')

@section('title', 'Destinasi - Wisata Kota Semarang')

@section('content')
<div class="container mx-auto px-4 py-8">
  <div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Destinasi Wisata</h1>
    @auth
    @if(auth()->user()->is_admin)
    <a href="{{ route('destinations.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
      Tambah Destinasi
    </a>
    @endif
    @endauth
  </div>

  <!-- Filter Section -->
  <div class="bg-white rounded-lg shadow-md p-6 mb-8">
    <form action="{{ route('destinations.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div>
        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
        <select name="category" id="category" class="w-full rounded-lg border-gray-300">
          <option value="">Semua Kategori</option>
          @foreach($categories as $category)
          <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
          </option>
          @endforeach
        </select>
      </div>
      <div>
        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Cari</label>
        <input type="text" name="search" id="search" value="{{ request('search') }}"
          class="w-full rounded-lg border-gray-300" placeholder="Cari destinasi...">
      </div>
      <div class="flex items-end">
        <button type="submit"
          class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
          Cari Destinasi
        </button>
      </div>
    </form>
  </div>

  <!-- Destinations Grid -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse($destinations as $destination)
    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
      <div class="relative h-48 overflow-hidden">
        <img src="{{ $destination->image_url }}"
          alt="{{ $destination->name }}"
          class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-300"
          onerror="this.src='{{ asset('images/default-destination.jpg') }}'">
      </div>
      <div class="p-6">
        <div class="flex items-center justify-between mb-2">
          <div class="flex flex-wrap gap-2">
            @foreach($destination->categories as $category)
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
              {{ $category->name }}
            </span>
            @endforeach
          </div>
          <div class="flex items-center">
            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
            <span class="ml-1 text-sm text-gray-600">{{ number_format($destination->reviews_avg_rating ?? 0, 1) }}</span>
          </div>
        </div>
        <h2 class="text-xl font-semibold text-gray-900 mb-2 hover:text-blue-600">{{ $destination->name }}</h2>
        <p class="text-gray-600 mb-4 line-clamp-3">{{ $destination->description }}</p>
        <div class="flex justify-between items-center">
          <span class="text-sm text-gray-600 line-clamp-1">{{ $destination->address }}</span>
          <a href="{{ route('destinations.show', $destination) }}"
            class="text-blue-600 hover:text-blue-800 font-medium">Lihat Detail</a>
        </div>
      </div>
    </div>
    @empty
    <div class="col-span-full text-center py-12">
      @if(request('search') || request('category'))
      <p class="text-gray-600">Tidak ada destinasi yang ditemukan untuk pencarian ini.</p>
      <a href="{{ route('destinations.index') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800">
        Lihat semua destinasi
      </a>
      @else
      <p class="text-gray-600">Belum ada destinasi yang tersedia.</p>
      @endif
    </div>
    @endforelse
  </div>

  <!-- Pagination -->
  @if($destinations->total() > 0)
  <div class="mt-8">
    {{ $destinations->links() }}
  </div>
  @endif
</div>
@endsection