<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Material extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_material', 'model');
	}

	public function index()
	{
		$data = [
			'title'		=> 'Bahan Baku',
			'type'		=> $this->model->type(),
			'all'		=> $this->model->all()
		];
		$this->load->view('master/materials/material-list', $data);
	}
	public function add()
	{
		$rules = [
			[
				'field'		=> 'material_name',
				'label'		=> 'Nama Bahan Baku',
				'rules'		=> 'required|is_unique[raw_materials.material_name]',
				'errors'		=> [
					'required'		=> '%s Wajib di isi',
					'is_unique'		=> '%s sudah digunakan, mohon ganti agar terlihat unik'
				]
			],
			[
				'field'		=> 'material_unit',
				'label'		=> 'Unit',
				'rules'		=> 'required',
				'errors'		=> [
					'required'		=> '%s wajib di isi',
				]
			],
			[
				'field'		=> 'material_type',
				'label'		=> 'Jenis Bahan Baku',
				'rules'		=> 'required',
				'errors'		=> [
					'required'		=> '%s wajib di isi',
				]
			],
			[
				'field'		=> 'material_stock',
				'label'		=> 'Stok Awal',
				'rules'		=> 'required|is_natural',
				'errors'		=> [
					'required'		=> '%s wajib di isi',
					'is_natural'		=> '%s harus angka',
				]
			]
		];
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == false) {
			$this->index();
		} else {
			$this->model->store();
			$this->session->set_flashdata('success', 'Data Bahan Baku Berhasi di Tambahkan.');
			redirect('master/bahan_baku');
		}
	}
	public function edit($id)
	{
		$rules = [
			[
				'field'		=> 'material_name',
				'label'		=> 'Nama Bahan Baku',
				'rules'		=> 'required',
				'errors'		=> [
					'required'		=> '%s Wajib di isi',
				]
			],
			[
				'field'		=> 'material_unit',
				'label'		=> 'Unit',
				'rules'		=> 'required',
				'errors'		=> [
					'required'		=> '%s wajib di isi',
				]
			],
		];
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('error', 'Data Bahan Baku Gagal di perbaharui.');
			redirect('master/bahan_baku');
		} else {
			$customer = $this->db->get_where('raw_materials', ['material_id' => $id, 'deleted' => 0])->row_array();
			if ($customer) {
				$this->model->update($id);
				$this->session->set_flashdata('success', 'Data Bahan Baku Berhasi di perbaharui.');
				redirect('master/bahan_baku');
			} else {
				$this->session->set_flashdata('warning', 'Data Bahan Baku Tidak di temukan.');
				redirect('master/bahan_baku');
			}
		}
	}
	public function deleted($id)
	{
		$customer = $this->db->get_where('raw_materials', ['material_id' => $id])->row_array();
		if ($customer) {
			$this->model->deleted($id);
			$this->session->set_flashdata('success', 'Data Bahan Baku Berhasi di hapus.');
			redirect('master/bahan_baku');
		} else {
			$this->session->set_flashdata('error', 'Data Bahan Baku  Gagal di hapus.');
			redirect('master/bahan_baku');
		}
	}
}

/* End of file Material.php */
