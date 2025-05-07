@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Tambah Destinasi Baru</h1>
        <a href="{{ route('destinations.index') }}" class="text-gray-600 hover:text-gray-900">
          Kembali ke Daftar Destinasi
        </a>
      </div>

      <form action="{{ route('destinations.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="space-y-6">
          <!-- Name -->
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Destinasi</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
              class="w-full rounded-lg border-gray-300 @error('name') border-red-500 @enderror">
            @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Category -->
          <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
            <select name="category_id" id="category_id" required
              class="w-full rounded-lg border-gray-300 @error('category_id') border-red-500 @enderror">
              <option value="">Pilih Kategori</option>
              @foreach($categories as $category)
              <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
              </option>
              @endforeach
            </select>
            @error('category_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Location -->
          <div>
            <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
            <input type="text" name="location" id="location" value="{{ old('location') }}" required
              class="w-full rounded-lg border-gray-300 @error('location') border-red-500 @enderror">
            @error('location')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Description -->
          <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea name="description" id="description" rows="6" required
              class="w-full rounded-lg border-gray-300 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
            @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Image -->
          <div>
            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Gambar Utama</label>
            <input type="file" name="image" id="image" accept="image/*" required
              class="w-full @error('image') border-red-500 @enderror">
            <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG, atau GIF. Maksimal 2MB.</p>
            @error('image')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Gallery Images -->
          <div>
            <label for="gallery" class="block text-sm font-medium text-gray-700 mb-2">Galeri Foto</label>
            <input type="file" name="gallery[]" id="gallery" accept="image/*" multiple
              class="w-full @error('gallery') border-red-500 @enderror">
            <p class="mt-1 text-sm text-gray-500">Pilih beberapa foto untuk galeri. Format: JPG, PNG, atau GIF. Maksimal 2MB per foto.</p>
            @error('gallery')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Submit Button -->
          <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
              Simpan Destinasi
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection