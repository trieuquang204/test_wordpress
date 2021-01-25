<?php
global $post;
$sticky = get_theme_mod('brookside_sticky_sidebar', 'sticky');
if( is_archive() ){
	$sticky = get_theme_mod('brookside_sticky_sidebar_archive', 'sticky');
}
?>
<div id="sidebar" class="span3 <?php echo esc_attr($sticky); ?>">
	<?php
		$name = rwmb_get_value('brookside_page_sidebar');
		if($name) {
			generated_dynamic_sidebar($name);
		} else {
			$name_temp = get_post_meta(get_the_ID(), 'sbg_selected_sidebar_replacement', true);
			if( is_array($name_temp)){
				$name = $name_temp[0];
				generated_dynamic_sidebar($name);
			} else {
				if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Blog Widgets') );
			}
		}
	?>
</div>