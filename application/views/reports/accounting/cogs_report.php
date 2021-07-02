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

			<div class="row mt-4">
				<div class="col-12">
					<div class="card mb-4">
						<div class="card-body">
							<form method="POST" id="form-filter">
								<div id="filter-section">
									<div class="form-group row">
										<label for="periode" class="col-sm-4 col-form-label">Periode</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="periode" placeholder="contoh. 202107">
										</div>
									</div>

								</div>

								<div class="form-group row">
									<div class="col-sm-12 text-right">
										<button type="button" class="btn btn-light col-2" id="btn-close-filter">Tutup</button>
										<button type="button" class="btn btn-primary col-2" id="btn-open-filter">Filter</button>
										<button type="submit" class="btn btn-primary col-2" id="btn-submit-filter">Tampilkan</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="col-12 " id="report-section">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-12 mb-4" style="border-bottom: double;">
									<div class="text-center">
										<h4>KONVEKSI KEN JR</h4>
										<h6>Laporan Harga Pokok Produksi</h6>
										<h6 id="periode-section">Periode </h6>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<div class="table-responsive" id="report-body-section">


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
<?php $this->load->view('reports/accounting/cogs_script'); ?>