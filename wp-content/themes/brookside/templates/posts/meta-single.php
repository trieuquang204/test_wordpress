<div class="clear"></div>
<?php if( get_tags() ) {?><div class="post-meta-tags"><span class="meta-tags"><?php the_tags('',' ', ''); ?></span></div><?php } ?>
<?php wp_link_pages(array('before' =>'<div class="pagination_post aligncenter">', 'next_or_number' => 'next_and_number', 'after'  =>'</div>', 'pagelink' => '<span>%</span>', 'nextpagelink' => esc_html__('Next page','brookside').' <i class="la la-angle-right"></i>', 'previouspagelink' => '<i class="la la-angle-left"></i> '.esc_html__('Previous page','brookside'))); ?>
<div class="post-meta">
	<?php
		$out = '';
		$out .= '<div class="meta meta-first-block">';
			if( comments_open() )
				$out .= '<div class="write-comment"><a href="#reply-title" class="button button-large">'.esc_html__('Write comment', 'brookside').'</a></div>';
			if( function_exists('BrooksideSharebox') && get_theme_mod('brookside_single_post_meta_sharebox', true) ){
				$out .= BrooksideSharebox( get_the_ID() );
			}
		$out .= '</div>';
		$out .= '<div class="meta meta-second-block">';
			if(comments_open())
				$out .= '<div class="post-comments">'.brookside_comments_number(get_the_ID()).'</div>';

			if( function_exists('getPostLikeCount') && get_theme_mod('brookside_single_post_likes', false) ) 
				$out .= '<div class="post-like">'.getPostLikeCount( get_the_ID() ).'</div>';

			if( function_exists('brookside_calculate_reading_time') && get_theme_mod('brookside_single_post_read_time', true) ) 
				$out .= '<div class="post-read">'.brookside_calculate_reading_time().'</div>';

			if( function_exists('BrooksideGetPostViews') && get_theme_mod('brookside_single_post_views', false) ) 
				$out .= '<div class="post-view">'.BrooksideGetPostViews( get_the_ID() ).'</div>';
		$out .= '</div>';
		
		echo ''.$out;
	?>
</div>