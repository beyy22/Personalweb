<?php
include "koneksi.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p>Artikel tidak ditemukan.</p>";
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM tbl_artikel WHERE id_artikel = $id";
$query = mysqli_query($db, $sql);

if (!$query || mysqli_num_rows($query) == 0) {
    echo "<p>Artikel tidak tersedia.</p>";
    exit;
}

$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($data['nama_artikel']) ?> | Detail Artikel</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script>
    tailwind.config = {
      darkMode: 'class',
    };
  </script>
  <script>
    // Terapkan preferensi dark mode saat halaman dimuat
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
    .justify-text {
      text-align: justify;
      line-height: 1.8;
    }

    .justify-text::first-letter {
      font-size: 1.8rem;
      font-weight: bold;
      color: #60a5fa;
      float: left;
      margin-right: 8px;
      line-height: 1;
    }
    
    .article-image {
      transition: transform 0.3s ease;
    }
    .article-image:hover {
      transform: scale(1.02);
    }
  </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100 font-sans transition-colors duration-300">
  <!-- Dark Mode Button -->
  <div class="fixed top-4 right-4 z-50">
    <button onclick="toggleDarkMode()" id="darkModeBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition-colors duration-300">
      🌙 Dark Mode
    </button>
  </div>
  
  <!-- Header -->
  <header class="bg-blue-900 dark:bg-gray-800 text-white text-center p-6 text-2xl font-bold">
    Personal Web | Faisal Mahfuzh
  </header>
  
  <!-- Navigation -->
  <nav class="bg-blue-700 dark:bg-gray-700 text-white py-3 shadow-sm sticky top-0 z-40">
    <ul class="flex justify-center space-x-10 font-medium text-lg">
      <li><a href="index.php" class="hover:underline"><i class="fas fa-newspaper mr-2"></i>Artikel</a></li>
      <li><a href="gallery.php" class="hover:underline"><i class="fas fa-image mr-2"></i>Gallery</a></li>
      <li><a href="about.php" class="hover:underline"><i class="fas fa-user mr-2"></i>About</a></li>
      <li><a href="kontak.php" class="hover:underline"><i class="fas fa-address-book mr-2"></i>Kontak</a></li>
      <li><a href="admin/login.php" class="hover:underline"><i class="fas fa-sign-in-alt mr-2"></i>Login</a></li>
    </ul>
  </nav>

  <!-- Main Content -->
  <main class="max-w-4xl mx-auto p-6 mt-6">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transition">
      <!-- Gambar Artikel -->
      <?php if (!empty($data['gambar'])): 
        $gambarPath = "uploads/" . htmlspecialchars($data['gambar']);
        if (file_exists($gambarPath)): ?>
          <img src="<?= $gambarPath ?>" 
               alt="<?= htmlspecialchars($data['nama_artikel']) ?>" 
               class="w-full h-96 object-cover article-image">
        <?php else: ?>
          <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-64 flex items-center justify-center text-gray-500">
            <i class="fas fa-image text-5xl"></i>
          </div>
        <?php endif; ?>
      <?php else: ?>
        <div class="bg-gray-200 dark:bg-gray-700 border-2 border-dashed rounded-xl w-full h-64 flex items-center justify-center text-gray-500 dark:text-gray-400">
          <i class="fas fa-image text-5xl"></i>
        </div>
      <?php endif; ?>
      
      <div class="p-6">
        <!-- Judul dan Tanggal -->
        <div class="flex justify-between items-start mb-4">
          <h1 class="text-2xl font-bold text-blue-800 dark:text-blue-400">
            <?= htmlspecialchars($data['nama_artikel']) ?>
          </h1>
          <span class="text-sm text-gray-500 dark:text-gray-400 whitespace-nowrap">
            <i class="far fa-calendar mr-1"></i> <?= date('d M Y', strtotime($data['tanggal'])) ?>
          </span>
        </div>
        
        <!-- Isi Artikel -->
        <article class="prose prose-lg max-w-none dark:prose-invert">
          <div class="justify-text">
            <?= nl2br(htmlspecialchars($data['isi_artikel'])) ?>
          </div>
        </article>
        
        <!-- Tombol Kembali -->
        <div class="mt-8 text-center">
          <a href="index.php" class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Beranda
          </a>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-blue-800 dark:bg-gray-800 text-white text-center py-4 mt-10">
    &copy; <?php echo date('Y'); ?> | Created by Faisal Mahfuzh
  </footer>
</body>
</html>