<?php

require('main/PrivateController.php');

class User extends PrivateController{
	
	public function __construct(){
		parent::__construct();

		$this->load->model('users_model');
		$this->form_validation->set_error_delimiters('<div class="error"><span class="label label-danger">', '</label></div>');
	}

	public function dashboard() {
		$this->data['page_info']['title'] = $this->session->userdata('username');
		$this->header_footer_wrap('users/dashboard');
	}

	public function list_all() {
		$this->data['page_info']['title'] = 'All Users';
		$this->data['users'] = $this->users_model->get_all();
		$this->header_footer_wrap('users/list_all');
	}
}