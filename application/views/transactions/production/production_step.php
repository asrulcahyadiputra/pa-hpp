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
				<?php if ($production['production_step'] == 1) : ?>
					<div class="col-12">

						<div class="card">
							<div class="card-header">
								<h6 class="card-title">Biaya Tenaga Kerja Langsung (BTKL)</h6>
							</div>
							<div class="card-body">
								<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#addBTKL">
									<i class="fa fa-plus"></i> Tambah BTKL
								</button>
								<table class="table">
									<thead>
										<tr>
											<th>#</th>
											<th>Nama Karyawan</th>
											<th>Upah</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										$btkl_total = 0;
										foreach ($btkl as $kl) : ?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?= $kl['employee_name'] ?></td>
												<td><?= nominal($kl['cost']) ?></td>
												<td>
													<a href="<?= site_url('delete/btkl/' . $kl['trans_id'] . '/' . $kl['direct_labor_id']) ?>" class="text-danger" onclick="return confirm('Setelah data dihapus, anda tidak dapat mengembalikan data !')"><i class="fa fa-trash"></i></a>
												</td>
												<?php $btkl_total = $btkl_total + $kl['cost'] ?>
											</tr>
										<?php endforeach ?>
										<tr>
											<td class="text-right" colspan="2"><b>Total</b></td>
											<td><b><?= nominal($btkl_total) ?></b></td>
										</tr>
									</tbody>
								</table>
								<?php if ($btkl) : ?>
									<div class="text-right">
										<a href="<?= site_url('done/btkl/' . $production['trans_id'] . '/' . $btkl_total) ?>" class="btn btn-success">BTKL Selesai</a>
									</div>
								<?php endif ?>
							</div>
						</div>
					</div>
				<?php endif ?>
				<!-- /.BTKL -->

				<?php if ($production['production_step'] == 2) : ?>
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<h6 class="card-title">Biaya Overhead Pabrik (BOP)</h6>
							</div>
							<div class="card-body">
								<!-- Button trigger modal -->
								<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#addBOP">
									<i class="fa fa-plus"></i> Tambah BOP
								</button>
								<table class="table">
									<thead>
										<tr>
											<th>#</th>
											<th>BOP</th>
											<th>Biaya</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										$bop_total = 0;
										foreach ($bop as $bo) : ?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?= $bo['name'] ?></td>
												<td><?= nominal($bo['overhead_cost']) ?></td>
												<td>
													<a href="<?= site_url('delete/bop/' . $bo['trans_id'] . '/' . $bo['id']) ?>" class="text-danger" onclick="return confirm('Setelah data dihapus, anda tidak dapat mengembalikan data !')"><i class="fa fa-trash"></i></a>
												</td>
												<?php $bop_total = $bop_total + $bo['overhead_cost'] ?>
											</tr>
										<?php endforeach ?>
										<tr>
											<td class="text-right" colspan="2"><b>Total</b></td>
											<td><b><?= nominal($bop_total) ?></b></td>
										</tr>
									</tbody>
								</table>
								<?php if ($bop) : ?>
									<div class="text-right">
										<a href="<?= site_url('done/bop/' . $production['trans_id'] . '/' . $bop_total) ?>" class="btn btn-success">BOP Selesai</a>
									</div>
								<?php endif ?>
							</div>
						</div>
					</div>
				<?php endif ?>
				<div class="col-12 mt-2">
					<div class="card">
						<div class="card-header">
							<h6 class="card-title">Data Pesanan <?= $order['trans_id'] ?></h6>
						</div>
						<div class="card-body">
							<table class="table">
								<thead>
									<tr>
										<td style="width: 20%;">Tanggal</td>
										<td style="width: 1%;">:</td>
										<td><?= $order['trans_date'] ?></td>
										<td style="width: 20%;">Harga Satuan Produk</td>
										<td style="width: 1%;">:</td>
										<td><?= nominal($order['order_price']) ?></td>
									</tr>
									<tr>
										<td style="width: 20%;">Pelanggan</td>
										<td style="width: 1%;">:</td>
										<td><?= $order['cus_name'] ?></td>
										<td style="width: 20%;">Total Harga Pesanan</td>
										<td style="width: 1%;">:</td>
										<td><?= nominal($order['order_price'] * $order['order_qty']) ?></td>
									</tr>
									<tr>
										<td style="width: 20%;">Qty Pesanan</td>
										<td style="width: 1%;">:</td>
										<td><?= $order['order_qty'] . ' ' . $order['product_unit'] ?></td>
										<td style="width: 20%;">Produk</td>
										<td style="width: 1%;">:</td>
										<td><?= $order['product_name'] ?></td>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h6 class="card-title">Biaya Produksi</h6>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table">
									<tbody>
										<tr>
											<td style="width: 20%;">Biaya Bahan Baku (BBB)</td>
											<td style="width: 1%;">:</td>
											<td><?= nominal($p_cost['material_cost']) ?></td>
										</tr>
										<tr>
											<td style="width: 20%;">Biaya Tenaga Kerja Langsung (BTKL)</td>
											<td style="width: 1%;">:</td>
											<td><?= nominal($p_cost['direct_labor_cost']) ?></td>
										</tr>
										<tr>
											<td style="width: 20%;">Biaya Overhead Pabrik (BOP)</td>
											<td style="width: 1%;">:</td>
											<td><?= nominal($p_cost['overhead_cost']) ?></td>
										</tr>
										<tr>
											<td style="width: 20%;"><b>Biaya Produksi</b></td>
											<td style="width: 1%;"><b>:</b></td>
											<?php $biaya_produksi = $p_cost['material_cost'] + $p_cost['direct_labor_cost'] + $p_cost['overhead_cost'] ?>
											<td><b><?= nominal($biaya_produksi) ?></b></td>
										</tr>
									</tbody>
								</table>
								<?php if ($production['production_step'] == 3) : ?>
									<div class="text-right">
										<a href="<?= site_url('transaksi/produksi/selesai/' . $production['trans_id']) ?>" class="btn btn-success">Perhitungan Selesai</a>
									</div>
								<?php endif ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>




<!-- Modal BTKL -->
<div class="modal fade" id="addBTKL" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Biaya Tenaga Kerja Langsung (BTKL)</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= site_url('store/btkl') ?>" method="POST" class="needs-validation" novalidate>
				<input type="hidden" name="trans_id" id="trans_id" value="<?= $production['trans_id'] ?>">
				<div class="modal-body">
					<div class="form-group">
						<label for="">Karyawan</label>
						<select name="employee_id" id="employee_id" class="form-control" required>
							<option value="">--pilih karyawan--</option>
							<?php foreach ($employee as $e) : ?>
								<option value="<?= $e['employee_id'] ?>"><?= $e['employee_name'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label for="">Biaya</label>
						<input type="text" name="cost" id="cost" class="form-control" data-type='currency' required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>




<!-- Modal BOP -->
<div class="modal fade" id="addBOP" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Biaya Overhead Pabrik (BOP)</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= site_url('store/bop') ?>" method="POST" class="needs-validation" novalidate>
				<input type="hidden" name="trans_id" id="trans_id" value="<?= $production['trans_id'] ?>">
				<div class="modal-body">
					<div class="form-group">
						<label for="">Komponen Biaya</label>
						<select name="oc_id" id="oc_id" class="form-control" required>
							<option value="">--pilih komponen--</option>
							<?php foreach ($overhead_component as $oc) : ?>
								<option value="<?= $oc['oc_id'] ?>"><?= $oc['name'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label for="">Biaya</label>
						<input type="text" name="overhead_cost" id="overhead_cost" class="form-control" data-type='currency' required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php $this->load->view('_partials/footer'); ?>
