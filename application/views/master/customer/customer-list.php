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
				<div class="breadcrumb-item">Data Master</div>
				<div class="breadcrumb-item"><?= $title ?></div>
			</div>
		</div>

		<div class="section-body">
			<button class="btn btn-primary"><i class="fas fa-plus"></i> Buat Pelanggan Baru</button>
			<div class="row mt-4">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped" id="table-1">
									<thead>
										<tr>
											<th class="text-center">
												#
											</th>
											<th>Nama Pelanggan</th>
											<th>Email</th>
											<th>No Telepon</th>
											<th>Alamat</th>
											<th class="text-center">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 1;
										foreach ($all as $cs) : ?>
											<tr>
												<td class="text-center"><?= $no++ ?></td>
												<td><?= $cs->customer_id . ' - ' . $cs->cus_name ?></td>
												<td><?= $cs->cus_email ?></td>
												<td><?= $cs->cus_phone ?></td>
												<td><?= $cs->cus_address ?></td>
												<td class="text-center">
													<a href="<?= site_url('master/customer/edit/' . $cs->customer_id) ?>" class="btn btn-info">Edit</a>
													<a href="<?= site_url('master/customer/deleted/' . $cs->customer_id) ?>" class="btn btn-danger">Hapus</a>
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
