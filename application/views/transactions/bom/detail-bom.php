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
			<div class="container">
				<div class="row mt-4">
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<div class="card-title"><h5><i>Bill of Materials</i></h5></div>
								<div class="row">
									<div class="col-6 mb-2">
										<table class="table table-sm">
											<tr>
												<td>Kode Bill of Materials</td>
												<td style="width: 1%" class="text-center">:</td>
												<td><?=$trans_id?></td>
											</tr>
											<tr>
												<td>Produk</td>
												<td style="width: 1%" class="text-center">:</td>
												<td><?=$product['product_id'].' '.$product['product_name']?></td>
											</tr>
											<tr>
												<td>Harga Jual</td>
												<td style="width: 1%" class="text-center">:</td>
												<td><?=nominal($product['sales_price']).' /'.$product['product_unit']?></td>
											</tr>
										</table>
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<div class="table-responsive">
											<table class="table table-sm table-striped" id="bom-table" >
												<thead>
													<tr>
														<th>#</th>
														<th>Bahan Baku</th>
														<th>Qty</th>
														<th>Unit</th>
													</tr>
												</thead>
												<tbody>
													<?php $no=1; foreach($bom as $b): ?>
														<tr>
															<td><?=$no++?></td>
															<td><?=$b['material_id'].' '.$b['material_name']?></td>
															<td><?=$b['qty']?></td>
															<td><?=$b['unit']?></td>
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
				</div>
			</div>
		
		</div>
	</section>
</div>
<?php $this->load->view('_partials/footer'); ?>
