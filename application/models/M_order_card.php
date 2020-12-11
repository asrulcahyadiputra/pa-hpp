<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_order_card extends CI_Model
{

	public function all($y, $m)
	{
		$this->db->select('b.trans_date,b.trans_id,c.material_cost,c.direct_labor_cost,c.overhead_cost')
			->from('transactions as a ')
			->join('transactions as b ', 'a.ref_production=b.trans_id')
			->join('production_costs as c ', 'c.trans_id=a.trans_id')
			->where('year(b.trans_date)', $y)
			->where('month(b.trans_date)', $m);
		return $this->db->get()->result_array();
	}
}

/* End of file M_order_card.php */
