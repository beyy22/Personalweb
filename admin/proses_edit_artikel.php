<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['username'])) {
  header('location:login.php');
  exit;
}

// Tangkap data form
$id = intval($_POST['id_artikel']);
$judul = mysqli_real_escape_string($db, $_POST['nama_artikel']);
$isi   = mysqli_real_escape_string($db, $_POST['isi_artikel']);
$tanggal = mysqli_real_escape_string($db, $_POST['tanggal']);

// Handle upload gambar baru
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
        
        // Hapus gambar lama jika ada
        $sql_old = "SELECT gambar FROM tbl_artikel WHERE id_artikel = $id";
        $result = mysqli_query($db, $sql_old);
        $old_data = mysqli_fetch_assoc($result);
        if ($old_data['gambar'] && file_exists("../uploads/{$old_data['gambar']}")) {
            unlink("../uploads/{$old_data['gambar']}");
        }
    } else {
        echo "<script>alert('Ekstensi file tidak diizinkan. Hanya JPG, PNG, GIF yang diperbolehkan.'); history.back();</script>";
        exit;
    }
}

// Query update
if ($gambar) {
    $sql = "UPDATE tbl_artikel SET 
            nama_artikel = '$judul', 
            isi_artikel = '$isi', 
            gambar = '$gambar',
            tanggal = '$tanggal'
            WHERE id_artikel = $id";
} else {
    $sql = "UPDATE tbl_artikel SET 
            nama_artikel = '$judul', 
            isi_artikel = '$isi',
            tanggal = '$tanggal'
            WHERE id_artikel = $id";
}

$query = mysqli_query($db, $sql);

if ($query) {
  echo "<script>alert('Artikel berhasil diperbarui.'); window.location='data_artikel.php';</script>";
} else {
  echo "<script>alert('Gagal memperbarui artikel: " . mysqli_error($db) . "'); history.back();</script>";
}
?>