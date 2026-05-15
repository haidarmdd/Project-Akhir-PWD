<?php
session_start();
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
    <div class="landing-wrapper">
        <div>
            <div class="landing-title">Deadline<span>Ku</span></div>
            <p class="landing-desc">Kelola deadline tugas dan ujian kuliahmu dalam satu tempat. Rapi, terstruktur, dan tidak ada yang terlewat.</p>
            <div class="landing-actions">
                <a href="login.php" class="btn btn-primary">Login</a>
                <a href="daftar.php" class="btn btn-secondary">Daftar Akun</a>
            </div>
        </div>
    </div>
</body>
</html>
