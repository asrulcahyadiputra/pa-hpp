<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="main-sidebar sidebar-style-2">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand">
			<a href="<?php echo base_url('Dashboard'); ?>">PA HPP</a>
		</div>
		<div class="sidebar-brand sidebar-brand-sm">
			<a href="<?php echo base_url('Dashboard'); ?>">PA</a>
		</div>
		<ul class="sidebar-menu">
			<li class="<?php echo $this->uri->segment(1) == 'Dashboard' ? 'active' : ''; ?>">
				<a href="<?= site_url('Dashboard') ?>" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
			</li>
			<!-- ./dashboard -->
			<li class="dropdown <?php echo $this->uri->segment(1) == 'master'  ? 'active' : ''; ?>">
				<a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-server"></i> <span>Data Master</span></a>
				<ul class="dropdown-menu">
					<li class="<?php echo $this->uri->segment(2) == 'pelanggan' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>master/pelanggan">Pelanggan</a></li>
					<li class="<?php echo $this->uri->segment(2) == 'karyawan' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>master/karyawan">Karyawan</a></li>
					<li class="<?php echo $this->uri->segment(2) == 'produk' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>master/produk">Produk</a></li>
					<li class="<?php echo $this->uri->segment(2) == 'bahan_baku' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>master/bahan_baku">Bahan Baku</a></li>
					<li class="<?php echo $this->uri->segment(2) == 'coa' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>master/coa">Chart of Acccount</a></li>
				</ul>
			</li>
			<!-- ./data master -->
			<li class="dropdown <?php echo $this->uri->segment(1) == 'transaksi'  ? 'active' : ''; ?>">
				<a href="#" class="nav-link has-dropdown"><i class="fas fa-handshake"></i> <span>Transaksi</span></a>
				<ul class="dropdown-menu">
					<li class="<?php echo $this->uri->segment(2) == 'bom' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>transaksi/bom">Bill of Materials (BOM)</a></li>
					<li class="<?php echo $this->uri->segment(2) == 'pesanan' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>transaksi/pesanan">Pesanan</a></li>
					<li class="<?php echo $this->uri->segment(2) == 'pembelian' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>transaksi/pembelian">Pembelian</a></li>
					<li class="<?php echo $this->uri->segment(2) == 'produksi' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>transaksi/produksi">Produksi</a></li>
				</ul>
			</li>
			<!-- ./transaksi -->
			<li class="dropdown <?php echo $this->uri->segment(1) == 'laporan'  ? 'active' : ''; ?>">
				<a href="#" class="nav-link has-dropdown"><i class="fas fa-book"></i> <span>Laporan</span></a>
				<ul class="dropdown-menu">
					<li class="<?php echo $this->uri->segment(2) == 'jurnal' ? 'active' : ''; ?>">
						<a class="nav-link" href="<?php echo base_url(); ?>laporan/jurnal">Jurnal Umum</a>
					</li>
					<li class="<?php echo $this->uri->segment(2) == 'buku_besar' ? 'active' : ''; ?>">
						<a class="nav-link" href="<?php echo base_url(); ?>laporan/buku_besar">Buku Besar</a>
					</li>
					<li class="<?php echo $this->uri->segment(2) == 'kartu_pesanan' ? 'active' : ''; ?>">
						<a class="nav-link" href="<?php echo base_url(); ?>laporan/kartu_pesanan">Kartu Pesanan</a>
					</li>
					<li class="<?php echo $this->uri->segment(2) == 'features_posts' ? 'active' : ''; ?>">
						<a class="nav-link" href="<?php echo base_url(); ?>dist/features_posts">Harga Pokok Produksi</a>
					</li>
				</ul>
			</li>
		</ul>
	</aside>
</div>
