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
		$sql = $this->db->select('a.trans_id,a.customer_id,a.trans_date,a.description,c.customer_id,c.cus_name,a.status_production,a.trans_total,a.dp,a.lock_doc')
			->from('transactions as a')
			->join('customers as c', 'c.customer_id=a.customer_id')
			->get()
			->result_array();
		$no = 1;
		$totRow = count($sql);
		foreach ($sql as $key => $val) {
			if ($val['status_production'] == 0) {
				$status_html = "<p class='text-danger'>Belum Produksi</p>";
			} elseif ($val['status_production'] == 1) {
				$status_html = "<p class='text-warning'>Dalam Produksi</p>";
			} else {
				$status_html = "<p class='text-success'>Selesai Produksi</p>";
			}

			if ($val['lock_doc'] == 1) {
				$lock_html = '<i class="fa fa-unlock"></i>';
			} else {
				$lock_html = '<i class="fa fa-lock"></i>';
			}
			$data[] = [
				'no'			=> $no++,
				'trans_id'		=> $val['trans_id'],
				'keterangan'    => $val['description'],
				'tanggal'		=> shortdate_indo(date('Y-m-d', strtotime($val['trans_date']))),
				'pelanggan'		=> $val['cus_name'],
				'total'			=> nominal($val['trans_total']),
				'dp'			=> nominal($val['dp']),
				'lock'			=> $lock_html,
				'status'		=> $status_html
			];
		}
		if ($totRow > 0) {
			$response = $data;
		} else {
			$response = [];
		}
		return $response;
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
		$trans_id 		= $this->trans_id();
		$tanggal 		= $this->input->post('tanggal');
		$periode		=  date('Y', strtotime($tanggal)) . '' . date('m', strtotime($tanggal));
		$customer_id 	= $this->input->post('customer_id');
		$product_id 	= $this->input->post('product_id');
		$payment 		= intval(preg_replace("/[^0-9]/", "", $this->input->post('dp')));
		$description 	= $this->input->post('description');
		$qty 			= $this->input->post('qty');
		$size 			= $this->input->post('ukuran');
		$unit_price		= $this->input->post('unit_price');
		$subtotal		= $this->input->post('jumlah');

		$total = 0;
		foreach ($product_id as $i => $val) {
			$orders[] = [
				'trans_id'			=> $trans_id,
				'product_id'		=> $product_id[$i],
				'order_qty'			=> $qty[$i],
				'order_size'		=> $size[$i],
				'order_price'		=> intval(preg_replace("/[^0-9]/", "", $unit_price[$i])),
				'order_total'		=> intval(preg_replace("/[^0-9]/", "", $subtotal[$i])),
			];

			$total = $total + intval(preg_replace("/[^0-9]/", "", $subtotal[$i]));
		}


		$transactions = [
			'trans_id'			=> $trans_id,
			'description'		=> $description,
			'trans_date'		=> $tanggal,
			'periode'			=> $periode,
			'customer_id'		=> $customer_id,
			'order_done'		=> 0,
			'trans_type'		=> 'order',
			'dp'				=> $payment,
			'status_production'	=> 0,
			'lock_doc'			=> 1,
			'trans_total'		=> $total
		];

		if ($payment > 0) {
			$gl = [
				[
					'account_no'		=> '1-10001',
					'periode'			=> $periode,
					'trans_id'			=> $trans_id,
					'nominal'			=> $payment,
					'gl_balance'		=> 'd'
				],
				[
					'account_no'		=> '2-10001',
					'periode'			=> $periode,
					'trans_id'			=> $trans_id,
					'nominal'			=> $payment,
					'gl_balance'		=> 'k'
				],

			];
			$py = [
				'trans_id'			=> $trans_id,
				'periode'			=> $periode,
				'nominal'			=> $payment,
				'description'		=> 'Down Payment (DP)'
			];
		}


		$this->db->trans_start();
		$this->db->insert('transactions', $transactions);
		$this->db->insert_batch('orders', $orders);
		$this->db->insert_batch('general_ledger', $gl);
		$this->db->insert('payments', $py);
		$this->db->trans_complete();



		if ($this->db->trans_status() == true) {
			$response = [
				'status'		=> true,
				'title'			=> 'Berhasil!',
				'message'		=> 'Data Berhasil di Simpan dengan kode ' . $trans_id,
				'type'			=> 'success',
				'data'			=> [
					'trx'			=> $transactions,
					'details'		=> $orders,
					'gl'			=> $gl,
					'py'			=> $py
				]
			];
		} else {
			$response = [
				'status'			=> $this->db->trans_status(),
				'title'				=> 'Gagal!',
				'message'			=> 'Data Gagal Disimpan',
				'type'				=> 'error',
				'data'				=> null,
				'system_response'   => $this->db->trans_status()
			];
		}
		return $response;
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
