<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once("Api.php");

class APIUser extends API {

	public function __construct(){
		parent::__construct();

		$this->load->model('users_model');
	}

	public function add_user($username){
		
		$added = $this->users_model->add_user($username);
		$ret['added'] = $added;

		$this->output($ret); 
	}

	public function get_users(){
		$this->output(array(
			'users' => $this->users_model->get_all()
		));
	}

}