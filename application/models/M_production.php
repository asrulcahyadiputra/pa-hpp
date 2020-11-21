<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_production extends CI_Model {

	public function orders(){
		$this->db->select('a.trans_id,a.customer_id,b.order_id,b.order_qty,b.order_price,c.customer_id,c.cus_name,d.product_id,d.product_name,d.product_unit,a.status')
			->from('transactions as a')
			->join('orders as b','a.trans_id=b.trans_id')
			->join('customers as c','c.customer_id=a.customer_id')
			->join('products as d','d.product_id=b.product_id')
			->order_by('a.trans_id','ASC');
		return $this->db->get()->result_array();
	}

}

/* End of file M_production.php */

?>
