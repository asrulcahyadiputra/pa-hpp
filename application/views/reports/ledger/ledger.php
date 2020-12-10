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
				<div class="col-4">
					<div class="card mb-4">
						<div class="card-body">
							<form class="form-inline" method="POST" action="<?= site_url('laporan/jurnal') ?>">
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
								<div class="col-12 mb-4">
									<div class="text-center">
										<h4>KONVEKSI KEN JR</h4>
										<h6>Jurnal Umum</h6>
										<h6>Periode <?= bulan($month) . ' ' . $year ?></h6>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<div class="table-responsive">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Tanggal</th>
													<th>Akun</th>
													<th>Ref</th>
													<th>Debit</th>
													<th>Kredit</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($row_ledger as $r1) : ?>
													<tr>
														<td rowspan="<?= $r1['row'] + 1 ?>"><?= $r1['gl_date'] ?></td>
													</tr>
													<?php foreach ($ledger as $r2) : ?>
														<?php if ($r1['trans_id'] == $r2['trans_id']) : ?>
															<tr>
																<?php if ($r2['gl_balance'] == 'd') : ?>
																	<td><?= $r2['account_no'] . ' ' . $r2['account_name'] ?></td>
																<?php endif ?>
																<?php if ($r2['gl_balance'] == 'k') : ?>
																	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $r2['account_no'] . ' ' . $r2['account_name'] ?></td>
																<?php endif ?>
																<td><?= $r2['trans_id'] ?></td>
																<td>
																	<span class="text-left">Rp</span>
																	<span style="float:right;">
																		<?php if ($r2['gl_balance'] == 'd') {
																			echo nominal1($r2['nominal']);
																		} else {
																			echo "-";
																		} ?>
																	</span>
																</td>
																<td>
																	<span class="text-left">Rp</span>
																	<span style="float:right;">
																		<?php if ($r2['gl_balance'] == 'k') {
																			echo nominal1($r2['nominal']);
																		} else {
																			echo "-";
																		} ?>
																	</span>
																</td>
															</tr>
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
			</div>
		</div>
	</section>
</div>
<?php $this->load->view('_partials/footer'); ?>
