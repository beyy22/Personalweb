<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit;
}

// Ambil data dari form
$id_about = $_POST['id_about'];
$about = mysqli_real_escape_string($db, $_POST['about']);

// Update ke database
$sql = "UPDATE tbl_about SET about = '$about' WHERE id_about = '$id_about'";
$query = mysqli_query($db, $sql);

if ($query) {
    echo "<script>alert('Data berhasil diperbarui.'); window.location='data_about.php';</script>";
} else {
    echo "<script>alert('Gagal memperbarui data.'); history.back();</script>";
}
?>
