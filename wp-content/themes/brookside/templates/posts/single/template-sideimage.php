<?php $sidebar_pos = brookside_get_sidebar_position(); ?>
<div id="page-wrap-blog" class="container">
	<div id="content" class="single">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<article <?php post_class(); ?>>
				<div class="post-content-container">
					<div class="row">
						<?php 
						switch ( get_post_format() ) {
							case 'gallery':
							case 'link':
							case 'audio':
							case 'video':
							case 'image':
							case 'quote':
								echo '<div class="span6">';
								break;
							default:
								if( has_post_thumbnail() ) {
									echo '<div class="span6">';
								} else {
									echo '<div class="span12">';
								}
								break;
						}
						?>
						<?php get_template_part('templates/posts/title', 'block'); ?>

						<div class="post-content">
							<div class="post-excerpt">
								<?php the_content(); ?>
							</div>
							<?php wp_link_pages(array('before' =>'<div class="pagination_post aligncenter">', 'after'  =>'</div>', 'pagelink' => '<span>%</span>')); ?>
						</div>
						<?php if( get_tags() ) {?><div class="post-meta-tags"><span class="meta-tags"><?php the_tags('',' ', ''); ?></span></div><?php } ?>
						<?php echo '</div>'; ?>
						<?php
						echo '<div class="span6">';
						brookside_single_post_format_content();
						echo '</div>';
					?>
					</div>	
					<div class="row">
						<div class="span12">
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
						</div>
					</div>
					<div class="row">
						<div class="side-mage-sidebar <?php echo esc_attr($sidebar_pos); ?>">
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

							comments_template();
							?>
						</div>
						<?php 
							if( $sidebar_pos == 'span9 sidebar-left' || $sidebar_pos == 'span9 sidebar-right' ){
								get_sidebar();
							}
						?>
					</div>
				</div>

			</div>
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
</div>
