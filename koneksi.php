<?php
$host = "localhost";
$user = "root";
$password = "";
$nama_database = "db_faisal_d1a240066";
$db = mysqli_connect($host, $user, $password, $nama_database);
// Cek koneksi
if (!$db) {
    die("Koneksi gagal: " . mysqli_connect_error());
} else {
    // echo "Koneksi berhasil";
}
?>
