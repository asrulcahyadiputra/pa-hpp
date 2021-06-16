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
			<button class="btn btn-primary" data-toggle="modal" data-target="#addEmployee"><i class="fas fa-plus"></i> Tambah Karyawan</button>
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
											<th>Nama Pegawai</th>
											<th>Alamat</th>
											<th>No Telepon</th>
											<th>Bidang</th>
											<th class="text-center">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 1;
										foreach ($all as $em) : ?>
											<tr>
												<td class="text-center"><?= $no++ ?></td>
												<td><?= $em->employee_id . ' - ' . $em->employee_name ?></td>
												<td><?= $em->employee_phone ?></td>
												<td><?= $em->employee_address ?></td>
												<td><?= $em->department ?></td>
												<td class="text-center">
													<button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#edit_employee<?= $em->employee_id ?>">Edit</button>

													<a href="<?= site_url('master/karyawan/deleted/' . $em->employee_id) ?>" onclick="return confirm('Data Akan dihapus, Apakah Anda Yakin ?')" class="btn btn-danger mb-2">Hapus</a>
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


<!-- Modal add a new customer -->
<div class="modal fade" id="addEmployee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Data Karyawan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= site_url('master/karyawan/add') ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="employee_name">Nama Karayawan</label>
						<input type="text" name="employee_name" class="form-control">
						<small class="text-danger"><?= form_error('employee_name') ?></small>
					</div>
					<div class="form-group">
						<label for="cus_phone">Bidang</label>
						<input type="text" name="department" id="department" class="form-control">
						<small class="text-danger"><?= form_error('department') ?></small>
					</div>
					<div class="form-group">
						<label for="cus_phone">No Telepon</label>
						<input type="text" name="employee_phone" id="employee_phone" class="form-control">
						<small class="text-danger"><?= form_error('employee_phone') ?></small>
					</div>
					<div class="form-group">
						<label for="cus_address">Alamat</label>
						<textarea name="employee_address" id="employee_address" cols="30" rows="10" class="form-control"></textarea>
						<small class="text-danger"><?= form_error('employee_address') ?></small>
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
<!-- end add a new customer modal -->
<?php foreach ($all as $kr) : ?>
	<!-- Modal edit  customer -->
	<div class="modal fade" id="edit_employee<?= $kr->employee_id ?>" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-krntered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Karyawan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?= site_url('master/karyawan/edit/' . $kr->employee_id) ?>" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label for="employee_name">Nama Karyawan</label>
							<input type="text" name="employee_name" id="employee_name" class="form-control" value="<?= $kr->employee_name ?>">
							<small class="text-danger"><?= form_error('employee_name') ?></small>
						</div>
						<div class="form-group">
							<label for="cus_phone">Bidang</label>
							<input type="text" name="department" id="department" value="<?= $kr->department ?>" class="form-control">
							<small class="text-danger"><?= form_error('department') ?></small>
						</div>
						<div class="form-group">
							<label for="employee_phone">No Telepon</label>
							<input type="text" name="employee_phone" id="employee_phone" class="form-control" value="<?= $kr->employee_phone ?>">
							<small class="text-danger"><?= form_error('employee_phone') ?></small>
						</div>
						<div class="form-group">
							<label for="employee_address">Alamat</label>
							<textarea name="employee_address" id="employee_address" cols="30" rows="10" class="form-control"><?= $kr->employee_address ?></textarea>
							<small class="text-danger"><?= form_error('employee_address') ?></small>
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
<!-- end edit employee modal -->
<?php $this->load->view('_partials/footer'); ?>