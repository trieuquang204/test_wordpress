<?php
function brookside_contactform_block() {
	// Scripts.
	wp_register_script(
		'brooksidecontactform-block-script', // Handle.
		BROOKSIDE_PLUGIN_URL.'inc/gutenberg/blocks/contactform/block.js', // Block.js: We register the block here.
		array( 'wp-blocks', 'wp-editor', 'wp-element', 'wp-i18n' ) // Dependencies, defined above.
	);

	// Here we actually register the block with WP, again using our namespacing
	// We also specify the editor script to be used in the Gutenberg interface
	register_block_type( 'brookside/contactform', array(
		'editor_script' => 'brooksidecontactform-block-script',
		'attributes'      => array(
			'contactform' => array(
				'type' => 'string',
				'default' => ''
			),
		),
		'render_callback' => 'BrooksideContactFormConvert',
	) );

}
add_action( 'init', 'brookside_contactform_block' );
function BrooksideContactFormConvert($attributes){
	$out = '';
	$out = $attributes['contactform'];
	if($out != ''){
		return do_shortcode($out);
	} else {
		return esc_html__('You need to insert shortcode for your form from "Contact Form 7" plugin or similar.', 'brookside-elements');
	}
	
}