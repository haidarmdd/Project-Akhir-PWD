<!DOCTYPE html>
<?php
// Mulai sesi dan cek status login
session_start();
include '01_koneksi_db.php';

// Jika belum login, arahkan ke halaman login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Ambil data pengguna dari sesi
$user_id = $_SESSION['user_id'];
$nama    = $_SESSION['nama'];

// Ambil semua deadline milik pengguna, urutkan dari yang paling dekat
$query  = "SELECT * FROM deadlines WHERE user_id = '$user_id' ORDER BY tanggal_deadline ASC";
$result = $konek->query($query);

// Hitung jumlah tiap status untuk kartu statistik
$total   = $konek->query("SELECT COUNT(*) as n FROM deadlines WHERE user_id='$user_id'")->fetch_assoc()['n'];
$belum   = $konek->query("SELECT COUNT(*) as n FROM deadlines WHERE user_id='$user_id' AND status='belum'")->fetch_assoc()['n'];
$sedang  = $konek->query("SELECT COUNT(*) as n FROM deadlines WHERE user_id='$user_id' AND status='sedang'")->fetch_assoc()['n'];
$selesai = $konek->query("SELECT COUNT(*) as n FROM deadlines WHERE user_id='$user_id' AND status='selesai'")->fetch_assoc()['n'];
?>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - DeadlineKu</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>

<div class="lapisan-gelap"></div>

    <!-- NAVBAR -->
<nav class="navbar">

    <!-- LOGO -->
    <div class="navbar-brand">
        Deadline<span style="color: crimson;">Ku</span>
    </div>

    <!-- MENU -->
    <div class="navbar-menu">

        <!-- NAMA USER -->
        <div class="navbar-pengguna">
            Halo, <span><?php echo $nama; ?></span>
        </div>

        <!-- DASHBOARD AKTIF -->
        <a href="dashboard.php" 
           class="tombol tombol-utama tombol-kecil">
           Dashboard
        </a>

        <!-- MENU RIWAYAT -->
        <a href="riwayat.php" 
           class="tombol tombol-sekunder tombol-kecil">
           Riwayat
        </a>

        <!-- LOGOUT -->
        <a href="logout.php" 
           class="tombol tombol-bahaya tombol-kecil">
           Logout
        </a>

    </div>
</nav>

    <div class="wadah">

        <!-- JUDUL HALAMAN -->
        <div class="header-dashboard">
            <div>
                <h1 class="judul-halaman">Dashboard</h1>
                <p class="subjudul-halaman">Pantau semua deadline akademik kamu</p>
            </div>
            <a href="tambah_tugas.php" class="tombol tombol-utama">+ Tambah Deadline</a>
        </div>

        <!-- KARTU STATISTIK -->
        <div class="grid-statistik">
            <div class="kartu-statistik stat-total">
                <div class="angka-statistik"><?php echo $total; ?></div>
                <div class="label-statistik">Total Deadline</div>
            </div>
            <div class="kartu-statistik stat-belum">
                <div class="angka-statistik"><?php echo $belum; ?></div>
                <div class="label-statistik">Belum Dikerjakan</div>
            </div>
            <div class="kartu-statistik stat-sedang">
                <div class="angka-statistik"><?php echo $sedang; ?></div>
                <div class="label-statistik">Sedang Dikerjakan</div>
            </div>
            <div class="kartu-statistik stat-selesai">
                <div class="angka-statistik"><?php echo $selesai; ?></div>
                <div class="label-statistik">Selesai</div>
            </div>
        </div>

        <!-- TABEL DAFTAR DEADLINE -->
        <div class="pembungkus-tabel">
             <div class="header-tabel">
                <span class="judul-tabel">Daftar Deadline</span>
            </div>

            <div class="table-responsive">
                <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Mata Kuliah</th>
                        <th>Jenis</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $hari_ini = date('Y-m-d');
                    while ($baris = $result->fetch_assoc()):
                        // Tentukan status tampilan (cek apakah sudah terlewat)
                        $status = $baris['status'];
                        if ($status != 'selesai' && $baris['tanggal_deadline'] < $hari_ini) {
                            $label_status = 'terlewat';
                        } else {
                            $label_status = $status;
                        }
                        $jenis_kecil = strtolower($baris['jenis']);
                    ?>
                    <tr>
                        <td class="td-nomor"><?php echo $no++; ?></td>
                        <td class="judul"><?php echo $baris['judul']; ?></td>
                        <td><?php echo $baris['mata_kuliah']; ?></td>
                        <td><span class="lencana lencana-<?php echo $jenis_kecil; ?>"><?php echo $baris['jenis']; ?></span></td>
                        <td><?php echo date('d M Y', strtotime($baris['tanggal_deadline'])); ?></td>
                        <td><span class="lencana lencana-<?php echo $label_status; ?>"><?php echo strtoupper($label_status); ?></span></td>
                        <td>
                            <div class="grup-aksi">
                                <a href="edit_tugas.php?id=<?php echo $baris['id']; ?>" class="tombol tombol-sekunder tombol-kecil">Edit</a>
                                <a href="hapus_tugas.php?id=<?php echo $baris['id']; ?>" class="tombol tombol-bahaya tombol-kecil" onclick="return confirm('Yakin ingin menghapus deadline ini?')">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>

                    <!-- Tampilkan pesan jika belum ada data -->
                    <?php if ($total == 0): ?>
                    <tr class="baris-kosong">
                        <td colspan="7">Belum ada deadline. Yuk tambah deadline pertamamu!</td>
                    </tr>
                    <?php endif; ?>
                    </tbody>
                    </table>
                        </div>
                    </div>

    </div>
</body>
</html>
