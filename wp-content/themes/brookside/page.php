
<?php get_header(); ?>
<?php 
	if( rwmb_get_value('brookside_page_sidebar') != 'none' ) {
		$sidebar_pos ='span9 sidebar-right';
	} else {
		$sidebar_pos = 'span12';
	}
	if( !is_active_sidebar('blog-widgets') && rwmb_get_value('brookside_page_sidebar') != 'none' ) {
		$sidebar_pos .=' no_widgets_sidebar';
	}
?>
<div id="page-wrap" class="container">
	<div id="content" class="<?php echo esc_attr($sidebar_pos); ?>">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if( has_post_thumbnail() ){ ?>
			<div class="featured-image">
				<figure>
					<?php the_post_thumbnail('large'); ?>
				</figure>
			</div>
			<?php } ?>
			<?php if(!rwmb_meta('brookside_page_title_hide')){ ?>
			<header class="title page-title">
				<h2 class="<?php echo rwmb_get_value('brookside_page_title_position'); ?>"><?php echo esc_attr(get_the_title()); ?></h2>
			</header>
			<?php } ?>
			<div class="entry">
				<?php the_content(); ?>

				<?php wp_link_pages(array('before' =>'<div class="pagination_post aligncenter">', 'after'  =>'</div>', 'pagelink' => '<span>%</span>')); ?>
			</div>

		</div>
		<?php if( comments_open() ){
			comments_template();
		} ?>
		<?php endwhile; endif; ?>
	</div> <!-- end content -->
	
	<?php if( is_active_sidebar('blog-widgets') && rwmb_get_value('brookside_page_sidebar') != 'none' ) { 
		get_sidebar(); 
	} ?>
	
</div> <!-- end page-wrap -->
	
<?php get_footer(); ?>
