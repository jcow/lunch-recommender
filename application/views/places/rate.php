<div class="container">

	<h1>
		Rate Place
	</h1>

	<div>

		<div id="place-container">
			Place...
		</div>

		<div id="ratings" class="row">
			<div class="col-md-2 col-md-offset-1">
				<button class="btn rating">Love it</button>
			</div>
			<div class="col-md-2">
				<button class="btn rating">Like it</button>
			</div>
			<div class="col-md-2">
				<button class="btn rating ">Indifferent</button>
			</div>
			<div class="col-md-2">
				<button class="btn rating">Dont really like it</button>
			</div>
			<div class="col-md-2">
				<button class="btn rating">Hate it</button>
			</div>
		</div>

		<div id="skip-container">
			<button class="btn rating skip-button">SKIP</button>
		</div>

	</div>	
</div>


<style>
	.skip-button{
		width: 100%;
	}

	#skip-container{
		margin-top: 15px;
	}
</style>


<script>

function Place(params) {
	this.id = params.id;
	this.name = params.name;
}

function UserRating(params) {
	this.userID = params.userID;
	this.rating = params.rating;
}

function User(params) {
	this.userID = params.userID;
	this.username = params.username;
}

var Places = {

	_urls: {
		placeToRate: config.siteURL + 'APIPlaces/get_place_for_user_to_rate',
		businessDetails: config.siteURL + 'APIYelp/get_business',
		ratePlace: ''
	},

	getPlaceHTML: function(place) {

	},

	getNextPlaceToRate: function(userID) {
		var defer = $.Deferred();
		$.when(this._callGetPlaceToRateAPI(userID)).then(function(data) {
			defer.resolve(data);
		},
		function(){
			defer.reject();
		});
		return defer;
	},

	getPlaceDetails: function(businessID){
		var defer = $.Deferred();
		$.when(this._callGetBusinessAPI(businessID)).then(function(data) {
			defer.resolve(data);
		},
		function() {
			defer.reject();
		});
		return defer;
	},

	ratePlace: function(userID, placeID, rating) {
		var defer = $.Deferred();
		$.when(this._callGetPlaceToRateAPI(userID, placeID, rating)).then(function(data) {
			defer.resolve(data);
		},
		function() {
			alert("failed to rate place, please refresh");
		});
		return defer;
	},

	_callGetPlaceToRateAPI: function(userID) {
		return $.get(this._urls.placeToRate + "/" + userID);
	},

	_callGetBusinessAPI: function(businessID){
		console.log(this._urls.businessDetails + "/" + businessID);
		return $.get(this._urls.businessDetails + "/" + businessID);
	},

	_callRatePlaceAPI: function(userID, placeID, rating) {
		return $.get(this._urls.ratePlace + "/" + userID + "/" + placeID + "/" + rating);
	}

}



$(document).ready(function(){
	var placeDeferred = Places.getNextPlaceToRate(<?=$this->session->userdata('user_id')?>);

	placeDeferred.then(function(resp){
		var placeData = $.parseJSON(resp).place;
		console.log(placeData);
		console.log(placeData.id);
		console.log(placeData.external_reference_id);
		Places.getPlaceDetails(placeData.external_reference_id).then(function(resp){
			console.log(resp);
		}, function(){
			alert("failed to get a places details, please refresh");
		})
	}, 
	function(resp){
		alert("failed to get place to rate, please refresh");
	});
});


var templates = {
	
}

</script>