<?php

add_action( 'init', 'brookside_elements_vc_shortcodes' );
function brookside_elements_vc_shortcodes() {
	$imageSizes = get_intermediate_image_sizes();
	$imageSizes[]= 'full';
	$suf = rand(0, 9999);
    vc_add_shortcode_param( 'hidden_id', 'brookside_hidden_id_settings_field' );
	function brookside_hidden_id_settings_field( $settings, $value ) {
	   return '<div class="hidden_id_param_block" style="display:none;">'
	             .'<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' .
	             esc_attr( $settings['param_name'] ) . ' ' .
	             esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" />' .
	             '</div>'; // This is html markup that will be outputted in content elements edit form
	}
	$text_transform = array(
		esc_html__('Default', 'brookside-elements' ) => 'default',
		esc_html__('Uppercase', 'brookside-elements' ) => 'uppercase',
		esc_html__('Lowercase', 'brookside-elements' ) => 'lowercase',
		esc_html__('Capitalize', 'brookside-elements' ) => 'capitalize'
	);
	vc_map( 
		array(
			"name" => __("Brookside Posts Slider", 'brookside-elements'),
			"base" => "post_slider",
			"icon" => 'brookside-element-icon dashicons dashicons-slides',
			"category" => __('Brookside Elements', 'brookside-elements'),
			'front_enqueue_js' => array(BROOKSIDE_PLUGIN_URL.'js/owl.carousel.min.js'),
			'description' => __('Slider with your posts', 'brookside-elements'),
			"params" => array(
				array(
					"type" => "dropdown",            
					"heading" => __("Autoplay", 'brookside-elements'),
					"param_name" => "slideshow",
					"value" => array(
					   __('Enable', 'brookside-elements')=>'true',
					   __('Disable', 'brookside-elements')=>'false',
					),
					"description" => __("Disable or Enable Autoplay.", 'brookside-elements'),
					"std" => array('true')
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Loop", 'brookside-elements'),
					"param_name" => "loop",
					"value" => array(
					   __('Enable', 'brookside-elements')=>'true',
					   __('Disable', 'brookside-elements')=>'false',
					),
					"description" => __("If you want to have continuous slider, please select enable", 'brookside-elements'),
					"std" => array('false')
				),		
				array(
					"type" => "textfield",            
					"heading" => __("Slider count", 'brookside-elements'),
					"param_name" => "number_posts",
					"value" => '3',
					'admin_label' => true,
					"description" => __("Enter number of slides to display (Note: Enter '-1' to display all slides).", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Category slug", 'brookside-elements'),
					"param_name" => "cat_slug",
					"value" => '',
					"description" => __("This help you to retrieve items from specific category. More than one separate by commas.", 'brookside-elements')
				),
				array(
					"type" => "textfield",            
					"heading" => __("Post IDs", 'brookside-elements'),
					"param_name" => "post_ids",
					"value" => '',
					"description" => __("Enter posts IDs to display only those records (Note: separate values by commas (,)).", 'brookside-elements')
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Order by", 'brookside-elements'),
					"param_name" => "orderby",
					"value" => array(
					   __('Date', 'brookside-elements')=>'date', 
					   __('Last modified date', 'brookside-elements') => 'modified',
					   __('Popularity', 'brookside-elements')=>'comment_count',
					   __('Title', 'brookside-elements')=>'title',
					   __('Random', 'brookside-elements')=>'rand',
					   __('Preserve post ID order', 'brookside-elements') => 'post__in',
					),
					"description" => __('Select how to sort retrieved posts.', 'brookside-elements'),
					"std" => array('date')
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Sort order", 'brookside-elements'),
					"param_name" => "order",
					"value" => array(
					   __('Descending', 'brookside-elements')=>'DESC', 
					   __('Ascending', 'brookside-elements')=>'ASC'
					),
					"description" => __('Select ascending or descending order.', 'brookside-elements'),
					"std" => array('DESC')
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Image size", 'brookside-elements'),
					"param_name" => "thumbsize",
					"value" => $imageSizes,
					"description" => __('Select your image size to use in slider.', 'brookside-elements'),
					"std" => array('large')
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Slider Style", 'brookside-elements'),
					"param_name" => "style",
					"value" => array(
					   __('Centered', 'brookside-elements')=>'center',
					   __('Two Centered', 'brookside-elements')=>'center2',
					   __('Simple', 'brookside-elements')=>'simple',
					   __('Two in row', 'brookside-elements') => 'two_per_row',
					   __('Three in row', 'brookside-elements') => 'three_per_row',
					),
					"std" => array('simple')
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Description Style", 'brookside-elements'),
					"param_name" => "description_style",
					"value" => array(
					   __('Style 1', 'brookside-elements')=>'style_1',
					   __('Style 2', 'brookside-elements') => 'style_2',
					   __('Style 3', 'brookside-elements') => 'style_3',
					   __('Style 4', 'brookside-elements') => 'style_4',
					   __('Style 5', 'brookside-elements') => 'style_5',
					),
					"std" => array('style_1')
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Navigation arrows", 'brookside-elements'),
					'description' => __('Display navigation arrows.', 'brookside-elements'),
					"param_name" => "nav",
					"value" => array(
					   __('Show', 'brookside-elements') => 'true',
					   __('Hide', 'brookside-elements') => 'false',
					),
					"std" => array('true')
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Overlay", 'brookside-elements'),
					'description' => __('Display overlay on image. Your image with displays with some saturation.', 'brookside-elements'),
					"param_name" => "overlay",
					"value" => array(
					   __('Show', 'brookside-elements') => 'true',
					   __('Hide', 'brookside-elements') => 'false',
					),
					"std" => array('true')
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Show meta categories?", 'brookside-elements'),
					"param_name" => "show_categories",
					"value" => array(
					   __('Show', 'brookside-elements') => 'true',
					   __('Hide', 'brookside-elements') => 'false',
					),
					"std" => array(true)
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Show date?", 'brookside-elements'),
					"param_name" => "show_date",
					"value" => array(
					   __('Show', 'brookside-elements') => 'true',
					   __('Hide', 'brookside-elements') => 'false',
					),
					"std" => array('true')
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Slider width", 'brookside-elements'),
					"param_name" => "slider_width",
					"value" => array(
					   __('Fullwidth', 'brookside-elements') => 'fullwidth',
					   __('Standard', 'brookside-elements') => 'standard',
					),
					"std" => array('standard')
				),
			)
		)
	);
	/*vc_map( 
		array(
			"name" => __("Brookside List Posts", 'brookside-elements'),
			"base" => "listposts",
			"icon" => 'brookside-element-icon dashicons dashicons-admin-post',
			"category" => __('Brookside Elements', 'brookside-elements'),
			'description' => __('Show WP posts. Latest, Popular or from specific category, etc.', 'brookside-elements'),
			"params" => array(		
				array(
					"type" => "textfield",            
					"heading" => __("Post count", 'brookside-elements'),
					"param_name" => "num",
					"value" => '3',
					'admin_label' => true,
					"description" => __("Enter number of posts to display (Note: Enter '-1' to display all posts).", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Category slug", 'brookside-elements'),
					"param_name" => "cat_slug",
					"value" => '',
					"description" => __("This help you to retrieve items from specific category. More than one separate by commas.", 'brookside-elements')
				),
				array(
					"type" => "textfield",            
					"heading" => __("Post IDs", 'brookside-elements'),
					"param_name" => "post_ids",
					"value" => '',
					"description" => __("Enter posts IDs to display only those records (Note: separate values by commas (,)).", 'brookside-elements')
				),
				array(
					"type" => "textfield",            
					"heading" => __("Post IDs Exclude", 'brookside-elements'),
					"param_name" => "post__not_in",
					"value" => '',
					"description" => __("Enter posts IDs to exclude those records (Note: separate values by commas (,)).", 'brookside-elements')
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Sort order", 'brookside-elements'),
					"param_name" => "order",
					"value" => array(
					   __('Descending', 'brookside-elements')=>'DESC', 
					   __('Ascending', 'brookside-elements')=>'ASC'
					),
					"description" => __('Select ascending or descending order.', 'brookside-elements'),
					"std" => array('DESC')
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Thumbnail size", 'brookside-elements'),
					"param_name" => "thumbsize",
					"value" => $imageSizes,
					"description" => __('Select your image size to use.', 'brookside-elements'),
					"std" => array('medium')
				),
				array(
		            "type" => "dropdown",            
		            "heading" => __("Display date?", 'brookside-elements'),
		            "param_name" => "display_date",
		            "value" => array(__('Yes','brookside-elements')=>'true', __('No', 'brookside-elements')=>'false'),
		            "std" => array('true')
		        ),
		        array(
		            "type" => "dropdown",            
		            "heading" => __("Display categories?", 'brookside-elements'),
		            "param_name" => "display_categories",
		            "value" => array(__('Yes','brookside-elements')=>'true', __('No', 'brookside-elements')=>'false'),
		            "std" => array('true')
		        ),
				array(
		            "type" => "dropdown",            
		            "heading" => __("Display likes?", 'brookside-elements'),
		            "param_name" => "display_likes",
		            "value" => array(__('Yes','brookside-elements')=>'true', __('No', 'brookside-elements')=>'false'),
		            "std" => array('true')
		        ),
		        array(
		            "type" => "dropdown",            
		            "heading" => __("Display read time?", 'brookside-elements'),
		            "param_name" => "display_read_time",
		            "value" => array(__('Yes','brookside-elements')=>'true', __('No', 'brookside-elements')=>'false'),
		            "std" => array('true')
		        ),
		        array(
		            "type" => "dropdown",            
		            "heading" => __("Display views count?", 'brookside-elements'),
		            "param_name" => "display_views",
		            "value" => array(__('Yes','brookside-elements')=>'true', __('No', 'brookside-elements')=>'false'),
		            "std" => array('true')
		        ),
				array(
		            "type" => "dropdown",            
		            "heading" => __("Display comments count?", 'brookside-elements'),
		            "param_name" => "display_comments",
		            "value" => array(__('Yes','brookside-elements')=>'true', __('No', 'brookside-elements')=>'false'),
		            "std" => array('false')
		        ),
		        array(
					"type" => "dropdown",            
					"heading" => __("Display read more?", 'brookside-elements'),
					"param_name" => "display_readmore",
					"value" => array(
					   __('Yes', 'brookside-elements') => 'true',
					   __('No', 'brookside-elements') => 'false',
					),
					"std" => array('true')
				),
				array(
					"type" => "textfield",            
					"heading" => __("Post excerpt count", 'brookside-elements'),
					"param_name" => "excerpt_count",
					"value" => '32',
					"description" => __("Enter number of words in post excerpt.", 'brookside-elements')            
				),
				array(
		            "type" => "dropdown",            
		            "heading" => __("Pagination", 'brookside-elements'),
		            "param_name" => "pagination",
		            "value" => array(__('Enable','brookside-elements')=>'true', __('Disable', 'brookside-elements')=>'false'),
		            "description" => __('Enable or Disable pagination for posts.', 'brookside-elements'),
		            "std" => array('false')
		        ),
		        array(
		            "type" => "dropdown",            
		            "heading" => __("Disable featured posts style", 'brookside-elements'),
		            "param_name" => "ignore_featured",
		            "value" => array(__('Yes','brookside-elements')=>'true', __('No', 'brookside-elements')=>'false'),
		            "description" => __('Disable style for featured posts. Do not highlight them.', 'brookside-elements'),
		            "std" => array('true')
		        ),
		        array(
		            "type" => "dropdown",            
		            "heading" => __("Ignore sticky posts", 'brookside-elements'),
		            "param_name" => "ignore_sticky_posts",
		            "value" => array(__('Yes','brookside-elements')=>'true', __('No', 'brookside-elements')=>'false'),
		            "description" => __('Do you want to ignore sticky posts?', 'brookside-elements'),
		            "std" => array('false')
		        ),
			)
		)
	);*/
	vc_map( 
		array(
			"name" => __("Brookside Recent Posts", 'brookside-elements'),
			"base" => "gridposts",
			"icon" => 'brookside-element-icon dashicons dashicons-layout',
			"category" => __('Brookside Elements', 'brookside-elements'),
			'description' => __('Show WP posts in grid.', 'brookside-elements'),
			"params" => array(	
				array(
					"type" => "textfield",            
					"heading" => __("Post count", 'brookside-elements'),
					"param_name" => "num",
					"value" => '3',
					'admin_label' => true,
					"description" => __("Enter number of posts to display (Note: Enter '-1' to display all posts).", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Load more posts count", 'brookside-elements'),
					"param_name" => "load_count",
					"value" => '',
					"description" => __("Enter number of posts to load (leave balnk to use the same value as per page).", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Category slug", 'brookside-elements'),
					"param_name" => "cat_slug",
					"value" => '',
					"description" => __("This help you to retrieve items from specific category. More than one separate by commas.", 'brookside-elements')
				),
				array(
					"type" => "textfield",            
					"heading" => __("Post IDs", 'brookside-elements'),
					"param_name" => "post_ids",
					"value" => '',
					"description" => __("Enter posts IDs to display only those records (Note: separate values by commas (,)).", 'brookside-elements')
				),
				array(
					"type" => "textfield",            
					"heading" => __("Post IDs Exclude", 'brookside-elements'),
					"param_name" => "post__not_in",
					"value" => '',
					"description" => __("Enter posts IDs to exclude those records (Note: separate values by commas (,)).", 'brookside-elements')
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Order by", 'brookside-elements'),
					"param_name" => "orderby",
					"value" => array(
					   __('Date', 'brookside-elements')=>'date', 
					   __('Last modified date', 'brookside-elements') => 'modified',
					   __('Popularity', 'brookside-elements')=>'comment_count',
					   __('Title', 'brookside-elements')=>'title',
					   __('Random', 'brookside-elements')=>'rand',
					   __('Preserve post ID order', 'brookside-elements') => 'post__in',
					),
					"description" => __('Select how to sort retrieved posts.', 'brookside-elements'),
					"std" => array('date')
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Sort order", 'brookside-elements'),
					"param_name" => "order",
					"value" => array(
					   __('Descending', 'brookside-elements')=>'DESC', 
					   __('Ascending', 'brookside-elements')=>'ASC'
					),
					"description" => __('Select ascending or descending order.', 'brookside-elements'),
					"std" => array('DESC')
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Post view style", 'brookside-elements'),
					"param_name" => "post_style",
					"value" => array(
					   __('Simple', 'brookside-elements')=>'style_1',
					   __('Featured','brookside-elements') => 'style_2', 
					   __('Featured even/odd', 'brookside-elements')=>'style_3',
					   __('Masonry', 'brookside-elements')=>'style_4',
					   __('List', 'brookside-elements') => 'style_5'
					),
					"description" => __('Select posts style on preview.', 'brookside-elements'),
					"std" => array('style_1')
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Posts per row", 'brookside-elements'),
					"param_name" => "columns",
					"value" => array(
					   __('Two', 'brookside-elements')=>'span6',
					   __('Three', 'brookside-elements')=>'span4',
					   __('Four', 'brookside-elements')=>'span3',
					   __('Five', 'brookside-elements')=>'one_fifth',
					   __('Six', 'brookside-elements')=>'span2',
					),
					"description" => __("Select posts count per row.", 'brookside-elements'),
					"std" => array('span4'),
					"dependency" => array(
				        "element" => "post_style",
				        "value" => array('style_1', 'style_4')
				    )
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Thumbnail size", 'brookside-elements'),
					"param_name" => "thumbsize",
					"value" => $imageSizes,
					"description" => __('Select your image size to use.', 'brookside-elements'),
					"std" => array('medium')
				),
				array(
					"type" => "textfield",            
					"heading" => __("Post excerpt count", 'brookside-elements'),
					"param_name" => "excerpt_count",
					"value" => '15',
					"description" => __("Enter number of words in post excerpt. 0 to hide it.", 'brookside-elements')            
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Align elements", 'brookside-elements'),
					"param_name" => "text_align",
					"value" => array(
					   __('Left', 'brookside-elements')=>'textleft',
					   __('Center', 'brookside-elements')=>'textcenter',
					   __('Right', 'brookside-elements')=>'textright'
					),
					"description" => __("Select position for text, meta info, categories, etc.", 'brookside-elements'),
					"std" => array('textcenter')
				),
		        array(
		            "type" => "dropdown",            
		            "heading" => __("Display categories?", 'brookside-elements'),
		            "param_name" => "display_categories",
		            "value" => array(__('Yes','brookside-elements')=>'true', __('No', 'brookside-elements')=>'false'),
		            "description" => __('Show categories above the title?', 'brookside-elements'),
		            "std" => array('true')
		        ),
		        array(
		            "type" => "dropdown",            
		            "heading" => __("Display time reading?", 'brookside-elements'),
		            "param_name" => "display_read_time",
		            "value" => array(__('Yes','brookside-elements')=>'true', __('No', 'brookside-elements')=>'false'),
		            "description" => __('Show estimate time to read the post?', 'brookside-elements'),
		            "std" => array('true')
		        ),
		        array(
		            "type" => "dropdown",            
		            "heading" => __("Display comments count?", 'brookside-elements'),
		            "param_name" => "display_comments",
		            "value" => array(__('Yes','brookside-elements')=>'true', __('No', 'brookside-elements')=>'false'),
		            "description" => __('Show comments count in meta?', 'brookside-elements'),
		            "std" => array('true')
		        ),
		        array(
		            "type" => "dropdown",            
		            "heading" => __("Display date label?", 'brookside-elements'),
		            "param_name" => "display_date",
		            "value" => array(__('Yes','brookside-elements')=>'true', __('No', 'brookside-elements')=>'false'),
		            "std" => array('true')
		        ),
		        array(
		            "type" => "dropdown",            
		            "heading" => __("Display views?", 'brookside-elements'),
		            "param_name" => "display_views",
		            "value" => array(__('Yes','brookside-elements')=>'true', __('No', 'brookside-elements')=>'false'),
		            "std" => array('true')
		        ),
		        array(
		            "type" => "dropdown",            
		            "heading" => __("Display likes?", 'brookside-elements'),
		            "param_name" => "display_likes",
		            "value" => array(__('Yes','brookside-elements')=>'true', __('No', 'brookside-elements')=>'false'),
		            "std" => array('true')
		        ),
				array(
		            "type" => "dropdown",            
		            "heading" => __("Pagination", 'brookside-elements'),
		            "param_name" => "pagination",
		            "value" => array(
		            	__('Load more','brookside-elements')=>'true',
		            	__('Standard','brookside-elements')=>'standard',
		            	__('Disable', 'brookside-elements')=>'false'
		            ),
		            "description" => __('Select pagination for posts.', 'brookside-elements'),
		            "std" => array('false')
		        ),
		        array(
		            "type" => "dropdown",            
		            "heading" => __("Disable featured posts style", 'brookside-elements'),
		            "param_name" => "ignore_featured",
		            "value" => array(__('Yes','brookside-elements')=>'true', __('No', 'brookside-elements')=>'false'),
		            "description" => __('Disable style for featured posts. Do not highlight them.', 'brookside-elements'),
		            "std" => array('true')
		        ),
		        array(
		            "type" => "dropdown",            
		            "heading" => __("Ignore sticky posts", 'brookside-elements'),
		            "param_name" => "ignore_sticky_posts",
		            "value" => array(__('Yes','brookside-elements')=>'true', __('No', 'brookside-elements')=>'false'),
		            "description" => __('Show sticky posts?', 'brookside-elements'),
		            "std" => array('false')
		        ),
			)
		)
	);
	vc_map( 
		array(
			"name" => __("Brookside Carousel Posts", 'brookside-elements'),
			"base" => "carouselposts",
			"icon" => 'brookside-element-icon dashicons dashicons-leftright',
			'front_enqueue_js' => array(BROOKSIDE_PLUGIN_URL.'js/owl.carousel.min.js'),
			"category" => __('Brookside Elements', 'brookside-elements'),
			'description' => __('Show WP posts in grid.', 'brookside-elements'),
			"params" => array(
				array(
					"type" => "textfield",            
					"heading" => __("Posts block title", 'brookside-elements'),
					"param_name" => "block_title",
					"value" => '',
					'admin_label' => true,
					"description" => __("Enter posts block title e.g. 'Latest posts'. Leave blank if you need not to display it.", 'brookside-elements')            
				),		
				array(
					"type" => "textfield",            
					"heading" => __("Post count", 'brookside-elements'),
					"param_name" => 'posts_count',
					"value" => '3',
					"description" => __("Enter number of posts to display (Note: Enter '-1' to display all posts).", 'brookside-elements')            
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Posts per view", 'brookside-elements'),
					"param_name" => "columns",
					"value" => array(
					   __('Two per view', 'brookside-elements')=>'span6',
					   __('Three per view', 'brookside-elements')=>'span4',
					   __('Four per view', 'brookside-elements')=>'span3',
					   __('Five per view', 'brookside-elements')=>'one_fifth',
					   __('Six per view', 'brookside-elements')=>'span2',
					),
					"description" => __("Select posts count per view.", 'brookside-elements'),
					"std" => array('one_fifth')
				),
				array(
					"type" => "textfield",            
					"heading" => __("Category slug", 'brookside-elements'),
					"param_name" => "cat_slug",
					"value" => '',
					"description" => __("This help you to retrieve items from specific category. More than one separate by commas.", 'brookside-elements')
				),
				array(
					"type" => "textfield",            
					"heading" => __("Post IDs", 'brookside-elements'),
					"param_name" => "post_ids",
					"value" => '',
					"description" => __("Enter posts IDs to display only those records (Note: separate values by commas (,)).", 'brookside-elements')
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Order by", 'brookside-elements'),
					"param_name" => "orderby",
					"value" => array(
					   __('Date', 'brookside-elements')=>'date', 
					   __('Last modified date', 'brookside-elements') => 'modified',
					   __('Popularity', 'brookside-elements')=>'comment_count',
					   __('Title', 'brookside-elements')=>'title',
					   __('Random', 'brookside-elements')=>'rand',
					   __('Preserve post ID order', 'brookside-elements') => 'post__in',
					),
					"description" => __('Select how to sort retrieved posts.', 'brookside-elements'),
					"std" => array('date')
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Sort order", 'brookside-elements'),
					"param_name" => "order",
					"value" => array(
					   __('Descending', 'brookside-elements')=>'DESC', 
					   __('Ascending', 'brookside-elements')=>'ASC'
					),
					"description" => __('Select ascending or descending order.', 'brookside-elements'),
					"std" => array('DESC')
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Thumbnail size", 'brookside-elements'),
					"param_name" => "thumbsize",
					"value" => $imageSizes,
					"description" => __('Select your image size to use.', 'brookside-elements'),
					"std" => array('medium')
				),
			)
		)
	);
	/*vc_map( 
		array(
			"name" => __("Brookside Recent Posts", 'brookside-elements'),
			"base" => "recentposts",
			"icon" => 'brookside-element-icon dashicons dashicons-format-aside',
			"category" => __('Brookside Elements', 'brookside-elements'),
			'description' => __('Show WP posts. Latest, Popular or from specific category, etc.', 'brookside-elements'),
			"params" => array(		
				array(
					"type" => "textfield",            
					"heading" => __("Post count", 'brookside-elements'),
					"param_name" => "num",
					"value" => '3',
					'admin_label' => true,
					"description" => __("Enter number of posts to display (Note: Enter '-1' to display all posts).", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Category slug", 'brookside-elements'),
					"param_name" => "cat_slug",
					"value" => '',
					"description" => __("This help you to retrieve items from specific category. More than one separate by commas.", 'brookside-elements')
				),
				array(
					"type" => "textfield",            
					"heading" => __("Post IDs", 'brookside-elements'),
					"param_name" => "post_ids",
					"value" => '',
					"description" => __("Enter posts IDs to display only those records (Note: separate values by commas (,)).", 'brookside-elements')
				),
				array(
					"type" => "textfield",            
					"heading" => __("Post IDs Exclude", 'brookside-elements'),
					"param_name" => "post__not_in",
					"value" => '',
					"description" => __("Enter posts IDs to exclude those records (Note: separate values by commas (,)).", 'brookside-elements')
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Order by", 'brookside-elements'),
					"param_name" => "orderby",
					"value" => array(
					   __('Date', 'brookside-elements')=>'date', 
					   __('Last modified date', 'brookside-elements') => 'modified',
					   __('Popularity', 'brookside-elements')=>'comment_count',
					   __('Title', 'brookside-elements')=>'title',
					   __('Random', 'brookside-elements')=>'rand',
					   __('Preserve post ID order', 'brookside-elements') => 'post__in',
					),
					"description" => __('Select how to sort retrieved posts.', 'brookside-elements'),
					"std" => array('date')
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Sort order", 'brookside-elements'),
					"param_name" => "order",
					"value" => array(
					   __('Descending', 'brookside-elements')=>'DESC', 
					   __('Ascending', 'brookside-elements')=>'ASC'
					),
					"description" => __('Select ascending or descending order.', 'brookside-elements'),
					"std" => array('DESC')
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Thumbnail size", 'brookside-elements'),
					"param_name" => "thumbsize",
					"value" => $imageSizes,
					"description" => __('Select your image size to use.', 'brookside-elements'),
					"std" => array('medium')
				),
				array(
		            "type" => "dropdown",            
		            "heading" => __("Content size", 'brookside-elements'),
		            "param_name" => "content_size",
		            "value" => array(__('Yes','brookside-elements')=>'true', __('No', 'brookside-elements')=>'false'),
		            "description" => __('Content width less than featured image.', 'brookside-elements'),
		            "std" => array('false')
		        ),
		        array(
		            "type" => "dropdown",            
		            "heading" => __("Show categories?", 'brookside-elements'),
		            "param_name" => "show_categories",
		            "value" => array(__('Yes','brookside-elements')=>'true', __('No', 'brookside-elements')=>'false'),
		            "description" => __('Show categories above the title?', 'brookside-elements'),
		            "std" => array('true')
		        ),
		        array(
		            "type" => "dropdown",            
		            "heading" => __("Show bottom lines?", 'brookside-elements'),
		            "param_name" => "show_lines",
		            "value" => array(__('Yes','brookside-elements')=>'true', __('No', 'brookside-elements')=>'false'),
		            "std" => array('true')
		        ),
		        array(
		            "type" => "dropdown",            
		            "heading" => __("Show date?", 'brookside-elements'),
		            "param_name" => "show_date",
		            "value" => array(__('Yes','brookside-elements')=>'true', __('No', 'brookside-elements')=>'false'),
		            "std" => array('true')
		        ),
		        array(
		            "type" => "dropdown",            
		            "heading" => __("Show read more?", 'brookside-elements'),
		            "param_name" => "show_readmore",
		            "value" => array(__('Yes','brookside-elements')=>'true', __('No', 'brookside-elements')=>'false'),
		            "std" => array('true')
		        ),
		        array(
		            "type" => "dropdown",            
		            "heading" => __("Show sharebox?", 'brookside-elements'),
		            "param_name" => "show_sharebox",
		            "value" => array(__('Yes','brookside-elements') => 'true', __('No', 'brookside-elements')=>'false'),
		            "std" => array('true')
		        ),
				array(
		            "type" => "dropdown",            
		            "heading" => __("Pagination", 'brookside-elements'),
		            "param_name" => "pagination",
		            "value" => array(__('Enable','brookside-elements')=>'true', __('Disable', 'brookside-elements')=>'false'),
		            "description" => __('Enable or Disable pagination for posts.', 'brookside-elements'),
		            "std" => array('false')
		        ),
		        array(
		            "type" => "dropdown",            
		            "heading" => __("Disable featured posts style", 'brookside-elements'),
		            "param_name" => "ignore_featured",
		            "value" => array(__('Yes','brookside-elements')=>'true', __('No', 'brookside-elements')=>'false'),
		            "description" => __('Disable style for featured posts. Do not highlight them.', 'brookside-elements'),
		            "std" => array('true')
		        ),
		        array(
		            "type" => "dropdown",            
		            "heading" => __("Ignore sticky posts", 'brookside-elements'),
		            "param_name" => "ignore_sticky_posts",
		            "value" => array(__('True','brookside-elements')=>'true', __('False', 'brookside-elements')=>'false'),
		            "description" => __('Show sticky posts?', 'brookside-elements'),
		            "std" => array('false')
		        ),
			)
		)
	);*/
	vc_map( 
		array(
			"name" => __("Brookside Single Posts", 'brookside-elements'),
			"base" => "singlepost",
			"icon" => 'brookside-element-icon dashicons dashicons-megaphone',
			"category" => __('Brookside Elements', 'brookside-elements'),
			'description' => __('Show WP post. Just input post ID. You can find post ID in browser address bar while editing post.', 'brookside-elements'),
			"params" => array(		
				array(
					"type" => "textfield",            
					"heading" => __("Post ID", 'brookside-elements'),
					"param_name" => "post_ids",
					"value" => '',
					"description" => __("Enter posts ID to display only those record.", 'brookside-elements')
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Thumbnail size", 'brookside-elements'),
					"param_name" => "thumbsize",
					"value" => $imageSizes,
					"description" => __('Select your image size to use.', 'brookside-elements'),
					"std" => array('post-thumbnail')
				),
				array(
		            "type" => "dropdown",            
		            "heading" => __("Show categories?", 'brookside-elements'),
		            "param_name" => "show_categories",
		            "value" => array(__('Yes','brookside-elements')=>'true', __('No', 'brookside-elements')=>'false'),
		            "description" => __('Show categories above the title?', 'brookside-elements'),
		            "std" => array('true')
		        ),
			)
		)
	);
	/*vc_map( 
		array(
			"name" => __("Brookside Footer", 'brookside-elements'),
			"base" => "brooksidefooter",
			"icon" => 'brookside-element-icon dashicons dashicons-align-center',
			"category" => __('Brookside Elements', 'brookside-elements'),
			'description' => __('Show page footer.', 'brookside-elements'),
			"params" => array(		
				array(
					"type" => "colorpicker",            
					"heading" => __("Custom footer background", 'brookside-elements'),
					"param_name" => "bg_color",
					"value" => ''
				)
			)
		)
	);*/
	vc_map( 
		array(
			"name" => __("Brookside Socials", 'brookside-elements'),
			"base" => "brooksidesocials",
			"icon" => 'brookside-element-icon dashicons dashicons-networking',
			"category" => array(__('Brookside Elements', 'brookside-elements'), __('Brookside Footer', 'brookside-elements'), __('Brookside Header', 'brookside-elements') ),
			'description' => __('Show social icons: facebook, twitter, pinterest, etc.', 'brookside-elements'),
			"params" => array(		
				array(
					"type" => "textfield",            
					"heading" => __("Facebook", 'brookside-elements'),
					"param_name" => "facebook",
					'admin_label' => true,
					"value" => '',
					"description" => __("Enter link to your account (profile).", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Twitter", 'brookside-elements'),
					"param_name" => "twitter",
					'admin_label' => true,
					"value" => '',
					"description" => __("Enter link to your account (profile).", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Pinterest", 'brookside-elements'),
					"param_name" => "pinterest",
					'admin_label' => true,
					"value" => '',
					"description" => __("Enter link to your account (profile).", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Instagram", 'brookside-elements'),
					"param_name" => "instagram",
					'admin_label' => true,
					"value" => '',
					"description" => __("Enter link to your account (profile).", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Tumblr", 'brookside-elements'),
					"param_name" => "tumblr",
					'admin_label' => true,
					"value" => '',
					"description" => __("Enter link to your account (profile).", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Forrst", 'brookside-elements'),
					"param_name" => "forrst",
					'admin_label' => true,
					"value" => '',
					"description" => __("Enter link to your account (profile).", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Flickr", 'brookside-elements'),
					"param_name" => "flickr",
					'admin_label' => true,
					"value" => '',
					"description" => __("Enter link to your account (profile).", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Dribbble", 'brookside-elements'),
					"param_name" => "dribbble",
					'admin_label' => true,
					"value" => '',
					"description" => __("Enter link to your account (profile).", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Skype", 'brookside-elements'),
					"param_name" => "skype",
					'admin_label' => true,
					"value" => '',
					"description" => __("Enter link to your account (profile).", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Digg", 'brookside-elements'),
					"param_name" => "digg",
					'admin_label' => true,
					"value" => '',
					"description" => __("Enter link to your account (profile).", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Google plus", 'brookside-elements'),
					"param_name" => "google_plus",
					'admin_label' => true,
					"value" => '',
					"description" => __("Enter link to your account (profile).", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Linkedin", 'brookside-elements'),
					"param_name" => "linkedin",
					'admin_label' => true,
					"value" => '',
					"description" => __("Enter link to your account (profile).", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Vimeo", 'brookside-elements'),
					"param_name" => "vimeo",
					'admin_label' => true,
					"value" => '',
					"description" => __("Enter link to your account (profile).", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Yahoo", 'brookside-elements'),
					"param_name" => "yahoo",
					'admin_label' => true,
					"value" => '',
					"description" => __("Enter link to your account (profile).", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Youtube", 'brookside-elements'),
					"param_name" => "youtube",
					'admin_label' => true,
					"value" => '',
					"description" => __("Enter link to your account (profile).", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Picasa", 'brookside-elements'),
					"param_name" => "picasa",
					'admin_label' => true,
					"value" => '',
					"description" => __("Enter link to your account (profile).", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Deviantart", 'brookside-elements'),
					"param_name" => "deviantart",
					'admin_label' => true,
					"value" => '',
					"description" => __("Enter link to your account (profile).", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Behance", 'brookside-elements'),
					"param_name" => "behance",
					'admin_label' => true,
					"value" => '',
					"description" => __("Enter link to your account (profile).", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("PayPal", 'brookside-elements'),
					"param_name" => "Paypal",
					'admin_label' => true,
					"value" => '',
					"description" => __("Enter link to your account (profile).", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Delicious", 'brookside-elements'),
					"param_name" => "delicious",
					'admin_label' => true,
					"value" => '',
					"description" => __("Enter link to your account (profile).", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Rss", 'brookside-elements'),
					"param_name" => "rss",
					'admin_label' => true,
					"value" => '',
					"description" => __("Enter link to rss.", 'brookside-elements')            
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Icons style", 'brookside-elements'),
					"param_name" => "style",
					"value" => array(
					   __('Simple', 'brookside-elements')=>'simple',
					   __('Big Icon+Text', 'brookside-elements')=>'big_icon_text'
					),
					"std" => array('simple')
				),
				array(
					"type" => "colorpicker",            
					"heading" => __("Circle background color", 'brookside-elements'),
					"param_name" => "bg_color",
					"value" => '',
					"description" => __("Leave empty to use default color.", 'brookside-elements'),
					"dependency" => array(
				        "element" => "style",
				        "value" => "big_icon_text"
				    )        
				),	
				array(
					"type" => "colorpicker",            
					"heading" => __("Icon color initial", 'brookside-elements'),
					"param_name" => "icon_color",
					"value" => '',
					"description" => __("Leave empty to use default color.", 'brookside-elements'),       
				),
				array(
					"type" => "colorpicker",            
					"heading" => __("Icon color hover", 'brookside-elements'),
					"param_name" => "icon_color_hover",
					"value" => '',
					"description" => __("Leave empty to use default color.", 'brookside-elements'),       
				),
				array(
					"type" => "colorpicker",            
					"heading" => __("Circle text color", 'brookside-elements'),
					"param_name" => "text_color",
					"value" => '',
					"description" => __("Leave empty to use default color.", 'brookside-elements'),
					"dependency" => array(
				        "element" => "style",
				        "value" => "big_icon_text"
				    )        
				),
				array(
					"type" => "hidden_id",            
					"heading" => '',
					"param_name" => "id",
					"value" => $suf,
					"description" => ''            
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Icons align", 'brookside-elements'),
					"param_name" => "icons_align",
					"value" => array(
					   __('Center', 'brookside-elements') => 'textcenter',
					   __('Right', 'brookside-elements') => 'textright',
					   __('Left', 'brookside-elements') => 'textleft',
					),
					"std" => array('textcenter')
				),
			)
		)
	);
	vc_map( 
		array(
			"name" => __("Brookside User Info", 'brookside-elements'),
			"base" => "brooksideuser",
			"icon" => 'brookside-element-icon dashicons dashicons-admin-users',
			"category" => __('Brookside Elements', 'brookside-elements'),
			'description' => __('Show user information.', 'brookside-elements'),
			"params" => array(		
				array(
					"type" => "textfield",            
					"heading" => __("Username", 'brookside-elements'),
					"param_name" => "username",
					"value" => '',
					'admin_label' => true,
					"description" => __("Enter username parameter to display information.", 'brookside-elements')            
				),
			)
		)
	);
	/*$menus_list = array();
	$menus_list['none'] = __('None', 'brookside-elements');
	$menus = get_terms('nav_menu');
	if( !empty($menus) ){
		foreach($menus as $menu){
		  $menus_list[$menu->term_id] = $menu->name;
		}
	}
	vc_map( 
		array(
			"name" => __("Brookside Menu", 'brookside-elements'),
			"base" => "brooksidemenu",
			"icon" => 'brookside-element-icon dashicons dashicons-menu',
			"category" => array( __('Brookside Header', 'brookside-elements'), __('Brookside Footer', 'brookside-elements') ), 
			'description' => __('Show your header menu.', 'brookside-elements'),
			"params" => array(
				array(
					"type" => "dropdown",            
					"heading" => __("Select your menu", 'brookside-elements'),
					"param_name" => "menu_id",
					"value" => $menus_list,
					"std" => array('none'),
					"description" => __("You need to create your menu under appearances->menus.", 'brookside-elements')            
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Menu place", 'brookside-elements'),
					"param_name" => "menu_place",
					"value" => array(
					   __('Header', 'brookside-elements') => 'header',
					   __('Footer', 'brookside-elements') => 'footer',
					),
					"std" => array('header'),
					"description" => __("Select place where do you want to insert menu.", 'brookside-elements')            
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Use default theme font", 'brookside-elements'),
					"param_name" => "default_font",
					"value" => array(
					   __('Yes', 'brookside-elements') => 'true',
					   __('No', 'brookside-elements') => 'false',
					),
					"std" => array('true'),
					"description" => __("Leave blank to use your default menu font.", 'brookside-elements')            
				),
				array(
					'type' => 'google_fonts',
					'param_name' => 'menu_font',
					'value' => '',
					'settings' => array(
						'fields' => array(
							'font_family' => 'Montserrat:regular,italic',
							'font_family_description' => __( 'Select font family.', 'brookside-elements' ),
							'font_style_description' => __( 'Select font styling.', 'brookside-elements' ),
						),
					),
					"dependency" => array(
				        "element" => "default_font",
				        "value" => "false"
				    )
				),
				array(
					"type" => "textfield",            
					"heading" => __("Menu font size", 'brookside-elements'),
					"param_name" => "menu_font_size",
					"value" => '12',
					"description" => __("Enter value in px. Do not set (px).", 'brookside-elements'),
					"dependency" => array(
				        "element" => "default_font",
				        "value" => 'false'
				    )            
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Menu text transform", 'brookside-elements'),
					"param_name" => "menu_text_transform",
					"value" => $text_transform,
					"description" => __("Select text transform.", 'brookside-elements'),
					"std" => array('uppercase')           
				),
				array(
					"type" => "colorpicker",            
					"heading" => __("Menu item color (initial)", 'brookside-elements'),
					"param_name" => "menu_items_color_initial",
					"value" => '',            
				),
				array(
					"type" => "colorpicker",            
					"heading" => __("Menu item color (hover)", 'brookside-elements'),
					"param_name" => "menu_items_color_hover",
					"value" => '',           
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Menu position", 'brookside-elements'),
					"param_name" => "menu_position",
					"value" => array(
					   __('Right', 'brookside-elements') => 'flex-end',
					   __('Center', 'brookside-elements') => 'center',
					   __('Left', 'brookside-elements') => 'flex-start',
					),
					"std" => array('flex-end'),           
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Enable search icon?", 'brookside-elements'),
					"param_name" => "enable_search",
					"value" => array(
					   __('Yes', 'brookside-elements') => 'true',
					   __('No', 'brookside-elements') => 'false',
					),
					"std" => array('true'),
					"description" => __("Enable search icon to show at the end of the menu.", 'brookside-elements') ,
					"dependency" => array(
				        "element" => "menu_place",
				        "value" => "header"
				    )           
				),
				array(
					"type" => "hidden_id",            
					"heading" => '',
					"param_name" => "id",
					"value" => $suf,
					"description" => ''            
				),
			)
		)
	);
	vc_map( 
		array(
			"name" => __("Brookside Logo", 'brookside-elements'),
			"base" => "brooksidelogo",
			"icon" => 'brookside-element-icon dashicons dashicons-admin-home',
			"category" => array(__('Brookside Footer', 'brookside-elements'), __('Brookside Header', 'brookside-elements')),
			'description' => __('Show your site logo.', 'brookside-elements'),
			"params" => array(
				array(
					"type" => "textfield",            
					"heading" => __("Text logo", 'brookside-elements'),
					"param_name" => "text_logo",
					"value" => '',
					"description" => __("Leave blank to use your default logo.", 'brookside-elements')            
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Use default theme settings", 'brookside-elements'),
					"param_name" => "default_font",
					"value" => array(
					   __('Yes', 'brookside-elements') => 'true',
					   __('No', 'brookside-elements') => 'false',
					),
					"std" => array('true'),
					"description" => __("Leave blank to use your default logo font.", 'brookside-elements')            
				),
				array(
					'type' => 'google_fonts',
					'param_name' => 'logo_font',
					'value' => '',
					'settings' => array(
						'fields' => array(
							'font_family' => 'Nothing You Could Do:regular',
							'font_family_description' => __( 'Select font family.', 'brookside-elements' ),
							'font_style_description' => __( 'Select font styling.', 'brookside-elements' ),
						),
					),
					"dependency" => array(
				        "element" => "default_font",
				        "value" => "false"
				    )
				),
				array(
					"type" => "textfield",            
					"heading" => __("Logo font size", 'brookside-elements'),
					"param_name" => "logo_font_size",
					"value" => '',
					"description" => __("Enter value in px. Do not set (px).", 'brookside-elements'),
					"dependency" => array(
				        "element" => "default_font",
				        "value" => 'false'
				    )            
				),		
				array(
					"type" => "attach_image",            
					"heading" => __("Image logo", 'brookside-elements'),
					"param_name" => "custom_logo",
					"value" => '',
					"description" => __("Leave blank to use your default logo.", 'brookside-elements')          
				),
				array(
					"type" => "textfield",            
					"heading" => __("Logo image width", 'brookside-elements'),
					"param_name" => "logo_width",
					"value" => '',
					"description" => __("Enter value, you can use px, %, em, etc. ", 'brookside-elements'),           
				),
				array(
					"type" => "hidden_id",            
					"heading" => '',
					"param_name" => "id",
					"value" => $suf,
					"description" => ''            
				),
			)
		)
	);*/
	vc_map( 
		array(
			"name" => __("Brookside Instagram", 'brookside-elements'),
			"base" => "brooksideinstagram",
			"icon" => 'brookside-element-icon dashicons dashicons-format-image',
			"category" => array( __('Brookside Elements', 'brookside-elements'), __('Brookside Footer', 'brookside-elements') ),
			'description' => __('Show your instagram feeds.', 'brookside-elements'),
			"params" => array(		
				array(
					"type" => "textfield",            
					"heading" => __("Title", 'brookside-elements'),
					"param_name" => "title",
					"value" => '',
					'admin_label' => true,
					"description" => __("Enter instagram block title.", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Access token", 'brookside-elements'),
					"param_name" => "access_token",
					"value" => get_theme_mod('brookside_footer_instagram_access_token', ''),
					'admin_label' => true,
					"description" => '<a target="_blank" href="https://instagram.com/oauth/authorize/?client_id=1677ed07ddd54db0a70f14f9b1435579&redirect_uri=http://instagram.pixelunion.net&response_type=token">'.esc_html__('Get your Access Token','brookside-elements').'</a>',            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Items count", 'brookside-elements'),
					"param_name" => "pics",
					"value" => '4',
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Items per row", 'brookside-elements'),
					"param_name" => "pics_per_row",
					"value" => array(
					   __('One per row', 'brookside-elements')=>'1',
					   __('Two row', 'brookside-elements')=>'2',
					   __('Three per row', 'brookside-elements')=>'3',
					   __('Four per row', 'brookside-elements') => '4',
					   __('Six per row', 'brookside-elements')=>'6',
					),
					"description" => __('Select items count per row', 'brookside-elements'),
					"std" => array('4')
				),
				array(
		            "type" => "dropdown",            
		            "heading" => __("Follow link", 'brookside-elements'),
		            "param_name" => "hide_link",
		            "value" => array(__('Hide','brookside-elements')=>'true', __('Show', 'brookside-elements')=>'false'),
		            "description" => __('Show or hide follow link', 'brookside-elements'),
		            "std" => array('true')
		        ),

			)
		)
	);
	$options = array();
	$options['Uncategorised'] = 'uncategorised';
    $query1 = get_terms( 'category', array('hide_empty' => false));
    if( $query1 ){
        foreach ( $query1 as $post ) {
            $options[ $post->name ] = $post->slug;
        }
    }
	vc_map( 
		array(
			"name" => __("Brookside Category", 'brookside-elements'),
			"base" => "brooksidecategory",
			"icon" => 'brookside-element-icon dashicons dashicons-category',
			"category" => __('Brookside Elements', 'brookside-elements'),
			'description' => __('Show special block with link to category.', 'brookside-elements'),
			"params" => array(
				array(
		            "type" => "dropdown",            
		            "heading" => __("Category", 'brookside-elements'),
		            "param_name" => "category",
		            "value" => $options,
		            "description" => __('Select category to show.', 'brookside-elements'),
		            'admin_label' => true,
		        ),	
		        array(
					"type" => "hidden_id",            
					"heading" => '',
					"param_name" => "id",
					"value" => $suf,
					"description" => ''            
				),	
				array(
					"type" => "textfield",            
					"heading" => __("Button label", 'brookside-elements'),
					"param_name" => "button_label",
					"value" => '',
					"description" => __("Enter button label, if empty label is equal to category name.", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Button url", 'brookside-elements'),
					"param_name" => "button_url",
					"value" => '',
					"description" => __("Enter button url, if empty url is equal to category url.", 'brookside-elements')            
				),
				array(
					"type" => "attach_image",            
					"heading" => __("Category image", 'brookside-elements'),
					"param_name" => "bg_image_id",
					"value" => '',
					"description" => __("Select image for category block", 'brookside-elements')          
				),
				array(
					"type" => "colorpicker",            
					"heading" => __("Button Border color", 'brookside-elements'),
					"param_name" => "category_button_border_color",
					"value" => '',
					"description" => __("Leave empty to use default style.", 'brookside-elements')          
				),
				array(
					"type" => "colorpicker",            
					"heading" => __("Button background color", 'brookside-elements'),
					"param_name" => "category_button_bg_color",
					"value" => '',
					"description" => __("Leave empty to use default style.", 'brookside-elements')          
				),
				array(
					"type" => "colorpicker",            
					"heading" => __("Button text color", 'brookside-elements'),
					"param_name" => "category_button_text_color",
					"value" => '',
					"description" => __("Leave empty to use default style.", 'brookside-elements')          
				)
			)
		)
	);
	/*vc_map( 
		array(
			"name" => __("Brookside Google Map", 'brookside-elements'),
			"base" => "brooksidegooglemap",
			"icon" => 'brookside-element-icon dashicons dashicons-location',
			"category" => __('Brookside Elements', 'brookside-elements'),
			'description' => __('Display styled google map', 'brookside-elements'),
			"params" => array(
				array(
					"type" => "textfield",            
					"heading" => __("Location", 'brookside-elements'),
					"param_name" => "address",
					"value" => 'Ontario, CA, USA',
					"description" => __("Enter your location.", 'brookside-elements'),
					'admin_label' => true,            
				),
				array(
		            "type" => "dropdown",            
		            "heading" => __("Style", 'brookside-elements'),
		            "param_name" => "style",
		            "value" => array(
		            	esc_html__('Blue water','brookside-elements') => 'style1',
		            	esc_html__('Simple grayscale','brookside-elements') => 'style2',
		            	esc_html__('Light monochrome','brookside-elements') => 'style3'
		            ),
		            "description" => __('Select google map style.', 'brookside-elements'),
		            'admin_label' => true,
		        ),		
				array(
					"type" => "attach_image",            
					"heading" => __("Map marker", 'brookside-elements'),
					"param_name" => "marker_icon",
					"value" => '',
					"description" => __("Select image for your map location icon. Leave blank to use default marker.", 'brookside-elements')          
				),
			)
		)
	);
	vc_map( 
		array(
			"name" => __("Brookside Page Title", 'brookside-elements'),
			"base" => "brooksidepagetitle",
			"icon" => 'brookside-element-icon dashicons dashicons-editor-textcolor',
			"category" => __('Brookside Elements', 'brookside-elements'),
			'description' => __('Display custom page title', 'brookside-elements'),
			"params" => array(
				array(
					"type" => "textfield",            
					"heading" => __("Title custom text", 'brookside-elements'),
					"param_name" => "title_text",
					"value" => '',
					"description" => __("Enter your page title text. Leave blank to use default page title text.", 'brookside-elements'),
					'admin_label' => true,            
				)
			)
		)
	);
	/*
	vc_map( 
		array(
			"name" => __("Brookside Hero Section", 'brookside-elements'),
			"base" => "brooksideherosection",
			"icon" => 'brookside-element-icon dashicons dashicons-welcome-view-site',
			"category" => __('Brookside Elements', 'brookside-elements'),
			'description' => __('Display section with image, title, and link divided into two columns.', 'brookside-elements'),
			"params" => array(
				array(
					"type" => "attach_image",            
					"heading" => __("First column image", 'brookside-elements'),
					"param_name" => "image_column",
					"value" => '',
					"description" => __("Select image for your left column in section.", 'brookside-elements')          
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Image size", 'brookside-elements'),
					"param_name" => "thumbsize",
					"value" => $imageSizes,
					"description" => __('Select your image size to use in column.', 'brookside-elements'),
					"std" => array('full')
				),
				array(
					"type" => "colorpicker",            
					"heading" => __("Second column background color", 'brookside-elements'),
					"param_name" => "column_bg_color",
					"value" => '',
					"description" => __("Leave empty to use default style.", 'brookside-elements')          
				),
				array(
					"type" => "textfield",            
					"heading" => __("Section height", 'brookside-elements'),
					"param_name" => "section_height",
					"value" => '',
					"description" => __("Enter your section height", 'brookside-elements'),           
				),
				array(
					"type" => "textarea",            
					"heading" => __("Text", 'brookside-elements'),
					"param_name" => "title",
					"value" => '',
					"description" => __("Enter your section title text.", 'brookside-elements'),
					'admin_label' => true,            
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Text font family", 'brookside-elements'),
					"param_name" => "default_font",
					"value" => array(
					   __('Default', 'brookside-elements') => 'true',
					   __('Google font', 'brookside-elements') => 'false',
					),
					"std" => array('true'),
					"description" => __("Leave blank to use your default title font family.", 'brookside-elements')            
				),
				array(
					'type' => 'google_fonts',
					'param_name' => 'title_font_family',
					'value' => '',
					'settings' => array(
						'fields' => array(
							'font_family' => 'Montserrat:regular,italic',
							'font_family_description' => __( 'Select font family.', 'brookside-elements' ),
							'font_style_description' => __( 'Select font styling.', 'brookside-elements' ),
						),
					),
					"dependency" => array(
				        "element" => "default_font",
				        "value" => "false"
				    )
				),
				array(
					"type" => "colorpicker",            
					"heading" => __("Text color", 'brookside-elements'),
					"param_name" => "title_color",
					"value" => '',
					"description" => __("Leave empty to use default color.", 'brookside-elements')          
				),
				array(
					"type" => "textfield",            
					"heading" => __("Text font size", 'brookside-elements'),
					"param_name" => "title_font_size",
					"value" => '68',
					"description" => __("Enter value in px. Do not set (px).", 'brookside-elements'),
					"dependency" => array(
				        "element" => "default_font",
				        "value" => 'false'
				    )            
				),
				array(
		            'type' => 'iconpicker',
		            'heading' => __( 'Icon', 'brookside-elements' ),
		            'param_name' => 'icon',
		            'value' => 'fa fa-bookmark', // default value to backend editor admin_label
		            'settings' => array(
		               'emptyIcon' => false,
		               // default true, display an "EMPTY" icon?
		               'iconsPerPage' => 4000,
		               // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
		            ),
		            'description' => __( 'Select icon from library.', 'brookside-elements' ),
		        ),
				array(
					"type" => "colorpicker",            
					"heading" => __("Icon color", 'brookside-elements'),
					"param_name" => "icon_color",
					"value" => '',
					"description" => __("Leave empty to use default color.", 'brookside-elements')          
				),
				array(
					"type" => "textfield",            
					"heading" => __("Link text", 'brookside-elements'),
					"param_name" => "link_text",
					"value" => '',
					"description" => __("Enter your link text.", 'brookside-elements'),            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Link url", 'brookside-elements'),
					"param_name" => "link_url",
					"value" => '',
					"description" => __("Enter your link URL. You can add anchor to another section to have scroll to it.", 'brookside-elements'),            
				),
				array(
					"type" => "colorpicker",            
					"heading" => __("Link color", 'brookside-elements'),
					"param_name" => "link_color",
					"value" => '',
					"description" => __("Leave empty to use default color.", 'brookside-elements')          
				),
				array(
					"type" => "hidden_id",            
					"heading" => '',
					"param_name" => "id",
					"value" => $suf,
					"description" => ''            
				),
			)
		)
	);
	vc_map( 
		array(
			"name" => __("Brookside Aboutme Section", 'brookside-elements'),
			"base" => "brooksideaboutmesection",
			"icon" => 'brookside-element-icon dashicons dashicons-admin-users',
			"category" => __('Brookside Elements', 'brookside-elements'),
			'description' => __('Display about me section with your image, name, and description.', 'brookside-elements'),
			"params" => array(
				array(
					"type" => "attach_image",            
					"heading" => __("Image", 'brookside-elements'),
					"param_name" => "image",
					"value" => '',
					"description" => __("Select image for your section.", 'brookside-elements')          
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Image size", 'brookside-elements'),
					"param_name" => "thumbsize",
					"value" => $imageSizes,
					"description" => __('Select your image size to use in column.', 'brookside-elements'),
					"std" => array('full')
				),
				array(
					"type" => "colorpicker",            
					"heading" => __("Section background color", 'brookside-elements'),
					"param_name" => "section_bg_color",
					"value" => '',
					"description" => __("Leave empty to use default style.", 'brookside-elements')          
				),
				array(
					"type" => "textfield",            
					"heading" => __("Title", 'brookside-elements'),
					"param_name" => "title",
					"value" => '',
					"description" => __("Enter your section title text.", 'brookside-elements'),
					'admin_label' => true,            
				),
				array(
					"type" => "dropdown",            
					"heading" => __("Title font family", 'brookside-elements'),
					"param_name" => "default_font",
					"value" => array(
					   __('Default', 'brookside-elements') => 'true',
					   __('Google font', 'brookside-elements') => 'false',
					),
					"std" => array('true'),
					"description" => __("Leave blank to use your default title font family.", 'brookside-elements')            
				),
				array(
					"type" => "textfield",            
					"heading" => __("Title font size", 'brookside-elements'),
					"param_name" => "title_font_size",
					"value" => '36',
					"description" => __("Enter value in px. Do not set (px).", 'brookside-elements'),
					"dependency" => array(
				        "element" => "default_font",
				        "value" => 'false'
				    )            
				),
				array(
					'type' => 'google_fonts',
					'param_name' => 'title_font_family',
					'value' => '',
					'settings' => array(
						'fields' => array(
							'font_family' => 'Montserrat:regular,italic',
							'font_family_description' => __( 'Select font family.', 'brookside-elements' ),
							'font_style_description' => __( 'Select font styling.', 'brookside-elements' ),
						),
					),
					"dependency" => array(
				        "element" => "default_font",
				        "value" => "false"
				    )
				),
				array(
					"type" => "textarea",            
					"heading" => __("Text", 'brookside-elements'),
					"param_name" => "text",
					"value" => '',
					"description" => __("Enter your section text.", 'brookside-elements'),
					'admin_label' => true,            
				),
				array(
					"type" => "colorpicker",            
					"heading" => __("Section text color", 'brookside-elements'),
					"param_name" => "text_color",
					"value" => '',
					"description" => __("Leave empty to use default color.", 'brookside-elements')          
				),
				array(
					"type" => "attach_image",            
					"heading" => __("Signature image", 'brookside-elements'),
					"param_name" => "signature_image",
					"value" => '',
					"description" => __("Select/upload your signature image.", 'brookside-elements'),            
				),
				array(
					"type" => "hidden_id",            
					"heading" => '',
					"param_name" => "id",
					"value" => $suf,
					"description" => ''            
				),
			)
		)
	);*/
}
?>