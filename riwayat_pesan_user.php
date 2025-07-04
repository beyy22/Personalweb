<?php
session_start();

// Check if user is logged in as user
if (!isset($_SESSION['username']) || $_SESSION['level'] !== 'user') {
    header("Location: admin/login.php");
    exit;
}

include "koneksi.php";

// Use prepared statement to prevent SQL injection
$nama = $_SESSION['username'];
$stmt = mysqli_prepare($db, "SELECT * FROM tbl_kontak WHERE nama = ? ORDER BY tanggal DESC");
mysqli_stmt_bind_param($stmt, "s", $nama);
mysqli_stmt_execute($stmt);
$query = mysqli_stmt_get_result($stmt);

if (!$query) {
    die("Database error: " . mysqli_error($db));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesan | Dashboard User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen text-gray-800">

<!-- Header/Navbar -->
<header class="bg-blue-700 text-white shadow-lg">
    <div class="max-w-6xl mx-auto p-4 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <i class="fas fa-user-circle text-2xl"></i>
            <h1 class="text-xl font-bold"><?= htmlspecialchars($_SESSION['username']) ?></h1>
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
        <div class="p-6">
            <h2 class="text-2xl font-bold mb-6 flex items-center">
                <i class="fas fa-history mr-3 text-blue-600"></i>
                Riwayat Pesan Anda
            </h2>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-blue-100 text-left">
                            <th class="p-3 border-b border-gray-200 font-semibold">No</th>
                            <th class="p-3 border-b border-gray-200 font-semibold">Pesan</th>
                            <th class="p-3 border-b border-gray-200 font-semibold">Tanggal</th>
                            <th class="p-3 border-b border-gray-200 font-semibold">Status</th>
                            <th class="p-3 border-b border-gray-200 font-semibold">Balasan Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($query) > 0): ?>
                            <?php $no = 1; while ($data = mysqli_fetch_assoc($query)): ?>
                                <tr class="hover:bg-gray-50 <?= $no % 2 === 0 ? 'bg-gray-50' : '' ?>">
                                    <td class="p-3 border-b border-gray-200"><?= $no ?></td>
                                    <td class="p-3 border-b border-gray-200"><?= htmlspecialchars($data['pesan']) ?></td>
                                    <td class="p-3 border-b border-gray-200"><?= date('d-m-Y H:i', strtotime($data['tanggal'])) ?></td>
                                    <td class="p-3 border-b border-gray-200 capitalize font-medium 
                                        <?= $data['status'] === 'dibaca' ? 'text-green-600' : 'text-blue-600' ?>">
                                        <?= htmlspecialchars($data['status']) ?>
                                    </td>
                                    <td class="p-3 border-b border-gray-200">
                                        <?= $data['balasan'] ? 
                                            nl2br(htmlspecialchars($data['balasan'])) : 
                                            '<span class="text-gray-400 italic">Belum dibalas</span>' ?>
                                    </td>
                                </tr>
                            <?php $no++; endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="p-4 text-center text-gray-500">
                                    Anda belum mengirim pesan apapun
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-4 flex justify-between items-center">
                <p class="text-sm text-gray-600">
                    Total Pesan: <span class="font-semibold"><?= mysqli_num_rows($query) ?></span>
                </p>
                <a href="user_home.php" class="text-blue-600 hover:underline">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Dashboard
                </a>
            </div>
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