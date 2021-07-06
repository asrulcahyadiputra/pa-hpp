<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		user_log();
		$this->load->model('M_order', 'model');
	}

	public function index()
	{
		$data = [
			'title'					=> 'Pesanan',
			'product'				=> $this->model->product(),
			'customers'				=> $this->model->customers()
		];
		$this->load->view('transactions/order/order-list', $data);
	}
	public function select($id)
	{
		$request = $this->model->find_pesanan($id);
		echo json_encode($request);
	}
	public function get_order()
	{
		$request = $this->model->all();
		echo json_encode($request);
	}
	public function find_product()
	{
		$id  = $this->input->post('product_id');
		$request = $this->model->find_product($id);
		echo json_encode($request);
	}

	public function store()
	{
		$request = $this->model->insert();
		echo json_encode($request);
	}

	public function lunas()
	{
		$id = $this->input->post('trans_id');
		$request = $this->model->pelunasan($id);
		echo json_encode($request);
	}



	public function delete($id)
	{
		$request = $this->model->delete($id);
		if ($request['status'] == 1) {
			$this->session->set_flashdata('success', 'Pesanan berhasil dibuat !');
			redirect('transaksi/pesanan');
		} else {
			$this->session->set_flashdata('warning', 'Pesanan tidak dapat dihapus !');
			redirect('transaksi/pesanan');
		}
	}
}

/* End of file Order.php */
