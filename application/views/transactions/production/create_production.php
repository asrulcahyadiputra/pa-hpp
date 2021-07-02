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

		<div class="section-body" id="data-produksi">
			<div class="row mt-4">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h6 class="card-title">Form Produksi</h6>
						</div>
						<div class="card-body">
							<form id="form-bom" class="needs-validation" novalidate></form>
							<form method="GET" action="<?= site_url('transaksi/produksi/create') ?>">
								<div class="row">
									<div class="col-4">
										<div class="form-group">
											<label for="kode_pesanan">Kode Pesanan</label>
											<select name="kode_pesanan" id="kode_pesanan" class="form-control" required>
												<option value="">-pilih pesanan untuk dihitung--</option>
												<?php foreach ($orders as $or) : ?>
													<option value="<?= $or['trans_id'] ?>"><?= $or['trans_id'] . '-' . $or['cus_name'] ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="col-4">
										<div class="form-group">
											<label for="tanggal">Tanggal Produksi</label>
											<input type="date" name="tanggal" id="tanggal" class="form-control" min="<?= date('Y-m-d') ?>" required>
										</div>
									</div>
									<div class="col-8">
										<div class="form-group">
											<label for="description">Keterangan</label>
											<textarea name="description" id="description" class="form-control" cols="30" rows="3" required></textarea>
										</div>
									</div>
								</div>


								<div class="row">
									<div class="col-12">
										<table class="table table-bordered table-sm" id="table-opsi-bom">
											<thead>
												<tr>
													<th class="text-center" style="width:5%">No</th>
													<th>Kode</th>
													<th>Produk</th>
													<th>Ukuran</th>
													<th>Qty</th>
													<th>Bill of Material</th>
												</tr>
											</thead>
											<tbody>

											</tbody>
										</table>
									</div>
									<div class="col-12 mt-3">
										<button type="submit" form="form-bom" id="btn-load" class="btn btn-light btn-block"><i class="fa fa-sync"></i> Load Data</button>
									</div>
								</div>



								<div class="row" id="komponen_biaya">
									<div class="col-12 col-sm-12 col-lg-12">
										<div class="card">
											<div class="card-header">
												<h4>Biaya Produksi</h4>
											</div>
											<div class="card-body">
												<ul class="nav nav-tabs" id="myTab" role="tablist">
													<li class="nav-item">
														<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Biaya Bahan Baku</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Biaya Tenaga Kerja Langsung</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Biaya Overhead Pabrik</a>
													</li>
												</ul>
												<div class="tab-content" id="myTabContent">
													<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
														Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
														tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
														quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
														consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
														cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
														proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
													</div>
													<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
														Sed sed metus vel lacus hendrerit tempus. Sed efficitur velit tortor, ac efficitur est lobortis quis. Nullam lacinia metus erat, sed fermentum justo rutrum ultrices. Proin quis iaculis tellus. Etiam ac vehicula eros, pharetra consectetur dui. Aliquam convallis neque eget tellus efficitur, eget maximus massa imperdiet. Morbi a mattis velit. Donec hendrerit venenatis justo, eget scelerisque tellus pharetra a.
													</div>
													<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
														Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin ligula massa, gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum, sem interdum molestie finibus, nulla diam varius leo, nec varius lectus elit id dolor. Nam malesuada orci non ornare vulputate. Ut ut sollicitudin magna. Vestibulum eget ligula ut ipsum venenatis ultrices. Proin bibendum bibendum augue ut luctus.
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>


								<!-- btn submit -->
								<div class="col-12 text-right">
									<button type="submit" class="btn btn-primary mb-2">Simpan</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


<?php $this->load->view('_partials/footer'); ?>
<?php $this->load->view('transactions/production/script'); ?>