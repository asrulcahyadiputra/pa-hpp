<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		user_log();
		$this->load->model('M_product', 'model');
	}

	public function index()
	{
		$data = [
			'title'		=> 'Produk',
			'all'		=> $this->model->all()
		];
		$this->load->view('master/product/product-list', $data);
	}
	public function add()
	{
		$rules = [
			[
				'field'		=> 'product_name',
				'label'		=> 'Nama Produk',
				'rules'		=> 'required|is_unique[products.product_name]',
				'errors'		=> [
					'required'		=> '%s Wajib di isi',
					'is_unique'		=> '%s sudah digunakan, mohon ganti agar terlihat unik'
				]
			],
			[
				'field'		=> 'product_unit',
				'label'		=> 'Unit',
				'rules'		=> 'required',
				'errors'		=> [
					'required'		=> '%s wajib di isi',
				]
			],
			[
				'field'		=> 'sales_price',
				'label'		=> 'Harga Jual',
				'rules'		=> 'required',
				'errors'		=> [
					'valid_email'		=> '%s waib di isi',
				]
			],
			[
				'field'		=> 'product_category',
				'label'		=> 'Kategori Produk',
				'rules'		=> 'required',
				'errors'		=> [
					'required'		=> '%s wajib di isi',
				]
			],
		];
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == false) {
			$this->index();
		} else {
			$this->model->store();
			$this->session->set_flashdata('success', 'Data Produk Berhasi di Tambahkan.');
			redirect('master/produk');
		}
	}
	public function edit($id)
	{
		$rules = [
			[
				'field'		=> 'product_name',
				'label'		=> 'Nama Produk',
				'rules'		=> 'required',
				'errors'		=> [
					'required'		=> '%s Wajib di isi',
				]
			],
			[
				'field'		=> 'product_unit',
				'label'		=> 'Unit',
				'rules'		=> 'required',
				'errors'		=> [
					'required'		=> '%s wajib di isi',
				]
			],
			[
				'field'		=> 'sales_price',
				'label'		=> 'Harga Jual',
				'rules'		=> 'required',
				'errors'		=> [
					'valid_email'		=> '%s waib di isi',
				]
			],
			[
				'field'		=> 'product_category',
				'label'		=> 'Kategori Produk',
				'rules'		=> 'required',
				'errors'		=> [
					'required'		=> '%s wajib di isi',
				]
			],
		];
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('error', 'Data Produk Gagal di perbaharui.');
			redirect('master/produk');
		} else {
			$customer = $this->db->get_where('products', ['product_id' => $id, 'deleted' => 0])->row_array();
			if ($customer) {
				$this->model->update($id);
				$this->session->set_flashdata('success', 'Data Produk Berhasi di perbaharui.');
				redirect('master/produk');
			} else {
				$this->session->set_flashdata('warning', 'Data Produk Tidak di temukan.');
				redirect('master/produk');
			}
		}
	}
	public function deleted($id)
	{
		$customer = $this->db->get_where('products', ['product_id' => $id])->row_array();
		if ($customer) {
			$this->model->deleted($id);
			$this->session->set_flashdata('success', 'Data Produk Berhasi di hapus.');
			redirect('master/produk');
		} else {
			$this->session->set_flashdata('error', 'Data Produk  Gagal di hapus.');
			redirect('master/produk');
		}
	}
}

/* End of file Product.php */
