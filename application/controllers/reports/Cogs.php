<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Cogs extends CI_Controller {

	public function index()
	{
		$data = [
			'title'			=> 'Harga Pokok Produksi',
		];
		$this->load->view('reports/accounting/cogs_report', $data);
	}

}

/* End of file Controllername.php */


?>
