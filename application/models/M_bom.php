<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_bom extends CI_Model
{

	public function get_product()
	{
		return $this->db->get_where('products', ['deleted' => 0])->result_array();
	}
	public function get_employees()
	{
		return $this->db->get_where('employees', ['status' => 1])->result_array();
	}
	public function overhead_component()
	{
		return $this->db->get('overhead_component')->result_array();
	}
	public function select_product($id)
	{
		$this->db->select('a.product_id,a.product_name,a.sales_price,a.product_unit,a.product_category')
			->from('products as a')
			->join('transactions as b', 'a.product_id=b.product_id')
			->where('b.trans_id', $id);
		return $this->db->get()->row_array();
	}
	public function get_bom()
	{
		$sql = $this->db->select('a.trans_id,a.product_id,b.product_name,a.description,a.status,a.lock_doc,a.date_created,a.updated_at')
			->from('transactions as a')
			->join('products as b', 'a.product_id=b.product_id')
			->order_by('a.date_created', 'DESC')
			->get()
			->result_array();


		$totData = count($sql);
		$no = 1;

		if ($totData > 0) {
			foreach ($sql as $key => $val) {
				if ($val['lock_doc'] == 1) {
					$html = '<i class="fa fa-unlock"></i>';
				} else {
					$html = '<i class="fa fa-lock"></i>';
				}
				$data[] = [
					'no' 			=> $no++,
					'kode_bom' 		=> $val['trans_id'],
					'description'	=> $val['description'],
					'product'		=> $val['product_id'] . ' - ' . $val['product_name'],
					'lock_doc'		=> $html
				];
			}
		} else {
			$data = null;
		}

		$response = [
			'total_data'	=> $totData,
			'values'		=> $data
		];

		return $response;
	}



	public function find_bom($id)
	{
		// find bom document open
		$sql1 = $this->db->get_where('transactions', ['trans_id' => $id, 'lock_doc' => 1])->result_array();

		$totData = count($sql1);

		if ($totData > 0) {
			foreach ($sql1 as $i => $val) {
				$sql2 = $this->db->get_where('bill_of_materials', ['trans_id' => $val['trans_id']])->result_array();
				$data = [
					'status'		=> true,
					'total_data'	=> $totData,
					'trans_id'		=> $val['trans_id'],
					'product_id'	=> $val['product_id'],
					'description'	=> $val['description'],
					'details'		=> $sql2
				];
			}

			$response = $data;
		} else {
			$response = [
				'status'			=> false,
				'title'				=> 'Gagal!',
				'message'			=> 'Data Dalam Keadaan Terkunci',
				'type'				=> 'error',
				'data'				=> null,
				'system_response'   => ''
			];
		}
		return $response;
	}



	public function select_bom($id)
	{
		$sql1 = $this->db->select('a.trans_id,a.product_id,b.product_name,a.description,a.status,a.lock_doc,a.date_created,a.updated_at')
			->from('transactions as a')
			->join('products as b', 'a.product_id=b.product_id')
			->where('trans_id', $id)
			->get()
			->result_array();

		$totData = count($sql1);
		foreach ($sql1 as $i => $val) {
			$sql2 = $this->db->select('a.material_id,a.qty,a.unit,b.material_name,a.trans_id,b.material_unit')
				->from('bill_of_materials as a')
				->join('raw_materials as b', 'a.material_id=b.material_id')
				->where('a.trans_id', $val['trans_id'])
				->get()
				->result_array();
			$data[] = [
				'trans_id'		=> $val['trans_id'],
				'produk'		=> $val['product_id'] . ' - ' . $val['product_name'],
				'keterangan'	=> $val['description'],
				'details'		=> $sql2
			];
		}


		$response = $data;
		return $response;
	}
	public function get_materials()
	{
		return $this->db->get_where('raw_materials', ['deleted' => 0])->result_array();
	}
	public function find_material($id)
	{
		return $this->db->get_where('raw_materials', ['material_id' => $id, 'deleted' => 0])->row_array();
	}
	private function trans_id()
	{
		$this->db->select('RIGHT(trans_id,4) as trans_id', FALSE);
		$this->db->where('trans_type', 'bom');
		$this->db->order_by('trans_id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('transactions');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$id = intval($data->trans_id) + 1;
		} else {
			$id = 1;
		}
		$code = str_pad($id, 9, "0", STR_PAD_LEFT);
		$trans_id = "TRX-BOM-" . $code;
		return $trans_id;
	}
	public function create_draff()
	{
		$data = [
			'trans_id'		=> $this->trans_id(),
			'product_id'		=> $this->input->post('product_id'),
			'trans_type'		=> 'bom'
		];
		if ($this->db->insert('transactions', $data)) {
			return $data;
		} else {
			return $data;
		}
	}
	public function insert_item()
	{
		$rm = $this->db->get_where('raw_materials', ['material_id' => $this->input->post('material_id')])->row();
		$validate = $this->db->get_where('bill_of_materials', ['trans_id' => $this->input->post('trans_id'), 'material_id' => $this->input->post('material_id')])->row();
		if ($validate) {
			$data = [
				'trans_id'		=> $this->input->post('trans_id'),
				'material_id'		=> $this->input->post('material_id'),
				'qty'			=> $this->input->post('qty') + $validate->qty,
			];
			if ($this->db->update('bill_of_materials', $data, ['material_id' => $this->input->post('material_id'), 'trans_id' => $this->input->post('trans_id')])) {
				return $data;
			} else {
				return $data;
			}
		} else {
			$data = [
				'trans_id'		=> $this->input->post('trans_id'),
				'material_id'		=> $this->input->post('material_id'),
				'qty'			=> $this->input->post('qty'),
				'unit'			=> $rm->material_unit
			];
			if ($this->db->insert('bill_of_materials', $data)) {
				return $data;
			} else {
				return $data;
			}
		}
	}
	public function store()
	{
		$trans_id = $this->trans_id();
		$material_id = $this->input->post('material_id');
		$product_id = $this->input->post('product_id');
		$description = $this->input->post('description');
		$periode = date('Y') . '' . date('m');

		$transactions = [
			'trans_id'			=> $trans_id,
			'periode'			=> $periode,
			'product_id'		=> $product_id,
			'description'		=> $description,
			'trans_type'		=> 'bom'
		];


		foreach ($material_id as $x => $values) {
			$materials[] = [
				'trans_id'		=> $trans_id,
				'material_id'	=> $material_id[$x],
				'qty'			=> $this->input->post('qty')[$x]
			];
		}


		$this->db->trans_start();
		$this->db->insert('transactions', $transactions);
		$this->db->insert_batch('bill_of_materials', $materials);
		$this->db->trans_complete();
		if ($this->db->trans_status() == true) {
			$response = [
				'status'		=> $this->db->trans_status(),
				'title'			=> 'Berhasil!',
				'message'		=> 'Data Berhasil di Simpan dengan kode ' . $trans_id,
				'type'			=> 'success',
				'data'			=> [
					'bom_desc'		=> $transactions,
					'bom_details'	=> $materials
				]
			];
		} else {
			$response = [
				'status'			=> $this->db->trans_status(),
				'title'				=> 'Gagal!',
				'message'			=> 'Data Gagal Disimpan',
				'type'				=> 'error',
				'data'				=> null,
				'system_response'   => $this->db->trans_status()
			];
		}
		return $response;
	}
	public function update($trans_id)
	{
		$data = [
			'trans_id'		=> $trans_id,
			'status'			=> 0
		];
		if ($this->db->update('transactions', $data, ['trans_id' => $trans_id])) {
			return $data;
		} else {
			return $data;
		}
	}
	public function delete_item($trans_id, $material_id)
	{
		return $this->db->delete('bill_of_materials', ['trans_id' => $trans_id, 'material_id' => $material_id]);
	}
	public function delete($trans_id)
	{
		$this->db->trans_start();
		$this->db->delete('bill_of_materials', ['trans_id' => $trans_id]);
		$this->db->delete('transactions', ['trans_id' => $trans_id]);

		$this->db->trans_complete();
	}
}

/* End of file M_bom.php */
