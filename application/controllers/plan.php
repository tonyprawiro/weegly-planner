<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plan extends CI_Controller {

	public function index()
	{
		$this->weegly_m->manage_session();

		$this->load->view('main.php');
	}
}

/* End of file plan.php */
/* Location: ./application/controllers/plan.php */