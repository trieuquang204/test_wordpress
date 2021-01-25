<?php
/**
 * Plugin Name: Brookside Elements
 * Description: This plugin is required for use with Brookside theme. It gathers all shortcodes and elements from Brookside theme. It gives a possibility to keep this content data even if you switch the theme to another one. This is a part of new Envato requirements for WordPress theme developers.
 * Version: 1.2.2
 * Author: Artstudioworks
 * Author URI: http://themeforest.net/user/artstudioworks/portfolio
 * Text Domain: brookside-elements
 * Domain Path: /languages
*/

add_action( 'plugins_loaded', 'brookside_plugin_load_textdomain' );
/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function brookside_plugin_load_textdomain() {
  load_plugin_textdomain( 'brookside-elements', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

$dir = plugin_dir_path( __FILE__ );
define( 'BROOKSIDE_PLUGIN_URL',  plugin_dir_url( __FILE__ ) );
define( 'BROOKSIDE_PLUGIN_PATH',  plugin_dir_path( __FILE__ ) );
include_once ( trailingslashit( $dir ).'inc/update.php' );
include_once ( trailingslashit( $dir ).'inc/shortcodes.php' );
include_once ( trailingslashit( $dir ).'inc/post-like/post-like-core.php' );//post like features
include_once ( trailingslashit( $dir ).'inc/post-view/post-view.php' );//post view features
//iclude widgets
include_once(trailingslashit( $dir ).'inc/widgets/twitter.php' );
include_once(trailingslashit( $dir ).'inc/widgets/socials.php'); // add socials widget
include_once(trailingslashit( $dir ).'inc/widgets/aboutme.php'); // add aboutMe widget
include_once(trailingslashit( $dir ).'inc/widgets/recentposts.php'); // add grid posts widget
include_once(trailingslashit( $dir ).'inc/widgets/bannerspot.php'); // add banner spot widget
include_once(trailingslashit( $dir ).'inc/widgets/latestposts.php'); // add latest posts widget
include_once(trailingslashit( $dir ).'inc/widgets/sliderposts.php'); // add slider posts widget
include_once(trailingslashit( $dir ).'inc/widgets/instagram.php'); // add instagram widget
include_once(trailingslashit( $dir ).'inc/widgets/subscribe.php'); // add instagram widget
include_once(trailingslashit( $dir ).'inc/widgets/map.php'); // add map widget
include_once(trailingslashit( $dir ).'inc/widgets/page_link.php' );
include_once(trailingslashit( $dir ).'inc/widgets/youtube_channel.php' );
/* Include Meta Box Script */
include_once(trailingslashit( $dir ).'inc/meta-boxes.php');

/* Include gutenberg blocks */
if( function_exists('register_block_type') ){
	include_once(trailingslashit($dir).'inc/gutenberg/gutenberg-blocks.php');
}
$pluginList = get_option( 'active_plugins' );
$js_composer = 'js_composer/js_composer.php'; 
if ( !in_array( $js_composer , $pluginList ) ) {
    // Plugin 'mg-post-contributors' is Active
    include_once( trailingslashit( $dir ).'inc/vc-google-font.php');
}

if(in_array( $js_composer , $pluginList )) {
	function brookside_deactivate_vc_notice() {
	    if(is_admin()) {
	        setcookie('vchideactivationmsg', '1', strtotime('+3 years'), '/');
	        setcookie('vchideactivationmsg_vc11', (defined('WPB_VC_VERSION') ? WPB_VC_VERSION : '1'), strtotime('+3 years'), '/');
	    }
	}
	add_action('admin_init', 'brookside_deactivate_vc_notice');
	include_once( trailingslashit( $dir ).'inc/vc-shortcodes.php');
}
$revslider = 'revslider/revslider.php';
if ( in_array( $revslider , $pluginList ) ) {
	add_action( 'admin_init', 'brookside_disable_revslider_notice' );
	function brookside_disable_revslider_notice() {
		update_option( 'revslider-valid-notice', 'false' );
	}
}

function brookside_shortcodes_scripts() {  
	wp_register_script('owl-carousel', BROOKSIDE_PLUGIN_URL . 'js/owl.carousel.min.js', array('jquery'), '2.3.4', TRUE);
	wp_register_script('isotope', BROOKSIDE_PLUGIN_URL . 'js/isotope.min.js', array('jquery'), '3.0.0', true);
}
add_action( 'wp_enqueue_scripts', 'brookside_shortcodes_scripts' );
function brookside_shortcodes_styles() {  
	wp_register_style( 'owl-carousel', BROOKSIDE_PLUGIN_URL . 'css/owl.carousel.css', array(), '2.3.4', 'all' );
}
add_action( 'wp_enqueue_scripts', 'brookside_shortcodes_styles', 5);

if( function_exists('register_block_type') ){
	function brookside_gutenberg_editor_styles() {
		wp_enqueue_style( 'brookside-blocks-grid', BROOKSIDE_PLUGIN_URL . 'inc/gutenberg/css/grid.css');
	    wp_enqueue_style( 'brookside-blocks-style', BROOKSIDE_PLUGIN_URL . 'inc/gutenberg/css/style.css');
	    wp_enqueue_style( 'brookside-blocks-lineawesome', BROOKSIDE_PLUGIN_URL . 'inc/gutenberg/fonts/line-awesome/css/line-awesome.min.css');
	    wp_enqueue_style( 'brookside-blocks-fontawesome', BROOKSIDE_PLUGIN_URL . 'inc/gutenberg/fonts/font-awesome/css/font-awesome.min.css');
	}
	add_action( 'enqueue_block_editor_assets', 'brookside_gutenberg_editor_styles', 100 );
}

function brookside_admin_scripts( $hook ) {
    global $post;
    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( 'post' === $post->post_type ) {     
            wp_enqueue_script(  'brookside-post-formats-select', BROOKSIDE_PLUGIN_URL . 'js/post-formats-select.js', array('jquery'), '1.0.0', true );
        }
    }
}
add_action( 'admin_enqueue_scripts', 'brookside_admin_scripts', 10, 1 );

function catch_og_image() {
	global $post, $posts;
	$first_img = '';
	if (has_post_thumbnail()) {
		$first_img = get_the_post_thumbnail_url(get_the_id(), 'post-thumbnail');
	}
	return $first_img;
}
if(!function_exists('BrooksideSharebox')){
	function BrooksideSharebox($postID, $echo = false){
		if(is_single()){
			$permalink = esc_url(get_permalink($postID));
			$title = esc_attr(get_the_title($postID));
			$description = esc_attr(get_the_excerpt($postID));
		} else if(is_front_page()){
			$permalink = esc_url(home_url());
			$title = esc_attr(get_bloginfo('name'));
			$description = esc_attr(get_bloginfo('description'));
		} else {
			$permalink = esc_url(get_permalink($postID));
			$title = esc_attr(get_the_title($postID));
			$description = esc_attr(get_the_excerpt($postID));
		}

		$out = '<div class="sharebox">';
			$out .= '<div class="social-icons">';
				$out .= '<span class="show-sharebox-icons"><i class="la la-share-alt"></i></span>';
				$out .= '<ul class="unstyled">';
					if( get_theme_mod('brookside_sharing_facebook',true) ) $out .= '<li class="social-facebook"><a href="//www.facebook.com/sharer.php?u='.esc_url($permalink).'&amp;t='.str_replace(' ', '+', $title).'" title="'.esc_html__( 'Share to Facebook', 'brookside-elements').'" target="_blank"><i class="fa fa-facebook"></i></a></li>';
					if( get_theme_mod('brookside_sharing_twitter',true) ) $out .= '<li class="social-twitter"><a href="//twitter.com/intent/tweet?text='.str_replace(' ', '+', $title).'&url='.esc_url($permalink).'" title="'.esc_html__( 'Share to Twitter', 'brookside-elements').'" target="_blank"><i class="fa fa-twitter"></i></a></li>';	
					if( get_theme_mod('brookside_sharing_pinterest',true) ) $out .= '<li class="social-pinterest"><a href="//pinterest.com/pin/create/link/?url='.esc_url($permalink).'&amp;media='.wp_get_attachment_url( get_post_thumbnail_id($postID) ).'&amp;description='.str_replace(" ", "+", $description).'" title="'.esc_html__( 'Share to Pinterest', 'brookside-elements').'" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>';
					if( get_theme_mod('brookside_sharing_linkedin',false) ) $out .= '<li class="social-linkedin"><a href="http://linkedin.com/shareArticle?mini=true&amp;url='.esc_url($permalink).'&amp;title='.str_replace(' ', '+', $title).'" title="'.esc_html__( 'Share to LinkedIn', 'brookside-elements').'" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
					if( get_theme_mod('brookside_sharing_googleplus',false) ) $out .= '<li class="social-googleplus"><a href="http://plus.google.com/share?url='.esc_url($permalink).'&amp;title='.str_replace(' ', '+', $title).'" title="'.esc_html__( 'Share To Google+', 'brookside-elements').'" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
					if( get_theme_mod('brookside_sharing_email',false) ) $out .= '<li class="social-email"><a href="mailto:?subject='.str_replace(' ', '+', $title).'&amp;body='.esc_url($permalink).'" title="'.esc_html__( 'Share with E-Mail', 'brookside-elements').'" target="_blank"><i class="fa fa-envelope"></i></a></li>';
				$out .= '</ul>';
			$out .= '</div>';
		$out .= '</div>';
		if($echo){
			echo $out;
		} else {
			return $out;
		}
	}
}
if(!function_exists('BrooksideShareboxProduct')){
	function BrooksideShareboxProduct(){
		$postID = get_the_ID();

		$permalink = esc_url(get_permalink($postID));
		$title = esc_attr(get_the_title($postID));
		$description = esc_attr(get_the_excerpt($postID));

		$out = '<div class="sharebox">';
			$out .= '<div class="social-icons">';
				$out .= '<ul class="unstyled">';
					if( get_theme_mod('brookside_sharing_facebook',true) ) $out .= '<li class="social-facebook"><a href="//www.facebook.com/sharer.php?u='.esc_url($permalink).'&amp;t='.str_replace(' ', '+', $title).'" title="'.esc_html__( 'Share to Facebook', 'brookside-elements').'" target="_blank"><i class="fa fa-facebook"></i></a></li>';
					if( get_theme_mod('brookside_sharing_twitter',true) ) $out .= '<li class="social-twitter"><a href="//twitter.com/intent/tweet?text='.str_replace(' ', '+', $title).'&url='.esc_url($permalink).'" title="'.esc_html__( 'Share to Twitter', 'brookside-elements').'" target="_blank"><i class="fa fa-twitter"></i></a></li>';	
					if( get_theme_mod('brookside_sharing_pinterest',true) ) $out .= '<li class="social-pinterest"><a href="//pinterest.com/pin/create/link/?url='.esc_url($permalink).'&amp;media='.wp_get_attachment_url( get_post_thumbnail_id($postID) ).'&amp;description='.str_replace(" ", "+", $description).'" title="'.esc_html__( 'Share to Pinterest', 'brookside-elements').'" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>';
					if( get_theme_mod('brookside_sharing_linkedin',false) ) $out .= '<li class="social-linkedin"><a href="http://linkedin.com/shareArticle?mini=true&amp;url='.esc_url($permalink).'&amp;title='.str_replace(' ', '+', $title).'" title="'.esc_html__( 'Share to LinkedIn', 'brookside-elements').'" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
					if( get_theme_mod('brookside_sharing_googleplus',false) ) $out .= '<li class="social-googleplus"><a href="http://plus.google.com/share?url='.esc_url($permalink).'&amp;title='.str_replace(' ', '+', $title).'" title="'.esc_html__( 'Share To Google+', 'brookside-elements').'" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
					if( get_theme_mod('brookside_sharing_email',false) ) $out .= '<li class="social-email"><a href="mailto:?subject='.str_replace(' ', '+', $title).'&amp;body='.esc_url($permalink).'" title="'.esc_html__( 'Share with E-Mail', 'brookside-elements').'" target="_blank"><i class="fa fa-envelope"></i></a></li>';
				$out .= '</ul>';
			$out .= '</div>';
		$out .= '</div>';

		echo $out;
	}
}
if(!function_exists('BrooksideStickySharebox')){
	function BrooksideStickySharebox($postID, $echo = false){
		if(is_single()){
			$permalink = esc_url(get_permalink($postID));
			$title = esc_attr(get_the_title($postID));
			$description = esc_attr(get_the_excerpt($postID));
		} else if(is_front_page()){
			$permalink = esc_url(home_url());
			$title = esc_attr(get_bloginfo('name'));
			$description = esc_attr(get_bloginfo('description'));
		} else {
			$permalink = esc_url(get_permalink($postID));
			$title = esc_attr(get_the_title($postID));
			$description = esc_attr(get_the_excerpt($postID));
		}

		$out = '<div class="sharebox sharebox-sticky">';
			$out .= '<div class="social-icons">';
				$out .= '<ul class="unstyled">';
					if( get_theme_mod('brookside_sharing_facebook',true) ) $out .= '<li class="social-facebook"><a href="//www.facebook.com/sharer.php?u='.esc_url($permalink).'&amp;t='.str_replace(' ', '+', $title).'" title="'.esc_html__( 'Share to Facebook', 'brookside-elements').'" target="_blank"><i class="fa fa-facebook"></i></a></li>';
					if( get_theme_mod('brookside_sharing_twitter',true) ) $out .= '<li class="social-twitter"><a href="//twitter.com/intent/tweet?text='.str_replace(' ', '+', $title).'&url='.esc_url($permalink).'" title="'.esc_html__( 'Share to Twitter', 'brookside-elements').'" target="_blank"><i class="fa fa-twitter"></i></a></li>';	
					if( get_theme_mod('brookside_sharing_pinterest',true) ) $out .= '<li class="social-pinterest"><a href="//pinterest.com/pin/create/link/?url='.esc_url($permalink).'&amp;media='.wp_get_attachment_url( get_post_thumbnail_id($postID) ).'&amp;description='.str_replace(" ", "+", $description).'" title="'.esc_html__( 'Share to Pinterest', 'brookside-elements').'" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>';
					if( get_theme_mod('brookside_sharing_linkedin',false) ) $out .= '<li class="social-linkedin"><a href="http://linkedin.com/shareArticle?mini=true&amp;url='.esc_url($permalink).'&amp;title='.str_replace(' ', '+', $title).'" title="'.esc_html__( 'Share to LinkedIn', 'brookside-elements').'" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
					if( get_theme_mod('brookside_sharing_googleplus',false) ) $out .= '<li class="social-googleplus"><a href="http://plus.google.com/share?url='.esc_url($permalink).'&amp;title='.str_replace(' ', '+', $title).'" title="'.esc_html__( 'Share To Google+', 'brookside-elements').'" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
					if( get_theme_mod('brookside_sharing_email',false) ) $out .= '<li class="social-email"><a href="mailto:?subject='.str_replace(' ', '+', $title).'&amp;body='.esc_url($permalink).'" title="'.esc_html__( 'Share with E-Mail', 'brookside-elements').'" target="_blank"><i class="fa fa-envelope"></i></a></li>';
				$out .= '</ul>';
			$out .= '</div>';
		$out .= '</div>';
		if($echo){
			echo $out;
		} else {
			return $out;
		}
	}
}

if(!function_exists('brookside_get_the_content')){
	function brookside_get_the_content() {
		$content = get_the_content();
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		return $content;
	}
}
if( !function_exists('brookside_get_post_format_content') ){
	function brookside_get_post_format_content($echo = true, $img_size) {
		$post_format = get_post_format();
		global $post;
		global $_wp_additional_image_sizes;
		if(!$img_size){
			$img_size = 'post-thumbnail';
		}
		$out = '';
		$width  = get_option( "{$img_size}_size_w" );
		$height = get_option( "{$img_size}_size_h" );
		if( isset($_wp_additional_image_sizes["{$img_size}"]) && (!$width || !$height)){
			$width = $_wp_additional_image_sizes["{$img_size}"]['width'];
			$height = $_wp_additional_image_sizes["{$img_size}"]['height'];
		}
		if( !$width || !$height || $img_size == 'brookside-masonry'){
			$proportions = '56.25';
		} else {
			$proportions = ($height/$width) * 100;
		}
		switch ($post_format) {
			case 'gallery':
				$autoplay = rwmb_get_value('brookside_gallery_autoplay', $post->ID);
				$loop = rwmb_get_value('brookside_gallery_loop', $post->ID);
				if(!$img_size) {
					$img_size = 'medium';
				}
				if($autoplay ){
					$autoplay = 'true';
				} else {
					$autoplay = 'false';
				}
				if($loop) {
					$loop = 'true';
				} else {
					$loop = 'false';
				}
				$id = rand(1, 999);
				$images = rwmb_get_value( 'brookside_gallery_images', 'type=image&size='.$img_size, $post->ID );
				if ( !empty($images) ){
					$owl_custom = 'jQuery(window).load(function(){
						var owl = jQuery(".preview-post-gallery'.$id.'").owlCarousel({
				            items:1,
				            autoplay:'.$autoplay.',
				            singleItem:true,
				            loop:'.$loop.',
				            nav:true,
				            navRewind:false,
				            navText: [ \'<i class="la la-angle-left"></i>\',\'<i class="la la-angle-right"></i>\' ],
				            dots:false,
				            autoHeight: true,
				            themeClass: "owl-gallery"
		    			});	
					});';
					wp_add_inline_script('owl-carousel', $owl_custom);
					wp_add_inline_script('image-lightbox', 'jQuery(document).ready( function($){ $( \'a[data-lightbox="lightbox-gallery'.$id.'"]\' ).lightbox(); });');
					$out .= '<div class="preview-post-gallery'.$id.' slideshow_2">';
					foreach( $images as $image ) :
						$out .= '<div><a href="'.esc_url($image['full_url']).'" data-lightbox="lightbox-gallery'.$id.'" data-caption="'.esc_attr($image['caption']).'"><img src="'.esc_url($image['url']).'" alt="'.esc_attr($image['alt']).'" /></a></div>';
					endforeach;
					$out .= '</div>';
				} elseif( has_post_thumbnail() ) {
					$out .= '<figure class="post-img"><a href="'.esc_url(get_the_permalink()).'" rel="bookmark">'.get_the_post_thumbnail($post->ID, $img_size).'</a></figure>';
				}
				break;
			case 'video':
				$media = rwmb_meta('brookside_post_format_video', $post->ID);
				$url = rwmb_get_value( 'brookside_post_format_video', $post->ID );
				$proportions_supports = array('cloudup','collegehumor', 'funnyordie', 'flickr', 'youtube', 'dailymotion', 'vimeo', 'ted', 'videopress', 'vine', 'wordpress.tv');
				$check = false;
				foreach ($proportions_supports as $site) {
					if( strpos( $media, $site ) ){
						$check = true;
					}
				}
				if( $media && $url != '' ) {
					if($check){
						$out = '<div class="video-container" style="padding-bottom:'.$proportions.'%">'.$media.'</div>';
					} else {
						$out = '<div class="iframe-container">'.$media.'</div>';
					}
				} elseif( has_post_thumbnail() ) {
					$out .= '<figure class="post-img"><a href="'.esc_url(get_the_permalink()).'" rel="bookmark">'.get_the_post_thumbnail($post->ID, $img_size).'</a></figure>';
				}
				break;
			case 'audio':
				$media = rwmb_get_value('brookside_post_format_audio', $post->ID);
				$url = rwmb_get_value( 'brookside_post_format_audio', $post->ID );
				$media_sites = array('soundcloud', 'mixcloud', 'reverbnation', 'spotify');
				$check = false;
				global $wp_embed;
				if( $media && $url != '' ){
					foreach ($media_sites as $site) {
						if( strpos( $media, $site ) ){
							$check = true;
						}
					}
					if($check){
						$out = '<div class="video-container" style="padding-bottom:'.$proportions.'%">'.$wp_embed->run_shortcode("[embed]".$media."[/embed]").'</div>';
					} else {
						if( has_post_thumbnail() ){
							$out = '<div class="audio-block">';
							$out .= '<figure class="post-img"><a href="'.esc_url(get_the_permalink()).'" rel="bookmark">'.get_the_post_thumbnail($post->ID, $img_size).'</a></figure>';
							$out .= '<div class="audio-overlay">'.do_shortcode('[audio src="'.$media.'" loop="off" autoplay="0" preload="none"]').'</div>';
							$out .= '</div>';
						} else {
							$out = do_shortcode('[audio src="'.$media.'" loop="off" autoplay="0" preload="none"]');
						}
					}
					
				} elseif( has_post_thumbnail() ) {
					$out .= '<figure class="post-img"><a href="'.esc_url(get_the_permalink()).'" rel="bookmark">'.get_the_post_thumbnail($post->ID, $img_size).'</a></figure>';
				}
				break;
			case 'link':
				$link = rwmb_get_value( 'brookside_post_format_link' );
				$title = rwmb_get_value( 'brookside_post_format_link_title' );
				if(is_array($title)){
					$title = $title[0];
				}
				if(is_array($link)){
					$link = $link[0];
				}
				if($title == '') {
					$title = $link;
				}
				if ( $link != '' && has_post_thumbnail() ){
					$out = '<figure class="post-img"><a class="overlay-link" href="'.esc_url($link).'" rel="bookmark"><h2>'.$title.'</h2></a>'.get_the_post_thumbnail($post->ID, $img_size).'</figure>';
				} elseif( has_post_thumbnail() ) {
					$out = '<figure class="post-img">'.get_the_post_thumbnail($post->ID, $img_size).'</figure>';
				}
				break;
			case 'quote':
				$text = rwmb_get_value( 'brookside_post_format_quote_text', $post->ID );
				if ( $text != '' ){
					$cite = rwmb_get_value( 'brookside_post_format_quote_cite', $post->ID );
					$text_color = rwmb_get_value( 'brookside_post_format_quote_text_color', $post->ID );
					$bg_color = rwmb_get_value( 'brookside_post_format_quote_bg_color', $post->ID );
					$style = $style_cite = '';
					if($text_color){
						$style .= $style_cite = 'color:'.$text_color.';';
					}
					if($bg_color) {
						$style .= 'background-color:'.$bg_color.';';
					}
					$out = '<blockquote style="'.$style.'">';
					$out .= '<p class="mb0">'.esc_html($text).'</p>';
					if($cite){
						$out .='<cite style="'.$style_cite.'">'.esc_html($cite).'</cite>';
					}
					$out .= '</blockquote>';
					
				} elseif( has_post_thumbnail() ) {
					$out = '<figure class="post-img"><a href="'.esc_url(get_the_permalink()).'" rel="bookmark">'.get_the_post_thumbnail($post->ID, $img_size).'</a></figure>';
				}
				break;
			default:
				$media = rwmb_get_value( 'brookside_post_format_embed', $post->ID );
				$url = rwmb_get_value( 'brookside_post_format_embed', $post->ID );
				$proportions_supports = array('cloudup','collegehumor', 'funnyordie', 'flickr', 'youtube', 'dailymotion', 'vimeo', 'ted', 'videopress', 'vine', 'wordpress.tv');
				$check = false;
				foreach ($proportions_supports as $site) {
					if(!is_array($media)){
						if( strpos( $media, $site ) ){
							$check = true;
						}
					}
					
				}
				if($media && $url != '') {
					if($check){
						$out = '<div class="video-container" style="padding-bottom:'.$proportions.'%">'.$media.'</div>';
					} else {
						$out = '<div class="iframe-container">'.$media.'</div>';
					}
				} elseif( has_post_thumbnail() ){
					$out = '<figure class="post-img"><a href="'.esc_url(get_the_permalink()).'" rel="bookmark">'.get_the_post_thumbnail($post->ID, $img_size).'</a></figure>';
				}
				break;
		}
			$show_post_format = rwmb_get_value('brookside_display_featured_img_instead', $post->ID);
			if( $show_post_format === 'true' ){
				$show_post_format = get_theme_mod('brookside_display_featured_img_preview', true);
			}
			if( $show_post_format === '1' || $show_post_format === true || $show_post_format === 'true' ){
				if( has_post_thumbnail() ){
					$out = '<figure class="post-img"><a href="'.esc_url(get_the_permalink()).'" rel="bookmark">'.get_the_post_thumbnail($post->ID, $img_size).'</a></figure>';
				} else {
					$out = '';
				}
			}
		if( $echo ){
			echo $out;
		} else {
			return $out;
		}
	}
}

if(!function_exists('brookside_post_has_more_link')){
	function brookside_post_has_more_link( $post_id ) {
		$post = get_post( $post_id );
		$content = $post->post_content;
		$data_array = get_extended( $content );
		return '' !== $data_array['extended'];
	}
}
if(!function_exists('brookside_custom_pagination')){
  function brookside_custom_pagination($pages = '', $range = 4) {
  	$showitems = ($range * 2)+1;
    $out ='';

    global $paged;
	if(empty($paged)) $paged = 1;

    if($pages == '') {
      global $wp_query;
      $pages = $wp_query->max_num_pages;
      if(!$pages) {
        $pages = 1;
      }
    }
    
    if(1 != $pages) {
    	$out .= '<div class="pagination-numbers">';
	    	$paged_t = $paged < 10 ? '0'.$paged : $paged;
	    	$out .= "<span class=\"current\">".$paged_t."</span>";
	    	$pages_t = $pages < 10 ? '0'.$pages : $pages;
			$out .= "<a href='".get_pagenum_link($pages)."' class=\"inactive\">/ ".$pages_t."</a>";
		$out .= '</div>';
		$out .= '<div class="pagination-arrows">';
			if($paged > 1) {
				$out .= get_previous_posts_link('<i class="la la-angle-left"></i>');
			} else {
				$out .= '<span class="previous"><i class="la la-angle-left"></i></span>';
			}
			if ($paged < $pages) {
				$out .= get_next_posts_link('<i class="la la-angle-right"></i>');
			} else {
				$out .= '<span class="next"><i class="la la-angle-right"></i></span>';
			}
		$out .= '</div>';
		if( get_theme_mod('brookside_view_more_url', '') != '' ){
			$view_more_url = get_theme_mod('brookside_view_more_url', '');
		} else {
			$view_more_url = get_next_posts_page_link();
		}
		$out .= '<div class="pagination-view-all"><a href="'.esc_url($view_more_url).'">'.esc_html__('View More', 'brookside-elements').'</a></div>';
		
    }
    return $out;
  }
}
if(!function_exists('BrooksideCommentsNumber')){
	function BrooksideCommentsNumber($postID, $echo = false){
		if( get_theme_mod('brookside_single_disable_comments', false ) ){
			return;
		}
		$num_comments = get_comments_number($postID);
		if ( comments_open() ) {
			if ( $num_comments == 0 ) {
				$comments = esc_html__('0 Comment', 'brookside-elements');
			} elseif ( $num_comments > 1 ) {
				$comments = $num_comments .' '. esc_html__('Comments', 'brookside-elements');
			} else {
				$comments = esc_html__('1 Comment', 'brookside-elements');
			}
			$write_comments = '<a href="' . get_comments_link($postID) .'"><span>'. $comments.'</span></a>';
		} else {
			$write_comments =  '<span><span>'.esc_html__('Comments disabled.', 'brookside-elements').'</span></span>';
		}
		if($echo){
			echo $write_comments;
		} else {
			return $write_comments;
		}
	}
	add_filter( 'BrooksideCommentsNumber', 'BrooksideCommentsNumber' );
}
if(!function_exists('brookside_calculate_reading_time')){
	function brookside_calculate_reading_time($postID = false, $echo = false) {
		$wpm = 250;
		if(!$postID){
			$postID = get_the_ID();
		}
		$include_shortcodes = true;
		$exclude_images = false;
		$tmpContent = get_post_field('post_content', $postID);
		$number_of_images = substr_count(strtolower($tmpContent), '<img ');
		if ( ! $include_shortcodes ) {
			$tmpContent = strip_shortcodes($tmpContent);
		}
		$tmpContent = strip_tags($tmpContent);
		$wordCount = str_word_count($tmpContent);

		if ( !$exclude_images ) {

			$additional_words_for_images = brookside_calculate_images( $number_of_images, $wpm );
			$wordCount += $additional_words_for_images;
		}

		$wordCount = apply_filters( 'brookside_filter_wordcount', $wordCount );

		$readingTime = ceil($wordCount / $wpm);

		// If the reading time is 0 then return it as < 1 instead of 0.
		if ( $readingTime < 1 ) {
			$readingTime = esc_html__('< 1 min read', 'brookside-elements');
		} elseif($readingTime == 1) {
			$readingTime = esc_html__('1 minute read', 'brookside-elements');
		} else {
			$readingTime = $readingTime.' '.esc_html__('minutes read', 'brookside-elements');
		}

		if($echo){ 
			echo $readingTime;
		} else {
			return $readingTime;
		}
	}
}

if(!function_exists('brookside_calculate_images')){
	function brookside_calculate_images( $total_images, $wpm ) {
		$additional_time = 0;
		// For the first image add 12 seconds, second image add 11, ..., for image 10+ add 3 seconds
		for ( $i = 1; $i <= $total_images; $i++ ) {
			if ( $i >= 10 ) {
				$additional_time += 3 * (int) $wpm / 60;
			} else {
				$additional_time += (12 - ($i - 1) ) * (int) $wpm / 60;
			}
		}

		return $additional_time;
	}
}


add_action('admin_head', 'brookside_custom_fonts');
add_action('wp_enqueue_style', 'brookside_custom_fonts');
function brookside_custom_fonts() {
  $brookside_icon_style = '.brookside-element-icon {
      width:32px;
      height:32px;
      line-height:32px !important;
      border-radius:4px;
      background-image:none !important;
      background-color:#2b2735;
      color:#ffffff;
      font-size:22px !important;
      text-align:center;
    }';
  wp_add_inline_style('js_composer', $brookside_icon_style);
  wp_add_inline_style('vc_inline_css', $brookside_icon_style);
}
if(!function_exists('BrooksideExcerpt')){
	function BrooksideExcerpt($limit) {
		$text = get_the_excerpt();
		if($text == ''){
			$text = get_the_content();
		}
		$text = apply_filters('the_content', $text);
		$text = strip_shortcodes($text);
		$text = str_replace('\]\]\>', ']]>', $text);
		$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
		$text = strip_tags($text);
		$words = explode(' ', $text);
		$text = implode(' ', array_slice($words, 0, $limit));
		return $text;
	}
}
if(!function_exists('brookside_string_limit_words')){
	function brookside_string_limit_words($string, $word_limit)
	{
	  $string = strip_tags($string, '<p>');
	  $words = explode(' ', $string, ($word_limit + 1));
	  if(count($words) > $word_limit)
	    array_pop($words);
	  return implode(' ', $words);
	}
}
if(!function_exists('brookside_additional_user_fields')){
	function brookside_additional_user_fields( $user ) {?>
	    <h3><?php _e( 'Additional User Meta', 'brookside-elements' ); ?></h3>
	    <table class="form-table">
	        <tr>
	            <th><label for="user_meta_image"><?php esc_html_e( 'A special image for each user', 'brookside-elements' ); ?></label></th>
	            <td>
	                <!-- Outputs the image after save -->
	                <img id="additional-user-image" src="<?php echo esc_url( get_the_author_meta( 'user_meta_image', $user->ID ) ); ?>" style="width:150px;"><br />
	                <!-- Outputs the text field and displays the URL of the image retrieved by the media uploader -->
	                <input type="text" name="user_meta_image" id="user_meta_image" value="<?php echo esc_url_raw( get_the_author_meta( 'user_meta_image', $user->ID ) ); ?>" class="regular-text" />
	                <!-- Outputs the save button -->
	                <input type='button' class="additional-user-image button-pbrooksidery" value="<?php _e( 'Upload Image', 'brookside-elements' ); ?>" id="uploadimage"/><br />
	                <span class="description"><?php esc_html_e( 'Upload an additional image for your user profile.', 'brookside-elements' ); ?></span>
	            </td>
	        </tr>
	        <tr>
	            <th><h4><?php esc_html_e( 'User socials icons', 'brookside-elements' ); ?></h4></th>
	            <td>
	                <p>
	                    <label for="user_facebook_url"><?php esc_html_e( 'Facebook:', 'brookside-elements' ); ?></label><br>
	                    <input type="text" name="user_facebook_url" id="user_facebook_url" value="<?php echo esc_url_raw( get_the_author_meta( 'user_facebook_url', $user->ID ) ); ?>" class="regular-text" />
	                </p>
	                <p>
	                    <label for="user_twitter_url"><?php esc_html_e( 'Twitter:', 'brookside-elements' ); ?></label><br>
	                    <input type="text" name="user_twitter_url" id="user_twitter_url" value="<?php echo esc_url_raw( get_the_author_meta( 'user_twitter_url', $user->ID ) ); ?>" class="regular-text" />
	                </p>
	                <p>
	                    <label for="user_pinterest_url"><?php esc_html_e( 'Pinterest:', 'brookside-elements' ); ?></label><br>
	                    <input type="text" name="user_pinterest_url" id="user_pinterest_url" value="<?php echo esc_url_raw( get_the_author_meta( 'user_pinterest_url', $user->ID ) ); ?>" class="regular-text" />
	                </p>
	                <p>
	                    <label for="user_instagram_url"><?php esc_html_e( 'Instagram:', 'brookside-elements' ); ?></label><br>
	                    <input type="text" name="user_instagram_url" id="user_instagram_url" value="<?php echo esc_url_raw( get_the_author_meta( 'user_instagram_url', $user->ID ) ); ?>" class="regular-text" />
	                </p>
	                <p>
	                    <label for="user_email_url"><?php esc_html_e( 'Email:', 'brookside-elements' ); ?></label><br>
	                    <input type="text" name="user_email_url" id="user_email_url" value="<?php echo esc_attr( get_the_author_meta( 'user_email_url', $user->ID ) ); ?>" class="regular-text" />
	                </p>
	                <br>
	                <span class="description"><?php esc_html_e( 'Enter your socials links to user profile. Leave blank to hide icon.', 'brookside-elements' ); ?></span>
	            </td>
	        </tr>
	 
	    </table><!-- end form-table -->
	<?php } // additional_user_fields
	add_action( 'show_user_profile', 'brookside_additional_user_fields' );
	add_action( 'edit_user_profile', 'brookside_additional_user_fields' );
}
if(!function_exists('brookside_save_additional_user_meta')){
	function brookside_save_additional_user_meta( $user_id ) {
	 
	    // only saves if the current user can edit user profiles
	    if ( !current_user_can( 'edit_user', $user_id ) )
	        return false;
	 
	    update_user_meta( $user_id, 'user_meta_image', $_POST['user_meta_image'] );
	    update_user_meta( $user_id, 'user_facebook_url', $_POST['user_facebook_url'] );
	    update_user_meta( $user_id, 'user_twitter_url', $_POST['user_twitter_url'] );
	    update_user_meta( $user_id, 'user_pinterest_url', $_POST['user_pinterest_url'] );
	    update_user_meta( $user_id, 'user_instagram_url', $_POST['user_instagram_url'] );
	    update_user_meta( $user_id, 'user_email_url', $_POST['user_email_url'] );
	}
	 
	add_action( 'personal_options_update', 'brookside_save_additional_user_meta' );
	add_action( 'edit_user_profile_update', 'brookside_save_additional_user_meta' );
}

if(!function_exists('brookside_user_photo_scripts') ){
	function brookside_user_photo_scripts() {
		global $pagenow;
		if($pagenow !== 'profile.php') return;
		wp_enqueue_media(); 
		wp_enqueue_script('brookside-author-photo', BROOKSIDE_PLUGIN_URL . 'js/author.photo.js', array('jquery'), '1.0.0');
	}
	add_action('admin_enqueue_scripts', 'brookside_user_photo_scripts');
}

if(!function_exists('brookside_get_additional_user_meta_thumb')){
	function brookside_get_additional_user_meta_thumb($user_id='') {
	 	global $post;
	 	if($user_id == ''){
	 		$user_id = $post->post_author;
	 	}
	    $attachment_url = esc_url( get_the_author_meta( 'user_meta_image', $user_id ) );
	 
	     // grabs the id from the URL using Frankie Jarretts function
	    $attachment_id = attachment_url_to_postid( $attachment_url );
	 
	    // retrieve the thumbnail size of our image
	    $image_thumb = wp_get_attachment_image_src( $attachment_id, 'thumbnail' );
	 
	    // return the image thumbnail
	    return $image_thumb[0];
	 
	}
}

if( !function_exists('brookside_get_user_socials') ){
	function brookside_get_user_socials($user_id='') {
	 	global $post;
	 	if($user_id == ''){
	 		$user_id = $post->post_author;
	 	}
	    $facebook = get_the_author_meta( 'user_facebook_url', $user_id );
	    $twitter = get_the_author_meta( 'user_twitter_url', $user_id );
	    $pinterest = get_the_author_meta( 'user_pinterest_url', $user_id );
	    $instagram = get_the_author_meta( 'user_instagram_url', $user_id );
	    $email = get_the_author_meta( 'user_email_url', $user_id );
	    if($facebook != "" || $twitter != "" || $pinterest != "" || $instagram != '' || $email != "") $output = '<div class="social-icons"><ul class="unstyled">';
		if($facebook != "") { 
			$output .= '<li class="social-facebook"><a href="'.esc_url($facebook).'" target="_blank" title="'.esc_html__( 'Facebook', 'brookside-elements').'"><i class="fa fa-facebook"></i></a></li>';
		}
		if($twitter != "") { 
			$output .= '<li class="social-twitter"><a href="'.esc_url($twitter).'" target="_blank" title="'.esc_html__( 'Twitter', 'brookside-elements').'"><i class="fa fa-twitter"></i></a></li>';
		}
		if($pinterest != "") { 
			$output .= '<li class="social-pinterest"><a href="'.esc_url($pinterest).'" target="_blank" title="'.esc_html__( 'Pinterest', 'brookside-elements').'"><i class="fa fa-pinterest-p"></i></a></li>';
		}
		if($instagram != '') { 
			$output .= '<li class="social-instagram"><a href="'.esc_url($instagram).'" target="_blank" title="'.esc_html__( 'Instagram', 'brookside-elements').'"><i class="fa fa-instagram"></i></a></li>';
		}
		if($email != "") { 
			$output .= '<li class="social-email"><a href="mailto:'.$email.'" target="_blank" title="'.$email.'"><i class="fa fa-envelope-o"></i></a></li>';
		}
	    if($facebook != "" || $twitter != "" || $pinterest != "" || $instagram != '' || $email != "") $output .= '</ul></div>';
	    
		return $output;
	}
}
// Echo theme's meta data if enabled
if(!function_exists('brookside_header_meta')) {
	/**
	 * Function that echoes meta data if our seo is enabled
	 */
	function brookside_header_meta() {
		global $post;
		$postID = $post->ID;
		$description = 0;
		if(is_front_page()){
			$permalink = esc_url(home_url());
			$title = esc_attr(get_bloginfo('name'));
		} else {
			$permalink = esc_url(get_permalink($postID));
			$title = esc_attr(get_the_title($postID));
		}
		$description = esc_html(get_post_meta(get_the_ID(), "brookside_page_meta_description", true));
		if(!$description && get_theme_mod('brookside_meta_description', false) ){
			$description = get_theme_mod('brookside_meta_description');
		}
		if(!$description){
			if(is_front_page()){
				$description = esc_attr(get_bloginfo('description'));
			} else {
				$description = esc_attr(get_the_excerpt($postID));
			}
		}
		$og_type = 'website';
		if(is_single()){
			$og_type = 'article';
		}
		$metas = '';
		if( !get_theme_mod('brookside_seo_settings', false) ) {
			
			$meta_keywords = esc_html(get_post_meta(get_the_ID(), "brookside_page_meta_keywords", true));
			$metas .= '<meta name="description" content="'.$description.'">';
			if($meta_keywords) {
				$metas .= '<meta name="keywords" content="'.$meta_keywords.'">';
			} else if( get_theme_mod('brookside_meta_keywords', false) ){
				$metas .= '<meta name="keywords" content="'.get_theme_mod('brookside_meta_keywords').'">'."\r\n";
			}
			$out = '<meta property="og:url" content="'.$permalink.'"/>';
			$out .= '<meta property="og:type" content="'.$og_type.'"/>';
			$out .= '<meta property="og:title" content="'.$title.'"/>';
			$out .= '<meta property="og:description" content="'.$description.'"/>';
			if(catch_og_image()){
				$out .= '<meta property="og:image" content="'.catch_og_image().'"/>';
			}
			$out .= '<meta property="og:site_name" content="'.$title.'" />';
			$out .= '<meta name="twitter:description" content="'.$description.'" />';
			$out .= '<meta name="twitter:title" content="'.$title.'" />';
			$out .= '<meta name="twitter:card" content="summary">';
			if(catch_og_image()){
				$out .= '<meta name="twitter:image" content="'.catch_og_image().'" />';
			}

			$metas .= $out;
		}
		echo ''.$metas;
	}
	add_action('brookside_header_meta', 'brookside_header_meta');
}
if(!function_exists('brookside_get_social_links_items')){
	function brookside_get_social_links_items(){
		$output='';
			if(get_theme_mod('brookside_social_facebook', '#') != "") { 
				$output .= '<li class="social-facebook"><a href="'.esc_url(get_theme_mod('brookside_social_facebook', '#')).'" target="_blank" title="'. esc_html__( 'Facebook', 'brookside-elements').'"><i class="fa fa-facebook"></i></a></li>';
			}
			if(get_theme_mod('brookside_social_twitter', '#') != "") { 
				$output .= '<li class="social-twitter"><a href="'.esc_url(get_theme_mod('brookside_social_twitter', '#')).'" target="_blank" title="'. esc_html__( 'Twitter', 'brookside-elements').'"><i class="fa fa-twitter"></i></a></li>';
			}
			if(get_theme_mod('brookside_social_pinterest', '') != "") { 
				$output .= '<li class="social-pinterest"><a href="'.esc_url(get_theme_mod('brookside_social_pinterest', '')).'" target="_blank" title="'. esc_html__( 'Pinterest', 'brookside-elements').'"><i class="fa fa-pinterest-p"></i></a></li>';
			}
			if(get_theme_mod('brookside_social_vimeo', '') != "") { 
				$output .= '<li class="social-vimeo"><a href="'.esc_url(get_theme_mod('brookside_social_vimeo', '')).'" target="_blank" title="'. esc_html__( 'Vimeo', 'brookside-elements').'"><i class="fa fa-vimeo"></i></a></li>';
			}	 
			if(get_theme_mod('brookside_social_instagram', '#') != '') { 
				$output .= '<li class="social-instagram"><a href="'.esc_url(get_theme_mod('brookside_social_instagram', '#')).'" target="_blank" title="'. esc_html__( 'Instagram', 'brookside-elements').'"><i class="fa fa-instagram"></i></a></li>';
			}
			if(get_theme_mod('brookside_social_tumblr', '') != "") { 
				$output .= '<li class="social-tumblr"><a href="'.esc_url(get_theme_mod('brookside_social_tumblr', '')).'" target="_blank" title="'. esc_html__( 'Tumblr', 'brookside-elements').'"><i class="fa fa-tumblr"></i></a></li>';
			}
			if(get_theme_mod('brookside_social_google_plus', '') != "") { 
				$output .= '<li class="social-googleplus"><a href="'.esc_url(get_theme_mod('brookside_social_google_plus', '')).'" target="_blank" title="'. esc_html__( 'Google plus', 'brookside-elements').'"><i class="fa fa-google-plus"></i></a></li>';
			}
			if(get_theme_mod('brookside_social_forrst', '') != "") { 
				$output .= '<li class="social-forrst"><a href="'.esc_url(get_theme_mod('brookside_social_forrst', '')).'" target="_blank" title="'. esc_html__( 'Forrst', 'brookside-elements').'"><i class="fa icon-forrst"></i></a></li>';
			}
			if(get_theme_mod('brookside_social_dribbble', '') != "") { 
				$output .= '<li class="social-dribbble"><a href="'.esc_url(get_theme_mod('brookside_social_dribbble', '')).'" target="_blank" title="'. esc_html__( 'Dribbble', 'brookside-elements').'"><i class="fa fa-dribbble"></i></a></li>';
			}
			if(get_theme_mod('brookside_social_flickr', '') != "") { 
				$output .= '<li class="social-flickr"><a href="'.esc_url(get_theme_mod('brookside_social_flickr', '')).'" target="_blank" title="'. esc_html__( 'Flickr', 'brookside-elements').'"><i class="fa fa-flickr"></i></a></li>';
			}
			if(get_theme_mod('brookside_social_linkedin', '') != "") { 
				$output .= '<li class="social-linkedin"><a href="'.esc_url(get_theme_mod('brookside_social_linkedin', '')).'" target="_blank" title="'. esc_html__( 'LinkedIn', 'brookside-elements').'"><i class="fa fa-linkedin"></i></a></li>';
			}
			if(get_theme_mod('brookside_social_skype', '') != "") { 
				$output .= '<li class="social-skype"><a href="skype:'.esc_attr(get_theme_mod('brookside_social_skype', '')).'" title="'. esc_html__( 'Skype', 'brookside-elements').'"><i class="fa fa-skype"></i></a></li>';
			}
			if(get_theme_mod('brookside_social_digg', '') != "") { 
				$output .= '<li class="social-digg"><a href="'.esc_url(get_theme_mod('brookside_social_digg', '')).'" target="_blank" title="'. esc_html__( 'Digg', 'brookside-elements').'"><i class="fa fa-digg"></i></a></li>';
			}
			if(get_theme_mod('brookside_social_yahoo', '') != "") { 
				$output .= '<li class="social-yahoo"><a href="'.esc_url(get_theme_mod('brookside_social_yahoo', '')).'" target="_blank" title="'. esc_html__( 'Yahoo', 'brookside-elements').'"><i class="fa fa-yahoo"></i></a></li>';
			}
			if(get_theme_mod('brookside_social_youtube', '') != "") { 
				$output .= '<li class="social-youtube"><a href="'.esc_url(get_theme_mod('brookside_social_youtube', '')).'" target="_blank" title="'. esc_html__( 'YouTube', 'brookside-elements').'"><i class="fa fa-youtube-play"></i></a></li>';
			}
			if(get_theme_mod('brookside_social_deviantart', '') != "") { 
				$output .= '<li class="social-deviantart"><a href="'.esc_url(get_theme_mod('brookside_social_deviantart', '')).'" target="_blank" title="'. esc_html__( 'DeviantArt', 'brookside-elements').'"><i class="fa fa-deviantart"></i></a></li>';
			}
			if(get_theme_mod('brookside_social_behance', '') != "") { 
				$output .= '<li class="social-behance"><a href="'.esc_url(get_theme_mod('brookside_social_behance', '')).'" target="_blank" title="'. esc_html__( 'Behance', 'brookside-elements').'"><i class="fa fa-behance"></i></a></li>';
			}
			if(get_theme_mod('brookside_social_paypal', '') != "") { 
				$output .= '<li class="social-paypal"><a href="'.esc_url(get_theme_mod('brookside_social_paypal', '')).'" target="_blank" title="'. esc_html__( 'PayPal', 'brookside-elements').'"><i class="fa fa-paypal"></i></a></li>';
			}
			if(get_theme_mod('brookside_social_delicious', '') != "") { 
				$output .= '<li class="social-delicious"><a href="'.esc_url(get_theme_mod('brookside_social_delicious', '')).'" target="_blank" title="'. esc_html__( 'Delicious', 'brookside-elements').'"><i class="fa fa-delicious"></i></a></li>';
			}
			if(get_theme_mod('brookside_social_rss', false)) { 
				$output .= '<li class="social-rss"><a href="'.esc_url(get_bloginfo('rss2_url')).'" target="_blank" title="'. esc_html__( 'RSS', 'brookside-elements').'"><i class="fa fa-rss"></i></a></li>';
			}
			return $output;
	}
}
if(!function_exists('brookside_get_social_links')){
	function brookside_get_social_links($echo = true){
		$output='';
		if( brookside_get_social_links_items() != '' ){
			$output .= '<div class="social-icons">';
				$output .= '<ul class="unstyled">';
					$output .= brookside_get_social_links_items(); 
				$output .= '</ul>';
			$output .= '</div>';
		}
		
		if($echo){
			echo ''.$output;
		} else {
			return $output;
		}
	}
}
if(!function_exists('brookside_get_footer_social_links_items')){
	function brookside_get_footer_social_links_items(){
		$output='';
			if(get_theme_mod('brookside_social_facebook', '#') != "") { 
				$output .= '<li class="social-facebook"><a href="'.esc_url(get_theme_mod('brookside_social_facebook', '#')).'" target="_blank" title="'. esc_html__( 'Facebook', 'brookside-elements').'"><i class="fa fa-facebook"></i><span>'. esc_html__( 'Facebook', 'brookside-elements').'</span></a></li>';
			}
			if(get_theme_mod('brookside_social_twitter', '#') != "") { 
				$output .= '<li class="social-twitter"><a href="'.esc_url(get_theme_mod('brookside_social_twitter', '#')).'" target="_blank" title="'. esc_html__( 'Twitter', 'brookside-elements').'"><i class="fa fa-twitter"></i><span>'. esc_html__( 'Twitter', 'brookside-elements').'</span></a></li>';
			}
			if(get_theme_mod('brookside_social_pinterest', '') != "") { 
				$output .= '<li class="social-pinterest"><a href="'.esc_url(get_theme_mod('brookside_social_pinterest', '')).'" target="_blank" title="'. esc_html__( 'Pinterest', 'brookside-elements').'"><i class="fa fa-pinterest-p"></i><span>'. esc_html__( 'Pinterest', 'brookside-elements').'</span></a></li>';
			}
			if(get_theme_mod('brookside_social_vimeo', '') != "") { 
				$output .= '<li class="social-vimeo"><a href="'.esc_url(get_theme_mod('brookside_social_vimeo', '')).'" target="_blank" title="'. esc_html__( 'Vimeo', 'brookside-elements').'"><i class="fa fa-vimeo"></i><span>'. esc_html__( 'Vimeo', 'brookside-elements').'</span></a></li>';
			}	 
			if(get_theme_mod('brookside_social_instagram', '#') != '') { 
				$output .= '<li class="social-instagram"><a href="'.esc_url(get_theme_mod('brookside_social_instagram', '#')).'" target="_blank" title="'. esc_html__( 'Instagram', 'brookside-elements').'"><i class="fa fa-instagram"></i><span>'. esc_html__( 'Instagram', 'brookside-elements').'</span></a></li>';
			}
			if(get_theme_mod('brookside_social_tumblr', '') != "") { 
				$output .= '<li class="social-tumblr"><a href="'.esc_url(get_theme_mod('brookside_social_tumblr', '')).'" target="_blank" title="'. esc_html__( 'Tumblr', 'brookside-elements').'"><i class="fa fa-tumblr"></i><span>'. esc_html__( 'Tumblr', 'brookside-elements').'</span></a></li>';
			}
			if(get_theme_mod('brookside_social_google_plus', '') != "") { 
				$output .= '<li class="social-googleplus"><a href="'.esc_url(get_theme_mod('brookside_social_google_plus', '')).'" target="_blank" title="'. esc_html__( 'Google plus', 'brookside-elements').'"><i class="fa fa-google-plus"></i><span>'. esc_html__( 'Google plus', 'brookside-elements').'</span></a></li>';
			}
			if(get_theme_mod('brookside_social_forrst', '') != "") { 
				$output .= '<li class="social-forrst"><a href="'.esc_url(get_theme_mod('brookside_social_forrst', '')).'" target="_blank" title="'. esc_html__( 'Forrst', 'brookside-elements').'"><i class="fa icon-forrst"></i><span>'. esc_html__( 'Forrst', 'brookside-elements').'</span></a></li>';
			}
			if(get_theme_mod('brookside_social_dribbble', '') != "") { 
				$output .= '<li class="social-dribbble"><a href="'.esc_url(get_theme_mod('brookside_social_dribbble', '')).'" target="_blank" title="'. esc_html__( 'Dribbble', 'brookside-elements').'"><i class="fa fa-dribbble"></i><span>'. esc_html__( 'Dribbble', 'brookside-elements').'</span></a></li>';
			}
			if(get_theme_mod('brookside_social_flickr', '') != "") { 
				$output .= '<li class="social-flickr"><a href="'.esc_url(get_theme_mod('brookside_social_flickr', '')).'" target="_blank" title="'. esc_html__( 'Flickr', 'brookside-elements').'"><i class="fa fa-flickr"></i><span>'. esc_html__( 'Flickr', 'brookside-elements').'</span></a></li>';
			}
			if(get_theme_mod('brookside_social_linkedin', '') != "") { 
				$output .= '<li class="social-linkedin"><a href="'.esc_url(get_theme_mod('brookside_social_linkedin', '')).'" target="_blank" title="'. esc_html__( 'LinkedIn', 'brookside-elements').'"><i class="fa fa-linkedin"></i><span>'. esc_html__( 'LinkedIn', 'brookside-elements').'</span></a></li>';
			}
			if(get_theme_mod('brookside_social_skype', '') != "") { 
				$output .= '<li class="social-skype"><a href="skype:'.esc_attr(get_theme_mod('brookside_social_skype', '')).'" title="'. esc_html__( 'Skype', 'brookside-elements').'"><i class="fa fa-skype"></i><span>'. esc_html__( 'Skype', 'brookside-elements').'</span></a></li>';
			}
			if(get_theme_mod('brookside_social_digg', '') != "") { 
				$output .= '<li class="social-digg"><a href="'.esc_url(get_theme_mod('brookside_social_digg', '')).'" target="_blank" title="'. esc_html__( 'Digg', 'brookside-elements').'"><i class="fa fa-digg"></i><span>'. esc_html__( 'Digg', 'brookside-elements').'</span></a></li>';
			}
			if(get_theme_mod('brookside_social_yahoo', '') != "") { 
				$output .= '<li class="social-yahoo"><a href="'.esc_url(get_theme_mod('brookside_social_yahoo', '')).'" target="_blank" title="'. esc_html__( 'Yahoo', 'brookside-elements').'"><i class="fa fa-yahoo"></i><span>'. esc_html__( 'Yahoo', 'brookside-elements').'</span></a></li>';
			}
			if(get_theme_mod('brookside_social_youtube', '') != "") { 
				$output .= '<li class="social-youtube"><a href="'.esc_url(get_theme_mod('brookside_social_youtube', '')).'" target="_blank" title="'. esc_html__( 'YouTube', 'brookside-elements').'"><i class="fa fa-youtube"></i><span>'. esc_html__( 'YouTube', 'brookside-elements').'</span></a></li>';
			}
			if(get_theme_mod('brookside_social_deviantart', '') != "") { 
				$output .= '<li class="social-deviantart"><a href="'.esc_url(get_theme_mod('brookside_social_deviantart', '')).'" target="_blank" title="'. esc_html__( 'DeviantArt', 'brookside-elements').'"><i class="fa fa-deviantart"></i><span>'. esc_html__( 'DeviantArt', 'brookside-elements').'</span></a></li>';
			}
			if(get_theme_mod('brookside_social_behance', '') != "") { 
				$output .= '<li class="social-behance"><a href="'.esc_url(get_theme_mod('brookside_social_behance', '')).'" target="_blank" title="'. esc_html__( 'Behance', 'brookside-elements').'"><i class="fa fa-behance"></i><span>'. esc_html__( 'Behance', 'brookside-elements').'</span></a></li>';
			}
			if(get_theme_mod('brookside_social_paypal', '') != "") { 
				$output .= '<li class="social-paypal"><a href="'.esc_url(get_theme_mod('brookside_social_paypal', '')).'" target="_blank" title="'. esc_html__( 'PayPal', 'brookside-elements').'"><i class="fa fa-paypal"></i><span>'. esc_html__( 'PayPal', 'brookside-elements').'</span></a></li>';
			}
			if(get_theme_mod('brookside_social_delicious', '') != "") { 
				$output .= '<li class="social-delicious"><a href="'.esc_url(get_theme_mod('brookside_social_delicious', '')).'" target="_blank" title="'. esc_html__( 'Delicious', 'brookside-elements').'"><i class="fa fa-delicious"></i><span>'. esc_html__( 'Delicious', 'brookside-elements').'</span></a></li>';
			}
			if(get_theme_mod('brookside_social_rss', false)) { 
				$output .= '<li class="social-rss"><a href="'.esc_url(get_bloginfo('rss2_url')).'" target="_blank" title="'. esc_html__( 'RSS', 'brookside-elements').'"><i class="fa fa-rss"></i><span>'. esc_html__( 'RSS', 'brookside-elements').'</span></a></li>';
			}
		return $output;
	}
}
if(!function_exists('brookside_get_footer_social_links')){
	function brookside_get_footer_social_links($echo = true){
		$output='';
		if( brookside_get_footer_social_links_items() != '' ){
			$output .= '<div class="social-icons">';
				$output .= '<ul class="unstyled">';
					$output .= brookside_get_footer_social_links_items();
				$output .= '</ul>';
			$output .= '</div>';
		}
		if($echo){
			echo ''.$output;
		} else {
			return $output;
		}
	}
}
function brookside_save_subscriber_to_list($email){
	$subscribers_list = array();
	$subscribers_list = maybe_unserialize(get_option('brookside_subscribe_mailing_list'));
	if(!in_array($email, $subscribers_list)){
		$subscribers_list[]=$email;
		update_option('brookside_subscribe_mailing_list', serialize($subscribers_list));
	}
	return;
}
if(!function_exists('brookside_email_subscription_fn')) {
	add_action('brookside_email_subscription', 'brookside_email_subscription_fn' );
	function brookside_email_subscription_fn($id) {

		if('POST' == $_SERVER['REQUEST_METHOD'] && isset($_POST['brookside_submit_subscription'])) {

			if( filter_var($_POST['subscriber_email'], FILTER_VALIDATE_EMAIL) ){
				
				$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
				 
				$subject = sprintf(esc_html__('New Subscription on %s','brookside-elements'), $blogname);
				 
				$to = get_option('admin_email'); 
				 
				$headers = 'From: '. sprintf(esc_html__('%s Admin', 'brookside-elements'), $blogname) .' <no-repy@'.$_SERVER['SERVER_NAME'] .'>' . PHP_EOL;
				 
				$message  = sprintf(esc_html__('Hi ,', 'brookside-elements')) . PHP_EOL . PHP_EOL;
				$message .= sprintf(esc_html__('You have a new subscription on your %s website.', 'brookside-elements'), $blogname) . PHP_EOL . PHP_EOL;
				$message .= esc_html__('Email Details', 'brookside-elements') . PHP_EOL;
				$message .= esc_html__('-----------------') . PHP_EOL;
				$message .= esc_html__('User E-mail: ', 'brookside-elements') . stripslashes($_POST['subscriber_email']) . PHP_EOL;
				$message .= esc_html__('Regards,', 'brookside-elements') . PHP_EOL . PHP_EOL;
				$message .= sprintf(esc_html__('Your %s Team', 'brookside-elements'), $blogname) . PHP_EOL;
				$message .= trailingslashit(get_option('home')) . PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL;
			
				if (wp_mail($to, $subject, $message, $headers)){
					echo '<p id="subscribe_message"class="subscribe-notice success">';
					esc_html_e('Your e-mail (' . $_POST['subscriber_email'] . ') has been added to our mailing list!', 'brookside-elements');
					echo '</p>';
					brookside_save_subscriber_to_list($_POST['subscriber_email']);
				} else {
					echo '<p id="subscribe_message"class="subscribe-notice error">';
					esc_html_e('There was a problem with your e-mail (' . $_POST['subscriber_email'] . ')', 'brookside-elements');
					echo '</p>'; 

				}
			} else {
			   echo '<p id="subscribe_message" class="subscribe-notice error">';
			   esc_html_e('There was a problem with your e-mail (' . $_POST['subscriber_email'] . ')', 'brookside-elements');
			   echo '</p>';
			}
		}?>
						
		<form id="newsletter-<?php echo esc_attr($id); ?>" method="POST">				
			<div class="newsletter-form">
				<div class="newsletter-email">
					<input type="email" name="subscriber_email" placeholder="<?php esc_html_e('Your Email', 'brookside-elements'); ?>">
				</div>
				<div class="newsletter-submit">
					<input type="hidden" name="brookside_submit_subscription" value="Submit"><button type="submit" name="submit_form"><span><?php esc_html_e('Subscribe now'); ?></span><i class="la la-envelope"></i></button>						
				</div>
			</div>
		</form>

	<?php }

}
add_action('admin_footer', 'brookside_export_subscribers');
function brookside_export_subscribers() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready( function($)
        {
            $('#menu-appearance > ul ').append('<li><form id="brookside_subscribers_form" action="#" method="POST"><input type="hidden" id="brookside_subscribers" name="brookside_subscribers" value="1" /><a href="#" onclick="document.getElementById(\'brookside_subscribers_form\').submit()" style="padding:5px 12px;"><?php esc_attr_e('Export Subscribers', 'brookside-elements');?></a></form></li>');
        });
    </script>
    <?php
}
add_action('admin_init', 'brookside_subscribers_menu_page'); //you can use admin_init as well
function brookside_subscribers_menu_page(){
	if (!empty($_POST['brookside_subscribers'])) {
		header("Content-type: application/force-download");
	    header('Content-Disposition: inline; filename="subscribers-'.date('Y-M-d').'.csv"');
	    $subscribers = maybe_unserialize(get_option('brookside_subscribe_mailing_list'));
	    if( !empty($subscribers) && is_array($subscribers) ){
	    	echo join("\r\n", $subscribers);
	    } else {
	    	esc_html_e('No subscribers yet.');
	    }
	    exit();
	}
}

?>