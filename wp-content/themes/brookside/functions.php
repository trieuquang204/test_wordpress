<?php 
/* ------------------------------------------------------------------------ */
/* Translation
/* Translations can be filed in the framework/languages/ directory */

load_theme_textdomain( 'brookside', get_template_directory() . '/languages' );

$locale = get_locale();
$locale_file = get_template_directory() . "/languages/$locale.php";
if ( is_readable($locale_file) ){
	require_once($locale_file);
}

include_once(trailingslashit( get_template_directory() ).'framework/customizer/customizer.php');
include_once(trailingslashit( get_template_directory() ).'framework/inc/customcss.php');
if( is_admin() ){
	include_once(trailingslashit( get_template_directory() ).'framework/inc/editor-customcss.php');
}
include_once(trailingslashit( get_template_directory() ).'framework/inc/sidebars.php'); // register widgets area
include_once(trailingslashit( get_template_directory() ).'framework/inc/sidebar-generator.php'); // add custom sidebars

if(!function_exists('brookside_scripts_basic')){
	function brookside_scripts_basic() { 
		if ( is_singular() ) { 
			wp_enqueue_script( 'comment-reply' ); 
		} 
		wp_enqueue_script('html5', get_template_directory_uri().'/js/html5shiv.js', array(), '3.7.3' );
		wp_script_add_data('html5', 'conditional', 'lt IE 9' );
		wp_register_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '2.0.0', TRUE);
		if( get_theme_mod('brookside_lightbox_enable', 1 ) ){
			wp_enqueue_script('image-lightbox', get_template_directory_uri() . '/js/image-lightbox.min.js', array('jquery'), '1.0', TRUE);
			$lightbox_script = "jQuery(document).ready(function($){
				$( 'a[data-lightbox^=\"lightbox-insta\"]' ).lightbox();
			    $( '.single-post a[data-lightbox=\"lightbox-gallery\"]' ).lightbox();
			    $( '[id*=\"gallery\"] a' ).lightbox();
			    $( '.wp-block-gallery li a' ).lightbox();

			    $('a[href$=jpg], a[href$=JPG], a[href$=jpeg], a[href$=JPEG], a[href$=png], a[href$=gif], a[href$=bmp]:has(img)').each(function(){
			        if( $(this).parents('[data-carousel-extra*=\"{\"]').length || $(this).parents('[id*=\"gallery\"]').length || $(this).parents('.wp-block-gallery').length || $(this).parents('.woocommerce-product-gallery').length ){
			            return false;
			        } else {
			           $(this).not('[data-lightbox*=\"lightbox\"]').lightbox(); 
			        }
			        
			    });
			});";
	wp_add_inline_script('image-lightbox', $lightbox_script);
		}
		wp_register_script('isotope', get_template_directory_uri() . '/js/isotope.min.js', array('jquery'), '3.0.0', true);
		wp_register_script('infinite-scroll', get_template_directory_uri() . '/js/infinite-scroll.pkgd.min.js', array('jquery'), '2.1.0', true);
		wp_enqueue_script('theia-sticky-sidebar', get_template_directory_uri() . '/js/theia-sticky-sidebar.js', array('jquery'), '1.7.0', true);
		wp_enqueue_script('jquery-dlmenu', get_template_directory_uri() . '/js/jquery.dlmenu.js', array('jquery'), '1.0.1', true);
		if( get_theme_mod('brookside_smooth_scroll', false) ){
			wp_enqueue_script('brookside-smoothscroll', get_template_directory_uri() . '/js/brookside-smoothscroll.js', array('jquery'), '1.0', TRUE);
		}
		if(get_theme_mod('brookside_live_search', false) == true){
			wp_enqueue_script('brookside-ajaxsearch', get_template_directory_uri() . '/js/brookside-ajaxsearch.js', array('jquery'), '1.0', TRUE);
			wp_localize_script( 'brookside-ajaxsearch', 'brooksideAjaxSearch', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		}
		wp_enqueue_script('brookside-functions', get_template_directory_uri() . '/js/brookside-functions.js', array('jquery'), '1.0', TRUE);
	}
	add_action( 'wp_enqueue_scripts', 'brookside_scripts_basic', 11 );
}
if(!function_exists('brookside_styles_basic')){
	function brookside_styles_basic() {  
		/* ------------------------------------------------------------------------ */
		/* Register Stylesheets */
		/* ------------------------------------------------------------------------ */
		wp_register_style( 'brookside-basic', get_template_directory_uri() . '/css/basic.css', array(), '1.0', 'all' );
		wp_register_style( 'brookside-stylesheet', get_template_directory_uri() .'/style.css', array(), '1.0', 'all' );
		wp_register_style( 'brookside-skeleton', get_template_directory_uri() . '/css/grid.css', array(), '1', 'all' );
		wp_register_style( 'image-lightbox', get_template_directory_uri() . '/css/imageLightbox.min.css', array(), '1.0', 'all' );
		wp_deregister_style( 'font-awesome' );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/framework/fonts/font-awesome/css/all.min.css', array(), '5.8.1', 'all' );
		wp_enqueue_style( 'line-awesome', get_template_directory_uri() . '/framework/fonts/line-awesome/css/line-awesome.min.css', array(), '1.0', 'all' );
		wp_register_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css', array(), '2.0.0', 'all' );
		wp_enqueue_style( 'dlmenu', get_template_directory_uri() . '/css/dlmenu.css', array(), '1.0', 'all' );
		wp_register_style( 'brookside-responsive', get_template_directory_uri() . '/css/responsive.css', array('brookside-stylesheet','owl-carousel'), '1.0', 'all' );
		wp_enqueue_style( 'brookside-basic' );
		wp_enqueue_style( 'brookside-skeleton' );
		if( get_theme_mod('brookside_lightbox_enable', 1 ) ){
			wp_enqueue_style( 'image-lightbox' );
		}
		if( class_exists('WooCommerce') ){
			wp_enqueue_style('brookside-woocommerce', get_template_directory_uri().'/css/custom-woocommerce.css', array('woocommerce-layout', 'woocommerce-general'), '1.0.0', 'all');
		}
		wp_enqueue_style( 'brookside-stylesheet' );
		if ( function_exists( 'is_rtl' ) && is_rtl() ) {
			wp_enqueue_style( 'brookside-stylesheet-rtl', get_template_directory_uri() . '/rtl.css', array('brookside-stylesheet'), '1.0', 'all' );
		}
		if( get_theme_mod('brookside_responsiveness', true) ) {
			wp_enqueue_style( 'brookside-responsive' );
		}

	}  
	add_action( 'wp_enqueue_scripts', 'brookside_styles_basic', 1 );
}
function brookside_gutenberg_editor() {
	wp_enqueue_style( 'brookside-blocks-grid', get_template_directory_uri() . '/css/grid.css');
    wp_enqueue_style( 'brookside-blocks-style', get_template_directory_uri() . '/framework/inc/editor-style.css');
    wp_enqueue_style( 'brookside-blocks-lineawesome', get_template_directory_uri() . '/framework/fonts/line-awesome/css/line-awesome.min.css');
    wp_enqueue_style( 'brookside-blocks-fontawesome', get_template_directory_uri() . '/framework/fonts/font-awesome/css/font-awesome.min.css');
}
add_action( 'enqueue_block_editor_assets', 'brookside_gutenberg_editor' );
if( !function_exists('brookside_blog_script_enqueue') ){
	function brookside_blog_script_enqueue (){
		if( is_home() && ($post_style == 'style_1' || $post_style == 'style_4') || $pagination == 'true' ){
			if( $post_style == 'style_4' ){
				$masonry = 'masonry';
			} else {
				$masonry = 'fitRows';
			}
			wp_enqueue_script('isotope' );
			wp_enqueue_script('infinite-scroll' );
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
	}
}

if(!function_exists('brookside_link_pages_args_prevnext_add')){
	add_filter('wp_link_pages_args', 'brookside_link_pages_args_prevnext_add');
	function brookside_link_pages_args_prevnext_add($args)
	{
	    global $page, $numpages, $more, $pagenow;

	    if (!$args['next_or_number'] == 'next_and_number') 
	        return $args; # exit early

	    $args['next_or_number'] = 'number'; # keep numbering for the main part
	    if (!$more)
	        return $args; # exit early

	    if($page-1) # there is a previous page
	        $args['before'] .= '<div class="prev-link">'._wp_link_page($page-1)
	        	    . $args['link_before']. $args['previouspagelink'] . $args['link_after'] . '</a></div>'
	        ;

	    if ($page<$numpages) # there is a next page
	        $args['after'] = '<div class="next-link">'._wp_link_page($page+1)
	            . $args['link_before'] . ' ' . $args['nextpagelink'] . $args['link_after'] . '</a></div>'
	            . $args['after']
	        ;

	    return $args;
	}
}
if(!function_exists('brookside_enqueue_comments_reply')){
	function brookside_enqueue_comments_reply(){
		wp_enqueue_script( 'comment-reply' );
	}
	add_action( 'comment_form_before', 'brookside_enqueue_comments_reply' );
}

/* Add Custom Pbrooksidery Navigation */
if(!function_exists('brookside_register_custom_menu')){
	add_action('init', 'brookside_register_custom_menu');
	function brookside_register_custom_menu() {
		register_nav_menu('main_navigation', esc_html__('Mega Menu Navigation','brookside'));
		register_nav_menu('side_navigation', esc_html__('Side Header Navigation','brookside'));
		register_nav_menu('mobile_navigation', esc_html__('Mobile menu navigation','brookside'));
		register_nav_menu('hidden_navigation', esc_html__('Hidden Navigation','brookside'));
		register_nav_menu('footer_navigation', esc_html__('Footer menu','brookside'));
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
if(!function_exists('BrooksideExcerpt')){
	function BrooksideExcerpt($limit) {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt)>=$limit) {
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt);
		} else {
			$excerpt = implode(" ",$excerpt);
		} 
		$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
		return $excerpt;
	}
}
if( !function_exists('brookside_allow_svg_upload')){
	function brookside_allow_svg_upload($mimes){
		$mimes['svg'] = 'image/svg+xml';
		$mimes['txt'] = 'text/plain';
		$mimes['csv'] = 'text/csv';
  		return $mimes;
	}
	add_filter('upload_mimes', 'brookside_allow_svg_upload');
}

if(!function_exists('brookside_theme_setup')){
	function brookside_theme_setup() {
		add_theme_support( 'woocommerce', array(
	        'thumbnail_image_width' => 400,
	        'single_image_width'    => 600,

	        'product_grid'          => array(
	            'default_rows'    => 3,
	            'min_rows'        => 2,
	            'max_rows'        => 3,
	            'default_columns' => 3,
	            'min_columns'     => 2,
	            'max_columns'     => 3,
	        ),
	    ) );
	    //add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'post-formats', array('gallery', 'image', 'video', 'audio', 'quote', 'link') );
		add_theme_support( "title-tag" );

		$crop = get_theme_mod('brookside_crop_post_thumbnail', true) ? true : false;
		set_post_thumbnail_size( '845', '550', $crop );

		add_image_size(esc_html__('brookside-masonry', 'brookside'), 585, 9999, false);

		$crop = get_theme_mod('brookside_extra_medium_crop', true) ? true : false;
		add_image_size(esc_html__('brookside-extra-medium', 'brookside'), 585, 585, $crop);

		$crop = get_theme_mod('brookside_fullwidth_slider_crop', true) ? true : false;
		add_image_size(esc_html__('brookside-fullwidth-slider', 'brookside'), 1900, 650, $crop);

		$crop = get_theme_mod('brookside_crop_thumbnail', true) ? 1 : 0;
		update_option( 'thumbnail_crop', $crop );
		$crop = get_theme_mod('brookside_crop_medium', true) ? 1 : 0;
		update_option( 'medium_crop', $crop );
		$crop = get_theme_mod('brookside_crop_large', true) ? 1 : 0;
		update_option( 'large_crop', $crop );
		
		$list = array(
		    'page',
		    'brookside-footer',
		    'brookside-header'
		);
		if( class_exists('WPBakeryVisualComposerAbstract') ){
			vc_set_default_editor_post_types( $list );
		}
	}
	add_action( 'after_setup_theme', 'brookside_theme_setup' );	
}
if(!function_exists('brookside_update_media_sizes')){
	function brookside_update_media_sizes(){
		update_option( 'thumbnail_size_w', 160 );
		update_option( 'thumbnail_size_h', 160 );
		
		update_option( 'medium_size_w', 570 );
		update_option( 'medium_size_h', 468 );
		
		update_option( 'large_size_w', 1170 );
		update_option( 'large_size_h', 690 );
		
	}
	add_action('after_switch_theme', 'brookside_update_media_sizes');
}
if(!function_exists('is_shop')){
	function is_shop(){
		return false;
	}
}

if( !function_exists('brookside_custom_posts_count') ){
	function brookside_custom_posts_count( $query ){
	    if( !is_admin() && $query->is_archive() && $query->is_main_query() && !is_shop() ){
	    		$posts_count = get_theme_mod( 'brookside_archive_post_count', '6');
	            $query->set( 'posts_per_page', $posts_count );
	    } elseif( !is_admin() && $query->is_search() && $query->is_main_query() ){
	    		$posts_count = get_theme_mod( 'brookside_search_post_count', '6');
	            $query->set( 'posts_per_page', $posts_count );
	    }
	}
	add_action( 'pre_get_posts', 'brookside_custom_posts_count' );
}
if(!function_exists('brookside_custom_image_sizes')){
	add_filter( 'image_size_names_choose', 'brookside_custom_image_sizes' );
	function brookside_custom_image_sizes( $sizes ) {
	    return array_merge( $sizes, array(
	    	'post-thumbnail' => esc_html__('post-thumbnail', 'brookside'),
	        'brookside-masonry' => esc_html__('brookside-masonry', 'brookside'),
	        'brookside-extra-medium' => esc_html__('brookside-extra-medium', 'brookside'),
	        'brookside-fullwidth-slider' => esc_html__('brookside-fullwidth-slider', 'brookside')
	    ) );
	}
}

if(!function_exists('brookside_custom_excerpt_length')){
	function brookside_custom_excerpt_length( $length ) {
		global $wp_query;
		$count = 55;
		if( !is_admin() && is_archive() ){
			$count = get_theme_mod('brookside_archive_excerpt_count', '15');
		} elseif( !is_admin() && is_search() ){
			$count = get_theme_mod('brookside_search_excerpt_count', '15');
		} elseif( !is_admin() && is_home() ) {
			$count = get_theme_mod('brookside_blog_excerpt_count', '24');
		}
		return $count;
	}
	add_filter( 'excerpt_length', 'brookside_custom_excerpt_length', 99 );
}

if(!function_exists('brookside_modify_read_more_link')){
	add_filter('excerpt_more', 'brookside_modify_read_more_link');
	add_filter( 'the_content_more_link', 'brookside_modify_read_more_link' );
	function brookside_modify_read_more_link() {
		return '';
	}
}

if(!function_exists('brookside_excerpt')){
	function brookside_excerpt($limit=17, $postID=false) {
		if(!$postID){
			$postID = get_the_ID();
		}
		$text = get_the_content($postID);
		$text = apply_filters('the_content', $text);
		$text = strip_shortcodes($text);
		$text = str_replace('\]\]\>', ']]>', $text);
		$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
		$text = strip_tags($text);
		$excerpt_length = $limit;
		$words = explode(' ', $text, $excerpt_length + 1);
		array_pop($words);
		$text = implode(' ', $words);
		return $text;
	}
}

if(!function_exists('brookside_comments_number')){
	function brookside_comments_number($postID, $echo = false){
		if( is_single() && get_theme_mod('brookside_single_disable_comments', false) ){
			return;
		}
		$num_comments = get_comments_number($postID);
		if ( comments_open() ) {
			if ( $num_comments == 0 ) {
				$comments = esc_html__('No Comments', 'brookside');
			} elseif ( $num_comments > 1 ) {
				$comments = $num_comments .' '. esc_html__('Comments', 'brookside');
			} else {
				$comments = esc_html__('1 Comment', 'brookside');
			}
			$write_comments = '<span>'.esc_html($comments).'</span>';
		} else {
			$write_comments =  '<span>'.esc_html__('Comments disabled.', 'brookside').'</span>';
		}

		if($echo){
			echo wp_kses_post($write_comments);
		} else {
			return $write_comments;
		}
	}
	add_filter( 'brookside_comments_number', 'brookside_comments_number' );
}

/* Pagination */
if(!function_exists('brookside_next_posts_link_attributes')){
	add_filter('next_posts_link_attributes', 'brookside_next_posts_link_attributes');
	function brookside_next_posts_link_attributes() {
	    return 'class="next"';
	}
}
if(!function_exists('brookside_prev_posts_link_attributes')){
	function brookside_prev_posts_link_attributes() {
    	return 'class="previous"';
	}
	add_filter('previous_posts_link_attributes', 'brookside_prev_posts_link_attributes');
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
		$out .= '<div class="pagination-view-all"><a href="'.esc_url($view_more_url).'">'.esc_html__('View More', 'brookside').'</a></div>';

    }
    return $out;
  }
}

/* ------------------------------------------------------------------------ */
/* Comments
/* ------------------------------------------------------------------------ */
if(!function_exists('brookside_move_comment_field_to_bottom')){
	function brookside_move_comment_field_to_bottom( $fields ) {
		$comment_field = $fields['comment'];
		unset( $fields['comment'] );
		$fields['comment'] = $comment_field;
		return $fields;
	}
	add_filter( 'comment_form_fields', 'brookside_move_comment_field_to_bottom' );
}
if( !function_exists('brookside_default_comments_field') ){
	add_filter('comment_form_default_fields', 'brookside_default_comments_field');
	function brookside_default_comments_field( $fields ){
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		//Custom Fields
		$commenter = wp_get_current_commenter();

		$fields =  array(
			'author'=> '<div class="flex-grid flex-grid-2"><div class="flex-column"><input id="author" name="author" type="text" value="'.esc_attr( $commenter['comment_author'] ).'" placeholder="' . esc_attr__('Name', 'brookside') . ' *" size="30"' . $aria_req . ' /></div>',
			'email' => '<div class="flex-column"><input id="email" name="email" type="text" value="'. esc_attr( $commenter['comment_author_email'] ) .'" placeholder="' . esc_attr__('E-Mail', 'brookside') . ' *" size="30"' . $aria_req . ' /></div></div>',
		);
		if( get_option('show_comments_cookies_opt_in') ){
			$fields['cookies'] = '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" /><label for="wp-comment-cookies-consent">' .get_theme_mod('brookside_gdpr_checkbox_consent', 'Save my name, email, and website in this browser for the next time I comment.'). '</label></p>';
		}
		return $fields;
	}
}	
if(!function_exists('brookside_comment')){
	function brookside_comment( $comment, $args, $depth ) {
	   $GLOBALS['comment'] = $comment; ?>
	   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	   <div id="comment-<?php comment_ID(); ?>" class="comment-body clearfix"> 
	   			<?php
				if ( function_exists( 'brookside_get_additional_user_meta_thumb' ) && get_comment()->user_id ){
					// retrieve our additional author meta info
					$user_meta_image = esc_attr( get_the_author_meta( 'user_meta_image', get_comment()->user_id ) );
				    // make sure the field is set
				    if ( isset( $user_meta_image ) && $user_meta_image ) {
				        // only display if function exists
				        ?>
							<div class="author-avatar alignleft"><img alt="<?php esc_attr_e('author photo', 'brookside'); ?>" src="<?php echo brookside_get_additional_user_meta_thumb(); ?>" /></div>
				        <?php } ?>
				<?php } else {
					if( get_avatar( $comment, '70', '' ) ) { echo '<div class="author-avatar alignleft">'.get_avatar( $comment, '70', '' ).'</div>'; }
				} ?>
	        <div class="comment-text">
				<div class="author">
				 	<h2 class="author-title"><?php printf( esc_html__( '%s', 'brookside'), get_comment_author_link() ) ?></h2>
				 	<div class="flex-end">
				 		<div class="meta-date"><?php printf(esc_html__('%1$s', 'brookside'), get_comment_date(get_option('date_format'))) ?><?php edit_comment_link( esc_html__( '(Edit)', 'brookside'),' ','' ) ?></div>  
				 		<div class="comment-reply"><span>X</span><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
				 	</div>
				</div>
				<div class="text clearfix">
				<?php comment_text() ?>
				<?php if ( $comment->comment_approved == '0' ) : ?>
			        <em><?php esc_html_e( 'Your comment is awaiting moderation.', 'brookside') ?></em>
			        <br />
		      	<?php endif; ?>
		      </div>
	      	</div>
	   </div>
	<?php
	}
}
if( !function_exists('rwmb_meta') ){
	function rwmb_meta($key) {
		return false;
	}
}
if( ! function_exists( 'rwmb_get_value' ) ) {
    function rwmb_get_value( $key, $args = '', $post_id = null ) {
        return '';
    }
}
if ( ! function_exists( 'rwmb_the_value' ) ) {
    function rwmb_the_value( $key, $args = '', $post_id = null, $echo = true ) {
        return false;
    }
}
// Define Content Width 
if(! isset( $content_width)){
	$content_width = 845;
	function brookside_adjust_content_width() {
		if( is_page_template( 'page-nosidebar.php' ) || is_page_template( 'page-fullwidth.php' )){
			global $content_width;
			$content_width = 1170;
		}
	}   
	add_action( 'template_redirect', 'brookside_adjust_content_width' );
}
/* ------------------------------------------------------------------------ */
/* Automatic Plugin Activation */
require_once(trailingslashit( get_template_directory() ). 'framework/inc/class-tgm-plugin-activation.php');
/* ------------------------------------------------------------------------ */
// Recommended plugins activation
if(!function_exists('brookside_register_required_plugins')){
	add_action('tgmpa_register', 'brookside_register_required_plugins');
	function brookside_register_required_plugins() {
		$plugins = array(
			array(
	        	'name'      => esc_html__('Contact Form 7', 'brookside'),
	        	'slug'      => 'contact-form-7',
				'required' 	=> false, 
	        ),
			array(
	        	'name'      => esc_html__('Meta Box', 'brookside'),
	        	'slug'      => 'meta-box',
				'required' 	=> false, 
	        ),
	        array(
	        	'name'      => esc_html__('WP Mega Menu', 'brookside'),
	        	'slug'      => 'wp-megamenu',
				'required' 	=> false, 
	        ),
	        array(
	        	'name'      => esc_html__('Kadence Blocks', 'brookside'),
	        	'slug'      => 'kadence-blocks',
				'required' 	=> false, 
	        ),
	        array(
	        	'name'      => esc_html__('One Click Demo Import','brookside'),
	        	'slug'      => 'one-click-demo-import',
				'required' 	=> false,
	        ),
	        array(
	        	'name'      		=> esc_html__('Revolution slider','brookside'),
	        	'slug'      		=> 'revslider',
	        	'source'   			=> esc_url('http://artstudioworks.net/recommended-plugins/revslider.zip'),
				'required' 			=> false,
	        ),
	        array(
	        	'name'      		=> esc_html__('Brookside elements','brookside'),
	        	'slug'      		=> 'brookside-elements',
	        	'source'   			=> trailingslashit( get_template_directory_uri() ).'framework/plugins/brookside-elements.zip',
				'required' 			=> true,
	        )
		);
		global $wp_version;
		if ( version_compare( $wp_version, '5.0', '<' ) ) {
			$plugins[] = array(
	        	'name'      => esc_html__('Gutenberg', 'brookside'),
	        	'slug'      => 'gutenberg',
				'required' 	=> false, 
	        );
		}
		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'domain'       		=> 'brookside',         	// Text domain - likely want to be the same as your theme.
			'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
			'menu'         		=> 'install-required-plugins', 	// Menu slug
			'has_notices'      	=> true,                       	// Show admin notices or not
			'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
			'message' 			=> '',							// Message to output right before the plugins table
			'strings'      		=> array(
				'page_title'                       			=> esc_html__( 'Install Required and Recommended Plugins', 'brookside' ),
				'menu_title'                       			=> esc_html__( 'Install Plugins', 'brookside' ),
				'installing'                       			=> esc_html__( 'Installing Plugin: %s', 'brookside' ), // %1$s = plugin name
				'oops'                             			=> esc_html__( 'Something went wrong with the plugin API.', 'brookside' ),
				'return'                           			=> esc_html__( 'Return to Required Plugins Installer', 'brookside' ),
				'plugin_activated'                 			=> esc_html__( 'Plugin activated successfully.', 'brookside' ),
				'complete' 									=> esc_html__( 'All plugins installed and activated successfully. %s', 'brookside' ), // %1$s = dashboard link
				'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
			)
		);
		tgmpa($plugins, $config);
	}	
}

if(!function_exists('brookside_import_files')){
	function brookside_import_files() {
	    return array(
	        array(
	            'import_file_name'           => 'Main Demo',
	            'local_import_file'            => trailingslashit( get_template_directory() ).'framework/demos/maindemo/demo.xml',
	            'local_import_widget_file'     => trailingslashit( get_template_directory() ).'framework/demos/maindemo/widgets.wie',
	            'local_import_customizer_file' => trailingslashit( get_template_directory() ).'framework/demos/maindemo/customizer.dat',
	            'import_preview_image_url'   => trailingslashit( get_template_directory_uri() ).'framework/demos/maindemo/demo.png',
	            'preview_url'                => 'https://www.brookside.artstudioworks.net/',
	        ),
	        array(
	            'import_file_name'           => 'Main Demo with Shop',
	            'local_import_file'            => trailingslashit( get_template_directory() ).'framework/demos/shopdemo/demo.xml',
	            'local_import_widget_file'     => trailingslashit( get_template_directory() ).'framework/demos/shopdemo/widgets.wie',
	            'local_import_customizer_file' => trailingslashit( get_template_directory() ).'framework/demos/shopdemo/customizer.dat',
	            'import_preview_image_url'   => trailingslashit( get_template_directory_uri() ).'framework/demos/shopdemo/demo.jpg',
	            'preview_url'                => 'https://www.brookside.artstudioworks.net/shop-main',
	        )
	    );
	}
	add_filter( 'pt-ocdi/import_files', 'brookside_import_files' );
}
if( !function_exists('brookside_before_widgets_import') ){
	function brookside_before_widgets_import( $selected_import ){
		if( 'Main Demo' === $selected_import['import_file_name'] ){
			$new_sidebars = array('AboutMe', 'ContactMe', 'SideImagePost');
			foreach ($new_sidebars as $sidebar) {
				$sidebars = sidebar_generator::get_sidebars();
				$name = str_replace(array("\n","\r","\t"),'', $sidebar);
				$id = sidebar_generator::name_to_class($name);
				if(!isset($sidebars[$id])){
					$sidebars[$id] = $name;
					sidebar_generator::update_sidebars($sidebars);
				}
			}
		}
	}
	add_action( 'pt-ocdi/before_widgets_import', 'brookside_before_widgets_import' );
}
if(!function_exists('brookside_after_import_setup')){
	function brookside_after_import_setup( $selected_import ) {
	    // Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'Main menu', 'nav_menu' );
    	$secondary_menu = get_term_by( 'name', 'Side menu', 'nav_menu' );

    	set_theme_mod( 'nav_menu_locations', array(
            'main_navigation' => $main_menu->term_id,
            'mobile_navigation' => $secondary_menu->term_id,
            'side_navigation' => $secondary_menu->term_id,
            'hidden_navigation' => $secondary_menu->term_id
        ));

		if ( class_exists( 'RevSlider' ) ) {
			if ( 'Main Demo with Shop' === $selected_import['import_file_name'] ) {
				$slider_array = array(
					trailingslashit( get_template_directory_uri() ).'framework/demos/shopdemo/shop-slider.zip'
				);
				$slider = new RevSlider();
				foreach($slider_array as $filepath){
					$slider->importSliderFromPost(true,true,$filepath);  
				}
				esc_html_e(' Slider processed', 'brookside');

		    }
		}

		// Assign front page and posts page (blog page).
	    $front_page_id = get_page_by_title( 'Home' );

	    update_option( 'show_on_front', 'page' );
	    update_option( 'page_on_front', $front_page_id->ID );
	}
	add_action( 'pt-ocdi/after_import', 'brookside_after_import_setup' );
	add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
}
if(!class_exists('Brookside_Mobile_Walker_Nav_Menu')){
	class Brookside_Mobile_Walker_Nav_Menu extends Walker_Nav_Menu {
	  function start_lvl(&$output, $depth = 0, $args = array()) {
	    $indent = str_repeat("\t", $depth);
	    $output .= "\n$indent<ul class=\"dl-submenu\">\n";
	  }
	}
}

function brookside_menu_logo_center( $items, $args ) {
    // Checks to see if the menu passed in is the pbrooksidery one, and creates the logo item for it
    $logo_item = '';
    if ( $args->theme_location == 'main_navigation' ) {
        $logo_item = '<li class="menu-item-logo"><div class="logo">' . brookside_get_logo() . '</div></li>';
    }

    //Gets the location of the menu element I want to insert the logo before
    $index = round( brookside_count_top_lvl_items() / 2 ) + 1;
    //Gets the menu item I want to insert the logo before
    $menu_item = brookside_get_menu_item( $index );
    $insert_before = '<li id="menu-item-' . $menu_item->ID;
    if(function_exists('wp_megamenu')){
    	$wpmm_nav_location_settings = get_wpmm_option('main_navigation');
	 	if(!empty($wpmm_nav_location_settings['is_enabled'])){
	 		$insert_before = '<li id="wp-megamenu-item-' . $menu_item->ID;
	 	} 
    }
    $menu_update = substr_replace( $items, $logo_item, strpos( $items, $insert_before ), 0 );
    if( get_theme_mod('brookside_header_search_button', false) && $args->theme_location == 'main_navigation' ) {
		$search_button = '<li class="search-link"><a href="javascript:void(0);" class="search-button"><i class="fa fa-search"></i></a><li>';
		$menu_update .= $search_button;
	}
	if( get_theme_mod('brookside_header_shopping_cart', false) && class_exists('WooCommerce') ) { 
		$cart_url = wc_get_cart_url();
		$count = WC()->cart->cart_contents_count;
		$menu_update .= '<li class="cart-main menu-item cart-contents">';
			$menu_update .= '<a class="my-cart-link" href="<?php echo esc_url($cart_url);?>"><i class="la la-shopping-cart"></i>';
			if ( $count > 0 ) {
		        $menu_update .='<span class="cart-contents-count">'.esc_html( $count ).'</span>';
		    }
			$menu_update .='</a>';
		$menu_update .= '</li>';
	}
    $items = $menu_update;
    return $items;
}
function brookside_menu_item_search( $items, $args ){
	$logo_item = '';
	if ( $args->theme_location == 'main_navigation' ) {
        $logo_item = '<li class="menu-item-search"><div class="search-link"><a href="javascript:void(0);" class="search-button"><i class="fa fa-search"></i></a></div></li>';
    }
    $items .= $logo_item;
    return $items;
}
//Counts the number of top level items in the menu
function brookside_count_top_lvl_items() {
    $items = brookside_get_menu_items();
    $counter = 0;
    foreach ( $items as $val ) {
        if ( $val->menu_item_parent === '0' ) {
            $counter++;
        }
    }
    return $counter;
}
//Returns the menu item to insert the logo before
function brookside_get_menu_item( $index ) {
    $items = brookside_get_menu_items();
    $counter = 0;
    foreach ( $items as $val ) {
        if ( $val->menu_item_parent === '0' ) {
            $counter++;
        }
        if ( $counter == $index ) {
            return $val;
        }
    }
}
//Returns the logo menu item. I have it separated because my theme allows for varied logos
function brookside_get_logo() {
    if(get_theme_mod('brookside_media_logo','') != "") {
		$logo_item = '<a href="'.esc_url(home_url('/')).'" class="logo_main"><img src="'.esc_url(get_theme_mod('brookside_media_logo')).'" alt="'.esc_attr(get_bloginfo('name')).'" /></a>';
	} else {
		$logo_item = '<a href="'.esc_url(home_url('/')).'" class="logo_text">'.esc_attr( get_bloginfo('name') ).'</a>';
	}
    return $logo_item;
}
function brookside_get_menu_items() {
    $locations = get_nav_menu_locations();
    $menu = wp_get_nav_menu_object( $locations['main_navigation'] );
    $items = wp_get_nav_menu_items( $menu );
    return $items;
}

if(!class_exists('Brookside_Custom_Menu_Walker')){
	class Brookside_Custom_Menu_Walker extends Walker_Nav_Menu {
		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$ex_li = '';
				$ex_li = "<li class=\"back-to-menu\">".esc_html__('back', 'brookside')."</li>";
			$indent = str_repeat( "\t", $depth );
			$output .= "\n{$indent}<ul class=\"sub-menu\">\n".$ex_li;
		}   
	}
}

if(!function_exists('brookside_widget_custom_walker')){
	function brookside_widget_custom_walker( $args ) {
	    return array_merge( $args, array(
	        'walker' => new Brookside_Custom_Menu_Walker(),
	        // another setting go here ... 
	    ) );
	}
	add_filter( 'widget_nav_menu_args', 'brookside_widget_custom_walker' );
}
if(!function_exists('brookside_embed_wrap')){
	add_filter('embed_oembed_html', 'brookside_embed_wrap', 10, 4);
	function brookside_embed_wrap($html, $url, $attr, $post_ID) {
	    if (strpos($url, 'youtube') !== false || strpos($url, 'vimeo') !== false ) {
	        $html = '<div class="video-container">'.$html.'</div>';
	    }
	    return $html;
	}
}

if(!function_exists('brookside_post_layout_classes')){
	add_filter('body_class', 'brookside_post_layout_classes');
	function brookside_post_layout_classes($classes) {
		$tmp = rwmb_get_value( 'brookside_post_layout' );
        if( is_single() && !is_array($tmp) && $tmp != '' ){
        	$classes[] = 'post-layout-'.$tmp;
        }
        $header_type = rwmb_get_value('brookside_header_variant');
		if(!is_array($header_type) && $header_type != '' && $header_type != 'default'){
			$header_var = $header_type;
		} else {
			$header_var = get_theme_mod('brookside_header_variant', 'header-version4');
		}
		$classes[] = $header_var;
        return $classes;
	}
}
if(!function_exists('brookside_add_meta_viewport')){
	function brookside_add_meta_viewport(){
		if( get_theme_mod('brookside_responsiveness', true) ) {
			echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">';
		}
	}
	add_action('brookside_header_meta', 'brookside_add_meta_viewport');
}
if( !function_exists('brookside_get_sidebar_position')){
	function brookside_get_sidebar_position(){
		$sidebar_pos = '';
		$brookside_post_sidebar = 'default';

		if( rwmb_get_value( 'brookside_post_sidebar', get_the_ID() ) == '' || rwmb_get_value( 'brookside_post_sidebar', get_the_ID() ) == 'default' ){
			$brookside_post_sidebar = 'default';
		} elseif (rwmb_get_value( 'brookside_post_sidebar', get_the_ID() ) == 'none') {
			$brookside_post_sidebar = 'none';
		} else {
			$brookside_post_sidebar = 'span9 '.rwmb_get_value( 'brookside_post_sidebar', get_the_ID() );
		}

		if( $brookside_post_sidebar == 'none' ){
			$sidebar_pos ='span12';
		} elseif( $brookside_post_sidebar == 'default' ){
			if (get_theme_mod('brookside_single_post_sidebar', 'none') == 'none'){
				$sidebar_pos = 'span12';
			} else {
				$sidebar_pos = 'span9 '.get_theme_mod('brookside_single_post_sidebar', 'none');
			}
		} else {
			$sidebar_pos = $brookside_post_sidebar;
		}
		if( !is_active_sidebar('blog-widgets') && ( get_theme_mod('brookside_single_post_sidebar', 'none') != 'none' || $brookside_post_sidebar != 'none' ) ) {
			$sidebar_pos .=' no_widgets_sidebar';
		}

		return $sidebar_pos;
	}
}
if( !function_exists('brookside_get_footer_display_option')){
	function brookside_get_footer_display_option(){

		$brookside_footer_display = 'default';

		if( rwmb_meta( 'brookside_display_page_footer', get_the_ID() ) == '' || !rwmb_meta( 'brookside_display_page_footer', get_the_ID() ) || rwmb_meta( 'brookside_display_page_footer', get_the_ID() ) == 'default' ){
			$brookside_footer_display = 'default';
		} else {
			$brookside_footer_display = rwmb_meta( 'brookside_display_page_footer', get_the_ID() );
		}

		if( $brookside_footer_display == 'default' ){
			$brookside_footer_display = get_theme_mod('brookside_footer_layout', 'widgetized');
		}

		return $brookside_footer_display;
	}
}
if( !function_exists('brookside_get_post_title_display_option')){
	function brookside_get_post_title_display_option(){

		$brookside_title_display = 'default';

		if( rwmb_meta( 'brookside_display_post_title', get_the_ID() ) == '' || !rwmb_meta( 'brookside_display_post_title', get_the_ID() ) || rwmb_meta( 'brookside_display_post_title', get_the_ID() ) == 'default' ){
			$brookside_title_display = 'default';
		} else {
			$brookside_title_display = rwmb_meta( 'brookside_display_post_title', get_the_ID() );
		}

		if( $brookside_title_display == 'default' ){
			$brookside_title_display = get_theme_mod('brookside_single_post_title_block', 'above');
		}

		return $brookside_title_display;
	}
}
if( !function_exists('brookside_get_header_style')){
	function brookside_get_header_style(){

		$brookside_header_style = 'default';

		if( rwmb_meta( 'brookside_header_color_style', get_the_ID() ) == '' || rwmb_meta( 'brookside_header_color_style', get_the_ID() ) == 'default' ){
			$brookside_header_style = 'default';
		} else {
			$brookside_header_style = rwmb_meta( 'brookside_header_color_style', get_the_ID() );
		}
		
		if( $brookside_header_style == 'default' ){
			$brookside_header_style = get_theme_mod('brookside_header_style', 'header-light');
		}

		return $brookside_header_style;
	}
}
if(!function_exists('brookside_single_post_gallery')){
	function brookside_single_post_gallery($postID = false, $echo = true){
		if(!$postID){
			$postID = get_the_ID();
		}
		$out = '';
		$gallery_type = rwmb_get_value('brookside_gallery_post_layout');
		$post_layout = rwmb_get_value( 'brookside_post_layout' );
		if(is_array($post_layout)){
			$post_layout = '';
		}
		if( $post_layout == 'default'){
			$post_layout = get_theme_mod( 'brookside_single_post_layout', 'wide' );
		}
		if($post_layout == 'fullwidth-alt' || $post_layout == 'fullwidth'){
			$gallery_type = 'gallery_block2';
		}
		$autoheight = rwmb_get_value('brookside_gallery_autoheight');
		$img_size = 'large';
		if( rwmb_get_value('brookside_post_layout') == 'fullwidth' ) {
			$img_size = 'brookside-fullwidth-slider';
		} elseif( rwmb_get_value('brookside_post_layout') == 'wide' ) {
			$img_size = 'large';
		} elseif( rwmb_get_value('brookside_post_layout') == 'sideimage' ){
			$img_size = 'brookside-masonry';
		} else {
			if( rwmb_get_value('brookside_post_sidebar') == 'none' || ( rwmb_get_value('brookside_post_sidebar') == 'default' && get_theme_mod('brookside_sidebar_pos', 'sidebar-right') != 'none' ) ) {
				$img_size = 'large';
			} else {
				$img_size = 'post-thumbnail';
			}
		}
		$images = rwmb_get_value( 'brookside_gallery_images', 'type=image&size='.$img_size );
		$autoplay = rwmb_get_value('brookside_gallery_autoplay');
		$loop = rwmb_get_value('brookside_gallery_loop');
		if($autoheight ){
			$autoheight = 'true';
		} else {
			$autoheight = 'false';
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
		if ( !empty($images) ){
			switch ($gallery_type) {
				case 'gallery_block':
					$i = 1;
					$out .= '<div class="gallery-block-wrap">';
					$out .= '<div class="gallery-block">';
						$count = 1;
						foreach( $images as $image ) :
							if($count % 2 == 0 ){
								$image['url'] = wp_get_attachment_image_url($image['ID'], 'brookside-masonry');
							}
							$image_alt = (isset($image['alt']) && $image['alt'] != '') ? $image['alt'] : get_the_title();
							$out .= '<div class="gallery-image"><img src="'.esc_url($image['url']).'" alt="'.esc_attr($image_alt).'" /></div>';
							if( $count % 2 == 0 ){
								$out .= '</div><div class="gallery-block">';
							}
							$count++;
						endforeach;
						$out .= '</div>';
						$out .= '</div>';
					break;
				case 'collage':
					$i = 1;
					$out .= '<div class="gallery-collage-wrap">';
					$out .= '<div class="gallery-collage">';
						$count = 1;
						foreach( $images as $image ) :
							if($count % 2 == 0 || $count % 3 == 0){
								$image['url'] = wp_get_attachment_image_url($image['ID'], 'brookside-extra-medium');
							}
							if( $i % 2 == 0 ){
								$i = 0;
								$image['url'] = wp_get_attachment_image_url($image['ID'], 'brookside-extra-medium');
							}
							$image_alt = (isset($image['alt']) && $image['alt'] != '') ? $image['alt'] : get_the_title();
							$out .= '<div class="gallery-image"><img src="'.esc_url($image['url']).'" alt="'.esc_attr($image_alt).'" /></div>';
							if( $count % 3 == 0 ){
								$i++;
								$out .= '</div><div class="gallery-collage">';
							}
							$count++;
						endforeach;
						$out .= '</div>';
						$out .= '</div>';
					break;
				case 'gallery_block2':
					$owl_custom = 'jQuery(window).load(function(){
						var owl = jQuery(".single-post-gallery").owlCarousel({
				            items:2,
				            autoplay:'.$autoplay.',
				            margin:0,
				            singleItem:true,
				            loop:'.$loop.',
				            nav:true,
				            navRewind:false,
				            navText: [ \'<span class="long-arrow-left"></span>\',\'<span class="long-arrow-right"></span>\' ],
				            dots:false,
				            autoHeight:'.$autoheight.',
				            themeClass: "owl-gallery"
		    			});	
					});';
					wp_add_inline_script('owl-carousel', $owl_custom);
					$out .= '<div class="single-post-gallery">';
					foreach( $images as $image ) :
						$out .= '<div><div class="overlay-bg"></div><img src="'.esc_url($image['url']).'" alt="'.esc_attr($image['alt']).'" /></div>';
					endforeach;
					$out .= '</div>';
					break;
				default:
					$owl_custom = 'jQuery(window).load(function(){
							var owl = jQuery(".single-post-gallery").owlCarousel({
					            items:1,
					            autoplay:'.$autoplay.',
					            singleItem:true,
					            loop:'.$loop.',
					            nav:true,
					            navRewind:false,
					            navText: [ \'<span class="long-arrow-left"></span>\',\'<span class="long-arrow-right"></span>\' ],
					            dots:false,
					            autoHeight:'.$autoheight.',
					            themeClass: "owl-gallery"
			    			});
					});';
					wp_add_inline_script('owl-carousel', $owl_custom);
					if( rwmb_get_value('brookside_post_layout') == 'sideimage' ){
						$type = ' slideshow_2';
					} else {
						$type = '';
					}
					$out .= '<div class="single-post-gallery'.$type.'">';
					foreach( $images as $image ) :
						$out .= '<div><a href="'.esc_url($image['full_url']).'" data-lightbox="lightbox-gallery" data-caption="'.esc_attr($image['caption']).'"><div class="overlay-bg"></div><img src="'.esc_url($image['url']).'" alt="'.esc_attr($image['alt']).'" /></a></div>';
					endforeach;
					$out .= '</div>';
					break;
			}
		} elseif( has_post_thumbnail() ) {
			$out .= '<figure class="post-img">'.get_the_post_thumbnail($postID, $img_size).'</figure>';
		}
		if($echo){
			echo ''.$out;
		} else {
			return $out;
		}
	}
}
if( !function_exists('brookside_single_post_format_content') ){
	function brookside_single_post_format_content($echo = true) {
		$post_format = get_post_format();
		global $post;
		global $_wp_additional_image_sizes;
		$img_size = 'post-thumbnail';
		if( rwmb_meta('brookside_post_layout') == 'fullwidth' || rwmb_meta('brookside_post_layout') == 'fullwidth-alt' ) {
			$img_size = 'brookside-fullwidth-slider';
		} elseif( rwmb_meta('brookside_post_layout') == 'wide' ) {
			$img_size = 'large';
		} elseif( rwmb_meta('brookside_post_layout') == 'sideimage' ){
			$img_size = 'brookside-masonry';
		} elseif( rwmb_meta('brookside_post_layout') == 'default' ){
			if( get_theme_mod('brookside_single_post_layout', 'wide') == 'fullwidth' || get_theme_mod('brookside_single_post_layout', 'wide') == 'fullwidth-alt' ) {
				$img_size = 'brookside-fullwidth-slider';
			} elseif( get_theme_mod('brookside_single_post_layout', 'wide') == 'wide' ) {
				$img_size = 'large';
			} elseif( get_theme_mod('brookside_single_post_layout', 'wide') == 'sideimage' ){
				$img_size = 'brookside-masonry';
			}
		} else {
			if( rwmb_meta('brookside_post_sidebar') == 'none' || ( rwmb_meta('brookside_post_sidebar') == 'default' && get_theme_mod('brookside_single_post_sidebar', 'none') == 'none' ) ) {
				$img_size = 'large';
			} else {
				$img_size = 'post-thumbnail';
			}
		}
		$width  = get_option( "{$img_size}_size_w" );
		$height = get_option( "{$img_size}_size_h" );
		if( !$width || !$height ){
			$width = $_wp_additional_image_sizes["{$img_size}"]['width'];
			$height = $_wp_additional_image_sizes["{$img_size}"]['height'];
		}
		if( !$width || !$height || $img_size == 'brookside-masonry'){
			$proportions = '56.25';
		} else {
			$proportions = ($height/$width) * 100;
		}
		$out = '';
		switch ($post_format) {
			case 'gallery':
				$out = brookside_single_post_gallery(false, false);
				break;
			case 'video':
				$media = rwmb_meta('brookside_post_format_video', $post->ID);
				$url = rwmb_get_value( 'brookside_post_format_video' );

				if( $media && $url != '' ){
					$out = '<div class="video-container">'.$media.'</div>';
				}
				break;
			case 'audio':
				$media = rwmb_get_value('brookside_post_format_audio');
				$url = rwmb_get_value( 'brookside_post_format_audio' );
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
					
				}
				break;
			case 'link':
				$out = brookside_single_post_link(false, false);
				break;
			case 'quote':
				$text = rwmb_get_value( 'brookside_post_format_quote_text' );
				if ( $text != '' ){
					$cite = rwmb_get_value( 'brookside_post_format_quote_cite' );
					$text_color = rwmb_get_value( 'brookside_post_format_quote_text_color' );
					$bg_color = rwmb_get_value( 'brookside_post_format_quote_bg_color' );
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
					
				}
				break;
			case 'image':
				$out = '';
				break;
			default:
				$check_media = rwmb_get_value('brookside_post_format_embed_replace');
				$media = rwmb_get_value( 'brookside_post_format_embed' );
				$url = rwmb_get_value( 'brookside_post_format_embed' );
				if( $check_media && $media && $url != ''){
					$proportions_supports = array('cloudup','collegehumor', 'funnyordie', 'flickr', 'youtube', 'dailymotion', 'vimeo', 'ted', 'videopress', 'vine', 'wordpress.tv');
					$check = false;
					foreach ($proportions_supports as $site) {
						if( strpos( $media, $site ) ){
							$check = true;
						}
					}
					if($media && $url != '') {
						if($check){
							$out = '<div class="video-container">'.$media.'</div>';
						} else {
							$out = '<div class="iframe-container">'.$media.'</div>';
						}
					}
				} elseif( has_post_thumbnail() ){
					$out = '<figure class="post-img"><img src="'.get_the_post_thumbnail_url($post->ID, $img_size).'" alt="'.get_the_title().'" ></figure>';
				}
				break;
		}
		if( $echo ){
			echo ''.$out;
		} else {
			return $out;
		}
	}
}
if( !function_exists('brookside_get_post_format_content') ){
	function brookside_get_post_format_content($echo = true, $img_size){
		global $_wp_additional_image_sizes;
		global $post;
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
		if( has_post_thumbnail() ){
			$out = '<figure class="post-img"><a href="'.esc_url(get_the_permalink()).'" rel="bookmark">'.get_the_post_thumbnail($post->ID, $img_size).'</a></figure>';
		}
		if( $echo ){
			echo ''.$out;
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
if( !function_exists('BrooksideSetPostViews')){
	function BrooksideSetPostViews() {
		return false;
	}
}
if(!function_exists('brookside_single_post_link')){
	function brookside_single_post_link($postID = false, $echo = true){
		if(!$postID){
			$postID = get_the_ID();
		}
		$out = '';
		$img_size = 'large';
		if( rwmb_get_value('brookside_post_layout') == 'fullwidth' ) {
			$img_size = 'brookside-fullwidth-slider';
		} elseif( rwmb_get_value('brookside_post_layout') == 'wide' ) {
			$img_size = 'large';
		} elseif( rwmb_get_value('brookside_post_layout') == 'sideimage' ){
			$img_size = 'brookside-masonry';
		} else {
			if( rwmb_get_value('brookside_post_sidebar') == 'none' || ( rwmb_get_value('brookside_post_sidebar') == 'default' && get_theme_mod('brookside_sidebar_pos', 'sidebar-right') != 'none' ) ) {
				$img_size = 'large';
			} else {
				$img_size = 'post-thumbnail';
			}
		}
		$link = rwmb_get_value( 'brookside_post_format_link');
		$title = rwmb_get_value( 'brookside_post_format_link_title' );
		if($title == '') {
			$title = $link;
		}
		if ( $link != '' && has_post_thumbnail() ){
			$out .= '<figure class="post-img"><a class="overlay-link" href="'.esc_url($link).'" rel="bookmark"><h2>'.$title.'</h2></a>'.get_the_post_thumbnail($postID, $img_size).'</figure>';
		} elseif( has_post_thumbnail() ) {
			$out .= '<figure class="post-img">'.get_the_post_thumbnail($postID, $img_size).'</figure>';
		}
		if($echo){
			echo ''.$out;
		} else {
			return $out;
		}
	}
}
if(!function_exists('brookside_ajax_search')) {
	//now hook into wordpress ajax function to catch any ajax requests
	add_action( 'wp_ajax_brookside_ajax_search', 'brookside_ajax_search' );
	add_action( 'wp_ajax_nopriv_brookside_ajax_search', 'brookside_ajax_search' );

	function brookside_ajax_search()
	{

	    unset($_REQUEST['action']);
	    if(empty($_REQUEST['s'])) die();

	    $defaults = array('numberposts' => 4, 'post_type' => 'post', 'post_status' => 'publish', 'post_password' => '', 'suppress_filters' => false);
	    $_REQUEST['s'] = apply_filters( 'get_search_query', $_REQUEST['s']);

	    $query = array_merge($defaults, $_REQUEST);
	    $query = http_build_query($query);
	    $posts = get_posts( $query );

	    if(empty($posts))
	    {
	        $output  = "<span class='ajax_search_entry ajax_not_found'>";
	        $output .= "<span class='ajax_search_title'>";
            $no_criteria_matched = esc_html__("Sorry, no posts matched your criteria", 'brookside');
            $output .= $no_criteria_matched;
	        $output .= "</span>";
	        $output .= "</span>";
	        echo ''.$output;
	        die();
	    }

	    //if we got posts resort them by post type
	    $output = "";
	    $sorted = array();
	    $post_type_obj = array();
	    foreach($posts as $post)
	    {
	        $sorted[$post->post_type][] = $post;
	        if(empty($post_type_obj[$post->post_type]))
	        {
	            $post_type_obj[$post->post_type] = get_post_type_object($post->post_type);
	        }
	    }

	    //now we got everything we need to preapre the output
	        $output .= "<ul class='unstyled'>";
	        foreach($posts as $post)
	        {
	            $image = get_the_post_thumbnail( $post->ID, 'medium' );
	            $excerpt = "";
	            $link = get_permalink($post->ID);
	            $output .= "<li class='post'>";
	            $output .= '<figure>';
	            $output .= '<a href="'.$link.'">'.$image.'</a></figure>';
	            $output .= '<div class="extra-wrap">';
	            $output .= '<div class="meta-categories">'.get_the_category_list(', ', 'single', $post->ID ).'</div>';
	            $output .= '<header class="title">';
				$output .= '<h3 itemprop="headline"><a href="'.$link.'" rel="bookmark">'.get_the_title($post->ID).'</a></h3>';
				$output .= '</header>';
				$output .= "</div>";
	            $output .= "</li>";
	        }

	    $query =  http_build_query($_REQUEST);
        $label = esc_html__('View all results','brookside');
        $output .= "</ul>";
	    $output .= "<a class='button' href='".home_url('?' . $query )."'>".$label."</a>";
	    echo ''.$output;
	    die();
	}
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
			$readingTime = esc_html__('< 1 min read', 'brookside');
		} elseif($readingTime == 1) {
			$readingTime = esc_html__('1 min read', 'brookside');
		} else {
			$readingTime = $readingTime.' '.esc_html__('mins read', 'brookside');
		}

		if($echo){ 
			echo ''.$readingTime;
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
if( class_exists('WooCommerce') ){
	if(!function_exists('brookside_woocommerce_my_single_title')){
		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
		add_action('woocommerce_single_product_summary', 'brookside_woocommerce_my_single_title', 5);
		function brookside_woocommerce_my_single_title() {
			echo '<header class="title"><h2>'.get_the_title().'</h2></header>';
		}
	}
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price');
	function brookside_price_add_to_cart_wrapper_1(){
		echo '<div class="add_to_cart_wrapper">';
	}
	function brookside_price_add_to_cart_wrapper_2(){
		echo '</div>';
	}
	add_action( 'woocommerce_before_shop_loop_item', 'brookside_price_add_to_cart_wrapper_1', 1);
	add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 11);
	add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 10);
	add_action( 'woocommerce_before_shop_loop_item_title', 'brookside_price_add_to_cart_wrapper_2', 20);
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
	add_action( 'woocommerce_before_cart', function(){ echo '<div class="flex-cart">'; }, 50);
	add_action( 'woocommerce_after_cart', function(){ echo "</div>"; }, 5);
	add_action('woocommerce_before_cart_table', function(){ echo '<h2>'.esc_html__('Shopping bag', 'brookside').'</h2>'; }, 5);
	if(function_exists('BrooksideShareboxProduct')){
		add_action('woocommerce_single_product_summary', 'BrooksideShareboxProduct', 80);
	}
	add_action( 'woocommerce_checkout_before_customer_details', function(){echo '<div class="row-fluid">';}, 1 );
	add_action( 'woocommerce_checkout_before_customer_details', function(){echo '<div class="span7">';}, 5 );
	add_action( 'woocommerce_checkout_after_customer_details', function(){echo '</div>';}, 1 );

	add_action( 'woocommerce_checkout_before_order_review_heading', function(){echo '<div class="span5">';}, 1 );
	add_action( 'woocommerce_checkout_after_order_review', function(){echo '</div>';}, 50 );

	add_action( 'woocommerce_checkout_after_order_review', function(){echo '</div>';}, 100 );

	add_action( 'woocommerce_checkout_shipping', function(){ echo '<h2 class="additional_information">'.esc_html__('Additional information', 'brookside').'</h2>';}, 1);
	add_action( 'woocommerce_checkout_order_review', function(){ echo '<h2 class="order-review-payment">'.esc_html__('Payment method', 'brookside').'</h2>';}, 15);
	add_action('woocommerce_after_single_product', 'woocommerce_output_related_products', 20);
	add_filter( 'woocommerce_output_related_products_args', 'brookside_related_products_args' );
	function brookside_related_products_args( $args ) {
		$args['posts_per_page'] = 4; // 4 related products
		$args['columns'] = 4; // arranged in 4 columns
		return $args;
	}
	remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
	add_filter( 'woocommerce_ship_to_different_address_checked', '__return_false' );
	/**
	 * Rename product data tabs
	 */
	add_filter( 'woocommerce_product_tabs', 'brookside_rename_tabs', 98 );
	function brookside_rename_tabs( $tabs ) {
		global $product;
		if ( $product && ( $product->has_attributes() || apply_filters( 'wc_product_enable_dimensions_display', $product->has_weight() || $product->has_dimensions() ) ) ) {
			$tabs['additional_information']['title'] = __( 'Material and Care', 'brookside' );	// Rename the additional information tab
		} else {
			unset( $tabs['additional_information'] );
		}
		return $tabs;

	}

	add_filter( 'woocommerce_show_page_title', 'brookside_disable_shop_title');
	function brookside_disable_shop_title($true){
		return false;
	}

	add_action('woocommerce_before_shop_loop', 'brookside_woocommerce_shop_title', 5);
	function brookside_woocommerce_shop_title() {
		echo '<header class="title"><h2>'.woocommerce_page_title(false).'</h2></header>';
	}

	add_filter('woocommerce_sale_flash', 'brookside_change_sale_content', 10, 3);
	function brookside_change_sale_content($content, $post, $product){
	   $content = '<span class="onsale">'.esc_html__( 'Sale', 'brookside' ).'</span>';
	   return $content;
	}

	remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
	function brookside_woocommerce_pagination() {
		echo '<div id="pagination">'.brookside_custom_pagination().'</div>'; 		
	}
	add_action( 'woocommerce_after_shop_loop', 'brookside_woocommerce_pagination', 10);
	/**
	 * Ensure cart contents update when products are added to the cart via AJAX
	 */
	function brookside_header_add_to_cart_fragment( $fragments ) {
	 
	    ob_start();
	    $count = WC()->cart->cart_contents_count;
	    $cart_url = wc_get_cart_url();
	    ?><div class="cart-main menu-item cart-contents">
			<a class="my-cart-link" href="<?php echo wc_get_cart_url(); ?>"><i class="la la-shopping-cart"></i>
				<?php if ( $count > 0 ) {?>
			        <span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
			        <?php
			    } ?>
			</a>
		</div><?php
	 
	    $fragments['div.cart-contents'] = ob_get_clean();
	     
	    return $fragments;
	}
	add_filter( 'woocommerce_add_to_cart_fragments', 'brookside_header_add_to_cart_fragment' );

	function brookside_track_product_view() {
	    if ( ! is_singular( 'product' ) ) {
	        return;
	    }
	    global $post;
	    if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) )
	        $viewed_products = array();
	    else
	        $viewed_products = (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] );
	    if ( ! in_array( $post->ID, $viewed_products ) ) {
	        $viewed_products[] = $post->ID;
	    }
	    if ( sizeof( $viewed_products ) > 15 ) {
	        array_shift( $viewed_products );
	    }
	    // Store for session only
	    wc_setcookie( 'woocommerce_recently_viewed', implode( '|', $viewed_products ) );
	}

	add_action( 'template_redirect', 'brookside_track_product_view', 20 );

	function brookside_recently_viewed_shortcode() {
	 
	   $viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) : array();
	   $viewed_products = array_reverse( array_filter( array_map( 'absint', $viewed_products ) ) );
	 
	   if ( empty( $viewed_products ) ) return;
	    
	   $title = '<h2>'.esc_html__('Viewed Products', 'brookside').'</h2>';
	   $product_ids = implode( ",", $viewed_products );
	 
	   return $title . do_shortcode("[products columns='4' limit='4' ids='$product_ids']");
	   
	}
	add_action( 'woocommerce_after_cart', function(){ echo '<div class="viewed_products">'.brookside_recently_viewed_shortcode().'</div>'; }, 20 );
}
?>