<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_employee extends CI_Model
{

	public function all()
	{
		return $this->db->get_where('employees', ['status' => 1])->result();
	}
	private function employee_id()
	{
		$this->db->select('RIGHT(employee_id,4) as employee_id', FALSE);
		$this->db->order_by('employee_id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('employees');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$id = intval($data->employee_id) + 1;
		} else {
			$id = 1;
		}
		// $tgl = date('dmY');
		$code = str_pad($id, 4, "0", STR_PAD_LEFT);
		$employee_id = "KAR-" . $code;
		return $employee_id;
	}
	public function store()
	{
		$data = [
			'employee_id'			=> $this->employee_id(),
			'employee_name'			=> $this->input->post('employee_name'),
			'employee_address'		=> $this->input->post('employee_address'),
			'department'			=> $this->input->post('department'),
			'employee_phone'		=> $this->input->post('employee_phone'),
		];
		return $this->db->insert('employees', $data);
	}
	public function update($id)
	{
		$data = [
			'employee_name'			=> $this->input->post('employee_name'),
			'employee_address'		=> $this->input->post('employee_address'),
			'department'			=> $this->input->post('department'),
			'employee_phone'		=> $this->input->post('employee_phone'),
		];
		return $this->db->update('employees', $data, ['employee_id' => $id]);
	}
	public function deleted($id)
	{
		$data = [
			'status'		=> 0
		];
		return $this->db->update('employees', $data, ['employee_id' => $id]);
	}
}

/* End of file M_employee.php */
