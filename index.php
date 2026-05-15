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
    <style>
        /* WARNA BODY */
        body {
            background-image: url('red_bg.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        /* ===== LAPISAN GELAP DI ATAS VIDEO ===== */
        .lapisan-gelap {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.25);
            z-index: 1;
        }

        /* ===== KONTEN DI ATAS VIDEO ===== */
        .pembungkus-landing {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 24px;
            background: none;
        }

        /* ===== TEKS BAYANGAN BIAR TERBACA ===== */
        .judul-landing {
            text-shadow: 0 2px 20px rgba(0,0,0,0.5);
        }

        .deskripsi-landing {
            text-shadow: 0 1px 8px rgba(0,0,0,0.4);
        }
    </style>
</head>
<body>    

    <!-- LAPISAN GELAP TRANSPARAN DI ATAS VIDEO -->
    <div class="lapisan-gelap"></div>

    <!-- KONTEN UTAMA -->
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
