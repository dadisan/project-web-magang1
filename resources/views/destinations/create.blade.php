@extends('layouts.app')

@section('content')
<!-- Tambahkan Leaflet CSS dan JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<!-- Input Mask -->
<script src="https://unpkg.com/imask"></script>

<div class="container mx-auto px-4 py-8">
  <div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Tambah Destinasi Baru</h1>
        <a href="{{ route('destinations.index') }}" class="text-gray-600 hover:text-gray-900">
          Kembali ke Daftar Destinasi
        </a>
      </div>

      <form action="{{ route('destinations.store') }}" method="POST" enctype="multipart/form-data"
        x-data="{
          showCategoryModal: false,
          selectedCategories: [],
          isSubmitting: false,
          validateBasicForm() {
            if (!this.$refs.name.value || !this.$refs.description.value || !this.$refs.address.value || this.selectedCategories.length === 0) {
              alert('Mohon lengkapi data wajib: Nama, Deskripsi, Alamat, dan Kategori');
              return false;
            }
            return true;
          }
        }"
        @submit.prevent="if (validateBasicForm()) { isSubmitting = true; $el.submit(); }">
        @csrf

        <!-- Loading Overlay -->
        <div x-show="isSubmitting"
          class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
          <div class="bg-white p-8 rounded-lg shadow-xl text-center">
            <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500 mx-auto mb-4"></div>
            <p class="text-gray-700">Sedang menyimpan destinasi...</p>
            <p class="text-sm text-gray-500 mt-2">Mohon tunggu sebentar</p>
          </div>
        </div>

        <div class="space-y-6">
          <!-- Name -->
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Destinasi <span class="text-red-500">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
              class="w-full rounded-lg border-gray-300 @error('name') border-red-500 @enderror"
              x-ref="name">
            @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Categories -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
            <div class="flex flex-wrap gap-2 mb-2">
              <template x-for="categoryId in selectedCategories" :key="categoryId">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                  <span x-text="document.querySelector(`[value='${categoryId}']`).dataset.name"></span>
                  <button type="button" @click="selectedCategories = selectedCategories.filter(id => id !== categoryId)" class="ml-2 inline-flex items-center p-0.5 rounded-full text-blue-400 hover:bg-blue-200 hover:text-blue-500">
                    <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                  </button>
                </span>
              </template>
            </div>
            <button type="button" @click="showCategoryModal = true"
              class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
              <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
              </svg>
              Pilih Kategori
            </button>
            @error('categories')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror

            <!-- Hidden inputs for categories -->
            <template x-for="categoryId in selectedCategories" :key="categoryId">
              <input type="hidden" name="categories[]" :value="categoryId">
            </template>
          </div>

          <!-- Category Modal -->
          <div x-show="showCategoryModal"
            class="fixed inset-0 z-10 overflow-y-auto"
            x-cloak
            style="display: none;">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
              <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="showCategoryModal = false"></div>

              <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                  <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                      <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                        Pilih Kategori
                      </h3>
                      <div class="grid grid-cols-2 gap-4">
                        @foreach($categories as $category)
                        <label class="inline-flex items-center">
                          <input type="checkbox"
                            value="{{ $category->id }}"
                            data-name="{{ $category->name }}"
                            x-model="selectedCategories"
                            class="form-checkbox h-5 w-5 text-blue-600">
                          <span class="ml-2">{{ $category->name }}</span>
                        </label>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                  <button type="button"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
                    @click="showCategoryModal = false">
                    Selesai
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Address -->
          <div>
            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Alamat <span class="text-red-500">*</span></label>
            <input type="text" name="address" id="address" value="{{ old('address') }}" required
              class="w-full rounded-lg border-gray-300 @error('address') border-red-500 @enderror"
              x-ref="address">
            @error('address')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Description -->
          <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi <span class="text-red-500">*</span></label>
            <textarea name="description" id="description" rows="6" required
              class="w-full rounded-lg border-gray-300 @error('description') border-red-500 @enderror"
              x-ref="description">{{ old('description') }}</textarea>
            @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- YouTube Video URL -->
          <div>
            <label for="youtube_url" class="block text-sm font-medium text-gray-700 mb-2">YouTube Video URL</label>
            <input type="url" name="youtube_url" id="youtube_url" value="{{ old('youtube_url') }}"
              class="w-full rounded-lg border-gray-300 @error('youtube_url') border-red-500 @enderror"
              placeholder="https://youtu.be/xxxx atau https://www.youtube.com/watch?v=xxxx">
            <p class="mt-1 text-sm text-gray-500">Opsional. Masukkan link video YouTube destinasi ini.</p>
            @error('youtube_url')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Additional Info -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="opening_hours" class="block text-sm font-medium text-gray-700 mb-2">Jam Operasional</label>
              <div class="grid grid-cols-2 gap-4">
                <div>
                  <label class="text-sm text-gray-600">Jam Buka</label>
                  <input type="time" name="opening_time"
                    class="w-full rounded-lg border-gray-300">
                </div>
                <div>
                  <label class="text-sm text-gray-600">Jam Tutup</label>
                  <input type="time" name="closing_time"
                    class="w-full rounded-lg border-gray-300">
                </div>
              </div>
            </div>

            <div>
              <label for="entrance_fee" class="block text-sm font-medium text-gray-700 mb-2">Harga Tiket</label>
              <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                  Rp
                </span>
                <input type="text" name="entrance_fee"
                  class="w-full rounded-lg border-gray-300 pl-10"
                  placeholder="0"
                  x-init="IMask($el, {
                    mask: Number,
                    scale: 0,
                    thousandsSeparator: '.',
                    padFractionalZeros: false,
                    normalizeZeros: true,
                    radix: ',',
                    mapToRadix: ['.']
                  })">
              </div>
            </div>

            <div>
              <label for="contact_number" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
              <input type="tel" name="contact_number"
                class="w-full rounded-lg border-gray-300"
                x-init="IMask($el, {
                  mask: '+{62}000-0000-0000'
                })">
            </div>

            <div>
              <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
              <input type="email" name="email" id="email" value="{{ old('email') }}"
                class="w-full rounded-lg border-gray-300 @error('email') border-red-500 @enderror"
                placeholder="contoh@email.com">
              @error('email')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="website" class="block text-sm font-medium text-gray-700 mb-2">Website</label>
              <input type="url" name="website" id="website" value="{{ old('website') }}"
                class="w-full rounded-lg border-gray-300 @error('website') border-red-500 @enderror"
                placeholder="https://www.example.com">
              @error('website')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <!-- Map for Location Selection -->
            <div class="col-span-2">
              <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Lokasi di Peta</label>
              <div id="map" class="w-full h-96 rounded-lg border border-gray-300"></div>
              <input type="hidden" name="latitude" id="latitude">
              <input type="hidden" name="longitude" id="longitude">
            </div>
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
          </div>

          <!-- Submit Button -->
          <div class="flex justify-end">
            <button type="submit"
              class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50"
              x-bind:disabled="isSubmitting">
              <span x-show="!isSubmitting">Simpan Destinasi</span>
              <span x-show="isSubmitting" class="inline-flex items-center">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Menyimpan...
              </span>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Initialize map centered on Semarang
    var map = L.map('map').setView([-7.0051453, 110.4381254], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var marker;

    // Handle map click
    map.on('click', function(e) {
      var lat = e.latlng.lat;
      var lng = e.latlng.lng;

      // Update form inputs
      document.getElementById('latitude').value = lat.toFixed(6);
      document.getElementById('longitude').value = lng.toFixed(6);

      // Update or add marker
      if (marker) {
        marker.setLatLng(e.latlng);
      } else {
        marker = L.marker(e.latlng).addTo(map);
      }
    });
  });
</script>
@endsection