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
  <title>Kelola Artikel</title>
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
    <h1 class="text-3xl font-bold">// HALAMAN ADMIN //</h1>
  </header>

  <div class="flex max-w-7xl mx-auto mt-8 px-4">
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
      <div class="flex justify-between items-center mb-6">
        <div>
          <h2 class="text-2xl font-bold text-gray-800">Daftar Artikel</h2>
          <p class="text-gray-600 text-sm">Total artikel: <?= mysqli_num_rows(mysqli_query($db, "SELECT * FROM tbl_artikel")) ?></p>
        </div>
        <a href="add_artikel.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition flex items-center">
          <i class="fas fa-plus mr-2"></i> Tambah Artikel
        </a>
      </div>

      <!-- Fitur Pencarian -->
      <div class="mb-6">
        <form action="" method="get" class="flex">
          <input type="text" name="search" placeholder="Cari artikel..." 
                 value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>"
                 class="w-full px-4 py-2 border rounded-l focus:outline-none focus:ring focus:border-blue-500">
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r hover:bg-blue-700">
            <i class="fas fa-search"></i>
          </button>
        </form>
      </div>

      <!-- Tabel Artikel -->
      <?php
      $search = isset($_GET['search']) ? mysqli_real_escape_string($db, $_GET['search']) : '';
      $where = $search ? "WHERE nama_artikel LIKE '%$search%' OR isi_artikel LIKE '%$search%'" : '';
      
      $sql = "SELECT * FROM tbl_artikel $where ORDER BY id_artikel DESC";
      $query = mysqli_query($db, $sql);
      
      if (mysqli_num_rows($query) > 0): ?>
        <div class="overflow-x-auto">
          <table class="min-w-full table-auto border border-gray-300 text-sm">
            <thead class="bg-blue-600 text-white">
              <tr>
                <th class="p-3 border">No</th>
                <th class="p-3 border">Gambar</th>
                <th class="p-3 border">Judul Artikel</th>
                <th class="p-3 border">Tanggal</th>
                <th class="p-3 border">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              while ($data = mysqli_fetch_array($query)): 
                $gambar = !empty($data['gambar']) ? "../uploads/" . htmlspecialchars($data['gambar']) : '';
              ?>
                <tr class='even:bg-gray-50 hover:bg-blue-50 article-card'>
                  <td class='border p-2 text-center'><?= $no++ ?></td>
                  <td class='border p-2 text-center'>
                    <?php if ($gambar && file_exists($gambar)): ?>
                      <img src="<?= $gambar ?>" alt="Gambar Artikel" class='w-16 h-16 object-cover mx-auto rounded'>
                    <?php else: ?>
                      <div class="w-16 h-16 bg-gray-200 border-2 border-dashed rounded flex items-center justify-center mx-auto">
                        <i class="fas fa-image text-gray-400"></i>
                      </div>
                    <?php endif; ?>
                  </td>
                  <td class='border p-2'>
                    <div class="font-semibold"><?= htmlspecialchars($data['nama_artikel']) ?></div>
                    <div class="text-xs text-gray-500 mt-1 truncate max-w-xs">
                      <?= htmlspecialchars(substr($data['isi_artikel'], 0, 100)) ?>...
                    </div>
                  </td>
                  <td class='border p-2'><?= date('d M Y', strtotime($data['tanggal'])) ?></td>
                  <td class='border p-2 text-center space-x-2'>
                    <a href='edit_artikel.php?id_artikel=<?= $data['id_artikel'] ?>' 
                       class='text-blue-600 hover:text-blue-800 hover:underline flex items-center justify-center'
                       title="Edit">
                      <i class="fas fa-edit mr-1"></i>
                    </a>
                    <a href='delete_artikel.php?id_artikel=<?= $data['id_artikel'] ?>' 
                       onclick='return confirm("Yakin ingin menghapus artikel ini?")'
                       class='text-red-600 hover:text-red-800 hover:underline flex items-center justify-center'
                       title="Hapus">
                      <i class="fas fa-trash-alt mr-1"></i>
                    </a>
                    <a href='../detail_artikel.php?id=<?= $data['id_artikel'] ?>' 
                       target='_blank'
                       class='text-green-600 hover:text-green-800 hover:underline flex items-center justify-center'
                       title="Lihat">
                      <i class="fas fa-eye mr-1"></i>
                    </a>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4">
          <p><i class="fas fa-exclamation-circle mr-2"></i> Tidak ada artikel ditemukan.</p>
        </div>
      <?php endif; ?>

      <!-- Pagination -->
      <?php
      $per_page = 10;
      $total_rows = mysqli_num_rows(mysqli_query($db, "SELECT * FROM tbl_artikel $where"));
      $total_pages = ceil($total_rows / $per_page);
      $current_page = isset($_GET['page']) ? max(1, min($total_pages, intval($_GET['page']))) : 1;
      
      if ($total_pages > 1): ?>
        <div class="mt-8 flex justify-center">
          <nav class="flex items-center space-x-1">
            <?php if ($current_page > 1): ?>
              <a href="?search=<?= urlencode($search) ?>&page=<?= $current_page - 1 ?>" 
                 class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">
                <i class="fas fa-chevron-left"></i>
              </a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
              <a href="?search=<?= urlencode($search) ?>&page=<?= $i ?>" 
                 class="px-3 py-1 rounded <?= $i == $current_page ? 'bg-blue-600 text-white' : 'bg-gray-200 hover:bg-gray-300' ?>">
                <?= $i ?>
              </a>
            <?php endfor; ?>

            <?php if ($current_page < $total_pages): ?>
              <a href="?search=<?= urlencode($search) ?>&page=<?= $current_page + 1 ?>" 
                 class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">
                <i class="fas fa-chevron-right"></i>
              </a>
            <?php endif; ?>
          </nav>
        </div>
      <?php endif; ?>
    </main>
  </div>

  <!-- Footer -->
  <footer class="bg-blue-800 text-white text-center py-4 mt-10">
    &copy; <?php echo date('Y'); ?> | Created by Faisal Mahfuzh Afrizal
  </footer>
</body>
</html>