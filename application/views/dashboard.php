<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Dashboard</h1>
		</div>
		<div class="row">
			<div class="col-lg-3 col-md-6 col-sm-6 col-12">
				<div class="card card-statistic-1">
					<div class="card-icon bg-primary">
						<i class="far fa-user"></i>
					</div>
					<div class="card-wrap">
						<div class="card-header">
							<h4>Total Pelanggan</h4>
						</div>
						<div class="card-body">
							10
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6 col-12">
				<div class="card card-statistic-1">
					<div class="card-icon bg-danger">
						<i class="fas fa-shopping-basket"></i>
					</div>
					<div class="card-wrap">
						<div class="card-header">
							<h4>Total Pesanan</h4>
						</div>
						<div class="card-body">
							42
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6 col-12">
				<div class="card card-statistic-1">
					<div class="card-icon bg-success">
						<i class="fas fa-check"></i>
					</div>
					<div class="card-wrap">
						<div class="card-header">
							<h4>Pesanan Selesai</h4>
						</div>
						<div class="card-body">
							1,201
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6 col-12">
				<div class="card card-statistic-1">
					<div class="card-icon bg-info">
						<i class="fas fa-boxes"></i>
					</div>
					<div class="card-wrap">
						<div class="card-header">
							<h4>Daftar Produk</h4>
						</div>
						<div class="card-body">
							47
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8 col-md-12 col-12 col-sm-12">
				<div class="card">
					<div class="card-header">
						<h4>Daftar Pembelian Terbaru</h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>#</th>
										<th>No Transaksi</th>
										<th>Tanggal</th>
										<th>Status</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($new_purchasing as $np) : ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $np['trans_id'] ?></td>
											<td><?= date('d-m-Y H:i:s', strtotime($np['trans_date'])) ?></td>
											<td>
												<?php if ($np['status'] == 0) : ?>
													<span class="text-warning"><i class="fa fa-lock-open"></i></span>
												<?php endif ?>
												<?php if ($np['status'] == 1) : ?>
													<span class="text-success"><i class="fa fa-check"></i></span>
												<?php endif ?>
											</td>
											<td><?= nominal($np['trans_total']) ?></td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-12 col-12 col-sm-12">
				<div class="card">
					<div class="card-header">
						<h4>Daftar Pesanan Terbaru</h4>
					</div>
					<div class="card-body">
						<ul class="list-unstyled list-unstyled-border">
							<li class="media">
								<img class="mr-3 rounded-circle" width="50" src="<?php echo base_url(); ?>assets/img/avatar/avatar-1.png" alt="avatar">
								<div class="media-body">
									<div class="float-right text-primary">Now</div>
									<div class="media-title">Farhan A Mujib</div>
									<span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
								</div>
							</li>
							<li class="media">
								<img class="mr-3 rounded-circle" width="50" src="<?php echo base_url(); ?>assets/img/avatar/avatar-2.png" alt="avatar">
								<div class="media-body">
									<div class="float-right">12m</div>
									<div class="media-title">Ujang Maman</div>
									<span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
								</div>
							</li>
							<li class="media">
								<img class="mr-3 rounded-circle" width="50" src="<?php echo base_url(); ?>assets/img/avatar/avatar-3.png" alt="avatar">
								<div class="media-body">
									<div class="float-right">17m</div>
									<div class="media-title">Rizal Fakhri</div>
									<span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
								</div>
							</li>
							<li class="media">
								<img class="mr-3 rounded-circle" width="50" src="<?php echo base_url(); ?>assets/img/avatar/avatar-4.png" alt="avatar">
								<div class="media-body">
									<div class="float-right">21m</div>
									<div class="media-title">Alfa Zulkarnain</div>
									<span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
								</div>
							</li>
						</ul>
						<div class="text-center pt-1 pb-1">
							<a href="#" class="btn btn-primary btn-lg btn-round">
								View All
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php $this->load->view('_partials/footer'); ?>
