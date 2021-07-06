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
	public function new_order()
	{
		$this->db->select('a.trans_id,a.customer_id,a.trans_date,b.order_id,b.order_qty,b.order_price,c.customer_id,c.cus_name,d.product_id,d.product_name,d.product_unit,a.status')
			->from('transactions as a')
			->join('orders as b', 'a.trans_id=b.trans_id')
			->join('customers as c', 'c.customer_id=a.customer_id')
			->join('products as d', 'd.product_id=b.product_id')
			->limit('5')
			->order_by('trans_date', 'DESC');
		return $this->db->get()->result_array();
	}
	public function sum_customer()
	{
		return $this->db->count_all('customers');
	}
	public function sum_order()
	{
		$this->db->select('count(trans_id) as total')
			->from('transactions')
			->where('trans_type', 'order');
		return $this->db->get()->row_array();
	}
	public function sum_order_done()
	{
		$this->db->select('count(trans_id) as total')
			->from('transactions')
			->where('trans_type', 'order')
			->where('status_bayar', 1);
		return $this->db->get()->row_array();
	}
	public function sum_product()
	{
		return $this->db->count_all('products');
	}
}

/* End of file M_widget.php */
