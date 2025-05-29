<?php
include '../koneksi/koneksi.php';

$kode_produk = $_GET['produk'];
$kode_customer = $_GET['kd_cs'];
$qty = isset($_GET['jml']) ? $_GET['jml'] : 1;

// Ambil data produk
$produk = mysqli_query($conn, "SELECT * FROM produk_mobil WHERE kode_produk = '$kode_produk'");
$data = mysqli_fetch_assoc($produk);

$nama_produk = $data['nama'];
$harga = $data['harga'];

// Cek apakah produk sudah ada di keranjang
$cek = mysqli_query($conn, "SELECT * FROM keranjang WHERE kode_customer = '$kode_customer' AND kode_produk = '$kode_produk'");
if(mysqli_num_rows($cek) > 0){
    mysqli_query($conn, "UPDATE keranjang SET qty = qty + $qty WHERE kode_customer = '$kode_customer' AND kode_produk = '$kode_produk'");
} else {
    mysqli_query($conn, "INSERT INTO keranjang (kode_customer, kode_produk, nama_produk, qty, harga) VALUES ('$kode_customer', '$kode_produk', '$nama_produk', '$qty', '$harga')");
}

header("Location: ../keranjang.php");
?>
