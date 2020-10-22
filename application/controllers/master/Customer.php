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
			redirect('master/pelanggan');
		} else {
			$this->model->update($id);
			redirect('master/pelanggan');
		}
	}
	public function deleted($id)
	{
	}
}

/* End of file Customer.php */
