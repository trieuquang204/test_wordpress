<header class="title">
	<h2><?php the_title(); ?></h2>
	<div class="meta-info">
		<div class="meta-categories"><?php echo get_the_category_list(', '); ?></div>
		<?php if( get_theme_mod('brookside_single_post_meta_date', true ) ) {?><div class="meta-date"><span>X</span><time datetime="<?php echo esc_attr(date(DATE_W3C)); ?>"><?php the_time(get_option('date_format')); ?></time></div><?php } ?>
	</div>
</header>