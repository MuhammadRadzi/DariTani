# DariTani

Katalog & Marketplace Hasil Tani Malino untuk Pelaku Usaha dan Konsumen di Makassar.

---

## Panduan Instalasi & Menjalankan Proyek

Pastikan di komputer Anda sudah terpasang **PHP >= 8.3**, **Composer**, **Node.js & npm**, serta SQLite atau MySQL.

```bash
# 1. Clone repositori
git clone https://github.com/MuhammadRadzi/DariTani.git
cd DariTani

# 2. Install dependensi backend & frontend
composer install
npm install

# 3. Salin file konfigurasi environment
cp .env.example .env

# 4. Generate app key
php artisan key:generate

# 5. Jalankan migrasi dan seeder database
php artisan migrate --seed

# 6. Build atau jalankan asset frontend
npm run dev

# 7. Di terminal lain, jalankan server Laravel
php artisan serve
```

Aplikasi dapat diakses melalui browser di `http://localhost:8000`.

---

## Akun Demo Pengujian

Setelah menjalankan `php artisan migrate --seed`, akun berikut siap digunakan:

| Peran (Role) | Email | Password | Keterangan |
|---|---|---|---|
| **Pembeli (Customer)** | `radzi@daritani.co.id` | `password` | Menjelajahi kebun, memasukkan produk ke keranjang, riwayat pesanan |
| **Petani (Farmer)** | `daengbaso@daritani.co.id` | `password` | Dashboard kebun, manajemen stok produk, kelola pesanan masuk |
| **Petani (Farmer)** | `rudy@daritani.co.id` | `password` | Akun petani mitra Malino lainnya |
| **Admin** | `admin@daritani.co.id` | `password` | Akun superadmin sistem |

---

## Menjalankan Unit & Feature Test

```bash
php artisan test
```

---

## Tentang Proyek

DARITANI merupakan sebuah inisiatif proyek kewirausahaan berbasis teknologi yang dirancang sebagai bagian dari tugas akhir mata pelajaran Produk Kreatif dan Kewirausahaan (PKK). Proyek ini dikembangkan oleh tim dengan pembagian peran yang terstruktur, mencakup perencanaan bisnis, perancangan sistem, desain produk digital, hingga strategi pemasaran. Melalui proyek ini, tim berfokus pada penerapan konsep kewirausahaan, kolaborasi tim, serta pemanfaatan teknologi digital sebagai sarana pengembangan produk yang relevan dengan kebutuhan masyarakat.

<img width="1080" height="1350" alt="struktur" src="https://github.com/user-attachments/assets/6c796b69-6d27-43f7-b133-f31927ac6f9f" />
