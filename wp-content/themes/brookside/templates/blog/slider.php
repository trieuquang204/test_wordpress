<?php
	$post_ids = get_theme_mod('brookside_home_slider_posts','');
	$slideshow = get_theme_mod('brookside_home_slider_slideshow','true');
	$loop = get_theme_mod('brookside_home_slider_loop','false');
	$sliderwidth = get_theme_mod('brookside_home_slider_width', 'fullwidth');
	$style = get_theme_mod('brookside_home_slider_style', 'simple');
	$description_style = 'style_1';
	$nav = 'false';
	if($loop){
		$loop = 'true';
	} else {
		$loop = 'false';
	}
	$paddings = array();
	$paddings['top'] = get_theme_mod('brookside_home_hero_section_padtop', '');
	$paddings['right'] = get_theme_mod('brookside_home_hero_section_padright', '');
	$paddings['bottom'] = get_theme_mod('brookside_home_hero_section_padbottom', '');
	$paddings['left'] = get_theme_mod('brookside_home_hero_section_padleft', '');
	$overlay = get_theme_mod('brookside_home_slider_overlay', 1);
	$show_date = get_theme_mod('brookside_home_slider_show_date', 1);
	$readmore = get_theme_mod('brookside_home_slider_readmore', false);
	$meta_categories = get_theme_mod('brookside_home_slider_meta_categories', 1);
	$slider_height = get_theme_mod('brookside_home_slider_height', '');
	$orderby = get_theme_mod('brookside_home_slider_orderby', 'date');
	$dots = get_theme_mod('brookside_home_slider_dots', 'true');
	$slider_height_style = '';
	if($slider_height != ''){
		$slider_height_style = 'height:'.$slider_height.'px;';
	}
	$padding_css = '';
	if(!empty($paddings)){
		$padding_css .= !empty($paddings['top']) ? 'padding-top:'.$paddings['top'].'px;' : '';
		$padding_css .= !empty($paddings['right']) ? 'padding-right:'.$paddings['right'].'px;' : '';
		$padding_css .= !empty($paddings['bottom']) ? 'margin-bottom:'.$paddings['bottom'].'px;' : '';
		$padding_css .= !empty($paddings['left']) ? 'padding-left:'.$paddings['left'].'px;' : '';
	}
	$thumbsize = 'large';

	if( $style == 'center' ){
		$center = 'true';
		$items = '2';
		$margin = '40';
		$loop = 'true';
		$nav = 'true';
		$centerClass = 'post-slider-center';
	} elseif ($style == 'three_per_row') {
		$center = 'false';
		$items = '3';
		$margin = '30';
		$centerClass = 'slider-three-per-row';
		$description_style = 'style_3';
	} else {
		$center = 'false';
		$items = '1';
		$centerClass = '';
		$margin = '0';
		if($sliderwidth == 'fullwidth'){
			$thumbsize = 'brookside-fullwidth-slider';
		}
	}
	if(!is_array($post_ids) && strlen($post_ids)){
		$post_ids = trim($post_ids);
		$post_ids = explode(',', $post_ids);
		$post_type = array('post', 'page');
	} elseif( !empty($post_ids)){
		
	} else {
		$post_ids = array();
		$post_type = 'post';
	}
	$args = array(
	    'post_type' => $post_type,
	    'posts_per_page' => get_theme_mod('brookside_home_slides_count','3'),
		'post__in' => $post_ids,
	    'order'          => 'DESC',
	    'orderby'        => $orderby,
	    'post_status'    => 'publish',
	    'post__not_in' => get_option( 'sticky_posts' ),
	    'meta_query' => array(
	        array(
	         'key' => '_thumbnail_id',
	         'compare' => 'EXISTS'
	        )
	    )
    ); 
    $out = '';
	$the_query = new WP_Query( $args );
	if( $the_query->have_posts() ) {
		wp_enqueue_script('owl-carousel');
		wp_enqueue_style( 'owl-carousel' );
		$owl_custom = 'jQuery(document).ready(function($){
				"use strict";
				setTimeout(function(){var owl = $("#post-slider-blog").owlCarousel(
				    {
				        items: '.$items.',
				        center: '.$center.',
				        margin: '.$margin.',
				        dots: '.$dots.',
				        nav: '.$nav.',
				        navText: [\'<i class="la la-arrow-left"></i>\',\'<i class="la la-arrow-right"></i>\'],
				        autoplay: '.$slideshow.',
				        responsiveClass:true,
				        loop: '.$loop.',
				        smartSpeed: 450,
				        autoHeight: false,
				        autoWidth:'.$center.',
				        themeClass: "owl-post-slider",';
				    if($style == 'three_per_row'){
				    	$owl_custom .= 'responsive:{
				            0:{
				                items:1,
				            },
				            782:{
				                items:2,
				            },
				            960:{
				                items:3
				            }
				        }';
				    }
				    $owl_custom .= '});
			}, 100);
				
			});';
			wp_add_inline_script('owl-carousel', $owl_custom);
		if($sliderwidth == 'container'){ $out .= '<div id="blog-page-slider" class="container"><div class="span12">'; }
		$out .= '<div id="post-slider-blog" class="owl-carousel post-slider '.$style.' '.$centerClass.' '.$sliderwidth.' post_more_'.$description_style.'" style="'.esc_attr($padding_css).'">';
		static $post_count = 0;
		while( $the_query->have_posts() ) {
			$the_query->the_post();
			$out .= '<div class="post-slider-item">';
				if( has_post_thumbnail() ) {
						$out .= '<figure class="post-img"><a href="'.esc_url(get_the_permalink()).'" rel="bookmark">';
						if( $overlay ){
							$out .= '<div class="overlay"></div>';
						}
						$out .= '<img src="'.get_the_post_thumbnail_url($post->ID, $thumbsize).'" style="height:'.esc_attr($slider_height).'px" alt="slider image"></a></figure>';
					}
				$out .= '<div class="post-more '.$description_style.'">';
				$out .= '<div class="top-right-br"></div>';
				$out .= '<div class="post-more-inner">';
					if( $description_style == 'style_3' ){
						$out .= '<div class="meta-categories">'.get_the_category_list(', ').'</div>';
					}
					$out .= '<h3><a href="'.get_the_permalink().'" title="'.esc_attr__('Permalink to', 'brookside').' '.esc_attr(the_title_attribute('echo=0')).'" rel="bookmark">'.esc_attr(get_the_title()).'</a></h3>';
				$out .= '</div>';
				$out .= '<div class="bottom-right-br"></div>';
				$out .= '</div>';
			$out .= '</div>';
		}
		$out .= '</div>';
		if($sliderwidth == 'container' ){ $out .= '</div></div>'; }
		echo ''.$out;
		wp_reset_postdata();
	}
?>