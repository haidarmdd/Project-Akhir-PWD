<?php
session_start();
include '01_koneksi_db.php';

// Ambil data dari formulir login
$nim      = $_POST['nim'];
$password = $_POST['password'];

// Cek apakah ada kolom yang kosong
if ($nim == '' || $password == '') {
    header('Location: login.php?error=kosong');
    exit;
}

// Cari pengguna berdasarkan NIM di database
$cek  = mysqli_query($konek, "SELECT * FROM users WHERE nim = '$nim'");
$user = mysqli_fetch_assoc($cek);

// Jika NIM tidak ditemukan di database
if (!$user) {
    header('Location: login.php?error=belum_daftar');
    exit;
}

// Cocokkan password yang diinput dengan password terenkripsi di database
if ($user && password_verify($password, $user['password'])) {

    // Jika cocok, simpan data pengguna ke sesi
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['nama']    = $user['nama'];
    $_SESSION['nim']     = $user['nim'];

    // Arahkan ke dashboard
    header('Location: dashboard.php');
    exit;
} else {
    // Jika password salah, kembali ke halaman login dengan pesan error
    header('Location: login.php?error=salah');
    exit;
}
?>
