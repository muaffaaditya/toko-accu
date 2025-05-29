<?php
session_start();
include '../koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_pemesanan'];
    $alasan = mysqli_real_escape_string($conn, $_POST['alasan']);

    $query = "UPDATE pemesanan SET alasan_batal='$alasan' WHERE id_pemesanan='$id'";
    if (mysqli_query($conn, $query)) {
        $_SESSION['pesan'] = "Permintaan pembatalan berhasil diajukan.";
    } else {
        $_SESSION['pesan'] = "Gagal mengajukan pembatalan.";
    }
}

header('Location: ../pemesanan.php');
exit;
