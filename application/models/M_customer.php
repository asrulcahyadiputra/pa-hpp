<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_customer extends CI_Model
{

	public function all()
	{
		return $this->db->get_where('customers', ['deleted' => 0])->result();
	}
	private function customer_id()
	{
		$this->db->select('RIGHT(customer_id,4) as customer_id', FALSE);
		$this->db->order_by('customer_id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('customers');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$id = intval($data->customer_id) + 1;
		} else {
			$id = 1;
		}
		// $tgl = date('dmY');
		$code = str_pad($id, 4, "0", STR_PAD_LEFT);
		$customer_id = "CUS-" . $code;
		return $customer_id;
	}
	public function store()
	{
		$data = [
			'customer_id'		=> $this->customer_id(),
			'cus_name'		=> $this->input->post('cus_name'),
			'cus_address'		=> $this->input->post('cus_address'),
			'cus_phone'		=> $this->input->post('cus_phone'),
			'cus_email'		=> $this->input->post('cus_name'),
		];
		return $this->db->insert('customers', $data);
	}
}

/* End of file M_customer.php */
