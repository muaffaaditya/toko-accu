<?php 
include 'header.php';
include 'koneksi/koneksi.php'; // pastikan koneksi disertakan

// Ambil nama file banner dari database
$q = mysqli_query($conn, "SELECT value FROM pengaturan WHERE nama = 'foto benner'");
$data = mysqli_fetch_assoc($q);
$banner = $data ? $data['value'] : 'foto benner.png'; // fallback ke default
?>

<!-- IMAGE -->
<div class="container-fluid" style="margin: 0;padding: 0;">
	<div class="image" style="margin-top: -21px">
		<img src="image/<?= htmlspecialchars($banner) ?>" style="width: 100%; height: 650px;">
	</div>
</div>
<br>
<br>

<!-- DESKRIPSI -->
<div class="container">
	<h4 class="text-center" style="font-family: arial; padding-top: 10px; padding-bottom: 10px; font-style: italic; line-height: 29px; border-top: 2px solid #000000; border-bottom: 2px solid #000000;">
	Toko Jaya Accu hadir untuk Anda! Beli aki mobil dan motor berkualitas secara online dengan mudah dan cepat. Pembayaran aman, pengiriman terpercaya, dan layanan pelanggan siap membantu Anda. Kunjungi website kami sekarang juga!
</div>
<br>
<br>
<br>
<br>
<?php 
include 'footer.php';
?>
