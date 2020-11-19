<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_bom extends CI_Model {

	public function get_product(){
		return $this->db->get_where('products', ['deleted' => 0])->result_array();
	}
	public function select_product($id){
		$this->db->select('a.product_id,a.product_name,a.sales_price,a.product_unit,a.product_category')
			->from('products as a')
			->join('transactions as b','a.product_id=b.product_id')
			->where('b.trans_id',$id);
		return $this->db->get()->row_array();
	}
	public function get_bom(){
		$this->db->select('a.trans_id,a.product_id,b.product_name,a.status,a.date_created,a.updated_at')
			->from('transactions as a')
			->join('products as b','a.product_id=b.product_id');
		return $this->db->get()->result_array();
	}
	public function select_bom($id){
		$this->db->select('a.material_id,a.qty,a.unit,b.material_name,a.trans_id')
			->from('bill_of_materials as a')
			->join('raw_materials as b','a.material_id=b.material_id')
			->where('a.trans_id',$id);
		return $this->db->get()->result_array();
	}
	public function get_materials(){
		return $this->db->get_where('raw_materials', ['deleted' => 0])->result_array();
	}
	public function find_material($id){
		return $this->db->get_where('raw_materials', ['material_id' => $id,'deleted' => 0])->row_array();
	}
	private function trans_id()
	{
		$this->db->select('RIGHT(trans_id,4) as trans_id', FALSE);
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
		$trans_id = "TRX-BOM-" . $code;
		return $trans_id;
	}
	public function create_draff(){
		$data=[
			'trans_id'		=> $this->trans_id(),
			'product_id'		=> $this->input->post('product_id')
		];
		if($this->db->insert('transactions',$data)){
			return $data;
		}else{
			return $data;
		}
	}
	public function insert_item(){
		$rm = $this->db->get_where('raw_materials',['material_id' => $this->input->post('material_id')])->row();
		$validate = $this->db->get_where('bill_of_materials',['trans_id' =>$this->input->post('trans_id'),'material_id' =>$this->input->post('material_id')  ])->row();
		if($validate){
			$data=[
				'trans_id'		=> $this->input->post('trans_id'),
				'material_id'		=> $this->input->post('material_id'),
				'qty'			=> $this->input->post('qty') + $validate->qty,
			];
			if($this->db->update('bill_of_materials',$data,['material_id' =>$this->input->post('material_id'),'trans_id' =>$this->input->post('trans_id')  ])){
				return $data;
			}else{
				return $data;
			}
		}else{
			$data=[
				'trans_id'		=> $this->input->post('trans_id'),
				'material_id'		=> $this->input->post('material_id'),
				'qty'			=> $this->input->post('qty'),
				'unit'			=> $rm->material_unit
			];
			if($this->db->insert('bill_of_materials',$data)){
				return $data;
			}else{
				return $data;
			}
		}
		
	}
	public function store($trans_id){
		$data=[
			'trans_id'		=> $trans_id,
			'status'			=> 1
		];
		if($this->db->update('transactions',$data,['trans_id' => $trans_id])){
			return $data;
		}else{
			return $data;
		}
	}
	public function update($trans_id){
		$data=[
			'trans_id'		=> $trans_id,
			'status'			=> 0
		];
		if($this->db->update('transactions',$data,['trans_id' => $trans_id])){
			return $data;
		}else{
			return $data;
		}
	}
	public function delete_item($trans_id,$material_id){
		return $this->db->delete('bill_of_materials',['trans_id' => $trans_id,'material_id' => $material_id]);
	}
	public function delete($trans_id){
		$this->db->trans_start();
		$this->db->delete('bill_of_materials',['trans_id' => $trans_id]);
		$this->db->delete('transactions',['trans_id' => $trans_id]);
		
		$this->db->trans_complete();
	}
}

/* End of file M_bom.php */

?>
