<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_ledger extends CI_Model
{

	public function sub_akun()
	{
		return $this->db->get('coa_subhead')->result_array();
	}
	public function akun()
	{
		return $this->db->get('chart_of_accounts')->result_array();
	}

	public function get_ledger($y, $m)
	{
		$this->db->select('a.trans_id,a.account_no,a.gl_date,a.nominal,a.gl_balance,b.account_name')
			->from('general_ledger as a')
			->join('chart_of_accounts as b', 'a.account_no=b.account_no')
			->where('month(a.gl_date)', $m)
			->where('year(a.gl_date)', $y)
			->order_by('a.gl_id', 'ASC');
		return $this->db->get()->result_array();
	}
	public function get_row_jurnal($y, $m)
	{
		$this->db->select('a.trans_id,count(a.trans_id) as row,date(a.gl_date) as gl_date')
			->from('general_ledger as a')
			->where('month(a.gl_date)', $m)
			->where('year(a.gl_date)', $y)
			->group_by('a.trans_id')
			->group_by('date(a.gl_date)')
			->order_by('a.gl_date', 'ASC');
		return $this->db->get()->result_array();
	}
	public function all($y, $m, $a)
	{
		$this->db->select("a.gl_date,a.account_no,b.account_name,a.trans_id,IF( a.gl_balance = 'd', a.nominal, 0) AS debet,IF( a.gl_balance = 'k', a.nominal, 0) AS kredit,b.normal_balance")
			->from('general_ledger as a')
			->join('chart_of_accounts as b', 'a.account_no=b.account_no')
			->where('b.account_name', $a)
			->where('month(a.gl_date)', $m)
			->where('year(a.gl_date)', $y)
			->order_by('a.gl_date', 'ASC');

		return $this->db->get()->result_array();
	}
	public function first_balance_month($y, $m, $a)
	{
		$this->db->select("a.account_no,b.account_name,sum(IF( a.gl_balance = 'd', a.nominal, 0)) AS debet,sum(IF( a.gl_balance = 'k', a.nominal, 0)) AS kredit,b.normal_balance")
			->from('general_ledger as a')
			->join('chart_of_accounts as b', 'a.account_no=b.account_no')
			->where('b.account_name', $a)
			->where('month(a.gl_date) <', $m)
			->where('year(a.gl_date) ', $y)
			->group_by('a.account_no');
		return $this->db->get()->row_array();
	}
	public function first_balance_year($y, $a)
	{
		$this->db->select("a.account_no,b.account_name,sum(IF( a.gl_balance = 'd', a.nominal, 0)) AS debet,sum(IF( a.gl_balance = 'k', a.nominal, 0)) AS kredit,b.normal_balance")
			->from('general_ledger as a')
			->join('chart_of_accounts as b', 'a.account_no=b.account_no')
			->where('b.account_name', $a)
			->where('year(a.gl_date) <', $y)
			->group_by('a.account_no');
		return $this->db->get()->row_array();
	}
	public function first_balance($y, $m, $a)
	{
		$month_balance = $this->first_balance_month($y, $m, $a);
		$year_balance	= $this->first_balance_year($y, $a);
		if (!$year_balance) {
			$normal_balance = $month_balance['normal_balance'];
		} else {
			$normal_balance = $year_balance['normal_balance'];
		}
		$data = [
			'normal_balance'		=> $normal_balance,
			'debet'				=> $month_balance['debet'] + $year_balance['debet'],
			'kredit'				=> $month_balance['kredit'] + $year_balance['kredit']
		];
		return $data;
	}
}

/* End of file M_ledger.php */
