☕ Kopi-Tech - Sistem POS Kasir & Manajemen Kafe Terintegrasi
Kopi-Tech adalah aplikasi berbasis web yang dirancang untuk mengotomatisasi operasional kafe, mulai dari sistem kassa POS (Point of Sale) kasir, manajemen menu oleh admin, hingga monitor antrean pesanan di dapur secara real-time. Proyek ini dikembangkan sebagai Tugas Akhir Mata Kuliah Pemrograman Web II.

👥 Anggota Kelompok & Pembagian Tugas
Proyek ini dikembangkan secara berkelompok yang terdiri dari 3 mahasiswa dengan pembagian tugas yang jelas sebagai bukti kontribusi aktif pada repositori Git:

Rahmad (NIM: 2410817210004) - Full Stack Developer

Merancang arsitektur database relasional, sistem autentikasi, dan model relasi Eloquent.

Membuat RoleMiddleware untuk pembatasan hak akses multi-user (Admin, Kasir, Dapur).

Mengimplementasikan fitur Smart Login (Autentikasi ganda via Username atau Email).

Mengembangkan halaman Monitor Antrean Dapur (Kitchen Display System) dengan layout geser horizontal yang efisien.

Membuat fitur Manajemen Data Master Menu (CRUD) yang dikhususkan untuk akun Admin.

Menyusun data dummy pada DatabaseSeeder untuk mempermudah simulasi pengujian sistem.

DANDY ORLEN JR.PONGPALILU (NIM: 2410817310018) - Frontend & UI/UX Specialist

Membangun antarmuka (UI) Sistem POS Kasir yang responsif menggunakan Tailwind CSS.

Mengembangkan fitur kalkulator hitung kembalian live (tanpa reload halaman) menggunakan JavaScript.

Mengintegrasikan tombol toggle tampil/sembunyikan kata sandi (👁️) pada halaman login.

🚀 Fitur Utama Aplikasi
Aplikasi Kopi-Tech dibekali dengan berbagai fitur wajib dan tambahan yang mengikuti praktik pengembangan web modern:

Sistem Login & Multi-User: Pengguna dapat melakukan login dan logout, serta mendukung lebih dari satu jenis hak akses (Admin, Kasir, Dapur).

Smart Login Authentication: Mendukung proses login fleksibel menggunakan username unik maupun alamat email resmi.

Halaman Dashboard POS Kasir: Menampilkan informasi utama berupa katalog menu kafe lengkap, manajemen keranjang belanja, dan catatan kustom resep dari pelanggan.

Kalkulator Kembalian Live (Vanilla JS & Alpine.js): Sistem otomatis mendeteksi kecukupan uang tunai yang diterima dan mengunci tombol checkout jika nominal uang masih kurang.

Monitor Antrean Dapur (Kitchen Display System): Layar khusus koki untuk memantau detail menu masakan beserta catatan kasir, serta fitur konfirmasi penyajian pesanan.

Manajemen Master Data Menu (CRUD): Modul khusus admin untuk melakukan operasi Tambah, Ubah, Hapus, dan Tampil data katalog menu beserta status stoknya.

Sistem Data Dummy Otomatis (Seeding): Menyediakan data awal siap pakai (3 akun user dan 9 menu andalan) saat database pertama kali dimigrasikan.

🛠️ Teknologi yang Digunakan
Aplikasi ini dibangun menggunakan ekosistem web modern berkinerja tinggi:

Backend Framework: Laravel (Mengikuti pola arsitektur MVC yang bersih).

Frontend CSS Framework: Tailwind CSS.

JavaScript Library: Alpine.js (Bawaan Laravel Breeze) & Vanilla JavaScript.

Database Relasional: MySQL / MariaDB.

Version Control System: Git & GitHub.

🗄️ Struktur Relasi Basis Data (Database Relations)
Sistem ini dirancang menggunakan basis data relasional dengan skema relasi data yang terstruktur secara benar:

A. 3 Relasi One-to-Many
User ───► Pesanan: Satu akun staff (Kasir) dapat memproses banyak data nota pesanan (HasMany).

Pesanan ───► DetailPesanan: Satu nota induk transaksi dapat memiliki banyak rincian item makanan/minuman (HasMany).

Menu ───► DetailPesanan: Satu menu produk kafe dapat terdaftar di dalam banyak baris rincian transaksi (HasMany).

B. 1 Relasi Many-to-Many
Pesanan ◄───► Menu: Banyak pesanan dapat memesan banyak menu sekaligus, dan sebaliknya. Relasi Many-to-Many ini dihubungkan secara sempurna melalui tabel pivot tengah, yaitu detail_pesanans.

💻 Panduan Instalasi Projek
Berikut adalah langkah-langkah untuk menjalankan aplikasi Kopi-Tech di lingkungan lokal komputer Anda:

1. Kloning Repositori
   Bash

git clone https://github.com/Rahmad-x/manajemen-kafe
cd repositori-kelompok 2. Instalasi Dependensi Backend (Composer)
Bash

composer install 3. Instalasi Dependensi Frontend (NPM)
Bash

npm install 4. Konfigurasi Environment (.env)
Salin file .env.example menjadi .env:

Bash

cp .env.example .env
Buka file .env yang baru dibuat melalui VS Code, lalu sesuaikan konfigurasi nama databasemu:

Cuplikan kode

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_manajemen_kafe
DB_USERNAME=root
DB_PASSWORD= 5. Generate Application Key
Bash

php artisan key:generate 6. Migrasi Database & Suntik Data Dummy (Seeding)
Pastikan aplikasi MySQL di XAMPP milikmu sudah menyala (Running), lalu jalankan perintah ini di terminal:

Bash

php artisan migrate:fresh --seed 7. Kompilasi Aset Frontend (Tailwind CSS)
Bash

npm run build 8. Jalankan Server Lokal Laravel
Bash

php artisan serve
Setelah aktif, buka browser Anda dan ketik alamat URL: http://127.0.0.1:8000

🔑 Data Akun Login Pengujian (Dummy Accounts)
Setelah berhasil melakukan perintah seeding di atas, kamu dan kelompokmu bisa langsung mensimulasikan 3 peran akun ini secara bergantian (Bisa login mengetikkan Username ataupun Email):
Hak Akses (Role) Username Email Password
Admin admin rhmd76457645@gmail.com password123
Kasir kasir Dandyorlenjunior@gmail.com password123
Dapur dapur acedomi64@gmail.com password123
