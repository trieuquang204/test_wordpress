<?php

/* ----------------------------------------------------- 
 * Post Slides Metabox
 * ----------------------------------------------------- */
add_filter( 'rwmb_meta_boxes', 'brookside_register_meta_boxes' );
function brookside_register_meta_boxes($meta_boxes) {
    $prefix = 'brookside_';

	/* ----------------------------------------------------- */
	// Post Slides Metabox
	/* ----------------------------------------------------- */
	$meta_boxes[] = array(
		'id'		=> 'post_layout',
		'title'		=> esc_html__('Single Post Layout','brookside-elements'),
		'pages'		=> array( 'post' ),
		'context' => 'normal',
		'fields'	=> array(
			array(
	    	   'name' => esc_html__('Single post layout', 'brookside-elements'),
	    	   'desc' => esc_html__('Select layout type.', 'brookside-elements'),
	    	   'id' => $prefix . 'post_layout',
	    	   'type' => 'select',
	    	   'options'  => array(
	    	   		'default' => esc_html__('Default', 'brookside-elements'),
	    	   		'standard' => esc_html__('Standard', 'brookside-elements'),
	    	   		'wide' => esc_html__('Wide', 'brookside-elements'),
	    	   		'fullwidth' => esc_html__('Fullwidth', 'brookside-elements'),
	    	   		'fullwidth-alt' => esc_html__('Fullscreen', 'brookside-elements'),
	    	   		'sideimage' => esc_html__('Side', 'brookside-elements')
	    	   	),
			   'std' => array('default')
	    	),
	    	array(
			    'name' => esc_html__('Post sidebar', 'brookside-elements'),
			    'desc' => esc_html__('Select sidebar position.', 'brookside-elements'),
			    'id'   => $prefix . 'post_sidebar',
			    'type' => 'select',
			    'options' => array(
			    	'default' => esc_html__('Default', 'brookside-elements'),
			    	'sidebar-right' => esc_html__('Sidebar right', 'brookside-elements'),
			    	'sidebar-left' => esc_html__('Sidebar left', 'brookside-elements'),
			    	'none' => esc_html__('No sidebar', 'brookside-elements'),
			    ),
			    'std'  => array('default'),
			),
			array(
	    	   'name' => esc_html__('Featured post', 'brookside-elements'),
	    	   'desc' => esc_html__('Check this if you need to highlight post for posts list view.', 'brookside-elements'),
	    	   'id' => $prefix . 'post_featured',
	    	   'type' => 'checkbox',
			   'std' => 0
	    	),
	    	array(
			    'id' => $prefix . 'display_post_title',
			    'name'      => esc_html__('Post title display', 'brookside-elements'),
			    'type' => 'select',
			    'options' => array(
			   		'default' => esc_html__('Default', 'brookside-elements'),
			    	'above' => esc_html__('Above featured image/gallery', 'brookside-elements'),
			    	'under' => esc_html__('Under featured image/gallery', 'brookside-elements'),
			    	'disable' => esc_html__('Disable title', 'brookside-elements')
			    ),
			    'std'  => array('default'),
			),
	    	array(
			    'name' => esc_html__('Post format on preview', 'brookside-elements'),
			    'desc' => esc_html__('Select what you need to display on preview, featured image or post format (video, gallery, audio, etc.)', 'brookside-elements'),
			    'id'   => $prefix . 'display_featured_img_instead',
			    'type' => 'select',
			    'options' => array(
			    	'true' => esc_html__('Default', 'brookside-elements'),
			    	'default' => esc_html__('Show post format', 'brookside-elements'),
			    	'false' => esc_html__('Show featured image', 'brookside-elements')
			    ),
			    'std'  => array('true'),
			),
	    	array(
	    	   'name' => esc_html__('Sticky sharebox', 'brookside-elements'),
	    	   'desc' => esc_html__('Check to enable vertical sticky sharebox.', 'brookside-elements'),
	    	   'id' => $prefix . 'post_sticky_sharebox',
	    	   'type' => 'checkbox',
			   'std' => 0
	    	),
		)
	);
	$meta_boxes[] = array(
		'id'		=> 'post_standard',
		'title'		=> esc_html__('Post Embed','brookside-elements'),
		'pages'		=> array( 'post' ),
		'context' => 'normal',
		'fields'	=> array(
			array(
				'name'	=> esc_html__('Embed Url','brookside-elements'),
				'desc'	=> esc_html__('This area used for the media content. If you need to show some media embeds for "Standard" post format instead featured image, use this field. It supports ', 'brookside-elements').'<a href="https://codex.wordpress.org/Embeds"> '.esc_html__('many media websites','brookside-elements').'</a>',
				'id'	=> $prefix . 'post_format_embed',
				'type'	=> 'oembed',
			),
			array(
	    	   'name' => esc_html__('Display on single post?', 'brookside-elements'),
	    	   'desc' => esc_html__('Check this if you need to display embed media on single post view. Featured image will be disabled.', 'brookside-elements'),
	    	   'id' => $prefix . 'post_format_embed_replace',
	    	   'type' => 'checkbox',
			   'std' => 0
	    	),
		)
	);
	$meta_boxes[] = array(
		'id'		=> 'post_slides',
		'title'		=> esc_html__('Post Gallery','brookside-elements'),
		'pages'		=> array( 'post' ),
		'context' => 'normal',
		'fields'	=> array(
			array(
				'name'	=> esc_html__('Post Gallery Images','brookside-elements'),
				'desc'	=> esc_html__('Upload up to 30 project images for a slideshow - or only one to display a single image.','brookside-elements'),
				'id'	=> $prefix . 'gallery_images',
				'type'	=> 'image_advanced',
				'max_file_uploads' => 30
			),
			array(
	    	   'name' => esc_html__('Gallery layout', 'brookside-elements'),
	    	   'desc' => esc_html__('Select gallery layout type.', 'brookside-elements'),
	    	   'id' => $prefix . 'gallery_post_layout',
	    	   'type' => 'select',
	    	   'options' => array(
			    	'slideshow' => esc_html__('Slideshow', 'brookside-elements'),
			    	'gallery_block' => esc_html__('Gallery', 'brookside-elements'),
			    	'collage' => esc_html__('Gallery collage', 'brookside-elements')
			    ),
			    'std'  => array('slideshow'),
	    	),
	    	array(
	    	   'name' => esc_html__('Auto slideshow', 'brookside-elements'),
	    	   'desc' => esc_html__('Check this if you need to have slideshow in your gallery.', 'brookside-elements'),
	    	   'id' => $prefix . 'gallery_autoplay',
	    	   'type' => 'checkbox',
			   'std' => 0
	    	),
	    	array(
	    	   'name' => esc_html__('Auto height', 'brookside-elements'),
	    	   'desc' => esc_html__('Check this if you need to resize slider height regarding to image size.', 'brookside-elements'),
	    	   'id' => $prefix . 'gallery_autoheight',
	    	   'type' => 'checkbox',
			   'std' => 0
	    	),
	    	array(
	    	   'name' => esc_html__('Loop items', 'brookside-elements'),
	    	   'desc' => esc_html__('Check this if you need to have loop in your gallery.', 'brookside-elements'),
	    	   'id' => $prefix . 'gallery_loop',
	    	   'type' => 'checkbox',
			   'std' => 0
	    	),

		)
	);
	$meta_boxes[] = array(
		'id'		=> 'post_video',
		'title'		=> esc_html__('Post Video','brookside-elements'),
		'pages'		=> array( 'post' ),
		'context' => 'normal',
		'fields'	=> array(
			array(
				'name'	=> esc_html__('Video URL','brookside-elements'),
				'desc'	=> esc_html__('This area used for video post format. This field offers live preview the media content. It supports self-hosted video and video from ', 'brookside-elements').'<a href="https://codex.wordpress.org/Embeds"> '.esc_html__('many media websites','brookside-elements').'</a>',
				'id'	=> $prefix . 'post_format_video',
				'type'	=> 'oembed',
			),
		)
	);
	$meta_boxes[] = array(
		'id'		=> 'post_audio',
		'title'		=> esc_html__('Post audio','brookside-elements'),
		'pages'		=> array( 'post' ),
		'context' => 'normal',
		'fields'	=> array(
			array(
				'name'	=> esc_html__('Audio','brookside-elements'),
				'desc'	=> esc_html__('This area used for audio post format. You can use self-hosted audio (mp3, m4a, ogg, wav, wma) or from link to soundcloud, mixcloud, reverbnation, spotify item.','brookside-elements'),
				'id'	=> $prefix . 'post_format_audio',
				'type'	=> 'text',
			)

		)
	);
	$meta_boxes[] = array(
		'id'		=> 'post_quote',
		'title'		=> esc_html__('Post Quote','brookside-elements'),
		'pages'		=> array( 'post' ),
		'context' => 'normal',
		'fields'	=> array(
			array(
				'name'	=> esc_html__('Quote text','brookside-elements'),
				'id'	=> $prefix . 'post_format_quote_text',
				'type'	=> 'textarea',
			),
			array(
				'name'	=> esc_html__('Quote author','brookside-elements'),
				'id'	=> $prefix . 'post_format_quote_cite',
				'type'	=> 'text',
			),
			array(
				'name'	=> esc_html__('Background color','brookside-elements'),
				'desc'	=> esc_html__('Leave empty to use default theme colors.','brookside-elements'),
				'id'	=> $prefix . 'post_format_quote_bg_color',
				'type'	=> 'color',
			),
			array(
				'name'	=> esc_html__('Quote text color','brookside-elements'),
				'desc'	=> esc_html__('Leave empty to use default theme colors.','brookside-elements'),
				'id'	=> $prefix . 'post_format_quote_text_color',
				'type'	=> 'color',
			),
		)
	);
	$meta_boxes[] = array(
		'id'		=> 'post_link',
		'title'		=> esc_html__('Post link','brookside-elements'),
		'pages'		=> array( 'post' ),
		'context' => 'normal',
		'fields'	=> array(
			array(
				'name'	=> esc_html__('Link','brookside-elements'),
				'desc'	=> esc_html__('This area used for link post format. If you need extarnal link, please input.','brookside-elements'),
				'id'	=> $prefix . 'post_format_link',
				'type'	=> 'text',
			),
			array(
				'name'	=> esc_html__('Title','brookside-elements'),
				'desc'	=> esc_html__('Input title for your external link.','brookside-elements'),
				'id'	=> $prefix . 'post_format_link_title',
				'type'	=> 'text',
			),
		)
	);

	global $wp_registered_sidebars;
	$sidebars = array();
	$sidebars['none'] = esc_html__('None', 'brookside-elements');
	if(!empty($wp_registered_sidebars)){
		foreach ($wp_registered_sidebars as $sidebar ) {
			$sidebars[$sidebar['id']]=$sidebar['name'];
		}
	}
	unset($sidebars['wpmm']);
	$meta_boxes[] = array(
		'id'		=> 'header_style',
		'title'		=> esc_html__('Page settings','brookside-elements'),
		'pages'		=> array( 'page', 'post' ),
		'context' => 'normal',
		'fields'	=> array(
			array(
	    	   'name' => esc_html__('Header layout', 'brookside-elements'),
	    	   'desc' => esc_html__('Select header layout. Default is layout from theme options.', 'brookside-elements'),
	    	   'id' => $prefix . 'header_variant',
	    	   'type' => 'select',
			    'options' => array(
			    	'default' => esc_html__('Default', 'brookside-elements'),
			    	'header-version1' => esc_html__('Simple header', 'brookside-elements'),
			    	'header-version2' => esc_html__('Side header', 'brookside-elements'),
			    	'header-version4' => esc_html__('Horizontal header', 'brookside-elements'),
			    	'header-version5' => esc_html__('Header center logo', 'brookside-elements'),
			    	'header-version6' => esc_html__('Header with hidden menu', 'brookside-elements'),
			    	'header-version7' => esc_html__('Header menu top', 'brookside-elements'),
			    ),
			    'std'  => array('default'),
	    	),
	    	array(
	    	   'name' => esc_html__('Header style', 'brookside-elements'),
	    	   'desc' => esc_html__('Select header style. Default is style from theme options.', 'brookside-elements'),
	    	   'id' => $prefix . 'header_color_style',
	    	   'type' => 'select',
			    'options' => array(
			    	'default' => esc_html__('Default', 'brookside-elements'),
			    	'header-light' => esc_html__('Header light', 'brookside-elements'),
			    	'header-dark' => esc_html__('Header dark', 'brookside-elements'),
			    	'header-light header-transparent' => esc_html__('Header light transparent', 'brookside-elements'),
			    	'header-dark header-transparent' => esc_html__('Header dark transparent', 'brookside-elements')
			    ),
			    'std'  => array('default'),
	    	),
	    	array(
	    	   'name' => esc_html__('Header background', 'brookside-elements'),
	    	   'desc' => esc_html__('Setup background parameters if you need custom header on this page.', 'brookside-elements'),
	    	   'id' => $prefix . 'header_background',
	    	   'type' => 'background',
			   'std'  => '',
	    	),
	    	array(
	    	   'name' => esc_html__('Header bottom line', 'brookside-elements'),
	    	   'desc' => esc_html__('Check this if you need to disable border line.', 'brookside-elements'),
	    	   'id' => $prefix . 'header_bottom_border',
	    	   'type' => 'checkbox',
			   'std' => 0
	    	),
	    	array(
	    	   'name' => esc_html__('Body background', 'brookside-elements'),
	    	   'desc' => esc_html__('Setup background parameters if you need custom background color on page.', 'brookside-elements'),
	    	   'id' => $prefix . 'body_background',
	    	   'type' => 'color',
			   'std'  => '',
	    	),
	    	array(
			    'id' => $prefix . 'display_page_footer',
			    'name'      => esc_html__('Footer layout?', 'brookside-elements'),
			    'type' => 'select',
			    'options' => array(
			   		'default' => esc_html__('Default', 'brookside-elements'),
			    	'widgetized' => esc_html__('Widgetized footer', 'brookside-elements'),
			    	'simple' => esc_html__('Simple footer', 'brookside-elements'),
			    	'disable' => esc_html__('Disable footer', 'brookside-elements')
			    ),
			    'std'  => array('default'),
			),
			array(
	    	   'name' => esc_html__('Footer background', 'brookside-elements'),
	    	   'desc' => esc_html__('Setup background parameters if you need custom background color on this page.', 'brookside-elements'),
	    	   'id' => $prefix . 'footer_background',
	    	   'type' => 'background',
			   'std'  => '',
	    	),
	    	array(
				'name'	=> esc_html__('Footer socials color','brookside-elements'),
				'desc'	=> esc_html__('Leave empty to use default theme colors.','brookside-elements'),
				'id'	=> $prefix . 'footer_socials_color',
				'type'	=> 'color',
			),
	    	
	    	array(
	    	   'name' => esc_html__('Page sidebar', 'brookside-elements'),
	    	   'desc' => esc_html__('Select your sidebar if you want to use another sidebar on this page/post.','brookside-elements'),
	    	   'id' => $prefix . 'page_sidebar',
	    	   'type' => 'select',
			   'options' => $sidebars,
			   'std'  => array('blog-widgets'),
	    	),
		)
	);
	if( !get_theme_mod('brookside_seo_settings', false) ) {
		$meta_boxes[] = array(
			'id'		=> 'brookside_page_seo',
			'title'		=> esc_html__('Brookside Page SEO','brookside-elements'),
			'pages'		=> array( 'page', 'post' ),
			'context' => 'side',
			'priority' => 'low',
			'fields'	=> array(
		    	array(
					'name'	=> esc_html__('Meta Description','brookside-elements'),
					'desc'	=> esc_html__('Enter your page/post description for SEO optimization. Recommended to use 120-140 characters.','brookside-elements'),
					'id'	=> $prefix . 'page_meta_description',
					'type'	=> 'textarea',
				),
				array(
					'name'	=> esc_html__('Meta Keywords','brookside-elements'),
					'desc'	=> esc_html__('Enter your page/post keywords for SEO optimization. Divide keywords by commas.','brookside-elements'),
					'id'	=> $prefix . 'page_meta_keywords',
					'type'	=> 'textarea',
				),
			)
		);
	}
	$meta_boxes[] = array(
		'id'		=> 'page_title',
		'title'		=> esc_html__('Page title','brookside-elements'),
		'pages'		=> array( 'page' ),
		'context' => 'side',
		'priority' => 'low',
		'fields'	=> array(
	    	array(
	    	   'name' => esc_html__('Hide title', 'brookside-elements'),
	    	   'desc' => esc_html__('Check this to hide page title.', 'brookside-elements'),
	    	   'id' => $prefix . 'page_title_hide',
	    	   'type' => 'checkbox',
			   'std' => 0
	    	),
	    	array(
	    	   'name' => esc_html__('Title position', 'brookside-elements'),
	    	   'id' => $prefix . 'page_title_position',
	    	   'type' => 'select',
			   'options' => array(
			   		'textleft' => esc_html__('Left', 'brookside-elements'),
			    	'textcenter' => esc_html__('Center', 'brookside-elements'),
			    	'textright' => esc_html__('Right', 'brookside-elements')
			    ),
			    'std'  => array('textleft'),
	    	),
		)
	);
	$image_sizes = get_intermediate_image_sizes();
	$image_sizes[]= 'full';
	$image_sizes = array_combine($image_sizes, $image_sizes);
	$meta_boxes[] = array(
		'id'		=> 'page_hero_header',
		'title'		=> esc_html__('Page hero section','brookside-elements'),
		'pages'		=> array( 'page' ),
		'context' => 'side',
		'priority' => 'low',
		'fields'	=> array(
	    	array(
	    	   'name' => esc_html__('Hero section', 'brookside-elements'),
	    	   'id' => $prefix . 'page_hero_section',
	    	   'type' => 'select',
			   'options' => array(
			   		'disable' => esc_html__('Disable', 'brookside-elements'),
			    	'slider' => esc_html__('Slider', 'brookside-elements')
			    ),
			    'std'  => array('disable'),
	    	),
	    	array(
			    'name' => esc_html__('Section padding', 'brookside-elements'),
			    'desc' => esc_html__('Do not set "px".', 'brookside-elements'),
			    'id'   => $prefix . 'page_herosection_padding',
			    'type' => 'fieldset_text',
			    'options' => array(
			        'top'    => esc_html__('top','brookside-elements'),
			        'right' => esc_html__('right','brookside-elements'),
			        'bottom'   => esc_html__('bottom','brookside-elements'),
			        'left'   => esc_html__('left','brookside-elements')
			    ),
			    'clone' => false
			),
			array(
			    'type' => 'heading',
			    'name' => esc_html__('Slider', 'brookside-elements'),
			    'desc' => esc_html__('Use options below if you select "Slider" hero section', 'brookside-elements'),
			),
			array(
			    'name'        => esc_html__('Select posts to show', 'brookside-elements'),
			    'id'          =>  $prefix . 'page_herosection_slider_posts',
			    'type'        => 'post',
			    'post_type'   => 'post',
			    'multiple' => true,
			    // Field type.
			    'field_type'  => 'select_advanced',
			    'placeholder' => esc_html__('Select posts', 'brookside-elements'),
			    'query_args'  => array(
			        'post_status'    => 'publish',
			        'posts_per_page' => - 1,
			        'order' => 'post__in'
			    ),
			),
			array(
			    'name' => esc_html__('Posts count', 'brookside-elements'),
			    'desc' => esc_html__('Select posts count to display posts', 'brookside-elements'),
			    'id'   => $prefix . 'page_herosection_slider_posts_count',
			    'type' => 'number',
			    'std' => 3,
			    'min'  => 3,
			    'step' => 1,
			),
			array(
	    	   'name' => esc_html__('Slider style', 'brookside-elements'),
	    	   'id' => $prefix . 'page_herosection_slider_style',
	    	   'type' => 'select',
			   'options' => array(
		        	'center' => esc_html__('Centered', 'brookside-elements'),
		        	'simple' => esc_html__( 'Simple', 'brookside-elements' ),
		        	'three_per_row' => esc_html__( 'Three per row', 'brookside-elements' )
		        ),
			    'std'  => array('simple'),
	    	),
	    	array(
			    'name' => esc_html__('Slider height', 'brookside-elements'),
			    'desc' => esc_html__('Enter slider height in (px)', 'brookside-elements'),
			    'id'   => $prefix . 'page_slider_height',
			    'type' => 'number'
			),
	    	array(
	    	   'name' => esc_html__('Image size', 'brookside-elements'),
	    	   'id' => $prefix . 'page_herosection_slider_image_size',
	    	   'type' => 'select',
			   'options' => $image_sizes,
			    'std'  => array('large'),
	    	),
			array(
	    	   'name' => esc_html__('Slider slideshow', 'brookside-elements'),
	    	   'id' => $prefix . 'page_herosection_slider_slideshow',
	    	   'type' => 'select',
			   'options' => array(
			   		'true' => esc_html__('Yes', 'brookside-elements'),
			    	'false' => esc_html__('No', 'brookside-elements'),
			    ),
			    'std'  => array('true'),
	    	),
			array(
	    	   'name' => esc_html__('Slider loop', 'brookside-elements'),
	    	   'id' => $prefix . 'page_herosection_slider_loop',
	    	   'type' => 'select',
			   'options' => array(
			   		'true' => esc_html__('Yes', 'brookside-elements'),
			    	'false' => esc_html__('No', 'brookside-elements'),
			    ),
			    'std'  => array('true'),
	    	)

		)
	);
	return $meta_boxes;
}
