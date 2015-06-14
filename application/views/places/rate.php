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
			<button class="btn rating">SKIP</button>
		</div>

	</div>	
</div>




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
		placeToRate: config.siteURL + '',
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
			alert("failed to get place to rate, please refresh");
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
		return $.get(this._urls.placesToRate + "/" + userID);
	},

	_callRatePlaceAPI: function(userID, placeID, rating) {
		return $.get(this._urls.ratePlace + "/" + userID + "/" + placeID + "/" + rating);
	}

}



$(document).ready(function(){
	var place = Places.getNextPlaceToRate();
});


var templates = {
	
}

</script>