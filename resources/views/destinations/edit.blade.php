@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Edit Destinasi</h1>
        <a href="{{ route('destinations.show', $destination) }}" class="text-gray-600 hover:text-gray-900">
          Kembali ke Detail Destinasi
        </a>
      </div>

      <form action="{{ route('destinations.update', $destination) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-6">
          <!-- Name -->
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Destinasi</label>
            <input type="text" name="name" id="name" value="{{ old('name', $destination->name) }}" required
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
              <option value="{{ $category->id }}"
                {{ old('category_id', $destination->category_id) == $category->id ? 'selected' : '' }}>
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
            <input type="text" name="location" id="location" value="{{ old('location', $destination->location) }}" required
              class="w-full rounded-lg border-gray-300 @error('location') border-red-500 @enderror">
            @error('location')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Description -->
          <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea name="description" id="description" rows="6" required
              class="w-full rounded-lg border-gray-300 @error('description') border-red-500 @enderror">{{ old('description', $destination->description) }}</textarea>
            @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Current Image -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Utama Saat Ini</label>
            <div class="relative w-48 h-48">
              <img src="{{ $destination->image_url }}" alt="{{ $destination->name }}"
                class="w-full h-full object-cover rounded-lg">
            </div>
          </div>

          <!-- New Image -->
          <div>
            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Ganti Gambar Utama</label>
            <input type="file" name="image" id="image" accept="image/*"
              class="w-full @error('image') border-red-500 @enderror">
            <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG, atau GIF. Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah gambar.</p>
            @error('image')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Current Gallery -->
          @if($destination->galleries->count() > 0)
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Galeri Foto Saat Ini</label>
            <div class="grid grid-cols-4 gap-4">
              @foreach($destination->galleries as $gallery)
              <div class="relative group">
                <img src="{{ Storage::url($gallery->image_path) }}" alt="{{ $gallery->caption }}"
                  class="w-full h-24 object-cover rounded-lg">
                <form action="{{ route('destinations.galleries.destroy', [$destination, $gallery]) }}"
                  method="POST" class="absolute top-2 right-2">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="bg-red-600 text-white p-1 rounded-full hover:bg-red-700"
                    onclick="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </button>
                </form>
              </div>
              @endforeach
            </div>
          </div>
          @endif

          <!-- New Gallery Images -->
          <div>
            <label for="gallery" class="block text-sm font-medium text-gray-700 mb-2">Tambah Foto ke Galeri</label>
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
              Simpan Perubahan
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection