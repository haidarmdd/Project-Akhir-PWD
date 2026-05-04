<?php
include '01_koneksi_db.php';

// tangkap dari form daftar 
$nama       = $_POST['nama'];
$nim        = $_POST['nim'];
$password   = $_POST['password'];

// cek kondisi dari daftar apakah ada data yang belum di isi atau tidak 
if($nama == '' || $nim == '' || $password == '' ){
    header('Location: daftar.php?error=kosong');
    exit;
}

// cek kalau nim udah kedaftar di database
$cek = mysqli_query($konek, "SELECT * FROM users WHERE nim = '$nim'");
$ada = mysqli_fetch_assoc($cek); // fetch_assoc buat ngambil satu baris dari yang di cek

// cek jika nim sudah ada (terdaftar)
if($ada){
    header('Location: daftar.php?error=nim_ada');
    exit;
}

// enkripsi password biar ngga langsung tampil sesuai yang di input user
// misal input "haidar3452" bakal jadi "$2y$10$abc123xyzhashedpassword.."
$password_terenkripsi = password_hash($password, PASSWORD_DEFAULT);

// simpan daftar ke dalam database
mysqli_query($konek, "INSERT INTO users 
(nama, nim, password) VALUES 
('$nama', '$nim', '$password_terenkripsi')");

// buat pindha ke halaman login kalo daftar berhasil
header('Location: login.php?sukses');
exit;
?>