<?php 
include('../koneksi.php'); 
session_start();
if (!isset($_SESSION['username'])) { 
    header('location:login.php'); 
    exit; 
}

// Ambil data dari form
$about = mysqli_real_escape_string($db, $_POST['about']);
$email = mysqli_real_escape_string($db, $_POST['email']);
$telepon = mysqli_real_escape_string($db, $_POST['telepon']);
$foto = '';

// Handle upload foto
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['foto'];
    $allowed = ['jpg', 'jpeg', 'png'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
    if (in_array($ext, $allowed)) {
        $namaFile = uniqid('profile_') . '.' . $ext;
        $targetPath = '../images/about/' . $namaFile;
        
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            $foto = $namaFile;
        }
    }
}

// Simpan ke database
$sql = "INSERT INTO tbl_about (about, email, telepon, foto) 
        VALUES ('$about', '$email', '$telepon', '$foto')";
$query = mysqli_query($db, $sql);

if ($query) {
    echo "<script>alert('Data about berhasil disimpan.'); window.location='data_about.php';</script>";
} else {
    echo "<script>alert('Gagal menyimpan data: " . mysqli_error($db) . "'); history.back();</script>";
}
?>