<?php

class MainController extends CI_Controller{

	public function __construct() {
		parent::__construct();
		$this->data = array('page_info'=>array());
	}

	protected function load_header(){
		$this->load->view('wrapper/header', $this->data);
	}

	protected function load_footer(){
		$this->load->view('wrapper/footer', $this->data);
	}

	protected function header_footer_wrap($view_path){
		$this->load_header();
		$this->load->view($view_path, $this->data);
		$this->load_footer();
	}
}