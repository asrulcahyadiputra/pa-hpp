<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		user_log();
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
	public function add()
	{
		$rules = [
			[
				'field'		=> 'cus_name',
				'label'		=> 'Nama Pelanggan',
				'rules'		=> 'required|is_unique[customers.cus_name]',
				'errors'		=> [
					'required'		=> '%s Wajib di isi',
					'is_unique'		=> '%s sudah digunakan, mohon ganti agar terlihat unik'
				]
			],
			[
				'field'		=> 'cus_phone',
				'label'		=> 'No Telepon',
				'rules'		=> 'required|is_natural|max_length[13]|is_unique[customers.cus_phone]',
				'errors'		=> [
					'required'		=> '%s wajib di isi',
					'is_natural'		=> '%s harus angka',
					'max_length'		=> '%s maksimal 13 angka',
					'is_unique'		=> '%s sudah digunakan'
				]
			],
			[
				'field'		=> 'cus_email',
				'label'		=> 'Email',
				'rules'		=> 'valid_email',
				'errors'		=> [
					'valid_email'		=> '%s email tidak valid',
				]
			],
			[
				'field'		=> 'cus_address',
				'label'		=> 'Alamat',
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
			$this->session->set_flashdata('success', 'Data Pelanggan Berhasi di Tambahkan.');
			redirect('master/pelanggan');
		}
	}
	public function edit($id)
	{
		$rules = [
			[
				'field'		=> 'cus_name',
				'label'		=> 'Nama Pelanggan',
				'rules'		=> 'required',
				'errors'		=> [
					'required'		=> '%s Wajib di isi',
				]
			],
			[
				'field'		=> 'cus_phone',
				'label'		=> 'No Telepon',
				'rules'		=> 'required|is_natural|max_length[13]',
				'errors'		=> [
					'required'		=> '%s wajib di isi',
					'is_natural'		=> '%s harus angka',
					'max_length'		=> '%s maksimal 13 angka',
				]
			],
			[
				'field'		=> 'cus_email',
				'label'		=> 'Email',
				'rules'		=> 'valid_email',
				'errors'		=> [
					'valid_email'		=> '%s email tidak valid',
				]
			],
			[
				'field'		=> 'cus_address',
				'label'		=> 'Alamat',
				'rules'		=> 'required',
				'errors'		=> [
					'required'		=> '%s wajib di isi',
				]
			],
		];
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('error', 'Data Pelanggan Gagal di perbaharui.');
			redirect('master/pelanggan');
		} else {
			$customer = $this->db->get_where('customers', ['customer_id' => $id, 'deleted' => 0])->row_array();
			if ($customer) {
				$this->model->update($id);
				$this->session->set_flashdata('success', 'Data Pelanggan Berhasi di perbaharui.');
				redirect('master/pelanggan');
			} else {
				$this->session->set_flashdata('warning', 'Data Pelanggan Tidak di temukan.');
				redirect('master/pelanggan');
			}
		}
	}
	public function deleted($id)
	{
		$customer = $this->db->get_where('customers', ['customer_id' => $id])->row_array();
		if ($customer) {
			$this->model->deleted($id);
			$this->session->set_flashdata('success', 'Data Pelanggan Berhasi di hapus.');
			redirect('master/pelanggan');
		} else {
			$this->session->set_flashdata('error', 'Data Pelanggan Gagal di hapus.');
			redirect('master/pelanggan');
		}
	}
}

/* End of file Customer.php */
