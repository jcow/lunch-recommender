<?php

class User extends CI_Controller{
	
	public function __construct(){
		parent::__construct();

		$this->load->model('users_model');
		$this->form_validation->set_error_delimiters('<div class="error"><span class="label label-danger">', '</label></div>');
	}

	public function login(){

		$this->form_validation->set_rules('username', 'User could not be found', 'callback_user_check');

		if($this->form_validation->run() === false){
			$this->load->view('wrapper/header');
			$this->load->view('users/login');
			$this->load->view('wrapper/footer');	
		}
		else {
			redirect();
		}

		
	}

	public function user_check($username) {

		if($username === NULL || $username === ''){
			$this->form_validation->set_message('user_check', "Username is required");
			return false;
		}

		if($this->users_model->does_user_exist($username)){
			return true;
		}
		else{
			$this->form_validation->set_message('user_check', "Username does not exist");
			return false;	
		}
		
		
	}



}