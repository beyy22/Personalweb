<?php 
include('../koneksi.php'); 
session_start();
if (!isset($_SESSION['username'])) { 
    header('location:login.php'); 
    exit; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Gambar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .article-card {
      transition: all 0.3s ease;
    }
    .article-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body class="bg-gray-100 min-h-screen">

<!-- Header -->
<header class="bg-blue-900 text-white text-center py-6 shadow">
    <h1 class="text-3xl font-bold">Tambah Gambar ke Gallery</h1>
</header>

<div class="flex max-w-7xl mx-auto mt-8 px-4">

    <!-- Sidebar -->
    <aside class="w-full md:w-1/4 bg-white rounded-lg shadow-md p-4 text-gray-700 sidebar">
      <h2 class="text-lg font-bold text-blue-700 mb-4 flex items-center">
        <i class="fas fa-bars mr-2"></i> MENU UTAMA
      </h2>
      <ul class="space-y-2">
        <li>
          <a href="beranda_login.php" class="flex items-center px-3 py-2 rounded-md hover:bg-blue-100 hover:text-blue-700 font-medium">
            <i class="fas fa-home mr-2 w-5 text-blue-600"></i> Beranda
          </a>
        </li>
        <li>
          <a href="data_artikel.php" class="flex items-center px-3 py-2 rounded-md hover:bg-blue-100 hover:text-blue-700 bg-blue-100 text-blue-700">
            <i class="fas fa-newspaper mr-2 w-5 text-blue-600"></i> Kelola Artikel
          </a>
        </li>
        <li>
          <a href="data_gallery.php" class="flex items-center px-3 py-2 rounded-md hover:bg-blue-100 hover:text-blue-700">
            <i class="fas fa-images mr-2 w-5 text-blue-600"></i> Kelola Gallery
          </a>
        </li>
        <li>
          <a href="data_about.php" class="flex items-center px-3 py-2 rounded-md hover:bg-blue-100 hover:text-blue-700">
            <i class="fas fa-user-circle mr-2 w-5 text-blue-600"></i> About
          </a>
        </li>
        <li>
          <a href="data_kontak.php" class="flex items-center px-3 py-2 rounded-md hover:bg-blue-100 hover:text-blue-700">
            <i class="fas fa-envelope mr-2 w-5 text-blue-600"></i> Pesan Kontak
          </a>
        </li>
        <li>
          <a href="data_kontak.php" class="flex items-center px-3 py-2 rounded-md hover:bg-blue-100 hover:text-blue-700">
            <i class="fas fa-users mr-2 w-5 text-blue-600"></i> Kelola User
          </a>
        </li>
        <li>
          <a href="logout.php" onclick="return confirm('Yakin ingin logout?');" class="flex items-center px-3 py-2 rounded-md text-red-600 hover:bg-red-100 hover:text-red-700">
            <i class="fas fa-sign-out-alt mr-2 w-5"></i> Logout
          </a>
        </li>
      </ul>
    </aside>

    <!-- Main Content -->
    <main class="w-3/4 bg-white rounded shadow p-6 ml-6">
        <form action="proses_add_gallery.php" method="post" enctype="multipart/form-data" class="space-y-6">
            <div>
                <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Gambar</label>
                <input type="text" id="judul" name="judul" required
                       class="w-full p-2 border rounded focus:outline-none focus:ring focus:border-blue-500">
            </div>
            <div>
                <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Pilih Gambar</label>
                <input type="file" id="foto" name="foto" accept="image/*" required
                       class="block w-full text-sm text-gray-600 file:mr-4 file:py-2
                       file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold
                       file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200">
            </div>
            <div class="flex justify-end space-x-4">
                <button type="submit"
                        class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800 transition">Simpan</button>
                <a href="data_gallery.php"
                   class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 transition">Batal</a>
            </div>
        </form>
    </main>
</div>

<!-- Footer -->
<footer class="bg-blue-800 text-white text-center py-4 mt-10">
    &copy; <?php echo date('Y'); ?> | Created by Faisal Mahfuzh
</footer>

</body>
</html>
