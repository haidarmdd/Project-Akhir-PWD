<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasboard - DeadlineKu</title>
</head>
<body>
    <?php
    session_start();
    include '01_koneksi_db.php';

    // cek udah login atau belum
    if(!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }

    // ambil data user yang sedang pakai (login)
    $user_id    = $_SESSION['user_id'];
    $nama       = $_SESSION['nama'];
    ?>

    <h2>Halo, <?php echo $nama; ?>!</h2>



</body>
</html>