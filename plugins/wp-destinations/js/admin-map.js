jQuery(document).ready(function() {
    if (document.getElementById('wp-destinations-address').value != '') {
        setupWPDestinationsMap();
        if(document.getElementById('wp-destinations-post-lats').value != '') {
            getLocation();
        }
    }
    else {
        setupWPDestinationsMap();
    }
    jQuery( '#post' ).submit(function() {
        if(document.getElementById('wp-destinations-post-lats').value == '' && document.getElementById('wp-destinations-address').value != '') {
            window.alert( "You haven't created coordinates for your location" );
            return false;
        }
    });
});
// Create new instance of a map in WP Destinations Admin Meta Box
function setupWPDestinationsMap() {
    var defaultPosition = new google.maps.LatLng(44.956318, -93.28249300000004);
    map = new google.maps.Map(document.getElementById('admin-map'), {
        zoom: 12,
        center: defaultPosition,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: false // Prevent users to start zooming the map when scrolling down the page
    });
}
function getWPDestinationCoords() {
    var getAddress = document.getElementById('wp-destinations-address').value;
    getAddressCoords(getAddress);
}

function getAddressCoords(address) {
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({'address': address}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var latitude = results[0].geometry.location.lat();
            var longitude = results[0].geometry.location.lng();
            var position = new google.maps.LatLng(parseFloat(latitude), parseFloat(longitude));
        }
        document.getElementById('wp-destinations-post-lats').value = latitude;
        document.getElementById('wp-destinations-post-longs').value = longitude;
        var marker = new google.maps.Marker({
            position: position,
            map: map
        });
        marker.push(marker);
        map.panTo(marker.getPosition());
    });
}
function getLocation() {
    var currentLat = document.getElementById('wp-destinations-post-lats').value;
    var currentLng = document.getElementById('wp-destinations-post-longs').value;
    var currentPosition = new google.maps.LatLng(parseFloat(currentLat), parseFloat(currentLng));
    var marker = new google.maps.Marker ({
        position: currentPosition,
        map: map,
        title: 'Hello World!'
    });
    map.panTo(marker.getPosition());
}