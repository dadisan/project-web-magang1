@extends('layouts.app')

@section('title', 'Categories - Wisata Kota Semarang')

@section('content')
<div class="bg-white">
  <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
    <div class="text-center">
      <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl sm:tracking-tight lg:text-6xl">
        Explore by Category
      </h1>
      <p class="mt-5 max-w-xl mx-auto text-xl text-gray-500">
        Find the perfect destination based on your interests
      </p>
    </div>

    <div class="mt-12 grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
      @forelse($categories as $category)
      <a href="{{ route('categories.show', $category) }}" class="group block p-6 bg-white rounded-lg border border-gray-200 hover:shadow-lg transition-shadow duration-200">
        <div class="flex items-center space-x-4">
          <div class="flex-shrink-0">
            <div class="w-12 h-12 rounded-lg bg-blue-50 flex items-center justify-center group-hover:bg-blue-100 transition-colors duration-200">
              <i class="{{ $category->icon }} text-2xl text-blue-600"></i>
            </div>
          </div>
          <div class="flex-1 min-w-0">
            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-200">
              {{ $category->name }}
            </h3>
            <p class="mt-1 text-sm text-gray-500 line-clamp-2">
              {{ $category->description }}
            </p>
            <p class="mt-2 text-sm font-medium text-blue-600">
              {{ $category->destinations->count() }} destinations
            </p>
          </div>
          <div class="flex-shrink-0">
            <i class="fas fa-chevron-right text-gray-400 group-hover:text-blue-600 transition-colors duration-200"></i>
          </div>
        </div>
      </a>
      @empty
      <div class="col-span-3 text-center py-12">
        <h3 class="text-lg font-medium text-gray-900">No categories found</h3>
        <p class="mt-2 text-sm text-gray-500">Categories will be added soon.</p>
      </div>
      @endforelse
    </div>
  </div>
</div>
@endsection