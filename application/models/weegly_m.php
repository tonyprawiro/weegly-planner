<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Weegly_m extends Supermodel {

	var $log_file = "/tmp/weegly.log";

    function __construct() {
        parent::__construct();
    }

    function delete_item($item_code) {
    	$weeglydata = $this->session->userdata('weeglydata');
    	$sql = "delete from weegly_items where item_code = ? and user_id = ?";
    	$this->db->query($sql, array($item_code, $weeglydata['account']['user_id']));
    }

    function log($s) {
    	error_log($s, 3, $this->log_file);
    }

    function authenticate($email, $password) {
		
		$this->log("I/ weegly_authenticate $email ".sha1('weegly'.$password)."\n");

		$result = null;

		$sql = "select * from weegly_users where user_email = ? and user_password = ?";
		$query = $this->db->query($sql, array($email, sha1('weegly'.$password)));
		$rows = $query->result_array();
		if(count($rows)) {
			$result = $rows[0];
			unset($result['user_password']);
		}

		return $result;    	
    }

	function item_to_obj($item) {

		//$this->log("I/ weegly_item_to_obj ".print_r($item, true)."\n");

		$obj = new stdClass();
		$obj->id = $item['item_code'];
		$obj->val = $item['item_name'];
		$classes = array();
		if($item['item_statusdone']) $classes[] = 'statusdone';
		switch($item['item_importance']) {
			case '0': $classes[] = "importance-low"; break;
			case '10': $classes[] = "importance-normal"; break;
			case '100': $classes[] = "importance-high"; break;
		}
		$classes[] = 'postpone-'.$item['item_postpone'];
		$obj->order = $item['item_order'];
		$obj->classes = implode(" ", $classes);
		return $obj;

	}

	function get_items($date) {

		$this->log("I/ weegly_get_items $date\n");
    	$weeglydata = $this->session->userdata('weeglydata');
		$sql = "select * from weegly_items where ((item_date is null or item_date='0000-00-00') or (item_date >= ? and item_date <= date_add(?, interval 6 day) )) and user_id = ? order by item_date asc, item_statusdone asc, item_importance desc, item_order asc";
		$query = $this->db->query($sql, array($date, $date, $weeglydata['account']['user_id']));
		$rows = $query->result_array();
		$result = array();
		foreach($rows as $row) {
			if(!$row['item_date'] or $row['item_date']=='0000-00-00') {
				$result[0][] = $this->item_to_obj($row);
			} else {
				$dow = $this->get_dow($row['item_date']);
				$result[$dow][] = $this->item_to_obj($row);
			}
		}

		return $result;
	}

	function update_items($date, $items) {

		$this->log("I/ $date ".print_r($items, true)."\n");

		for($d=0; $d<=7; $d++) {

			foreach($items[$d] as $i => $item) {

				if($d==0) {
					$item_date = 'NULL';					
				} else {
					$item_date = date('Y-m-d', strtotime($date . ' +'.($d-1).' day'));
				}

				$item_statusdone = 0;
				if(strpos($item->classes, 'statusdone')!==false) {
					$item_statusdone = 1;
				}

				$item_importance = 10;
				if(strpos($item->classes, 'importance-low')!==false) {
					$item_importance = 0;
				} elseif(strpos($item->classes, 'importance-normal')!==false) {
					$item_importance = 10;
				} elseif(strpos($item->classes, 'importance-high')!==false) {
					$item_importance = 100;
				}

				$item_postpone = '0';

				$sql = "select * from weegly_items where item_code = ?";
				$query = $this->db->query($sql, array($item->id));

				if($query->num_rows()) {
					$sql = "update weegly_items set item_name=?, item_date=?, item_order=?, item_statusdone=?, item_importance=?, item_postpone=? where item_code = ? and user_id = ?";
					$weeglydata = $this->session->userdata('weeglydata');
					$this->db->query($sql, array($item->val,
						$item_date,
						$i+1,
						$item_statusdone,
						$item_importance,
						$item_postpone,
						$item->id,
						$weeglydata['account']['user_id'],
						));
					$this->log($this->db->last_query()."\n");
				} else {
					$sql = "insert into weegly_items (user_id, item_code, item_name, item_creation_datetime, item_date, item_order, item_statusdone, item_importance, item_postpone) values (?, ?, ?, NOW(), ?, ?, ?, ?, ?)";
					$weeglydata = $this->session->userdata('weeglydata');
					$this->db->query($sql, array(
						$weeglydata['account']['user_id'],
						$item->id,
						$item->val,
						$item_date,
						$i+1,
						$item_statusdone,
						$item_importance,
						$item_postpone,
					));
					$this->log($this->db->last_query()."\n");
				}
			}

		}

	}

	function get_dow($date) {
		return date('N', strtotime($date));
	}

	function manage_session($ajax=false) {

		$weeglydata = $this->session->userdata('weeglydata');

		if(!$weeglydata) {
			if($this->uri->segment(1)=='account' and $this->uri->segment(2)=='login') {
				if($_SERVER['REQUEST_METHOD']=='POST') {
					$username = $_POST['email'];
					$password = $_POST['password'];
					$result = $this->authenticate($username, $password);
					if($result) {
						$weeglydata['account'] = $result;
						$this->session->set_userdata('weeglydata', $weeglydata);
						if(!$ajax) { redirect('plan'); } else { exit; }
					} else {
						if(!$ajax) { redirect('account/login/loginerr'); } else { exit; }
					}
				}
			} else {
				if(!$ajax) { redirect('account/login'); } else { print "-1"; exit; }
			}
		} else {
			if($this->uri->segment(1)=='account' and $this->uri->segment(2)=='logout') {
				$this->session->set_userdata('weeglydata', null);
				if(!$ajax) { redirect('account/login/loggedout'); } else { exit; }
			} else {
				// retrieve data and populate session variables
				if(!isset($weeglydata['navdate'])) {
					if(date('N', time())==1)
						$weeglydata['navdate'] = date('Y-m-d');
					else
						$weeglydata['navdate'] = date('Y-m-d', strtotime('last monday'));
					$weeglydata['weekitems'] = $this->get_items($weeglydata['navdate']);
					$this->session->set_userdata('weeglydata', $weeglydata);
				}
			}

		}

		return true;
	}

	function update_item($item_code, $item_name, $item_date, $item_statusdone, $item_importance) {
		$sql = "update weegly_items set item_name = ?, item_date = ?, item_statusdone = ?, item_importance = ? where item_code = ?";
		$this->db->query($sql, array($item_name, $item_date, $item_statusdone, $item_importance, $item_code));
		return true;
	}

}

/* End of file weegly_m.php */
/* Location: ./application/models/weegly_m.php */