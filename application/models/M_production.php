<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_production extends CI_Model
{

	public function orders()
	{
		$this->db->select('a.trans_id,a.customer_id,b.order_id,b.order_qty,b.order_price,c.customer_id,c.cus_name,d.product_id,d.product_name,d.product_unit,a.status')
			->from('transactions as a')
			->join('orders as b', 'a.trans_id=b.trans_id')
			->join('customers as c', 'c.customer_id=a.customer_id')
			->join('products as d', 'd.product_id=b.product_id')
			->order_by('a.trans_id', 'ASC');
		return $this->db->get()->result_array();
	}
	public function find_order($id)
	{
		$this->db->select('a.trans_id,a.trans_date,a.customer_id,b.order_id,b.order_qty,b.order_price,c.customer_id,c.cus_name,d.product_id,d.product_name,d.product_unit,a.status')
			->from('transactions as a')
			->join('orders as b', 'a.trans_id=b.trans_id')
			->join('customers as c', 'c.customer_id=a.customer_id')
			->join('products as d', 'd.product_id=b.product_id')
			->where('a.trans_id', $id);
		return $this->db->get()->row_array();
	}
	public function find_bom($id)
	{
		$find = $this->find_order($id);
		$this->db->select('a.material_id,a.qty,a.unit,b.material_name,a.trans_id,avg(d.purchase_price) as unit_price,b.material_type')
			->from('transactions as c')
			->join('bill_of_materials as a', 'a.trans_id=c.trans_id')
			->join('raw_materials as b', 'a.material_id=b.material_id')
			->join('purchase as d', 'd.material_id=b.material_id')
			->where('c.product_id', $find['product_id'])
			->group_by('a.material_id');
		return $this->db->get()->result_array();
	}
	private function trans_id()
	{
		$this->db->select('RIGHT(trans_id,9) as trans_id', FALSE);
		$this->db->where('trans_type', 'production');
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
		$trans_id = "TRX-PRD-" . $code;
		return $trans_id;
	}
}

/* End of file M_production.php */
