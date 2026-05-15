<?php
session_start();
session_destroy(); // Hapus sesi
Header("location: index.php"); // kembali ke halaman depan
?>