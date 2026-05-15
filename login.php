<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DeadlineKu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="pembungkus-auth">
        <div class="kartu-auth">
            <div class="logo-auth">Deadline<span style="color:crimson ;">Ku</span></div>
            <p class="tagline-auth">Pelacak deadline akademik mahasiswa</p>

            <h2 class="judul-auth">Selamat datang!</h2>
            <p class="subjudul-auth">Masuk ke akun kamu</p>

            <?php if (isset($_GET['error'])): ?>
                <div class="peringatan peringatan-error">
                    <?php
                    $error = $_GET['error'];
                    if ($error === 'salah') echo 'NIM atau Password kamu salah.';
                    elseif ($error === 'kosong') echo 'NIM dan Password tidak boleh kosong.';
                    elseif ($error === 'belum_daftar') echo 'Akun belum terdaftar, silahkan daftar dulu.';
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['sukses'])): ?>
                <div class="peringatan peringatan-sukses">Akun berhasil dibuat! Silahkan login.</div>
            <?php endif; ?>

            <form method="POST" action="proses_login.php">
                <div class="grup-formulir">
                    <label class="label-formulir">NIM</label>
                    <input type="text" name="nim" class="input-formulir" placeholder="Masukkan NIM kamu">
                </div>
                <div class="grup-formulir">
                    <label class="label-formulir">Password</label>
                    <input type="password" name="password" class="input-formulir" placeholder="Masukkan password">
                </div>
                <button type="submit" class="tombol tombol-utama" style="width:100%; justify-content:center; margin-top:8px;">Login</button>
            </form>

            <div class="footer-auth">
                Belum punya akun? <a href="daftar.php" style="color: crimson;">Daftar disini</a>
            </div>
        </div>
    </div>
</body>
</html>
