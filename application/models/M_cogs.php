<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_cogs extends CI_Model
{
    public function getReport($periode)
    {
        $sql = $this->db->select('sum(material_cost) as bbb, sum(direct_labor_cost) as btkl, sum(overhead_cost) as bop')
            ->from('transactions as a')
            ->join('production_costs as b', 'a.trans_id=b.trans_id')
            ->where('a.periode', $periode)
            ->group_by('a.periode')
            ->get()
            ->result_array();

        $response =  [
            'status'        => true,
            'periode'       => bulan(substr($periode, 4, 2)) . ' ' . substr($periode, 0, 4),
            'bdp_aw'        => 0,
            'bdp_ak'        => 0,
            'values'        => $sql
        ];

        return $response;
    }
}

/* End of file M_cogs.php */
