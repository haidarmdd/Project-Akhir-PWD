<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DeadlineKu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-logo">DeadlineKu</div>
            <p class="auth-tagline">Tracker deadline akademik mahasiswa</p>

            <h2 class="auth-title">Selamat datang!</h2>
            <p class="auth-subtitle">Masuk ke akun kamu</p>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-error">
                    <?php
                    $error = $_GET['error'];
                    if ($error === 'salah') echo 'NIM atau Password kamu salah.';
                    elseif ($error === 'kosong') echo 'NIM dan Password tidak boleh kosong.';
                    elseif ($error === 'belum_daftar') echo 'Akun belum terdaftar, silahkan daftar dulu.';
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['sukses'])): ?>
                <div class="alert alert-success">Akun berhasil dibuat! Silahkan login.</div>
            <?php endif; ?>

            <form method="POST" action="proses_login.php">
                <div class="form-group">
                    <label class="form-label">NIM</label>
                    <input type="text" name="nim" class="form-input" placeholder="Masukkan NIM kamu">
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-input" placeholder="Masukkan password">
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center; margin-top:8px;">Login</button>
            </form>

            <div class="auth-footer">
                Belum punya akun? <a href="daftar.php">Daftar disini</a>
            </div>
        </div>
    </div>
</body>
</html>
