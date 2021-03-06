<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bom extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		user_log();
		$this->load->model('M_bom', 'model');
	}


	public function index()
	{
		$data = [
			'title'			=> 'Bill of Materials',
			'products'		=> $this->model->get_product(),
			'materials'		=> $this->model->get_materials(),
		];
		$this->load->view('transactions/bom/bom-list', $data);
	}

	public function get_bom()
	{
		$request = $this->model->get_bom();

		echo json_encode($request);
	}

	public function find($id)
	{
		$request = $this->model->select_bom($id);

		echo json_encode($request);
	}


	public function edit($id)
	{
		$request = $this->model->find_bom($id);
		echo json_encode($request);
	}


	// this function for store bom final 
	public function store()
	{
		$request = $this->model->store();

		echo json_encode($request);
	}
	// this function for updated bom final 
	public function update($trans_id)
	{
		$request = $this->model->update($trans_id);
		redirect('transaksi/bom/create/' . $trans_id);
	}
	public function show($trans_id)
	{
		$validate = $this->db->get_where('transactions', ['trans_id' => $trans_id, 'status' => 0])->row_array();
		if ($validate) {
			redirect('transaksi/bom/create/' . $trans_id);
		} else {
			$data = [
				'title'			=> 'Bill of Materials',
				'trans_id'		=> $trans_id,
				'product'		=> $this->model->select_product($trans_id),
				'bom'			=> $this->model->select_bom($trans_id)
			];
			$this->load->view('transactions/bom/detail-bom', $data);
		}
	}

	public function delete($id)
	{
		$request = $this->model->delete($id);
		echo json_encode($request);
	}
}

/* End of file Bom.php */
