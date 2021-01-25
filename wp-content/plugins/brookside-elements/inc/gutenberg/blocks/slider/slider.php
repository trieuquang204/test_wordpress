<?php
function brookside_postslider_block() {
	// Scripts.
	wp_register_script(
		'brookside_postslider-block-script', // Handle.
		BROOKSIDE_PLUGIN_URL.'inc/gutenberg/blocks/slider/block.js', // Block.js: We register the block here.
		array( 'wp-blocks', 'wp-editor', 'wp-element', 'wp-i18n', 'wp-api-fetch' ) // Dependencies, defined above.
	);

	// Here we actually register the block with WP, again using our namespacing
	// We also specify the editor script to be used in the Gutenberg interface
	register_block_type( 'brookside/postslider', array(
		'editor_script' => 'brookside_postslider-block-script',
		'attributes'      => array(
			'slideshow' => array(
				'type' => 'boolean',
				'default' => true
			),
			'number_posts' => array(
				'type' => 'string',
				'default' => '3'
			),
			'loop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'orderby' => array(
				'type' => 'string',
				'default' => 'date'
			),
			'order' => array(
				'type' => 'string',
				'default' => 'DESC'
			),
			'thumbsize' => array(
				'type' => 'string',
				'default' => 'large'
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
			'show_categories' => array(
				'type' => 'string',
				'default' => 'true'
			),
			'slider_style' => array(
				'type' => 'string',
				'default' => 'style_1'
			),
			'nav' => array(
				'type' => 'boolean',
				'default' => false
			),
			'show_dots' => array(
				'type' => 'boolean',
				'default' => true
			),
			'slider_height' => array(
				'type' => 'string',
				'default' => '580'
			),
			'excerpt_count' => array(
				'type' => 'string',
				'default' => '29'
			),
		),
		'render_callback' => 'BrooksidePostSliderConvert',
	) );

}
add_action( 'init', 'brookside_postslider_block' );
function BrooksidePostSliderConvert($attributes){
	extract(shortcode_atts(array(
    	'slideshow' => true,
    	'loop' => 'false',
      	'number_posts' => '3',
      	'orderby' => 'date',
      	'order' => 'DESC',
      	'thumbsize' => 'brookside-extra-medium',
      	'cat_slug' => '',
      	'post_ids' => '',
      	'nav' => 'false',
      	'show_categories' => 'true',
      	'show_dots' => 'true',
      	'excerpt_count' => '29',
      	'slider_height' => '',
      	'slider_style' => 'style_1'
    ), $attributes));
    $loop = $loop ? 'true' : 'false';
    $slideshow = $slideshow ? 'true' : 'false';
    $nav = $nav ? 'true' : 'false';
    $show_dots = $show_dots ? 'true' : 'false';
    $post_ids = implode(',', $post_ids);
	$out = '[post_slider number_posts="'.$number_posts.'" slideshow="'.$slideshow.'" loop="'.$loop.'" cat_slug="'.$cat_slug.'" post_ids="'.$post_ids.'" orderby="'.$orderby.'" order="'.$order.'" thumbsize="'.$thumbsize.'" nav="'.$nav.'" show_categories="'.$show_categories.'" show_dots="'.$show_dots.'" excerpt_count="'.$excerpt_count.'" slider_style="'.$slider_style.'" slider_height="'.$slider_height.'"]';
	return do_shortcode($out);
}