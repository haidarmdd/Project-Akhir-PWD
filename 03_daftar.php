<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Daftar</title>
</head>
<body>
     <h2>Silahkan Daftar Untuk Melanjutkan</h2>

     <form action="POST" action="proses_Daftar.php">
        <input type="text" name="Nama_Lengkap" placeholder="Nama Lengkap" required><br><br>
        <input type="text" name="NIM" placeholder="NIM" required><br><br>
        <input type="password" name="Password" placeholder="Password" required><br><br>
        <input type="Password" name="Konfirmasi Password" placeholder="Konfirmasi Password" required><br><br>
        <button type="submit">Daftar</button>
     </form>
        
    <P>sudah memiliki akun? <a href="login.php">login disini</a></P>

</body>
</html>