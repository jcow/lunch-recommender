<?php

require_once("Default_model.php");

class Users_to_places_model extends Default_model {

	public static $TABLE_NAME = "users_to_places";
	public static $MAX_RATING = 5;
	public static $MIN_RATING = 1;


	public function __construct() {
		parent::__construct();
	}

	public function add_rating_for_user($user_id, $place_id, $rating) {
		$rating = intval($rating);

		if($rating < self::$MIN_RATING || $rating > self::$MAX_RATING){
			return false;
		}

		$this->db->insert(self::$TABLE_NAME, array(
			'user_id'=>$user_id,
			'place_id'=>$place_id,
			'rating'=>$rating
		));

		return $this->db->affected_rows() > 0;
	}
}
