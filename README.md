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
text
.
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
about.php
Menampilkan informasi tentang saya dengan foto profil dan informasi kontak. Data diambil dari tabel tbl_about.

gallery.php
Menampilkan galeri foto dari tabel tbl_gallery dengan fitur modal popup untuk melihat gambar secara detail.

index.php
Halaman utama yang menampilkan daftar artikel dari tabel tbl_artikel dengan fitur:

Pagination

Pencarian artikel

Dark mode

detail_artikel.php
Menampilkan detail lengkap sebuah artikel berdasarkan ID.

kontak.php
Form untuk mengirim pesan (hanya bisa diakses oleh user yang sudah login).

user_home.php
Dashboard user setelah login, berisi menu:

Kirim pesan

Lihat riwayat pesan

riwayat_pesan_user.php
Menampilkan riwayat pesan yang pernah dikirim user beserta balasan admin.

admin/
Folder berisi sistem admin:

Login/logout

Dashboard

CRUD artikel

CRUD galeri

CRUD about

Kelola pesan user

koneksi.php
File koneksi ke database MySQL.

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
Dark Mode
Pengguna bisa beralih antara mode terang dan gelap, dan preferensi akan disimpan di localStorage.

Responsive Design
Website dapat diakses dengan baik di berbagai ukuran perangkat.

Sistem Login Multi-level

Admin: dapat mengelola semua konten

User: dapat mengirim pesan dan melihat riwayat

Gallery Modal
Pengguna dapat melihat foto dalam ukuran besar dengan navigasi antar foto.

Form Validation
Validasi form di sisi klien dan server.

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
