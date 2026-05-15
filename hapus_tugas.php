<?php
session_start();
include '01_koneksi_db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM deadlines WHERE id='$id'";
    $konek->query($sql);
}

header("location: dashboard.php");
?>