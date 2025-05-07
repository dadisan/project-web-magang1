<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
  public function run()
  {
    $categories = [
      [
        'name' => 'Wisata Sejarah & Budaya',
        'description' => 'Tempat-tempat bersejarah dan budaya di Kota Semarang',
        'slug' => 'sejarah-budaya',
        'icon' => 'fas fa-landmark',
      ],
      [
        'name' => 'Wisata Alam',
        'description' => 'Destinasi wisata alam di Kota Semarang',
        'slug' => 'wisata-alam',
        'icon' => 'fas fa-mountain',
      ],
      [
        'name' => 'Wisata Religi',
        'description' => 'Tempat-tempat ibadah dan wisata religi di Kota Semarang',
        'slug' => 'wisata-religi',
        'icon' => 'fas fa-pray',
      ],
      [
        'name' => 'Wisata Kuliner',
        'description' => 'Tempat-tempat kuliner khas Kota Semarang',
        'slug' => 'wisata-kuliner',
        'icon' => 'fas fa-utensils',
      ],
      [
        'name' => 'Wisata Keluarga',
        'description' => 'Destinasi wisata yang cocok untuk keluarga di Kota Semarang',
        'slug' => 'wisata-keluarga',
        'icon' => 'fas fa-users',
      ],
    ];

    foreach ($categories as $category) {
      Category::create($category);
    }
  }
}
