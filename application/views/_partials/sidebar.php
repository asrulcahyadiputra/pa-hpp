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
					<li class="<?php echo $this->uri->segment(2) == 'produk' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>master/produk">Produk</a></li>
					<li class="<?php echo $this->uri->segment(2) == 'bahan_baku' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>master/bahan_baku">Bahan Baku</a></li>

				</ul>
			</li>
			<!-- ./data master -->
			<li class="dropdown <?php echo $this->uri->segment(2) == 'features_activities' || $this->uri->segment(2) == 'features_post_create' || $this->uri->segment(2) == 'features_posts' || $this->uri->segment(2) == 'features_profile' || $this->uri->segment(2) == 'features_settings' || $this->uri->segment(2) == 'features_setting_detail' || $this->uri->segment(2) == 'features_tickets' ? 'active' : ''; ?>">
				<a href="#" class="nav-link has-dropdown"><i class="fas fa-handshake"></i> <span>Transaksi</span></a>
				<ul class="dropdown-menu">
					<li class="<?php echo $this->uri->segment(2) == 'features_activities' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>dist/features_activities">Pesanan</a></li>
					<li class="<?php echo $this->uri->segment(2) == 'features_post_create' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>dist/features_post_create">Produksi</a></li>
					<li class="<?php echo $this->uri->segment(2) == 'features_posts' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>dist/features_posts">Pembelian</a></li>
					<li><a class="nav-link" href="<?php echo base_url(); ?>dist/layout_top_navigation">Bill of Materials (BOM)</a></li>
				</ul>
			</li>
			<!-- ./transaksi -->
			<li class="dropdown <?php echo $this->uri->segment(2) == 'features_activities' || $this->uri->segment(2) == 'features_post_create' || $this->uri->segment(2) == 'features_posts' || $this->uri->segment(2) == 'features_profile' || $this->uri->segment(2) == 'features_settings' || $this->uri->segment(2) == 'features_setting_detail' || $this->uri->segment(2) == 'features_tickets' ? 'active' : ''; ?>">
				<a href="#" class="nav-link has-dropdown"><i class="fas fa-book"></i> <span>Laporan</span></a>
				<ul class="dropdown-menu">
					<li class="<?php echo $this->uri->segment(2) == 'features_activities' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>dist/features_activities">Jurnal Umum</a></li>
					<li class="<?php echo $this->uri->segment(2) == 'features_post_create' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>dist/features_post_create">Buku Besar</a></li>
					<li class="<?php echo $this->uri->segment(2) == 'features_posts' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>dist/features_posts">Harga Pokok Produksi</a></li>
				</ul>
			</li>
		</ul>
	</aside>
</div>
