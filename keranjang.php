<?php 
include 'header.php';

if(isset($_POST['submit1'])){
	$id_keranjang = $_POST['id'];
	$qty = $_POST['qty'];
	$edit = mysqli_query($conn, "UPDATE keranjang SET qty = '$qty' WHERE id_keranjang = '$id_keranjang'");
	if($edit){
		echo "<script>alert('KERANJANG BERHASIL DIPERBARUI'); window.location = 'keranjang.php';</script>";
	}
} else if(isset($_GET['del'])){
	$id_keranjang = $_GET['id'];
	$del = mysqli_query($conn, "DELETE FROM keranjang WHERE id_keranjang = '$id_keranjang'");
	if($del){
		echo "<script>alert('1 PRODUK DIHAPUS'); window.location = 'keranjang.php';</script>";
	}
}
?>

<style>
@media (max-width: 576px) {
	input[type="number"] {
		width: 60px;
		margin: auto;
	}
	.btn {
		margin: 2px 0;
		width: 100%;
	}
}
</style>

<div class="container">
	<h2 style="width: 100%; border-bottom: 6px solid #000000; padding-bottom: 10px;"><b>Keranjang</b></h2>
	<div class="table-responsive">
	<table class="table table-striped table-bordered align-middle text-center">
	<?php 
	if(isset($_SESSION['kd_cs'])){
		$kode_cs = $_SESSION['kd_cs'];
		$cek = mysqli_query($conn, "SELECT * FROM keranjang WHERE kode_customer = '$kode_cs'");
		if(mysqli_num_rows($cek) > 0){
	?>
		<thead>
			<tr>
				<th>No</th><th>Nama</th><th>Harga</th><th>Qty</th><th>SubTotal</th><th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$no = 1; $hasil = 0;
			while($row = mysqli_fetch_assoc($cek)){
				$sub = $row['harga'] * $row['qty'];
				$hasil += $sub;
		?>
		<tr>
			<form method="POST" action="">
			<input type="hidden" name="id" value="<?= $row['id_keranjang']; ?>">
			<td><?= $no++; ?></td>
			<td><?= $row['nama_produk']; ?></td>
			<td>Rp.<?= number_format($row['harga']); ?></td>
			<td><input type="number" name="qty" class="form-control" value="<?= $row['qty']; ?>" style="text-align: center;"></td>
			<td>Rp.<?= number_format($sub); ?></td>
			<td>
				<button name="submit1" class="btn btn-warning">Update</button>
				<a href="keranjang.php?del=1&id=<?= $row['id_keranjang']; ?>" onclick="return confirm('Hapus produk ini?')" class="btn btn-danger">Delete</a>
			</td>
			</form>
		</tr>
		<?php } ?>
		<tr><td colspan="6" style="text-align: right;"><strong>Grand Total: Rp.<?= number_format($hasil); ?></strong></td></tr>
		<tr>
			<td colspan="6" style="text-align: right;">
				<a href="index.php" class="btn btn-success">Kembali</a> 
				<a href="checkout.php?kode_cs=<?= $kode_cs; ?>" class="btn btn-primary">Checkout</a>
			</td>
		</tr>
		<?php } else { ?>
		<tr><td colspan="6" class="text-center bg-warning"><h5><b>KERANJANG KOSONG</b></h5></td></tr>
		<?php }} else { ?>
		<tr><td colspan="6" class="text-center bg-danger"><h5><b>LOGIN TERLEBIH DAHULU</b></h5></td></tr>
		<?php } ?>
		</tbody>
	</table>
	</div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php include 'footer.php'; ?>
