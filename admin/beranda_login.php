<?php
require_once("../koneksi.php");
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// QUERY JUMLAH DATA
$jumlah_artikel = mysqli_num_rows(mysqli_query($db, "SELECT id_artikel FROM tbl_artikel"));
$jumlah_gallery = mysqli_num_rows(mysqli_query($db, "SELECT id_gallery FROM tbl_gallery"));
$jumlah_kontak  = mysqli_num_rows(mysqli_query($db, "SELECT id_kontak FROM tbl_kontak"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Beranda Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<!-- Header -->
<header class="bg-blue-900 text-white text-center py-6 shadow">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <h1 class="text-3xl font-bold">// HALAMAN ADMIN //</h1>
</header>

<!-- Main Container -->
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
    <h2 class="text-2xl font-semibold mb-4">Selamat Datang, Admin!</h2>
    <p class="text-gray-700 mb-6">Silakan kelola konten web Anda melalui menu di samping.</p>
    <?php
$pesan_terbaru = mysqli_query($db, "SELECT * FROM tbl_kontak ORDER BY id_kontak DESC LIMIT 5");
?>

<h2 class="text-xl font-semibold mt-10 mb-4 text-gray-800">📬 5 Pesan Terbaru</h2>
<div class="overflow-x-auto">
  <table class="min-w-full text-sm border border-gray-300 bg-white rounded shadow">
    <thead class="bg-gray-100">
      <tr>
        <th class="p-2 border">No</th>
        <th class="p-2 border">Nama</th>
        <th class="p-2 border">Email</th>
        <th class="p-2 border">Pesan</th>
        <th class="p-2 border">Tanggal</th>
        <th class="p-2 border">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      while ($row = mysqli_fetch_assoc($pesan_terbaru)) {
        $id = $row['id_kontak'];
        echo "<tr class='even:bg-gray-50'>";
        echo "<td class='p-2 border text-center'>{$no}</td>";
        echo "<td class='p-2 border'>{$row['nama']}</td>";
        echo "<td class='p-2 border'>{$row['email']}</td>";
        echo "<td class='p-2 border'>" . substr(htmlspecialchars($row['pesan']), 0, 40) . "...</td>";
        echo "<td class='p-2 border text-center'>" . date('d-m-Y', strtotime($row['tanggal'])) . "</td>";
        echo "<td class='p-2 border text-center'>
                <a href='data_kontak.php?id_kontak=$id' class='text-blue-600 hover:underline text-sm'>Lihat</a>
                <a href='hapus_kontak.php?id_kontak=$id' class='text-red-600 hover:underline text-sm' onclick='return confirm(\"Hapus pesan ini?\")'>Hapus</a>
              </td>";
        echo "</tr>";
        $no++;
      }
      ?>
    </tbody>
  </table>
</div>


    <!-- Dashboard Ringkasan -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
      <div class="bg-white shadow rounded p-4 text-center border-t-4 border-blue-600">
        <h3 class="text-xl font-semibold text-blue-700">Jumlah Artikel</h3>
        <p class="text-3xl font-bold text-gray-800"><?php echo $jumlah_artikel; ?></p>
      </div>

      <div class="bg-white shadow rounded p-4 text-center border-t-4 border-green-600">
        <h3 class="text-xl font-semibold text-green-700">Jumlah Gallery</h3>
        <p class="text-3xl font-bold text-gray-800"><?php echo $jumlah_gallery; ?></p>
      </div>

      <div class="bg-white shadow rounded p-4 text-center border-t-4 border-yellow-600">
        <h3 class="text-xl font-semibold text-yellow-700">Pesan Kontak</h3>
        <p class="text-3xl font-bold text-gray-800"><?php echo $jumlah_kontak; ?></p>
      </div>
    </div>
  </main>
</div>

<!-- Footer -->
<footer class="bg-blue-800 text-white text-center py-4 mt-10">
  &copy; <?php echo date("Y"); ?> | Created by Faisal Mahfuzh
</footer>

</body>
</html>
