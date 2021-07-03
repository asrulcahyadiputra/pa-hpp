<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_menu extends CI_Model
{
    public function all()
    {
        return $this->db->get('menu_item')->result_array();
    }
    public function menu_head()
    {
        return $this->db->get('menu_head')->result_array();
    }
    public function get_menu()
    {
        $sql  = $this->db->select('*')
            ->from('menu_head as a')
            ->order_by('nu', 'asc')
            ->get()
            ->result_array();
        foreach ($sql as $key => $rowdata) {
            $sql2 = $this->db->select('*')
                ->from('menu_item as a')
                ->where('a.head_id', $rowdata['head_id'])
                ->order_by('nu', 'asc')
                ->get()
                ->result_array();

            $res[] = [
                'head_id'       => $rowdata['head_id'],
                'head_name'     => $rowdata['head_name'],
                'nu'            => $rowdata['nu'],
                'icon'          => $rowdata['icon'],
                'id'            => $rowdata['id'],
                'menu_item'     => $sql2
            ];
        }

        return $res;
    }
}

/* End of file M_menu.php */
