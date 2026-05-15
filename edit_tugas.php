<!DOCTYPE html>
<?php
// Mulai sesi dan cek login
session_start();
include '01_koneksi_db.php';

// Jika belum login, arahkan ke halaman login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Ambil ID deadline dari parameter URL
$id = $_GET['id'];

// Proses pembaruan data jika formulir dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul    = $_POST['judul'];
    $matkul   = $_POST['mata_kuliah'];
    $jenis    = $_POST['jenis'];
    $tgl      = $_POST['tanggal'];
    $status   = $_POST['status'];
    $semester = $_POST['semester'];

    // Perbarui data deadline di database
    $sql = "UPDATE deadlines SET judul='$judul', mata_kuliah='$matkul', jenis='$jenis', tanggal_deadline='$tgl', status='$status', semester='$semester' WHERE id='$id'";

    if ($konek->query($sql)) {
        // Jika berhasil, kembali ke dashboard
        header("Location: dashboard.php");
        exit;
    } else {
        $pesan_error = "Gagal memperbarui data: " . $konek->error;
    }
}

// Ambil data lama dari database untuk ditampilkan di formulir
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

    <!-- BILAH NAVIGASI -->
    <nav class="navbar">
        <div class="navbar-brand">Deadline<span>Ku</span></div>
        <div class="navbar-menu">
            <a href="dashboard.php" class="tombol tombol-sekunder tombol-kecil">← Kembali</a>
        </div>
    </nav>

    <div class="wadah">
        <h1 class="judul-halaman">Edit Deadline</h1>
        <p class="subjudul-halaman">Ubah informasi deadline di bawah ini</p>

        <!-- Tampilkan pesan error jika pembaruan gagal -->
        <?php if (isset($pesan_error)): ?>
            <div class="peringatan peringatan-error"><?php echo $pesan_error; ?></div>
        <?php endif; ?>

        <div class="kartu-formulir">
            <form method="POST">
                <div class="grup-formulir">
                    <label class="label-formulir">Judul Tugas / Deadline</label>
                    <input type="text" name="judul" class="input-formulir" value="<?php echo $data['judul']; ?>" required>
                </div>
                <div class="grup-formulir">
                    <label class="label-formulir">Mata Kuliah</label>
                    <input type="text" name="mata_kuliah" class="input-formulir" value="<?php echo $data['mata_kuliah']; ?>" required>
                </div>
                <div class="grup-formulir">
                    <label class="label-formulir">Jenis</label>
                    <select name="jenis" class="pilihan-formulir">
                        <option value="Tugas" <?php if($data['jenis']=='Tugas') echo 'selected'; ?>>Tugas</option>
                        <option value="Ujian" <?php if($data['jenis']=='Ujian') echo 'selected'; ?>>Ujian</option>
                        <option value="Praktikum" <?php if($data['jenis']=='Praktikum') echo 'selected'; ?>>Praktikum</option>
                    </select>
                </div>
                <div class="grup-formulir">
                    <label class="label-formulir">Tanggal Deadline</label>
                    <input type="date" name="tanggal" class="input-formulir" value="<?php echo $data['tanggal_deadline']; ?>" required>
                </div>
                <div class="grup-formulir">
                    <label class="label-formulir">Semester</label>
                    <select name="semester" class="pilihan-formulir">
                        <?php for($i=1; $i<=8; $i++): ?>
                        <option value="<?php echo $i; ?>" <?php if($data['semester']==$i) echo 'selected'; ?>>Semester <?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="grup-formulir">
                    <label class="label-formulir">Status</label>
                    <select name="status" class="pilihan-formulir">
                        <option value="belum" <?php if($data['status']=='belum') echo 'selected'; ?>>Belum Dikerjakan</option>
                        <option value="sedang" <?php if($data['status']=='sedang') echo 'selected'; ?>>Sedang Dikerjakan</option>
                        <option value="selesai" <?php if($data['status']=='selesai') echo 'selected'; ?>>Selesai</option>
                    </select>
                </div>
                <div class="aksi-formulir">
                    <button type="submit" class="tombol tombol-utama">Simpan Perubahan</button>
                    <a href="dashboard.php" class="tombol tombol-sekunder">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
