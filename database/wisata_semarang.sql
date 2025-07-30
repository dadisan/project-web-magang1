-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jun 2025 pada 16.42
-- Versi server: 10.11.2-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wisata_semarang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('wisataku_cache_admin@example.como|127.0.0.1', 'i:1;', 1748712045),
('wisataku_cache_admin@example.como|127.0.0.1:timer', 'i:1748712045;', 1748712045),
('wisataku_cache_d@gmail.com|127.0.0.1', 'i:1;', 1748318508),
('wisataku_cache_d@gmail.com|127.0.0.1:timer', 'i:1748318508;', 1748318508);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `icon`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Wisata Sejarah & Budaya', 'sejarah-budaya', 'Tempat-tempat bersejarah dan budaya di Kota Semarang', 'fas fa-landmark', 1, '2025-05-07 07:09:32', '2025-05-07 07:09:32'),
(2, 'Wisata Alam', 'wisata-alam', 'Destinasi wisata alam di Kota Semarang', 'fas fa-mountain', 1, '2025-05-07 07:09:32', '2025-05-07 07:09:32'),
(3, 'Wisata Religi', 'wisata-religi', 'Tempat-tempat ibadah dan wisata religi di Kota Semarang', 'fas fa-pray', 1, '2025-05-07 07:09:32', '2025-05-07 07:09:32'),
(4, 'Wisata Kuliner', 'wisata-kuliner', 'Tempat-tempat kuliner khas Kota Semarang', 'fas fa-utensils', 1, '2025-05-07 07:09:32', '2025-05-07 07:09:32'),
(5, 'Wisata Keluarga', 'wisata-keluarga', 'Destinasi wisata yang cocok untuk keluarga di Kota Semarang', 'fas fa-users', 1, '2025-05-07 07:09:32', '2025-05-07 07:09:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `category_destination`
--

CREATE TABLE `category_destination` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `destination_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `category_destination`
--

INSERT INTO `category_destination` (`id`, `category_id`, `destination_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 3, 2, NULL, NULL),
(4, 1, 3, NULL, NULL),
(5, 3, 4, NULL, NULL),
(6, 3, 5, NULL, NULL),
(7, 2, 6, NULL, NULL),
(8, 5, 7, NULL, NULL),
(9, 5, 8, NULL, NULL),
(10, 2, 9, NULL, NULL),
(11, 5, 9, NULL, NULL),
(12, 4, 10, NULL, NULL),
(13, 2, 11, NULL, NULL),
(14, 5, 12, NULL, NULL),
(15, 1, 13, NULL, NULL),
(16, 5, 13, NULL, NULL),
(17, 4, 14, NULL, NULL),
(18, 5, 14, NULL, NULL),
(19, 4, 15, NULL, NULL),
(20, 5, 15, NULL, NULL),
(27, 5, 22, NULL, NULL),
(28, 5, 23, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `destinations`
--

CREATE TABLE `destinations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `opening_hours` varchar(255) DEFAULT NULL,
  `entrance_fee` decimal(10,2) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `featured_image` varchar(255) NOT NULL,
  `gallery_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery_images`)),
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `destinations`
--

INSERT INTO `destinations` (`id`, `name`, `slug`, `description`, `address`, `latitude`, `longitude`, `opening_hours`, `entrance_fee`, `contact_number`, `email`, `website`, `featured_image`, `gallery_images`, `is_featured`, `is_active`, `created_at`, `updated_at`, `youtube_url`) VALUES
(1, 'Lawang Sewu', 'lawang-sewu', 'Lawang Sewu adalah gedung bersejarah milik PT Kereta Api Indonesia (Persero) yang awalnya digunakan sebagai Kantor Pusat perusahaan kereta api swasta Nederlandsch-Indische Spoorweg Maatschappij (NISM). Gedung ini terletak di Jalan Pemuda, Semarang Tengah. Lawang Sewu dibangun secara bertahap mulai tahun 1904 dan selesai pada tahun 1907. Bangunan ini merupakan salah satu landmark Kota Semarang yang terkenal dengan arsitektur kolonial yang megah.', 'Lawang Sewu, Jalan Pemuda, Sekayu, Semarang', '-6.9839786', '110.4107909', '08:00 - 17:00 WIB', 20000.00, NULL, NULL, NULL, 'destinations/cca9245c-78f9-4810-b7b4-3771f5f7de34.jpg', '[\"destinations\\/gallery\\/8c31a279-6320-4415-bcef-9e9338212b68.jpg\",\"destinations\\/gallery\\/2d66971a-fea0-45aa-8edd-6da8df533825.jpg\"]', 0, 1, '2025-05-07 07:09:32', '2025-05-26 20:47:21', 'https://youtu.be/VooQMpJ4GKQ?si=dtNS5NgcmKTFmnLj'),
(2, 'Sam Poo Kong', 'sam-poo-kong', 'Kelenteng Sam Poo Kong merupakan bekas tempat persinggahan dan pendaratan pertama seorang Laksamana Tiongkok beragama Islam yang bernama Zheng He/Cheng Ho. Kelenteng ini memiliki nilai sejarah dan budaya yang tinggi, menggambarkan akulturasi budaya Tionghoa, Islam, dan Jawa.', 'Sam Poo Kong, Jalan Simongan, Bongsari, Semarang', '-6.9958722', '110.3983842', '07:00 - 21:00 WIB', 30000.00, NULL, NULL, NULL, 'destinations/d96d486c-5cb0-4dba-a80f-73044b3a2bdc.png', '[\"destinations\\/gallery\\/25972648-a534-43ed-b742-d6dfccfd8062.png\",\"destinations\\/gallery\\/9d427f66-4bc6-4300-82e4-89c37b54e048.jpg\"]', 0, 1, '2025-05-07 07:09:32', '2025-05-26 20:52:25', 'https://youtu.be/uvGEnIZVNrM?si=yf_MfNAEjPe-XDAN'),
(3, 'Kota Lama', 'kota-lama', 'Kota Lama Semarang adalah suatu kawasan di Semarang yang menjadi pusat perdagangan pada abad 19-20. Pada masa itu, kawasan ini merupakan pusat kota yang memperlihatkan kekayaan bangunan-bangunan dengan arsitektur Eropa. Kawasan ini juga dikenal dengan sebutan Outstadt atau Little Netherlands.', 'Kota Lama, Jalan Letjen Suprapto, Tanjung Mas, Semarang', '-6.96827', '110.42843', '24 jam', 0.00, NULL, NULL, NULL, 'destinations/e7ef7c75-b754-45ee-806b-527181b5ac7a.jpg', '[\"destinations\\/gallery\\/fe800319-e4f5-48c1-bec2-ccde952586cd.jpg\",\"destinations\\/gallery\\/9ea50418-21dc-4026-9ba5-fd807d196d34.jpg\"]', 0, 1, '2025-05-07 07:09:32', '2025-05-26 20:39:04', NULL),
(4, 'Pagoda Avalokitesvara', 'pagoda-avalokitesvara', 'Pagoda Avalokitesvara adalah sebuah vihara Buddha yang terletak di kawasan Bukit Simongan. Pagoda ini memiliki arsitektur yang indah dengan pemandangan kota Semarang yang menakjubkan dari atasnya.', 'Jl. Simongan Raya, Bongsari, Kec. Semarang Barat, Kota Semarang', '-7.08655', '110.40912', '08:00 - 20:00 WIB', 10000.00, NULL, NULL, NULL, 'destinations/20186916-e1f7-4bab-b5b7-a15d5ae083b8.jpg', '[\"destinations\\/gallery\\/b263ad8d-d2ac-457f-a851-e7b3ed990117.jpg\",\"destinations\\/gallery\\/df89b303-0905-48d8-ac2c-8aa805507998.png\"]', 0, 1, '2025-05-07 07:09:32', '2025-05-31 10:28:11', 'https://youtu.be/3HeKIsBg7cI?si=3OSKohACLLz-Mnf8'),
(5, 'Masjid Agung Jawa Tengah', 'masjid-agung-jawa-tengah', 'Masjid Agung Jawa Tengah adalah masjid termegah di Jawa Tengah. Arsitekturnya memadukan unsur Jawa, Timur Tengah dan Yunani. Masjid ini dilengkapi dengan payung raksasa yang bisa membuka dan menutup seperti yang ada di Masjid Nabawi.', 'Jl. Gajah Raya, Sambirejo, Kec. Gayamsari, Kota Semarang', '-6.988338', '110.44514', '04:00 - 22:00 WIB', 0.00, NULL, NULL, NULL, 'destinations/66ff2a20-e25d-47e6-aa6d-ecdeb36cb278.jpg', '[\"destinations\\/gallery\\/2a3a0702-7212-4366-83d2-2d415dc957e7.jpg\",\"destinations\\/gallery\\/1c305492-e5a7-4229-96d9-905561c4ae46.jpg\"]', 0, 1, '2025-05-07 07:09:32', '2025-05-31 10:33:20', 'https://youtu.be/yyr4_8Aad_w?si=fhQtfBq6Flkw8wO3'),
(6, 'Goa Kreo', 'goa-kreo', 'Goa Kreo adalah sebuah goa kecil yang terletak di bukit dengan ketinggian ± 80 meter di atas permukaan laut. Dalam bahasa Jawa kuno, \"kreo\" berasal dari kata \"mankreo\" yang berarti peliharalah atau jagalah. Di sekitar goa ini terdapat waduk Jatibarang yang menambah keindahan tempat wisata ini.', 'Kandri, Kec. Gunungpati, Kota Semarang', '-7.03856', '110.35108', '08:00 - 17:00 WIB', 15000.00, NULL, NULL, NULL, 'destinations/ab476187-089a-46ad-9751-adb756c1faed.JPG', '[\"destinations\\/gallery\\/9aa6b1fb-2b4c-424f-aa15-f8b5f5a5a0d3.jpg\",\"destinations\\/gallery\\/45141de2-ed53-4aa6-a896-1401c1f41cc6.jpg\"]', 0, 1, '2025-05-07 07:09:32', '2025-05-31 10:38:59', 'https://youtu.be/Y0OR0hMNq_s?si=5p9ZTLtTSiywdwIk'),
(7, 'Dusun Semilir', 'dusun-semilir', 'Dusun Semilir adalah destinasi wisata modern dengan konsep eco park yang menawarkan berbagai spot foto instagramable. Tempat ini memadukan unsur alam dan arsitektur modern yang menarik.', 'Jl. Soekarno-Hatta No.49, Ngemple, Bawen, Kabupaten Semarang', '-7.23814', '109.43328', '08:00 - 21:00 WIB', 35000.00, NULL, NULL, NULL, 'destinations/3f5c8716-0de2-49a1-bae6-87850b17dd97.jpg', '[\"destinations\\/gallery\\/36cd061b-36a2-48a0-bb8f-ff02743e8dae.jpg\",\"destinations\\/gallery\\/602bfaf6-1b90-4a0e-8916-6cfc282c2028.jpg\"]', 0, 1, '2025-05-07 07:09:32', '2025-05-31 10:41:58', 'https://youtu.be/4k8iIqC_M5g?si=esDO5eSyk9-V94cY'),
(8, 'Kampung Pelangi', 'kampung-pelangi', 'Kampung Pelangi adalah sebuah perkampungan yang dicat dengan berbagai warna cerah membentuk pola pelangi. Dulunya adalah permukiman kumuh yang kini menjadi destinasi wisata yang menarik dan instagramable.', 'Jl. DR. Sutomo No.89, Randusari, Kec. Semarang Sel., Kota Semarang', '-6.988860', '110.40841', '24 jam', 0.00, NULL, NULL, NULL, 'destinations/83e2d5c8-f095-4172-a8bc-86208fae51bb.jpg', '[\"destinations\\/gallery\\/9e29b09b-701d-4c77-8cdf-18af6c5978db.jpeg\"]', 0, 1, '2025-05-07 07:09:32', '2025-05-31 10:49:55', 'https://youtu.be/mELnVv-uZTs?si=7UvGaBMXTZw8IRTP'),
(9, 'Pantai Marina', 'pantai-marina', 'Pantai Marina adalah salah satu pantai di Semarang yang telah dikembangkan menjadi kawasan wisata terpadu. Selain pantai, pengunjung bisa menikmati berbagai fasilitas seperti playground, area kuliner, dan spot memancing.', 'Tawangsari, Kec. Semarang Barat, Kota Semarang', '-6.94871', '110.38931', '07:00 - 18:00 WIB', 10000.00, NULL, NULL, NULL, 'destinations/b74863c1-ae8c-4f1b-95e5-52b076b4759c.jpg', '[\"destinations\\/gallery\\/042c9e90-a433-47ce-af87-f8532b2366fe.jpg\",\"destinations\\/gallery\\/ec395f20-140c-4fc1-9ab8-4f4d07421925.jpg\"]', 0, 1, '2025-05-07 07:09:32', '2025-05-31 10:53:15', 'https://youtu.be/CX3JZ7LsA1s?si=0oWsVqDAx-njDpPj'),
(10, 'Pasar Semawis', 'pasar-semawis', 'Pasar Semawis adalah pasar malam yang terletak di kawasan Pecinan Semarang. Tempat ini menawarkan berbagai kuliner khas Semarang dan suasana yang kental dengan budaya Tionghoa.', 'Jl. Gang Warung, Kranggan, Kec. Semarang Tengah, Kota Semarang', '-6.97465', '110.42823', '17:00 - 22:00 WIB (Jumat-Minggu)', 0.00, NULL, NULL, NULL, 'destinations/f6c413c5-2a0d-4cf2-8a9b-5fa0c4f71ca2.jpeg', '[\"destinations\\/gallery\\/9db47388-f82f-4bac-b058-3b75c8d36cc8.jpg\"]', 0, 1, '2025-05-07 07:09:32', '2025-05-31 10:55:27', 'https://youtu.be/kuv8LWYJWLk?si=NDKhJxC2yzYFxJYw'),
(11, 'Brown Canyon', 'brown-canyon', 'Brown Canyon adalah bekas lokasi penambangan yang kini menjadi destinasi wisata yang menarik. Tebing-tebing berwarna kecokelatan membentuk pemandangan yang mirip dengan Grand Canyon di Amerika.', 'Rowosari, Kec. Tembalang, Kota Semarang', '-7.05611', '108.48628', '07:00 - 17:00 WIB', 10000.00, NULL, NULL, NULL, 'destinations/3647f2d5-f702-40db-890d-369b54993e9e.jpg', '[\"destinations\\/gallery\\/aa8e6bdf-19e3-4d66-aa64-b5bb95db72fd.jpg\"]', 0, 1, '2025-05-07 07:09:32', '2025-05-31 10:58:31', 'https://youtu.be/gLFdY7VgD2Y?si=uEglWHCfdboWKWZZ'),
(12, 'Saloka Theme Park', 'saloka-theme-park', 'Saloka Theme Park adalah taman hiburan keluarga terbesar di Jawa Tengah. Taman ini menawarkan berbagai wahana permainan modern dan tradisional yang cocok untuk segala usia.', 'Jl. Fatmawati No.154, Gumuksari, Lopait, Kec. Tuntang, Kabupaten Semarang', '-7.28062', '108.45902', '09:00 - 17:00 WIB', 150000.00, NULL, NULL, NULL, 'destinations/ed9d3027-587a-4d75-8abb-5df814478dcb.jpg', '[\"destinations\\/gallery\\/eb942d8c-abd6-4e32-b9ce-c3b0f5de4737.jpg\"]', 0, 1, '2025-05-07 07:09:32', '2025-05-31 11:00:03', 'https://youtu.be/ji-uripwKeA?si=eHXaV3nUvQOIdIVQ'),
(13, 'Puri Maerokoco', 'puri-maerokoco', 'Puri Maerokoco atau Taman Mini Jawa Tengah adalah tempat wisata yang menampilkan miniatur rumah adat dari 35 kabupaten/kota di Jawa Tengah. Pengunjung bisa belajar tentang kebudayaan Jawa Tengah di sini.', 'Jl. Anjasmoro Raya, Tawangsari, Kec. Semarang Barat, Kota Semarang', '-6.96097', '110.38927', '08:00 - 16:00 WIB', 15000.00, NULL, NULL, NULL, 'destinations/50a824ef-6333-422d-a113-a2634bcf7675.jpeg', '[\"destinations\\/gallery\\/077e5c51-4796-4436-a77d-e7b049b9ede9.jpg\"]', 0, 1, '2025-05-07 07:09:32', '2025-05-31 11:01:10', 'https://youtu.be/nfH4hgDMWUU?si=AM8HJJsJx2KPrbLA'),
(14, 'Kampoeng Semarang', 'kampoeng-semarang', 'Kampoeng Semarang adalah destinasi wisata yang menggabungkan konsep kuliner, edukasi, dan hiburan. Tempat ini menawarkan berbagai kuliner khas Semarang dan aktivitas edukatif tentang sejarah dan budaya Semarang.', 'Jl. Raya Kaligawe KM. 1, Kaligawe, Kec. Gayamsari, Kota Semarang', '-6.95803', '110.44596', '10:00 - 21:00 WIB', 25000.00, NULL, NULL, NULL, 'destinations/d5b62739-bcea-4713-be68-ceba249e902b.jpg', '[\"destinations\\/gallery\\/a13d6219-7c63-422a-b366-900b0ad29887.jpeg\"]', 0, 1, '2025-05-07 07:09:32', '2025-05-31 11:02:43', 'https://youtu.be/yLlGI7ILnPo?si=q9a2-_uhGE5lN9wt'),
(15, 'Simpang Lima', 'simpang-lima', 'Simpang Lima adalah alun-alun utama Kota Semarang yang menjadi pusat aktivitas masyarakat. Area ini dikelilingi pusat perbelanjaan dan kuliner, serta sering menjadi tempat berbagai acara dan festival.', 'Simpang Lima, Pleburan, Kec. Semarang Selatan, Kota Semarang', '-6.99016', '110.422886', '24 jam', 0.00, NULL, NULL, NULL, 'destinations/0de36279-95b9-47ee-8778-3b03044b4784.jpeg', '[\"destinations\\/gallery\\/6d96dcb1-80b0-4c54-be11-9e53aa570ca0.jpg\"]', 0, 1, '2025-05-07 07:09:32', '2025-05-31 11:05:13', 'https://youtu.be/tOl_ilOGtHM?si=Nm9d0aJjjCNOU33B'),
(22, 'Semarang Zoo', 'semarang-zoo', 'Semarang Zoo, yang juga dikenal sebagai Kebun Binatang Mangkang, adalah sebuah tempat wisata edukatif dan menyenangkan di Semarang. Di sini pengunjung dapat melihat berbagai koleksi satwa, menikmati wahana interaktif, dan berpartisipasi dalam program konservasi satwa.', 'Jl. Jend. Urip Sumoharjo No.1, Wonosari, Kec. Ngaliyan, Kota Semarang, Jawa Tengah 50244', '-6.96934', '110.28664', '08:00 - 15:00', 25000.00, '+62085-9322-3655', NULL, 'http://www.semarangzooofficial.com/', 'destinations/c45466ed-98c1-4178-a7cc-1cfe3bcfe094.jpeg', '[\"destinations\\/gallery\\/9c12baa7-b2e3-4ca2-a32a-71370e08e58c.jpg\"]', 0, 1, '2025-05-22 00:53:09', '2025-05-31 11:07:34', 'https://youtu.be/PTblrzA7Z4s?si=QKeCrtmPUOAQGvJS'),
(23, 'Funtopia Queen City Mall', 'funtopia-queen-city-mall', 'Mencari tempat bermain anak yang aman serta nyaman tentu adalah hal yang perlu dilakukan oleh orang tua untuk mengisi waktu luang, serta mengedukasi si kecil. Salah satu playground yang bisa dikunjungi orang tua bersama anak adalah Funtopia Queen City Semarang.', '2CHC+443, Jl. Pemuda, Dadapsari, Kec. Semarang Tengah, Kota Semarang, Jawa Tengah', '-6.97213', '110.42033', '10:00 - 22:00', 90000.00, NULL, NULL, 'http://www.mitragamesindo.com/', 'destinations/45ac9d59-8d57-4eb5-9542-e7b9fd8c8444.jpeg', '[\"destinations\\/gallery\\/215d7c03-93b9-4f0a-af64-cbfd1b6b5bd3.jpeg\"]', 0, 1, '2025-05-22 01:06:50', '2025-05-31 11:08:34', 'https://youtu.be/43Yss6yox6M?si=Yxf7-bxdUUoYoLCY');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `destination_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_07_060855_create_categories_table', 1),
(5, '2025_05_07_060855_create_destinations_table', 1),
(6, '2025_05_07_060856_create_galleries_table', 1),
(7, '2025_05_07_060856_create_reviews_table', 1),
(8, '2025_05_07_060931_create_category_destination_table', 1),
(9, '2025_05_07_070234_add_is_admin_to_users_table', 1),
(10, '2025_05_22_005530_add_youtube_url_to_destinations_table', 2),
(11, '2024_03_21_add_gallery_images_to_destinations', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `destination_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `reviews`
--

INSERT INTO `reviews` (`id`, `destination_id`, `user_id`, `rating`, `comment`, `is_verified`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 5, 'mantapppppp', 1, '2025-05-07 07:27:30', '2025-05-07 07:27:30'),
(2, 1, 1, 1, 'jelekkkkkkk', 1, '2025-05-08 02:13:43', '2025-05-08 02:13:43'),
(3, 1, 4, 3, 'anjaiiiiii', 1, '2025-05-08 02:16:29', '2025-05-08 02:16:29'),
(4, 1, 1, 5, 'tempatnya baguss', 1, '2025-05-22 00:40:28', '2025-05-22 00:40:28'),
(5, 2, 6, 4, 'anjaiii keren', 1, '2025-05-26 21:04:17', '2025-05-26 21:04:17'),
(7, 23, 7, 4, 'bagussssss', 1, '2025-06-01 21:04:52', '2025-06-01 21:04:52'),
(8, 23, 7, 5, 'mantapppppp', 1, '2025-06-01 21:06:32', '2025-06-01 21:06:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('R0Twyli3PCtPzruucN9dgQPq0BIk7ZiPn05IqQLz', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiU0JBN2ZpaEFpOVg5UG85V1hSQmx5QTNDa1ZiV2pUUm1qa00yRVppMiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kZXN0aW5hdGlvbnMvMjMiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo3O30=', 1748837193),
('rdAKS0POZytN2dq6XFWxXSzaAFU0fFdwBa6H99PF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSk1iUkkzSVdiRW9EanhYc0VMdUpmMzdwaFdLbk1EWTlVd0VJbUFZeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748836822);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@example.com', NULL, '$2y$12$9lEKTXC98vcn2Bc3hfBw3.ae2g91kF7p1IeV6Vi.I3itf8zFrYUsO', 1, NULL, '2025-05-07 07:09:32', '2025-05-07 07:09:32'),
(2, 'david', 'david@gmail.com', NULL, '$2y$12$DUJ/cXm.zYrYVycXCWIMzu.kzRvXm9QAgRs/MrhqO6pAfpAQyph6u', 0, NULL, '2025-05-07 07:27:16', '2025-05-07 07:27:16'),
(3, 'dapid', 'dapid@gmail.com', NULL, '$2y$12$/7C38p6kroIPEW4zwp3e3OFUJPkSExq7WNjNaQH5dc/.hWg1yG9k2', 0, NULL, '2025-05-07 08:12:33', '2025-05-07 08:12:33'),
(4, 'dipka', 'dipka@gmail.com', NULL, '$2y$12$c.ZvU7YZs8wdR.M1Q/V1W.W25Wm.P2nbo.9cbEreJsWXz30nc//Lq', 0, NULL, '2025-05-08 02:16:15', '2025-05-08 02:16:15'),
(5, 'david', 'd@example.com', NULL, '$2y$12$CPWA.QllwmHBUPPZs9WU2O5rmM2d4C30YzhPaIGVfdb8uKVaYJGpy', 0, NULL, '2025-05-21 17:53:03', '2025-05-21 17:53:03'),
(6, 'da', 'da@gmail.com', NULL, '$2y$12$8GLrU3o0LI2AZMPGmxhnSORqv8OPUB9mD03CbaTU6xZG2GDFLhWra', 0, NULL, '2025-05-26 21:01:27', '2025-05-26 21:01:27'),
(7, 'david', 'd@gmail.com', NULL, '$2y$12$danhuOqettN7QHK3wm/NouVqrTRZtYwWqNLaWscgdADYk87riDImy', 0, NULL, '2025-06-01 21:04:20', '2025-06-01 21:04:20');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indeks untuk tabel `category_destination`
--
ALTER TABLE `category_destination`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_destination_category_id_foreign` (`category_id`),
  ADD KEY `category_destination_destination_id_foreign` (`destination_id`);

--
-- Indeks untuk tabel `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `destinations_slug_unique` (`slug`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galleries_destination_id_foreign` (`destination_id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_destination_id_foreign` (`destination_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `category_destination`
--
ALTER TABLE `category_destination`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `category_destination`
--
ALTER TABLE `category_destination`
  ADD CONSTRAINT `category_destination_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_destination_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `galleries_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
