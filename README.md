# 🏛️ Wisata Semarang - Web Application

[![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-orange.svg)](https://mysql.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](https://opensource.org/licenses/MIT)

## 📖 Tentang Project

**Wisata Semarang** adalah aplikasi web berbasis Laravel yang menyediakan informasi lengkap tentang destinasi wisata di Kota Semarang. Aplikasi ini dirancang untuk membantu wisatawan menemukan tempat-tempat menarik, mendapatkan informasi detail, dan berbagi pengalaman melalui review.

### ✨ Fitur Utama

-   🏠 **Dashboard Admin** - Manajemen destinasi wisata, kategori, dan user
-   🗺️ **Katalog Destinasi** - 23+ destinasi wisata Semarang dengan detail lengkap
-   📸 **Galeri Foto** - Koleksi foto setiap destinasi wisata
-   🎥 **Video YouTube** - Embed video YouTube untuk setiap destinasi
-   ⭐ **Sistem Review** - User dapat memberikan rating dan review
-   🔍 **Pencarian & Filter** - Filter berdasarkan kategori wisata
-   👥 **User Management** - Registrasi, login, dan manajemen profil
-   📱 **Responsive Design** - Tampilan optimal di desktop dan mobile

### 🏛️ Destinasi Wisata yang Tersedia

-   **Wisata Sejarah & Budaya**: Lawang Sewu, Kota Lama, Sam Poo Kong
-   **Wisata Alam**: Goa Kreo, Brown Canyon, Pantai Marina
-   **Wisata Religi**: Masjid Agung Jawa Tengah, Pagoda Avalokitesvara
-   **Wisata Kuliner**: Pasar Semawis, Kampoeng Semarang
-   **Wisata Keluarga**: Saloka Theme Park, Puri Maerokoco, Semarang Zoo

## 🚀 Teknologi yang Digunakan

-   **Backend**: Laravel 10.x (PHP 8.2+)
-   **Frontend**: Blade Templates, Tailwind CSS
-   **Database**: MySQL 8.0+
-   **Authentication**: Laravel Breeze
-   **File Storage**: Laravel Storage
-   **Image Processing**: Laravel Jobs & Queues

## 📋 Prasyarat

Sebelum menjalankan aplikasi, pastikan sistem Anda memenuhi persyaratan berikut:

-   PHP >= 8.2
-   Composer
-   MySQL >= 8.0
-   Node.js & NPM (untuk asset compilation)
-   Git

## 🛠️ Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/dadisan/project-web-magang1.git
cd project-web-magang1
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=wisata_semarang
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Import Database

```bash
# Buat database baru
mysql -u root -p -e "CREATE DATABASE wisata_semarang;"

# Import data dari file SQL
mysql -u root -p wisata_semarang < database/wisata_semarang.sql
```

### 6. Jalankan Migration & Seeder

```bash
php artisan migrate
php artisan db:seed
```

### 7. Setup Storage

```bash
php artisan storage:link
```

### 8. Compile Assets

```bash
npm run dev
```

### 9. Jalankan Server

```bash
php artisan serve
```

Aplikasi akan berjalan di `http://127.0.0.1:8000`

## 👤 Akun Default

### Admin

-   **Email**: admin@example.com
-   **Password**: password

### User Biasa

-   **Email**: david@gmail.com
-   **Password**: password

## 📁 Struktur Project

```
test-web2/
├── app/
│   ├── Http/Controllers/     # Controllers
│   ├── Models/              # Eloquent Models
│   ├── Jobs/                # Background Jobs
│   └── Providers/           # Service Providers
├── database/
│   ├── migrations/          # Database Migrations
│   ├── seeders/            # Database Seeders
│   └── wisata_semarang.sql # Database Dump
├── resources/
│   └── views/              # Blade Templates
├── public/
│   ├── images/             # Public Images
│   └── storage/            # Storage Symlink
└── routes/
    └── web.php             # Web Routes
```

## 🗄️ Database Schema

### Tabel Utama

-   **users** - Data pengguna (admin & user biasa)
-   **categories** - Kategori wisata (5 kategori)
-   **destinations** - Data destinasi wisata (23 destinasi)
-   **reviews** - Review dan rating dari user
-   **galleries** - Galeri foto destinasi
-   **category_destination** - Relasi many-to-many kategori & destinasi

## 🔧 Fitur Admin

### Dashboard Admin

-   Akses: `/admin/dashboard`
-   Fitur: Manajemen destinasi, kategori, user, dan review

### Manajemen Destinasi

-   CRUD destinasi wisata
-   Upload gambar utama dan galeri
-   Tambah URL YouTube
-   Set kategori destinasi

### Manajemen Kategori

-   CRUD kategori wisata
-   Set icon dan deskripsi

## 🎨 Customization

### Menambah Destinasi Baru

1. Akses admin panel
2. Pilih "Tambah Destinasi"
3. Isi form dengan data lengkap
4. Upload gambar dan set kategori

### Mengubah Tema

-   Edit file CSS di `resources/css/app.css`
-   Modifikasi layout di `resources/views/layouts/`

## 🐛 Troubleshooting

### Error Database Connection

```bash
php artisan config:clear
php artisan cache:clear
```

### Error Storage Link

```bash
php artisan storage:link
```

### Error Asset Compilation

```bash
npm install
npm run dev
```

## 🤝 Contributing

1. Fork repository
2. Buat branch fitur baru (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📄 License

Project ini dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).

## 👨‍💻 Developer

**David Dimas** - [GitHub](https://github.com/dadisan)

---

<div align="center">
  <p>Made with ❤️ for Semarang Tourism</p>
</div>
