<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login DeadlineKu</title>
</head>
<body>
     <h2>LOGIN DeadlineKu</h2>

    <?php if (isset($_GET['error'])): ?> //issetitu untuk mengecek ada tidaknya data
        <p style="color: red;">
            <?php 
            $error = $_GET['error'];
            if ($error === 'salah') { 
                echo 'NIM atau Password kamu salah';
            } elseif ($error === 'kosong') {
                echo 'NIM dan Password tidak boleh kosong';
            } 
            ?>
        </p>
    <?php endif ?>
    
    <?php if(isset($_GET['sukses'])): ?>
        <p style="color: green;">Akun berhasil dibuat! Silahkan lakukan login</p>
    <?php endif; ?>

     <form method="POST" action="proses_login.php">
        <label>NIM</label><br>
        <input type="text" name="nim" placeholder="Masukan NIM"><br><br>
        <label>Password</label><br>
        <input type="password" name="password" placeholder="Masukkan Password"><br><br>
        <button type="submit">LOGIN</button>
     </form>
    <br>
    <P>Belum memiliki akun? <a href="daftar.php">Daftar disini</a></P>

</body>
</html>