<?php

function user_log()
{
    $CI3 = get_instance();
    if (!$CI3->session->userdata('user_id')) {
        redirect('login');
    }
}

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

function getProfile($user_id)
{
    $CI3 = get_instance();
    $sql = $CI3->db->select('a.username, a.user_id, a.name, b.role_name')
        ->from('users as a')
        ->join('roles as b', 'a.role = b.role_id')
        ->where('a.user_id', $user_id)
        ->get()
        ->row_array();

    return $sql;
}
