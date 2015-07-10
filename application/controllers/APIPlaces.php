<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once("Api.php");

class APIPlaces extends API {

	public function __construct() {
		parent::__construct();
		$this->load->model('places_model');
		$this->load->model('users_to_places_model');
	}

	public function get_place_for_user_to_rate($user_id, $offset = 0){
		$place = $this->places_model->get_next_place_for_user_to_rate($user_id, array(
			'offset' => $offset
		));
		$place = count($place) > 0 ? $place[0] : null;

		$this->output(array(
			'place' => $place
		));
	}

	public function add_rating_for_user($user_id, $place_id, $rating) {
		// todo, use person that is logged in
		$added = $this->users_to_places_model->add_rating_for_user($user_id, $place_id, $rating);

		$this->output(array(
			'added' => $added
		));
	}

}