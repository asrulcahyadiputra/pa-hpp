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
				<div class="col-4">
					<div class="card">
						<div class="card-body">
							<div class="card-title"><h5><i>Form Bill of Materials</i></h5></div>
							<form action="<?=site_url('transaksi/bom/store_item')?>" method="POST">
								<div class="form-group">
									<label for="">Kode BOM</label>
									<input type="text" class="form-control" name="trans_id" value="<?=$trans_id?>" readonly>
								</div>
								<div class="form-group">
									<label for="">Pilih Bahan Baku <small class="text-danger">*</small></label>
									<select name="material_id" id="material_id" class="form-control" required>
										<option value="">Pilih bahan baku..</option>
										<?php foreach($materials as $m): ?>
											<option value="<?=$m['material_id']?>"><?=$m['material_id'].' '.$m['material_name']?></option>
										<?php endforeach ?>
									</select>
								</div>
								<div class="form-group">
									<label for="">Qty <small class="text-danger">*</small></label>
									<div class="input-group mb-3">
										<input type="text" class="form-control" name="qty" required >
										<div class="input-group-append">
											<span class="input-group-text" id="unit"></span>
										</div>
									</div>
								</div>	
								<div class="form-group text-right">
									<button class="btn btn-secondary" type="reset"> Batalkan</button>
									<button type="submit" class="btn btn-info"> Tambahkan</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-8">
					<div class="card">
						<div class="card-body">
							<div class="card-title"><h5><i>Bill of Materials</i></h5></div>
							<div class="row">
								<div class="col-6 mb-2">
									<table class="table">
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
													
													<th class="no-content"></th>
												</tr>
											</thead>
											<tbody>
												<?php $no=1; foreach($bom as $b): ?>
													<tr>
														<td><?=$no++?></td>
														<td><?=$b['material_id'].' '.$b['material_name']?></td>
														<td><?=$b['qty']?></td>
														<td><?=$b['unit']?></td>
														<td class="text-center">
															<a href="<?=site_url('transaksi/bom/delete_item/'.$b['trans_id'].'/'.$b['material_id'])?>" class="btn btn-danger btn-sm" onclick="return confirm('Data tidak dapat dikembalikan, Apakah anda yakin ?')" ><i class="fa fa-trash"></i></a>
														</td>
													</tr>
												<?php endforeach ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12 mt-4 text-right">
									<a href="<?=site_url('transaksi/bom')?>" class="btn btn-secondary">Simpan Sebagai Draf</a>
									<a href="<?=site_url('transaksi/bom/store/'.$trans_id)?>" class="btn btn-success">Selesai</a>
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
