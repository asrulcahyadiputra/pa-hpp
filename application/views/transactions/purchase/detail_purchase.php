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
						<!-- Button trigger modal -->
						<div class="card-body">
								<form action="" method="POST">
									<div class="row">
										<div class="col-12">
											<div class="table-responsive">
												<table class="table table-bordered" >
													<thead>
														<tr>
															<th>#</th>
															<th>Item</th>
															<th>qty</th>
															<th>Harga Satuan</th>
															<th>Subtotal</th>
															<th>Tipe</th>
															<th class="no-content"></th>
														</tr>
													</thead>
													<tbody>
														<?php $tp=0;$tb=0; $total=0; $no=1; foreach($details as $dt): ?>
															<?php 
																if($dt['type_id'] == 'BBB'){
																	$tb = $tb + ($dt['purchase_qty']*$dt['purchase_price']);
																}else{
																	$tp = $tp + ($dt['purchase_qty']*$dt['purchase_price']);
																}
																$total=$tb+$tp;	
															?>
															<tr>
																<td><?=$no++?></td>
																<td><?=$dt['material_id'].' '.$dt['material_name']?></td>
																<td><?=$dt['purchase_qty'].' '.$dt['material_unit']?></td>
																<td><?=nominal($dt['purchase_price'])?></td>
																<td><?=nominal($dt['purchase_qty']*$dt['purchase_price'])?></td>
																<td><?=$dt['type_name']?></td>
																<td class="text-center">
																	<a href="<?=site_url('transaksi/pembelian/delete_item/'.$dt['purchase_id'].'/'.$dt['trans_id'])?> " class="btn btn-sm btn-danger" onclick="return confirm('Data tidak dapat dikembalikan, apakah anda yakin ?')" ><i class="fa fa-trash"></i></a>
																</td>
															</tr>
														<?php endforeach ?>
													</tbody>
												</table>
											</div>
										</div>
										<div class="col-6"></div>
										<div class="col-6">
											<ul class="list-group list-group-flush">
												<li class="list-group-item d-flex justify-content-between align-items-center">
												Total Bahan Baku Utama
												<span><?=nominal($tb)?></span>
												</li>
												<li class="list-group-item d-flex justify-content-between align-items-center">
												Total Bahan Baku Penolong
												<span><?=nominal($tp)?></span>
												</li>
												<li class="list-group-item d-flex justify-content-between align-items-center">
												Grand Total
												<span><?=nominal($total)?></span>
												</li>
											</ul>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php $this->load->view('_partials/footer'); ?>
