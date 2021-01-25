<?php 

$sidebar_pos = brookside_get_sidebar_position();

$img_size = 'post-thumbnail';
if($sidebar_pos == 'span12'){
	$img_size = 'large';
}
?>
<div id="page-wrap-blog" class="container">
	<div id="content" class="<?php echo esc_attr($sidebar_pos); ?> single">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<article itemscope itemtype="http://schema.org/Article" <?php post_class(); ?>>
					<div class="post-content-container">
						<?php if( brookside_get_post_title_display_option() == 'above' ){
							get_template_part('templates/posts/title', 'block');
						} ?>

						<?php get_template_part('templates/posts/content', 'single'); ?>

						<?php get_template_part( 'templates/posts/meta', 'single' ); ?>
					</div>
					<?php 
						if ( '' !== get_the_author_meta( 'description' ) || get_theme_mod( 'brookside_single_post_author_info', false ) ) {
							get_template_part( 'templates/posts/biography' );
						}					

						if( get_theme_mod( 'brookside_single_post_navigation', true ) ){
							get_template_part( 'templates/posts/post-navigation' );
						}

						if( get_theme_mod( 'brookside_single_post_related', 'true' ) == 'true' ){
							get_template_part( 'templates/posts/related-posts' );
						}
	
						comments_template();
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
