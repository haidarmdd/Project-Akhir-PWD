<!DOCTYPE html>
<?php
session_start();
include '01_koneksi_db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$nama    = $_SESSION['nama'];

// Ambil semua deadline milik user
$query  = "SELECT * FROM deadlines WHERE user_id = '$user_id' ORDER BY tanggal_deadline ASC";
$result = $konek->query($query);

// Hitung statistik
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

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="navbar-brand">Deadline<span>Ku</span></div>
        <div class="navbar-menu">
            <div class="navbar-user">Halo, <span><?php echo $nama; ?></span></div>
            <a href="logout.php" class="btn btn-secondary btn-sm">Logout</a>
        </div>
    </nav>

    <div class="container">

        <!-- PAGE HEADER -->
        <div class="dashboard-header">
            <div>
                <h1 class="page-title">Dashboard</h1>
                <p class="page-subtitle">Pantau semua deadline akademik kamu</p>
            </div>
            <a href="tambah_tugas.php" class="btn btn-primary">+ Tambah Deadline</a>
        </div>

        <!-- STAT CARDS -->
        <div class="stats-grid">
            <div class="stat-card stat-total">
                <div class="stat-number"><?php echo $total; ?></div>
                <div class="stat-label">Total Deadline</div>
            </div>
            <div class="stat-card stat-belum">
                <div class="stat-number"><?php echo $belum; ?></div>
                <div class="stat-label">Belum Dikerjakan</div>
            </div>
            <div class="stat-card stat-sedang">
                <div class="stat-number"><?php echo $sedang; ?></div>
                <div class="stat-label">Sedang Dikerjakan</div>
            </div>
            <div class="stat-card stat-selesai">
                <div class="stat-number"><?php echo $selesai; ?></div>
                <div class="stat-label">Selesai</div>
            </div>
        </div>

        <!-- TABEL DEADLINE -->
        <div class="table-wrapper">
            <div class="table-header">
                <span class="table-title">Daftar Deadline</span>
            </div>
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
                    while ($row = $result->fetch_assoc()):
                        $status = $row['status'];
                        if ($status != 'selesai' && $row['tanggal_deadline'] < $hari_ini) {
                            $status_label = 'terlewat';
                        } else {
                            $status_label = $status;
                        }
                        $jenis_lower = strtolower($row['jenis']);
                    ?>
                    <tr>
                        <td class="td-no"><?php echo $no++; ?></td>
                        <td class="judul"><?php echo $row['judul']; ?></td>
                        <td><?php echo $row['mata_kuliah']; ?></td>
                        <td><span class="badge badge-<?php echo $jenis_lower; ?>"><?php echo $row['jenis']; ?></span></td>
                        <td><?php echo date('d M Y', strtotime($row['tanggal_deadline'])); ?></td>
                        <td><span class="badge badge-<?php echo $status_label; ?>"><?php echo strtoupper($status_label); ?></span></td>
                        <td>
                            <div class="action-group">
                                <a href="edit_tugas.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary btn-sm">Edit</a>
                                <a href="hapus_tugas.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus deadline ini?')">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>

                    <?php if ($total == 0): ?>
                    <tr class="empty-row">
                        <td colspan="7">Belum ada deadline. Yuk tambah deadline pertamamu!</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>
