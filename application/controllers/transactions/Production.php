<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Production extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_production','model');
		
	}
	
	public function index()
	{
		$data=[
			'title'		=> 'Produksi'
		];
		$this->load->view('transactions/production/production_list', $data);
		
	}
	public function create(){
		$data=[
			'title'		=> 'Hitung Biaya Produksi',
			'orders'		=> $this->model->orders()
		];
		$this->load->view('transactions/production/create_production', $data);
	}
	public function conversion(){

	}

}

/* End of file Production.php */


?>
