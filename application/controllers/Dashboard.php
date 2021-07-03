<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		user_log();
		$this->load->model('M_widget', 'model');
	}


	public function index()
	{
		$data = [
			'title'			=> 'Dashboard',
			'new_purchasing'	=> $this->model->new_purchasing(),
			'new_order'		=> $this->model->new_order(),
			'sum_customer'		=> $this->model->sum_customer(),
			'sum_order'		=> $this->model->sum_order(),
			'sum_product'		=> $this->model->sum_product(),
		];

		// $menu = getMenu();
		// echo "<pre>";
		// print_r($menu);
		// echo "</pre>";
		// die;
		$this->load->view('dashboard', $data);
	}
}

/* End of file Dashboard.php */
