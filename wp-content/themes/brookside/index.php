<?php get_header(); ?>

<?php 
// Get Blog Layout from Theme Options
if(get_theme_mod('brookside_sidebar_pos', 'none') != 'none'){
	$sidebar_pos = get_theme_mod('brookside_sidebar_pos', 'sidebar-right').' span9';
} else {
	$sidebar_pos ='span12';
}
if( !is_active_sidebar('blog-widgets') && get_theme_mod('brookside_sidebar_pos', 'sidebar-right') != 'none') {
	$sidebar_pos .=' no_widgets_sidebar';
}
if( get_theme_mod('brookside_home_hero_slider', 'slider' ) == 'slider') {
	get_template_part('templates/blog/slider');
}//end slider output if ?>
<div id="page-wrap-blog" class="container">
	<div id="content" class="<?php echo esc_attr($sidebar_pos); ?>">
		<div class="row">
			<?php
			$columns = get_theme_mod( 'brookside_blog_columns', 'span4');
	      	$display_categories = get_theme_mod( 'brookside_display_post_categories', true);
	      	$display_date = get_theme_mod( 'brookside_display_post_date', true);
	      	$display_comments = get_theme_mod( 'brookside_display_post_comments', false);
	      	$display_views = get_theme_mod( 'brookside_display_post_views', false);
	      	$excerpt_count = get_theme_mod( 'brookside_blog_excerpt_count', '15' );
	      	if( function_exists('BrooksideGetPostViews')){
	      		$display_views = get_theme_mod( 'brookside_display_post_views', false);
	      	} else {
	      		$display_views = false;
	      	}
	      	if( function_exists('getPostLikeLink') ){
	      		$display_likes = get_theme_mod( 'brookside_display_post_likes', false);
	      	} else {
	      		$display_likes = false;
	      	}
	      	if( function_exists('brookside_calculate_reading_time') ){
	      		$display_read_time = get_theme_mod( 'brookside_display_post_read_time', false);
	      	} else {
	      		$display_read_time = false;
	      	}
	      	
	      	$pagination = get_theme_mod( 'brookside_display_post_pagination', 'standard');
	      	$display_readmore = 'true';
	      	$ignore_featured = get_theme_mod( 'brookside_ignore_featured_posts', true);
	      	$ignore_sticky_posts = get_theme_mod( 'brookside_ignore_sticky_posts', false);
	      	$bottom_lines = '';
	      	$text_align = get_theme_mod('brookside_blog_elements_align','textleft');
			$out = '';
			$post_style = get_theme_mod('brookside_blog_style', 'style_4');
			$thumbsize = get_theme_mod('brookside_blog_thumbnail_size','brookside-extra-medium');
			$i = 0;
			$j = 0;
			$blockclass = 'odd';
			if($post_style == 'style_4'){
				$thumbsize = 'brookside-masonry';
			}
			if($post_style == 'style_2' || $post_style == 'style_3' ){
				$thumbsize = 'post-thumbnail';
			}
			if(($post_style == 'style_1' || $post_style == 'style_4' || $post_style == 'style_5') || $pagination == 'true' ){
				if( $post_style == 'style_4' || $post_style == 'style_5' ){
					$masonry = 'masonry';
				} else {
					$masonry = 'fitRows';
				}
				
				wp_enqueue_script('isotope');
				wp_enqueue_script('infinite-scroll');
				wp_enqueue_script('imagesloaded');
				$script = "(function($) {
					\"use strict\";
					var win = $(window);
				    win.load(function(){
				        var isoOptionsBlog = {
		                    itemSelector: '.post',
		                    layoutMode: '".$masonry."',
		                    masonry: {
		                        columnWidth: '.post-size'
		                    },
		                    percentPosition:true,
		                };
				        var gridBlog2 = $('#latest-posts .blog-posts');
				        gridBlog2.isotope(isoOptionsBlog);       
				        win.resize(function(){
				            gridBlog2.isotope('layout');
				        });
				        gridBlog2.infinitescroll({
				            navSelector  : '#pagination',    // selector for the paged navigation 
				            nextSelector : '#pagination a.next',  // selector for the NEXT link (to page 2)
				            itemSelector : '.post',     // selector for all items you'll retrieve
				            loading: {
				                finishedMsg: 'No more items to load.',
				                msgText: '<i class=\"fa fa-spinner fa-spin fa-2x\"></i>'
				              },
				            animate      : false,
				            errorCallback: function(){
				                $('a.loadmore').removeClass('active').hide();
				                $('a.loadmore').addClass('hide');
				            },
				            appendCallback: true
				            },  // call Isotope as a callback
				            function( newElements ) {
				                var newElems = $( newElements ); 
				                newElems.imagesLoaded(function(){
				                    gridBlog2.isotope( 'appended', newElems );
				                    gridBlog2.isotope('layout');
				                    $('a.loadmore').removeClass('active');
				                });
				            }
				        );
				        $('body').on('click', 'a.loadmore', function () {
				            $(this).addClass('active');
				            gridBlog2.infinitescroll('retrieve');
				            return false;
				        });
				        setTimeout(function(){ $('.page-loading').fadeOut('fast', function (){});}, 100);
				    });
				    $(window).load(function(){ $(window).unbind('.infscr'); });
				})(jQuery);";
				wp_add_inline_script('isotope', $script);
			}
			if( have_posts() ) {
			$out .= '<div id="latest-posts">';
			$out .= '<div class="row-fluid blog-posts">';
			if( $post_style == 'style_6' ){ 
				$out .= '<div class="nested-block '.$blockclass.'">';
			}
			while ( have_posts() ) {
				the_post();
				$tmpContent = get_the_content();
				$classes = join(' ', get_post_class($post->ID));
				$classes .= ' post';
				if(!$ignore_sticky_posts && is_sticky()){
					$out .= '<article class="textcenter single-post span12 '.$classes.'">';
						$out .= '<div class="post-content-container aligncenter">';
							$out .= '<div class="post-content">';
								$out .= brookside_get_post_format_content(false, 'large');
								$out .='<div class="meta-over-img">';
									$out .= '<header class="title">';
										$out .= '<h2><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'" rel="bookmark">'.get_the_title().'</a></h2>';
										$out .= '<div class="meta-info">';
											if( $display_categories ) $out .= '<div class="meta-categories">'.get_the_category_list(', ').'</div>';
											if( $display_date ) $out .= '<div class="meta-date"><span>X</span>'.get_the_time(get_option('date_format')).'</div>';
										$out .= '</div>';
									$out .= '</header>';
									$out .= get_the_excerpt();
								$out .= '</div>';
							$out .= '</div>';
						$out .= '</div>';
					$out .= '</article>';
				} elseif(!$ignore_featured && rwmb_meta('brookside_post_featured', get_the_ID()) && ($post_style == 'style_1' || $post_style == 'style_4') ){
					$classes = str_replace('sticky ', '', $classes);
					$out .= '<article class="post-featured-style4 post-size '.$columns.' '.$classes.'">';
						$out .= '<div class="post-content-container '.$text_align.'">';						
							$out .= '<div class="post-content">';
								$out .= '<div class="post-img-block">';
									$out .= '<div class="meta-over-img">';
									$out .= '<header class="title">';
										$out .= '<h2><a href="'.get_the_permalink().'" title="'.esc_attr__('Permalink to', 'brookside').' '.esc_attr(the_title_attribute('echo=0')).'" rel="bookmark">'.get_the_title().'</a></h2>';
										$out .= '<div class="meta-info">';
											if( $display_categories ) $out .= '<div class="meta-categories">'.get_the_category_list(', ').'</div>';
											if( $display_date ) $out .= '<div class="meta-date"><span>X</span>'.get_the_time(get_option('date_format')).'</div>';
										$out .= '</div>';
									$out .= '</header>';
									$out .= '</div>';
									if( has_post_thumbnail() ) {
										$out .= '<figure class="post-img"><a href="'.get_the_permalink().'" rel="bookmark">'.get_the_post_thumbnail($post->ID, $thumbsize).'</a></figure>';
									}
								$out .= '</div>';

							$out .= '</div>';
						$out .= '</div>';
					$out .= '</article>';
				} elseif(!$ignore_featured && rwmb_meta('brookside_post_featured', get_the_ID()) && $post_style == 'style_5' ){
					switch ($columns) {
						case 'span6':
							$cols = 'span8';
							$img_size = 'large';
							break;
						default:
							$cols = 'span6';
							$img_size = 'brookside-extra-medium';
							break;
					}
					$classes = str_replace('sticky ', '', $classes);
					$classes .= ' '.$cols;

					$out .= '<article class="post-featured post-featured-style5 '.$classes.'">';
						$out .= '<div class="post-content-container '.$text_align.'">';						
						$out .= '<div class="post-content">';
							$out .= '<div class="post-img-block">';
							$out .= brookside_get_post_format_content(false, $img_size);
							$out .= '</div>';
							$out .= '<div class="post-title-block">';
								$out .= '<header class="title">';
									$out .= '<h2><a href="'.get_the_permalink().'" title="'.esc_attr__('Permalink to', 'brookside').' '.esc_attr(the_title_attribute('echo=0')).'" rel="bookmark">'.get_the_title().'</a></h2>';
									$out .= '<div class="meta-info">';
										if( $display_categories ) $out .= '<div class="meta-categories">'.get_the_category_list(', ').'</div>';
										if( $display_date ) $out .= '<div class="meta-date"><span>X</span>'.get_the_time(get_option('date_format')).'</div>';
									$out .= '</div>';
								$out .= '</header>';
							$out .= '</div>';
							$out .= '<div class="post-content">';
								$featured_excerpt_size = apply_filters('brookside_featured_post_excerpt_count', '24');
								$out .= '<div class="post-excerpt">'.brookside_string_limit_words(get_the_content(), $featured_excerpt_size).'</div>';
							$out .= '</div>';
						$out .= '</div>';
						$out .= '</div>';
					$out .= '</article>';
				} elseif( $post_style == 'style_5' ){
					switch ($columns) {
						case 'span6':
							$cols = 'span4';
							break;
						default:
							$cols = 'span3';
							break;
					}
					$classes = str_replace('sticky ', '', $classes);
					$classes .= ' '.$cols;
					$out .= '<article class="post-size span3 '.$post_style.' '.$classes.'">';
						$out .= '<div class="post-content-container '.$text_align.'">';
							$out .= '<div class="post-img-block">';
							$out .= brookside_get_post_format_content(false, $thumbsize);
							$out .= '</div>';
							$out .= '<div class="post-content-block">';
							$out .= '<header class="title">';
								$out .= '<h2><a href="'.get_the_permalink().'" title="'.esc_attr__('Permalink to', 'brookside').' '.esc_attr(the_title_attribute('echo=0')).'" rel="bookmark">'.get_the_title().'</a></h2>';
								$out .= '<div class="meta-info">';
									if( $display_categories ) $out .= '<div class="meta-categories">'.get_the_category_list(', ').'</div>';
									if( $display_date ) $out .= '<div class="meta-date"><span>X</span>'.get_the_time(get_option('date_format')).'</div>';
								$out .= '</div>';
							$out .= '</header>';
							$out .= '<div class="post-content">';
								$out .= '<div class="post-excerpt">'.brookside_string_limit_words(get_the_content(), $excerpt_count).'</div>';
							$out .= '</div>';
							$out .= '</div>';
						$out .= '</div>';
					$out .= '</article>';
				} elseif( $post_style == 'style_2' || $post_style == 'style_3' ){
					$classes = str_replace('sticky ', '', $classes);
					if($post_style == 'style_3' ){
						static $i = 0;
						$i++;
						if($i % 2 == 0){
							$post_pos = 'even';
						} else {
							$post_pos = 'odd';
						}
					} else {
						$post_pos = '';
					}
					$out .= '<article class="post-size style_2 '.$post_pos.' span12 '.$classes.'">';
						$out .= '<div class="post-content-container '.$text_align.'">';
							$out .= '<div class="post-img-side">';
							$out .= brookside_get_post_format_content(false, $thumbsize);
							$out .= '</div>';
							$out .= '<div class="post-content-side">';
								$out .= '<header class="title">';
									$out .= '<h2><a href="'.get_the_permalink().'" title="'.esc_attr__('Permalink to', 'brookside').' '.esc_attr(the_title_attribute('echo=0')).'" rel="bookmark">'.get_the_title().'</a></h2>';
									$out .= '<div class="meta-info">';
										if( $display_categories ) $out .= '<div class="meta-categories">'.get_the_category_list(', ').'</div>';
										if( $display_date ) $out .= '<div class="meta-date"><span>X</span>'.get_the_time(get_option('date_format')).'</div>';
									$out .= '</div>';
								$out .= '</header>';
							$out .= '<div class="post-content">';
							
							$out .= '<div class="post-excerpt">'.BrooksideExcerpt($excerpt_count).'</div>';

							$out .= '</div>';
							if( $display_likes || $display_read_time || $display_views || (comments_open() && $display_comments)) {
								$out .= '<div class="post-meta footer-meta">';
								if( $display_likes ) $out .= '<div class="post-like">'.getPostLikeLink(get_the_ID()).'</div>';
								if( $display_read_time ) $out .= '<div class="post-read">'.brookside_calculate_reading_time().'</div>';
								if( $display_views ) $out .= '<div class="post-view">'.BrooksideGetPostViews(get_the_ID()).'</div>';
								if( comments_open() && $display_comments ){
									$out .= '<div class="meta-comment">'.BrooksideCommentsNumber( get_the_ID() ).'</div>';
								}
								$out .= '</div>';
							}
							$out .= '<div class="post-meta"><div class="meta">';
								$out .= '<div class="post-more"><a href="'.esc_url(get_the_permalink()).'" rel="bookmark"><i class="la la-long-arrow-right"></i></a></div>';
								if( function_exists('BrooksideSharebox') && get_theme_mod('brookside_single_post_meta_sharebox', true) ){
									$out .= BrooksideSharebox( get_the_ID() );
								}
							$out .= '</div></div>';
							$out .= '</div>';
						$out .= '</div>';
					$out .= '</article>';
				} elseif( $post_style == 'style_6' ) {
					$i++;				
					if(0 == $j % 3 && $j != 0) {
						if($j % 2 == 0 ){
							$blockclass = 'odd';
						} else {
							$blockclass = 'even';
						} 
						$out .= '</div><div class="nested-block '.$blockclass.'">';
					}
					$classes = str_replace('sticky ', '', $classes);
					if( ($blockclass == 'odd' && $i==1) || ($blockclass == 'even' && $i==3) ){
						
						if( $i== 1 ){
							$thumbsize_tmp = 'post-thumbnail';
						} else {
  							$thumbsize_tmp = 'large';	
						}
						
						$out .= '<article class="post-item-'.$i.' post-featured-style4 post-size '.$post_style.' '.$classes.'">';
						$out .= '<div class="post-content-container '.$text_align.'">';						
							$out .= '<div class="post-content">';
								$out .= '<div class="post-img-block">';
									if( has_post_thumbnail() ) {
										$out .= '<figure class="post-img"><a href="'.get_the_permalink().'" rel="bookmark">'.get_the_post_thumbnail($post->ID, $thumbsize_tmp).'</a></figure>';
									}
									$out .= '<div class="meta-over-img">';
									$out .= '<header class="title">';
										$out .= '<h2><a href="'.get_the_permalink().'" title="'.esc_attr__('Permalink to', 'brookside').' '.esc_attr(the_title_attribute('echo=0')).'" rel="bookmark">'.get_the_title().'</a></h2>';
										$out .= '<div class="meta-info">';
											if( $display_categories ) $out .= '<div class="meta-categories">'.get_the_category_list(', ').'</div>';
											if( $display_date ) $out .= '<div class="meta-date"><span>X</span>'.get_the_time(get_option('date_format')).'</div>';
										$out .= '</div>';
									$out .= '</header>';
									$out .= '</div>';
								$out .= '</div>';

							$out .= '</div>';
						$out .= '</div>';
					$out .= '</article>';
					} else {
						$out .= '<article class="post-size post-item-'.$i.' '.$post_style.' '.$classes.'">';
							$out .= '<div class="post-content-container '.$text_align.'">';
								$out .= '<div class="post-img-block">';
								$out .= brookside_get_post_format_content(false, $thumbsize);
								$out .= '</div>';
								$out .= '<div class="post-content-block">';
									$out .= '<header class="title">';
										$out .= '<h2><a href="'.get_the_permalink().'" title="'.esc_attr__('Permalink to', 'brookside').' '.esc_attr(the_title_attribute('echo=0')).'" rel="bookmark">'.get_the_title().'</a></h2>';
										$out .= '<div class="meta-info">';
											if( $display_categories ) $out .= '<div class="meta-categories">'.get_the_category_list(', ').'</div>';
											if( $display_date ) $out .= '<div class="meta-date"><span>X</span>'.get_the_time(get_option('date_format')).'</div>';
										$out .= '</div>';
									$out .= '</header>';
									$out .= '<div class="post-content">';
										$out .= '<div class="post-excerpt">'.BrooksideExcerpt($excerpt_count).'</div>';
										$out .= '<div class="post-more"><a href="'.esc_url(get_the_permalink()).'" rel="bookmark">'.esc_html__('Read More', 'brookside').'<i class="la la-arrow-right"></i></a></div>';
									$out .= '</div>';
								$out .= '</div>';
							$out .= '</div>';
						$out .= '</article>';
					}
					if($i >= 3 ) { 
						$i=0;
					}
					$j++;

				} else {
					$classes = str_replace('sticky ', '', $classes);
					if($post_style == 'style_4') {
						$post_style_tmp = 'style_4 style_1';
					} else {
						$post_style_tmp = $post_style;
					}
					$out .= '<article class="post-size '.$columns.' '.$post_style_tmp.' '.$classes.'">';
						$out .= '<div class="post-content-container '.$text_align.'">';
							$out .= '<div class="post-img-block">';
							$out .= brookside_get_post_format_content(false, $thumbsize);
							$out .= '</div>';
							$out .= '<div class="post-content-block">';
							$out .= '<header class="title">';
								$out .= '<h2><a href="'.get_the_permalink().'" title="'.esc_attr__('Permalink to', 'brookside').' '.esc_attr(the_title_attribute('echo=0')).'" rel="bookmark">'.get_the_title().'</a></h2>';
								$out .= '<div class="meta-info">';
									if( $display_categories ) $out .= '<div class="meta-categories">'.get_the_category_list(', ').'</div>';
									if( $display_date ) $out .= '<div class="meta-date"><span>X</span>'.get_the_time(get_option('date_format')).'</div>';
								$out .= '</div>';
							$out .= '</header>';
							$out .= '<div class="post-content">';
							
							$out .= '<div class="post-excerpt">'.BrooksideExcerpt($excerpt_count).'</div>';

							$out .= '</div>';
							if( $display_likes || $display_read_time || $display_views || (comments_open() && $display_comments) ) {
								$out .= '<div class="post-meta footer-meta">';
								if( $display_likes ) $out .= '<div class="post-like">'.getPostLikeLink(get_the_ID()).'</div>';
								if( $display_read_time ) $out .= '<div class="post-read">'.brookside_calculate_reading_time().'</div>';
								if( $display_views ) $out .= '<div class="post-view">'.BrooksideGetPostViews(get_the_ID()).'</div>';
								if( comments_open() && $display_comments ){
									$out .= '<div class="meta-comment">'.BrooksideCommentsNumber( get_the_ID() ).'</div>';
								}
								$out .= '</div>';
							}
							$out .= '</div>';
						$out .= '</div>';
					$out .= '</article>';
				}

			}
			if( $post_style == 'style_6'){
				$out .= '</div>';
			}
			$out .= '</div>';
		if( $pagination == 'true' && get_next_posts_link() ) {
			$out .= '<div id="pagination" class="hide">'.get_next_posts_link().'</div>';
			$out .= '<div class="loadmore-container"><a href="#" class="loadmore button"><span>'.esc_html__('Load More', 'brookside').'</span></a></div>';
		} elseif($pagination == 'standard') {
			$out .= '<div id="pagination">'.brookside_custom_pagination().'</div>';
		}
		$out .= '</div>';
			echo ''.$out;
		} else { ?>
				
				<h2><?php esc_html_e('Not Found', 'brookside') ?></h2>
				
			<?php } ?>
		</div>
	</div>

<?php if(get_theme_mod('brookside_sidebar_pos', 'none') != 'none' && is_active_sidebar('blog-widgets') ){
		get_sidebar();
	} 
?>
</div>

<?php get_footer(); ?>