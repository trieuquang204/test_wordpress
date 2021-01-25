<?php 
	$share_class = '';
	if( rwmb_meta('brookside_post_sticky_sharebox') && function_exists('BrooksideStickySharebox') ){
		$share_class = ' sharebox-enabled';
	} elseif ( get_theme_mod( 'brookside_single_post_sicky_sharebox', false ) && function_exists('BrooksideStickySharebox') ){
		$share_class = ' sharebox-enabled';
	}
?>
<div class="post-content">
	<?php
		brookside_single_post_format_content();

		if( brookside_get_post_title_display_option() == 'under' ){
			get_template_part('templates/posts/title', 'block');
		}
	?>
	<div class="post-excerpt<?php echo esc_attr($share_class); ?>">
		<?php 
			if( rwmb_meta('brookside_post_sticky_sharebox') && function_exists('BrooksideStickySharebox') ){
				BrooksideStickySharebox(get_the_ID(), true);
			} elseif ( get_theme_mod( 'brookside_single_post_sicky_sharebox', false ) && function_exists('BrooksideStickySharebox') ){
				BrooksideStickySharebox(get_the_ID(), true);
			}
		?>
		<?php the_content(); ?>
	</div>
</div>