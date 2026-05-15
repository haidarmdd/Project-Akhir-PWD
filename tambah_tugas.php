<!DOCTYPE html>
<?php
session_start();
include '01_koneksi_db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id  = $_SESSION['user_id'];
    $judul    = $_POST['judul'];
    $matkul   = $_POST['mata_kuliah'];
    $jenis    = $_POST['jenis'];
    $tgl      = $_POST['tanggal'];
    $semester = $_POST['semester'];
    $status   = 'belum';

    $sql = "INSERT INTO deadlines (user_id, judul, mata_kuliah, jenis, tanggal_deadline, semester, status) 
            VALUES ('$user_id', '$judul', '$matkul', '$jenis', '$tgl', '$semester', '$status')";

    if ($konek->query($sql)) {
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Gagal menyimpan data: " . $konek->error;
    }
}
?>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Deadline - DeadlineKu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav class="navbar">
        <div class="navbar-brand">Deadline<span>Ku</span></div>
        <div class="navbar-menu">
            <a href="dashboard.php" class="btn btn-secondary btn-sm">← Kembali</a>
        </div>
    </nav>

    <div class="container">
        <h1 class="page-title">Tambah Deadline</h1>
        <p class="page-subtitle">Isi form di bawah untuk menambahkan deadline baru</p>

        <?php if (isset($error)): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="form-card">
            <form method="POST">
                <div class="form-group">
                    <label class="form-label">Judul Tugas / Deadline</label>
                    <input type="text" name="judul" class="form-input" placeholder="Contoh: UTS Pemrograman Web" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Mata Kuliah</label>
                    <input type="text" name="mata_kuliah" class="form-input" placeholder="Contoh: Pemweb Dasar" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Jenis</label>
                    <select name="jenis" class="form-select">
                        <option value="Tugas">Tugas</option>
                        <option value="Ujian">Ujian</option>
                        <option value="Praktikum">Praktikum</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal Deadline</label>
                    <input type="date" name="tanggal" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Semester</label>
                    <select name="semester" class="form-select">
                        <option value="1">Semester 1</option>
                        <option value="2">Semester 2</option>
                        <option value="3">Semester 3</option>
                        <option value="4">Semester 4</option>
                        <option value="5">Semester 5</option>
                        <option value="6">Semester 6</option>
                        <option value="7">Semester 7</option>
                        <option value="8">Semester 8</option>
                    </select>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Simpan Deadline</button>
                    <a href="dashboard.php" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
