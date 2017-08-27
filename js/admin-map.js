jQuery( document ).ready( function() {

	if ( '' !== document.getElementById( WPDestinationsAdminData.idInputAddress ).value ) {
		setupWPDestinationsMap();
		if ( '' !== document.getElementById( WPDestinationsAdminData.idInputLatitude ).value ) {
			getWPDestinationsLocation();
		}
	} else {
		setupWPDestinationsMap();
	}

	jQuery( '#post' ).submit( function() {
		if ( '' !== document.getElementById( WPDestinationsAdminData.idInputAddress ).value && '' === document.getElementById( WPDestinationsAdminData.idInputLatitude ).value && '' === document.getElementById( WPDestinationsAdminData.idInputLongitude ).value ) {
			window.alert( WPDestinationsAdminData.emptyCoordsMessage );
			return false;
		}
	} );
} );

// Create new instance of a map in WP Destinations Admin Meta Box
function setupWPDestinationsMap() {
	var defaultPosition = new google.maps.LatLng( 44.956318, -93.28249300000004 );
	map = new google.maps.Map( document.getElementById( WPDestinationsAdminData.idMap ), {
		zoom: 12,
		center: defaultPosition,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		scrollwheel: false // Prevent users to start zooming the map when scrolling down the page
	} );
}

function getWPDestinationCoords() {
	var getAddress = document.getElementById( WPDestinationsAdminData.idInputAddress ).value;
	getWPDestinationsCoords( getAddress );
}

function getWPDestinationsCoords( address ) {

	var latitude;
	var longitude;
	var position;
	var marker;
	var geocoder = new google.maps.Geocoder();

	geocoder.geocode( { 'address': address }, function( results, status ) {
		if ( status == google.maps.GeocoderStatus.OK ) {
			latitude = results[ 0 ].geometry.location.lat();
			longitude = results[ 0 ].geometry.location.lng();
			position = new google.maps.LatLng( parseFloat( latitude ), parseFloat( longitude ) );
		}
		document.getElementById( WPDestinationsAdminData.idInputLatitude ).value = latitude;
		document.getElementById( WPDestinationsAdminData.idInputLongitude ).value = longitude;
		marker = new google.maps.Marker( {
			position: position,
			map: map
		} );
		marker.push( marker );
		map.panTo( marker.getPosition() );
	} );
}

function getWPDestinationsLocation() {
	var currentLat = document.getElementById( WPDestinationsAdminData.idInputLatitude ).value;
	var currentLng = document.getElementById( WPDestinationsAdminData.idInputLongitude ).value;
	var currentPosition = new google.maps.LatLng( parseFloat( currentLat ), parseFloat( currentLng ) );
	var marker = new google.maps.Marker( {
		position: currentPosition,
		map: map
	} );
	map.panTo( marker.getPosition() );
}
