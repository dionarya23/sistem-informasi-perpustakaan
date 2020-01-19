<?php

include './config/koneksi.php';
session_start();
$id_anggota = $_GET['id_anggota'];
$query = "DELETE FROm anggota where id_anggota=$id_anggota";

$result = mysqli_query($koneksi, $query);

if ($result) {
    $_SESSION['message_hapus'] = "success";
    header("location:anggota.php");
}else{
    $_SESSION['message_hapus_failed'] = "success";
    header("location:anggota.php");
}