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
			<button class="btn btn-primary" data-toggle="modal" data-target="#addMaterial"><i class="fas fa-plus"></i> Buat <?= $title ?> Baru</button>
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
											<th>Kode BOM</th>
											<th>Produk</th>
											<th>Tanggal Dibuat</th>
											<th>Status</th>
											<th class="no-content"></th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 1;
										foreach ($all as $bl) : ?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?= $bl['trans_id'] ?></td>
												<td><?= $bl['product_id'] . ' ' . $bl['product_name'] ?></td>
												<td><?= date('d-m-Y', strtotime($bl['date_created'])) ?></td>
												<td>
													<?php if ($bl['status'] == 0) : ?>
														<span class="text-success">Open</span>
													<?php endif ?>
													<?php if ($bl['status'] == 1) : ?>
														<span class="text-warning">Closed</span>
													<?php endif ?>
												</td>
												<td class="text-center">
													<a href="<?= site_url('transaksi/bom/show/' . $bl['trans_id']) ?>" class="btn btn-info btn-sm mr-2"><i class="fa fa-list"></i></a>
													<a href="<?= site_url('transaksi/bom/update/' . $bl['trans_id']) ?>" class="btn btn-warning btn-sm mr-2"><i class="fa fa-edit"></i></a>
													<a href="<?= site_url('transaksi/bom/delete/' . $bl['trans_id']) ?>" class="btn btn-danger btn-sm mr-2"><i class="fa fa-trash"></i></a>
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


<!-- Modal add a new BOM -->
<div class="modal fade" id="addMaterial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Buat <?= $title ?> Baru</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= site_url('transaksi/bom/draf') ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="material_name">Pilih Produk</label>
						<select name="product_id" id="product_id" class="form-control" required>
							<option value="">Pilih Produk...</option>
							<?php foreach ($product as $pr) : ?>
								<option value="<?= $pr['product_id'] ?>"><?= $pr['product_id'] . ' ' . $pr['product_name'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Lanjutkan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php $this->load->view('_partials/footer'); ?>