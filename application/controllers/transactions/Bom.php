<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Bom extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_bom','model');
		
	}
	

	public function index()
	{
		$data=[
			'title'			=> 'Bill of Materials',
			'product'		=> $this->model->get_product(),
			'all'			=> $this->model->get_bom()
		];
		$this->load->view('transactions/bom/bom-list', $data);
		
	}
	// this function for create a new draff
	public function create_draff(){
		$request = $this->model->create_draff();
		redirect('transaksi/bom/create/'.$request['trans_id']);
	}
	public function find_material(){
		$material_id = $this->input->post('material_id');
		$request = $this->model->find_material($material_id);
		echo json_encode($request);
	}
	// this function for display bom form
	public function create($trans_id){
		$validate = $this->db->get_where('transactions',['trans_id' => $trans_id,'status' => 0])->row_array();
		if($validate){
			$data=[
				'title'			=> 'Draf Bill of Materials Baru',
				'trans_id'		=> $trans_id,
				'materials'		=> $this->model->get_materials(),
				'product'		=> $this->model->select_product($trans_id),
				'bom'			=> $this->model->select_bom($trans_id)
			];
			$this->load->view('transactions/bom/create-bom', $data);
		}else{
			$this->session->set_flashdata('error', 'Draf Bill of Materials gagal dibuat !');
			redirect('transaksi/bom','refresh');
		}
	}
	// this function for store item to bom
	public function store_item(){
		$request = $this->model->insert_item();
		redirect('transaksi/bom/create/'.$request['trans_id']);
	}
	// this function for destroy item to bom
	public function delete_item($trans_id,$material_id){
		$request = $this->model->delete_item($trans_id,$material_id);
		redirect('transaksi/bom/create/'.$trans_id);
	}
	// this function for store bom final 
	public function store($trans_id){
		$request = $this->model->store($trans_id);
		$this->session->set_flashdata('success', 'Bill of Materials berhasil dibuat !');
		redirect('transaksi/bom');
	}
	// this function for updated bom final 
	public function update($trans_id){
		$request = $this->model->update($trans_id);
		redirect('transaksi/bom/create/'.$trans_id);
	}
	public function show($trans_id){
		$validate = $this->db->get_where('transactions',['trans_id' => $trans_id,'status' => 0])->row_array();
		if($validate){
			redirect('transaksi/bom/create/'.$trans_id);
		}else{
			$data=[
				'title'			=> 'Bill of Materials',
				'trans_id'		=> $trans_id,
				'product'		=> $this->model->select_product($trans_id),
				'bom'			=> $this->model->select_bom($trans_id)
			];
			$this->load->view('transactions/bom/detail-bom', $data);
		}
		
	}
	public function destroy($trans_id){
		$validate = $this->db->get_where('transactions',['trans_id' => $trans_id,'status' => 1])->row_array();
		if($validate){
			$this->session->set_flashdata('warning', 'Bill of Materials tidak dapat dihapus !');
			redirect('transaksi/bom');
		}else{
			$this->model->delete($trans_id);
			$this->session->set_flashdata('success', 'Bill of Materials berhasil dihapus !');
			redirect('transaksi/bom');
		}
		
	}

}

/* End of file Bom.php */
