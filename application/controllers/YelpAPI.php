<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . "external/YelpOAuthLocationSearch.php");

class YelpAPI extends CI_Controller {

	private $russellInvestmentsLocation = "1301 2nd Ave #18 Seattle, WA 98101";
	private $searchRadius = 1610; // 1 mile in meters

	public function __construct(){
		parent::__construct();

		$this->load->config('yelp_api');
	}

	public function get_zillow_food(){
		$yelp_oath = new YelpOAuthLocationSearch(
			$this->config->item('consumer_key'),
			$this->config->item('consumer_secret'),
			$this->config->item('token'),
			$this->config->item('token_secret'),
			$this->russellInvestmentsLocation
		);
		
		$results = $yelp_oath->searchForFood();

		echo "<pre>";
		var_dump($results);
	}
}