<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Production extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_production', 'model');
	}

	public function index()
	{
		$data = [
			'title'		=> 'Produksi',
			'all'		=> $this->model->all()
		];
		$this->load->view('transactions/production/production_list', $data);
	}
	public function create()
	{
		$data = [
			'title'					=> 'Produksi',
			'orders'				=> $this->model->orders(),
			'employee'				=> $this->model->employee(),
			'overhead_component'	=> $this->model->overhead_component(),
		];
		$this->load->view('transactions/production/create_production', $data);
	}

	public function find_order($id)
	{
		$request = $this->model->find_order($id);

		echo json_encode($request);
	}

	public function load_bom()
	{
		$request = $this->model->load_bom();

		echo json_encode($request);
	}

	public function store()
	{
		$request = $this->model->store();

		echo json_encode($request);
	}


	public function conversion($id_transaksi_order)
	{
		$requesrt =  $this->model->conversion($id_transaksi_order);
		redirect('transaksi/produksi/production_step/' . $requesrt['trans_id']);
	}
	public function production_step($id_transaksi)
	{
		$data = [
			'title'				=> 'Hitung Biaya Produksi (2)',
			'employee'			=> $this->model->employee(),
			'overhead_component'	=> $this->model->overhead_component(),
			'production'			=> $this->model->production($id_transaksi),
			'p_cost'				=> $this->model->production_costs($id_transaksi),
			'btkl'				=> $this->model->btkl($id_transaksi),
			'bop'				=> $this->model->bop($id_transaksi),
			'order'				=> $this->model->find_order_production($id_transaksi),
		];
		$this->load->view('transactions/production/production_step', $data);
	}
	public function store_btkl()
	{
		$id = $this->input->post('trans_id');
		$this->model->store_btkl();
		$this->session->set_flashdata('success', 'BTKL Berhasil ditambahkan !');
		redirect('transaksi/produksi/production_step/' . $id);
	}
	public function delete_btkl($trans_id, $id)
	{
		$request = $this->model->delete_btkl($id);
		$this->session->set_flashdata('success', 'BTKL Berhasil dihapus !');
		redirect('transaksi/produksi/production_step/' . $trans_id);
	}
	public function done_btkl($trans_id, $total)
	{
		$request = $this->model->done_btkl($trans_id, $total);
		$this->session->set_flashdata('success', 'BTKL Berhasil Ditambahkan ke Biaya Produksi !');
		redirect('transaksi/produksi/production_step/' . $trans_id);
	}

	// BOP
	public function store_bop()
	{
		$id = $this->input->post('trans_id');
		$this->model->store_bop();
		$this->session->set_flashdata('success', 'BOP Berhasil ditambahkan !');
		redirect('transaksi/produksi/production_step/' . $id);
	}
	public function delete_bop($trans_id, $id)
	{
		$request = $this->model->delete_bop($id);
		$this->session->set_flashdata('success', 'BOP Berhasil dihapus !');
		redirect('transaksi/produksi/production_step/' . $trans_id);
	}
	public function done_bop($trans_id, $total)
	{
		$request = $this->model->done_bop($trans_id, $total);
		$this->session->set_flashdata('success', 'BOP Berhasil Ditambahkan ke Biaya Produksi !');
		redirect('transaksi/produksi/production_step/' . $trans_id);
	}
	public function done_production($trans_id)
	{
		$request = $this->model->done_production($trans_id);
		$this->session->set_flashdata('success', 'Perhitungan Biaya Produksi Berhasil Dilakukan  !');
		redirect('transaksi/produksi');
	}
}

/* End of file Production.php */
