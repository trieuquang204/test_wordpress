<?php
if(!function_exists('brookside_compress')){
    function brookside_compress( $minify ){
    /* remove comments */
        $minify = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $minify );

        /* remove tabs, spaces, newlines, etc. */
        $minify = str_replace( array("\r\n", "\r", "\n", "\t", '; ', '  ', '    ', '    ',': ', ', ','{ ','}.'), array('','','','',';','','','',':',',','{','} .'), $minify );
            
        return $minify;
    }
}
/**
 * Add color styling from theme
 */
if(!function_exists('HexToRGB')){
   function HexToRGB($hex, $grad=0) {
        $hex = preg_replace("/#/", "", $hex);
        $color = array();

        if(strlen($hex) == 3) {
            $color['r'] = hexdec(substr($hex, 0, 1) . $r)+$grad;
            $color['g'] = hexdec(substr($hex, 1, 1) . $g)+$grad;
            $color['b'] = hexdec(substr($hex, 2, 1) . $b)+$grad;
        }
        else if(strlen($hex) == 6) {
            $color['r'] = hexdec(substr($hex, 0, 2))+$grad;
            $color['g'] = hexdec(substr($hex, 2, 2))+$grad;
            $color['b'] = hexdec(substr($hex, 4, 2))+$grad;
        }

        return implode(",", $color);
    } 
}

function brookside_styles_custom() {
?>
<?php ob_start(); ?>
body {
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_body_font_family', 'Open Sans' )); ?>';
    font-size: <?php echo esc_attr(get_theme_mod( 'brookside_body_font_size', '14px' )); ?>;
    line-height: <?php echo esc_attr(get_theme_mod( 'brookside_body_line_height', '26px' )); ?>;
    color: <?php echo esc_attr(get_theme_mod('brookside_body_color', '#444b4d')); ?>;
}
body {
    padding-top: <?php echo esc_attr(get_theme_mod('brookside_body_top_padding', '0')); ?>px;
    padding-right: <?php echo esc_attr(get_theme_mod('brookside_body_right_padding', '0')); ?>px;
    padding-bottom: <?php echo esc_attr(get_theme_mod('brookside_body_bottom_padding', '0')); ?>px;
    padding-left: <?php echo esc_attr(get_theme_mod('brookside_body_left_padding', '0')); ?>px;
}
#content .has-regular-font-size {
    font-size: <?php echo esc_attr(get_theme_mod( 'brookside_body_font_size', '14px' )); ?>;
}
 <?php 
    $body_background = rwmb_get_value( 'brookside_body_background' );
    if($body_background){
        echo 'body.page-id-'.get_the_ID().' {';
        echo 'background-color: '.$body_background.';';
        echo '}'; 
    } 
?>

a {
   color: <?php echo esc_attr(get_theme_mod('brookside_links_color', '#ba5c23')); ?>; 
}
a:hover, .meta-categories a:hover {
   color: <?php echo esc_attr(get_theme_mod('brookside_links_color_hover', '#1c1d1f')); ?>; 
}
#header {
	<?php 
    if( get_theme_mod('brookside_header_bottom_border_width', '1') != '' ){
        echo "border-bottom-width:".get_theme_mod('brookside_header_bottom_border_width', '1')."px !important;";
    }
    ?>
}
<?php
$header_background = rwmb_get_value( 'brookside_header_background' );
if(!empty($header_background)){
    echo '.page-id-'.get_the_ID().' #header, .page-id-'.get_the_ID().' #side-header, .page-id-'.get_the_ID().' #side-header-vertical {';
    rwmb_the_value('brookside_header_background');
    echo '}';
    if($header_background['color']){
        echo '.page-id-'.get_the_ID().' #side-header .overlay-bg {background-color:rgba('.HexToRGB($header_background['color']).', 0.75);}';
        echo '.page-id-'.get_the_ID().' #header #navigation-block {background-color:rgba('.HexToRGB($header_background['color']).', 1);}';
    }
    
}
?>
#header .logo img {
    width: <?php echo esc_attr(get_theme_mod( 'brookside_media_logo_width', '185' )); ?>px;
}
#header.header4.header-scrolled .logo img, #header.header5.header-scrolled .logo img {
    width: <?php echo (int)esc_attr(get_theme_mod( 'brookside_media_logo_width', '185' ))/2; ?>px;
}
#header .logo .logo_text,
#hidden-area-widgets .logo .logo_text {
    font-size: <?php echo esc_attr(get_theme_mod( 'brookside_media_logo_width', '75' )); ?>px;
    letter-spacing:<?php echo esc_attr( get_theme_mod( 'brookside_logo_title_letter_spacing', '1.5') ); ?>px;
    <?php if(get_theme_mod( 'brookside_logo_color', '' ) != '') 
        echo "color: ".esc_attr(get_theme_mod( 'brookside_logo_color', '' )); ?>;
}
<?php
    if( get_theme_mod('brookside_subscribe_popup_bg') != '' ){
        echo ".subscribe-popup .subscribe-bg { background-image: url(".get_theme_mod('brookside_subscribe_popup_bg')."); }";
    }
    if( get_theme_mod('brookside_subscribe_popup_bg_color') != '' ){
        echo ".subscribe-popup .subscribe-popup-inner { background-color:".get_theme_mod('brookside_subscribe_popup_bg_color')."; }";
    }
?>
<?php
    if( get_theme_mod('brookside_hidden_navigation_bg', '') != '' ){
        echo "#hidden-area-widgets .widgets-side-bg {background-image:url(".get_theme_mod('brookside_hidden_navigation_bg').");}";
    }
?>
<?php
    if( (int)get_theme_mod( 'brookside_media_logo_width', '18' ) < 30){
        echo '#header.header4.header-scrolled .logo .logo_text, #header.header5.header-scrolled .logo .logo_text, #header.header-custom.header-scrolled .logo .logo_text{font-size: '.esc_attr(get_theme_mod( 'brookside_media_logo_width', '18' )).'px;}';
    }
?>
#mobile-header .logo img {
    width: <?php echo esc_attr(get_theme_mod( 'brookside_media_logo_mobile_width', '90' )); ?>px;
}
#mobile-header .logo .logo_text {
    font-size: <?php echo esc_attr(get_theme_mod( 'brookside_media_logo_mobile_width', '18' )); ?>px;
}
#navigation .menu li a,
#mobile-header .dl-menuwrapper li a,
#navigation-block #wp-megamenu-main_navigation>.wpmm-nav-wrap ul.wp-megamenu>li>a,
#navigation-block #wp-megamenu-main_navigation>.wpmm-nav-wrap ul.wp-megamenu>li ul.wp-megamenu-sub-menu .wpmm-tab-btns li a { 
    font-size: <?php echo esc_attr(get_theme_mod( 'brookside_menu_font_size', '12px' )); ?>;
    font-weight: <?php echo esc_attr(get_theme_mod( 'brookside_menu_font_weight', '700' )); ?>;
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_menu_font_family', 'Montserrat' )); ?>';
    text-transform: <?php echo esc_attr(get_theme_mod( 'brookside_menu_transform', 'uppercase' )); ?>;
}
.menu > li > a {
    padding-right: <?php echo (int)(get_theme_mod( 'brookside_menu_item_padding', '40' ))/2 + 2; ?>px;
    padding-left: <?php echo (int)(get_theme_mod( 'brookside_menu_item_padding', '40' ))/2; ?>px;
}
input[type="submit"], .button, button[type="submit"], #content .tnp-subscription input.tnp-submit, 
#content .woocommerce #respond input#submit,
#content .wp-block-button .wp-block-button__link {
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_button_font_family', 'Montserrat' )); ?>';
    font-size: <?php echo esc_attr(get_theme_mod( 'brookside_button_font_size', '12px' )); ?>;
    background-color: <?php echo esc_attr(get_theme_mod( 'brookside_button_default_bg_color', '#1c1d1f' )); ?>;
    border-color: <?php echo esc_attr(get_theme_mod( 'brookside_button_default_border_color', 'transparent' )); ?>;
    color: <?php echo esc_attr(get_theme_mod( 'brookside_button_default_text_color', '#ffffff' )); ?>;
    font-weight: <?php echo esc_attr(get_theme_mod( 'brookside_button_font_weight', '500' )); ?>;
    border-radius: <?php echo esc_attr(get_theme_mod( 'brookside_button_border_radius', '0' )); ?>px;
    letter-spacing: <?php echo esc_attr(get_theme_mod( 'brookside_button_letter_spacing', '1' )); ?>px;
    padding:<?php echo esc_attr(get_theme_mod( 'brookside_button_vertical_padding', '19' )); ?>px <?php echo esc_attr(get_theme_mod( 'brookside_button_horizontal_padding', '41' )); ?>px
}
#footer-widgets .widget_brooksidesubscribe .newsletter-submit button {
    background-color: <?php echo esc_attr(get_theme_mod( 'brookside_button_default_bg_color', '#1c1d1f' )); ?>;
    color: <?php echo esc_attr(get_theme_mod( 'brookside_button_default_text_color', '#ffffff' )); ?>;
}
#content .woocommerce div.product .woocommerce-tabs ul.tabs li a,
#content .woocommerce .quantity .qty,
#content .woocommerce .quantity .qty-button,
.pagination_post .prev-link,
.pagination_post .next-link {
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_button_font_family', 'Montserrat' )); ?>';
}
.post-slider-item .post-more .post-more-link,
.sharebox.sharebox-sticky .share-text {
    font-family:'<?php echo esc_attr(get_theme_mod( 'brookside_button_font_family', 'Montserrat' )); ?>';
    font-size: <?php echo esc_attr(get_theme_mod( 'brookside_button_font_size', '11px' )); ?>;
}
.loadmore.button {
    background-color: <?php echo esc_attr(get_theme_mod( 'brookside_button_loadmore_bg_color', '#141516' )); ?>;
    border-color: <?php echo esc_attr(get_theme_mod( 'brookside_button_loadmore_border_color', '#141516' )); ?>;
    color: <?php echo esc_attr(get_theme_mod( 'brookside_button_loadmore_text_color', '#fff' )); ?>;
}
#footer-copy-block {
    font-size: <?php echo esc_attr(get_theme_mod( 'brookside_footer_copyright_font_size', '15px' )); ?>;
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_footer_copyright_font_family', 'Montserrat' )); ?>';
    color: <?php echo esc_attr(get_theme_mod('brookside_footer_copyright_color', '#201f22')); ?>;
}
#footer #footer-bottom .social-icons li a {
    background-color: <?php echo esc_attr(get_theme_mod('brookside_footer_socials_color', '#abacae')); ?>;
}
#footer .special-bg {
    background-color: <?php echo esc_attr(get_theme_mod('brookside_footer_bg_color', '#1d1f20')); ?>;
    <?php if(get_theme_mod('brookside_footer_bg_image') == ''){ echo 'display:none;'; }?>
    <?php if(get_theme_mod('brookside_footer_bg_image') != ''){
        echo 'background-image: url('.esc_attr(get_theme_mod('brookside_footer_bg_image')).');';
        echo 'background-position: '.esc_attr(get_theme_mod('brookside_footer_bg_position', 'center bottom')).';'; 
        echo 'background-size: '.esc_attr(get_theme_mod('brookside_footer_bg_size', 'auto')).';';
    } ?>
}
#footer {
    padding-top:<?php echo get_theme_mod('brookside_footer_top_padding', '45'); ?>px;
    padding-bottom:<?php echo get_theme_mod('brookside_footer_bottom_padding', '75'); ?>px;
}
<?php if(get_theme_mod('brookside_footer_bg_image') == ''){
    echo '#footer {background-color: '.esc_attr(get_theme_mod('brookside_footer_bg_color', '#fff')).';}';
}?>
<?php
$footer_background = rwmb_meta( 'brookside_footer_background' );
if(!empty($footer_background)){
    echo '.page-id-'.get_the_ID().' #footer {';
    rwmb_the_value('brookside_footer_background');
    echo '}';    
}
$footer_socials_color = rwmb_get_value( 'brookside_footer_socials_color' );
if( $footer_socials_color != '' ){
    echo '.page-id-'.get_the_ID().' #footer #footer-bottom .social-icons li a, .page-id-'.get_the_ID().' #footer .social-icons li a span {background-color:'.$footer_socials_color.';}';
}

?>
<?php
    if( rwmb_get_value('brookside_header_bottom_border') ){
        echo '#header, #header.header-scrolled, #header.header5 .header-top {border-bottom:0 !important;}';
    }
    if( !get_theme_mod('brookside_post_headings_separator', false) ){
        echo '.title:after {display:none !important;} .post .title.hr-sep {margin-bottom:0!important;}';
    }
    if( !get_theme_mod('brookside_widgets_headings_separator', true ) ){
        echo '#related-posts h2:after, #related-posts h2:before, .post-meta .meta-date:after, .post-meta .sharebox:before {display:none !important;}';
    }
?>
.title h2, .title h3 { 
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_family', 'Montserrat' )); ?>';
    color: <?php echo esc_attr(get_theme_mod('brookside_posts_headings_item_color', '#1c1d1f')); ?>;
    font-weight: <?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_weight', '800' )); ?>;
    font-size: <?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_size', '39' )); ?>px;
    text-transform: <?php echo esc_attr(get_theme_mod( 'brookside_post_headings_transform', 'capitalize' )); ?>;
    letter-spacing:<?php echo esc_attr( get_theme_mod( 'brookside_posts_headings_letter_spacing', '0') ); ?>px;
}
#content .woocommerce .woocommerce-loop-product__title {
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_family', 'Montserrat' )); ?>';
    color: <?php echo esc_attr(get_theme_mod('brookside_posts_headings_item_color', '#1c1d1f')); ?>;
    font-weight: <?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_weight', '800' )); ?>;
    text-transform: <?php echo esc_attr(get_theme_mod( 'brookside_post_headings_transform', 'capitalize' )); ?>;
    letter-spacing:<?php echo esc_attr( get_theme_mod( 'brookside_posts_headings_letter_spacing', '0') ); ?>px;
}
.author-title h2 {
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_family', 'Montserrat' )); ?>';
    text-transform: <?php echo esc_attr(get_theme_mod( 'brookside_post_headings_transform', 'capitalize' )); ?>;
    letter-spacing:<?php echo esc_attr( get_theme_mod( 'brookside_posts_headings_letter_spacing', '0') ); ?>px;
}
<?php
    if( get_theme_mod('brookside_post_headings_separator_style', 'vertical') === 'horizontal' && get_theme_mod('brookside_post_headings_separator', false) ){
        echo '.title { padding-bottom: 2px !important; margin-bottom: 23px !important; }';
        echo '.page-template-default .before-content .title h2 { margin-bottom:12px !important;}';
        echo 'body.single-post .post .title, .before-content header.title, body.search header.title {margin-bottom:35px !important;}';
        echo '.title:after { top: auto !important; bottom: 0px !important; height: 1px !important; width: 66px !important; border: 0 !important; left: 50% !important; margin: 0 0 0px -33px !important; border-bottom: 2px solid !important; }';
        echo '.title:after {color:'.get_theme_mod('brookside_accent_color', '#ba5c23').'}';
    }
?>
#navigation-block #wp-megamenu-main_navigation>.wpmm-nav-wrap ul.wp-megamenu h4.grid-post-title a,
#navigation-block #wp-megamenu-main_navigation>.wpmm-nav-wrap ul.wp-megamenu h4.grid-post-title,
.archive .title.archive-title span {
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_family', 'Montserrat' )); ?>' !important;
}
.logo { 
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_logo_font_family', 'Montserrat' )); ?>';
    font-weight: <?php echo esc_attr(get_theme_mod( 'brookside_logo_font_weight', '800' )); ?>;
    text-transform: <?php echo esc_attr(get_theme_mod( 'brookside_logo_transform', 'lowercase' )); ?>;
}
<?php if( get_theme_mod('brookside_footer_logo_img', '') == '' ){ ?>
.footer-logo {
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_footer_logo_font_family', 'Montserrat' )); ?>';
    font-size:<?php echo esc_attr(get_theme_mod('brookside_footer_logo_size', '18')); ?>px;
    font-weight: <?php echo esc_attr(get_theme_mod( 'brookside_footer_logo_font_weight', '400' )); ?>;
    text-transform: <?php echo esc_attr(get_theme_mod( 'brookside_footer_logo_transform', 'uppercase' )); ?>;
    color:<?php echo esc_attr(get_theme_mod('brookside_footer_logo_color', '#151516'));?>;
}
<?php } else { ?>
    .footer-logo img { max-width:<?php echo get_theme_mod('brookside_footer_logo_size', '150') ?>px; }
<?php } ?>
blockquote,
.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta {
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_family', 'Montserrat' )); ?>';
}
h1,h2,h3,h4,h5,.has-drop-cap:first-letter {
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_family', 'Montserrat' )); ?>';
    color: <?php echo esc_attr(get_theme_mod('brookside_posts_headings_item_color', '#1c1d1f')); ?>;
    font-weight: <?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_weight', '800' )); ?>;
    letter-spacing:<?php echo esc_attr( get_theme_mod( 'brookside_posts_headings_letter_spacing', '0') ); ?>px;
}
#pagination .current,
.pagination-view-all {
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_family', 'Montserrat' )); ?>';
}
.post-slider-item .post-more.style_5 h3, .post-slider-item .post-more h3 {
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_family', 'Montserrat' )); ?>';
    font-weight: <?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_weight', '500' )); ?>;
    text-transform: <?php echo esc_attr(get_theme_mod( 'brookside_post_headings_transform', 'uppercase' )); ?>;
    letter-spacing:<?php echo esc_attr( get_theme_mod( 'brookside_posts_headings_letter_spacing', '1.5') ); ?>px;
}
p.title-font {
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_family', 'Montserrat' )); ?>';
}
#content .woocommerce ul.products li.product .price,
#content .woocommerce table.shop_table .product-subtotal span,
#content .woocommerce table.shop_table .product-name a,
.woocommerce table.shop_table tbody th {
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_family', 'Montserrat' )); ?>';
    color: <?php echo esc_attr(get_theme_mod('brookside_posts_headings_item_color', '#1c1d1f')); ?>;
}
.social-icons.big_icon_text li span {
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_family', 'Montserrat' )); ?>';
}
.woocommerce .products div.product p.price, .woocommerce .products div.product span.price {
    color:<?php echo esc_attr(get_theme_mod('brookside_accent_color', '#ba5c23')); ?> !important;
}
.woocommerce div.product p.price, .woocommerce div.product span.price {
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_family', 'Montserrat' )); ?>' !important;
}
.title h2 a:hover, .title h3 a:hover, .related-item-title a:hover, .latest-blog-item-description a.title:hover,
.post-slider-item .post-more.style_5 h3 a:hover {
    color: <?php echo esc_attr(get_theme_mod('brookside_posts_headings_item_color_active', '#ba5c23')); ?>;
}
.meta-categories {
    font-size: <?php echo esc_attr(get_theme_mod( 'brookside_meta_categories_font_size', '12px' )); ?>;
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_meta_categories_font_family', 'Montserrat' )); ?>';
    text-transform: <?php echo esc_attr(get_theme_mod( 'brookside_meta_categories_transform', 'uppercase' )); ?>;
    letter-spacing: <?php echo esc_attr(get_theme_mod( 'brookside_meta_categories_letter_spacing', '1' )); ?>px;
    color:<?php echo esc_attr(get_theme_mod('brookside_meta_categories_color', '#ba5c23')); ?>;
    font-weight:<?php echo esc_attr(get_theme_mod('brookside_meta_categories_font_weight', '500')); ?>;
}
.post.style_6 .post-more a {
    font-size: <?php echo esc_attr(get_theme_mod( 'brookside_meta_categories_font_size', '12px' )); ?>;
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_meta_categories_font_family', 'Montserrat' )); ?>';
    text-transform: <?php echo esc_attr(get_theme_mod( 'brookside_meta_categories_transform', 'uppercase' )); ?>;
    letter-spacing: <?php echo esc_attr(get_theme_mod( 'brookside_meta_categories_letter_spacing', '1' )); ?>px;
}
.post.post-featured-style4.post-item-1 .post-img-block .meta-over-img .title .meta-categories {
    color:<?php echo esc_attr(get_theme_mod('brookside_meta_categories_color', '#ba5c23')); ?>;
}
.meta-info .meta-date {
    font-size: <?php echo esc_attr(get_theme_mod( 'brookside_meta_categories_font_size', '12px' )); ?>;
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_meta_categories_font_family', 'Montserrat' )); ?>';
    text-transform: <?php echo esc_attr(get_theme_mod( 'brookside_meta_categories_transform', 'uppercase' )); ?>;
    letter-spacing: <?php echo esc_attr(get_theme_mod( 'brookside_meta_categories_letter_spacing', '1' )); ?>px;
    font-weight:<?php echo esc_attr(get_theme_mod('brookside_meta_categories_font_weight', '500')); ?>;
}
.meta-categories a:hover {
    color:<?php echo esc_attr(get_theme_mod('brookside_meta_categories_color_hover', '#cccccc')); ?>;
}
.post-meta.footer-meta > div {
    font-size: <?php echo esc_attr(get_theme_mod( 'brookside_meta_info_font_size', '11px' )); ?>;
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_meta_info_font_family', 'Montserrat' )); ?>';
    text-transform: <?php echo esc_attr(get_theme_mod( 'brookside_meta_info_transform', 'uppercase' )); ?>;
    color:<?php echo esc_attr(get_theme_mod('brookside_meta_info_color', '#888c8e')); ?>;
}

.herosection_text {
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_meta_categories_font_family', 'Dancing Script' )); ?>';
}
.wpb_widgetised_column .widget h3.title, .widget-title,
#related-posts h2, #comments #reply-title, #comments-title, .write-comment h3 {
    font-size: <?php echo esc_attr(get_theme_mod( 'brookside_widgets_headings_font_size', '11px' )); ?>; 
    font-weight: <?php echo esc_attr(get_theme_mod( 'brookside_widgets_headings_font_weight', '700' )); ?>;
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_widgets_headings_font_family', 'Montserrat' )); ?>';
    color: <?php echo esc_attr(get_theme_mod('brookside_widgets_headings_item_color', '#1c1d1f')); ?>;
    text-transform: <?php echo esc_attr(get_theme_mod( 'brookside_widgets_headings_transform', 'uppercase' )); ?>;    
    letter-spacing:<?php echo esc_attr( get_theme_mod( 'brookside_widgets_headings_letter_spacing', '1') ); ?>px;
}
#related-posts h2, #comments #reply-title, #comments-title, .write-comment h3 {
    font-weight: <?php echo esc_attr(get_theme_mod( 'brookside_widgets_headings_font_weight', '700' )); ?>;
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_widgets_headings_font_family', 'Montserrat' )); ?>';
    color: <?php echo esc_attr(get_theme_mod('brookside_widgets_headings_item_color', '#1c1d1f')); ?>;
    text-transform: <?php echo esc_attr(get_theme_mod( 'brookside_widgets_headings_transform', 'uppercase' )); ?>;    
    letter-spacing:<?php echo esc_attr( get_theme_mod( 'brookside_widgets_headings_letter_spacing', '1') ); ?>px;
}
.comment .author-title,
.widget_categories ul li,
.widget_pages ul li {
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_family', 'Montserrat' )); ?>';
    color: <?php echo esc_attr(get_theme_mod('brookside_widgets_headings_item_color', '#1c1d1f')); ?>;   
}
.meta-date, #latest-list-posts .post .post-meta .categories, #latest-posts .post .post-meta .categories, 
.meta-read, .related-meta-date, .label-date, .post-meta .post-more a span, .post-more a.post-more-button span,
.tp-caption.slider-posts-desc .slider-post-meta, .slider-posts-desc .slider-post-meta,
.author .comment-reply a, .author .comment-reply span, .pagination_post > a, .pagination_post > span,
body.single-post .post .post-meta .meta > div {
    font-size: <?php echo esc_attr(get_theme_mod( 'brookside_meta_info_font_size', '12px' )); ?>;
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_meta_info_font_family', 'Montserrat' )); ?>';
    text-transform: <?php echo esc_attr(get_theme_mod( 'brookside_meta_info_transform', 'uppercase' )); ?>;
    letter-spacing:<?php echo esc_attr( get_theme_mod( 'brookside_widgets_headings_letter_spacing', '1') ); ?>px;
}
.meta-date,
#navigation-block #wp-megamenu-main_navigation>.wpmm-nav-wrap ul.wp-megamenu .meta-date {
   color:<?php echo esc_attr(get_theme_mod('brookside_meta_info_color', '#888c8e')); ?>; 
}
.widget .latest-blog-list .post-meta-recent span,
.prev-post-title span, .next-post-title span,
.post-meta-tags .meta-tags a {
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_widgets_headings_font_family', 'Montserrat' )); ?>';
}
.widget .latest-blog-list .meta-categories a:hover, .post-meta .meta-tags a:hover,
.author .comment-reply a:hover, .pie-top-button, #header .social-icons li a:hover, #mobile-nav .social-icons li a:hover,
.widget_categories ul li a:hover, #latest-list-posts .post .post-meta .categories a:hover, input[type="checkbox"]:not(:checked) + label:after,
input[type="checkbox"]:checked + label:after,
.category-block:hover .category-block-inner .link-icon,
.author .comment-reply a,
#content .woocommerce .product .price ins,
#content .woocommerce table.shop_table .product-remove .remove:hover,
.subscribe-popup h5.subtitle {
    color:<?php echo esc_attr(get_theme_mod('brookside_accent_color', '#ba5c23')); ?>;
}
#content .woocommerce-message .button,
.block-title,
.list-style2 li:before,
.number-list li:before,
.widget_brooksidesubscribe .newsletter-submit button,
.widget_instagram h4 a,
.author-description .social-icons li a,
.post.style_6 .post-more a:hover,
.pagination-view-all a:hover,
.pagination-view-all:hover,
ul#nav-mobile li > a:hover,#navigation .menu li > a:hover, #navigation .menu li ul li a:hover,#navigation-block .wp-megamenu li a:hover,
#navigation-block #wp-megamenu-main_navigation>.wpmm-nav-wrap ul.wp-megamenu>li ul.wp-megamenu-sub-menu li:hover>a,
.header-dark.header-transparent ul#nav-mobile li > a:hover, .header-dark.header-transparent #navigation .menu li > a:hover,
.header-dark.header-transparent #navigation .menu li ul li a:hover, .header-dark.header-transparent #navigation-block .wp-megamenu li a:hover,
.header-dark.header-transparent #navigation-block #wp-megamenu-main_navigation>.wpmm-nav-wrap ul.wp-megamenu>li ul.wp-megamenu-sub-menu li:hover>a,
#navigation-block ul.wp-megamenu li ul.wp-megamenu-sub-menu .wpmm-vertical-tabs-nav ul li.active:hover,
#navigation-block ul.wp-megamenu li ul.wp-megamenu-sub-menu .wpmm-vertical-tabs-nav ul li.active:hover a,
.header-dark.header-transparent #navigation-block ul.wp-megamenu li ul.wp-megamenu-sub-menu .wpmm-vertical-tabs-nav ul li.active:hover,
.header-dark.header-transparent #navigation-block ul.wp-megamenu li ul.wp-megamenu-sub-menu .wpmm-vertical-tabs-nav ul li.active:hover a {
    color:<?php echo esc_attr(get_theme_mod('brookside_accent_color', '#ba5c23')); ?> !important;
}
.social-icons.big_icon_text li a:hover,
.sharebox.sharebox-sticky ul li a:hover,
.list-style1 li:before,
.post-slider-item:hover .post-more.style_4 .post-more-inner,
#pagination a.next:hover,
#pagination a.previous:hover,
.subscribe-block .newsletter-submit .button-subscribe:hover {
    background-color:<?php echo esc_attr(get_theme_mod('brookside_accent_color', '#ba5c23')); ?>;
}
.instagram-item:hover img,
input[type="text"]:focus,
input[type="password"]:focus,
input[type="email"]:focus,
input[type="url"]:focus,
input[type="tel"]:focus,
input[type="number"]:focus,
textarea:focus,
.single-post .post.featured .title .meta-date .meta-categories a,
.wp-block-pullquote blockquote, #content .wp-block-pullquote blockquote, #content blockquote.style2,
#navigation .menu li ul li a:hover:before,
#navigation .menu li ul .current-menu-item > a:before,
#navigation .menu li ul .current-menu-ancestor > a:before,
.wp-megamenu-wrap .wp-megamenu li .wp-megamenu-sub-menu li > a:hover:before,
.wp-megamenu-wrap .wp-megamenu li .wp-megamenu-sub-menu li.current-menu-item > a:before,
.wp-megamenu-wrap .wp-megamenu li .wp-megamenu-sub-menu li.current-menu-ancestor > a:before,
#navigation-block #wp-megamenu-main_navigation>.wpmm-nav-wrap ul.wp-megamenu>li ul.wp-megamenu-sub-menu .wpmm-tab-btns li.active a:before,
blockquote.is-style-style2 {
    border-color:<?php echo esc_attr(get_theme_mod('brookside_accent_color', '#ba5c23')); ?>;
}
.category-block:hover .category-block-inner::before {
    border-top-color: <?php echo esc_attr(get_theme_mod('brookside_accent_color', '#ba5c23')); ?>;
    border-right-color: <?php echo esc_attr(get_theme_mod('brookside_accent_color', '#ba5c23')); ?>;
}
.category-block:hover .category-block-inner::after {
    border-bottom-color: <?php echo esc_attr(get_theme_mod('brookside_accent_color', '#ba5c23')); ?>;
    border-left-color: <?php echo esc_attr(get_theme_mod('brookside_accent_color', '#ba5c23')); ?>;
}

#sidebar .widget.widget_socials .social-icons li a:before, .pie,
#footer .social-icons li a:before, .sk-folding-cube .sk-cube:before,
#back-to-top a:hover, input[type="radio"]:checked + label:after,
input[type="radio"]:not(:checked) + label:after,
.pagination_post > span,
.pagination_post > a:hover,
.woocommerce nav.woocommerce-pagination ul li a:focus,
.woocommerce nav.woocommerce-pagination ul li a:hover,
.woocommerce nav.woocommerce-pagination ul li span.current {
    background-color:<?php echo esc_attr(get_theme_mod('brookside_accent_color', '#ba5c23')); ?> !important;
}
<?php $out=ob_get_contents(); $out = brookside_compress($out); ob_end_clean();

    wp_add_inline_style('brookside-stylesheet', $out);
}
add_action( 'wp_enqueue_scripts', 'brookside_styles_custom' );
?>