Personal Web - Faisal Mahfuzh
Website pribadi yang menampilkan artikel, galeri foto, informasi tentang saya, dan halaman kontak. Website ini dilengkapi dengan fitur dark mode, sistem login untuk admin dan user, serta CRUD untuk mengelola konten.

Fitur Utama
Artikel: Menampilkan daftar artikel dengan pagination dan fitur pencarian
Gallery: Galeri foto dengan modal popup untuk melihat gambar detail
About: Halaman profil dengan foto dan informasi kontak
Kontak: Form kontak untuk mengirim pesan (hanya user login)
Admin Dashboard:
Mengelola artikel (tambah/edit/hapus)
Mengelola galeri foto
Mengelola halaman about
Melihat dan membalas pesan user
User Dashboard:
Mengirim pesan melalui form kontak
Melihat riwayat pesan dan balasan admin
Dark Mode: Fitur untuk mengubah tema website menjadi gelap
Authentication: Sistem login untuk admin dan user


Struktur File
├── about.php
├── admin/
│   ├── about.php
│   ├── artikel.php
│   ├── balas_pesan.php
│   ├── dashboard.php
│   ├── gallery.php
│   ├── index.php
│   ├── login.php
│   ├── logout.php
│   ├── pesan.php
│   └── proses_login.php
├── db_faisal_d1a240066 (1).sql
├── detail_artikel.php
├── gallery.php
├── images/
│   └── about/
├── index.php
├── koneksi.php
├── kontak.php
├── proses_kontak.php
├── register.php
├── riwayat_pesan_user.php
└── user_home.php


Penjelasan File Utama
about.php - Menampilkan informasi tentang saya
gallery.php - Galeri foto dengan modal popup
index.php - Halaman utama artikel
detail_artikel.php - Detail artikel lengkap
kontak.php - Form kontak (user only)
user_home.php - Dashboard user
riwayat_pesan_user.php - Riwayat pesan user
admin/ - Folder sistem admin
koneksi.php - Koneksi database MySQL


Teknologi Digunakan
PHP
MySQL
Tailwind CSS
Font Awesome
JavaScript


Instalasi
Import database dari file db_faisal_d1a240066 (1).sql
Sesuaikan konfigurasi database di koneksi.php:
php
$host = "localhost";
$user = "root";
$password = "";
$nama_database = "db_faisal_d1a240066";


Akses website melalui:
Home: index.php
Admin: admin/login.php (username: admin, password: admin123)
User: register.php untuk membuat akun user


Fitur Menarik
✅ Dark Mode (preferensi disimpan di localStorage)
✅ Responsive Design
✅ Sistem Login Multi-level (admin/user)
✅ Gallery Modal dengan navigasi gambar
✅ Form Validation
✅ Pagination Artikel
✅ Search Artikel
✅ First-letter styling pada artikel
✅ Hover effects pada gambar

Database Structure
Tabel Utama
tbl_artikel
id_artikel
nama_artikel
isi_artikel
gambar
tanggal
penulis

tbl_gallery
id_gallery
judul
foto

tbl_about
id_about
about
foto (opsional)
email (opsional)
telepon (opsional)
tbl_user
username
password
level (admin/user)

tbl_kontak
id_kontak
nama
email
pesan
tanggal
status
balasan
