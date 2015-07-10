<?php

require_once('YelpOAuth.php');

class YelpOAuthBusiness extends YelpOAuth {

	public function __construct($consumer_key, $consumer_secret,$token, $token_secret){
		parent::__construct($consumer_key, $consumer_secret, $token, $token_secret);
	}


	public function get_business($business_id) {
		$url_path = $this->businessPath.$business_id;
		return json_decode($this->request($this->apiHost, $url_path), true);
	}
}
