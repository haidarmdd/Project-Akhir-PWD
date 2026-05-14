<?php
session_start();
include '01_konkesi_db.php';

$id = $_GET ['id'];

// Jika form disubmit (POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $judul = $_POST ['judul'];
    $matkul = $_POST ['mata_kuliah'];
    $jenis = $_POST ['jenis'];
    $tgl = $_POST ['tanggal'];
    $status = $_POST ['status'];

    $sql = "UPDATE deadlines SET judul='$judul', mata_kuliah='$matkul', jenis='$jenis', tanggal_deadline='$tgl', status='$status' WHERE id='$id'";

    if ($konek->query($sql)) {
        header("location: dashboard.php");
    } else {
        echo "Gagal update: " . $konek->error;
    }
}

// Jika belum submit, tampilkan data lama (GET)
$sql = "SELECT * FROM deadlines WHERE id='$id'";
$result = $konek->query($sql);
$data = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas</title>
</head>
<body>
    <h2>Edit Deadline</h2>
    <form method="POST">
        Judul: <input type="text" name="judul" value="<?php echo $data['judul']; ?>" required><br><br>
        Mata Kuliah: <input  type="text" name="mata_kuliah" value="<?php echo $data['mata_kuliah']; ?>" required><br><br>
        jenis:
        <select name="jenis">
            <option value="Tugas" <?php if($data['jenis']=='Tugas') echo 'selected'; ?>>Tugas</option>
            <option value="Ujian" <?php if($data['jenis']=='Ujian') echo 'selected'; ?>>Ujian</option>
            <option value="Praktikum" <?php if($data['jenis']=='Praktikum') echo 'selected'; ?>>Praktikum</option>
        </select><br><br>
        tanggal: <input type="date" name="tanggal" value="<?php echo $data['tanggal_deadline']; ?>" required><br><br>
        status:
        <select name="status">
            <option value="belum" <?php if($data['status']=='belum') echo 'selected'; ?>>belum</option>
            <option value="sedang" <?php if($data['status']=='sedang') echo 'selected'; ?>>sedang</option>
            <option value="selesai" <?php if($data['status']=='selesai') echo 'selected'; ?>>selesai</option>
        </select><br><br>
        <button type="submit">update</button>
    </form>
    <br>
    <a href="dashboard.php">Batal</a>
</body>
</html>