<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	protected function output($json_array){
		echo json_encode($json_array);
	}
}
