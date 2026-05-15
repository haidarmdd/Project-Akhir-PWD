<?php
include '01_koneksi_db.php';

// Ambil data dari formulir pendaftaran
$nama     = $_POST['nama'];
$nim      = $_POST['nim'];
$password = $_POST['password'];

// Cek apakah ada kolom yang belum diisi
if ($nama == '' || $nim == '' || $password == '') {
    header('Location: daftar.php?error=kosong');
    exit;
}

// Cek apakah NIM sudah pernah terdaftar di database
$cek = mysqli_query($konek, "SELECT * FROM users WHERE nim = '$nim'");
$ada = mysqli_fetch_assoc($cek);

// Jika NIM sudah ada, tolak pendaftaran
if ($ada) {
    header('Location: daftar.php?error=nim_ada');
    exit;
}

// Enkripsi password sebelum disimpan ke database
// Contoh: "password123" menjadi "$2y$10$abc123xyzhashedpassword.."
$password_terenkripsi = password_hash($password, PASSWORD_DEFAULT);

// Simpan data pengguna baru ke database
mysqli_query($konek, "INSERT INTO users (nama, nim, password) VALUES ('$nama', '$nim', '$password_terenkripsi')");

// Arahkan ke halaman login jika pendaftaran berhasil
header('Location: login.php?sukses');
exit;
?>
