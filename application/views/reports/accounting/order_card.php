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
				<div class="breadcrumb-item">Laporan</div>
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
				<div class="col-6">
					<div class="card mb-4">
						<div class="card-body">
							<form class="form-inline" method="GET" action="<?= site_url('laporan/kartu_pesanan') ?>">
								<div class="input-group mb-2 mr-sm-2">
									<div class="input-group-prepend">
										<div class="input-group-text"><i class="fa fa-calendar"></i></div>
									</div>
									<input type="month" class="form-control" id="periode" placeholder="periode" name="periode">
								</div>
								<button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i></button>
							</form>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-12 mb-4" style="border-bottom: double;">
									<div class="text-center">
										<h4>KONVEKSI KEN JR</h4>
										<h6>Kartu Pesanan</h6>
										<h6>Periode <?= bulan($month) . ' ' . $year ?></h6>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<div class="table-responsive">
										<table class="table table-sm table-bordered ">
											<thead>
												<tr class="text-center" style="background-color: #4361ee; color: #fff">
													<th>#</th>
													<th>Tanggal Pesanan</th>
													<th>Kode Pesanan</th>
													<th>Biaya Bahan Baku</th>
													<th>Biaya Tenaga Kerja Langsung</th>
													<th>Biaya Overhead Pabrik</th>
												</tr>
											</thead>
											<tbody>
												<?php $no = 1;
												$tot_bb = 0;
												$tot_btkl = 0;
												$tot_bop = 0;
												foreach ($all as $row) : ?>
													<?php
													$tot_bb = $tot_bb + $row['material_cost'];
													$tot_btkl = $tot_btkl + $row['direct_labor_cost'];
													$tot_bop = $tot_bop + $row['overhead_cost'];
													?>
													<tr>
														<td class="text-center"><?= $no++ ?></td>
														<td><?= date('d-m-Y H:i:s', strtotime($row['trans_date'])) ?></td>
														<td><?= $row['trans_id'] ?></td>
														<td>
															<span class="text-left">Rp</span>
															<span style="float:right;">
																<?= nominal1($row['material_cost']) ?>
															</span>
														</td>
														<td>
															<span class="text-left">Rp</span>
															<span style="float:right;">
																<?= nominal1($row['direct_labor_cost']) ?>
															</span>
														</td>
														<td>
															<span class="text-left">Rp</span>
															<span style="float:right;">
																<?= nominal1($row['overhead_cost']) ?>
															</span>
														</td>
													</tr>
												<?php endforeach ?>
												<tr>
													<td class="text-right" colspan="3">Total</td>
													<td>
														<span class="text-left">Rp</span>
														<span style="float:right;">
															<?= nominal1($tot_bb) ?>
														</span>
													</td>
													<td>
														<span class="text-left">Rp</span>
														<span style="float:right;">
															<?= nominal1($tot_btkl) ?>
														</span>
													</td>
													<td>
														<span class="text-left">Rp</span>
														<span style="float:right;">
															<?= nominal1($tot_bop) ?>
														</span>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php $this->load->view('_partials/footer'); ?>