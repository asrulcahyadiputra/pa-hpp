<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ledger extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_ledger', 'model');
	}


	public function index()
	{
		$periode = $this->input->post('periode');
		$account_name    = $this->input->post('account_name');
		if ($periode === null || $account_name === null) {
			$m = date('m');
			$y = date('Y');
			$a = 'Kas';
		} else {
			$m = date('m', strtotime($periode));
			$y = date('Y', strtotime($periode));
			$a = $account_name;
		}
		$data = [
			'title'			=> 'Buku Besar',
			'all'			=> $this->model->all($y, $m, $a),
			'sub'			=> $this->model->sub_akun(),
			'list_akun'		=> $this->model->akun(),
			'row_ledger'		=> $this->model->get_row_jurnal($y, $m),
			'first'			=> $this->model->first($y, $m, $a),
			'month'			=> $m,
			'year'			=> $y,
			'akun'			=> $a
		];
		// echo "<pre>";
		// print_r($data['first']);
		// echo "</pre>";
		// die;
		$this->load->view('reports/accounting/ledger', $data);
	}
}

/* End of file Ledger.php */
