<?php
session_start();
if (isset($_SESSION['login'])) {
  header("Location: beranda_login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login | Personal Web</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-image: url('../images/bg.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    }

    .login-box {
      background: rgba(255, 255, 255, 0.25);
      backdrop-filter: blur(14px);
      border: 1px solid rgba(255, 255, 255, 0.3);
    }

    input, button {
      box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
      transition: all 0.2s ease-in-out;
    }

    input:focus {
      border-color: #38bdf8; /* sky-400 */
      box-shadow: 0 0 0 2px rgba(56, 189, 248, 0.3);
    }

    button:hover {
      background-color: #0284c7; /* sky-600 */
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4">

  <div class="login-box max-w-md w-full p-8 rounded-xl shadow-2xl text-white space-y-6">
    <div class="text-center">
      <img src="../images/branding.png" alt="User Icon" class="w-16 h-16 mx-auto mb-2 rounded-full bg-white p-1">
      <h2 class="text-2xl font-bold text-white">Login Akun</h2>
      <p class="text-sm text-white">Masuk sebagai Admin / User</p>
    </div>

    <form action="cek_login.php" method="POST" class="space-y-4 text-left">
      <div>
        <label class="block text-sm text-white mb-1">Username</label>
        <input type="text" name="username" required class="w-full px-4 py-2 border rounded bg-white text-gray-900 focus:outline-none" />
      </div>
      <div>
        <label class="block text-sm text-white mb-1">Password</label>
        <input type="password" name="password" required class="w-full px-4 py-2 border rounded bg-white text-gray-900 focus:outline-none" />
      </div>
      <button type="submit" class="w-full bg-sky-600 hover:bg-sky-700 text-white font-semibold py-2 px-4 rounded">Masuk</button>
    </form>
    <div class="text-sm text-center mt-3">
      <a href="../register.php" class="text-blue-200 hover:underline">Daftar di sini</a> ·
      <a href="../reset_password.php" class="text-blue-200 hover:underline">Lupa password?</a>
      <a href="../index.php" class="inline-block mt-2 text-sm text-gray-700 hover:text-blue-600 hover:underline">
          ⬅️ Kembali ke Halaman Utama
    </div>
  </div>
  

  <?php if (isset($_GET['msg']) && $_GET['msg'] == 'daftar_berhasil'): ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Pendaftaran Berhasil!',
        text: 'Silakan login dengan akun yang baru.',
        timer: 3000,
        showConfirmButton: false
      });
    </script>
  <?php endif; ?>
</body>
</html>
