<?php 
include 'header.php';
?>

<div class="container">
	<h2 style="width: 100%; border-bottom: 6px solid #000000; padding-bottom: 10px;"><b>Accu Mobil</b></h2>
	<div class="row">
		<?php 
		$result = mysqli_query($conn, "SELECT * FROM produk_mobil");
		while ($row = mysqli_fetch_assoc($result)) {
		?>
		<div class="col-sm-6 col-md-4">
			<div class="thumbnail product-box">
				<img src="image/produk/<?= $row['image']; ?>" class="img-responsive" alt="<?= $row['nama']; ?>">
				<div class="caption">
					<h3><?= $row['nama']; ?></h3>
					<h4>Rp.<?= number_format($row['harga']); ?></h4>
					<div class="row">
						<div class="col-md-6">
							<a href="detail_produk_mobil.php?produk_mobil=<?= $row['kode_produk']; ?>" class="btn btn-warning btn-block">Detail</a> 
						</div>
						<?php if(isset($_SESSION['kd_cs'])){ ?>
						<div class="col-md-6">
							<a href="proses/add_mobil.php?produk=<?= $row['kode_produk']; ?>&kd_cs=<?= $_SESSION['kd_cs']; ?>" class="btn btn-success btn-block">
								<i class="glyphicon glyphicon-shopping-cart"></i> Tambah
							</a>
						</div>
						<?php } else { ?>
						<div class="col-md-6">
							<a href="user_login.php" class="btn btn-success btn-block"><i class="glyphicon glyphicon-shopping-cart"></i> Tambah</a>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>
<br>
<?php include 'footer.php'; ?>

<style>
	/* Pastikan semua box produk punya tinggi seragam */
	.product-box {
		display: flex;
		flex-direction: column;
		justify-content: space-between;
		height: 100%;
		border: 3px solid #dcdcdc;
		padding: 10px;
		border-radius: 5px;
		transition: all 0.3s ease;
	}

	.thumbnail {
		height: 100%;
		display: flex;
		flex-direction: column;
		justify-content: space-between;
	}

	/* Gambar tetap proporsional dan tinggi seragam */
	.product-box img {
		width: 100%;
		height: 200px;
		object-fit: cover;
		border-radius: 4px;
	}

	.product-box .caption {
		flex-grow: 1;
		display: flex;
		flex-direction: column;
		justify-content: space-between;
	}

	.product-box .row {
		margin-top: auto;
	}

	/* Efek hover */
	.product-box:hover {
		box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
		transform: translateY(-5px);
		border-color: #bcbcbc;
	}

	.product-box:active {
		transform: translateY(2px);
		box-shadow: none;
	}
</style>
