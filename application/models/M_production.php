<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_production extends CI_Model
{
	public function all()
	{
		return $this->db->get_where('transactions', ['trans_type' => 'production'])->result_array();
	}
	public function employee()
	{
		return $this->db->get_where('employees', ['status' => 1])->result_array();
	}
	public function overhead_component()
	{
		return $this->db->get('overhead_component')->result_array();
	}

	public function orders()
	{
		$this->db->select('a.trans_id,a.customer_id,c.customer_id,c.cus_name')
			->from('transactions as a')
			->join('customers as c', 'c.customer_id=a.customer_id')
			->where('a.status_production', 0)
			->order_by('a.trans_id', 'ASC');
		return $this->db->get()->result_array();
	}
	public function find_order($id)
	{
		$sql = $this->db->select('a.trans_id,a.trans_date,a.customer_id,b.order_id,b.order_size,b.order_qty,b.order_price,c.customer_id,c.cus_name,d.product_id,d.product_name,d.product_unit,a.status')
			->from('transactions as a')
			->join('orders as b', 'a.trans_id=b.trans_id')
			->join('customers as c', 'c.customer_id=a.customer_id')
			->join('products as d', 'd.product_id=b.product_id')
			->where('a.trans_id', $id)
			->get()
			->result_array();
		foreach ($sql as $key => $val) {
			$bom_opsi = $this->db->get_where('transactions', ['trans_type' => 'bom', 'product_id' => $val['product_id']])->result_array();
			$data[] = [
				'product_id'		=> $val['product_id'],
				'product_name'		=> $val['product_name'],
				'order_qty'			=> $val['order_qty'],
				'order_size'		=> $val['order_size'],
				'opsi'				=> $bom_opsi
			];
		}

		return $data;
	}

	public function load_bom()
	{

		$where = [];
		$kode_bom = $this->input->post('kode_bom');
		$order_qty = $this->input->post('order_qty');
		foreach ($kode_bom as $i => $val) {
			$sql = $this->db->select('a.trans_id,a.material_id,b.material_name,a.qty,b.material_unit,b.material_type, d.avg_price')
				->from('transactions as c')
				->join('bill_of_materials as a', 'a.trans_id=c.trans_id')
				->join('raw_materials as b', 'a.material_id=b.material_id')
				->join('(SELECT material_id,AVG(purchase_price) as avg_price 
			FROM purchase 
			GROUP BY material_id) as d ', 'd.material_id = a.material_id')
				->where('c.trans_id', $kode_bom[$i])
				->order_by('c.trans_id', 'asc')
				->get()
				->result_array();

			$data[] = [
				'kode_bom'		=> $kode_bom[$i],
				'order_qty'		=> $order_qty[$i],
				'details'		=> $sql
			];
		}



		$response = [
			'bom'			=> $data
		];
		return $response;
	}

	public function find_bom($id)
	{
		$find = $this->find_order($id);
		if (isset($find['product_id'])) {
			$product_id = $find['product_id'];
		} else {
			$product_id = '';
		}
		$this->db->select('a.material_id,a.qty,a.unit,b.material_name,a.trans_id,avg(d.purchase_price) as unit_price,b.material_type')
			->from('transactions as c')
			->join('bill_of_materials as a', 'a.trans_id=c.trans_id')
			->join('raw_materials as b', 'a.material_id=b.material_id')
			->join('purchase as d', 'd.material_id=b.material_id')
			->where('c.product_id', $product_id)
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
	public function conversion($id_transaksi_order)
	{
		$id_transaksi = $this->trans_id();
		// insert into transaction for new production
		$transaksi = [
			'trans_id'				=> $id_transaksi,
			'ref_production'		=> $id_transaksi_order,
			'production_step'		=> 1,
			'trans_type'			=> 'production'
		];
		// update transactions for transaction type -order
		$transaksi_order = [
			'status'	=> 1
		];

		$bom 	= $this->find_bom($id_transaksi_order);
		$order 	= $this->find_order($id_transaksi_order);
		// insert to direact labor table
		$bbb = 0;
		$bbp = 0;
		foreach ($bom as $value) {
			$arr[] = [
				'trans_id'		=> $id_transaksi,
				'material_id'		=> $value['material_id'],
				'unit_price'		=> $value['unit_price'],
				'qty'			=> $value['qty'] * $order['order_qty'],
				'type'			=> $value['material_type']
			];
			if ($value['material_type'] == 'BBB') {
				$bbb =  $bbb + (($value['qty'] * $order['order_qty']) * $value['unit_price']);
			} elseif ($value['material_type'] == 'BBP') {
				$bbp =  $bbp + (($value['qty'] * $order['order_qty']) * $value['unit_price']);
			}
		}
		$production_cost = [
			'trans_id'		=> $id_transaksi,
			'material_cost'	=> $bbb,
			'overhead_cost'	=> $bbp
		];
		$overhead_cost	= [
			'trans_id'		=> $id_transaksi,
			'oc_id'			=> 'OV04',
			'overhead_cost'	=> $bbp
		];
		// echo "<pre>";
		// print_r($transaksi);
		// print_r($transaksi_order);
		// print_r($arr);
		// print_r($production_cost);
		// echo "</pre>";
		// die;
		$this->db->trans_start();
		$this->db->update('transactions', $transaksi_order, ['trans_id' => $id_transaksi_order]);
		$this->db->insert('transactions', $transaksi);
		$this->db->insert('production_costs', $production_cost);
		$this->db->insert('overhead_cost', $overhead_cost);
		$this->db->insert_batch('direct_material_cost', $arr);
		$this->db->trans_complete();

		$response = [
			'status'			=> 'OK',
			'trans_id'		=> $id_transaksi,
			'ref_production'	=> $id_transaksi_order
		];
		return $response;
	}

	public function production($id_transaksi)
	{
		return $this->db->get_where('transactions', ['trans_id' => $id_transaksi])->row_array();
	}
	public function production_costs($id_transaksi)
	{
		return $this->db->get_where('production_costs', ['trans_id' => $id_transaksi])->row_array();
	}
	public function btkl($trans_id)
	{
		$this->db->select('a.trans_id,a.direct_labor_id,a.employee_id,a.cost,b.employee_name')
			->from('direct_labor_costs as a ')
			->join('employees as b', 'a.employee_id=b.employee_id')
			->where('a.trans_id', $trans_id);
		return $this->db->get()->result_array();
	}
	public function store_btkl()
	{
		$trans_id 	= $this->input->post('trans_id');
		$employee_id  	= $this->input->post('employee_id');
		$cost 		= intval(preg_replace("/[^0-9]/", "", $this->input->post('cost')));

		$data = [
			'trans_id'	=> $trans_id,
			'employee_id'	=> $employee_id,
			'cost'		=> $cost
		];

		// echo "<pre>";
		// print_r($transaksi);
		// die;
		return $this->db->insert('direct_labor_costs', $data);
	}
	public function delete_btkl($id)
	{
		$btkl = $this->db->get_where('direct_labor_costs', ['direct_labor_id', $id])->row_array();

		$this->db->delete('direct_labor_costs', ['direct_labor_id' => $id]);

		$response = [
			'status'		=> 'OK',
		];
		return $response;
	}
	public function done_btkl($trans_id, $total)
	{
		$transaksi = [
			'production_step'	=> 2
		];
		$production_cost = [
			'direct_labor_cost'	=> $total
		];

		$this->db->trans_start();
		$this->db->update('transactions', $transaksi, ['trans_id' => $trans_id]);
		$this->db->update('production_costs', $production_cost, ['trans_id' => $trans_id]);
		$this->db->trans_complete();
		$response = [
			'status'		=> 'OK',
		];
		return $response;
	}

	public function bop($trans_id)
	{
		$this->db->select('a.trans_id,a.id,a.oc_id,a.overhead_cost,b.name')
			->from('overhead_cost as a ')
			->join('overhead_component as b', 'a.oc_id=b.oc_id')
			->where('a.trans_id', $trans_id);
		return $this->db->get()->result_array();
	}


	// BOP
	public function store_bop()
	{
		$trans_id 		= $this->input->post('trans_id');
		$oc_id  			= $this->input->post('oc_id');
		$overhead_cost 	= intval(preg_replace("/[^0-9]/", "", $this->input->post('overhead_cost')));

		$data = [
			'trans_id'		=> $trans_id,
			'oc_id'			=> $oc_id,
			'overhead_cost'	=> $overhead_cost
		];

		// echo "<pre>";
		// print_r($transaksi);
		// die;
		return $this->db->insert('overhead_cost', $data);
	}
	public function delete_bop($id)
	{
		$bop = $this->db->get_where('overhead_cost', ['id', $id])->row_array();

		$this->db->delete('overhead_cost', ['id' => $id]);

		$response = [
			'status'		=> 'OK',
		];
		return $response;
	}
	public function done_bop($trans_id, $total)
	{

		$transaksi = [
			'production_step'	=> 3
		];
		$production_cost = [
			'overhead_cost'	=> $total
		];

		$this->db->trans_start();
		$this->db->update('transactions', $transaksi, ['trans_id' => $trans_id]);
		$this->db->update('production_costs', $production_cost, ['trans_id' => $trans_id]);
		$this->db->trans_complete();
		$response = [
			'status'		=> 'OK',
		];
		return $response;
	}
	public function find_order_production($id_transaksi)
	{
		$tras = $this->db->get_where('transactions', ['trans_id' => $id_transaksi])->row_array();

		$order = $this->find_order($tras['ref_production']);
		return $order;
	}
	private function bbp($trans_id)
	{
		$this->db->select('sum(unit_price*qty)as bbp')
			->from('direct_material_cost')
			->where('trans_id', $trans_id)
			->where('type', 'BBP')
			->group_by('type');
		return $this->db->get()->row_array();
	}
	public function done_production($trans_id)
	{
		$p_cost 			= $this->production_costs($trans_id);
		$production 		=  $this->db->get_where('transactions', ['trans_id' => $trans_id])->row_array(); //data hasil perhitungan biaya produksi
		$production_cost 	= $p_cost['material_cost'] + $p_cost['direct_labor_cost'] + $p_cost['overhead_cost']; //total biaya produksi
		$order 			= $this->db->get_where('transactions', ['trans_id' => $production['ref_production']])->row_array(); //data pesanan
		$payment 			= $this->db->get_where('payments', ['trans_id' => $production['ref_production']])->row_array(); //Pendapatan diterima dimuka
		$bbp				= $this->bbp($trans_id);
		$transaksi = [
			'status'					=> 1,
			'production_step'			=> 4, //hpp selesai
			'trans_total'				=> $production_cost
		];
		$tras_order = [
			'status'					=> 2
		];
		$gl = [
			[
				'account_no'	     => '2-10001',
				'trans_id'		=> $trans_id,
				'nominal'			=> $payment['nominal'],
				'gl_balance'		=> 'd'
			],
			[
				'account_no'	     => '1-10002',
				'trans_id'		=> $trans_id,
				'nominal'			=> $order['trans_total'] - $payment['nominal'],
				'gl_balance'		=> 'd'
			],
			[
				'account_no'	     => '4-10001',
				'trans_id'		=> $trans_id,
				'nominal'			=> $order['trans_total'],
				'gl_balance'		=> 'k'
			],
			[
				'account_no'	     => '5-20001',
				'trans_id'		=> $trans_id,
				'nominal'			=> $p_cost['material_cost'],
				'gl_balance'		=> 'd'
			],
			[
				'account_no'	     => '1-10003',
				'trans_id'		=> $trans_id,
				'nominal'			=> $p_cost['material_cost'],
				'gl_balance'		=> 'k'
			],
			[
				'account_no'	     => '5-20004',
				'trans_id'		=> $trans_id,
				'nominal'			=> $bbp['bbp'],
				'gl_balance'		=> 'd'
			],
			[
				'account_no'	     => '1-10004',
				'trans_id'		=> $trans_id,
				'nominal'			=> $bbp['bbp'],
				'gl_balance'		=> 'k'
			],
			[
				'account_no'	     => '5-20003',
				'trans_id'		=> $trans_id,
				'nominal'			=> $p_cost['overhead_cost'],
				'gl_balance'		=> 'd'
			],
			[
				'account_no'	     => '5-20005',
				'trans_id'		=> $trans_id,
				'nominal'			=> $p_cost['overhead_cost'],
				'gl_balance'		=> 'k'
			],
			[
				'account_no'	     => '1-10005',
				'trans_id'		=> $trans_id,
				'nominal'			=> $production_cost,
				'gl_balance'		=> 'd'
			],
			[
				'account_no'	     => '5-20001',
				'trans_id'		=> $trans_id,
				'nominal'			=> $p_cost['material_cost'],
				'gl_balance'		=> 'k'
			],
			[
				'account_no'	     => '5-20002',
				'trans_id'		=> $trans_id,
				'nominal'			=> $p_cost['direct_labor_cost'],
				'gl_balance'		=> 'k'
			],
			[
				'account_no'	     => '5-20003',
				'trans_id'		=> $trans_id,
				'nominal'			=> $p_cost['overhead_cost'],
				'gl_balance'		=> 'k'
			],
		];

		// echo "<pre>";
		// print_r($transaksi);
		// print_r($gl);
		// echo "</pre>";
		// die;

		$this->db->trans_start();
		$this->db->update('transactions', $transaksi, ['trans_id' => $trans_id]);
		$this->db->update('transactions', $tras_order, ['trans_id' => $production['ref_production']]);
		$this->db->insert_batch('general_ledger', $gl);
		$this->db->trans_complete();
	}
}

/* End of file M_production.php */
