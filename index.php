<?php
session_start();
// Jika sudah login, langsung ke dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeadlineKu</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>    

    <!-- LAPISAN GELAP TRANSPARAN DI ATAS VIDEO -->
    <div class="lapisan-gelap"></div>

    <!-- KONTEN UTAMA -->
    <div class="konten-landing">
    <div class="pembungkus-landing">
        <div>
            <div class="judul-landing">Deadline<span style="color:crimson">Ku</span></div>
            <p class="deskripsi-landing">Website kelola deadline tugas dan ujian kuliah kamu dalam satu tempat. <br> Bikin lebih rapi, terstruktur, dan tidak ada yang terlewat.</p>
            <p class="deskripsi-landing"></p>
            <div class="aksi-landing">
                <a href="login.php" class="tombol tombol-utama">Login</a>
                <a href="daftar.php" class="tombol tombol-sekunder">Daftar Akun</a>
            </div>
        </div>
    </div>

</body>
</html>
