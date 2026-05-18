<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - DeadlineKu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="pembungkus-auth">
        <div class="kartu-auth">
            <div class="logo-auth">Deadline<span>Ku</span></div>
            <p class="tagline-auth">Pelacak deadline akademik mahasiswa</p>

            <h2 class="judul-auth">Buat akun baru</h2>
            <p class="subjudul-auth">Gratis dan mudah digunakan</p>

            <?php if (isset($_GET['error'])): ?>
                <div class="peringatan peringatan-error">
                    <?php
                    $error = $_GET['error'];
                    if ($error === 'kosong') echo 'Semua data wajib diisi.';
                    elseif ($error === 'nim_ada') echo 'NIM sudah terdaftar, coba NIM lain.';
                    ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="proses_daftar.php">
                <div class="grup-formulir">
                    <label class="label-formulir">Nama Lengkap</label>
                    <input type="text" name="nama" class="input-formulir" placeholder="Masukkan nama lengkap">
                </div>
                <div class="grup-formulir">
                    <label class="label-formulir">NIM</label>
                    <input type="text" name="nim" class="input-formulir" placeholder="Masukkan NIM">
                </div>
                <div class="grup-formulir">
                    <label class="label-formulir">Password</label>
                    <input type="password" name="password" class="input-formulir" placeholder="Buat password">
                </div>
                <button type="submit" class="tombol tombol-utama" style="width:100%; justify-content:center; margin-top:8px;">Daftar Sekarang</button>
            </form>

            <div class="footer-auth">
                Sudah punya akun? <a href="login.php">Login disini</a>
            </div>
        </div>
    </div>
</body>
</html>