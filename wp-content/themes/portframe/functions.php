<?php 


add_action('init','portframe_actions_remove');
function portframe_actions_remove(){
    remove_action('arrival_footer_section','arrival_btm_footer',15);
}
/**
 * Register Google Fonts
 */
function portframe_fonts_url() {
    $fonts_url = '';

    $poppins        = esc_html_x( 'on', 'Poppins font: on or off', 'portframe' );
    $playfDisplay   = esc_html_x( 'on', 'Playfair Display font: on or off', 'portframe' );

    $font_families = array();

    if ( 'off' !== $poppins ) {
        $font_families[] = 'Poppins:300,400,500,600,700';
    }

    if ( 'off' !== $playfDisplay ) {
        $font_families[] = 'Playfair+Display:wght@400;500;600&display=swap';
    }

    if ( in_array( 'on', array(  $poppins, $playfDisplay ) ) ) {
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );

        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    return esc_url_raw( $fonts_url );

}


add_action( 'wp_enqueue_scripts', 'portframe_scripts' );
function portframe_scripts() {

    $themeVersion = wp_get_theme()->get('Version');
    wp_enqueue_style('portframe-styles', get_template_directory_uri() . '/style.css',array(), $themeVersion);
    wp_enqueue_style( 'portframe-fonts', portframe_fonts_url(), array(), null );

}


/**
 * Get default theme options and replace with new values
 *
 * @since 1.0.0
 *
 * @return array Default theme options.
 */
add_filter('arrival_filter_default_theme_options','portframe_get_default_theme_options');
function portframe_get_default_theme_options() {
    $prefix = 'arrival';
    $defaults = array();
    
    $defaults[$prefix.'_top_header_enable']                 = 'off';
    $defaults[$prefix.'_top_header_email']                  = '';
    $defaults[$prefix.'_top_header_phone']                  = '';
    $defaults[$prefix.'_top_right_header_content']          = 'menus';
    $defaults[$prefix.'_blog_layout']                       = 'list-layout';
    $defaults[$prefix.'_top_right_header_menus']            = 'top';
    $defaults[$prefix.'_main_nav_layout']                   = 'full';
    $defaults[$prefix.'_main_nav_right_btn_txt']            = esc_html__('Contact Us','portframe');
    $defaults[$prefix.'_main_nav_right_btn_url']            = '#';
    $defaults[$prefix.'_page_header_layout']                = 'default';
    $defaults[$prefix.'_menu_hover_styles']                 = 'hover-layout-one';
    $defaults[$prefix.'_one_page_menus']                    = 'no';
    $defaults[$prefix.'_footer_widget_enable']              = 'no';
    $defaults[$prefix.'_footer_icons_enable']               = 'no';
    $defaults[$prefix.'_lazyload_image_enable']             = 'yes';
    $defaults[$prefix.'_smooth_scroll_enable']              = 'no';
    $defaults[$prefix.'_top_header_bg_color']               = '#fbd214';
    $defaults[$prefix.'_main_nav_bg_color']                 = '#fafafa';
    $defaults[$prefix.'_footer_bg_color']                   = '#223645';
    $defaults[$prefix.'_footer_text_color']                 = '#fff';
    $defaults[$prefix.'_footer_link_color']                 = '#fff';
    $defaults[$prefix.'_footer_copyright_border_top']       = false;
    $defaults[$prefix.'_breadcrumb_overlay_disable']        = true;
    $defaults[$prefix.'_main_nav_menu_color']               = '#333';
    $defaults[$prefix.'_link_color']                        = '#333';
    $defaults[$prefix.'_main_container_width']              = 1170;
    $defaults[$prefix.'_inner_header_image_padding_btm']    = 32;
    $defaults[$prefix.'_inner_header_img_position']         = 'initial';
    $defaults[$prefix.'_sidebar_width']                     = 440;
    $defaults[$prefix.'_header_box_shadow_disable']         = false;
    $defaults[$prefix.'_blog_excerpts']                     = 580;
    $defaults[$prefix.'_single_post_sidebars']              = 'no_sidebar';
    $defaults[$prefix.'_nav_font_weight']                   = 500;
    $defaults[$prefix.'_top_header_txt_color']              = '#fff';
    $defaults[$prefix.'_theme_color']                       = '#FF2E63';
    $defaults[$prefix.'_top_left_content_type']             = 'contacts';
    $defaults[$prefix.'_top_header_txt']                    = '';
    $defaults[$prefix.'_main_nav_menu_align']               = 'default';
    $defaults[$prefix.'_main_nav_last_item_align']          = 'left';
    $defaults[$prefix.'_after_top_header_enable']           = 'no';
    $defaults[$prefix.'_main_nav_disable_logo']             = 'no';
    $defaults[$prefix.'_after_top_header_height']           = 150;
    $defaults[$prefix.'_after_top_hdr_top_padding']         = 30;
    $defaults[$prefix.'_after_top_hdr_btm_padding']         = 75;
    $defaults[$prefix.'_after_top_header_top_border_show']  = false;
    $defaults[$prefix.'_after_top_header_align_center']     = false;
    $defaults[$prefix.'_after_top_header_bg_color']         = '#fff';
    $defaults[$prefix.'_after_top_header_txt_color']        = '#333';
    $defaults[$prefix.'_after_top_header_border_color']     = '#f1f1f1';
    $defaults[$prefix.'_after_top_header_icon_color']       = '#333';
    $defaults[$prefix.'_cart_display_position']             = 'top';
    $defaults[$prefix.'_site_header_type']                  = 'default';
    $defaults[$prefix.'_site_header_custom_template']       = 0;
    $defaults[$prefix.'_site_footer_type']                  = 'default';
    $defaults[$prefix.'_site_footer_custom_template']       = 0;
    $defaults[$prefix.'_nav_header_padding']                = 0;
    $defaults[$prefix.'_transparent_header_enable']         = true;
    $defaults[$prefix.'_social_icons_new_tab']              = false;
    $defaults[$prefix.'_breadcrumb_enable']                = 'yes';

    $defaults[$prefix.'_main_nav_menu_color_transparent']  = '#ffffff';
   
    $defaults[$prefix.'_main_logo_width']                   = 100;
    $defaults[$prefix.'_single_page_sidebars']              = 'no_sidebar';
    $defaults[$prefix.'_post_featured_image_enable']        = 'yes';
    $defaults[$prefix.'_blog_page_sidebars']                = 'no_sidebar';
    $defaults[$prefix.'_post_meta_enable']                  = 'yes';
    $defaults[$prefix.'_post_author_enable']                = 'yes';
    $defaults[$prefix.'_post_date_enable']                  = 'yes';
    $defaults[$prefix.'_post_comment_enable']               = 'yes';

    $defaults[$prefix.'_main_nav_right_content']            = 'social-icons';

if( class_exists('woocommerce')):
    $defaults[$prefix.'_archive_shop_sidebars']             = 'no_sidebar';
    $defaults[$prefix.'_single_shop_sidebars']              = 'no_sidebar';
endif;

	return $defaults;

}

/**
* Add Social icons to header last items
*
*/
add_filter('arrival_nav_last_item','portframe_nav_last_item');
function portframe_nav_last_item(){
    $args = array(
        'social-icons'  => esc_html__('Social Icons','portframe'), 
        'search'        => esc_html__('Search','portframe'),
        'button'        => esc_html__('Button','portframe'),
        'none'          => esc_html__('Empty','portframe')
    );

   return $args; 
}

add_filter('arrival_custom_item_reserve','portframe_nav_last_icons');
function portframe_nav_last_icons(){
    do_action('arrival_social_icons');
}


/**
* Register footer menu
*/
register_nav_menus(
        apply_filters('arrival_nav_register',array(
            'footer'   => esc_html__( 'Footer', 'portframe' ),
        ))
    );


/**
* Additional footer settings
*
*/

add_action( 'customize_register', 'portframe_customize_register' );
function portframe_customize_register( $wp_customize ) {

    $wp_customize->add_setting( 'portframe_add_ftr_sep', array(
        'sanitize_callback'   => 'sanitize_text_field',        
      ) );

    $wp_customize->add_control( new Arrival_Customize_Seperator_Control( $wp_customize, 'portframe_add_ftr_sep', array(
            'label'         => esc_html__( 'Additional Options', 'portframe' ),
            'priority'      => 25,
            'description'   => esc_html__( 'Additional Footer Options', 'portframe' ),
            'section'       => 'arrival_footer_settings',
          ) ) );


    $wp_customize->add_setting( 'portframe_footer_logo',array(
        'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'portframe_footer_logo',
          array(
              'label'       => esc_html__( 'Footer Logo', 'portframe' ),
                'section'   => 'arrival_footer_settings',
                'priority'      => 30,
            )
        )
    );

    //footer title text
    $wp_customize->add_setting( 'portframe_footer_title_text', array(
      'sanitize_callback'   => 'sanitize_text_field',
      
    ) );



    $wp_customize->add_control( 'portframe_footer_title_text', array(
            'type'          => 'text',
            'priority'      => 35,
            'label'         => esc_html__( 'Footer Title Text', 'portframe' ),
            'description'   => esc_html__('Title text to display on footer','portframe'),
            'section'       => 'arrival_footer_settings'
            
          ) );

    /**
    * Footer button option
    */
    $wp_customize->add_setting('portframe_ftr_btn_txt', array(
            'sanitize_callback'     => 'sanitize_text_field',
            
          ) );

    $wp_customize->add_control('portframe_ftr_btn_txt', array(
            'type'          => 'text',
            'priority'      => 40,
            'label'         => esc_html__( 'Button Text', 'portframe' ),
            'description'   => esc_html__('Text for button','portframe'),
            'section'       =>'arrival_footer_settings'
            
          ) );

    $wp_customize->add_setting('portframe_ftr_btn_url', array(
            'sanitize_callback'     => 'esc_url_raw',
          ) );

    $wp_customize->add_control('portframe_ftr_btn_url', array(
            'type'         => 'text',
            'priority'      => 45,
            'label'         => esc_html__( 'Button URL', 'portframe' ),
            'description'   => esc_html__('Add URL for header button','portframe'),
            'section'       =>'arrival_footer_settings'
            
          ) );


}

add_filter( 'arrival_footer_options', 'portframe_footer_ids_tab' );
function portframe_footer_ids_tab(){

    $settings_id = [
        'portframe_add_ftr_sep',
        'portframe_footer_logo',
        'portframe_footer_title_text',
        'portframe_ftr_btn_txt',
        'portframe_ftr_btn_url',

        'arrival_sticky_ftr_enable',
        'arrival_sticky_ftr_height',
        'arrival_ftr_scroll_top_enable',
        'arrival_site_footer_type',
        'arrival_site_footer_custom_template',
        'arrival_footer_widget_enable',
        'arrival_footer_copyright_text',
        'arrival_footer_icons_enable',
        'arrival_footer_social_redirect_btn',
        'arrival_btm_ftr_content_layout',
    ];

    return $settings_id;
}

/**
* Footer contents
*
*/

add_action('arrival_footer_section','portframe_btm_footer',16);
if(! function_exists('portframe_btm_footer')){
    function portframe_btm_footer(){

        $defaults                       = portframe_get_default_theme_options();
        $_footer_copyright_text         = get_theme_mod('arrival_footer_copyright_text');
        $_footer_icons_enable           = get_theme_mod('arrival_footer_icons_enable',$defaults['arrival_footer_icons_enable']);
        $_footer_copyright_border_top   = get_theme_mod('arrival_footer_copyright_border_top',$defaults['arrival_footer_copyright_border_top']);
        
        $footer_border = ($_footer_copyright_border_top == true) ? 'border-enable' : '';
        $ftr_def_text_value = apply_filters('arrival_footer_credit_texts','__return_true' );

        $portframe_footer_logo         = get_theme_mod('portframe_footer_logo');
        $portframe_footer_title_text   = get_theme_mod('portframe_footer_title_text');
        $portframe_ftr_btn_txt         = get_theme_mod('portframe_ftr_btn_txt');
        $portframe_ftr_btn_url         = get_theme_mod('portframe_ftr_btn_url');

    ?>
    <div class="footer-btm <?php echo esc_attr($footer_border);?>">
        <div class="footer-additionals-wrapp">

            <?php if($portframe_footer_logo){ ?>
            <div class="footer-logo">
                <img src="<?php echo esc_url($portframe_footer_logo)?>">
            </div>
            <?php }

            if($portframe_footer_title_text){?>
                <div class="footer-title-txt">
                    <h3><?php  echo esc_html($portframe_footer_title_text); ?></h3>
                </div>
            <?php }

            if($portframe_ftr_btn_url){?>
                <div class="ftr-btn">
                    <a href="<?php echo esc_url($portframe_ftr_btn_url)?>" class="btn-ftr">
                        <?php echo esc_html($portframe_ftr_btn_txt); ?>
                    </a>
                </div>
            <?php } ?>


        </div>
        <div class="ftr-menus">
            <?php 
                wp_nav_menu(
                        array(
                            'theme_location' => 'footer',
                            'menu_id'        => 'footer-menu',
                            'container'      => 'ul',
                            'menu_class'     => 'footer-menus'
                        )
                    );
             ?>
        </div>
        <?php if( $_footer_icons_enable == 'yes' ){ ?>
        <div class="social-icons-wrapp">
            <?php do_action('arrival_social_icons'); ?>
        </div>
        <?php } ?>
        <div class="site-info">
            <?php if($_footer_copyright_text){ ?>
                <span class="cppyright-text"><?php echo wp_kses_post(do_shortcode($_footer_copyright_text)); ?></span>
            <?php }else{
             printf(wp_kses_post('&copy; %1$s %2$s'), esc_html(date("Y")), esc_html(get_bloginfo('name')));
            } 
            
            $theme_ob = wp_get_theme();
            $theme    = $theme_ob->get( 'Name' );
            

            if( $ftr_def_text_value == true ): ?>

            <span class="sep"> | </span>
            <?php echo esc_html__('WordPress Theme:','portframe'); ?>
            <a href="<?php echo esc_url('https://wpoperation.com/themes/portframe')?>">
                <?php echo esc_html($theme); ?>
            </a>

            <?php endif; ?>

        </div><!-- .site-info -->
        
        

    </div><!-- .footer-btm -->
    <?php 
    }
}