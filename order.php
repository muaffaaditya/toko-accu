<?php
include '../koneksi/koneksi.php';

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$kode_cs  = $_POST['kode_cs'] ?? '';
$provinsi = $_POST['provinsi'] ?? '';
$kota     = $_POST['kota'] ?? '';
$alamat   = $_POST['alamat'] ?? '';
$kode_pos = $_POST['kode_pos'] ?? '';
$tanggal  = date('Y-m-d');
$status   = ""; // status awal: menunggu persetujuan admin
$status_lanjutan = ""; // belum ada tindakan lanjutan

// Upload bukti pembayaran
$nama_file = $_FILES['bukti']['name'];
$tmp_file  = $_FILES['bukti']['tmp_name'];
$folder    = "../bukti/";

if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
}

if (!empty($nama_file)) {
    $ext = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    if (!in_array($ext, $allowed_ext)) {
        die("Format file tidak diperbolehkan.");
    }

    if ($_FILES['bukti']['size'] > 2 * 1024 * 1024) {
        die("Ukuran file melebihi 2MB.");
    }

    $nama_file_baru = uniqid() . '.' . $ext;
    if (!move_uploaded_file($tmp_file, $folder . $nama_file_baru)) {
        die("Gagal upload bukti pembayaran.");
    }
} else {
    die("Bukti pembayaran belum diupload.");
}

$invoice = "INV" . date('YmdHis');

// Ambil produk dari keranjang
$keranjang = mysqli_query($conn, "SELECT * FROM keranjang WHERE kode_customer = '$kode_cs'");
if (!$keranjang) {
    die('Query error: ' . mysqli_error($conn));
}

$produk_ditemukan = false;
while ($row = mysqli_fetch_assoc($keranjang)) {
    $kode_produk = $row['kode_produk'];
    $qty         = $row['qty'];

    $produk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produk_mobil WHERE kode_produk = '$kode_produk'"))
           ?: mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produk_motor WHERE kode_produk = '$kode_produk'"));

    if (!$produk) continue;

    $produk_ditemukan = true;
    $nama_produk = $produk['nama'];
    $harga       = $produk['harga'];

    mysqli_query($conn, "INSERT INTO pemesanan (
        invoice, kode_customer, kode_produk, nama_produk, qty, harga, bukti_bayar, status, status_lanjutan, tanggal, provinsi, kota, alamat, kode_pos
    ) VALUES (
        '$invoice', '$kode_cs', '$kode_produk', '$nama_produk', '$qty', '$harga', '$nama_file_baru', '$status', '$status_lanjutan', '$tanggal', '$provinsi', '$kota', '$alamat', '$kode_pos'
    )");
}

if (!$produk_ditemukan) {
    die("Produk tidak ditemukan dalam keranjang.");
}

// Update alamat customer
mysqli_query($conn, "UPDATE customer SET 
    provinsi='$provinsi', kota='$kota', alamat='$alamat', kode_pos='$kode_pos' 
    WHERE kode_customer='$kode_cs'");

// Kosongkan keranjang
mysqli_query($conn, "DELETE FROM keranjang WHERE kode_customer='$kode_cs'");

header("Location: ../pemesanan.php");
exit();
?>
