<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_material extends CI_Model
{

	public function all()
	{
		$this->db->select('a.material_id,a.material_name,a.material_stock,a.material_unit,a.deleted,b.id as type_id,b.name as type_name')
			->from('raw_materials as a')
			->join('type_of_materials as b','a.material_type=b.id')
			->where('a.deleted',0);
		return $this->db->get()->result();
	}
	public function type(){
		return $this->db->get('type_of_materials')->result();
	}
	private function material_id()
	{
		$this->db->select('RIGHT(material_id,4) as material_id', FALSE);
		$this->db->order_by('material_id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('raw_materials');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$id = intval($data->material_id) + 1;
		} else {
			$id = 1;
		}
		// $tgl = date('dmY');
		$code = str_pad($id, 4, "0", STR_PAD_LEFT);
		$material_id = "MTR-" . $code;
		return $material_id;
	}
	public function store()
	{

		$data = [
			'material_id'			=> $this->material_id(),
			'material_name'		=> $this->input->post('material_name'),
			'material_unit'		=> $this->input->post('material_unit'),
			'material_type'		=> $this->input->post('material_type'),
			'material_stock'		=> $this->input->post('material_stock'),
		];
		return $this->db->insert('raw_materials', $data);
	}
	public function update($id)
	{
		$data = [
			'material_id'			=> $this->material_id(),
			'material_name'		=> $this->input->post('material_name'),
			'material_unit'		=> $this->input->post('material_unit'),
			'material_type'		=> $this->input->post('material_type'),
		];
		return $this->db->update('raw_materials', $data, ['material_id' => $id]);
	}
	public function deleted($id)
	{
		date_default_timezone_set("Asia/Jakarta");
		$data = [
			'deleted'		=> 1,
			'deleted_at'	=> date('Y-m-d H:i:s')
		];
		return $this->db->update('raw_materials', $data, ['material_id' => $id]);
	}
}

/* End of file M_material.php */
