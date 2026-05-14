<?php
session_start();
include '01_koneksi_db.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Proses hanya jika form disubmit via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form (sesuai name di 10_edit_tugas.php)
    $id     = $_POST['id'];
    $judul  = $_POST['judul'];
    $matkul = $_POST['mata_kuliah'];
    $jenis  = $_POST['jenis'];
    $tgl    = $_POST['tanggal'];
    $status = $_POST['status'];

    // DATABASE MEMERLUKAN KOLOM 'semester' (NOT NULL)
    $cek = $konek->query("SELECT semester FROM deadlines WHERE id='$id'");
    $data_lama = $cek->fetch_assoc();
    $semester = $data_lama['semester']; // Pertahankan nilai semester lama

    // 3. UPDATE data ke database
    $sql = "UPDATE deadlines SET 
            judul='$judul', 
            mata_kuliah='$matkul', 
            jenis='$jenis', 
            tanggal_deadline='$tgl', 
            status='$status',
            semester='$semester'
            WHERE id='$id'";

    if ($konek->query($sql)) {
        // Jika berhasil, redirect ke dashboard
        header("Location: 05_dashboard.php");
        exit;
    } else {
        // Jika gagal, tampilkan error dari MySQL
        echo "Gagal update data: " . $konek->error;
    }
} else {
    // Jika file ini dibuka langsung tanpa submit form, kembalikan ke dashboard
    header("Location: dashboard.php");
    exit;
}
?>