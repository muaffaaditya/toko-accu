<?php 
include 'header.php';

$kd = mysqli_real_escape_string($conn, $_GET['kode_cs']);
$cs = mysqli_query($conn, "SELECT * FROM customer WHERE kode_customer = '$kd'");
$rows = mysqli_fetch_assoc($cs);

// Cek apakah keranjang kosong
$cek_keranjang = mysqli_query($conn, "SELECT * FROM keranjang WHERE kode_customer = '$kd'");
if (mysqli_num_rows($cek_keranjang) == 0) {
    echo "<script>alert('Keranjang kamu kosong. Silakan belanja dulu.'); window.location='keranjang.php';</script>";
    exit();
}
?>

<div class="container" style="padding-bottom: 200px">
	<h2 style="width: 100%; border-bottom: 4px solid #000000"><b>Checkout</b></h2>
	<div class="row">
		<div class="col-md-6">
			<h4>Daftar Pesanan</h4>
			<table class="table table-striped">
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Harga</th>
					<th>Qty</th>
					<th>Sub Total</th>
				</tr>
				<?php 
				$result = mysqli_query($conn, "SELECT * FROM keranjang WHERE kode_customer = '$kd'");
				$no = 1;
				$hasil = 0;
				while($row = mysqli_fetch_assoc($result)){
					?>
					<tr>
						<td><?= $no; ?></td>
						<td><?= $row['nama_produk']; ?></td>
						<td>Rp.<?= number_format($row['harga']); ?></td>
						<td><?= $row['qty']; ?></td>
						<td>Rp.<?= number_format($row['harga'] * $row['qty']);  ?></td>
					</tr>
					<?php 
					$total = $row['harga'] * $row['qty'];
					$hasil += $total;
					$no++;
				}
				?>
				<tr>
					<td colspan="5" style="text-align: right; font-weight: bold;">Grand Total = Rp<?= number_format($hasil); ?></td>
				</tr>
			</table>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 bg-success">
			<h5>Pastikan Pesanan Anda Sudah Benar</h5>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-6 bg-warning">
			<h5>Isi Form di bawah ini </h5>
		</div>
	</div>
	<br>

	<form action="proses/order.php" method="POST" id="checkoutForm" enctype="multipart/form-data">
		<input type="hidden" name="kode_cs" value="<?= $kd; ?>">
		<div class="form-group">
			<label for="nama">Nama</label>
			<input type="text" class="form-control" name="nama" value="<?= $rows['nama']; ?>" readonly>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Provinsi</label>
					<input type="text" class="form-control" name="prov" required>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Alamat</label>
					<input type="text" class="form-control" name="kota" required>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Kota</label>
					<input type="text" class="form-control" name="almt" required>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Kode Pos</label>
					<input type="text" class="form-control" name="kopos" required>
				</div>
			</div>
		</div>

		<hr>
		<h4>Pembayaran</h4>
		<p><strong>Pembayaran hanya melalui kode QR berikut:</strong></p>
		<img src="image/kode QR.png" alt="QR Pembayaran" style="width: 200px; border: 2px solid #000; margin-bottom: 10px;">
		
		<div class="form-group">
			<label for="bukti">Upload Bukti Pembayaran</label>
			<input type="file" name="bukti" id="bukti" class="form-control" accept="image/*" required>
		</div>

		<button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-shopping-cart"></i> Order Sekarang</button>
		<a href="keranjang.php" class="btn btn-danger">Cancel</a>
	</form>
</div>

<script>
document.getElementById("checkoutForm").addEventListener("submit", function(e) {
	const prov = document.querySelector("[name='prov']").value.trim();
	const kota = document.querySelector("[name='kota']").value.trim();
	const almt = document.querySelector("[name='almt']").value.trim();
	const kopos = document.querySelector("[name='kopos']").value.trim();
	const bukti = document.getElementById("bukti").files[0];

	if (!prov || !kota || !almt || !kopos || !bukti) {
		alert("Harap lengkapi semua data dan upload bukti pembayaran sebelum memesan.");
		e.preventDefault();
		return;
	}

	const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
	if (!allowedTypes.includes(bukti.type)) {
		alert("Hanya file gambar yang diizinkan (jpg, png, gif, webp)");
		e.preventDefault();
	}
});
</script>

<?php include 'footer.php'; ?>
