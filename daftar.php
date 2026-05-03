<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar DeadlineKu</title>
</head>
<body>

     <h2>Daftar Akun DeadlineKu</h2>

     <?php if (isset($_GET['error'])):?>
        <p style="color: red;">
            <?php 
            $error = $_GET['error'];
            if ($error === 'kosong') {
                echo 'Semua data wajib diisi';
            } elseif ($error === 'nim_ada') {
                echo 'NIM sudah terdaftar, mau daftar pakai nim lain?';
            }
            ?>
        </p>

     <?php endif; ?>

     <form method="POST" action="proses_daftar.php">
        <label>Nama</label><br>
        <input type="text" name="nama" placeholder="Masukkan Nama Lengkap"><br><br>

        <label>NIM</label><br>
        <input type="text" name="nim" placeholder="Masukkan NIM"><br><br>

        <label>Password</label><br>
        <input type="password" name="Password" placeholder="Buat Password"><br><br>
    
        <button type="submit">Daftar</button>
     </form>
    
     <br>
    <P>Sudah memiliki akun? <a href="login.php">login disini</a></P>
</body>
</html>