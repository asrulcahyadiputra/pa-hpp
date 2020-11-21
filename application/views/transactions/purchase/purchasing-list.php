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
			<a href="<?=site_url('transaksi/pembelian/create_draff')?>" class="btn btn-primary"><i class="fas fa-plus"></i> Buat <?=$title?> Baru</a>
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
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped" id="table-1">
									<thead>
										<tr>
											<th>#</th>
											<th>Kode Transaksi</th>
											<th>Tanggal</th>
											<th>Total</th>
											<th>Status</th>
											<th class="no-content"></th>
										</tr>
									</thead>
									<tbody>
										<?php $no=1; foreach($all as $al): ?>
											<tr>
												<td><?=$no++?></td>
												<td><?=$al['trans_id']?></td>
												<td><?=date('d-m-Y H:i:s',strtotime($al['trans_date']))?></td>
												<td><?=nominal($al['trans_total'])?></td>
												<td>
													<?php if($al['status'] == 0): ?>
														<span class="text-warning"><i class="fa fa-lock-open"></i> Draf</span>
													<?php endif ?>
													<?php if($al['status'] == 1): ?>
														<span class="text-success"><i class="fa fa-lock"></i> Selesai</span>
													<?php endif ?>
												</td>
												<td>
													<a href="<?=site_url('transaksi/pembelian/draff/'.$al['trans_id'])?>" class="btn btn-sm btn-info"><i class="fa fa-list"></i></a>
												</td>
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
	</section>
</div>


<?php $this->load->view('_partials/footer'); ?>
