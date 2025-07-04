<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Gallery | Personal Web</title>
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
    
    // Fungsi untuk modal galeri
    const images = <?php 
      $sql = "SELECT * FROM tbl_gallery ORDER BY id_gallery DESC";
      $query = mysqli_query($db, $sql);
      $images = [];
      while ($data = mysqli_fetch_assoc($query)) {
        $images[] = $data;
      }
      echo json_encode($images);
    ?>;
    let currentIndex = 0;

    function openModal(index) {
      currentIndex = index;
      const img = images[index];
      document.getElementById('modalImage').src = 'images/' + img.foto;
      document.getElementById('modalCaption').textContent = img.judul;
      document.getElementById('imageModal').classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
    }

    function closeModal() {
      document.getElementById('imageModal').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
    }

    function prevImage() {
      if (currentIndex > 0) {
        openModal(currentIndex - 1);
      }
    }

    function nextImage() {
      if (currentIndex < images.length - 1) {
        openModal(currentIndex + 1);
      }
    }
    
    // Tutup modal dengan ESC
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeModal();
    });
  </script>
  <style>
    .gallery-item {
      transition: all 0.3s ease;
      overflow: hidden;
    }
    .gallery-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
    .gallery-item img {
      transition: transform 0.5s ease;
    }
    .gallery-item:hover img {
      transform: scale(1.05);
    }
    #modalImage {
      max-height: 80vh;
      max-width: 90vw;
    }
  </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100 font-sans transition-colors duration-300 min-h-screen flex flex-col">

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
      <li><a href="gallery.php" class="hover:underline font-bold"><i class="fas fa-image mr-2"></i>Gallery</a></li>
      <li><a href="about.php" class="hover:underline"><i class="fas fa-user mr-2"></i>About</a></li>
      <li><a href="kontak.php" class="hover:underline"><i class="fas fa-address-book mr-2"></i>Kontak</a></li>
      <li><a href="admin/login.php" class="hover:underline"><i class="fas fa-sign-in-alt mr-2"></i>Login</a></li>
    </ul>
  </nav>

  <!-- Galeri -->
  <main class="max-w-6xl mx-auto p-6 flex-grow">
    <h2 class="text-2xl font-bold mb-6 text-center text-blue-800 dark:text-blue-400">
      <i class="fas fa-images mr-2"></i>Galeri Foto
    </h2>

    <?php if (mysqli_num_rows($query) === 0): ?>
      <div class="text-center py-10">
        <div class="bg-gray-200 dark:bg-gray-700 border-2 border-dashed rounded-xl w-24 h-24 flex items-center justify-center mx-auto text-gray-500">
          <i class="fas fa-image text-3xl"></i>
        </div>
        <p class="mt-4 text-gray-600 dark:text-gray-300">Belum ada foto di galeri</p>
      </div>
    <?php else: ?>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php foreach ($images as $index => $data): ?>
          <div class="gallery-item bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <div class="overflow-hidden">
              <img src="images/<?= htmlspecialchars($data['foto']) ?>" 
                   onclick="openModal(<?= $index ?>)" 
                   class="w-full h-56 object-cover cursor-pointer" 
                   alt="<?= htmlspecialchars($data['judul']) ?>">
            </div>
            <div class="p-4">
              <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200">
                <?= htmlspecialchars($data['judul']) ?>
              </h3>
              <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
              </p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </main>

  <!-- Modal -->
  <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 hidden">
    <div class="relative w-full max-w-4xl px-4">
      <button onclick="closeModal()" 
              class="absolute top-4 right-4 bg-white text-black rounded-full w-10 h-10 flex items-center justify-center shadow-lg hover:bg-gray-200">
        <i class="fas fa-times"></i>
      </button>
      
      <!-- Navigasi -->
      <button onclick="prevImage()" 
              class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white text-black rounded-full w-10 h-10 flex items-center justify-center shadow-lg hover:bg-gray-200">
        <i class="fas fa-chevron-left"></i>
      </button>
      <button onclick="nextImage()" 
              class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white text-black rounded-full w-10 h-10 flex items-center justify-center shadow-lg hover:bg-gray-200">
        <i class="fas fa-chevron-right"></i>
      </button>

      <!-- Image Container -->
      <div class="w-full flex flex-col items-center">
        <img id="modalImage" src="" 
             alt="Preview Gambar" 
             class="rounded-lg shadow-xl max-h-[70vh] object-contain">
        <p id="modalCaption" class="mt-4 text-white text-center text-lg font-medium"></p>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-blue-800 dark:bg-gray-800 text-white text-center py-4">
    &copy; <?php echo date('Y'); ?> | Created by Faisal Mahfuzh
  </footer>
</body>
</html>