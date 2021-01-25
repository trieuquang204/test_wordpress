<?php

	$prevPost = get_previous_post();
	$nextPost = get_next_post();
	
	if(!empty($prevPost) || !empty($nextPost)) { ?>
	<div id="post-navigation">
		
		<div class="prev">
			<?php if(!empty($prevPost)) { $prevURL = get_permalink($prevPost->ID); ?>
			<h5 class="nav-label"><?php esc_html_e('Previous post', 'brookside'); ?></h5>
			<a class="prev-post-label" href="<?php echo esc_url($prevURL); ?>" >
				<?php if( has_post_thumbnail($prevPost->ID) ){ echo '<figure>'.get_the_post_thumbnail($prevPost->ID, 'medium').'</figure>'; } ?>
				<div class="prev-post-title">
					<span><?php esc_html_e('Read previous post', 'brookside'); ?></span>
					<h2><?php echo get_the_title($prevPost->ID); ?></h2>
				</div>
			</a>
			<?php } ?>
		</div>
		
		<div class="next">
			<?php if(!empty($nextPost)) { $nextURL = get_permalink($nextPost->ID); ?>
			<h5 class="nav-label"><?php esc_html_e('Next post', 'brookside'); ?></h5>
			<a class="next-post-label" href="<?php echo esc_url($nextURL); ?>">
				<?php if( has_post_thumbnail($nextPost->ID) ){ echo '<figure>'.get_the_post_thumbnail($nextPost->ID, 'medium').'</figure>'; } ?>
				<div class="next-post-title">
					<span><?php esc_html_e('Read next post', 'brookside'); ?></span>
					<h2><?php echo get_the_title($nextPost->ID); ?></h2>
				</div>
			</a>
			<?php } ?>
		</div>
		
	</div>
<?php } ?>