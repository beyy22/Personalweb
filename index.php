<?php
include "koneksi.php";

// Konfigurasi pagination
$per_page = 4;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;

// Proses pencarian
$keyword = '';
$where = '1';
if (isset($_GET['search'])) {
    $keyword = mysqli_real_escape_string($db, $_GET['search']);
    $where = "nama_artikel LIKE '%$keyword%' OR isi_artikel LIKE '%$keyword%'";
}

// Hitung total halaman
$count_sql = "SELECT COUNT(*) as total FROM tbl_artikel WHERE $where";
$count_result = mysqli_query($db, $count_sql);
$total_rows = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_rows / $per_page);

// Validasi nomor halaman
$page = max(1, min($page, $total_pages));
$offset = ($page - 1) * $per_page;

// Query artikel
$sql = "SELECT * FROM tbl_artikel WHERE $where ORDER BY id_artikel DESC LIMIT $per_page OFFSET $offset";
$query = mysqli_query($db, $sql);
if (!$query) {
    die("Query error: " . mysqli_error($db));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Personal Web | Home</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script>
    tailwind.config = {
      darkMode: 'class',
    };
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const isDark = localStorage.getItem('darkMode') === 'enabled';
      if (isDark) document.documentElement.classList.add('dark');
      document.getElementById('darkModeBtn').textContent = isDark ? '☀️ Light Mode' : '🌙 Dark Mode';
    });
    function toggleDarkMode() {
      const isDark = document.documentElement.classList.toggle('dark');
      localStorage.setItem('darkMode', isDark ? 'enabled' : 'disabled');
      document.getElementById('darkModeBtn').textContent = isDark ? '☀️ Light Mode' : '🌙 Dark Mode';
    }
  </script>
  <style>
    article {
      transition: transform 0.3s, box-shadow 0.3s;
    }
    article:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100 font-sans transition-colors duration-300">
  <!-- Loading Overlay -->
  <div id="loading" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-blue-500"></div>
  </div>

  <div class="fixed top-4 right-4 z-50">
    <button onclick="toggleDarkMode()" id="darkModeBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition-colors duration-300">
      🌙 Dark Mode
    </button>
  </div>
  
  <header class="bg-blue-900 dark:bg-gray-800 text-white text-center p-6 text-2xl font-bold">
    Personal Web | Faisal Mahfuzh
  </header>
  
  <nav class="bg-blue-700 dark:bg-gray-700 text-white py-3 shadow-sm sticky top-0 z-40">
    <ul class="flex justify-center space-x-10 font-medium text-lg">
      <li><a href="index.php" class="hover:underline"><i class="fas fa-newspaper mr-2"></i>Artikel</a></li>
      <li><a href="gallery.php" class="hover:underline"><i class="fas fa-image mr-2"></i>Gallery</a></li>
      <li><a href="about.php" class="hover:underline"><i class="fas fa-user mr-2"></i>About</a></li>
      <li><a href="kontak.php" class="hover:underline"><i class="fas fa-address-book mr-2"></i>Kontak</a></li>
      <li><a href="admin/login.php" class="hover:underline"><i class="fas fa-sign-in-alt mr-2"></i>Login</a></li>
    </ul>
  </nav>
  
  <div class="p-6 flex justify-center">
    <form action="" method="get" class="w-full max-w-xl flex gap-2" id="searchForm">
      <input type="text" name="search" placeholder="Cari artikel..." value="<?= htmlspecialchars($keyword) ?>" 
             class="w-full px-4 py-2 rounded border dark:bg-gray-800 dark:text-white">
      <button type="submit" class="bg-blue-600 dark:bg-gray-800 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Cari
      </button>
    </form>
  </div>
  
  <!-- Info Hasil Pencarian -->
  <?php if($keyword): ?>
    <div class="text-center mb-4">
      <p class="text-gray-600 dark:text-gray-300">
        Hasil pencarian: "<?= htmlspecialchars($keyword) ?>" 
        (<?= $total_rows ?> artikel ditemukan)
      </p>
    </div>
  <?php endif; ?>
  
  <main class="p-6 grid gap-6 max-w-4xl mx-auto">
    <?php if (mysqli_num_rows($query) > 0): ?>
      <?php while ($row = mysqli_fetch_assoc($query)) : ?>
        <article class="bg-white dark:bg-gray-800 rounded shadow p-4">
          <?php if (!empty($row['gambar'])): ?>
            <img src="uploads/<?= htmlspecialchars($row['gambar']) ?>" 
                 alt="<?= htmlspecialchars($row['nama_artikel']) ?>" 
                 class="w-full h-48 object-cover mb-4 rounded-lg">
          <?php else: ?>
            <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-48 mb-4 flex items-center justify-center text-gray-500">
              <i class="fas fa-image text-3xl"></i>
            </div>
          <?php endif; ?>
          
          <h2 class="text-xl font-semibold text-blue-800 dark:text-blue-400">
            <?= htmlspecialchars($row['nama_artikel']) ?>
          </h2>
          
          <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
            <?= date('d M Y', strtotime($row['tanggal'])) ?>
          </div>
          
          <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">
            <?= nl2br(htmlspecialchars(substr($row['isi_artikel'], 0, 200))) ?>...
          </p>
          
          <div class="mt-3">
            <a href="detail_artikel.php?id=<?= $row['id_artikel'] ?>" 
               class="inline-flex items-center text-blue-600 hover:text-blue-800 dark:hover:text-blue-300 transition-colors">
              Baca Selengkapnya <i class="fas fa-arrow-right ml-1 text-xs"></i>
            </a>
          </div>
        </article>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-center text-gray-500 dark:text-gray-400 py-10">Tidak ada artikel ditemukan.</p>
    <?php endif; ?>

    <!-- Pagination -->
    <?php if ($total_pages > 1): ?>
      <nav class="mt-6 flex flex-col items-center">
        <div class="mb-2 text-sm text-gray-500 dark:text-gray-400">
          Halaman <?= $page ?> dari <?= $total_pages ?>
        </div>
        <div class="flex space-x-2">
          <?php if ($page > 1): ?>
            <a href="?search=<?= urlencode($keyword) ?>&page=<?= $page - 1 ?>" 
               class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded hover:bg-gray-300 transition-colors">
              <i class="fas fa-arrow-left"></i>
            </a>
          <?php endif; ?>

          <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?search=<?= urlencode($keyword) ?>&page=<?= $i ?>" 
               class="px-3 py-1 rounded transition-colors <?= $i == $page ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-gray-700 hover:bg-gray-300' ?>">
              <?= $i ?>
            </a>
          <?php endfor; ?>

          <?php if ($page < $total_pages): ?>
            <a href="?search=<?= urlencode($keyword) ?>&page=<?= $page + 1 ?>" 
               class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded hover:bg-gray-300 transition-colors">
              <i class="fas fa-arrow-right"></i>
            </a>
          <?php endif; ?>
        </div>
      </nav>
    <?php endif; ?>
  </main>
  
  <footer class="bg-blue-800 dark:bg-gray-800 text-white text-center py-4 mt-10 shadow-inner">
    &copy; <?php echo date('Y'); ?> | Created by Faisal Mahfuzh
  </footer>

  <script>
    // Loading overlay untuk pencarian
    document.getElementById('searchForm').addEventListener('submit', () => {
      document.getElementById('loading').classList.remove('hidden');
    });
    
    // Sembunyikan loading saat halaman selesai dimuat
    window.addEventListener('load', () => {
      document.getElementById('loading').classList.add('hidden');
    });
  </script>
</body>
</html>