<?php
include "koneksi.php";
session_start();

// Ambil data dari form
$nama   = mysqli_real_escape_string($db, $_POST['nama']);
$email  = mysqli_real_escape_string($db, $_POST['email']);
$pesan  = mysqli_real_escape_string($db, $_POST['pesan']);
$tanggal = date("Y-m-d H:i:s");

// Simpan ke database
$sql = "INSERT INTO tbl_kontak (nama, email, pesan, tanggal) 
        VALUES ('$nama', '$email', '$pesan', '$tanggal')";
$query = mysqli_query($db, $sql);

// Redirect atau beri pesan
if ($query) {
  echo "<script>window.location='kontak.php?status=sukses';</script>";
} else {
  echo "<script>alert('Gagal mengirim pesan!'); history.back();</script>";
}
?>
