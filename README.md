# 📚 Sistem Manajemen Data Mahasiswa

<p align="center">
    <img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP Version">
    <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel Version">
    <img src="https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap Version">
</p>

Aplikasi web berbasis Laravel untuk mengelola data mahasiswa dengan fitur CRUD (Create, Read, Update, Delete), pencarian, ekspor PDF dan Excel.

## ✨ Fitur Utama

- 📝 **Manajemen Data Mahasiswa**
  - Tambah data mahasiswa baru
  - Lihat daftar mahasiswa
  - Edit informasi mahasiswa
  - Hapus data mahasiswa

- 🔍 **Pencarian Pintar**
  - Pencarian berdasarkan nama
  - Pencarian berdasarkan NIM
  - Pencarian berdasarkan email

- 📊 **Ekspor Data**
  - Ekspor ke PDF dengan formatting yang rapi
  - Ekspor ke Excel dengan header yang terstruktur

- 📱 **User Interface Modern**
  - Desain responsif
  - Navigasi yang intuitif
  - Pesan konfirmasi untuk aksi penting
  - Validasi form real-time

## 🛠️ Teknologi

- **Backend**
  - PHP 8.2
  - Laravel 12.x
  - MySQL/MariaDB

- **Frontend**
  - Bootstrap 5.3
  - Bootstrap Icons
  - JavaScript

- **Package Pendukung**
  - barryvdh/laravel-dompdf (PDF Export)
  - maatwebsite/excel (Excel Export)

## 💻 Persyaratan Sistem

- PHP >= 8.2
- Composer
- MySQL/MariaDB
- Web Server (Apache/Nginx)
- Node.js & NPM (opsional, untuk asset compilation)

## 🚀 Instalasi

1. **Clone Repositori**
   ```bash
   git clone https://github.com/yourusername/crud-laravel.git
   cd crud-laravel
   ```

2. **Install Dependensi**
   ```bash
   composer install
   ```

3. **Konfigurasi Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Setup Database**
   - Buat database baru di MySQL
   - Update konfigurasi database di file .env:
     ```
     DB_DATABASE=nama_database_anda
     DB_USERNAME=username_database
     DB_PASSWORD=password_database
     ```

5. **Migrasi & Seeding**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Jalankan Aplikasi**
   ```bash
   php artisan serve
   ```
   Akses aplikasi di: http://localhost:8000

## 📝 Penggunaan

### Mengelola Data Mahasiswa

1. **Tambah Mahasiswa**
   - Klik tombol "+ Tambah Mahasiswa"
   - Isi form dengan data yang valid
   - Klik "Simpan"

2. **Edit Mahasiswa**
   - Klik tombol "Edit" pada baris yang ingin diubah
   - Update informasi yang diperlukan
   - Klik "Simpan"

3. **Hapus Mahasiswa**
   - Klik tombol "Hapus"
   - Konfirmasi penghapusan

### Pencarian dan Filtering

- Gunakan search bar untuk mencari berdasarkan:
  - Nama mahasiswa
  - NIM
  - Alamat email

### Ekspor Data

- **PDF**
  - Klik tombol "Export PDF"
  - File akan otomatis terdownload

- **Excel**
  - Klik tombol "Export Excel"
  - File Excel akan terdownload dengan format yang rapi

## 🔒 Validasi Data

### Mahasiswa
- **Nama**
  - Wajib diisi
  - Minimal 3 karakter

- **NIM**
  - Wajib diisi
  - Harus unik
  - Format numerik

- **Email**
  - Wajib diisi
  - Harus unik
  - Format email valid

## ⚙️ Kustomisasi

### Mengubah Jumlah Item Per Halaman
Di `app/Http/Controllers/MahasiswaController.php`:
```php
protected $perPage = 8; // Ubah sesuai kebutuhan
```

### Mengubah Format Export
- **PDF**: Edit template di `resources/views/mahasiswa/pdf.blade.php`
- **Excel**: Modifikasi di `app/Exports/MahasiswaExport.php`

## 🤝 Kontribusi

Kontribusi selalu diterima dengan senang hati. Untuk perubahan besar, harap buka issue terlebih dahulu untuk mendiskusikan perubahan yang diinginkan.

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).
