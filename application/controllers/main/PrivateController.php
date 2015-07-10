<?php

require('MainController.php');

class PrivateController extends MainController{

	public function __construct() {
		parent::__construct();

		if(!is_string($this->session->userdata('username'))) {
			redirect('', 'refresh');
		}
	}

	protected function load_header(){
		$this->load->view('wrapper/private_header', $this->data);
	}

	protected function load_footer(){
		$this->load->view('wrapper/private_footer', $this->data);
	}

	protected function header_footer_wrap($view_path){
		parent::load_header();
		$this->load_header();
		$this->load->view($view_path, $this->data);
		$this->load_footer();
		parent::load_footer();
	}
}