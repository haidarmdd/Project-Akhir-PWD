<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - DeadlineKu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-logo">DeadlineKu</div>
            <p class="auth-tagline">Tracker deadline akademik mahasiswa</p>

            <h2 class="auth-title">Buat akun baru</h2>
            <p class="auth-subtitle">Gratis dan mudah</p>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-error">
                    <?php
                    $error = $_GET['error'];
                    if ($error === 'kosong') echo 'Semua data wajib diisi.';
                    elseif ($error === 'nim_ada') echo 'NIM sudah terdaftar, coba NIM lain.';
                    ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="proses_daftar.php">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-input" placeholder="Masukkan nama lengkap">
                </div>
                <div class="form-group">
                    <label class="form-label">NIM</label>
                    <input type="text" name="nim" class="form-input" placeholder="Masukkan NIM">
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-input" placeholder="Buat password">
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center; margin-top:8px;">Daftar Sekarang</button>
            </form>

            <div class="auth-footer">
                Sudah punya akun? <a href="login.php">Login disini</a>
            </div>
        </div>
    </div>
</body>
</html>
