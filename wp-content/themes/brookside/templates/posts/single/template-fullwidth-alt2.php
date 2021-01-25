<div class="fullwidth-image fullwidth-image-alt fullwidth-image-alt2">
	<div class="overlay-bg"></div>
	<?php if(get_post_format() == '' || get_post_format() == 'standard' ) { ?>
	<div class="overlay-title">
		<?php get_template_part('templates/posts/title', 'block'); ?>
	</div>
	<?php } ?>
	<?php
		brookside_single_post_format_content();
	?>

</div>
<?php 
$sidebar_pos = brookside_get_sidebar_position();
?>
<div id="page-wrap-blog" class="container">
	<div id="content" class="<?php echo esc_attr($sidebar_pos); ?> single">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<article itemscope itemtype="http://schema.org/Article" <?php post_class(); ?>>
					<div class="post-content-container">
										
						<div class="post-content">
							<div class="post-excerpt">
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

						if( get_theme_mod( 'brookside_single_post_related', 'false' ) == 'true' ){
							get_template_part( 'templates/posts/related-posts' );
						}

						if(comments_open()) {
							comments_template();
						} 
					?>
				</article>
				<?php 
					if( rwmb_meta('brookside_post_sticky_sharebox') && function_exists('BrooksideStickySharebox') ){
						BrooksideStickySharebox(get_the_ID(), true);
					} elseif ( get_theme_mod( 'brookside_single_post_sicky_sharebox', false ) && function_exists('BrooksideStickySharebox') ){
						BrooksideStickySharebox(get_the_ID(), true);
					}
				?>
				
		<?php endwhile; endif; ?>
	</div>

<?php 
	if( $sidebar_pos == 'sidebar-left span9' || $sidebar_pos == 'sidebar-right span9'){
		get_sidebar();
	}
?>
</div>
