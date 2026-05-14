<?php
session_start();
include '01_koneksi_db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FORM deadlines WHERE id='$id'";
    $konek->query($sql);
}

header("location: 05_dasboard.php");
?>