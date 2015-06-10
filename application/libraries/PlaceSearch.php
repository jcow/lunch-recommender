<?php

class PlaceSearch {
	
	private $url;
	private $key;
	private $location;
	private $radius;
	private $types;
	private $rankby;

	private $url_hit = null;

	public function __construct($args) {
		$this->url = $args['url'];
		$this->key = $args['key'];
		$this->location = $args['location'];
		$this->radius = $args['radius'];

		if(!in_array('types', $args)){
			$args['types'] = 'food';
		}

		if(!in_array('rankby', $args)){
			$args['rankby'] = 'distance';
		}

		$this->rankby = $args['rankby'];
		$this->types = $args['types'];
	}

	public function get(){
		$url = $this->url . $this->getQueryString();
		$this->url_hit = $url;
		return json_decode(file_get_contents($url), true);
	}

	public function get_url_hit() 
	{
		return $this->url_hit;
	}

	private function getQueryString(){

		return '?' . 
			implode('&', array(
				'location=' . $this->location,
				'radius=' . $this->radius,
				'types=' . $this->types,
				'key=' . $this->key
			)
		);
	}
}