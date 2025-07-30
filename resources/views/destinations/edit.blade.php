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
            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
            <input type="text" name="address" id="address" value="{{ old('address', $destination->address) }}" required
              class="w-full rounded-lg border-gray-300 @error('address') border-red-500 @enderror">
            @error('address')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Coordinates -->
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label for="latitude" class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
              <input type="number" step="any" name="latitude" id="latitude" value="{{ old('latitude', $destination->latitude) }}"
                class="w-full rounded-lg border-gray-300 @error('latitude') border-red-500 @enderror"
                placeholder="Contoh: -6.966667">
              @error('latitude')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
            <div>
              <label for="longitude" class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
              <input type="number" step="any" name="longitude" id="longitude" value="{{ old('longitude', $destination->longitude) }}"
                class="w-full rounded-lg border-gray-300 @error('longitude') border-red-500 @enderror"
                placeholder="Contoh: 110.416664">
              @error('longitude')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
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

          <!-- YouTube Video URL -->
          <div>
            <label for="youtube_url" class="block text-sm font-medium text-gray-700 mb-2">YouTube Video URL</label>
            <input type="url" name="youtube_url" id="youtube_url" value="{{ old('youtube_url', $destination->youtube_url) }}"
              class="w-full rounded-lg border-gray-300 @error('youtube_url') border-red-500 @enderror"
              placeholder="https://youtu.be/xxxx atau https://www.youtube.com/watch?v=xxxx">
            <p class="mt-1 text-sm text-gray-500">Opsional. Masukkan link video YouTube destinasi ini.</p>
            @error('youtube_url')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Featured Image -->
          <div>
            <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">Gambar Utama <span class="text-red-500">*</span></label>
            <input type="file" name="featured_image" id="featured_image" accept="image/*" required
              class="w-full @error('featured_image') border-red-500 @enderror">
            <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG. Maksimal 5MB.</p>
            @error('featured_image')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
            @if($destination->image_url)
            <div class="mt-2">
              <p class="text-sm text-gray-600 mb-2">Gambar Utama Saat Ini:</p>
              <img src="{{ $destination->image_url }}" alt="Current featured image" class="w-32 h-32 object-cover rounded-lg">
            </div>
            @endif
          </div>

          <!-- Gallery Images -->
          <div>
            <label for="gallery_images" class="block text-sm font-medium text-gray-700 mb-2">Galeri Foto</label>
            <input type="file" name="gallery_images[]" id="gallery_images" accept="image/*" multiple
              class="w-full @error('gallery_images') border-red-500 @enderror"
              onchange="previewGalleryImages(this)">
            <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG. Maksimal 5MB per gambar. Pilih beberapa gambar sekaligus.</p>
            @error('gallery_images')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror

            <!-- Preview Container -->
            <div id="galleryPreview" class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 justify-items-center">
              <!-- Existing Images -->
              @php $featuredPath = $destination->featured_image; @endphp
              @if($destination->gallery_images)
              @foreach($destination->gallery_images as $index => $image)
              @if($image !== $featuredPath)
              <div class="relative group">
                <img src="{{ asset('storage/' . ltrim($image, '/')) }}" alt="Gallery image {{ $index + 1 }}"
                  class="w-full max-w-xs h-32 object-contain rounded-lg bg-gray-100">
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-opacity duration-300 rounded-lg"></div>
                <button type="button"
                  data-index="{{ $index }}"
                  class="remove-image-btn absolute top-2 right-2 bg-red-500 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
                <input type="hidden" name="existing_gallery_images[]" value="{{ $image }}">
              </div>
              @endif
              @endforeach
              @endif
            </div>
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

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const addressInput = document.getElementById('address');
    const latitudeInput = document.getElementById('latitude');
    const longitudeInput = document.getElementById('longitude');
    let timeoutId;

    // Function to get coordinates from address
    async function getCoordinates(address) {
      try {
        const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}, Indonesia`);
        const data = await response.json();

        if (data && data.length > 0) {
          latitudeInput.value = data[0].lat;
          longitudeInput.value = data[0].lon;
        }
      } catch (error) {
        console.error('Error getting coordinates:', error);
      }
    }

    // Add event listener to address input
    addressInput.addEventListener('input', function() {
      // Clear previous timeout
      clearTimeout(timeoutId);

      // Set new timeout to avoid too many API calls
      timeoutId = setTimeout(() => {
        if (addressInput.value) {
          getCoordinates(addressInput.value);
        }
      }, 1000); // Wait 1 second after user stops typing
    });
  });

  // Preview gallery images before upload
  function previewGalleryImages(input) {
    const preview = document.getElementById('galleryPreview');
    const existingImages = document.querySelectorAll('[name="existing_gallery_images[]"]');

    // Keep existing images
    const existingImagesHTML = Array.from(existingImages).map(input => {
      const img = input.previousElementSibling.previousElementSibling;
      return img.parentElement.outerHTML;
    }).join('');

    // Clear preview except existing images
    preview.innerHTML = existingImagesHTML;

    if (input.files) {
      Array.from(input.files).forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function(e) {
          const div = document.createElement('div');
          div.className = 'relative group';
          div.innerHTML = `
            <img src="${e.target.result}" alt="Preview ${index + 1}" 
              class="w-full h-32 object-cover rounded-lg">
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-opacity duration-300 rounded-lg"></div>
            <button type="button" onclick="this.parentElement.remove()" 
              class="absolute top-2 right-2 bg-red-500 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          `;
          preview.appendChild(div);
        }
        reader.readAsDataURL(file);
      });
    }
  }

  // Remove existing image
  function removeExistingImage(index) {
    const inputs = document.querySelectorAll('[name="existing_gallery_images[]"]');
    if (inputs[index]) {
      inputs[index].parentElement.remove();
    }
  }

  // Update event listener for remove image buttons
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.remove-image-btn').forEach(button => {
      button.addEventListener('click', function() {
        const index = this.dataset.index;
        removeExistingImage(index);
      });
    });
  });
</script>
@endpush