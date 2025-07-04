<?php
session_start();
session_destroy();

// Arahkan kembali ke login.php
header("Location: login.php");
exit;
?>
