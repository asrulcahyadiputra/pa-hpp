<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1><?= $title ?></h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="<?= site_url('Dashboard') ?>">Dashboard</a></div>
				<div class="breadcrumb-item">Transaksi</div>
				<div class="breadcrumb-item"><?= $title ?></div>
			</div>
		</div>

		<div class="section-body">
			<button class="btn btn-primary" data-toggle="modal" data-target="#newOrder"><i class="fas fa-plus"></i> Buat <?= $title ?> Baru</button>
			<?php if ($this->session->flashdata('success')) : ?>
				<div class="alert alert-success alert-dismissible fade show mt-3 col-md-4" role="alert">
					<strong>Berhasil !</strong> <?= $this->session->flashdata('success') ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php endif ?>
			<?php if ($this->session->flashdata('error')) : ?>
				<div class="alert alert-danger alert-dismissible fade show mt-3 col-md-4" role="alert">
					<strong>Gagal !</strong> <?= $this->session->flashdata('error') ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php endif ?>
			<?php if ($this->session->flashdata('warning')) : ?>
				<div class="alert alert-warning alert-dismissible fade show mt-3 col-md-4" role="alert">
					<strong>Peringatan !</strong> <?= $this->session->flashdata('warning') ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php endif ?>
			<div class="row mt-4">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped" id="table-1">
									<thead>
										<tr>
											<th>#</th>
											<th>Kode Pesanan</th>
											<th>Tanggal</th>
											<th>Pelanggan</th>
											<th>Produk</th>
											<th class="text-center">Qty</th>
											<th class="text-right">Total</th>
											<th>Status</th>
											<th class="no-content"></th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 1;
										foreach ($all as $row) : ?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?= $row['trans_id'] ?></td>
												<td><?= date('d-m-Y', strtotime($row['trans_date'])) ?></td>
												<td><?= $row['cus_name'] ?></td>
												<td><?= $row['product_name'] ?></td>
												<td class="text-center"><?= $row['order_qty'] . ' ' . $row['product_unit'] ?></td>
												<td class="text-right"><?= nominal($row['order_qty'] * $row['order_price']) ?></td>
												<td>
													<?php if ($row['status'] == 0) : ?>
														<span class="text-warning"><i class="fa fa-lock-open"></i> Belum Produksi</span>
													<?php endif ?>
													<?php if ($row['status'] == 1) : ?>
														<span class="text-primary"><i class="fa fa-lock"></i> <i class="fa fa-clock"></i> Proses Produksi</span>
													<?php endif ?>
													<?php if ($row['status'] == 2) : ?>
														<span class="text-success"><i class="fa fa-lock"></i> <i class="fa fa-check"></i>Selesai Produksi</span>
													<?php endif ?>
												</td>
												<td class="text-center">
													<a href="<?= site_url('transaksi/pesanan/delete/' . $row['trans_id']) ?>" onclick="return confirm('Semua Data terkait transaksi ini akan hilang. Apakah anda yakin ?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
												</td>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<!-- Modal add a new order -->
<div class="modal fade" id="newOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Buat <?= $title ?> Baru</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= site_url('transaksi/pesanan/add') ?>" method="POST" class="needs-validation" novalidate>
				<div class="modal-body">
					<div class="form-group">
						<label for="cus_name">Pilih Pelanggan</label>
						<select name="customer_id" id="customer_id" class="form-control" required>
							<option value="">-pilih pelanggan-</option>
							<?php foreach ($customers as $cs) : ?>
								<option value="<?= $cs['customer_id'] ?>"><?= $cs['customer_id'] . ' ' . $cs['cus_name'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label for="cus_phone">Pilih Produk</label>
						<select name="product_id" id="product_id" class="form-control" required>
							<option value="">-pilih produk-</option>
							<?php foreach ($product as $pr) : ?>
								<option value="<?= $pr['product_id'] ?>"><?= $pr['product_id'] . ' ' . $pr['product_name'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label for="cus_email">Qty</label>
						<input type="number" name="order_qty" value="" id="order_qty" min="1" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="cus_email">Harga Satuan</label>
						<input type="text" name="order_price" value="" id="order_price" class="form-control" readonly>
					</div>
					<div class="form-group">
						<label for="cus_email">Pembayaran</label>
						<input type="text" name="sales_payment" value="" id="sales_payment" data-type="currency" class="form-control" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>


<script>
	// Example starter JavaScript for disabling form submissions if there are invalid fields
	(function() {
		'use strict';
		window.addEventListener('load', function() {
			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			var forms = document.getElementsByClassName('needs-validation');
			// Loop over them and prevent submission
			var validation = Array.prototype.filter.call(forms, function(form) {
				form.addEventListener('submit', function(event) {
					if (form.checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					}
					form.classList.add('was-validated');
				}, false);
			});
		}, false);
	})();
</script>
<?php $this->load->view('_partials/footer'); ?>
