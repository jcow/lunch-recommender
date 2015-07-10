<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once("Api.php");
require_once(APPPATH . "external/YelpOAuth/YelpOAuthLocationSearch.php");
require_once(APPPATH . "external/YelpOAuth/YelpOAuthBusiness.php");

class APIYelp extends API {

	private $russellInvestmentsLocation = "1301 2nd Ave #18 Seattle, WA 98101";
	private $searchRadius = 1610; // 1 mile in meters
	private $offsetLimit = 20;

	public function __construct(){
		parent::__construct();

		$this->load->config('yelp_api');
		$this->load->model('places_model');
	}

	public function get_zillow_food() {
		$yelp_oath = new YelpOAuthLocationSearch(
			$this->config->item('consumer_key'),
			$this->config->item('consumer_secret'),
			$this->config->item('token'),
			$this->config->item('token_secret'),
			$this->russellInvestmentsLocation
		);

		$yelp_oath->setRadius($this->searchRadius);
		$yelp_oath->setOffsetLimit($this->offsetLimit);

		$inserted_count = 0;
		
		$results = $yelp_oath->searchForFood();
		while(count($results["businesses"]) > 0){
			$inserted_count += $this->places_model->insert_batch($results['businesses']);
			$results = $yelp_oath->searchForFood();
		}
		
		$this->output(array(
			'inserted_count' => $inserted_count
		));
	}

	public function get_business($business_id){
		$yelp_oath = new YelpOAuthBusiness(
			$this->config->item('consumer_key'),
			$this->config->item('consumer_secret'),
			$this->config->item('token'),
			$this->config->item('token_secret')
		);

		$business = $yelp_oath->get_business($business_id);

		echo '<pre>';
		var_dump($business);
	}
}