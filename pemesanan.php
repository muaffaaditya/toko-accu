<?php
$kode_cs = $_SESSION['kode_cs'] ?? '';
include 'header.php';
include 'koneksi/koneksi.php';

$query = mysqli_query($conn, "SELECT * FROM pemesanan WHERE kode_customer='$kode_cs' ORDER BY tanggal DESC");
?>

<style>
@media (max-width: 576px) {
    textarea {
        width: 100%;
        margin-bottom: 5px;
    }

    button {
        width: 100%;
        margin-top: 5px;
    }

    td, th {
        font-size: 14px;
        vertical-align: middle !important;
    }
}
.badge.bg-warning { background-color: #ffc107; color: #000; }
.badge.bg-primary { background-color: #0d6efd; }
.badge.bg-success { background-color: #198754; }
.badge.bg-danger { background-color: #dc3545; }
.badge.bg-info { background-color: #0dcaf0; }
.badge.bg-secondary { background-color: #6c757d; }
</style>

<div class="container">
	<h2 style="width: 100%; border-bottom: 6px solid #000000; padding-bottom: 10px;"><b>Pemesanan</b></h2>
	<div class="table-responsive">
        <table class="table table-striped table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Invoice</th>
                    <th>Nama Produk</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th>Status</th>
                    <th>Status Lanjutan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($query)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['invoice']) ?></td>
                        <td><?= htmlspecialchars($row['nama_produk']) ?></td>
                        <td><?= (int)$row['qty'] ?></td>
                        <td>Rp<?= number_format($row['harga'] * $row['qty']) ?></td>
                        <td>
                            <span class="badge bg-<?= 
                                $row['status'] === 'Diterima' ? 'success' : 
                                ($row['status'] === 'Ditolak' ? 'danger' : 'secondary') ?>">
                                <?= $row['status'] ?>
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-<?= 
                                $row['status_lanjutan'] === 'Diproses' ? 'warning' : 
                                ($row['status_lanjutan'] === 'Dikirim' ? 'primary' :
                                ($row['status_lanjutan'] === 'Selesai' ? 'success' :
                                ($row['status_lanjutan'] === 'Pembatalan Diterima' ? 'danger' :
                                ($row['status_lanjutan'] === 'Pembatalan Ditolak' ? 'info' : 'secondary')))) ?>">
                                <?= $row['status_lanjutan'] ?: '-' ?>
                            </span>
                        </td>
                        <td>
                            <?php if (
                                $row['status'] === 'Diterima' &&
                                $row['status_lanjutan'] === 'Dikirim' &&
                                !$row['pesanan_diterima']
                            ): ?>
                                <form method="POST" action="proses/aksi_terima.php">
                                    <input type="hidden" name="id_pemesanan" value="<?= $row['id_pemesanan'] ?>">
                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Konfirmasi bahwa barang telah diterima?')">Barang Diterima</button>
                                </form>
                            <?php elseif (
                                $row['status'] === 'Diterima' &&
                                $row['status_lanjutan'] === 'Diproses' &&
                                empty($row['alasan_batal'])
                            ): ?>
                                <form method="POST" action="proses/ajukan_batal.php">
                                    <input type="hidden" name="id_pemesanan" value="<?= $row['id_pemesanan'] ?>">
                                    <textarea name="alasan" class="form-control" placeholder="Alasan pembatalan..." required></textarea>
                                    <br>
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ajukan pembatalan?')">Ajukan Pembatalan</button>
                                </form>
                            <?php elseif (!empty($row['alasan_batal']) && !$row['status_lanjutan']): ?>
                                <span class="text-warning">Menunggu Konfirmasi Admin</span>
                            <?php elseif ($row['status_lanjutan'] === 'Pembatalan Diterima'): ?>
                                <span class="text-danger">Pembatalan Disetujui</span>
                            <?php elseif ($row['status_lanjutan'] === 'Pembatalan Ditolak'): ?>
                                <span class="text-info">Pembatalan Ditolak</span>
                            <?php elseif ($row['pesanan_diterima']): ?>
                                <span class="text-success">Selesai</span>
                            <?php else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
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
<?php include 'footer.php'; ?>
