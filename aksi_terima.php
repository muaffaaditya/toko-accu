<?php
session_start();
include '../koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_pemesanan'];

    $query = "UPDATE pemesanan SET status_lanjutan='Selesai', pesanan_diterima=1 WHERE id_pemesanan='$id'";
    if (mysqli_query($conn, $query)) {
        $_SESSION['pesan'] = "Pesanan ditandai sebagai selesai.";
    } else {
        $_SESSION['pesan'] = "Gagal memperbarui status pesanan.";
    }
}

header('Location: ../pemesanan.php');
exit;
