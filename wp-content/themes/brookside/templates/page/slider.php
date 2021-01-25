<?php
	$post_ids = rwmb_meta('brookside_page_herosection_slider_posts');
	$post_count = rwmb_meta('brookside_page_herosection_slider_posts_count');
	$slideshow = rwmb_meta('brookside_page_herosection_slider_slideshow');
	$loop = rwmb_meta('brookside_page_herosection_slider_loop');
	$sliderwidth = 'fullwidth';
	$style = rwmb_meta('brookside_page_herosection_slider_style');
	$description_style = 'style_1';	
	$paddings = rwmb_meta('brookside_page_herosection_padding');
	$slider_height = '';
	$slider_height = rwmb_meta('brookside_page_slider_height');
	if( $slider_height != '' ){
		$slider_height = 'height:'.$slider_height.'px;';
	}
	$nav = 'false';
	$overlay = 'true';
	$thumbsize = rwmb_meta('brookside_page_herosection_slider_image_size');
	if( $thumbsize == '' ){
		$thumbsize = 'large';
	}
	$padding_css = '';
	if(!empty($paddings)){
		$padding_css .= !empty($paddings['top']) ? 'padding-top:'.$paddings['top'].'px;' : '';
		$padding_css .= !empty($paddings['right']) ? 'padding-right:'.$paddings['right'].'px;' : '';
		$padding_css .= !empty($paddings['bottom']) ? 'margin-bottom:'.$paddings['bottom'].'px;' : '';
		$padding_css .= !empty($paddings['left']) ? 'padding-left:'.$paddings['left'].'px;' : '';
	} 
	$slideby = '1';
	if( $style == 'center' ){
		$center = 'true';
		$items = '2';
		$margin = '40';
		$loop = 'true';
		$nav = 'true';
		$centerClass = 'post-slider-center';
	} elseif ($style == 'three_per_row') {
		$center = 'false';
		$items = $slideby = '3';
		$margin = '30';
		$centerClass = 'slider-three-per-row';
		$description_style = 'style_3';
	} else {
		$center = 'false';
		$items = '1';
		$centerClass = '';
		$margin = '0';
		if($sliderwidth == 'fullwidth'){
			$centerClass = 'post-slider-fullwidth';
		}
	}
	if( (int)$post_count <= 3 && $description_style == 'style_3') {
		$dots = 'false';
	} elseif( (int)$post_count < 2){
		$dots = 'false';
	} else {
		$dots = 'true';
	}
	$orderby = 'post__in';
	$post_type = ['post', 'page'];
	if(!is_array($post_ids)){
		$post_ids = trim($post_ids);
		$post_ids = explode(',', $post_ids);
		$orderby = 'post__in';
		$post_type = array('post', 'page');
	}
	if(empty($post_ids)){
		$post_ids = array();
		$orderby = 'date';
	}
	$args = array(
	    'post_type' => $post_type,
	    'posts_per_page' => $post_count,
		'post__in' => $post_ids,
	    'order' => 'DESC',
	    'orderby' => $orderby,
	    'post_status' => 'publish',
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
		$owl_custom = 'jQuery(window).load(function(){
				"use strict";
				setTimeout(function(){var owl = jQuery("#post-slider-blog").owlCarousel(
				    {
				        items: '.$items.',
				        center: '.$center.',
				        margin: '.$margin.',
				        slideBy: '.$slideby.',
				        dots: '.$dots.',
				        nav: '.$nav.',
				        navText: [\'<i class="la la-arrow-left"></i>\',\'<i class="la la-arrow-right"></i>\'],
				        autoplay: '.$slideshow.',
				        responsiveClass:true,
				        loop: '.$loop.',
				        smartSpeed: 450,
				        autoHeight: true,
				        autoWidth:'.$center.',
				        autoplayTimeout:6000,
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
		$out .= '<div id="post-slider-blog" class="owl-carousel post-slider '.$style.' '.$centerClass.' '.$sliderwidth.' post_more_'.$description_style.'" style="'.esc_attr($padding_css).'">';
		static $post_count = 0;
		while( $the_query->have_posts() ) {
			$the_query->the_post();
			$out .= '<div class="post-slider-item">';
				if( has_post_thumbnail() ) {
						$out .= '<figure class="post-img"><a href="'.esc_url(get_the_permalink()).'" rel="bookmark">';
						if( $overlay == 'true' ){
							$out .= '<div class="overlay"></div>';
						}
						$out .= '<img src="'.get_the_post_thumbnail_url($post->ID, $thumbsize).'" style="'.esc_attr($slider_height).'" alt="slider image"></a></figure>';
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
		echo ''.$out;
		wp_reset_postdata();
	}
?>