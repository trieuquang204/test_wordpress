<?php
function brookside_socials_block() {
	// Scripts.
	wp_register_script(
		'brooksidesocials-block-script', // Handle.
		BROOKSIDE_PLUGIN_URL.'inc/gutenberg/blocks/socials/block.js', // Block.js: We register the block here.
		array( 'wp-blocks', 'wp-editor', 'wp-element', 'wp-i18n' ) // Dependencies, defined above.
	);

	// Styles.
	wp_register_style(
		'brooksidesocials-block-editor-style', // Handle.
		BROOKSIDE_PLUGIN_URL.'inc/gutenberg/blocks/socials/editor.css', // Block editor CSS.
		array( 'wp-edit-blocks' ) // Dependency to include the CSS after it.
	);

	// Here we actually register the block with WP, again using our namespacing
	// We also specify the editor script to be used in the Gutenberg interface
	register_block_type( 'brookside/socials', array(
		'editor_script' => 'brooksidesocials-block-script',
		'attributes'      => array(
			'links_color' => array(
				'type' => 'string',
				'default' => ''
			),
			'bg_color' => array(
				'type' => 'string',
				'default' => ''
			),
			'block_id' => array(
				'type' => 'string',
				'default' => ''
			),
			'icons_align' => array(
				'type' => 'string',
				'default' => 'textcenter'
			),
		),
		'render_callback' => 'BrooksideSocialsConvert',
	) );

}
add_action( 'init', 'brookside_socials_block' );
function BrooksideSocialsConvert($attributes){
	$out = '[brooksidesocials ';
	$out .= 'id="'.$attributes['block_id'].'" ';
	$out .= 'facebook="'.get_theme_mod('brookside_social_facebook', '#').'" ';
	$out .= 'twitter="'.get_theme_mod('brookside_social_twitter', '#').'" ';
	$out .= 'pinterest="'.get_theme_mod('brookside_social_pinterest', '').'" ';
	$out .= 'vimeo="'.get_theme_mod('brookside_social_vimeo', '').'" ';
	$out .= 'instagram="'.get_theme_mod('brookside_social_instagram', '#').'" ';
	$out .= 'tumblr="'.get_theme_mod('brookside_social_tumblr', '').'" ';
	$out .= 'google_plus="'.get_theme_mod('brookside_social_google_plus', '').'" ';
	$out .= 'forrst="'.get_theme_mod('brookside_social_forrst', '').'" ';
	$out .= 'dribbble="'.get_theme_mod('brookside_social_dribbble', '').'" ';
	$out .= 'flickr="'.get_theme_mod('brookside_social_flickr', '').'" ';
	$out .= 'linkedin="'.get_theme_mod('brookside_social_linkedin', '').'" ';
	$out .= 'skype="'.get_theme_mod('brookside_social_skype', '').'" ';
	$out .= 'digg="'.get_theme_mod('brookside_social_digg', '').'" ';
	$out .= 'yahoo="'.get_theme_mod('brookside_social_yahoo', '').'" ';
	$out .= 'youtube="'.get_theme_mod('brookside_social_youtube', '').'" ';
	$out .= 'deviantart="'.get_theme_mod('brookside_social_deviantart', '').'" ';
	$out .= 'behance="'.get_theme_mod('brookside_social_behance', '').'" ';
	$out .= 'paypal="'.get_theme_mod('brookside_social_paypal', '').'" ';
	$out .= 'delicious="'.get_theme_mod('brookside_social_delicious', '').'" ';
	$out .= 'rss="'.get_theme_mod('brookside_social_rss', '').'" ';
	$out .= 'icon_color="'.$attributes['links_color'].'" ';
	$out .= 'bg_color="'.$attributes['bg_color'].'" ';
	$out .= 'icons_align="'.$attributes['icons_align'].'"';
	$out .=']';
	$css = '';
	return do_shortcode($out);
	
}