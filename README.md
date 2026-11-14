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
- Database: MySQL / MariaDB (production: MySQL 8.0.34)
- Frontend: Laravel Blade dan Bootstrap 5
- Version control: Git dan GitHub
- Lingkungan lokal: XAMPP dan Visual Studio Code
- Hosting production: YoHost (cPanel), domain dari IDCloudHost

## Cara Menjalankan di Komputer Lokal

Prasyarat: PHP 8.2 atau lebih baru, Composer, dan MySQL/MariaDB (misalnya dari XAMPP).

1. Clone repository ini: git clone https://github.com/Naylaaanr/ruangsetara.git
2. Masuk ke folder proyek: cd ruangsetara
3. Pasang dependensi PHP: composer install
4. Salin file konfigurasi contoh: cp .env.example .env
5. Buat kunci aplikasi: php artisan key:generate
6. Buat database kosong bernama ruangsetara (misalnya melalui phpMyAdmin)
7. Atur koneksi database pada file .env (lihat bagian Konfigurasi Environment)
8. Jalankan migrasi database beserta data awal kategori dan fasilitas: php artisan migrate --seed
9. Jalankan server lokal: php artisan serve
10. Buka aplikasi di browser: http://127.0.0.1:8000

## Konfigurasi Environment (.env)

Seluruh nilai rahasia disimpan pada file .env di masing-masing komputer/server dan file tersebut TIDAK di-commit ke repository (dilindungi oleh .gitignore). Variabel yang perlu diatur:

- APP_KEY : kunci enkripsi aplikasi, dibuat oleh perintah php artisan key:generate
- DB_CONNECTION : mysql
- DB_HOST : 127.0.0.1
- DB_PORT : 3306
- DB_DATABASE : ruangsetara
- DB_USERNAME : 
- DB_PASSWORD : 

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

Aplikasi aktif dan dapat diakses publik di: 
**https://ruangsetara-kuningan.my.id**

Situs live sejak 13 November 2026 dengan HTTPS yang valid (sertifikat Let's Encrypt). Data pada situs live saat ini: 7 tempat terdaftar (4 di antaranya berstatus sudah diverifikasi dan tampil ke publik), 6 kategori, dan 12 fasilitas aksesibilitas.

## Akun Uji

Akun berikut dibuat pada situs live agar dosen dapat mencoba kedua peran. Alamat berakhiran .test adalah alamat khusus pengujian dan hanya berfungsi sebagai identitas login.

| Peran | Email | Kata Sandi |
| --- | --- | --- |
| Admin | adminrutra@ruangsetara.test | (tercantum pada Laporan)|
| User | user@ruangsetara.test | (tercantum pada Laporan)|

Kata sandi akun uji juga tercantum pada laporan PDF yang dikumpulkan melalui EdLink.

## Hasil Self-Testing Keamanan

Hasil berikut adalah yang benar-benar teramati selama pembangunan (di komputer lokal) dan setelah deployment (di situs live). Penulis tidak mengarang hasil pengujian.

Terbukti dari pengamatan:

- **Hashing bcrypt:** kata sandi tersimpan sebagai hash yang diawali $2y$ pada tabel users (terlihat di phpMyAdmin), bukan teks biasa.
- **Autentikasi:** login dengan kata sandi salah ditolak dengan pesan kesalahan generik; kata sandi lemah (misalnya hanya angka atau terlalu pendek) ditolak oleh aturan validasi saat registrasi.
- **Kontrol akses (RBAC/IDOR):** user biasa menerima penolakan 403 pada area admin, terbukti di lokal dan teramati di situs live; halaman detail tempat yang belum diverifikasi mengembalikan 404 dan tempat tersebut tidak tampil di halaman publik.
- **XSS:** masukan berupa skrip pada kolom pencarian tampil sebagai teks biasa (ter-escape oleh Blade) pada pengujian lokal.
- **Sesi:** setelah logout, membuka /dashboard memantul kembali ke halaman login.
- **HTTPS:** situs live terbuka dengan sertifikat Let's Encrypt yang valid tanpa peringatan browser (diterbitkan 13 November 2026 melalui AutoSSL).
- **Secret:** berkas .env tidak ada di repository ini; yang tersedia hanya .env.example tanpa nilai rahasia.

Belum dilakukan, dinyatakan terbuka:

- Pengujian SQL injection secara formal dan pengujian rate limiting login belum dilakukan.
- Audit dependensi (composer audit) belum dijalankan dan header keamanan respons belum diperiksa.

Rincian lengkap beserta perbaikannya ada pada laporan PDF yang dikumpulkan melalui EdLink.

## Penulis

Nayla Nur Alvi - Repository: https://github.com/Naylaaanr/ruangsetara
