<?php session_start(); if (isset($_SESSION['user_id'])) { header('Location: dashboard.php'); exit; } ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeadlineKu - Kelola Tugasmu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="lapisan-gelap"></div>
    <h1>hallo</h1>

    <div class="konten-landing">
        <div class="pembungkus-landing">
            <h1 class="judul-landing">Deadline<span style="color:#e74c3c">Ku</span></h1>
            <p class="deskripsi-landing">
                Kelola semua tugas, ujian, dan praktikum kuliahmu dalam satu tempat.<br>
                Tidak ada lagi deadline yang terlewat.
            </p>
            <div class="aksi-landing">
                <a href="login.php" class="tombol tombol-utama">Masuk</a>
                <a href="daftar.php" class="tombol tombol-sekunder">Daftar Sekarang</a>
            </div>
        </div>
    </div>
</body>
</html>