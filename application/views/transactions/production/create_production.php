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
						<div class="card-header">
							<h6 class="card-title">Cari Pesanan</h6>
						</div>
						<div class="card-body">
							<form method="POST" action="<?= site_url('transaksi/create') ?>" class="form-inline">
								<label class="sr-only" for="inlineFormInputName2">Name</label>
								<div class="input-group mb-2 mr-sm-2">
									<select name="id_transaksi" id="id_transaksi" class="form-control">
										<option value="">-pilih pesanan untuk dihitung--</option>
										<?php foreach ($orders as $or) : ?>
											<option value="<?= $or['trans_id'] ?>"><?= $or['trans_id'] . '-' . $or['cus_name'] . '-' . $or['product_name'] ?></option>
										<?php endforeach ?>
									</select>
								</div>
								<button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i></button>
							</form>
						</div>
					</div>
				</div>
				<div class="col-12 mt-2">
					<div class="card">
						<div class="card-header">
							<h6 class="card-title">Data Pesanan</h6>
						</div>
						<div class="card-body">
							<table class="table">
								<thead>
									<tr>
										<td style="width: 20%;">Tanggal</td>
										<td style="width: 1%;">:</td>
										<td><?= $order['trans_date'] ?></td>
										<td style="width: 20%;">Harga Satuan Produk</td>
										<td style="width: 1%;">:</td>
										<td><?= nominal($order['order_price']) ?></td>
									</tr>
									<tr>
										<td style="width: 20%;">Pelanggan</td>
										<td style="width: 1%;">:</td>
										<td><?= $order['cus_name'] ?></td>
										<td style="width: 20%;">Total Harga Pesanan</td>
										<td style="width: 1%;">:</td>
										<td><?= nominal($order['order_price'] * $order['order_qty']) ?></td>
									</tr>
									<tr>
										<td style="width: 20%;">Qty Pesanan</td>
										<td style="width: 1%;">:</td>
										<td><?= $order['order_qty'] . ' ' . $order['product_unit'] ?></td>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
				<div class="col-12 mt-2">
					<div class="card">
						<div class="card-header">
							<h6 class="card-title">Kebutuhan Bahan Baku & Bahan Penolong</h6>
						</div>
						<div class="card-body">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Nama Bahan Baku</th>
										<th>BOM</th>
										<th>Harga Satuan</th>
										<th>Total Kebutuhan</th>
										<th>Total Biaya</th>
										<th>Tipe Bahan</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									$bbb = 0;
									$bbp = 0;
									foreach ($bom as $b) : ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $b['material_id'] . ' ' . $b['material_name'] ?></td>
											<td><?= $b['qty'] . ' ' . $b['unit'] ?></td>
											<td><?= nominal($b['unit_price']) ?></td>
											<td><?= nominal1($b['qty'] * $order['order_qty']) . ' ' . $b['unit'] ?></td>
											<td><?= nominal(($b['qty'] * $order['order_qty']) * $b['unit_price']) ?></td>
											<td><?= $b['material_type'] ?></td>
										</tr>
										<?php
										if ($b['material_type'] == 'BBB') {
											$bbb = $bbb + (($b['qty'] * $order['order_qty']) * $b['unit_price']);
										} elseif ($b['material_type'] == 'BBP') {
											$bbp = $bbp + (($b['qty'] * $order['order_qty']) * $b['unit_price']);
										}
										?>
									<?php endforeach ?>
									<tr>
										<td colspan="5" class="text-right"><b>Total BBB</b></td>
										<td colspan="2"><?= nominal($bbb) ?></td>
									</tr>
									<tr>
										<td colspan="5" class="text-right"><b>Total BBP</b></td>
										<td colspan="2"><?= nominal($bbp) ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


<?php $this->load->view('_partials/footer'); ?>
