<?php

class Wrapper {

	public function __construct(){}

	public static function loadView($view, $args){
		get_instance()->load->view($view, $args);
	}
}