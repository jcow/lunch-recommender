<?php 

require('main/PublicController.php');

class Auth extends PublicController {

	public function __construct(){
		parent::__construct();
		$this->load->model('users_model');
	}

	public function index(){
		$this->login();
	}

	public function login(){

		$this->form_validation->set_rules('username', 'User could not be found', 'callback_user_check');

		if($this->form_validation->run() === false){
			$this->header_footer_wrap('users/login');
		}
		else {
			$username = $this->input->post('username');
			$user = $this->users_model->get_by_username($username);
			if(!$user) {
				echo ":/";
			}
			else {
				$this->session->set_userdata(array(
					'username' => $user->username,
					'user_id' => $user->user_id
				));
				redirect('user/dashboard', 'refresh');
			}
		}
		
	}

	public function logout(){
		redirect('', 'refresh');
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