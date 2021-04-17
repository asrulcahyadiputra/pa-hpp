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
				<div class="breadcrumb-item"> Bill of Materials</div>
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
							<div class="card-title">
								<h5><i>Buat Bill of Materials (BOM) Baru</i></h5>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-6 mb-2">
									<table class="table table-sm">
										<tr>
											<td>Produk</td>
											<td style="width: 1%" class="text-center">:</td>
											<td><?= $product['product_id'] . ' ' . $product['product_name'] ?></td>
										</tr>
										<tr>
											<td>Harga Jual</td>
											<td style="width: 1%" class="text-center">:</td>
											<td><?= nominal($product['sales_price']) . ' /' . $product['product_unit'] ?></td>
										</tr>
									</table>
								</div>
							</div>
							<!-- form start -->
							<form action="" method="POST">
								<div class="row">
									<div class="col-12">
										<div class="accordion" id="accordionExample">
											<div class="card">
												<div class="card-header" id="headingOne">
													<h2 class="mb-0">
														<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
															#1 Bahan Baku
														</button>
													</h2>
												</div>

												<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
													<div class="card-body">
														<div class="table-responsive">
															<table class="table table-bordered table-sm table-striped" id="tbl_posts">
																<thead>
																	<tr>
																		<th class="text-center">#</th>
																		<th>Bahan Baku</th>
																		<th>Qty</th>
																		<th class="no-content"></th>
																	</tr>
																</thead>
																<tbody>
																<tbody id="tbl_posts_body" class="contents">

																</tbody>

																</tbody>
															</table>
															<a href="#" class="btn btn-secondary btn-sm btn-block add-record" data-added="0"><i class="fa fa-plus"></i> Tambah Baris</a>
														</div>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" id="headingTwo">
													<h2 class="mb-0">
														<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
															#2 Biaya Tenaga Kerja Langsung
														</button>
													</h2>
												</div>
												<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
													<div class="card-body">
														<div class="table-responsive">
															<table class="table table-bordered table-sm table-striped" id="tbl_posts_btkl">
																<thead>
																	<tr>
																		<th class="text-center">#</th>
																		<th>Karyawan</th>
																		<th>Nominal</th>
																		<th class="no-content"></th>
																	</tr>
																</thead>
																<tbody>
																<tbody id="tbl_posts_body_btkl" class="contents">

																</tbody>
															</table>
															<a href="#" class="btn btn-secondary btn-sm btn-block add-record-btkl" data-added="0"><i class="fa fa-plus"></i> Tambah Baris</a>
														</div>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" id="headingThree">
													<h2 class="mb-0">
														<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
															#3 Biaya Overhead Pabrik
														</button>
													</h2>
												</div>
												<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
													<div class="card-body">
														<div class="table-responsive">
															<table class="table table-bordered table-sm table-striped" id="tbl_posts_bop">
																<thead>
																	<tr>
																		<th class="text-center">#</th>
																		<th>Komponen Biaya</th>
																		<th>Nominal</th>
																		<th class="no-content"></th>
																	</tr>
																</thead>
																<tbody id="tbl_posts_body_bop" class="contents">

																</tbody>
															</table>
															<a href="#" class="btn btn-secondary btn-sm btn-block add-record-bop" data-added="0"><i class="fa fa-plus"></i> Tambah Baris</a>
														</div>
													</div>
												</div>
											</div>
										</div>

									</div>
								</div>
								<div class="row">
									<div class="col-6 mt-4 text-left">
										<a href="<?= site_url('transaksi/bom') ?>" class="btn btn-warning">Simpan Sebagai Draf</a>
									</div>
									<div class="col-6 mt-4 text-right">
										<button type="button" class="btn btn-success btn-submit" bom-id="<?= $trans_id ?>">Selesai & Simpan</button>

									</div>
								</div>
							</form>
							<!-- form end -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


<!-- invisible tag -->
<div class="invisible">
	<table id="sample_table">
		<tr>
			<td class="text-center">
				<span class="sn"></span>
			</td>
			<td>
				<select name="kd_bahan[]" class="form-control" required>
					<option value="">-pilih bahan baku-</option>
					<?php foreach ($materials as $rowData) : ?>
						<option value="<?= $rowData['material_id'] ?>"><?= $rowData['material_id'] . ' ' . $rowData['material_name'] . ' [Satuan:' . $rowData['material_unit'] . ']' ?></option>
					<?php endforeach ?>
				</select>
			</td>
			<td>
				<input type="number" name="qty[]" class="form-control" min="1" value="1" required>
			</td>
			<td class="text-center">
				<a href="#" class="text-danger  btn-icon delete-record" data-id="0">
					<i class="fa fa-trash-alt"></i>
				</a>
			</td>
		</tr>
	</table>
</div>

<div class="invisible">
	<table id="sample_table_btkl">
		<tr>
			<td class="text-center">
				<span class="sn"></span>
			</td>
			<td>
				<select name="employee_id[]" class="form-control" required>
					<option value="">-pilih karyawan-</option>
					<?php foreach ($materials as $rowData) : ?>
						<option value="<?= $rowData['material_id'] ?>"><?= $rowData['material_id'] . ' ' . $rowData['material_name'] . ' [Satuan:' . $rowData['material_unit'] . ']' ?></option>
					<?php endforeach ?>
				</select>
			</td>
			<td>
				<input type="number" name="cost[]" class="form-control" min="1" value="1" required>
			</td>
			<td class="text-center">
				<a href="#" class="text-danger  btn-icon delete-record-btkl" btkl-id="0">
					<i class="fa fa-trash-alt"></i>
				</a>
			</td>
		</tr>
	</table>
</div>

<div class="invisible">
	<table id="sample_table_bop">
		<tr>
			<td class="text-center">
				<span class="sn"></span>
			</td>
			<td>
				<select name="oc_id[]" class="form-control" required>
					<option value="">-pilih komponen-</option>
					<?php foreach ($materials as $rowData) : ?>
						<option value="<?= $rowData['material_id'] ?>"><?= $rowData['material_id'] . ' ' . $rowData['material_name'] . ' [Satuan:' . $rowData['material_unit'] . ']' ?></option>
					<?php endforeach ?>
				</select>
			</td>
			<td>
				<input type="number" name="overhead_cost[]" class="form-control" min="1" value="100" required>
			</td>
			<td class="text-center">
				<a href="#" class="text-danger  btn-icon delete-record-bop" bop-id="0">
					<i class="fa fa-trash-alt"></i>
				</a>
			</td>
		</tr>
	</table>
</div>

<!-- modal component -->

<!-- Modal -->
<div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-danger" id="exampleModalLabel">Oops!</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<?php $this->load->view('transactions/bom/script'); ?>