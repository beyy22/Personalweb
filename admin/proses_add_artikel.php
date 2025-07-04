<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['username'])) {
  header('location:login.php');
  exit;
}

// Tangkap data form
$judul = mysqli_real_escape_string($db, $_POST['nama_artikel']);
$isi   = mysqli_real_escape_string($db, $_POST['isi_artikel']);
$tanggal = mysqli_real_escape_string($db, $_POST['tanggal']);

// Handle upload gambar
$gambar = '';
if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['gambar'];
    
    // Validasi ekstensi file
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
    if (in_array($ext, $allowed)) {
        // Generate nama file unik
        $gambar = uniqid('img_', true) . '.' . $ext;
        $target_path = "../uploads/" . $gambar;
        
        if (!move_uploaded_file($file['tmp_name'], $target_path)) {
            echo "<script>alert('Gagal mengupload gambar.'); history.back();</script>";
            exit;
        }
    } else {
        echo "<script>alert('Ekstensi file tidak diizinkan. Hanya JPG, PNG, GIF yang diperbolehkan.'); history.back();</script>";
        exit;
    }
}

// Query insert dengan gambar
$sql = "INSERT INTO tbl_artikel (nama_artikel, isi_artikel, gambar, tanggal) 
        VALUES ('$judul', '$isi', '$gambar', '$tanggal')";
$query = mysqli_query($db, $sql);

if ($query) {
  echo "<script>alert('Artikel berhasil ditambahkan.'); window.location='data_artikel.php';</script>";
} else {
  echo "<script>alert('Gagal menambahkan artikel: " . mysqli_error($db) . "'); history.back();</script>";
}
?>