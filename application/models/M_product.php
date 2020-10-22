<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_product extends CI_Model
{

	public function all()
	{
		return $this->db->get_where('products', ['deleted' => 0])->result();
	}
	private function product_id()
	{
		$this->db->select('RIGHT(product_id,4) as product_id', FALSE);
		$this->db->order_by('product_id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('products');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$id = intval($data->product_id) + 1;
		} else {
			$id = 1;
		}
		// $tgl = date('dmY');
		$code = str_pad($id, 4, "0", STR_PAD_LEFT);
		$product_id = "PRD-" . $code;
		return $product_id;
	}
	public function store()
	{
		$unit_price = intval(preg_replace("/[^0-9]/", "", $this->input->post('sales_price')));
		$data = [
			'product_id'			=> $this->product_id(),
			'product_name'			=> $this->input->post('product_name'),
			'sales_price'			=> $unit_price,
			'product_unit'			=> $this->input->post('product_unit'),
			'product_category'		=> $this->input->post('product_category'),
		];
		return $this->db->insert('products', $data);
	}
	public function update($id)
	{
		$unit_price = intval(preg_replace("/[^0-9]/", "", $this->input->post('sales_price')));
		$data = [
			'product_name'			=> $this->input->post('product_name'),
			'sales_price'			=> $unit_price,
			'product_unit'			=> $this->input->post('product_unit'),
			'product_category'		=> $this->input->post('product_category'),
		];
		return $this->db->update('products', $data, ['product_id' => $id]);
	}
	public function deleted($id)
	{
		date_default_timezone_set("Asia/Jakarta");
		$data = [
			'deleted'		=> 1,
			'deleted_at'	=> date('Y-m-d H:i:s')
		];
		return $this->db->update('products', $data, ['product_id' => $id]);
	}
}

/* End of file M_product.php */
