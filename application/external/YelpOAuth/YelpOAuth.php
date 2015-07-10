
<?php

// Taken from: https://github.com/Yelp/yelp-api/blob/master/v2/php/sample.php

require_once("Oauth.php");

class YelpOAuth{

	public static $OFFSET_AMOUNT = 20;

	protected $apiHost = 'api.yelp.com';
	protected $searchPath = '/v2/search/';
	protected $businessPath = '/v2/business/';

	protected $consumer_key;
	protected $consumer_secret;
	protected $token;
	protected $token_secret;

	protected $offset;
	protected $offset_limit;

	public function __construct($consumer_key, $consumer_secret, $token, $token_secret, $offset = 0){
		$this->consumer_key = $consumer_key;
		$this->consumer_secret = $consumer_secret;
		$this->token = $token;
		$this->token_secret = $token_secret;

		$this->offset = $offset;
	}

	public function request($host, $path) {
		$unsigned_url = "http://" . $host . $path;
		// Token object built using the OAuth library
		$token = new OAuthToken($this->token, $this->token_secret);
		// Consumer object built using the OAuth library
		$consumer = new OAuthConsumer($this->consumer_key, $this->consumer_secret);
		// Yelp uses HMAC SHA1 encoding
		$signature_method = new OAuthSignatureMethod_HMAC_SHA1();
		$oauthrequest = OAuthRequest::from_consumer_and_token(
			$consumer,
			$token,
			'GET',
			$unsigned_url
		);
		// Sign the request
		$oauthrequest->sign_request($signature_method, $consumer, $token);
		// Get the signed URL
		$signed_url = $oauthrequest->to_url();
		// Send Yelp API Call
		$ch = curl_init($signed_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}

	public function setOffsetLimit($limit){
		$this->offset_limit = $limit;
	}
	
}