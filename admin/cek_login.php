<?php
include('../koneksi.php');
session_start();

// Validasi input kosong
if (empty($_POST['username']) || empty($_POST['password'])) {
  echo "<script>
    alert('Username dan password tidak boleh kosong!');
    window.location = 'login.php';
  </script>";
  exit;
}

$username = mysqli_real_escape_string($db, $_POST['username']);
$password = md5($_POST['password']); // Sesuaikan dengan hash yang kamu pakai di database

$sql = "SELECT * FROM tbl_user WHERE username='$username' AND password='$password'";
$query = mysqli_query($db, $sql);
$data = mysqli_fetch_assoc($query);

if ($data) {
  $_SESSION['username'] = $data['username'];
  $_SESSION['level'] = $data['level'];

  if ($data['level'] == 'admin') {
    header("Location: beranda_login.php");
  } else if ($data['level'] == 'user') {
    header("Location: ../user_home.php");
  }
  exit;
} else {
  echo "<script>
    alert('Login gagal! Username atau password salah.');
    window.location = 'login.php';
  </script>";
}
?>
