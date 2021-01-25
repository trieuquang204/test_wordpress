<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Display map js.
 */    
function mistercorporate_js_method() {
    if ( get_theme_mod( 'mrcorp_map_show' ) ){

    	if ( get_theme_mod( 'mrcorp_map_google_api' ) ){
    		    wp_enqueue_script( 'mistercorporate-googlemaps', 'https://maps.googleapis.com/maps/api/js?key='.get_theme_mod( 'mrcorp_map_google_api' ) , array('jquery', 'jquery-ui-core'), '1.0.0', true );
    	} else {
    			wp_enqueue_script( 'mistercorporate-googlemaps', 'https://maps.googleapis.com/maps/api/js' );
    	}
	
    	wp_enqueue_script( 'mistercorporate-map', MISTERCORPORATE_NS_PLUGIN_URL . '/js/mistercorporate-map.js', array( 'jquery' ), '1.0', true );

        $mrcoporate_marker_img = MISTERCORPORATE_NS_PLUGIN_URL . '/img/map-marker.png';
        $image_attributes = wp_get_attachment_image_src( get_theme_mod( 'mrcorp_marker_img' ) );
        if( $image_attributes ) :
            $mrcoporate_marker_img = $image_attributes[0];
        endif;    
        $mrcoporate_marker_lat = get_theme_mod( 'mrcorp_marker_pos_lat' );
        $mrcoporate_marker_lng = get_theme_mod( 'mrcorp_marker_pos_lng' );
        $mrcoporate_center_lat = get_theme_mod( 'mrcorp_marker_center_lat' );
        $mrcoporate_center_lng = get_theme_mod( 'mrcorp_marker_center_lng' );
        $mrcoporate_map_js = "

			//MAP
			// When the window has finished loading create our google map below
			google.maps.event.addDomListener(window, 'load', init);

			function init() {
			    // Basic options for a simple Google Map
			    // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
			    var mapOptions = {
			        scrollwheel: false,
			        // How zoomed in you want the map to start at (always required)
			        zoom: 12,

			        // The latitude and longitude to center the map (always required)
			        center: new google.maps.LatLng({$mrcoporate_center_lat},{$mrcoporate_center_lng}),

			        // How you would like to style the map. 
			        // This is where you would paste any style found on Snazzy Maps.
			        styles: [{'featureType':'all','elementType':'geometry.fill','stylers':[{'weight':'2.00'}]},{'featureType':'all','elementType':'geometry.stroke','stylers':[{'color':'#9c9c9c'}]},{'featureType':'all','elementType':'labels.text','stylers':[{'visibility':'on'}]},{'featureType':'landscape','elementType':'all','stylers':[{'color':'#f2f2f2'}]},{'featureType':'landscape','elementType':'geometry.fill','stylers':[{'color':'#ffffff'}]},{'featureType':'landscape.man_made','elementType':'geometry.fill','stylers':[{'color':'#ffffff'}]},{'featureType':'poi','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'road','elementType':'all','stylers':[{'saturation':-100},{'lightness':45}]},{'featureType':'road','elementType':'geometry.fill','stylers':[{'color':'#eeeeee'}]},{'featureType':'road','elementType':'labels.text.fill','stylers':[{'color':'#7b7b7b'}]},{'featureType':'road','elementType':'labels.text.stroke','stylers':[{'color':'#ffffff'}]},{'featureType':'road.highway','elementType':'all','stylers':[{'visibility':'simplified'}]},{'featureType':'road.arterial','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'transit','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'water','elementType':'all','stylers':[{'color':'#46bcec'},{'visibility':'on'}]},{'featureType':'water','elementType':'geometry.fill','stylers':[{'color':'#c8d7d4'}]},{'featureType':'water','elementType':'labels.text.fill','stylers':[{'color':'#070707'}]},{'featureType':'water','elementType':'labels.text.stroke','stylers':[{'color':'#ffffff'}]}]
			    };

			    // Get the HTML DOM element that will contain your map 
			    // We are using a div with id='map' seen below in the <body>
			    var mapElement = document.getElementById('map');

			    // Create the Google Map using our element and options defined above
			    var map = new google.maps.Map(mapElement, mapOptions);

			    var image = '{$mrcoporate_marker_img}';
			      var beachMarker = new google.maps.Marker({
			        position: {lat: {$mrcoporate_marker_lat}, lng: {$mrcoporate_marker_lng}},
			        map: map,
			        icon: image
			      });
			}
        ";
        wp_add_inline_script( 'mistercorporate-map', $mrcoporate_map_js );
    } // if show map
}
add_action( 'wp_enqueue_scripts', 'mistercorporate_js_method' );