<?php
session_start();
include '01_koneksi_db.php';

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Proses hanya jika form disubmit via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari session & form 
    $user_id = $_SESSION['user_id'];
    $judul= $_POST['judul'];
    $matkul= $_POST['mata_kuliah'];
    $jenis= $_POST['jenis'];
    $tgl= $_POST['tanggal'];

    $semester =1; // Nilai default agar tidak error
    $status = 'belum';

    // Masukan data ke DB
    $sql = "INSERT INTO deadlines (user_id, judul, mata_kuliah, jenis, tanggal_deadline, semester, status) VALUES ('$user_id', '$judul', '$matkul', '$jenis', '$tgl', '$semester', '$status')";

    if ($konek->query($sql)) {
        // Jika berhasil, redirect ke dashboard
        header("Location: dashboard.php");
        exit;
    } else {
        // JIka gagal, tmapilkan error
        echo "Gagal menyimpan data: " . $konek->error;
    }
} else {
    // Jika file dibuka tanpa form, kembali ke form
    header("Location: tambah_tugas.php");
    exit;
}   
?>