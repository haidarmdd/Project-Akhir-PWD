<?php
session_start();
session_destroy(); // Hapus sesi
Header("location: 02_index.php") // kembali ke halaman depan
?>