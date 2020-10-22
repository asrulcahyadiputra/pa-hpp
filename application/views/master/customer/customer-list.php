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
			<button class="btn btn-primary" data-toggle="modal" data-target="#addCustomer"><i class="fas fa-plus"></i> Buat Pelanggan Baru</button>
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
											<th>Nama Pelanggan</th>
											<th>Email</th>
											<th>No Telepon</th>
											<th>Alamat</th>
											<th class="text-center">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 1;
										foreach ($all as $cs) : ?>
											<tr>
												<td class="text-center"><?= $no++ ?></td>
												<td><?= $cs->customer_id . ' - ' . $cs->cus_name ?></td>
												<td><?= $cs->cus_email ?></td>
												<td><?= $cs->cus_phone ?></td>
												<td><?= $cs->cus_address ?></td>
												<td class="text-center">
													<a href="#addCustomer" data-toggle="modal" data-target="#editCustomer<?= $cs->customer_id ?>" class="btn btn-info">Edit</a>
													<a href="<?= site_url('master/customer/deleted/' . $cs->customer_id) ?>" class="btn btn-danger">Hapus</a>
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


<!-- Modal -->
<div class="modal fade" id="addCustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Buat Pelanggan Baru</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= site_url('master/pelanggan/add') ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="cus_name">Nama Pelanggan</label>
						<input type="text" name="cus_name" value="" id="cus_name" class="form-control">
						<small class="text-danger"><?= form_error('cus_name') ?></small>
					</div>
					<div class="form-group">
						<label for="cus_phone">No Telepon</label>
						<input type="text" name="cus_phone" value="" id="cus_phone" class="form-control">
						<small class="text-danger"><?= form_error('cus_phone') ?></small>
					</div>
					<div class="form-group">
						<label for="cus_email">Email</label>
						<input type="text" name="cus_email" value="" id="cus_email" class="form-control">
						<small class="text-danger"><?= form_error('cus_email') ?></small>
					</div>
					<div class="form-group">
						<label for="cus_address">Alamat</label>
						<textarea name="cus_address" id="cus_address" cols="30" rows="10" class="form-control"></textarea>
						<small class="text-danger"><?= form_error('cus_address') ?></small>
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
<?php $this->load->view('_partials/footer'); ?>
