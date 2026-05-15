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

// Proses penyimpanan data jika formulir dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id  = $_SESSION['user_id'];
    $judul    = $_POST['judul'];
    $matkul   = $_POST['mata_kuliah'];
    $jenis    = $_POST['jenis'];
    $tgl      = $_POST['tanggal'];
    $semester = $_POST['semester'];
    $status   = 'belum'; // Status awal selalu belum dikerjakan

    // Simpan deadline baru ke database
    $sql = "INSERT INTO deadlines (user_id, judul, mata_kuliah, jenis, tanggal_deadline, semester, status) 
            VALUES ('$user_id', '$judul', '$matkul', '$jenis', '$tgl', '$semester', '$status')";

    if ($konek->query($sql)) {
        // Jika berhasil, kembali ke dashboard
        header("Location: dashboard.php");
        exit;
    } else {
        $pesan_error = "Gagal menyimpan data: " . $konek->error;
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

    <!-- BILAH NAVIGASI -->
    <nav class="navbar">
        <div class="navbar-brand">Deadline<span>Ku</span></div>
        <div class="navbar-menu">
            <a href="dashboard.php" class="tombol tombol-sekunder tombol-kecil">← Kembali</a>
        </div>
    </nav>

    <div class="wadah">
        <h1 class="judul-halaman">Tambah Deadline</h1>
        <p class="subjudul-halaman">Isi formulir di bawah untuk menambahkan deadline baru</p>

        <!-- Tampilkan pesan error jika penyimpanan gagal -->
        <?php if (isset($pesan_error)): ?>
            <div class="peringatan peringatan-error"><?php echo $pesan_error; ?></div>
        <?php endif; ?>

        <div class="kartu-formulir">
            <form method="POST">
                <div class="grup-formulir">
                    <label class="label-formulir">Judul Tugas / Deadline</label>
                    <input type="text" name="judul" class="input-formulir" placeholder="Contoh: UTS Pemrograman Web" required>
                </div>
                <div class="grup-formulir">
                    <label class="label-formulir">Mata Kuliah</label>
                    <input type="text" name="mata_kuliah" class="input-formulir" placeholder="Contoh: Pemweb Dasar" required>
                </div>
                <div class="grup-formulir">
                    <label class="label-formulir">Jenis</label>
                    <select name="jenis" class="pilihan-formulir">
                        <option value="Tugas">Tugas</option>
                        <option value="Ujian">Ujian</option>
                        <option value="Praktikum">Praktikum</option>
                    </select>
                </div>
                <div class="grup-formulir">
                    <label class="label-formulir">Tanggal Deadline</label>
                    <input type="date" name="tanggal" class="input-formulir" required>
                </div>
                <div class="grup-formulir">
                    <label class="label-formulir">Semester</label>
                    <select name="semester" class="pilihan-formulir">
                        <?php for($i=1; $i<=8; $i++): ?>
                        <option value="<?php echo $i; ?>">Semester <?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="aksi-formulir">
                    <button type="submit" class="tombol tombol-utama">Simpan Deadline</button>
                    <a href="dashboard.php" class="tombol tombol-sekunder">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
