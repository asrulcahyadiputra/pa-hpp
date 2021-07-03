<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="main-sidebar  sidebar-style-2">
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

			<?php $menu = getMenu();
			foreach ($menu as $key => $rowData) : ?>

				<li class="dropdown <?php echo $this->uri->segment(1) == $rowData['id']  ? 'active' : ''; ?>">
					<a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="<?= $rowData['icon'] ?>"></i> <span><?= $rowData['head_name'] ?></span></a>
					<ul class="dropdown-menu">
						<?php foreach ($rowData['menu_item'] as $i => $item) : ?>
							<?php $url_explode = explode('/', $item['url']); ?>
							<li class="<?php echo $this->uri->segment(2) == $url_explode[1] ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url($item['url']); ?>"><?= $item['menu_name'] ?></a></li>
						<?php endforeach ?>
					</ul>
				</li>
			<?php endforeach ?>
		</ul>

	</aside>
</div>