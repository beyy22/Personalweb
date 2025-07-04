<?php
include "koneksi.php";
session_start();

if (isset($_POST['submit'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = md5($_POST['password']);
  $level = $_POST['level'];
  $token_input = $_POST['token'] ?? '';

  // Token valid khusus untuk admin
  $token_admin = "adminsuper2025"; // ganti sesuai keinginan

  // Validasi token jika daftar sebagai admin
  if ($level === 'admin' && $token_input !== $token_admin) {
    $error = "Token admin salah atau kosong!";
  } else {
    $cek = mysqli_query($db, "SELECT * FROM tbl_user WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
      $error = "Username sudah digunakan!";
    } else {
      mysqli_query($db, "INSERT INTO tbl_user (username, password, level) VALUES ('$username', '$password', '$level')");
      header("Location: admin/login.php?register=sukses");
      exit;
    }
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Akun</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function toggleToken() {
      const level = document.querySelector('input[name="level"]:checked').value;
      const tokenDiv = document.getElementById('token-section');
      tokenDiv.style.display = (level === 'admin') ? 'block' : 'none';
    }
  </script>
</head>
<body class="bg-gray-100 p-8 font-sans">
  <div class="max-w-md mx-auto bg-white shadow p-6 rounded">
    <h2 class="text-xl font-bold mb-4 text-center">📝 Form Pendaftaran</h2>

    <?php if (isset($error)): ?>
      <div class="bg-red-100 border border-red-400 text-red-700 p-2 mb-4 rounded"><?= $error ?></div>
    <?php endif; ?>

    <form method="post" class="space-y-4">
      <div>
        <label class="block mb-1 font-medium">Username</label>
        <input type="text" name="username" required class="w-full border rounded p-2">
      </div>

      <div>
        <label class="block mb-1 font-medium">Password</label>
        <input type="password" name="password" required class="w-full border rounded p-2">
      </div>

      <div>
        <label class="block mb-1 font-medium">Daftar Sebagai:</label>
        <div class="flex gap-4 mt-1">
          <label><input type="radio" name="level" value="user" checked onclick="toggleToken()"> User</label>
          <label><input type="radio" name="level" value="admin" onclick="toggleToken()"> Admin</label>
        </div>
      </div>

      <div id="token-section" style="display: none;">
        <label class="block mb-1 font-medium mt-3">Token Admin</label>
        <input type="text" name="token" class="w-full border rounded p-2">
      </div>

      <div class="text-right">
        <button name="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800">
          Daftar
        </button>
      </div>
    </form>

    <p class="text-sm text-center mt-4">
      Sudah punya akun? <a href="admin/login.php" class="text-blue-600 hover:underline">Login di sini</a>
    </p>
  </div>
</body>
</html>
