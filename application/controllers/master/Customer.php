<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_customer', 'model');
	}

	public function index()
	{
		$data = [
			'title'		=> 'Pelanggan',
			'all'		=> $this->model->all()
		];
		$this->load->view('master/customer/customer-list', $data);
	}
}

/* End of file Customer.php */
