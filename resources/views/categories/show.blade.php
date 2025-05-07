@extends('layouts.app')

@section('title', $category->name . ' - Wisata Kota Semarang')

@section('content')
<div class="container mx-auto px-4 py-8">
  <div class="bg-white rounded-lg shadow-md overflow-hidden">
    <!-- Category Header -->
    <div class="bg-gray-800 text-white p-8">
      <div class="flex justify-between items-center">
        <div>
          <h1 class="text-3xl font-bold mb-2">{{ $category->name }}</h1>
          <p class="text-gray-300">{{ $category->description }}</p>
        </div>
        @auth
        @if(auth()->user()->is_admin)
        <div class="flex space-x-4">
          <a href="{{ route('categories.edit', $category) }}"
            class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700">
            Edit Kategori
          </a>
          <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700"
              onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
              Hapus Kategori
            </button>
          </form>
        </div>
        @endif
        @endauth
      </div>
    </div>

    <!-- Destinations -->
    <div class="p-8">
      <h2 class="text-2xl font-semibold mb-6">Destinasi dalam Kategori Ini</h2>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($category->destinations as $destination)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
          <img src="{{ $destination->image_url }}" alt="{{ $destination->name }}"
            class="w-full h-48 object-cover">
          <div class="p-6">
            <div class="flex items-center justify-between mb-2">
              <span class="text-sm text-gray-600">{{ $destination->location }}</span>
              <div class="flex items-center">
                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <span class="ml-1 text-sm text-gray-600">{{ number_format($destination->average_rating, 1) }}</span>
              </div>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $destination->name }}</h3>
            <p class="text-gray-600 mb-4">{{ Str::limit($destination->description, 100) }}</p>
            <a href="{{ route('destinations.show', $destination) }}"
              class="text-blue-600 hover:text-blue-800">Lihat Detail</a>
          </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
          <p class="text-gray-600">Belum ada destinasi dalam kategori ini.</p>
        </div>
        @endforelse
      </div>
    </div>
  </div>
</div>
@endsection