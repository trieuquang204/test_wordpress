<?php
function brooksidegridposts_block() {
	// Scripts.
	wp_register_script(
		'brooksidegridposts-block-script', // Handle.
		BROOKSIDE_PLUGIN_URL.'inc/gutenberg/blocks/gridposts/block.js', // Block.js: We register the block here.
		array( 'wp-blocks', 'wp-editor', 'wp-element', 'wp-i18n' ) // Dependencies, defined above.
	);

	// Styles.
	wp_register_style(
		'brooksidegridposts-block-editor-style', // Handle.
		BROOKSIDE_PLUGIN_URL.'inc/gutenberg/blocks/gridposts/editor.css', // Block editor CSS.
		array( 'wp-edit-blocks' ) // Dependency to include the CSS after it.
	);

	// Here we actually register the block with WP, again using our namespacing
	// We also specify the editor script to be used in the Gutenberg interface
	register_block_type( 'brookside/gridposts', array(
		'editor_script' => 'brooksidegridposts-block-script',
		'editor_style' => 'brooksidegridposts-block-editor-style',
		'attributes'      => array(
			'num' => array(
				'type' => 'string',
				'default' => '6'
			),
			'load_count' => array(
				'type' => 'string',
			),
			'offset' => array(
				'type' => 'string',
			),
			'columns' => array(
				'type' => 'string',
				'default' => 'span6'
			),
			'post_style' => array(
				'type' => 'string',
				'default' => 'style_1'
			),
			'orderby' => array(
				'type' => 'string',
				'default' => 'date'
			),
			'order' => array(
				'type' => 'string',
				'default' => 'DESC'
			),
			'post_ids' => array(
				'type' => 'array',
				'default' => [],
				'items'   => [
					'type' => 'integer',
				],
			),
			'cat_slug' => array(
				'type' => 'array',
				'default' => [],
				'items'   => [
					'type' => 'string',
				],
			),
			'post__not_in' => array(
				'type' => 'array',
				'default' => [],
				'items'   => [
					'type' => 'integer',
				],
			),
			'pagination' => array(
				'type' => 'string',
				'default' => 'standard'
			),
			'thumbsize' => array(
				'type' => 'string',
				'default' => 'medium'
			),
			'text_align' => array(
				'type' => 'string',
				'default' => 'textleft'
			),
			'excerpt_count' => array(
				'type' => 'string',
				'default' => '15'
			),
			'display_categories' => array(
				'type' => 'boolean',
				'default' => 1
			),
			'display_date' => array(
				'type' => 'boolean',
				'default' => 1
			),
			'display_comments' => array(
				'type' => 'boolean',
				'default' => 0
			),
			'display_views' => array(
				'type' => 'boolean',
				'default' => 0
			),
			'display_likes' => array(
				'type' => 'boolean',
				'default' => 0
			),
			'display_read_time' => array(
				'type' => 'boolean',
				'default' => 0
			),
			'ignore_featured' => array(
				'type' => 'boolean',
				'default' => 1
			),
			'ignore_sticky_posts' => array(
				'type' => 'boolean',
				'default' => 1
			),
		),
		'render_callback' => 'BrooksideGridPostsConvert',
	) );

}
add_action( 'init', 'brooksidegridposts_block' );
function BrooksideGridPostsConvert($attributes){
	extract(shortcode_atts(array(
    	'num' => '6',
      	'load_count' => '',
      	'offset' => '',
      	'columns' => 'span4',
      	'post_style' => 'style_1',
      	'orderby' => 'date',
      	'order' => 'DESC',
      	'cat_slug' => '',
      	'post_ids' => '',
      	'post__not_in' => '',
      	'pagination' => 'standard',
      	'thumbsize'		=> 'medium',
      	'text_align' => 'textleft',
      	'excerpt_count'	=> '15',
      	'display_categories' => 'true',
      	'display_date' => 'true',
      	'display_comments' => 'false',
      	'display_views' => 'false',
      	'display_likes' => 'false',
      	'display_read_time' => 'false',
      	'ignore_featured' => 'true',
      	'ignore_sticky_posts' => 'true'
    ), $attributes));

	$out = '[gridposts
	num="'.$num.'" 
	load_count="'.$load_count.'" 
	columns="'.$columns.'" 
	post_style="'.$post_style.'" 
	post_ids="'.implode(',',$post_ids).'" 
	orderby="'.$orderby.'" 
	order="'.$order.'" 
	cat_slug="'.implode(',',$cat_slug).'" 
	post__not_in="'.implode(',',$post__not_in).'" 
	pagination="'.$pagination.'" 
	thumbsize="'.$thumbsize.'" 
	text_align="'.$text_align.'" 
	excerpt_count="'.$excerpt_count.'" 
	display_categories="'.$display_categories.'" 
	display_date="'.$display_date.'" 
	display_comments="'.$display_comments.'" 
	display_views="'.$display_views.'" 
	display_likes="'.$display_likes.'" 
	display_read_time="'.$display_read_time.'"
	ignore_featured="'.$ignore_featured.'" 
	ignore_sticky_posts="'.$ignore_sticky_posts.'"]';
	return shortcode_unautop(do_shortcode($out));
}