<?php
session_start();
include('../koneksi.php');
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Pesan Kontak</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<!-- Header -->
  <header class="bg-blue-900 text-white text-center py-6 shadow">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <h1 class="text-3xl font-bold">// HALAMAN ADMIN //</h1>
  </header>

<!-- Container -->
<div class="flex max-w-7xl mx-auto mt-10 gap-6">

  <!-- ✅ SIDEBAR -->
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

  <!-- ✅ KONTEN UTAMA -->
  <main class="w-3/4 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4 text-blue-800">Data Pesan Kontak</h1>

    <!-- Tombol Export PDF di konten utama -->
    <a href="export_kontak.php" target="_blank"
       class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded mb-4">
      📄 Export PDF
    </a>

    <!-- Tabel Data Kontak -->
    <div class="overflow-x-auto">
      <table class="w-full text-sm border">
  <thead class="bg-gray-200">
    <tr>
      <th class="border px-2 py-1">No</th>
      <th class="border px-2 py-1">Nama</th>
      <th class="border px-2 py-1">Email</th>
      <th class="border px-2 py-1">Pesan</th>
      <th class="border px-2 py-1">Tanggal</th>
      <th class="border px-2 py-1">Status</th>
      <th class="border px-2 py-1">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    $query = mysqli_query($db, "SELECT * FROM tbl_kontak ORDER BY tanggal DESC");
    while ($data = mysqli_fetch_assoc($query)) {
      echo "<tr class='even:bg-gray-50'>";
      echo "<td class='border px-2 py-1 text-center'>{$no}</td>";
      echo "<td class='border px-2 py-1'>{$data['nama']}</td>";
      echo "<td class='border px-2 py-1'>{$data['email']}</td>";
      echo "<td class='border px-2 py-1'>{$data['pesan']}</td>";
      echo "<td class='border px-2 py-1'>" . date('d-m-Y H:i', strtotime($data['tanggal'])) . "</td>";
      echo "<td class='border px-2 py-1 capitalize text-blue-700 font-semibold text-center'>{$data['status']}</td>";
      echo "<td class='border px-2 py-1 text-center'>
              <a href='ubah_status.php?id={$data['id_kontak']}&status=dibaca' class='text-green-600 text-xs mr-2 hover:underline'>Dibaca</a>
              <a href='ubah_status.php?id={$data['id_kontak']}&status=dibalas' class='text-blue-600 text-xs hover:underline'>Dibalas</a>
              <a href='balas_pesan.php?id={$data['id_kontak']}' class='text-yellow-600 text-xs hover:underline'>Balas</a>
            </td>";
      echo "</tr>";
      $no++;
    }
    ?>
  </tbody>
</table>
    </div>
  </main>
</div>

</body>
</html>
