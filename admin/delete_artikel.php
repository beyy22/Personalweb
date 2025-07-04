<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['username'])) {
  header('location:login.php');
  exit;
}

if (isset($_GET['id_artikel']) && is_numeric($_GET['id_artikel'])) {
    $id = intval($_GET['id_artikel']);
    
    // Ambil data gambar
    $sql_img = "SELECT gambar FROM tbl_artikel WHERE id_artikel = $id";
    $result_img = mysqli_query($db, $sql_img);
    $data = mysqli_fetch_assoc($result_img);
    
    // Hapus gambar dari server jika ada
    if ($data['gambar'] && file_exists("../uploads/{$data['gambar']}")) {
        unlink("../uploads/{$data['gambar']}");
    }
    
    // Hapus artikel dari database
    $sql = "DELETE FROM tbl_artikel WHERE id_artikel = $id";
    $query = mysqli_query($db, $sql);
    
    if ($query) {
        header('Location: data_artikel.php?status=deleted');
        exit;
    }
}

header('Location: data_artikel.php?error=delete_failed');
exit;
?>