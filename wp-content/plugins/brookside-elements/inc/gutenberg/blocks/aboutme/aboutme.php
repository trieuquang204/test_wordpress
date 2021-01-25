<?php
function brookside_aboutme_block() {
	// Scripts.
	wp_register_script(
		'brookside-aboutme-block-script', // Handle.
		BROOKSIDE_PLUGIN_URL.'inc/gutenberg/blocks/aboutme/block.js', // Block.js: We register the block here.
		array( 'wp-blocks', 'wp-editor', 'wp-element', 'wp-i18n' ) // Dependencies, defined above.
	);

	// Here we actually register the block with WP, again using our namespacing
	// We also specify the editor script to be used in the Gutenberg interface
	register_block_type( 'brookside/aboutme', array(
		'editor_script' => 'brookside-aboutme-block-script',
		'attributes'      => array(
			'title' => array(
				'type' => 'string',
				'default' => 'Hello, my name is Skye Jenner.'
			),
			'subtitle' => array(
				'type' => 'string',
				'default' => 'Welcome'
			),
			'text' => array(
				'type' => 'string',
				'default' => ''
			),
			'mediaID' => array(
				'type' => 'number',
				'default' => ''
			),
			'mediaURL' => array(
				'type' => 'string',
				'default' => ''
			),
			'socials' => array(
				'type' => 'boolean',
				'default' => true
			),
			'fullwidth' => array(
				'type' => 'boolean',
				'default' => true
			),
		),
		'render_callback' => 'BrooksideAboutMeCallback',
	) );

}
add_action( 'init', 'brookside_aboutme_block' );
function BrooksideAboutMeCallback($attributes){
	extract(shortcode_atts(array(
    	'title' => 'Hello, my name is Skye Jenner.',
    	'subtitle' => 'Welcome',
    	'text' => '',
      	'mediaID' => '',
      	'mediaURL' => '',
      	'socials' => 'true',
      	'fullwidth' => 'true'
    ), $attributes));
    $socials = $socials ? 'true' : 'false';
    $fullwidth = $fullwidth ? 'true' : 'false';
    $out = '[brooksideaboutme title="'.$title.'" subtitle="'.$subtitle.'" text="'.$text.'" mediaid="'.$mediaID.'" mediaurl="'.$mediaURL.'" socials="'.$socials.'" fullwidth="'.$fullwidth.'"]';
	return do_shortcode($out);	
}