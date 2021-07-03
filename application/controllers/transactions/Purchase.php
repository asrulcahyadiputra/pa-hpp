<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Purchase extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		user_log();
		$this->load->model('M_purchase', 'model');
	}


	public function index()
	{
		$data = [
			'title'		=> 'Pembelian',
			'all'		=> $this->model->all()
		];
		$this->load->view('transactions/purchase/purchasing-list', $data);
	}
	public function create_draff()
	{
		$request = $this->model->create_draff();
		if ($request['status'] == 1) {
			$this->session->set_flashdata('sukses', 'Berhasil membuat draf pembelian');
			redirect('transaksi/pembelian/draff/' . $request['trans_id']);
		} else {
			$this->session->set_flashdata('error', 'Gagal membuat draf pembelian');
			redirect('transaksi/pembelian');
		}
	}
	public function create($trans_id)
	{
		$validate = $this->db->get_where('transactions', ['trans_id' => $trans_id])->row_array();

		if ($validate['status'] > 0) {
			$data = [
				'title'		=> 'Detail Pembelian ',
				'trans_id'	=> $trans_id,
				'materials'	=> $this->model->raw_materials(),
				'details'		=> $this->model->select_raw_materials($trans_id)
			];
			$this->load->view('transactions/purchase/detail_purchase', $data);
		} else {
			$data = [
				'title'		=> 'Buat Pembelian Baru',
				'trans_id'	=> $trans_id,
				'materials'	=> $this->model->raw_materials(),
				'details'		=> $this->model->select_raw_materials($trans_id)
			];
			$this->load->view('transactions/purchase/create_purchase', $data);
		}
	}
	public function add_item()
	{
		$request = $this->model->insert_item();
		redirect('transaksi/pembelian/draff/' . $request['trans_id']);
	}
	public function delete_item($purchase_id, $trans_id)
	{
		$request = $this->model->delete_item($purchase_id, $trans_id);
		redirect('transaksi/pembelian/draff/' . $request['trans_id']);
	}
	public function store($trans_id, $tb, $tp, $total)
	{
		$request = $this->model->store($trans_id, $tb, $tp, $total);
		$this->session->set_flashdata('success', 'Pembelian Berhasil dilakukan !');
		redirect('transaksi/pembelian');
	}
}

/* End of file Purchase.php */
