<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once("Api.php");

class APIPlaces extends API {

	public function __construct(){
		parent::__construct();

		$this->load->model('places_model');
	}

}