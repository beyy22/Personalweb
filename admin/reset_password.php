<?php
include "../koneksi.php"; // atau "koneksi.php" jika file ini sejajar
session_start();

if (isset($_POST['reset'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $new_pass = md5($_POST['password']);

  // Cek username
  $cek = mysqli_query($db, "SELECT * FROM tbl_user WHERE username='$username'");
  if (mysqli_num_rows($cek) > 0) {
    mysqli_query($db, "UPDATE tbl_user SET password='$new_pass' WHERE username='$username'");
    $sukses = true;
  } else {
    $error = "Username tidak ditemukan!";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Reset Password</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-blue-50">
  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-sm">
    <h2 class="text-xl font-bold text-blue-700 mb-4 text-center">🔐 Reset Password</h2>

    <?php if (isset($sukses)): ?>
      <p class="text-green-600 text-center mb-4">Password berhasil diubah. <a href="login.php" class="underline text-blue-700">Login</a></p>
    <?php elseif (isset($error)): ?>
      <p class="text-red-600 text-center mb-4"><?= $error ?></p>
    <?php endif; ?>

    <form method="post" class="space-y-4">
      <div>
        <label class="text-sm font-medium text-gray-700">Username</label>
        <input type="text" name="username" required class="w-full border px-3 py-2 rounded">
      </div>
      <div>
        <label class="text-sm font-medium text-gray-700">Password Baru</label>
        <input type="password" name="password" required class="w-full border px-3 py-2 rounded">
      </div>
      <button name="reset" class="w-full bg-blue-700 text-white py-2 rounded hover:bg-blue-800">Reset Password</button>
    </form>
  </div>
</body>
</html>

