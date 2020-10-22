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
				<div class="breadcrumb-item">Data Master</div>
				<div class="breadcrumb-item"><?= $title ?></div>
			</div>
		</div>

		<div class="section-body">
			<button class="btn btn-primary" data-toggle="modal" data-target="#addProduct"><i class="fas fa-plus"></i> Buat Produk Baru</button>
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
											<th class="text-center">
												#
											</th>
											<th>Nama Produk</th>
											<th>Unit</th>
											<th>Harga /Unit</th>
											<th>Kategori</th>
											<th class="text-center">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 1;
										foreach ($all as $pr) : ?>
											<tr>
												<td class="text-center"><?= $no++ ?></td>
												<td><?= $pr->product_id . ' - ' . $pr->product_name ?></td>
												<td><?= $pr->product_unit ?></td>
												<td><?= nominal2($pr->sales_price) ?></td>
												<td><?= $pr->product_category ?></td>
												<td class="text-center">
													<button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#edit_product<?= $pr->product_id ?>">Edit</button>

													<a href="<?= site_url('master/produk/deleted/' . $pr->product_id) ?>" onclick="return confirm('Data Akan dihapus, Apakah Anda Yakin ?')" class="btn btn-danger mb-2">Hapus</a>
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


<!-- Modal add a new product -->
<div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Buat Produk Baru</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= site_url('master/produk/add') ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="product_name">Nama Produk</label>
						<input type="text" name="product_name" value="<?= set_value('product_name') ?>" id="product_name" class="form-control">
						<small class="text-danger"><?= form_error('product_name') ?></small>
					</div>
					<div class="form-group">
						<label for="product_unit">Unit</label>
						<input type="text" name="product_unit" value="<?= set_value('product_unit') ?>" id="product_unit" class="form-control">
						<small class="text-danger"><?= form_error('product_unit') ?></small>
					</div>
					<div class="form-group">
						<label for="sales_price">Harga Jual</label>
						<input type="text" name="sales_price" value="<?= set_value('sales_price') ?>" id="sales_price" class="form-control" data-type="currency">
						<small class="text-danger"><?= form_error('sales_price') ?></small>
					</div>
					<div class="form-group">
						<label for="product_categori">Kategori Produk</label>
						<input type="text" name="product_category" value="<?= set_value('product_category') ?>" id="product_category" class="form-control">
						<small class="text-danger"><?= form_error('product_category') ?></small>
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
<!-- end add a new product modal -->
<?php foreach ($all as $ep) : ?>
	<!-- Modal edit  customer -->
	<div class="modal fade" id="edit_product<?= $ep->product_id ?>" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Produk</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?= site_url('master/produk/edit/' . $ep->product_id) ?>" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label for="product_name">Nama Produk</label>
							<input type="text" name="product_name" id="product_name" class="form-control" value="<?= $ep->product_name ?>">
							<small class="text-danger"><?= form_error('product_name') ?></small>
						</div>
						<div class="form-group">
							<label for="product_unit">Unit</label>
							<input type="text" name="product_unit" id="product_unit" class="form-control" value="<?= $ep->product_unit ?>">
							<small class="text-danger"><?= form_error('product_unit') ?></small>
						</div>
						<div class="form-group">
							<label for="sales_price">Harga Jual</label>
							<input type="text" name="sales_price" id="sales_price" class="form-control" data-type="currency" value="<?= nominal2($ep->sales_price) ?>">
							<small class="text-danger"><?= form_error('sales_price') ?></small>
						</div>
						<div class="form-group">
							<label for="product_category">Harga Jual</label>
							<input type="text" name="product_category" id="product_category" class="form-control" value="<?= $ep->product_category ?>">
							<small class="text-danger"><?= form_error('product_category') ?></small>
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary">Simpan Perubahan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endforeach ?>
<!-- end edit customer modal -->
<?php $this->load->view('_partials/footer'); ?>
