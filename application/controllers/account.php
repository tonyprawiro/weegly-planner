<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

	public function index()
	{
		$this->weegly_m->manage_session();
	}

	public function login()
	{
		$this->weegly_m->manage_session();

		$this->load->view('login', array(
			'email' => $this->input->post('email'),
		));
	}

	public function logout()
	{
		$this->weegly_m->manage_session();
	}

}

/* End of file account.php */
/* Location: ./application/controllers/account.php */