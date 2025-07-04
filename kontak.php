<?php
session_start();

// Restrict access to logged-in users only
if (!isset($_SESSION['username']) || $_SESSION['level'] !== 'user') {
    header("Location: admin/login.php");
    exit;
}

include "koneksi.php";

$nama = htmlspecialchars($_SESSION['username']);
$notif = isset($_GET['status']) && $_GET['status'] == 'sukses';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak | Dashboard User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen text-gray-800">

<!-- Header/Navbar -->
<header class="bg-blue-700 text-white shadow-lg">
    <div class="max-w-6xl mx-auto p-4 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <i class="fas fa-user-circle text-2xl"></i>
            <h1 class="text-xl font-bold"><?= $nama ?></h1>
        </div>
        <div class="flex items-center space-x-4">
            <span class="bg-blue-600 px-3 py-1 rounded-full text-sm">User</span>
            <a href="admin/logout.php" class="hover:text-blue-200 transition" 
               onclick="return confirm('Yakin ingin logout?')">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>
</header>

<!-- Main Content -->
<main class="max-w-6xl mx-auto mt-8 p-4">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <!-- Notification -->
        <?php if ($notif): ?>
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <p>Pesan berhasil dikirim! Terima kasih telah menghubungi.</p>
            </div>
        </div>
        <?php endif; ?>

        <!-- Contact Form -->
        <div class="p-6">
            <h2 class="text-2xl font-bold mb-2 flex items-center">
                <i class="fas fa-envelope mr-3 text-blue-600"></i>
                Formulir Kontak
            </h2>
            <p class="text-gray-600 mb-6">Silakan isi form berikut untuk menghubungi admin</p>

            <!-- PESAN YANG LEBIH RELEVAN -->
            <div class="mb-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                    <div>
                        <p class="font-medium text-blue-800">Informasi Akun</p>
                        <p class="text-blue-700">
                            Anda login sebagai <span class="font-semibold"><?= $nama ?></span>. 
                            Pesan akan dikirim menggunakan identitas akun Anda.
                        </p>
                    </div>
                </div>
            </div>

            <form action="proses_kontak.php" method="post" class="space-y-6">
                <input type="hidden" name="nama" value="<?= $nama ?>">

                <div>
                    <label for="email" class="block font-medium mb-2">Email</label>
                    <input type="email" name="email" id="email" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                           value="<?= isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : '' ?>">
                </div>

                <div>
                    <label for="pesan" class="block font-medium mb-2">Pesan</label>
                    <textarea name="pesan" id="pesan" rows="6" required minlength="10"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"></textarea>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="user_home.php" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-paper-plane mr-2"></i>Kirim Pesan
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-6 mt-10">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <h3 class="text-lg font-semibold">Sistem Informasi User</h3>
                <p class="text-sm text-gray-400 mt-1">© <?= date('Y'); ?> All Rights Reserved</p>
            </div>
            <div class="flex space-x-4">
                <a href="#" class="hover:text-blue-300 transition"><i class="fab fa-facebook"></i></a>
                <a href="#" class="hover:text-blue-400 transition"><i class="fab fa-twitter"></i></a>
                <a href="#" class="hover:text-red-400 transition"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</footer>

</body>
</html>