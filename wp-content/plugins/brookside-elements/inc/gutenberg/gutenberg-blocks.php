<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'block_categories', function( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'brooksideelements',
				'title' => esc_html__( 'Brookside Elements', 'brookside-elements' ),
			),
		)
	);
}, 10, 2 );

/**
 * Enqueue JavaScript
 */
function block_styles_enqueue_javascript() {
    wp_enqueue_script( 'brookside-styles-script', BROOKSIDE_PLUGIN_URL.'inc/gutenberg/blocks/block.js', array( 'wp-blocks'));
} 
add_action( 'enqueue_block_editor_assets', 'block_styles_enqueue_javascript' ); 

require_once( realpath(dirname(__FILE__)) . '/blocks/gridposts/gridposts.php' );
require_once( realpath(dirname(__FILE__)) . '/blocks/singlepost/singlepost.php' );
require_once( realpath(dirname(__FILE__)) . '/blocks/aboutme/aboutme.php' );
require_once( realpath(dirname(__FILE__)) . '/blocks/contactform/contactform.php' );
require_once( realpath(dirname(__FILE__)) . '/blocks/sidebar/sidebar.php' );
require_once( realpath(dirname(__FILE__)) . '/blocks/slider/slider.php' );
require_once( realpath(dirname(__FILE__)) . '/blocks/socials/socials.php' );
require_once( realpath(dirname(__FILE__)) . '/blocks/map/map.php' );
require_once( realpath(dirname(__FILE__)) . '/blocks/subscribe/subscribe.php' );
require_once( realpath(dirname(__FILE__)) . '/blocks/carousel/carousel.php' );
require_once( realpath(dirname(__FILE__)) . '/blocks/category/category.php' );