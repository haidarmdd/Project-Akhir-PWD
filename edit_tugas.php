<!DOCTYPE html>
<?php
session_start();
include '01_koneksi_db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul    = $_POST['judul'];
    $matkul   = $_POST['mata_kuliah'];
    $jenis    = $_POST['jenis'];
    $tgl      = $_POST['tanggal'];
    $status   = $_POST['status'];
    $semester = $_POST['semester'];

    $sql = "UPDATE deadlines SET judul='$judul', mata_kuliah='$matkul', jenis='$jenis', tanggal_deadline='$tgl', status='$status', semester='$semester' WHERE id='$id'";

    if ($konek->query($sql)) {
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Gagal update: " . $konek->error;
    }
}

$sql    = "SELECT * FROM deadlines WHERE id='$id'";
$result = $konek->query($sql);
$data   = $result->fetch_assoc();
?>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Deadline - DeadlineKu</title>
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
        <h1 class="page-title">Edit Deadline</h1>
        <p class="page-subtitle">Ubah informasi deadline di bawah ini</p>

        <?php if (isset($error)): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="form-card">
            <form method="POST">
                <div class="form-group">
                    <label class="form-label">Judul Tugas / Deadline</label>
                    <input type="text" name="judul" class="form-input" value="<?php echo $data['judul']; ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Mata Kuliah</label>
                    <input type="text" name="mata_kuliah" class="form-input" value="<?php echo $data['mata_kuliah']; ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Jenis</label>
                    <select name="jenis" class="form-select">
                        <option value="Tugas" <?php if($data['jenis']=='Tugas') echo 'selected'; ?>>Tugas</option>
                        <option value="Ujian" <?php if($data['jenis']=='Ujian') echo 'selected'; ?>>Ujian</option>
                        <option value="Praktikum" <?php if($data['jenis']=='Praktikum') echo 'selected'; ?>>Praktikum</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal Deadline</label>
                    <input type="date" name="tanggal" class="form-input" value="<?php echo $data['tanggal_deadline']; ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Semester</label>
                    <select name="semester" class="form-select">
                        <?php for($i=1; $i<=8; $i++): ?>
                        <option value="<?php echo $i; ?>" <?php if($data['semester']==$i) echo 'selected'; ?>>Semester <?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="belum" <?php if($data['status']=='belum') echo 'selected'; ?>>Belum Dikerjakan</option>
                        <option value="sedang" <?php if($data['status']=='sedang') echo 'selected'; ?>>Sedang Dikerjakan</option>
                        <option value="selesai" <?php if($data['status']=='selesai') echo 'selected'; ?>>Selesai</option>
                    </select>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="dashboard.php" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
