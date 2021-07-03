<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		user_log();
		$this->load->model('M_employee', 'model');
	}

	public function index()
	{
		$data = [
			'title'		=> 'Karyawan',
			'all'		=> $this->model->all()
		];
		$this->load->view('master/employee/employees', $data);
	}
	public function add()
	{
		$rules = [
			[
				'field'		=> 'employee_name',
				'label'		=> 'Nama Karyawan',
				'rules'		=> 'required|is_unique[employees.employee_name]',
				'errors'		=> [
					'required'		=> '%s Wajib di isi',
					'is_unique'		=> '%s sudah digunakan, mohon ganti agar terlihat unik'
				]
			],
			[
				'field'		=> 'department',
				'label'		=> 'Bidang',
				'rules'		=> 'required',
				'errors'		=> [
					'required'		=> '%s wajib di isi',
				]
			],
			[
				'field'		=> 'employee_phone',
				'label'		=> 'No Telepon',
				'rules'		=> 'required|is_natural|max_length[13]|is_unique[employees.employee_phone]',
				'errors'		=> [
					'required'		=> '%s wajib di isi',
					'is_natural'		=> '%s harus angka',
					'max_length'		=> '%s maksimal 13 angka',
					'is_unique'		=> '%s sudah digunakan'
				]
			],
			[
				'field'		=> 'employee_address',
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
			$this->session->set_flashdata('success', 'Data Karyawan Berhasi di Tambahkan.');
			redirect('master/karyawan');
		}
	}
	public function edit($id)
	{
		$rules = [
			[
				'field'		=> 'employee_name',
				'label'		=> 'Nama Karyawan',
				'rules'		=> 'required',
				'errors'		=> [
					'required'		=> '%s Wajib di isi',
				]
			],
			[
				'field'		=> 'department',
				'label'		=> 'Bidang',
				'rules'		=> 'required',
				'errors'		=> [
					'required'		=> '%s wajib di isi',
				]
			],
			[
				'field'		=> 'employee_phone',
				'label'		=> 'No Telepon',
				'rules'		=> 'required|is_natural|max_length[13]',
				'errors'		=> [
					'required'		=> '%s wajib di isi',
					'is_natural'		=> '%s harus angka',
					'max_length'		=> '%s maksimal 13 angka',
				]
			],

			[
				'field'		=> 'employee_address',
				'label'		=> 'Alamat',
				'rules'		=> 'required',
				'errors'		=> [
					'required'		=> '%s wajib di isi',
				]
			],
		];
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('error', 'Data Karayawan Gagal di perbaharui.');
			redirect('master/karyawan');
		} else {
			$employee = $this->db->get_where('employees', ['employee_id' => $id, 'status' => 1])->row_array();
			if ($employee) {
				$this->model->update($id);
				$this->session->set_flashdata('success', 'Data Karyawan Berhasi di perbaharui.');
				redirect('master/karyawan');
			} else {
				$this->session->set_flashdata('warning', 'Data Karyawan Tidak di temukan.');
				redirect('master/karyawan');
			}
		}
	}
	public function deleted($id)
	{
		$customer = $this->db->get_where('employees', ['employee_id' => $id, 'status' => 1])->row_array();
		if ($customer) {
			$this->model->deleted($id);
			$this->session->set_flashdata('success', 'Data Karyawan Berhasi di hapus.');
			redirect('master/karyawan');
		} else {
			$this->session->set_flashdata('error', 'Data Karyawan Gagal di hapus.');
			redirect('master/karayawan');
		}
	}
}

/* End of file Employee.php */
