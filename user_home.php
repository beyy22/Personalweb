<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['level'] != 'user') {
  header("Location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard User</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen text-gray-800">

  <!-- Header/Navbar -->
  <header class="bg-blue-700 text-white shadow-lg">
    <div class="max-w-6xl mx-auto p-4 flex justify-between items-center">
      <div class="flex items-center space-x-2">
        <i class="fas fa-user-circle text-2xl"></i>
        <h1 class="text-xl font-bold">Selamat Datang, <?= htmlspecialchars($_SESSION['username']); ?></h1>
      </div>
      <div class="flex items-center space-x-4">
        <span class="bg-blue-600 px-3 py-1 rounded-full text-sm"><?= ucfirst($_SESSION['level']); ?></span>
        <a href="admin/logout.php" class="hover:text-blue-200 transition" 
           onclick="return confirm('Yakin ingin logout?')">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="max-w-6xl mx-auto mt-8 p-4">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
      <!-- Welcome Card -->
      <div class="bg-gradient-to-r from-blue-600 to-blue-800 p-6 text-white">
        <div class="flex items-center justify-between">
          <div>
            <h2 class="text-2xl font-bold">Halo, <?= htmlspecialchars($_SESSION['username']); ?>!</h2>
            <p class="mt-2">Selamat datang di dashboard pengguna</p>
          </div>
          <i class="fas fa-user-circle text-6xl opacity-20"></i>
        </div>
      </div>

      <!-- Menu Grid -->
      <div class="p-6">
        <h3 class="text-xl font-semibold mb-6 text-gray-700">
          <i class="fas fa-th-list mr-2 text-blue-600"></i>Menu Utama
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Kirim Pesan -->
          <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition-all duration-300 hover:border-blue-300">
            <div class="flex items-start">
              <div class="bg-blue-100 p-3 rounded-full mr-4">
                <i class="fas fa-comment-dots text-blue-600 text-xl"></i>
              </div>
              <div>
                <h4 class="font-semibold text-lg mb-2">Kirim Pesan</h4>
                <p class="text-gray-600 text-sm mb-3">Hubungi admin melalui form kontak kami</p>
                <a href="kontak.php" class="inline-flex items-center text-blue-600 hover:text-blue-800 transition">
                  <span>Kirim Sekarang</span>
                  <i class="fas fa-chevron-right ml-2 text-sm"></i>
                </a>
              </div>
            </div>
          </div>

          <!-- Riwayat Pesan -->
          <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition-all duration-300 hover:border-green-300">
            <div class="flex items-start">
              <div class="bg-green-100 p-3 rounded-full mr-4">
                <i class="fas fa-history text-green-600 text-xl"></i>
              </div>
              <div>
                <h4 class="font-semibold text-lg mb-2">Riwayat Pesan</h4>
                <p class="text-gray-600 text-sm mb-3">Lihat pesan yang pernah Anda kirimkan</p>
                <a href="riwayat_pesan_user.php" class="inline-flex items-center text-green-600 hover:text-green-800 transition">
                  <span>Lihat Riwayat</span>
                  <i class="fas fa-chevron-right ml-2 text-sm"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Info Tambahan -->
      <div class="border-t border-gray-200 p-6 bg-gray-50">
        <h3 class="text-lg font-semibold mb-4 text-gray-700">
          <i class="fas fa-info-circle mr-2 text-blue-600"></i>Informasi Terbaru
        </h3>
        <div class="bg-blue-50 border border-blue-100 rounded-lg p-4">
          <p class="text-sm text-gray-700">
            <i class="fas fa-bell text-yellow-500 mr-2"></i>
            Sistem akan melakukan maintenance pada Jumat, 15 Juli 2023 pukul 23:00 - 01:00 WIB.
          </p>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white py-6 mt-10">
    <div class="max-w-6xl mx-auto px-4">
      <div class="flex flex-col md:flex-row justify-between items-center">
        <div class="mb-4 md:mb-0">
          <h3 class="text-lg font-semibold">Sistem Informasi User</h3>
          <p class="text-sm text-gray-400 mt-1">© <?= date('Y'); ?> All Rights Reserved</p>
        </div>
        <div class="flex space-x-4">
          <a href="#" class="hover:text-blue-300 transition"><i class="fab fa-facebook"></i></a>
          <a href="#" class="hover:text-blue-400 transition"><i class="fab fa-twitter"></i></a>
          <a href="#" class="hover:text-red-400 transition"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
    </div>
  </footer>

</body>
</html>