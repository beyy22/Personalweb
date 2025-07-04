<?php
include "../koneksi.php";
session_start();

if (!isset($_SESSION['username']) || $_SESSION['level'] !== 'admin') {
  header("Location: login.php");
  exit;
}

$id = $_GET['id'];
$status = $_GET['status'];

// Validasi nilai status
$allowed = ['dibaca', 'dibalas'];
if (in_array($status, $allowed)) {
  mysqli_query($db, "UPDATE tbl_kontak SET status = '$status' WHERE id_kontak = '$id'");
}

header("Location: data_kontak.php");
?>
