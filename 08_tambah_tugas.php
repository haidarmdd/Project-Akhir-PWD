<?php
session_start();
include '01_koneksi_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $judul = $_POST['judul'];
    $matkul = $_POST['mata_kuliah'];
    $jenis = $_POST['jenis'];
    $tgl = $_POST['tanggal'];

    // Simpan ke DB
    $sql = "INSERT INTO dealines (user_id, judul, mata_kuliah, jenis, tanggal_deadline) VALUE ('$user_id', '$judul', '$matkul', '$jenis', '$tgl')";

    if ($konek->query($sql)) {
        header("location: 05_dasboard.php");
    } else {
        echo "Gagal menyimpan data.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas</title>
</head>
<body>
    <h2>Tambah Deadline Baru</h2>
    <form method="POST">
        Judul Tugas: <input type="text" name="judul" required><br><br>
        Mata Kuliah: <input type="text" name="mata_kuliah" required><br><br>
        Jenis:
        <select name="jenis">
            <option value="Tugas">Tugas</option>
            <option value="Ujian">Ujian</option>
            <option value="Praktikum">Praktikum</option>
        </select><br><br>
        Tanggal Deadline: <input type="date" name="tanggal" required><br><br>
        <button type="submit">Simpan</button>
    </form>
    <br>
    <a href="dashboard.php">Kembali ke Dashboard</a>
</body>
</html>