<?php 
include('../koneksi.php'); 
session_start();
if (!isset($_SESSION['username'])) { 
    header('location:login.php'); 
    exit; 
}

$judul = mysqli_real_escape_string($db, $_POST['judul']);
$foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];

// Pastikan folder images/ tersedia
$folder = '../images/';
$target = $folder . basename($foto);

// Coba upload file ke folder
if (move_uploaded_file($tmp, $target)) {
    // Jika berhasil upload, simpan ke database
    $sql = "INSERT INTO tbl_gallery (judul, foto) VALUES ('$judul', '$foto')";
    $query = mysqli_query($db, $sql);

    if ($query) {
        echo "<script>alert('Gambar berhasil ditambahkan.'); window.location='data_gallery.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data ke database.'); history.back();</script>";
    }

} else {
    echo "<script>alert('Gagal mengupload gambar.'); history.back();</script>";
}
?>
