# GreenTag - QR Waste Disposal Information System

![GreenTag Poster](https://i.ibb.co/L5B7Nvy/greentag-poster.jpg)

GreenTag adalah sistem informasi manajemen sampah berbasis web yang dirancang untuk menjembatani komunikasi antara masyarakat, petugas kebersihan, dan admin fasilitas. Dengan memanfaatkan teknologi QR code, GreenTag menyederhanakan proses pelaporan, menyediakan informasi transparan, dan mendukung operasional pengelolaan sampah yang lebih efisien dan cerdas.

Proyek ini dibangun menggunakan **Laravel 12** dengan arsitektur modern, termasuk Blade, Vite, dan Alpine.js untuk pengalaman pengguna yang interaktif.

## Fitur Utama

### Fitur Publik (untuk Masyarakat)

- **Halaman Landing Informatif:** Menampilkan jadwal pengambilan, artikel edukasi, dan informasi kontak yang dinamis.
- **Scan QR Code:** Setiap tempat sampah memiliki QR code unik. Saat di-scan, pengguna akan diarahkan ke halaman detail khusus yang berisi:
    - Informasi jenis sampah yang diterima.
    - Jadwal pengambilan untuk lokasi tersebut.
    - Link ke artikel edukasi terkait.
- **Formulir Pengaduan Cerdas:** Pengguna dapat melaporkan masalah (misalnya, tempat sampah penuh atau rusak) melalui formulir yang secara otomatis melampirkan ID tempat sampah yang relevan.
- **Dukungan Multi-Bahasa:** Antarmuka publik sepenuhnya mendukung Bahasa Indonesia dan Inggris.

### Fitur Panel Admin & Petugas

- **Dasbor Visual:**
    - **Admin:** Melihat statistik keseluruhan sistem, tren pengaduan, dan komposisi kategori dalam bentuk grafik.
    - **Petugas (Officer):** Melihat ringkasan tugas harian, pengaduan yang perlu ditangani, dan laporan kinerja pribadi.
- **Manajemen Pengguna (Admin):** Admin dapat membuat, mengedit, dan menghapus akun untuk Petugas. Akun admin dilindungi dari penghapusan.
- **Manajemen Data Master (Officer & Admin):**
    - **Lokasi:** CRUD untuk mengelola lokasi fisik tempat sampah.
    - **Tempat Sampah (Bins):** CRUD untuk mengelola aset tempat sampah, termasuk pembuatan QR token unik secara otomatis dan penentuan jenis sampah.
    - **Jadwal:** CRUD untuk rute pengambilan sampah, dengan kemampuan untuk menugaskan banyak lokasi ke satu rute.
- **Manajemen Konten (Officer & Admin):**
    - **Edukasi:** CRUD untuk artikel, berita, dan pengumuman menggunakan Rich Text Editor (Trix).
    - **Pengaduan:** Petugas dapat melihat detail pengaduan yang masuk, mengubah statusnya (Baru, Diproses, Selesai, Ditolak), dan menambahkan catatan penyelesaian.
- **Antarmuka Modern:**
    - Sidebar yang dapat diciutkan (collapsible) yang mengingat preferensi pengguna.
    - Indikator loading progress bar di setiap navigasi halaman.

## Prasyarat

- PHP >= 8.2
- Composer
- Node.js (20.19.x) & NPM
- Database (PostgreSQL direkomendasikan, tetapi MySQL/MariaDB juga bisa)

## Panduan Instalasi

1.  **Clone Repositori**

    ```bash
    git clone https://github.com/username/greentag-web.git
    cd greentag-web
    ```

2.  **Instal Dependensi PHP**

    ```bash
    composer install
    ```

3.  **Instal Dependensi Frontend**

    ```bash
    npm install
    ```

4.  **Konfigurasi Lingkungan**
    - Salin file `.env.example` menjadi `.env`:
        ```bash
        cp .env.example .env
        ```
    - Buat kunci aplikasi:
        ```bash
        php artisan key:generate
        ```
    - Atur koneksi database Anda di dalam file `.env`:
        ```
        DB_CONNECTION=pgsql
        DB_HOST=127.0.0.1
        DB_PORT=5432
        DB_DATABASE=greentag
        DB_USERNAME=user
        DB_PASSWORD=password
        ```

5.  **Migrasi & Seeding Database**
    Jalankan migrasi untuk membuat semua tabel dan jalankan seeder untuk mengisi data awal (termasuk akun admin default).

    ```bash
    php artisan migrate:fresh --seed
    ```

    - Akun admin default: `admin@example.com`
    - Password: `password`

6.  **Buat Symlink untuk Storage**
    Agar gambar yang diunggah (seperti foto pengaduan dan gambar artikel) dapat diakses secara publik, jalankan perintah ini:
    ```bash
    php artisan storage:link
    ```

## Menjalankan Aplikasi

1.  **Jalankan Server Pengembangan Vite** (untuk kompilasi aset frontend):

    ```bash
    npm run dev
    ```

2.  **Jalankan Server Aplikasi Laravel**
    Buka terminal baru dan jalankan:
    ```bash
    php artisan serve
    ```

Aplikasi sekarang akan berjalan di `http://127.0.0.1:8000`.

## Struktur Database

Aplikasi ini menggunakan beberapa tabel utama yang saling berhubungan:

- `users`: Menyimpan data admin dan petugas.
- `bin_locations`: Menyimpan informasi tentang lokasi fisik.
- `bins`: Menyimpan data setiap aset tempat sampah dengan QR token unik.
- `collection_routes`: Mendefinisikan rute dan jadwal pengambilan.
- `route_location`: Tabel pivot yang menghubungkan `collection_routes` dan `bin_locations` (Many-to-Many).
- `complaints`: Menyimpan semua laporan yang masuk dari masyarakat.
- `informations`: Menyimpan konten artikel untuk edukasi dan berita.

---

_README ini dibuat berdasarkan pengembangan proyek GreenTag. Dibuat dengan ❤ dan Laravel._
