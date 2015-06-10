<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GooglePlaces extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->config->load('google_api');
		$google_api = $this->config->item('google_api');

		$this->load->library('PlaceSearch', array(
			'url'=>$google_api['url'],
			'key'=>$google_api['key'],
			'location'=>$google_api['zillow_building_lat_lon'],
			'radius'=>$google_api['default_search_radius']
		));
		
	}


	Look at this: https://github.com/Yelp/yelp-api/blob/master/v2/php/sample.php

	public function index()
	{
		echo 'More information here: https://developers.google.com/places/webservice/intro';
	}

	public function getPlaces() 
	{
		$this->load->model('places_model');
		$response = $this->placesearch->get();
		if($response) {
			echo '<pre>';
			var_dump($this->placesearch->get_url_hit());
			var_dump($response['results']);
			exit();
			$this->places_model->insert_all($response['results']);
		}
	}
}
