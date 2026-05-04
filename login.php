<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login DeadlineKu</title>
</head>
<body>
     <h2>LOGIN DeadlineKu</h2>

     <form method="POST" action="proses_login.php">
        <label>NIM</label><br>
        <input type="text" name="nim" placeholder="Masukan NIM"><br><br>
        <label>Password</label><br>
        <input type="password" name="password" placeholder="Masukkan Password"><br><br>
        <button type="submit">LOGIN</button>
     </form>

    <!-- isset untuk mengecek ada tidaknya data -->
    <?php if (isset($_GET['error'])): ?> 
        <p style="color: red;">
            <?php 
            $error = $_GET['error'];
            if ($error === 'salah') { 
                echo 'NIM atau Password kamu salah';
            } elseif ($error === 'kosong') {
                echo 'NIM atau Password tidak boleh kosong';
            } elseif ($error === 'belum_daftar') {
                echo 'anda belum memiliki akun, silahkan daftar terlebih dahulu';   
            }
            ?>
        </p>
    <?php endif ?>
    
    <?php if(isset($_GET['sukses'])): ?>
        <p style="color: green;">Akun berhasil dibuat! Silahkan lakukan login</p>
    <?php endif; ?>

    <P>Belum memiliki akun? <a href="daftar.php">Daftar disini</a></P>

</body>
</html>