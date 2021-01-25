<?php
function brookside_editor_styles_dynamic() {
?>
<?php ob_start(); ?>
.wp-block.editor-block-list__block .editor-block-list__block-edit,
.editor-styles-wrapper .editor-block-list__block-edit .components-autocomplete > p:not(.wp-block-cover-text) {
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_body_font_family', 'Open Sans' )); ?>';
    font-size: <?php echo esc_attr(get_theme_mod( 'brookside_body_font_size', '14px' )); ?>;
    line-height: <?php echo esc_attr(get_theme_mod( 'brookside_body_line_height', '28px' )); ?>;
    color: <?php echo esc_attr(get_theme_mod('brookside_body_color', '#444b4d')); ?>;
}
.wp-block.editor-block-list__block .editor-block-list__block-edit .has-regular-font-size {
    font-size: <?php echo esc_attr(get_theme_mod( 'brookside_body_font_size', '14px' )); ?>;
}

.wp-block.editor-block-list__block .editor-block-list__block-edit a {
   color: <?php echo esc_attr(get_theme_mod('brookside_links_color', '#ba5c23')); ?>; 
}
.wp-block.editor-block-list__block .editor-block-list__block-edit a:hover, .wp-block.editor-block-list__block .editor-block-list__block-edit .meta-categories a:hover {
   color: <?php echo esc_attr(get_theme_mod('brookside_links_color_hover', '#1c1d1f')); ?>; 
}

.wp-block.editor-block-list__block .editor-block-list__block-edit input[type="submit"],
.wp-block.editor-block-list__block .editor-block-list__block-edit .button,
.wp-block.editor-block-list__block .editor-block-list__block-edit .editor-rich-text button[type="submit"],
.block-editor-block-list__layout .wp-block.editor-block-list__block .wp-block-button .wp-block-button__link {
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_button_font_family', 'Montserrat' )); ?>';
    font-size: <?php echo esc_attr(get_theme_mod( 'brookside_button_font_size', '12px' )); ?>;
    background-color: <?php echo esc_attr(get_theme_mod( 'brookside_button_default_bg_color', '#1c1d1f' )); ?>;
    border-color: <?php echo esc_attr(get_theme_mod( 'brookside_button_default_border_color', 'transparent' )); ?>;
    color: <?php echo esc_attr(get_theme_mod( 'brookside_button_default_text_color', '#ffffff' )); ?>;
    font-weight: <?php echo esc_attr(get_theme_mod( 'brookside_button_font_weight', '500' )); ?>;
    border-radius: <?php echo esc_attr(get_theme_mod( 'brookside_button_border_radius', '0' )); ?>px;
    letter-spacing: <?php echo esc_attr(get_theme_mod( 'brookside_button_letter_spacing', '1' )); ?>px;
    text-transform: uppercase;
    line-height:1em;
    padding:<?php echo esc_attr(get_theme_mod( 'brookside_button_vertical_padding', '19' )); ?>px <?php echo esc_attr(get_theme_mod( 'brookside_button_horizontal_padding', '41' )); ?>px
}
.wp-block.editor-block-list__block .editor-block-list__block-edit .post-slider-item .post-more .post-more-link {
    font-family: <?php echo esc_attr(get_theme_mod( 'brookside_button_font_family', 'Montserrat' )); ?>;
    font-size: <?php echo esc_attr(get_theme_mod( 'brookside_button_font_size', '11px' )); ?>;
}
.wp-block.editor-block-list__block .wp-block-button .wp-block-button__link {
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_button_font_family', 'Montserrat' )); ?>';
    font-size: <?php echo esc_attr(get_theme_mod( 'brookside_button_font_size', '11px' )); ?>; 
    font-weight: <?php echo esc_attr(get_theme_mod( 'brookside_button_font_weight', '400' )); ?>;
    letter-spacing: <?php echo esc_attr(get_theme_mod( 'brookside_button_letter_spacing', '1' )); ?>px;
    padding:<?php echo esc_attr(get_theme_mod( 'brookside_button_vertical_padding', '13' )); ?>px <?php echo esc_attr(get_theme_mod( 'brookside_button_horizontal_padding', '32' )); ?>px
}
.wp-block.editor-block-list__block .editor-block-list__block-edit .loadmore.button {
    background-color: <?php echo esc_attr(get_theme_mod( 'brookside_button_loadmore_bg_color', '#141516' )); ?>;
    border-color: <?php echo esc_attr(get_theme_mod( 'brookside_button_loadmore_border_color', '#141516' )); ?>;
    color: <?php echo esc_attr(get_theme_mod( 'brookside_button_loadmore_text_color', '#fff' )); ?>;
}
<?php
    if( !get_theme_mod('brookside_post_headings_separator', false) ){
        echo '.wp-block.editor-block-list__block .editor-block-list__block-edit .title:after {display:none !important;} .post .title.hr-sep {margin-bottom:0!important;}';
    }
    if( !get_theme_mod('brookside_widgets_headings_separator', true ) ){
        echo '#related-posts h2:after, #related-posts h2:before, .post-meta .meta-date:after, .post-meta .sharebox:before {display:none !important;}';
    }
?>
.wp-block.editor-block-list__block .editor-block-list__block-edit .title h2, 
.wp-block.editor-block-list__block .editor-block-list__block-edit .title h3,
.editor-post-title__block .editor-post-title__input { 
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_family', 'Montserrat' )); ?>';
    color: <?php echo esc_attr(get_theme_mod('brookside_posts_headings_item_color', '#1c1d1f')); ?>;
    font-weight: <?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_weight', '800' )); ?>;
    font-size: <?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_size', '39' )); ?>px;
    text-transform: <?php echo esc_attr(get_theme_mod( 'brookside_post_headings_transform', 'capitalize' )); ?>;
    letter-spacing:<?php echo esc_attr( get_theme_mod( 'brookside_posts_headings_letter_spacing', '0') ); ?>px;
}
.wp-block.editor-block-list__block .editor-block-list__block-edit .post-slider-item .post-more h3,
<?php
    if( get_theme_mod('brookside_post_headings_separator_style', 'vertical') === 'horizontal' && get_theme_mod('brookside_post_headings_separator', false) ){
        echo '.wp-block.editor-block-list__block .editor-block-list__block-edit .title { padding-bottom: 2px !important; margin-bottom: 23px !important; }';
        echo '.wp-block.editor-block-list__block .editor-block-list__block-edit .title:after { top: auto !important; bottom: 0px !important; height: 1px !important; width: 66px !important; border: 0 !important; left: 50% !important; margin: 0 0 0px -33px !important; border-bottom: 2px solid !important; }';
        echo '.wp-block.editor-block-list__block .editor-block-list__block-edit .title:after {color:'.get_theme_mod('brookside_accent_color', '#ba5c23').'}';
    }
?>
.wp-block.editor-block-list__block .editor-block-list__block-edit blockquote {
    font-family: <?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_family', 'Montserrat' )); ?>;
}

.wp-block.editor-block-list__block .editor-block-list__block-edit h1,
.wp-block.editor-block-list__block .editor-block-list__block-edit h2,
.wp-block.editor-block-list__block .editor-block-list__block-edit h3,
.wp-block.editor-block-list__block .editor-block-list__block-edit h4,
.wp-block.editor-block-list__block .editor-block-list__block-edit h5,
.wp-block.editor-block-list__block .editor-block-list__block-edit .has-drop-cap:first-letter {
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_family', 'Montserrat' )); ?>';
    color: <?php echo esc_attr(get_theme_mod('brookside_posts_headings_item_color', '#1c1d1f')); ?>;
    font-weight: <?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_weight', '800' )); ?>;
    letter-spacing:<?php echo esc_attr( get_theme_mod( 'brookside_posts_headings_letter_spacing', '0') ); ?>px;
}
.wp-block.editor-block-list__block .editor-block-list__block-edit .social-icons.big_icon_text li span {
    font-family: <?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_family', 'Montserrat' )); ?>;
}
.wp-block.editor-block-list__block .editor-block-list__block-edit .title h2 a:hover,
.wp-block.editor-block-list__block .editor-block-list__block-edit .title h3 a:hover,
.wp-block.editor-block-list__block .editor-block-list__block-edit .related-item-title a:hover,
.wp-block.editor-block-list__block .editor-block-list__block-edit .latest-blog-item-description a.title:hover {
    color: <?php echo esc_attr(get_theme_mod('brookside_posts_headings_item_color_active', '#ba5c23')); ?>;
}
.wp-block.editor-block-list__block .editor-block-list__block-edit .post-slider-item .post-more.style_5 h3,
.wp-block.editor-block-list__block .editor-block-list__block-edit .post-slider-item .post-more h3 {
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_family', 'Montserrat' )); ?>';
    font-weight: <?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_weight', '500' )); ?>;
    text-transform: <?php echo esc_attr(get_theme_mod( 'brookside_post_headings_transform', 'uppercase' )); ?>;
    letter-spacing:<?php echo esc_attr( get_theme_mod( 'brookside_posts_headings_letter_spacing', '1.5') ); ?>px;
}
p.title-font {
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_posts_headings_font_family', 'Montserrat' )); ?>';
}
.wp-block.editor-block-list__block .editor-block-list__block-edit .title h2 a:hover,
.wp-block.editor-block-list__block .editor-block-list__block-edit .title h3 a:hover,
.wp-block.editor-block-list__block .editor-block-list__block-edit .related-item-title a:hover,
.wp-block.editor-block-list__block .editor-block-list__block-edit .latest-blog-item-description a.title:hover,
.wp-block.editor-block-list__block .editor-block-list__block-edit .post-slider-item .post-more.style_5 h3 a:hover {
    color: <?php echo esc_attr(get_theme_mod('brookside_posts_headings_item_color_active', '#ba5c23')); ?>;
}
.wp-block.editor-block-list__block .editor-block-list__block-edit .meta-categories {
    font-size: <?php echo esc_attr(get_theme_mod( 'brookside_meta_categories_font_size', '12px' )); ?>;
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_meta_categories_font_family', 'Montserrat' )); ?>';
    text-transform: <?php echo esc_attr(get_theme_mod( 'brookside_meta_categories_transform', 'uppercase' )); ?>;
    letter-spacing: <?php echo esc_attr(get_theme_mod( 'brookside_meta_categories_letter_spacing', '1' )); ?>px;
    color:<?php echo esc_attr(get_theme_mod('brookside_meta_categories_color', '#ba5c23')); ?>;
    font-weight:<?php echo esc_attr(get_theme_mod('brookside_meta_categories_font_weight', '500')); ?>;
}
.wp-block.editor-block-list__block .editor-block-list__block-edit .meta-categories a:hover {
    color:<?php echo esc_attr(get_theme_mod('brookside_meta_categories_color_hover', '#cccccc')); ?>;
}
.wp-block.editor-block-list__block .editor-block-list__block-edit .post.style_6 .post-more a {
    font-size: <?php echo esc_attr(get_theme_mod( 'brookside_meta_categories_font_size', '12px' )); ?>;
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_meta_categories_font_family', 'Montserrat' )); ?>';
    text-transform: <?php echo esc_attr(get_theme_mod( 'brookside_meta_categories_transform', 'uppercase' )); ?>;
    letter-spacing: <?php echo esc_attr(get_theme_mod( 'brookside_meta_categories_letter_spacing', '1' )); ?>px;
}
.wp-block.editor-block-list__block .editor-block-list__block-edit .post.post-featured-style4.post-item-1 .post-img-block .meta-over-img .title .meta-categories {
    color:<?php echo esc_attr(get_theme_mod('brookside_meta_categories_color', '#ba5c23')); ?>;
}
.meta-info .meta-date {
    font-size: <?php echo esc_attr(get_theme_mod( 'brookside_meta_categories_font_size', '12px' )); ?>;
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_meta_categories_font_family', 'Montserrat' )); ?>';
    text-transform: <?php echo esc_attr(get_theme_mod( 'brookside_meta_categories_transform', 'uppercase' )); ?>;
    letter-spacing: <?php echo esc_attr(get_theme_mod( 'brookside_meta_categories_letter_spacing', '1' )); ?>px;
    font-weight:<?php echo esc_attr(get_theme_mod('brookside_meta_categories_font_weight', '500')); ?>;
}
.wp-block.editor-block-list__block .editor-block-list__block-edit .post-meta.footer-meta > div {
    font-size: <?php echo esc_attr(get_theme_mod( 'brookside_meta_info_font_size', '11px' )); ?>;
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_meta_info_font_family', 'Montserrat' )); ?>';
    text-transform: <?php echo esc_attr(get_theme_mod( 'brookside_meta_info_transform', 'uppercase' )); ?>;
    color:<?php echo esc_attr(get_theme_mod('brookside_meta_info_color', '#888c8e')); ?>;
}
.wp-block.editor-block-list__block .editor-block-list__block-edit .widget h3.title, .wp-block.editor-block-list__block .editor-block-list__block-edit .widget-title {
    font-size: <?php echo esc_attr(get_theme_mod( 'brookside_widgets_headings_font_size', '11px' )); ?>; 
    font-weight: <?php echo esc_attr(get_theme_mod( 'brookside_widgets_headings_font_weight', '400' )); ?>;
    font-family: <?php echo esc_attr(get_theme_mod( 'brookside_widgets_headings_font_family', 'Montserrat' )); ?>;
    color: <?php echo esc_attr(get_theme_mod('brookside_widgets_headings_item_color', '#1c1d1f')); ?>;
    text-transform: <?php echo esc_attr(get_theme_mod( 'brookside_widgets_headings_transform', 'uppercase' )); ?>;    
    letter-spacing:<?php echo esc_attr( get_theme_mod( 'brookside_widgets_headings_letter_spacing', '1') ); ?>px;
}
.wp-block.editor-block-list__block .editor-block-list__block-edit .meta-date,
.wp-block.editor-block-list__block .editor-block-list__block-edit #latest-list-posts .post .post-meta .categories,
.wp-block.editor-block-list__block .editor-block-list__block-edit #latest-posts .post .post-meta .categories,
.wp-block.editor-block-list__block .editor-block-list__block-edit .post-meta > div,
.wp-block.editor-block-list__block .editor-block-list__block-edit .meta-read,
.wp-block.editor-block-list__block .editor-block-list__block-edit .related-meta-date,
.wp-block.editor-block-list__block .editor-block-list__block-edit .tp-caption.slider-posts-desc .slider-post-meta,
.wp-block.editor-block-list__block .editor-block-list__block-edit .slider-posts-desc .slider-post-meta,
.wp-block.editor-block-list__block .editor-block-list__block-edit .pagination_post a,
.wp-block.editor-block-list__block .editor-block-list__block-edit .pagination_post span {
        font-size: <?php echo esc_attr(get_theme_mod( 'brookside_meta_info_font_size', '12px' )); ?>;
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_meta_info_font_family', 'Montserrat' )); ?>';
    text-transform: <?php echo esc_attr(get_theme_mod( 'brookside_meta_info_transform', 'uppercase' )); ?>;
    letter-spacing:<?php echo esc_attr( get_theme_mod( 'brookside_widgets_headings_letter_spacing', '1') ); ?>px;
}
.wp-block.editor-block-list__block .editor-block-list__block-edit .widget .latest-blog-list .post-meta-recent span {
    font-family: <?php echo esc_attr(get_theme_mod( 'brookside_widgets_headings_font_family', 'Montserrat' )); ?>;
}
.wp-block.editor-block-list__block .editor-block-list__block-edit .widget .latest-blog-list .meta-categories a:hover,
.wp-block.editor-block-list__block .editor-block-list__block-edit .post-meta .meta-tags a:hover,
.wp-block.editor-block-list__block .editor-block-list__block-edit .widget_categories ul li a:hover,
.wp-block.editor-block-list__block .editor-block-list__block-edit #latest-list-posts .post .post-meta .categories a:hover,
.wp-block.editor-block-list__block .editor-block-list__block-edit .social-icons li a:hover,
.wp-block.editor-block-list__block .editor-block-list__block-edit input[type="checkbox"]:not(:checked) + label:after,
.wp-block.editor-block-list__block .editor-block-list__block-edit input[type="checkbox"]:checked + label:after,
.wp-block.editor-block-list__block .editor-block-list__block-edit .category-block:hover .category-block-inner .link-icon,
.wp-block.editor-block-list__block .editor-block-list__block-edit .block-title,
.wp-block.editor-block-list__block .editor-block-list__block-edit .list-style2 li:before,
.wp-block.editor-block-list__block .editor-block-list__block-edit .number-list li:before,
.post.style_6 .post-more a:hover {
    color:<?php echo esc_attr(get_theme_mod('brookside_accent_color', '#ba5c23')); ?> !important;
}
.meta-date {
   color:<?php echo esc_attr(get_theme_mod('brookside_meta_info_color', '#888c8e')); ?>; 
}
.prev-post-title span, .next-post-title span,
.post-meta-tags .meta-tags a {
    font-family: '<?php echo esc_attr(get_theme_mod( 'brookside_widgets_headings_font_family', 'Montserrat' )); ?>';
}
.wp-block.editor-block-list__block .editor-block-list__block-edit .social-icons.big_icon_text li a:hover,
.wp-block.editor-block-list__block .editor-block-list__block-edit .list-style1 li:before {
    background-color:<?php echo esc_attr(get_theme_mod('brookside_accent_color', '#ba5c23')); ?>;
}
.wp-block.editor-block-list__block .editor-block-list__block-edit .post.featured .title .meta-date .meta-categories a,
.wp-block.editor-block-list__block .editor-block-list__block-edit .wp-block-pullquote blockquote, .wp-block.editor-block-list__block .editor-block-list__block-edit .style2 {
    border-color:<?php echo esc_attr(get_theme_mod('brookside_accent_color', '#ba5c23')); ?>;
}
.wp-block.editor-block-list__block .editor-block-list__block-edit .category-block:hover .category-block-inner::before {
    border-top-color: <?php echo esc_attr(get_theme_mod('brookside_accent_color', '#ba5c23')); ?>;
    border-right-color: <?php echo esc_attr(get_theme_mod('brookside_accent_color', '#ba5c23')); ?>;
}
.wp-block.editor-block-list__block .editor-block-list__block-edit .category-block:hover .category-block-inner::after {
    border-bottom-color: <?php echo esc_attr(get_theme_mod('brookside_accent_color', '#ba5c23')); ?>;
    border-left-color: <?php echo esc_attr(get_theme_mod('brookside_accent_color', '#ba5c23')); ?>;
}

.wp-block.editor-block-list__block .editor-block-list__block-edit .widget.widget_socials .social-icons li a:before,
.wp-block.editor-block-list__block .editor-block-list__block-edit .pagination_post > span,
.wp-block.editor-block-list__block .editor-block-list__block-edit .pagination_post a:hover span {
    background-color:<?php echo esc_attr(get_theme_mod('brookside_accent_color', '#ba5c23')); ?> !important;
}
<?php $out=ob_get_contents(); $out = brookside_compress($out); ob_end_clean();
    wp_add_inline_style('brookside-blocks-style', $out);
}
add_action( 'enqueue_block_editor_assets', 'brookside_editor_styles_dynamic', 30 );
?>