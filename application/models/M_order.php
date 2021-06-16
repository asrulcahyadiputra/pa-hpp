<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_order extends CI_Model
{
	public function customers()
	{
		return $this->db->get_where('customers', ['deleted' => 0])->result_array();
	}
	public function product()
	{
		return $this->db->get_where('products', ['deleted' => 0])->result_array();
	}
	public function find_product($id)
	{
		return $this->db->get_where('products', ['product_id' => $id, 'deleted' => 0])->row_array();
	}
	public function all()
	{
		$this->db->select('a.trans_id,a.customer_id,a.trans_date,b.order_id,b.order_qty,b.order_price,b.order_size,c.customer_id,c.cus_name,d.product_id,d.product_name,d.product_unit,a.status')
			->from('transactions as a')
			->join('orders as b', 'a.trans_id=b.trans_id')
			->join('customers as c', 'c.customer_id=a.customer_id')
			->join('products as d', 'd.product_id=b.product_id');
		return $this->db->get()->result_array();
	}
	private function trans_id()
	{
		$this->db->select('RIGHT(trans_id,4) as trans_id', FALSE);
		$this->db->where('trans_type', 'order');
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
		$trans_id = "TRX-PSN-" . $code;
		return $trans_id;
	}
	public function insert()
	{
		$payment = intval(preg_replace("/[^0-9]/", "", $this->input->post('sales_payment')));
		$data = [
			'trans_id'		=> $this->trans_id(),
			'customer_id'		=> $this->input->post('customer_id'),
			'order_done'		=> 0,
			'trans_total'		=> $this->input->post('order_qty') * $this->input->post('order_price'),
			'trans_type'		=> 'order'
		];
		$order = [
			'trans_id'		=> $this->trans_id(),
			'product_id'		=> $this->input->post('product_id'),
			'order_qty'		=> $this->input->post('order_qty'),
			'order_size'		=> $this->input->post('order_size'),
			'order_price'		=> $this->input->post('order_price')
		];
		if ($payment > 0) {
			$gl = [
				[
					'account_no'		=> '1-10001',
					'trans_id'		=> $this->trans_id(),
					'nominal'			=> $payment,
					'gl_balance'		=> 'd'
				],
				[
					'account_no'		=> '2-10001',
					'trans_id'		=> $this->trans_id(),
					'nominal'			=> $payment,
					'gl_balance'		=> 'k'
				],

			];
			$py = [
				'trans_id'		=> $this->trans_id(),
				'nominal'			=> $payment,
				'description'		=> 'Down Payment (DP)'
			];
		}
		$this->db->trans_start();
		$this->db->insert('transactions', $data);
		$this->db->insert('orders', $order);
		$this->db->insert_batch('general_ledger', $gl);
		$this->db->insert('payments', $py);
		$this->db->trans_complete();
	}
	public function delete($id)
	{
		$validate = $this->db->get_where('transactions', ['trans_id' => $id])->row();
		if ($validate->status > 0) {
			$response = [
				'status' 	=> 0
			];
		} else {
			$this->db->trans_start();
			$this->db->delete('transactions', ['trans_id' => $id]);
			$this->db->trans_complete();
			$response = [
				'status'	=> 1
			];
		}
		return $response;
	}
}

/* End of file M_order.php */
