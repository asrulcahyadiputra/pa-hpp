<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function index()
	{
		$data=[
			'title'		=> 'Pesanan'
		];
		$this->load->view('transactions/order/order-list', $data);
		
	}

}

/* End of file Order.php */

?>
