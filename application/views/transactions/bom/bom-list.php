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

		<div class="section-body" id="list-data">
			<button type="button" class="btn btn-primary" id="btn-pluss"><i class="fas fa-plus"></i> Buat <?= $title ?> Baru</button>
			<div class="row mt-4">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered table-hover" id="table-bom-list">
									<thead>
										<tr>
											<th style="width: 5%;">#</th>
											<th style="width: 15%;">Kode</th>
											<th>Keterangan</th>
											<th style="width: 20%;">Produk</th>
											<!-- <th class="no-content"></th> -->
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- BEGIN FORM ADD CONTENT -->
		<div class="section-body" id="form-create">
			<div class="row mt-4">
				<div class="col-md-6">
					<div class="text-left">
						<button type="button" class="btn btn-primary" id="btn-back"><i class="fa fa-arrow-left"></i> Kembali</button>
					</div>
					<div class="text-right">

					</div>
				</div>
			</div>
			<div class="row mt-4">
				<div class="col-12">

					<div class="card">
						<div class="card-header">
							<div class="card-title">
								<h5><i>Create Bill of Materials (BOM)</i></h5>
							</div>
						</div>
						<form action="<?= site_url("transaksi/bom/store/") ?>" method="POST" id="createBom" class="needs-validation" novalidate>
							<div class="card-body">
								<!-- form start -->
								<div class="row">
									<div class="col-4">
										<div class="form-group">
											<label for="trans_id">Kode BoM</label>
											<input type="text" name="trans_id" id="trans_id" class="form-control" value="AUTO" disabled>
										</div>
									</div>
									<div class="col-4">
										<div class="form-group">
											<label for="product_id">Produk</label>
											<select name="product_id" id="product_id" class="form-control" required>
												<option value="">-</option>
												<?php foreach ($products as $rowData) : ?>
													<option value="<?= $rowData['product_id'] ?>"><?= $rowData['product_id'] . ' ' . $rowData['product_name'] ?></option>
												<?php endforeach ?>
											</select>

										</div>
									</div>
									<div class="col-8">
										<label for="keterangan">Keterangan</label>
										<textarea name="description" id="keterangan" cols="30" rows="5" class="form-control" required></textarea>
									</div>
									<div class="col-12 mt-4">
										<div class="table-responsive">
											<table class="table table-bordered table-sm" id="tbl_posts">
												<thead>
													<tr>
														<th class="text-center">#</th>
														<th style="width: 70%;">Bahan Baku</th>
														<th>Qty</th>
														<th class="no-content"></th>
													</tr>
												</thead>

												<tbody id="tbl_posts_body" class="contents"> </tbody>

											</table>
											<a href="#" class="btn btn-secondary btn-sm btn-block add-record" data-added="0"><i class="fa fa-plus"></i> Tambah Baris</a>
										</div>
									</div>
								</div>

							</div>

							<div class="card-footer">
								<div class="text-right">
									<button type="button" class="btn btn-secondary" id="btn-cancel">Batal</button>
									<button type="submit" class="btn btn-primary" id="btn-submit">Simpan</button>
								</div>
							</div>
						</form>
						<!-- form end -->
					</div>
				</div>
			</div>
		</div>
		<!-- BEGIN FORM ADD CONTENT -->


	</section>
</div>

<div class="invisible">
	<table id="sample_table">
		<tr>
			<td class="text-center">
				<span class="sn"></span>
			</td>
			<td>
				<select name="material_id[]" class="form-control material_id" required>
					<option value="">-pilih bahan baku-</option>
					<?php foreach ($materials as $rowData) : ?>
						<option value="<?= $rowData['material_id'] ?>"><?= $rowData['material_id'] . ' ' . $rowData['material_name'] . ' [Satuan:' . $rowData['material_unit'] . ']' ?></option>
					<?php endforeach ?>
				</select>
			</td>
			<td>
				<input type="text" name="qty[]" class="form-control qty" value="1" required>
			</td>
			<td class="text-center" style="vertical-align: middle;">
				<a href="#" class="text-danger  btn-icon delete-record" data-id="0">
					<i class="fa fa-trash-alt"></i>
				</a>
			</td>
		</tr>
	</table>
</div>
<?php $this->load->view('transactions/bom/script'); ?>