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
			<button class="btn btn-primary" data-toggle="modal" data-target="#addMaterial"><i class="fas fa-plus"></i> Buat Bahan Baku Baru</button>
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
											<th class="text-center">#</th>
											<th>Nama Bahan Baku</th>
											<th>Unit</th>
											<!-- <th>Tersedia</th> -->
											<th>Harga Beli Terakhir</th>
											<th class="text-center">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 1;
										foreach ($all as $mt) : ?>
											<tr>
												<td class="text-center"><?= $no++ ?></td>
												<td><?= $mt->material_id . ' - ' . $mt->material_name ?></td>
												<td><?= $mt->material_unit ?></td>

												<td><?= $mt->type_name ?></td>
												<td class="text-center">
													<button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#edit_material<?= $mt->material_id ?>">Edit</button>
													<a href="<?= site_url('master/bahan_baku/deleted/' . $mt->material_id) ?>" onclick="return confirm('Data Akan dihapus, Apakah Anda Yakin ?')" class="btn btn-danger mb-2">Hapus</a>
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
<div class="modal fade" id="addMaterial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Buat Bahan Baku Baru</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= site_url('master/bahan_baku/add') ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="material_name">Nama Bahan Baku</label>
						<input type="text" name="material_name" value="<?= set_value('material_name') ?>" id="material_name" class="form-control">
						<small class="text-danger"><?= form_error('material_name') ?></small>
					</div>
					<div class="form-group">
						<label for="material_unit">Unit</label>
						<input type="text" name="material_unit" value="<?= set_value('material_unit') ?>" id="material_unit" class="form-control">
						<small class="text-danger"><?= form_error('material_unit') ?></small>
					</div>
					<div class="form-group">
						<label for="material_stock">Stok Awal</label>
						<input type="text" name="material_stock" value="<?= set_value('material_stock') ?>" id="material_stock" class="form-control">
						<small class="text-danger"><?= form_error('material_stock') ?></small>
					</div>
					<div class="form-group">
						<label for="material_stock">Jenis Bahan Baku</label>
						<select name="material_type" id="material_type" class="form-control">
							<option value="">-pilih-</option>
							<?php foreach ($type as $ty) : ?>
								<option value="<?= $ty->id ?>" <?= $ty->id == set_value('material_type') ? 'selected' : '' ?>><?= $ty->name ?></option>
							<?php endforeach ?>
						</select>
						<small class="text-danger"><?= form_error('material_type') ?></small>
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
<?php foreach ($all as $em) : ?>
	<!-- Modal edit  customer -->
	<div class="modal fade" id="edit_material<?= $em->material_id ?>" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Bahan Baku</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?= site_url('master/bahan_baku/edit/' . $em->material_id) ?>" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label for="material_name">Nama Bahan Baku</label>
							<input type="text" name="material_name" id="material_name" class="form-control" value="<?= $em->material_name ?>">
							<small class="text-danger"><?= form_error('material_name') ?></small>
						</div>
						<div class="form-group">
							<label for="material_unit">Unit</label>
							<input type="text" name="material_unit" id="material_unit" class="form-control" value="<?= $em->material_unit ?>">
							<small class="text-danger"><?= form_error('material_unit') ?></small>
						</div>
						<div class="form-group">
							<label for="material_stock">Jenis Bahan Baku</label>
							<select name="material_type" id="material_type" class="form-control">
								<option value="">-pilih-</option>
								<?php foreach ($type as $ty) : ?>
									<option value="<?= $ty->id ?>" <?= $ty->id == $em->type_id ? 'selected' : '' ?>><?= $ty->name ?></option>
								<?php endforeach ?>
							</select>
							<small class="text-danger"><?= form_error('material_type') ?></small>
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