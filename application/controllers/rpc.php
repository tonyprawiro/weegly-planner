<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rpc extends CI_Controller {

	public function index()
	{
		exit;
	}

	public function updentries($init='') {

		$this->weegly_m->manage_session(true);

		$entries = $this->input->post('entries');
		$init = ($init=='init') ? true : false;
		if(!$entries and !$init) {
			print -2;
		}

		$this->weegly_m->log("API/ api-updentries init=".($init ? 1 : 0)." $entries");

		try {

			$obj = json_decode($entries);
			$weeglydata = $this->session->userdata('weeglydata');
			if(!$init) {
				$this->weegly_m->update_items($weeglydata['navdate'], $obj);		
			}
			$weeglydata['weekitems'] = $this->weegly_m->get_items($weeglydata['navdate']);
			$this->session->set_userdata('weeglydata', $weeglydata);
			print json_encode($this->session->userdata('weeglydata'));

		} catch(Exception $e) {

			print -3;

		}

	}

	public function delentry($item_code) {

		$this->weegly_m->manage_session(true);
		$this->weegly_m->delete_item($item_code);

		$weeglydata = $this->session->userdata('weeglydata');
		$weeglydata['weekitems'] = $this->weegly_m->get_items($weeglydata['navdate']);
		$this->session->set_userdata('weeglydata', $weeglydata);
		print json_encode($this->session->userdata('weeglydata'));
	}

	public function updentry($item_code) {

		$this->weegly_m->manage_session(true);

		$this->weegly_m->update_item($item_code, 
			$this->input->post('item_name'),
			$this->input->post('item_date'),
			$this->input->post('item_statusdone'),
			$this->input->post('item_importance')
			);

		$weeglydata = $this->session->userdata('weeglydata');
		$weeglydata['weekitems'] = $this->weegly_m->get_items($weeglydata['navdate']);
		$this->session->set_userdata('weeglydata', $weeglydata);
		print json_encode($this->session->userdata('weeglydata'));
	}

	public function navweek($date='') {

		$this->weegly_m->manage_session(true);

		if(!$date) {
			if(date('N', time())==1)
				$date = date('Y-m-d');
			else
				$date = date('Y-m-d', strtotime('last monday'));
		} else {
			$arr = explode('-', $date);
			if(!isset($arr[0])) $arr[0] = date('Y');
			if(!isset($arr[1])) $arr[1] = date('m');
			if(!isset($arr[2])) $arr[2] = date('d');
			$y = str_pad($arr[0]*1, 4, '0', STR_PAD_LEFT);
			$m = str_pad($arr[1]*1, 2, '0', STR_PAD_LEFT);
			$d = str_pad($arr[2]*1, 2, '0', STR_PAD_LEFT);
			$date = $y.'-'.$m.'-'.$d;
		}
		$navdate = $date;
		$dow = $this->weegly_m->get_dow($navdate);
		$weeglydata = $this->session->userdata('weeglydata');
		if($dow==1) {
			$weeglydata['navdate'] = $navdate;
			$weeglydata['weekitems'] = $this->weegly_m->get_items($weeglydata['navdate']);
			$this->session->set_userdata('weeglydata', $weeglydata);
			print json_encode($this->session->userdata('weeglydata'));
		} else {
			print -2;
		}
	}

	/*public function dumpdata() {
		$weeglydata = $this->session->userdata('weeglydata');
		var_dump($weeglydata);
	}*/

}

/* End of file rpc.php */
/* Location: ./application/controllers/rpc.php */