
<?php get_header(); ?>

	<div id="page-wrap">
		<div class="container">
			<div id="content" class="span12">
				<div id="error-404">
					<div class="entry">
						<h1 class="error-title"><?php esc_html_e('404', 'brookside'); ?></h1>
						<h3 class="error-subtitle"><?php esc_html_e("Page Not Found", 'brookside'); ?></h3>
						<div class="error-text"><?php esc_html_e('The page you were looking for does not exist. It might have been removed had its address changed or become temporarily unavailable.', 'brookside'); ?></div>
						<a href="<?php echo esc_url(home_url('/')); ?>" class="button error-button"><?php esc_html_e('Return to homepage','brookside'); ?> <i class="la la-arrow-right"></i></a>
					</div>
				</div>
			</div> <!-- end content -->
		</div>
	</div> <!-- end page-wrap -->
<?php get_footer('blank'); ?>
