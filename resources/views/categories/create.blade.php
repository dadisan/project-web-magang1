@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Tambah Kategori Baru</h1>
        <a href="{{ route('categories.index') }}" class="text-gray-600 hover:text-gray-900">
          Kembali ke Daftar Kategori
        </a>
      </div>

      <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div class="space-y-6">
          <!-- Name -->
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
              class="w-full rounded-lg border-gray-300 @error('name') border-red-500 @enderror">
            @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Description -->
          <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea name="description" id="description" rows="4" required
              class="w-full rounded-lg border-gray-300 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
            @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Submit Button -->
          <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
              Simpan Kategori
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection