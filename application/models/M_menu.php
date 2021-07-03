<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_menu extends CI_Model
{
    public function all()
    {
        return $this->db->get('menu_item')->result_array();
    }
    public function select($id)
    {
        return $this->db->get_where('menu_item', ['tcode' => $id])->row_array();
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
    public function store()
    {
        $tcode          = $this->input->post('tcode');
        $menu_name      = $this->input->post('menu_name');
        $url            = $this->input->post('url');
        $menu_icon      = $this->input->post('menu_icon');
        $nu             = $this->input->post('nu');
        $head_id        = $this->input->post('head_id');

        $data = [
            'tcode'         => $tcode,
            'menu_name'     => $menu_name,
            'url'           => $url,
            'menu_icon'     => $menu_icon,
            'nu'            => $nu,
            'head_id'       => $head_id
        ];
        if ($this->db->insert('menu_item', $data)) {
            $res = [
                'status'        => true,
                'message'       => 'Data Berhasil di Simpan dengan tcode ' . $tcode
            ];
        } else {
            $res = [
                'status'        => false,
                'message'       => $this->db->error()
            ];
        }

        return $res;
    }
    public function update()
    {
        $tcode          = $this->input->post('tcode');
        $menu_name      = $this->input->post('menu_name');
        $url            = $this->input->post('url');
        $menu_icon      = $this->input->post('menu_icon');
        $nu             = $this->input->post('nu');
        $head_id        = $this->input->post('head_id');

        $data = [
            'menu_name'     => $menu_name,
            'url'           => $url,
            'menu_icon'     => $menu_icon,
            'nu'            => $nu,
            'head_id'       => $head_id
        ];
        if ($this->db->update('menu_item', $data,  ['tcode' => $tcode])) {
            $res = [
                'status'        => true,
                'message'       => 'Data ' . $tcode . ' Berhasil di update '
            ];
        } else {
            $res = [
                'status'        => false,
                'message'       => $this->db->error()
            ];
        }

        return $res;
    }

    public function destroy($id)
    {
        if ($this->db->delete('menu_item', ['tcode' => $id])) {
            $res = [
                'status'        => true,
                'message'       => 'Data ' . $id . ' Berhasil di hapus '
            ];
        } else {
            $res = [
                'status'        => false,
                'message'       => $this->db->error()
            ];
        }

        return $res;
    }
}

/* End of file M_menu.php */
