<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_widget', 'model');
	}


	public function index()
	{
		$data = [
			'title'			=> 'Dashboard',
			'new_purchasing'	=> $this->model->new_purchasing()
		];
		$this->load->view('dashboard', $data);
	}
}

/* End of file Dashboard.php */
