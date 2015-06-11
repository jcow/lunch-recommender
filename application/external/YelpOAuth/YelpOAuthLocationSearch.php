<?php

require_once('YelpOAuth.php');

class YelpOAuthLocationSearch extends YelpOAuth {

	private $location;
	private $radius;

	public function __construct($consumer_key, $consumer_secret, $token, $token_secret, $location, $offset = 0){
		parent::__construct($consumer_key, $consumer_secret, $token, $token_secret, $offset);

		$this->location = $location;
	}

	public function searchForFood() {

		if($this->offset_limit && $this->offset >= $this->offset_limit){
			return array('businesses'=>array());
		}

		$url_params = array();
		$url_params['term'] = 'food';
		$url_params['location'] = $this->location;
		$url_params['offset'] = $this->offset;

		if($this->radius){
			$url_params['radius'] = $this->radius;
		}

		$search_path = $this->searchPath . "?" . http_build_query($url_params);

		$this->offset += parent::$OFFSET_AMOUNT;

		return json_decode($this->request($this->apiHost, $search_path), true);
	}

	public function setRadius($radius){
		$this->radius = $radius;
	}

}