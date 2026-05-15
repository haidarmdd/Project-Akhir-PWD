<?php
// Mulai sesi untuk keamanan
session_start();
include '01_koneksi_db.php';

// Hapus deadline jika ID tersedia di parameter URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM deadlines WHERE id='$id'";
    $konek->query($sql);
}

// Kembali ke dashboard setelah penghapusan
header("location: dashboard.php");
?>
