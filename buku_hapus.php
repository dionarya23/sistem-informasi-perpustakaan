<?php

include './config/koneksi.php';
session_start();
$id_buku = $_GET['id_buku'];
$query = "DELETE FROM buku where id_buku=$id_buku";

$result = mysqli_query($koneksi, $query);

if ($result) {
    $_SESSION['message_hapus'] = "success";
    header("location:buku.php");
}else{
    $_SESSION['message_hapus_failed'] = "success";
    header("location:buku.php");
}