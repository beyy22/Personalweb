<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['username'])) {
  header('location:login.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Data About</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen">

  <!-- Header -->
  <header class="bg-blue-900 text-white text-center py-6 shadow">
    <h1 class="text-3xl font-bold">Kelola Data About</h1>
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
                <a href="data_artikel.php" class="flex items-center px-3 py-2 rounded-md hover:bg-blue-100 hover:text-blue-700">
                    <i class="fas fa-newspaper mr-2 w-5 text-blue-600"></i> Kelola Artikel
                </a>
            </li>
            <li>
                <a href="data_gallery.php" class="flex items-center px-3 py-2 rounded-md hover:bg-blue-100 hover:text-blue-700">
                    <i class="fas fa-images mr-2 w-5 text-blue-600"></i> Kelola Gallery
                </a>
            </li>
            <li>
                <a href="data_about.php" class="flex items-center px-3 py-2 rounded-md bg-blue-100 text-blue-700">
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
    <main class="w-full md:w-3/4 bg-white rounded shadow p-6 ml-6">
      <div class="flex justify-between items-center mb-6">
        <div>
          <h2 class="text-2xl font-bold text-gray-800">Tentang Saya</h2>
          <p class="text-gray-600 text-sm">Deskripsi singkat tentang diri Anda</p>
        </div>
        <a href="add_about.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition flex items-center">
          <i class="fas fa-plus mr-2"></i> Tambah Data
        </a>
      </div>

      <div class="space-y-4">
        <?php
        $sql = "SELECT * FROM tbl_about ORDER BY id_about DESC";
        $query = mysqli_query($db, $sql);
        
        if (mysqli_num_rows($query) > 0) {
          while ($data = mysqli_fetch_array($query)) {
            echo "<div class='p-6 bg-white border border-gray-200 rounded-lg shadow hover:shadow-md transition duration-300'>";
            echo "<div class='prose prose-lg max-w-none mb-4'>";
            echo nl2br(htmlspecialchars($data['about']));
            echo "</div>";
            echo "<div class='flex space-x-4 text-sm'>";
            echo "<a href='edit_about.php?id_about={$data['id_about']}' class='text-blue-600 hover:text-blue-800 hover:underline flex items-center'>";
            echo "<i class='fas fa-edit mr-1'></i> Edit";
            echo "</a>";
            echo "<a href='delete_about.php?id_about={$data['id_about']}' onclick='return confirm(\"Yakin ingin menghapus?\")' class='text-red-600 hover:text-red-800 hover:underline flex items-center'>";
            echo "<i class='fas fa-trash-alt mr-1'></i> Hapus";
            echo "</a>";
            echo "</div></div>";
          }
        } else {
          echo "<div class='text-center py-10'>";
          echo "<div class='bg-gray-200 border-2 border-dashed rounded-xl w-24 h-24 flex items-center justify-center mx-auto text-gray-500'>";
          echo "<i class='fas fa-user text-3xl'></i>";
          echo "</div>";
          echo "<p class='mt-4 text-gray-600'>Belum ada data about</p>";
          echo "</div>";
        }
        ?>
      </div>
    </main>
  </div>

  <!-- Footer -->
  <footer class="bg-blue-800 text-white text-center py-4 mt-10">
    &copy; <?php echo date('Y'); ?> | Created by Faisal Mahfuzh
  </footer>
</body>
</html>