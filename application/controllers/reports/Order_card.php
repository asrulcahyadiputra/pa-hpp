<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Order_card extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_order_card', 'model');
	}


	public function index()
	{
		$periode = $this->input->get('periode');

		if ($periode === null) {
			$m = date('m');
			$y = date('Y');
		} else {
			$m = date('m', strtotime($periode));
			$y = date('Y', strtotime($periode));
		}
		$data = [
			'title'			=> 'Kartu Pesanan',
			'all'			=> $this->model->all($y, $m),
			'month'			=> $m,
			'year'			=> $y,
		];
		$this->load->view('reports/accounting/order_card', $data);
	}
}

/* End of file Order_card.php */
