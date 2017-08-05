var isDraggable = jQuery(document).width() > 480 ? true : false; // If document is wider than 480px, isDraggable = true, else isDraggable = false
jQuery(".post-modal a").addClass( "inactive-link" );

function initialize() {
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 14,
		center: new google.maps.LatLng(44.956318, -93.28249300000004),
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		scrollwheel: false, // Prevent users to start zooming the map when scrolling down the page
		draggable: isDraggable
	});
    var nextPostBtn = document.getElementsByClassName( 'next-post' );
    var previousPostBtn = document.getElementsByClassName( 'previous-post' );
    // Run a for loop that creates the markers
    var markers = [];
	for (var i = 0; i < locations.length; i++) {
		// Create new variables for the id, address, latitudes, longitudes and marker positions
		var marker_id = locations[i].marker_id;
        var marker_address = locations [i].marker_address;
        var map_marker_lat = locations[i].marker_lat;
        var map_marker_long = locations[i].marker_long;
        var position = new google.maps.LatLng(parseFloat(map_marker_lat),parseFloat(map_marker_long));
        // Creates a new google Map marker from the marker variables
		var marker = new google.maps.Marker({
			map: map,
            icon: {
			    url: "/uptownvine/wp-content/themes/uptownvine/assets/img/uv-i.png",
                scaledSize: new google.maps.Size(35, 35)
            },
			position: position,
			title: marker_address,
			id: marker_id
		});
        markers.push(marker);
        var markerCluster = new MarkerClusterer(map, marker, {
            imagePath: "/uptownvine/wp-content/themes/uptownvine/assets/img/cluster-i.png"
        });

        // Run Attach Content using the marker and marker ID variables as parameters
        attachContent(marker, marker_id);
	}
    /*
     * The Attach Content Function runs with the marker and markerContent to be input as Paramaters
     */
    function attachContent(marker, markerContent) {
        // postContent inputs the marker's content into an object called postContent with a property the marker ID.
        var postContent = ( { content: markerContent } );
        // The marker object adds an Event Listener for a click on the marker and runs a function
        marker.addListener('click', function() {
            // jQuery runs a for loop through each modal with a class of post-modal-behind
            jQuery('.post-modal-behind').each(function() {
                // The variable clicked_marker_ID adds "item_" and the marker ID
                var clicked_marker_ID = "item_" + postContent.content;
                // The variable post_ID holds the ID attribute from the class post-modal-behind
                var post_ID = jQuery(this).attr('id');
                // An if statement runs to check if the clicked_marker_ID value matches post_ID variables
                if (clicked_marker_ID == post_ID) {
                    // Adds the class of active-modal to the current modal selection
                    jQuery(this).addClass("active-modal");
                    // If the current modal has a class of active-modal fade the modal in with this post ID
                    if(jQuery(this).hasClass("active-modal")) {
                        jQuery('.inactive-post').hide();
                        jQuery("#" + post_ID).fadeIn("swing");
                    }
                    // Prevent the window from scrolling while the modal is open
                    var scrollPosition = [
                        self.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft,
                        self.pageYOffset || document.documentElement.scrollTop  || document.body.scrollTop
                    ];
                    var html = jQuery('html');
                    html.data('scroll-position', scrollPosition);
                    html.data('previous-overflow', html.css('overflow'));
                    html.css('overflow', 'hidden');
                    window.scrollTo(scrollPosition[0], scrollPosition[1]);
                } // End If Statement
                // Set a Timeout function to make links active inside the Post Modal to prevent double clicking links on animation
                window.setTimeout(function() {
                    jQuery('.post-modal a').addClass("active-link");
                }, 1000);

                // Close the Modal
                jQuery(".close").click(function(e) {
                    jQuery("#" + post_ID).fadeOut("swing");
                    jQuery(".post-modal-behind").removeClass("active-modal");
                    jQuery(".post-modal a").removeClass( "active-link" );
                    jQuery(".post-modal a").addClass( "inactive-link" );
                    // un-lock scroll position
                    var html = jQuery('html');
                    var scrollPosition = html.data('scroll-position');
                    html.css('overflow', html.data('previous-overflow'));
                    window.scrollTo(scrollPosition[0], scrollPosition[1]);
                    e.preventDefault();
                }); // End Exit on click
            }); // End Post Loop
        }); // End Add Listener
    } // End Attach Content
    jQuery(nextPostBtn).on('click', function(e) {
        e.preventDefault();
        var currentPost = document.getElementsByClassName( 'current-post');
        var inactivePost = document.getElementsByClassName( 'inactive-post' );
        var nextPost = jQuery(currentPost).next();
        jQuery(currentPost).removeClass('current-post');
        jQuery(currentPost).addClass('inactive-post');
        inactivePost.slideUp('swing');
        nextPost.slideToggle('swing');
    });
} // End Initialize

initialize();