<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_widget extends CI_Model
{

	public function new_purchasing()
	{
		$this->db->limit(5);
		$this->db->order_by('trans_date', 'DESC');
		return $this->db->get_where('transactions', ['trans_type' => 'purchasing'])->result_array();
	}
}

/* End of file M_widget.php */
