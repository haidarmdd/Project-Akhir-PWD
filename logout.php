<?php
// Mulai sesi lalu hapus semua data sesi
session_start();
session_destroy();

// Arahkan ke halaman utama setelah keluar
header("location: index.php");
?>
