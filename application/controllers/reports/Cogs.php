<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cogs extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		user_log();
		$this->load->model('M_cogs', 'model');
	}


	public function index()
	{
		$data = [
			'title'			=> 'Harga Pokok Produksi',
		];
		$this->load->view('reports/accounting/cogs_report', $data);
	}

	public function load_report($periode)
	{
		$request = $this->model->getReport($periode);

		echo json_encode($request);
	}
}

/* End of file Controllername.php */
