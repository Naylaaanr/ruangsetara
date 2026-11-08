# RuangSetara

**Platform Pencarian dan Rekomendasi Tempat Ramah Disabilitas di Kabupaten Kuningan, Jawa Barat.**

RuangSetara adalah aplikasi web full-stack yang dibangun sebagai proyek individu mata kuliah Cyber Security. Aplikasi ini membantu penyandang disabilitas menemukan tempat publik (kantor layanan, fasilitas kesehatan, tempat ibadah, ruang publik, dan lainnya) yang fasilitasnya sesuai dengan kebutuhan aksesibilitas mereka.

## Latar Belakang dan Tujuan

Informasi tentang aksesibilitas tempat publik di Kabupaten Kuningan belum terhimpun dalam satu platform. Pengguna kursi roda, tunanetra, dan tunarungu sering harus menebak apakah sebuah tempat memiliki jalur landai, guiding block, atau informasi visual sebelum memutuskan datang. RuangSetara menghimpun data fasilitas aksesibilitas tiap tempat, memverifikasinya, dan menyajikan rekomendasi berdasarkan kecocokan fasilitas dengan kebutuhan pengguna.

## Fitur Utama

Fitur yang dibangun pada proyek ini (dikembangkan dan didokumentasikan bertahap):

1. Registrasi dan login pengguna
2. Hak akses berdasarkan peran (role): user dan admin
3. Pencarian tempat ramah disabilitas
4. Filter berdasarkan kategori tempat dan fasilitas aksesibilitas
5. Halaman detail tempat beserta fasilitasnya
6. Rekomendasi tempat berdasarkan kecocokan fasilitas dengan kebutuhan pengguna (Skor Aksesibilitas)
7. CRUD data tempat dan fasilitas oleh admin
8. Dashboard admin berisi statistik jumlah tempat dan status verifikasi
9. Status data tempat: belum diverifikasi, sudah diverifikasi, dan perlu diperiksa

Fasilitas aksesibilitas yang dicatat per tempat antara lain: jalur landai (ramp), toilet aksesibel, guiding block, informasi braille, informasi visual, dan fasilitas pendukung lainnya. Pencarian dapat disesuaikan dengan kebutuhan: disabilitas fisik/pengguna kursi roda, tunanetra/keterbatasan penglihatan, dan tunarungu/keterbatasan pendengaran.

## Teknologi yang Digunakan

- Backend: Laravel 12 (PHP 8.2)
- Database: MySQL / MariaDB
- Frontend: Laravel Blade dan Bootstrap 5
- Version control: Git dan GitHub
- Lingkungan lokal: XAMPP dan Visual Studio Code

## Cara Menjalankan di Komputer Lokal

Prasyarat: PHP 8.2 atau lebih baru, Composer, dan MySQL/MariaDB (misalnya dari XAMPP).

1. Clone repository ini: git clone https://github.com/Naylaaanr/ruangsetara.git
2. Masuk ke folder proyek: cd ruangsetara
3. Pasang dependensi PHP: composer install
4. Salin file konfigurasi contoh: cp .env.example .env
5. Buat kunci aplikasi: php artisan key:generate
6. Buat database kosong bernama ruangsetara (misalnya melalui phpMyAdmin)
7. Atur koneksi database pada file .env (lihat bagian Konfigurasi Environment)
8. Jalankan migrasi database: php artisan migrate
9. Jalankan server lokal: php artisan serve
10. Buka aplikasi di browser: http://127.0.0.1:8000

## Konfigurasi Environment (.env)

Seluruh nilai rahasia disimpan pada file .env di masing-masing komputer/server dan file tersebut TIDAK di-commit ke repository (dilindungi oleh .gitignore). Variabel yang perlu diatur:

- APP_KEY : kunci enkripsi aplikasi, dibuat oleh perintah php artisan key:generate
- DB_CONNECTION : mysql
- DB_HOST : 127.0.0.1
- DB_PORT : 3306
- DB_DATABASE : ruangsetara
- DB_USERNAME : (diisi sesuai pengguna database setempat)
- DB_PASSWORD : (diisi sesuai kata sandi database setempat, tidak ditulis di dokumen ini)

## Keamanan yang Diterapkan

Kontrol keamanan yang diterapkan pada aplikasi ini, sesuai persyaratan mata kuliah:

- Hashing kata sandi dengan bcrypt (bawaan Laravel), kata sandi tidak pernah disimpan sebagai teks biasa
- Pencegahan SQL injection melalui Eloquent ORM dan parameter binding bawaan Laravel
- Pencegahan XSS melalui validasi input dan escaping output otomatis Blade ({{ }})
- Perlindungan CSRF melalui token CSRF bawaan Laravel pada setiap form
- Pembatasan percobaan login (rate limiting) untuk menahan serangan brute force
- Kontrol akses berbasis peran (RBAC): halaman dan fungsi admin tidak dapat diakses user biasa
- Sesi login melalui cookie dengan atribut HttpOnly
- Secret hanya disimpan di file .env dan tidak diunggah ke GitHub
- HTTPS aktif pada deployment publik

## Penggunaan AI

Sesuai ketentuan mata kuliah, penggunaan AI pada proyek ini dicantumkan secara terbuka. Penulis menggunakan bantuan AI (Muse dari Meta) untuk:

- Pendampingan langkah demi langkah penggunaan Git/GitHub dan instalasi Laravel dari nol
- Penjelasan konsep keamanan (hashing, RBAC, CSRF, rate limiting, pengelolaan secret)
- Penelusuran error berdasarkan pesan error nyata yang muncul, misalnya error Composer "Project directory is not empty" dan timeout unduhan paket
- Penyusunan draf awal README ini

Contoh prompt utama yang digunakan: "Jelaskan penyebab error Composer ini dan cara mengatasinya tanpa menghapus folder .git" dan "Bimbing saya membuat aplikasi Laravel tahap demi tahap dari nol, satu tahap terverifikasi sebelum lanjut".

Seluruh perintah, kode, dan konfigurasi dijalankan, diuji, dan diverifikasi sendiri oleh penulis dari output nyata di komputer penulis. Tidak ada kata sandi, token, kunci, atau data pribadi yang diberikan kepada AI.

## URL Aplikasi

(Belum tersedia - diisi setelah deployment publik dengan HTTPS selesai.)

## Akun Uji

(Diisi setelah fitur registrasi dan login selesai: satu akun user dan satu akun admin untuk keperluan pengujian dosen.)

## Hasil Self-Testing Keamanan

(Diisi setelah tahap pengujian selesai. Pengujian mencakup minimal 5 skenario: SQL injection, XSS, kontrol akses/IDOR, autentikasi dan sesi, serta HTTPS dan header keamanan, ditambah pemeriksaan secret yang tidak ter-commit dan audit dependensi.)

## Penulis

Nayla Nur Alvi - Repository: https://github.com/Naylaaanr/ruangsetara
