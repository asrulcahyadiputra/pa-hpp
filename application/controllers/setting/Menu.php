<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_menu', 'model');
    }

    public function index()
    {
        $data = [
            'title'        => 'Pengaturan Menu',
            'head'         => $this->model->menu_head()
        ];
        $this->load->view('setting/menu/content', $data);
    }

    public function load_menu_list()
    {
        $req = $this->model->all();

        echo json_encode($req);
    }
    public function store()
    {
        $req = $this->model->store();

        if ($req['status'] == true) {
            $response = [
                'icon'      => 'success',
                'title'     => 'Berhasil',
                'text'      => $req['message']
            ];
        } else {
            $response = [
                'icon'      => 'error',
                'title'     => '500',
                'text'      => $req['message']
            ];
        }
        echo json_encode($response);
    }

    public function update()
    {
        $req = $this->model->update();

        if ($req['status'] == true) {
            $response = [
                'icon'      => 'success',
                'title'     => 'Berhasil',
                'text'      => $req['message']
            ];
        } else {
            $response = [
                'icon'      => 'error',
                'title'     => '500',
                'text'      => $req['message']
            ];
        }
        echo json_encode($response);
    }

    public function select($id)
    {
        $req = $this->model->select($id);

        echo json_encode($req);
    }
}

/* End of file Menu.php */
