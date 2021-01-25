<div class="fullwidth-image">
	<?php if(get_post_format() == '' || get_post_format() == 'standard' ) { ?>
		<div class="overlay-bg"></div>
	<?php } ?>
	<?php
		brookside_single_post_format_content();
	?>
	<?php if( brookside_get_post_title_display_option() == 'above' ){
		get_template_part('templates/posts/title', 'block');
	} ?>
</div>
<?php 
$sidebar_pos = brookside_get_sidebar_position();
?>
<div id="page-wrap-blog" class="container">
	<div id="content" class="<?php echo esc_attr($sidebar_pos); ?> single">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<article itemscope itemtype="http://schema.org/Article" <?php post_class(); ?>>
					<div class="post-content-container">
						<?php if( brookside_get_post_title_display_option() == 'under' ){
							get_template_part('templates/posts/title', 'block');
						} ?>
						<?php 
							$share_class = '';
							if( rwmb_meta('brookside_post_sticky_sharebox') && function_exists('BrooksideStickySharebox') ){
								$share_class = ' sharebox-enabled';
							} elseif ( get_theme_mod( 'brookside_single_post_sicky_sharebox', false ) && function_exists('BrooksideStickySharebox') ){
								$share_class = ' sharebox-enabled';
							}
						?>
						<div class="post-content">
							<div class="post-excerpt <?php echo esc_attr($share_class); ?>">
								<?php 
									if( rwmb_meta('brookside_post_sticky_sharebox') && function_exists('BrooksideStickySharebox') ){
										BrooksideStickySharebox(get_the_ID(), true);
									} elseif ( get_theme_mod( 'brookside_single_post_sicky_sharebox', false ) && function_exists('BrooksideStickySharebox') ){
										BrooksideStickySharebox(get_the_ID(), true);
									}
								?>
								<?php the_content(); ?>
							</div>
							<?php wp_link_pages(array('before' =>'<div class="pagination_post aligncenter">', 'after'  =>'</div>', 'pagelink' => '<span>%</span>')); ?>
						</div>

						<?php get_template_part( 'templates/posts/meta', 'single' ); ?>
					</div>
					<?php 
						if ( '' !== get_the_author_meta( 'description' ) ) {
							get_template_part( 'templates/posts/biography' );
						}
						
						if( get_theme_mod( 'brookside_single_post_navigation', true ) ){
							get_template_part( 'templates/posts/post-navigation' );
						}

						if( get_theme_mod( 'brookside_single_post_related', 'true' ) == 'true' ){
							get_template_part( 'templates/posts/related-posts' );
						}

						if(comments_open()) {
							comments_template();
						} 
					?>
				</article>
				
		<?php endwhile; endif; ?>
	</div>

<?php 
	if( $sidebar_pos == 'span9 sidebar-left' || $sidebar_pos == 'span9 sidebar-right' ){
		get_sidebar();
	}
?>
</div>
