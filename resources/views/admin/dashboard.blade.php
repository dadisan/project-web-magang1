@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Dashboard Admin</h1>
    <p class="mt-2 text-gray-600">Selamat datang di panel admin Wisata Kota Semarang</p>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Kelola Destinasi -->
    <div class="bg-white rounded-lg shadow-md p-6">
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold text-gray-900">Destinasi Wisata</h2>
        <span class="text-sm text-gray-500">{{ $destinations_count }} total</span>
      </div>
      <p class="text-gray-600 mb-4">Kelola destinasi wisata yang ada di Kota Semarang</p>
      <div class="space-y-2">
        <a href="{{ route('destinations.index') }}"
          class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
          Lihat Semua Destinasi
        </a>
        <a href="{{ route('destinations.create') }}"
          class="block w-full text-center px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
          Tambah Destinasi Baru
        </a>
      </div>
    </div>

    <!-- Kelola Kategori -->
    <div class="bg-white rounded-lg shadow-md p-6">
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold text-gray-900">Kategori</h2>
        <span class="text-sm text-gray-500">{{ $categories_count }} total</span>
      </div>
      <p class="text-gray-600 mb-4">Kelola kategori untuk mengelompokkan destinasi wisata</p>
      <div class="space-y-2">
        <a href="{{ route('categories.index') }}"
          class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
          Lihat Semua Kategori
        </a>
        <a href="{{ route('categories.create') }}"
          class="block w-full text-center px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
          Tambah Kategori Baru
        </a>
      </div>
    </div>

    <!-- Statistik -->
    <div class="bg-white rounded-lg shadow-md p-6">
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold text-gray-900">Statistik</h2>
      </div>
      <div class="space-y-4">
        <div>
          <p class="text-sm text-gray-500">Total Ulasan</p>
          <p class="text-2xl font-semibold text-gray-900">{{ $reviews_count }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Total Pengguna</p>
          <p class="text-2xl font-semibold text-gray-900">{{ $users_count }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Rating Rata-rata</p>
          <p class="text-2xl font-semibold text-gray-900">{{ $average_rating }}</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection