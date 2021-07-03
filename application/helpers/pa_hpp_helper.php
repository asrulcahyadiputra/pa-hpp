<?php

function getMenu()
{
    $CI3 = get_instance();

    $sql  = $CI3->db->select('*')
        ->from('menu_head as a')
        ->order_by('nu', 'asc')
        ->get()
        ->result_array();
    foreach ($sql as $key => $rowdata) {
        $sql2 = $CI3->db->select('*')
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
