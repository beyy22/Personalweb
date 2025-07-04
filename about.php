<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>About | Personal Web</title>
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
    .profile-img {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .profile-img:hover {
      transform: scale(1.03);
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
  </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100 min-h-screen flex flex-col transition-colors duration-300">

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
  
  <!-- Navigasi -->
  <nav class="bg-blue-700 dark:bg-gray-700 text-white py-3 shadow-sm sticky top-0 z-40">
    <ul class="flex justify-center space-x-10 font-medium text-lg">
      <li><a href="index.php" class="hover:underline"><i class="fas fa-newspaper mr-2"></i>Artikel</a></li>
      <li><a href="gallery.php" class="hover:underline"><i class="fas fa-image mr-2"></i>Gallery</a></li>
      <li><a href="about.php" class="hover:underline font-bold"><i class="fas fa-user mr-2"></i>About</a></li>
      <li><a href="kontak.php" class="hover:underline"><i class="fas fa-address-book mr-2"></i>Kontak</a></li>
      <li><a href="admin/login.php" class="hover:underline"><i class="fas fa-sign-in-alt mr-2"></i>Login</a></li>
    </ul>
  </nav>

  <!-- Konten Utama -->
  <main class="max-w-4xl mx-auto p-6 mt-6 flex-grow">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 transition duration-300">
      <h2 class="text-2xl font-bold text-blue-800 dark:text-blue-300 mb-8 text-center">
        <i class="fas fa-user mr-2"></i>Tentang Saya
      </h2>
      
      <?php
      $sql = "SELECT * FROM tbl_about ORDER BY id_about DESC LIMIT 1";
      $query = mysqli_query($db, $sql);
      
      if (!$query) {
        echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6'>
                <p>Terjadi kesalahan saat mengambil data: " . mysqli_error($db) . "</p>
              </div>";
      } elseif (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        ?>
        <div class="flex flex-col md:flex-row gap-8 items-center">
          <!-- Foto Profil -->
          <div class="flex-shrink-0">
  <?php 
  // Pastikan ada foto di database
  if (!empty($data['foto'])):
    $fotoPath = "images/about/" . htmlspecialchars($data['foto']);
    
    // Cek apakah file benar-benar ada
    if (file_exists($fotoPath)): ?>
      <img src="<?= $fotoPath ?>" 
           alt="Foto Profil" 
           class="w-56 h-56 rounded-full border-4 border-blue-600 dark:border-blue-400 shadow-lg profile-img">
    <?php else: ?>
      <div class="w-56 h-56 rounded-full border-4 border-blue-600 dark:border-blue-400 shadow-lg bg-gray-200 dark:bg-gray-700 flex flex-col items-center justify-center text-center p-2">
        <i class="fas fa-exclamation-triangle text-3xl text-yellow-500 mb-2"></i>
        <span class="text-xs text-gray-600 dark:text-gray-300">Gambar tidak ditemukan</span>
        <span class="text-xs text-gray-500 mt-1"><?= htmlspecialchars($data['foto']) ?></span>
      </div>
    <?php endif; ?>
  <?php else: ?>
    <div class="w-56 h-56 rounded-full border-4 border-blue-600 dark:border-blue-400 shadow-lg bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
      <i class="fas fa-user text-6xl text-gray-500 dark:text-gray-400"></i>
    </div>
  <?php endif; ?>
</div>
          <!-- Deskripsi -->
          <div class="flex-grow">
            <div class="prose prose-lg dark:prose-invert max-w-none">
              <p class="text-gray-700 dark:text-gray-200 leading-relaxed">
                <?= nl2br(htmlspecialchars($data['about'])) ?>
              </p>
            </div>
            
            <!-- Informasi Tambahan -->
            <?php if (!empty($data['email']) || !empty($data['telepon'])): ?>
              <div class="mt-6 border-t pt-4">
                <h3 class="text-lg font-semibold text-blue-700 dark:text-blue-400 mb-3">
                  <i class="fas fa-info-circle mr-2"></i>Informasi Kontak
                </h3>
                
                <ul class="space-y-2">
                  <?php if (!empty($data['email'])): ?>
                    <li class="flex items-center">
                      <i class="fas fa-envelope text-blue-600 dark:text-blue-400 mr-2 w-5"></i>
                      <span class="text-gray-700 dark:text-gray-300"><?= htmlspecialchars($data['email']) ?></span>
                    </li>
                  <?php endif; ?>
                  
                  <?php if (!empty($data['telepon'])): ?>
                    <li class="flex items-center">
                      <i class="fas fa-phone text-blue-600 dark:text-blue-400 mr-2 w-5"></i>
                      <span class="text-gray-700 dark:text-gray-300"><?= htmlspecialchars($data['telepon']) ?></span>
                    </li>
                  <?php endif; ?>
                </ul>
              </div>
            <?php endif; ?>
          </div>
        </div>
      <?php } else { ?>
        <div class="text-center py-8">
          <div class="bg-gray-200 dark:bg-gray-700 border-2 border-dashed rounded-xl w-24 h-24 flex items-center justify-center mx-auto text-gray-500">
            <i class="fas fa-user text-4xl"></i>
          </div>
          <p class="mt-4 text-gray-600 dark:text-gray-300">Belum ada informasi tentang saya</p>
        </div>
      <?php } ?>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-blue-800 dark:bg-gray-800 text-white text-center py-4">
    &copy; <?php echo date('Y'); ?> | Created by Faisal Mahfuzh
  </footer>
</body>
</html>