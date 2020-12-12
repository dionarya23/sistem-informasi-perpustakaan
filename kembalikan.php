<?php

include './config/koneksi.php';
session_start();
$tgl_pengembalian = date('Y-m-d');
$id_peminjaman  = $_GET['id_peminjaman'];
$total_denda = $_GET['denda'];
$id_buku = $_GET['id_buku'];

$query_buku = "UPDATE buku SET status='Tersedia' WHERE id_buku=$id_buku";
mysqli_query($koneksi, $query_buku);

$query = "UPDATE peminjaman SET denda='$total_denda', tgl_pengembalian='$tgl_pengembalian' WHERE id_peminjaman=$id_peminjaman";
$result = mysqli_query($koneksi, $query);

if ($result) {
    $_SESSION['message'] = "success";
    header('location:pengembalian.php');
} else {
    $_SESSION['message_gagal'] = 'failure';
    header('location:pengembalian.php');
}