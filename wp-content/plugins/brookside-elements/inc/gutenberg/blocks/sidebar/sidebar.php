<?php
function brookside_sidebar_block() {
	// Scripts.
	wp_register_script(
		'brooksidesidebar-block-script', // Handle.
		BROOKSIDE_PLUGIN_URL.'inc/gutenberg/blocks/sidebar/block.js', // Block.js: We register the block here.
		array( 'wp-blocks', 'wp-editor', 'wp-element', 'wp-i18n' ) // Dependencies, defined above.
	);

	// Styles.
	wp_register_style(
		'brooksidesidebar-block-editor-style', // Handle.
		BROOKSIDE_PLUGIN_URL.'inc/gutenberg/blocks/sidebar/editor.css', // Block editor CSS.
		array( 'wp-edit-blocks' ) // Dependency to include the CSS after it.
	);

	// Here we actually register the block with WP, again using our namespacing
	// We also specify the editor script to be used in the Gutenberg interface
	register_block_type( 'brookside/sidebar', array(
		'editor_script' => 'brooksidesidebar-block-script',
		'editor_style' => 'brooksidesidebar-block-editor-style',
		'attributes'      => array(
			'sidebar_id' => array(
				'type' => 'string',
			),
		),
		'render_callback' => 'BrooksideSlidebarConvert',
	) );

}
add_action( 'init', 'brookside_sidebar_block' );
function BrooksideSlidebarConvert($attributes){
	$out = '';
	global $post;
	$sticky = get_theme_mod('brookside_sticky_sidebar', 'sticky');
	ob_start();
	?>
	<div id="sidebar" class="<?php echo esc_attr($sticky); ?>">
	<?php
		$name = rwmb_get_value('brookside_page_sidebar');
		if($name) {
			generated_dynamic_sidebar($name);
		} else {
			$name_temp = get_post_meta($post->ID, 'sbg_selected_sidebar_replacement', true);
			if( is_array($name_temp)){
				$name = $name_temp[0];
				generated_dynamic_sidebar($name);
			} else {
				if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Blog Widgets') );
			}
		}
	?>
	</div>
	<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}