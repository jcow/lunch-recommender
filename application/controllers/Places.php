<?php

require('main/PrivateController.php');

class Places extends PrivateController{

	public function __construct(){
		parent::__construct();
	}

	public function rate(){
		$this->header_footer_wrap('places/rate');
	}


}