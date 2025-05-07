<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;
use App\Models\Category;
use Illuminate\Support\Str;

class DestinationSeeder extends Seeder
{
  public function run()
  {
    $sejarah = Category::where('slug', 'sejarah-budaya')->first();
    $alam = Category::where('slug', 'wisata-alam')->first();
    $religi = Category::where('slug', 'wisata-religi')->first();
    $kuliner = Category::where('slug', 'wisata-kuliner')->first();
    $keluarga = Category::where('slug', 'wisata-keluarga')->first();

    $destinations = [
      [
        'name' => 'Lawang Sewu',
        'description' => 'Lawang Sewu adalah gedung bersejarah milik PT Kereta Api Indonesia (Persero) yang awalnya digunakan sebagai Kantor Pusat perusahaan kereta api swasta Nederlandsch-Indische Spoorweg Maatschappij (NISM). Gedung ini terletak di Jalan Pemuda, Semarang Tengah. Lawang Sewu dibangun secara bertahap mulai tahun 1904 dan selesai pada tahun 1907. Bangunan ini merupakan salah satu landmark Kota Semarang yang terkenal dengan arsitektur kolonial yang megah.',
        'address' => 'Jl. Pemuda, Sekayu, Kec. Semarang Tengah, Kota Semarang',
        'opening_hours' => '08:00 - 17:00 WIB',
        'entrance_fee' => 20000,
        'featured_image' => 'destinations/lawang-sewu.jpg',
        'categories' => [$sejarah],
      ],
      [
        'name' => 'Sam Poo Kong',
        'description' => 'Kelenteng Sam Poo Kong merupakan bekas tempat persinggahan dan pendaratan pertama seorang Laksamana Tiongkok beragama Islam yang bernama Zheng He/Cheng Ho. Kelenteng ini memiliki nilai sejarah dan budaya yang tinggi, menggambarkan akulturasi budaya Tionghoa, Islam, dan Jawa.',
        'address' => 'Jl. Simongan No.129, Bongsari, Kec. Semarang Barat, Kota Semarang',
        'opening_hours' => '07:00 - 21:00 WIB',
        'entrance_fee' => 30000,
        'featured_image' => 'destinations/sam-poo-kong.jpg',
        'categories' => [$sejarah, $religi],
      ],
      [
        'name' => 'Kota Lama',
        'description' => 'Kota Lama Semarang adalah suatu kawasan di Semarang yang menjadi pusat perdagangan pada abad 19-20. Pada masa itu, kawasan ini merupakan pusat kota yang memperlihatkan kekayaan bangunan-bangunan dengan arsitektur Eropa. Kawasan ini juga dikenal dengan sebutan Outstadt atau Little Netherlands.',
        'address' => 'Jl. Letjen Suprapto, Tanjung Mas, Kec. Semarang Utara, Kota Semarang',
        'opening_hours' => '24 jam',
        'entrance_fee' => 0,
        'featured_image' => 'destinations/kota-lama.jpg',
        'categories' => [$sejarah],
      ],
      [
        'name' => 'Pagoda Avalokitesvara',
        'description' => 'Pagoda Avalokitesvara adalah sebuah vihara Buddha yang terletak di kawasan Bukit Simongan. Pagoda ini memiliki arsitektur yang indah dengan pemandangan kota Semarang yang menakjubkan dari atasnya.',
        'address' => 'Jl. Simongan Raya, Bongsari, Kec. Semarang Barat, Kota Semarang',
        'opening_hours' => '08:00 - 20:00 WIB',
        'entrance_fee' => 10000,
        'featured_image' => 'destinations/pagoda-avalokitesvara.jpg',
        'categories' => [$religi],
      ],
      [
        'name' => 'Masjid Agung Jawa Tengah',
        'description' => 'Masjid Agung Jawa Tengah adalah masjid termegah di Jawa Tengah. Arsitekturnya memadukan unsur Jawa, Timur Tengah dan Yunani. Masjid ini dilengkapi dengan payung raksasa yang bisa membuka dan menutup seperti yang ada di Masjid Nabawi.',
        'address' => 'Jl. Gajah Raya, Sambirejo, Kec. Gayamsari, Kota Semarang',
        'opening_hours' => '04:00 - 22:00 WIB',
        'entrance_fee' => 0,
        'featured_image' => 'destinations/masjid-agung-jawa-tengah.jpg',
        'categories' => [$religi],
      ],
      [
        'name' => 'Goa Kreo',
        'description' => 'Goa Kreo adalah sebuah goa kecil yang terletak di bukit dengan ketinggian ± 80 meter di atas permukaan laut. Dalam bahasa Jawa kuno, "kreo" berasal dari kata "mankreo" yang berarti peliharalah atau jagalah. Di sekitar goa ini terdapat waduk Jatibarang yang menambah keindahan tempat wisata ini.',
        'address' => 'Kandri, Kec. Gunungpati, Kota Semarang',
        'opening_hours' => '08:00 - 17:00 WIB',
        'entrance_fee' => 15000,
        'featured_image' => 'destinations/goa-kreo.jpg',
        'categories' => [$alam],
      ],
      [
        'name' => 'Dusun Semilir',
        'description' => 'Dusun Semilir adalah destinasi wisata modern dengan konsep eco park yang menawarkan berbagai spot foto instagramable. Tempat ini memadukan unsur alam dan arsitektur modern yang menarik.',
        'address' => 'Jl. Soekarno-Hatta No.49, Ngemple, Bawen, Kabupaten Semarang',
        'opening_hours' => '08:00 - 21:00 WIB',
        'entrance_fee' => 35000,
        'featured_image' => 'destinations/dusun-semilir.jpg',
        'categories' => [$keluarga],
      ],
      [
        'name' => 'Kampung Pelangi',
        'description' => 'Kampung Pelangi adalah sebuah perkampungan yang dicat dengan berbagai warna cerah membentuk pola pelangi. Dulunya adalah permukiman kumuh yang kini menjadi destinasi wisata yang menarik dan instagramable.',
        'address' => 'Jl. DR. Sutomo No.89, Randusari, Kec. Semarang Sel., Kota Semarang',
        'opening_hours' => '24 jam',
        'entrance_fee' => 0,
        'featured_image' => 'destinations/kampung-pelangi.jpg',
        'categories' => [$keluarga],
      ],
      [
        'name' => 'Pantai Marina',
        'description' => 'Pantai Marina adalah salah satu pantai di Semarang yang telah dikembangkan menjadi kawasan wisata terpadu. Selain pantai, pengunjung bisa menikmati berbagai fasilitas seperti playground, area kuliner, dan spot memancing.',
        'address' => 'Tawangsari, Kec. Semarang Barat, Kota Semarang',
        'opening_hours' => '07:00 - 18:00 WIB',
        'entrance_fee' => 10000,
        'featured_image' => 'destinations/pantai-marina.jpg',
        'categories' => [$alam, $keluarga],
      ],
      [
        'name' => 'Pasar Semawis',
        'description' => 'Pasar Semawis adalah pasar malam yang terletak di kawasan Pecinan Semarang. Tempat ini menawarkan berbagai kuliner khas Semarang dan suasana yang kental dengan budaya Tionghoa.',
        'address' => 'Jl. Gang Warung, Kranggan, Kec. Semarang Tengah, Kota Semarang',
        'opening_hours' => '17:00 - 22:00 WIB (Jumat-Minggu)',
        'entrance_fee' => 0,
        'featured_image' => 'destinations/pasar-semawis.jpg',
        'categories' => [$kuliner],
      ],
      [
        'name' => 'Brown Canyon',
        'description' => 'Brown Canyon adalah bekas lokasi penambangan yang kini menjadi destinasi wisata yang menarik. Tebing-tebing berwarna kecokelatan membentuk pemandangan yang mirip dengan Grand Canyon di Amerika.',
        'address' => 'Rowosari, Kec. Tembalang, Kota Semarang',
        'opening_hours' => '07:00 - 17:00 WIB',
        'entrance_fee' => 10000,
        'featured_image' => 'destinations/brown-canyon.jpg',
        'categories' => [$alam],
      ],
      [
        'name' => 'Saloka Theme Park',
        'description' => 'Saloka Theme Park adalah taman hiburan keluarga terbesar di Jawa Tengah. Taman ini menawarkan berbagai wahana permainan modern dan tradisional yang cocok untuk segala usia.',
        'address' => 'Jl. Fatmawati No.154, Gumuksari, Lopait, Kec. Tuntang, Kabupaten Semarang',
        'opening_hours' => '09:00 - 17:00 WIB',
        'entrance_fee' => 150000,
        'featured_image' => 'destinations/saloka-theme-park.jpg',
        'categories' => [$keluarga],
      ],
      [
        'name' => 'Puri Maerokoco',
        'description' => 'Puri Maerokoco atau Taman Mini Jawa Tengah adalah tempat wisata yang menampilkan miniatur rumah adat dari 35 kabupaten/kota di Jawa Tengah. Pengunjung bisa belajar tentang kebudayaan Jawa Tengah di sini.',
        'address' => 'Jl. Anjasmoro Raya, Tawangsari, Kec. Semarang Barat, Kota Semarang',
        'opening_hours' => '08:00 - 16:00 WIB',
        'entrance_fee' => 15000,
        'featured_image' => 'destinations/puri-maerokoco.jpg',
        'categories' => [$sejarah, $keluarga],
      ],
      [
        'name' => 'Kampoeng Semarang',
        'description' => 'Kampoeng Semarang adalah destinasi wisata yang menggabungkan konsep kuliner, edukasi, dan hiburan. Tempat ini menawarkan berbagai kuliner khas Semarang dan aktivitas edukatif tentang sejarah dan budaya Semarang.',
        'address' => 'Jl. Raya Kaligawe KM. 1, Kaligawe, Kec. Gayamsari, Kota Semarang',
        'opening_hours' => '10:00 - 21:00 WIB',
        'entrance_fee' => 25000,
        'featured_image' => 'destinations/kampoeng-semarang.jpg',
        'categories' => [$kuliner, $keluarga],
      ],
      [
        'name' => 'Simpang Lima',
        'description' => 'Simpang Lima adalah alun-alun utama Kota Semarang yang menjadi pusat aktivitas masyarakat. Area ini dikelilingi pusat perbelanjaan dan kuliner, serta sering menjadi tempat berbagai acara dan festival.',
        'address' => 'Simpang Lima, Pleburan, Kec. Semarang Selatan, Kota Semarang',
        'opening_hours' => '24 jam',
        'entrance_fee' => 0,
        'featured_image' => 'destinations/simpang-lima.jpg',
        'categories' => [$kuliner, $keluarga],
      ],
    ];

    foreach ($destinations as $destination) {
      $categories = $destination['categories'];
      unset($destination['categories']);

      $destination['slug'] = Str::slug($destination['name']);
      $destination['is_active'] = true;

      $dest = Destination::create($destination);
      $dest->categories()->attach($categories);
    }
  }
}
