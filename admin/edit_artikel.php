<?php
include('../koneksi.php');
session_start();

// Cek sesi login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Validasi ID artikel
if (!isset($_GET['id_artikel']) || !is_numeric($_GET['id_artikel'])) {
    echo "<p>Artikel tidak ditemukan.</p>";
    exit;
}

$id = intval($_GET['id_artikel']);
$sql = "SELECT * FROM tbl_artikel WHERE id_artikel = $id";
$query = mysqli_query($db, $sql);

if (!$query || mysqli_num_rows($query) === 0) {
    echo "<p>Artikel tidak tersedia.</p>";
    exit;
}

$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Artikel</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Gunakan CKEditor -->
  <script src="https://cdn.ckeditor.com/4.26.1/standard/ckeditor.js"></script>
  <script>
    // Preview gambar sebelum upload
    function previewImage(event) {
      const preview = document.getElementById('imagePreview');
      const file = event.target.files[0];
      
      if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
          preview.innerHTML = `<img src="${e.target.result}" class="max-w-full h-48 object-contain" alt="Preview">`;
          preview.classList.remove('hidden');
        }
        
        reader.readAsDataURL(file);
      } else {
        preview.classList.add('hidden');
      }
    }
  </script>
</head>
<body class="bg-gray-100 min-h-screen">

  <!-- Header -->
  <header class="bg-blue-900 text-white text-center py-6 shadow">
    <h1 class="text-3xl font-bold">Edit Artikel</h1>
  </header>

  <div class="flex max-w-7xl mx-auto mt-8 px-4">
    <!-- Sidebar -->
    <aside class="w-1/4 bg-white rounded shadow p-4">
      <h2 class="text-xl font-semibold text-blue-700 mb-4 text-center">MENU</h2>
      <ul class="space-y-2 text-gray-700">
        <li><a href="beranda_login.php" class="block hover:text-blue-600">Beranda</a></li>
        <li><a href="data_artikel.php" class="block font-semibold text-blue-800">Kelola Artikel</a></li>
        <li><a href="data_gallery.php" class="block hover:text-blue-600">Kelola Gallery</a></li>
        <li><a href="data_about.php" class="block hover:text-blue-600">About</a></li>
        <li><a href="logout.php" onclick="return confirm('Yakin ingin logout?')" class="block text-red-600 hover:underline font-medium">Logout</a></li>
      </ul>
    </aside>

    <!-- Form Edit Artikel -->
    <main class="w-3/4 bg-white rounded shadow p-6 ml-6">
      <form action="proses_edit_artikel.php" method="post" enctype="multipart/form-data" class="space-y-6">
        <input type="hidden" name="id_artikel" value="<?= $data['id_artikel'] ?>">

        <div>
          <label for="nama_artikel" class="block text-sm font-medium text-gray-700 mb-1">Judul Artikel</label>
          <input type="text" id="nama_artikel" name="nama_artikel" required value="<?= htmlspecialchars($data['nama_artikel']) ?>" class="w-full p-2 border rounded focus:outline-none focus:ring focus:border-blue-500">
        </div>

        <div>
          <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
          <input type="date" id="tanggal" name="tanggal" required value="<?= $data['tanggal'] ?>" class="w-full p-2 border rounded focus:outline-none focus:ring focus:border-blue-500">
        </div>

        <div>
          <label for="gambar" class="block text-sm font-medium text-gray-700 mb-1">Gambar Artikel</label>
          
          <?php if (!empty($data['gambar'])): ?>
            <div class="mb-2">
              <p class="text-sm text-gray-600">Gambar saat ini:</p>
              <img src="../uploads/<?= htmlspecialchars($data['gambar']) ?>" class="w-48 h-32 object-contain border p-1">
              <p class="text-xs text-gray-500 mt-1"><?= htmlspecialchars($data['gambar']) ?></p>
            </div>
          <?php endif; ?>
          
          <input type="file" id="gambar" name="gambar" accept="image/*" 
                 onchange="previewImage(event)"
                 class="w-full p-2 border rounded focus:outline-none focus:ring focus:border-blue-500">
          <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
          
          <!-- Preview gambar -->
          <div id="imagePreview" class="mt-2 hidden bg-gray-100 p-4 rounded border border-dashed"></div>
        </div>

        <div>
          <label for="isi_artikel" class="block text-sm font-medium text-gray-700 mb-1">Isi Artikel</label>
          <textarea id="isi_artikel" name="isi_artikel" rows="10" required class="w-full p-2 border rounded focus:outline-none focus:ring focus:border-blue-500"><?= htmlspecialchars($data['isi_artikel']) ?></textarea>
          <script>
            CKEDITOR.replace('isi_artikel', {
              toolbar: [
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Blockquote'] },
                { name: 'links', items: ['Link', 'Unlink'] },
                { name: 'insert', items: ['Table'] },
                { name: 'tools', items: ['Maximize'] },
                { name: 'document', items: ['Source'] }
              ],
              height: 300,
              removePlugins: 'uploadimage,uploadwidget,uploadfile,filetools,filebrowser'
            });
          </script>
        </div>

        <div class="text-right">
          <button type="submit" class="bg-blue-700 text-white px-6 py-2 rounded hover:bg-blue-800">Simpan Perubahan</button>
        </div>
      </form>
    </main>
  </div>

</body>
</html>