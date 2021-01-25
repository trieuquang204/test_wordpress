<?php
/*
Template Name: Page: WooCommerce
*/
?>
<?php get_header(); ?>
	<div id="page-wrap">
		<div id="content" <?php post_class(); ?>>
		<?php if(!rwmb_meta('brookside_page_title_hide')){ ?>
			<header class="title"><h2><?php the_title(); ?></h2></header>
		<?php } ?>
		<div class="container">
			<div class="span12">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php the_content(); ?>
						
					<?php wp_link_pages(array('before' =>'<div class="pagination_post aligncenter">', 'after'  =>'</div>', 'pagelink' => '<span>%</span>')); ?>
					
				<?php endwhile; endif; ?></div>
			</div>
		</div> <!-- end content -->
	</div> <!-- end page-wrap -->
<?php get_footer('shop'); ?>
