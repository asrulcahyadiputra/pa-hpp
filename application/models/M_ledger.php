<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_ledger extends CI_Model {

	public function get_ledger($y,$m){
		$this->db->select('a.trans_id,a.account_no,a.gl_date,a.nominal,a.gl_balance,b.account_name')
			->from('general_ledger as a')
			->join('chart_of_accounts as b','a.account_no=b.account_no')
			->where('month(a.gl_date)',$m)
			->where('year(a.gl_date)',$y)
			->order_by('a.gl_id','ASC');
		return $this->db->get()->result_array();
	}
	public function get_row_jurnal($y,$m){
		$this->db->select('a.trans_id,count(a.trans_id) as row,date(a.gl_date) as gl_date')
			->from('general_ledger as a')
			->where('month(a.gl_date)',$m)
			->where('year(a.gl_date)',$y)
			->group_by('a.trans_id')
			->group_by('date(a.gl_date)')
			->order_by('date(a.gl_date)','ASC');
		return $this->db->get()->result_array();
	}

}

/* End of file M_ledger.php */

?>
