<?php

class Main extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
	}

	public function rate_place(){
		$this->load->view('wrapper/header');
		$this->load->view('places/rate');
		$this->load->view('wrapper/footer');
	}

}