<!DOCTYPE html>
<?php
    session_start();
    include '01_koneksi_db.php';

    // cek udah login atau belum
    if(!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }

    // ambil data user yang sedang pakai (login)
    $user_id    = $_SESSION['user_id'];
    $nama       = $_SESSION['nama'];

    // Akses database ambil data deadline milik user ini saja
    $query = "SELECT * FROM deadlines WHERE user_id = '$user_id' ORDER BY tanggal_deadline ASC";
    $result = $konek->query($query);
    ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasboard - DeadlineKu</title>
</head>
<body>

    <h2>Halo, <?php echo $nama; ?>!</h2>

    <!-- Menu Navigasi Sederhana -->
    
    <p>
        <a href="tambah_tugas.php">[+] Tambah Deadline</a>
        <a href="logout.php">[Logout]</a>
    </p>

    <hr>

    <h3>Daftar Deadline Kamu</h3>

    <!-- Menu Navigasi Sederhana -->
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
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
            // Perulangan & array, loop data dari DB
            $no =1;
            while ($row = $result->fetch_assoc()) {

                // Percabangan, logika penentuan status (terlewat atau tidak)
                $status_tampil = $row['status'];
                $hari_ini = date('Y-m-d');

                // Jika status belum selesai & tanggal deadline sudah lewat
                if ($row['status'] != 'selesai' && $row['tanggal_deadline'] < $hari_ini) {
                    $status_tampil = "TERLEWAT";
                }
            ?>

            <!-- Baris Tabel Dinamis -->
             <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['judul']; ?></td>
                <td><?php echo $row['mata_kuliah']; ?></td>
                <td><?php echo $row['jenis']; ?></td>
                <td><?php echo $row['tanggal_deadline']; ?></td>

                <!-- Tampilkan status dengan format teks biasa -->
                 <td><?php echo strtoupper($status_tampil); ?></td>

                 <td>
                    <!-- Link Edit dan Hapus -->
                     <a href="edit_tugas.php?id=<?php echo $row['id'] ?>">Edit</a>
                     <a href="hapus_tugas.php?id=<?php echo $row['id'] ?>" onclick="return confirm('yakin ingin menghapus?')">Hapus</a>
                 </td>
             </tr>

             <?php
            } // Ahir while loop
            ?>

            <!-- Jika data kosong -->
             <?php if ($result->num_rows == 0): ?>
             <tr>
                <td colspan="7" style="text-align:center;">Belum ada data deadline.</td>
             </tr>
             <?php endif; ?>
        </tbody>
    </table>


</body>
</html>