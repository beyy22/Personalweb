<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "../koneksi.php";
session_start();
if (!isset($_SESSION['username']) || $_SESSION['level'] !== 'admin') {
  header("Location: login.php");
  exit;
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM tbl_kontak WHERE id_kontak = '$id'"));

if (isset($_POST['balas'])) {
  $balasan = mysqli_real_escape_string($db, $_POST['balasan']);
  mysqli_query($db, "UPDATE tbl_kontak SET balasan='$balasan', status='dibalas' WHERE id_kontak='$id'");
  header("Location: data_kontak.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Balas Pesan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 p-8">
  <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">✉️ Balas Pesan</h2>
    <p><strong>Dari:</strong> <?= $data['nama'] ?> (<?= $data['email'] ?>)</p>
    <p class="mb-4"><strong>Pesan:</strong><br><?= nl2br($data['pesan']) ?></p>

    <form method="post">
      <label class="block mb-2 font-medium">Balasan:</label>
      <textarea name="balasan" rows="5" required
        class="w-full border rounded p-3 mb-4"><?= $data['balasan'] ?></textarea>
      <div class="text-right">
        <button name="balas" class="bg-blue-700 text-white px-6 py-2 rounded hover:bg-blue-800">Kirim Balasan</button>
      </div>
    </form>
  </div>
</body>
</html>
