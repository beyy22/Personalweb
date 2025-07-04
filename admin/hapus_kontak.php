<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['username'])) {
  header('location:login.php');
  exit;
}

$id = $_GET['id_kontak'];
$sql = "DELETE FROM tbl_kontak WHERE id_kontak = '$id'";
$query = mysqli_query($db, $sql);

if ($query) {
  echo "<script>alert('Pesan berhasil dihapus.'); window.location='data_kontak.php';</script>";
} else {
  echo "<script>alert('Gagal menghapus pesan.'); history.back();</script>";
}
?>
