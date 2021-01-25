<?php
function brookside_singlepost_block() {
	// Scripts.
	wp_register_script(
		'brookside-singlepost-block-script', // Handle.
		BROOKSIDE_PLUGIN_URL.'inc/gutenberg/blocks/singlepost/block.js', // Block.js: We register the block here.
		array( 'wp-blocks', 'wp-editor', 'wp-element', 'wp-i18n' ) // Dependencies, defined above.
	);


	// Here we actually register the block with WP, again using our namespacing
	// We also specify the editor script to be used in the Gutenberg interface
	register_block_type( 'brookside/singlepost', array(
		'editor_script' => 'brookside-singlepost-block-script',
		'attributes'      => array(
			'post_id' => array(
				'type' => 'string',
			),
			'thumbsize' => array(
				'type' => 'string',
				'default' => 'full'
			),
			'display_categories' => array(
				'type' => 'boolean',
				'default' => 1
			),
		),
		'render_callback' => 'BrooksideSinglePostConvert',
	) );

}
add_action( 'init', 'brookside_singlepost_block' );
function BrooksideSinglePostConvert($attributes){
	extract(shortcode_atts(array(
      	'post_id' => '',
      	'thumbsize'		=> 'full',
      	'display_categories' => 'true',
    ), $attributes));

	$out = '[singlepost post_ids="'.$post_id.'" thumbsize="'.$thumbsize.'" show_categories="'.$display_categories.'"]';
	return do_shortcode($out);
}