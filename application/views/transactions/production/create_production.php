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

		<div class="section-body" id="data-produksi">
			<div class="row mt-4">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h6 class="card-title">Form Produksi</h6>
						</div>
						<div class="card-body">
							<form id="form-bom" class="needs-validation" novalidate></form>
							<form method="POST" id='production-form' class="needs-validation" novalidate>
								<div class="row">
									<div class="col-4">
										<div class="form-group">
											<label for="kode_pesanan">Kode Pesanan</label>
											<select name="kode_pesanan" id="kode_pesanan" class="form-control" required>
												<option value="">-pilih pesanan untuk dihitung--</option>
												<?php foreach ($orders as $or) : ?>
													<option value="<?= $or['trans_id'] ?>"><?= $or['trans_id'] . '-' . $or['cus_name'] ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="col-4">
										<div class="form-group">
											<label for="tanggal">Tanggal Produksi</label>
											<input type="date" name="tanggal" id="tanggal" class="form-control" min="<?= date('Y-m-d') ?>" required>
										</div>
									</div>
									<div class="col-8">
										<div class="form-group">
											<label for="description">Keterangan</label>
											<textarea name="description" id="description" class="form-control" cols="30" rows="3" required></textarea>
										</div>
									</div>
								</div>


								<div class="row">
									<div class="col-12">
										<table class="table table-bordered table-sm" id="table-opsi-bom">
											<thead>
												<tr style="background-color: #4361ee; color: #fff">
													<th class="text-center" style="width:5%">No</th>
													<th>Kode</th>
													<th>Produk</th>
													<th>Ukuran</th>
													<th>Qty</th>
													<th>Bill of Material</th>
												</tr>
											</thead>
											<tbody>

											</tbody>
										</table>
									</div>
									<div class="col-12 mt-3">
										<button type="submit" form="form-bom" id="btn-load" class="btn btn-light btn-block"><i class="fa fa-sync"></i> Load Data</button>
									</div>
								</div>



								<div class="row" id="komponen_biaya">
									<div class="col-12 col-sm-12 col-lg-12">
										<div class="card">
											<div class="card-header">
												<h4>Biaya Produksi</h4>
											</div>
											<div class="card-body">
												<ul class="nav nav-tabs" id="myTab" role="tablist">
													<li class="nav-item">
														<a class="nav-link active" id="home-tab" data-toggle="tab" href="#bbb" role="tab" aria-controls="bbb" aria-selected="true">Biaya Bahan Baku</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" id="profile-tab" data-toggle="tab" href="#btkl" role="tab" aria-controls="btkl" aria-selected="false">Biaya Tenaga Kerja Langsung</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" id="contact-tab" data-toggle="tab" href="#bop" role="tab" aria-controls="bop" aria-selected="false">Biaya Overhead Pabrik</a>
													</li>
												</ul>
												<div class="tab-content" id="myTabContent">
													<div class="tab-pane fade show active overflow-auto" id="bbb" role="tabpanel" aria-labelledby="home-tab">
														<!-- load biaya bahan baku here -->
													</div>


													<!-- BTKL -->
													<div class="tab-pane fade" id="btkl" role="tabpanel" aria-labelledby="profile-tab">
														<div class="col-12 mt-4">
															<div class="table-responsive">
																<table class="table table-bordered table-sm" id="tbl_posts_btkl">
																	<thead>
																		<tr>
																			<th class="text-center">#</th>
																			<th style="width: 30%;">Btkl</th>
																			<th>Nominal</th>
																			<th class="no-content"></th>
																		</tr>
																	</thead>

																	<tbody id="tbl_posts_body_btkl" class="contents"> </tbody>

																</table>
																<a href="#" class="btn btn-secondary btn-sm btn-block add-record-btkl" data-added="0"><i class="fa fa-plus"></i> Tambah Baris</a>
															</div>
														</div>
													</div>



													<!-- BOP -->
													<div class="tab-pane fade" id="bop" role="tabpanel" aria-labelledby="contact-tab">
														<div class="col-12 mt-4">
															<div class="table-responsive">
																<table class="table table-bordered table-sm" id="tbl_posts_bop">
																	<thead>
																		<tr>
																			<th class="text-center">#</th>
																			<th style="width: 30%;">Komponen Biaya</th>
																			<th>Nominal</th>
																			<th class="no-content"></th>
																		</tr>
																	</thead>

																	<tbody id="tbl_posts_body_bop" class="contents"> </tbody>

																</table>
																<a href="#" class="btn btn-secondary btn-sm btn-block add-record-bop" data-added="0"><i class="fa fa-plus"></i> Tambah Baris</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>


								<!-- btn submit -->
								<div class="col-12 text-right">
									<button type="submit" class="btn btn-primary mb-2">Simpan</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>



<div class="invisible">
	<table id="sample_table_btkl">
		<tr>
			<td class="text-center">
				<span class="sn"></span>
			</td>
			<td>
				<select name="employee_id[]" class="form-control form-calc employee_id" id="employee_id-" data-id="0" required>
					<option value="">-pilih karyawan-</option>
					<?php foreach ($employee as $e) : ?>
						<option value="<?= $e['employee_id'] ?>"><?= $e['employee_id'] . '-' . $e['employee_name'] . '-' . $e['department'] ?></option>
					<?php endforeach ?>
				</select>
			</td>
			<td>
				<input type="text" name="nominal_btkl[]" id="ukuran" class="form-control" required>
			</td>


			<td class="text-center" style="vertical-align: middle;">
				<a href="#" class="text-danger  btn-icon delete-record-btkl" data-id="0">
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
				<select name="oc_id[]" class="form-control form-calc oc_id" id="oc_id-" data-id="0" required>
					<option value="">--pilih komponen--</option>
					<?php foreach ($overhead_component as $oc) : ?>
						<option value="<?= $oc['oc_id'] ?>"><?= $oc['name'] ?></option>
					<?php endforeach ?>
				</select>
			</td>
			<td>
				<input type="text" name="nominal_bop[]" id="ukuran" class="form-control" required>
			</td>

			<td class="text-center" style="vertical-align: middle;">
				<a href="#" class="text-danger  btn-icon delete-record-bop" data-id="0">
					<i class="fa fa-trash-alt"></i>
				</a>
			</td>
		</tr>
	</table>
</div>

<?php $this->load->view('_partials/footer'); ?>
<?php $this->load->view('transactions/production/script'); ?>