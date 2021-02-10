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
								<div class="col-12 mb-4">
									<div class="text-center">
										<h4>KONVEKSI KEN JR</h4>
										<h6>Laporan Harga Pokok Produksi</h6>
										<h6>Periode </h6>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<div class="table-responsive">
										<table class="table table-sm">
											<tr>
												<td><b>Persediaan Barang Dalam Proses</b></td>
												<td></td>
												<td><?= nominal(0) ?></td>
											</tr>

											<tr>
												<td><b>Bahan Baku</b></td>
												<td></td>
												<td></td>
											</tr>

											<tr>
												<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Persediaan Bahan Baku Awal</td>
												<td></td>
												<td><?= nominal(0) ?></td>
											</tr>

											<tr>
												<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pembelian Bahan Baku</td>
												<td></td>
												<td></td>
											</tr>

											<tr>
												<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Retur Pembelian</td>
												<td>(<?= nominal(0) ?>)</td>
												<td></td>
											</tr>

											<tr>
												<td><b>Total Pembelian Bahan Baku</b></td>
												<td></td>
												<td></td>
											</tr>

											<tr>
												<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Persediaan Bahan Baku Tersedia untuk Produksi</td>
												<td></td>
												<td></td>
											</tr>

											<tr>
												<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Persediaan Bahan Baku Akhir</td>
												<td></td>
												<td></td>
											</tr>

											<tr>
												<td><b>Total Biaya Bahan Baku</b></td>
												<td></td>
												<td></td>
											</tr>

											<tr>
												<td><b>Biaya Tenaga Kerja Langsung</b></td>
												<td></td>
												<td></td>
											</tr>

											<tr>
												<td><b>Biaya Overhead Pabrik</b></td>
												<td></td>
												<td></td>
											</tr>

											<tr>
												<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Biaya Tenaga Kerja Tidak Langsung</td>
												<td></td>
												<td></td>
											</tr>

											<tr>
												<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Biaya Perlatan dan Pemeliharaan Pabrik</td>
												<td></td>
												<td></td>
											</tr>

											<tr>
												<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Biaya Listrik dan Air</td>
												<td></td>
												<td></td>
											</tr>

											<tr>
												<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Biaya Rupa-Rupa Overhead</td>
												<td></td>
												<td></td>
											</tr>

											<tr>
												<td><b>Total Biaya Overhead Pabrik</b></td>
												<td></td>
												<td></td>
											</tr>

											<tr>
												<td><b>Total Biaya Produksi</b></td>
												<td></td>
												<td></td>
											</tr>

											<tr>
												<td><b>Total Biaya Barang Dalam Proses</b></td>
												<td></td>
												<td></td>
											</tr>

											<tr>
												<td><b>Total Barang Dalam Proses Akhir</b></td>
												<td></td>
												<td></td>
											</tr>

											<tr>
												<td><b>Harga Pokok Produksi</b></td>
												<td></td>
												<td></td>
											</tr>
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
