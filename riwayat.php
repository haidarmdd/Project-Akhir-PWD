<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once '01_koneksi_db.php';

$user_id = $_SESSION['user_id'];
$nama    = $_SESSION['nama'] ?? 'Pengguna';

// Kolom DB: id, user_id, judul, mata_kuliah, jenis, tanggal_deadline, status, file_tugas, semester, created_at
// Status enum: 'belum', 'sedang', 'selesai'
$sql = "SELECT * FROM deadlines 
        WHERE user_id = ? AND status = 'selesai' 
        ORDER BY semester ASC, tanggal_deadline ASC";
$stmt = $konek->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$semua_tugas  = [];
$per_semester = [];

while ($row = $result->fetch_assoc()) {
    $semua_tugas[] = $row;
    $sem = $row['semester'] ?? 'Lainnya';
    $per_semester[$sem][] = $row;
}

$total_selesai  = count($semua_tugas);
$total_semester = count($per_semester);
ksort($per_semester);

$semester_keys  = array_keys($per_semester);
$semester_aktif = isset($_GET['semester']) ? $_GET['semester'] : ($semester_keys[0] ?? '');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Tugas - DeadlineKu</title>
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
            Halo, <span><?= htmlspecialchars($nama) ?></span>
        </div>

        <!-- MENU DASHBOARD -->
        <a href="dashboard.php" 
           class="tombol tombol-sekunder tombol-kecil">
           Dashboard
        </a>

        <!-- RIWAYAT AKTIF -->
        <a href="riwayat.php" 
           class="tombol tombol-utama tombol-kecil">
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

    <!-- HEADER -->
    <div class="header-dashboard">
        <div>
            <h1 class="judul-halaman">Riwayat Tugas Selesai</h1>
            <p class="subjudul-halaman">Semua tugas yang telah kamu selesaikan</p>
        </div>
        <a href="dashboard.php" class="tombol tombol-sekunder">&#8592; Kembali ke Dashboard</a>
    </div>

    <!-- STATISTIK -->
    <div class="grid-statistik">
        <div class="kartu-statistik stat-selesai">
            <div class="angka-statistik"><?= $total_selesai ?></div>
            <div class="label-statistik">Total Selesai</div>
        </div>
        <div class="kartu-statistik stat-total">
            <div class="angka-statistik"><?= $total_semester ?></div>
            <div class="label-statistik">Semester Tercatat</div>
        </div>
        <?php foreach ($per_semester as $sem => $tugas_sem): ?>
        <div class="kartu-statistik stat-sedang">
            <div class="angka-statistik"><?= count($tugas_sem) ?></div>
            <div class="label-statistik">Semester <?= htmlspecialchars($sem) ?></div>
        </div>
        <?php endforeach; ?>
    </div>

    <?php if (!empty($per_semester)): ?>

    <!-- TAB SEMESTER -->
    <div class="tab-semester">
        <?php foreach ($semester_keys as $sem): ?>
        <a href="?semester=<?= urlencode($sem) ?>"
           class="tab-item <?= $sem == $semester_aktif ? 'tab-aktif' : '' ?>">
            Semester <?= htmlspecialchars($sem) ?>
            <span class="tab-badge"><?= count($per_semester[$sem]) ?> tugas</span>
        </a>
        <?php endforeach; ?>
    </div>

    <!-- TABEL RIWAYAT -->
    <div class="pembungkus-tabel">
        <div class="header-tabel">
            <span class="judul-tabel">
                Semester <?= htmlspecialchars($semester_aktif) ?> &mdash;
                <?= count($per_semester[$semester_aktif] ?? []) ?> tugas selesai
            </span>
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
                        <th>File Tugas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tugas_tampil = $per_semester[$semester_aktif] ?? [];
                    if (empty($tugas_tampil)):
                    ?>
                    <tr class="baris-kosong">
                        <td colspan="6">Tidak ada tugas selesai di semester ini.</td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($tugas_tampil as $i => $t): ?>
                    <tr>
                        <td class="td-nomor"><?= $i + 1 ?></td>
                        <td class="judul"><?= htmlspecialchars($t['judul']) ?></td>
                        <td><?= htmlspecialchars($t['mata_kuliah']) ?></td>
                        <td>
                            <?php
                            $jenis       = $t['jenis'];
                            $kelas_badge = 'lencana-tugas';
                            if ($jenis === 'Ujian')         $kelas_badge = 'lencana-ujian';
                            elseif ($jenis === 'Praktikum') $kelas_badge = 'lencana-praktikum';
                            ?>
                            <span class="lencana <?= $kelas_badge ?>">
                                <?= htmlspecialchars($jenis) ?>
                            </span>
                        </td>
                        <td>
                            <?php
                            $tgl = $t['tanggal_deadline'] ?? '';
                            echo $tgl
                                ? date('d M Y', strtotime($tgl))
                                : '<span style="color:#4b5563">&#8212;</span>';
                            ?>
                        </td>
                        <td>
                            <?php if (!empty($t['file_tugas'])): ?>
                                <a href="uploads/<?= htmlspecialchars($t['file_tugas']) ?>"
                                   target="_blank"
                                   class="tombol tombol-sekunder tombol-kecil">
                                   &#128206; Lihat File
                                </a>
                            <?php else: ?>
                                <span style="color:#4b5563;font-size:12px">Tidak ada</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php else: ?>
    <!-- KOSONG -->
    <div class="pembungkus-tabel">
        <div class="baris-kosong">
            <p style="text-align:center;padding:60px 20px;color:#4b5563;margin:0">
                Belum ada riwayat tugas &#127919;
            </p>
        </div>
    </div>
    <?php endif; ?>

</div>

</body>
</html>
