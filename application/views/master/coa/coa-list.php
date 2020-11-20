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
			<button class="btn btn-primary" data-toggle="modal" data-target="#addCoa"><i class="fas fa-plus"></i> Buat <?=$title?></button>
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
											<th><i>Chart of Account</i></th>
											<th>Saldo Normal</th>
											<th class="text-center">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php $no=1; foreach ($head as $h) : ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><b><?= $h['head_code'] . ' ' . $h['name'] ?></b></td>
											<td></td>
											<td></td>
										</tr>
										<?php foreach ($sub as $s) : ?>
											<?php if ($s['head_code'] == $h['head_code']) : ?>
												<tr>
													<td><?= $no++ ?></td>
													<td><b>&nbsp;&nbsp;&nbsp;<?= $s['sub_code'] . ' ' . $s['name'] ?></b></td>
													<td></td>
													<td></td>
												</tr>
											<?php foreach ($all as $row) : ?>
												<?php if ($s['sub_code'] == $row['sub_code']) : ?>
														<tr>
															<td><?= $no++ ?></td>
															<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?= $row['account_no'] . ' ' . $row['account_name'] ?></td>
															<td><?php
																if ($row['normal_balance'] == 'd') {
																	echo "Debet";
																} else {
																	echo "Kredit";
																}
																?></td>
															<td class="text-center">
																	<button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#editCoa<?= $row['account_no'] ?>">Edit</button>
																
															</td>
														</tr>
														<?php endif ?>
													<?php endforeach ?>
												<?php endif ?>
											<?php endforeach ?>
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


<!-- Modal add a new CoA -->
<div class="modal fade" id="addCoa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Buat Produk Baru</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('master/coa/add') ?>" method="POST" class="needs-validation" novalidate>
					<div class="modal-body">
						<div class="form-group">
							<label>Header CoA</label>
							<select name="sub_code" class="form-control" required>
								<option value="">-pilih header-</option>
								<?php foreach ($sub as $h) : ?>
									<option value="<?= $h['sub_code'] ?>"><?= $h['sub_code'] . ' ' . $h['name'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="form-group">
							<label>Nama CoA</label>
							<input type="text" class="form-control" name="account_name" required>
						</div>
						<div class="form-group">
							<label>Normal Balance</label><br>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="normal_balance" id="inlineRadio1" value="d" checked>
								<label class="form-check-label" for="inlineRadio1">Debet</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="normal_balance" id="inlineRadio2" value="k">
								<label class="form-check-label" for="inlineRadio2">Kredit</label>
							</div>
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
						<button type="sumbit" class="btn btn-primary">Tambahkan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- eedit coa -->
<?php foreach ($all as $row) : ?>
		<div class="modal fade" id="editCoa<?= $row['account_no'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Edit Cara Pembayaran</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="<?= site_url('master/coa/update') ?>" method="POST" class="needs-validation" novalidate>
						<div class="modal-body">
							<div class="form-group">
								<label>Kode CoA</label>
								<input type="text" value="<?= $row['account_no'] ?>" class="form-control" name="account_no" readonly>
							</div>
							<div class="form-group">
								<label>Nama CoA</label>
								<input type="text" class="form-control" value="<?= $row['account_name'] ?>" name="account_name" required>
							</div>
							<div class="form-group">
								<label>Normal Balance</label><br>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="normal_balance" id="inlineRadio1" value="d" <?= $row['normal_balance'] == 'd' ? 'checked' : '' ?>>
									<label class="form-check-label" for="inlineRadio1">Debet</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="normal_balance" id="inlineRadio2" value="k" <?= $row['normal_balance'] == 'k' ? 'checked' : '' ?>>
									<label class="form-check-label" for="inlineRadio2">Kredit</label>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
							<button type="sumbit" class="btn btn-primary">Simpan Perubahan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	<?php endforeach ?>

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
