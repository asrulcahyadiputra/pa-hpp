<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function index()
	{
		$data = [
			'title'		=> 'Login'
		];
		$this->load->view('login', $data);
	}

	public function verification()
	{
		if ($this->input->post('username')) {
			$data = $this->log_in();
		} else {
			$data = [
				'success'       => false,
				'message'       => 'Username Tidak Boleh Kosong',
				'type'          => 'error'
			];
		}
		echo json_encode($data);
	}

	private function log_in()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$this->db->select('user_id, role, username, password');
		$this->db->from('users');
		$this->db->where('username', $username);
		$this->db->where('status', '1');
		$get = $this->db->get()->row_array();
		if ($get['username']) {
			if (password_verify($password, $get['password'])) {
				$sess  = [
					'user_id'       => $get['user_id'],
					'username'      => $get['username'],
					'role'          => $get['role']
				];
				$this->session->set_userdata($sess);
				$data = [
					'success'   => true,
					'message'   => 'Berhasil Login',
					'type'      => 'success'
				];
			} else {
				$data = [
					'success'   => false,
					'type'      => 'error',
					'message'   => 'Kata Sandi salah!'
				];
			}
		} else {
			$data = [
				'success'   => false,
				'type'      => 'error',
				'message'   => 'Nama Pengguna tidak terdaftar!'
			];
		}

		return $data;
	}

	public function log_out()
	{
		session_destroy();
		redirect('login');
	}
}

/* End of file Auth.php */
