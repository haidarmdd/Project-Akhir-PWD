<?php 
    session_start();
    include '01_koneksi_db.php';

    // tangkap dari POST di proses login
    $nim = $_POST['nim'];
    $password = $_POST['password'];

    // buat ngecek apakah ada input yang kosong dari user 
    if ($nim = '' || $password = ''){
        header('Location: login.php?error=kosong');
        exit;
    }

    // mengecek user di database dengan NIM
    $cek = mysqli_query($konek, "SELECT * FROM users WHERE nim = '$nim'");
    $user = mysqli_fetch_assoc($cek);

    // mengecek password dari nim yang dimasukkan ke database
    if ($user && password_verify($password, $user['password'])) {
        
        // kalo password nya cocok, simpan data user ke session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['nim'] = $user['nim'];

        header('Location: dashboard.php');
        exit;
    } else {
        // kalo passwordnya gacocok / gagal login, balik ke halaman login dengan pesan error
        header('Location: login.php?error=salah');
        exit;
    }
?>