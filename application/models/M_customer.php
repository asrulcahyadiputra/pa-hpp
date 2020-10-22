<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_customer extends CI_Model
{

	public function all()
	{
		return $this->db->get_where('customers', ['deleted' => 0])->result();
	}
}

/* End of file M_customer.php */
