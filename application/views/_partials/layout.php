<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<body class=" <?= $this->uri->segment(1) == 'transaksi' ? 'sidebar-mini' : '' ?> ">
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<div class="navbar-bg"></div>
			<nav class="navbar navbar-expand-lg main-navbar">
				<form class="form-inline mr-auto">
					<ul class="navbar-nav mr-3">
						<li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
					</ul>
				</form>
				<ul class="navbar-nav navbar-right">
					<li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
							<img alt="image" src="<?php echo base_url(); ?>assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
							<div class="d-sm-none d-lg-inline-block">
								<?php $profile = getProfile($this->session->userdata('user_id')) ?>
								<?= $profile['name'] ?>
							</div>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<div class="dropdown-title">Logged in 5 min ago</div>

							<div class="dropdown-divider"></div>
							<a href="<?= site_url('logout') ?>" class="dropdown-item has-icon text-danger">
								<i class="fas fa-sign-out-alt"></i> Logout
							</a>
						</div>
					</li>
				</ul>
			</nav>