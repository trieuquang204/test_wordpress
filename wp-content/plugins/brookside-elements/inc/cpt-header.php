<?php

add_action('init', 'brookside_post_type_header');
function brookside_post_type_header() {
	register_post_type( 'brookside-header',
        array( 
        'menu_icon'=>'dashicons-welcome-widgets-menus',	
		'label' => __('Header', 'brookside-elements'), 
		'public' => true, 
		'show_ui' => true,
		'show_in_nav_menus' => false,
		'has_archive' => false,
		'exclude_from_search' => true,
		'menu_position' => 20,
		'rewrite' => array(
			'slug' => 'header-view',
			'with_front' => true,
		),
		'supports' => array(
				'title',
				'editor')
			) 
		);
}

?>