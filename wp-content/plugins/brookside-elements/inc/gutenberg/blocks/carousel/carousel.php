<?php
function brookside_postscarousel_block() {
	// Scripts.
	wp_register_script(
		'brookside_postscarousel-block-script', // Handle.
		BROOKSIDE_PLUGIN_URL.'inc/gutenberg/blocks/carousel/block.js', // Block.js: We register the block here.
		array( 'wp-blocks', 'wp-editor', 'wp-element', 'wp-i18n', 'wp-api-fetch' ) // Dependencies, defined above.
	);

	// Here we actually register the block with WP, again using our namespacing
	// We also specify the editor script to be used in the Gutenberg interface
	register_block_type( 'brookside/postscarousel', array(
		'editor_script' => 'brookside_postscarousel-block-script',
		'attributes'      => array(
			'slideshow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'number_posts' => array(
				'type' => 'string',
				'default' => '5'
			),
			'loop' => array(
				'type' => 'boolean',
				'default' => false
			),	
			'cat_slug' => array(
				'type' => 'string',
			),
			'post_ids' => array(
				'type' => 'array',
				'default' => [],
				'items'   => [
					'type' => 'integer',
				],
			),
			'nav' => array(
				'type' => 'boolean',
				'default' => false
			),
			'show_dots' => array(
				'type' => 'boolean',
				'default' => true
			),
		),
		'render_callback' => 'BrooksidePostsCarousel',
	) );

}
add_action( 'init', 'brookside_postscarousel_block' );
function BrooksidePostsCarousel($attributes){
	extract(shortcode_atts(array(
    	'slideshow' => 'false',
    	'loop' => 'false',
      	'number_posts' => '5',
      	'cat_slug' => '',
      	'post_ids' => '',
      	'nav' => 'false',
      	'show_dots' => 'true'
    ), $attributes));
    $loop = $loop ? 'true' : 'false';
    $slideshow = $slideshow ? 'true' : 'false';
    $nav = $nav ? 'true' : 'false';
    $show_dots = $show_dots ? 'true' : 'false';
    $post_ids = implode(',', $post_ids);
	$out = '[carouselposts posts_count="'.$number_posts.'" slideshow="'.$slideshow.'" loop="'.$loop.'" cat_slug="'.$cat_slug.'" post_ids="'.$post_ids.'" nav="'.$nav.'" show_dots="'.$show_dots.'"]';
	return do_shortcode($out);
}