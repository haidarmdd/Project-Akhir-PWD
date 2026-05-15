<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deadline Tracker</title>
</head>
<body>
    <h1>Deadline Tracker</h1>
    <p>Kelola deadline tugas dan ujian kuliahmu</p>
    <hr>
    <p>
        <a href="login.php">Login</a>
        <a href="daftar.php">Daftar Akun Baru</a>
    </p>
</body>
</html>