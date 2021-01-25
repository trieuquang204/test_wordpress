<?php


if ( ! isset( $content_width ) ) {
    $content_width = 1170;
}


if ( ! function_exists( 'mistercorporate_setup' ) ) :

function mistercorporate_setup() {

    load_theme_textdomain( 'mistercorporate', get_template_directory() . '/languages' );

    /*
     * Add logo upload support.
     */
    add_theme_support( 'custom-logo' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     */
    add_theme_support( 'title-tag' );
    
    /*
     * Enable support for Post Thumbnails on posts and pages.
     */
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 825, 510, true );

    // Add menus.
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'mistercorporate' ),
        'social'  => __( 'Social Links Menu', 'mistercorporate' ),
    ) );


    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ) );

    add_theme_support( 'custom-background', array('default-color' => 'FFFFFF') ); /*requires WP v >= 3.4  */
    add_theme_support( 'custom-header' );

}
endif; // mistercorporate_setup

/*
 * Register widget areas.
 */
add_action( 'after_setup_theme', 'mistercorporate_setup' );


if ( ! function_exists( 'mistercorporate_widgets_init' ) ) :

function mistercorporate_widgets_init() {

    /* Mistercorporate generated Register Sidebars Begin */

    register_sidebar( array(
        'name' => __( 'Footer Sidebar 1', 'mistercorporate' ),
        'id' => 'mrcorp_footer_sidebar_1',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Sidebar 2', 'mistercorporate' ),
        'id' => 'mrcorp_footer_sidebar_2',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Sidebar 3', 'mistercorporate' ),
        'id' => 'mrcorp_footer_sidebar_3',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ) );



    /* Mistercorporate generated Register Sidebars End */
}
add_action( 'widgets_init', 'mistercorporate_widgets_init' );
endif;// mistercorporate_widgets_init



if ( ! function_exists( 'mistercorporate_customize_register' ) ) :

function mistercorporate_customize_register( $wp_customize ) {

    /* Mistercorporate generated Customizer Controls Begin */

    $wp_customize->add_panel( 'mistercoporate_panel', array(
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __( 'Mistercorporate Options', 'mistercorporate' ),
        'description' => __( 'Options for Mistercorporate.', 'mistercorporate' ),
    ) );



    $wp_customize->add_section( 'mrcorp_header_section', array(
        'panel' => 'mistercoporate_panel',
        'title' => __( 'Header Section', 'mistercorporate' )
    ));


    $wp_customize->add_section( 'mrcorp_footer_section', array(
        'panel' => 'mistercoporate_panel',
        'title' => __( 'Footer Section', 'mistercorporate' )
    ));

    $wp_customize->add_setting( 'mrcorp_footer_tw', array(
        'sanitize_callback' => 'esc_url_raw',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( 'mrcorp_footer_tw', array(
        'label' => __( 'Twitter Link', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_footer_section'
    ));

    $wp_customize->add_setting( 'mrcorp_footer_fb', array(
        'sanitize_callback' => 'esc_url_raw',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( 'mrcorp_footer_fb', array(
        'label' => __( 'Facebook Link', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_footer_section'
    ));

    $wp_customize->add_setting( 'mrcorp_footer_g', array(
        'sanitize_callback' => 'esc_url_raw',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( 'mrcorp_footer_g', array(
        'label' => __( 'Google + Link', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_footer_section'
    ));

    $wp_customize->add_setting( 'mrcorp_footer_copy', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => ''
    ));

    $wp_customize->add_control( 'mrcorp_footer_copy', array(
        'label' => __( 'Copyright Text', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_footer_section'
    ));

    $wp_customize->add_setting( 'mrcorp_header_big_text', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => ''
    ));

    $wp_customize->add_control( 'mrcorp_header_big_text', array(
        'label' => __( 'Big Text', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_header_section'
    ));

    $wp_customize->add_setting( 'mrcorp_header_small_text', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => ''
    ));

    $wp_customize->add_control( 'mrcorp_header_small_text', array(
        'label' => __( 'Small Text', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_header_section'
    ));

    $wp_customize->add_setting( 'mrcorp_gallery_show', array(
        'sanitize_callback' => 'absint',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( 'mrcorp_gallery_show', array(
        'label' => __( 'Show/Hide Section', 'mistercorporate' ),
        'type' => 'checkbox',
        'section' => 'mrcorp_gallery_section'
    ));

    $wp_customize->add_section( 'mrcorp_gallery_section', array(
        'panel' => 'mistercoporate_panel',
        'title' => __( 'Gallery Section', 'mistercorporate' )
    ));

    $wp_customize->add_setting( 'mrcorp_gallery_big_text', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => ''
    ));

    $wp_customize->add_control( 'mrcorp_gallery_big_text', array(
        'label' => __( 'Big Text', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_gallery_section'
    ));

    $wp_customize->add_setting( 'mrcorp_gallery_small_text', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => ''
    ));

    $wp_customize->add_control( 'mrcorp_gallery_small_text', array(
        'label' => __( 'Small Text', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_gallery_section'
    ));

    /* Mistercorporate generated Customizer Controls End */

}
add_action( 'customize_register', 'mistercorporate_customize_register' );
endif;// mistercorporate_customize_register


if ( ! function_exists( 'mistercorporate_enqueue_scripts' ) ) :
    function mistercorporate_enqueue_scripts() {

    /* Mistercorporate generated Enqueue Scripts Begin */

    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js', array( 'jquery' ), '3.3.7', true );

    wp_enqueue_script( 'scrollreveal', get_template_directory_uri() . '/assets/js/scrollreveal.js', array( 'jquery' ), '1.0', true );

    wp_enqueue_script( 'mistercorporate', get_template_directory_uri() . '/assets/js/mistercorporate.js', array( 'jquery' ), '1.0', true );

    wp_enqueue_script( 'scrollingnav-nav', get_template_directory_uri() . '/assets/js/scrolling-nav.js', array( 'jquery' ), '1.0', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    /* Mistercorporate generated Enqueue Scripts End */

    /* Mistercorporate generated Enqueue Styles Begin */

    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css', null, '3.3.7', 'all' );

    wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/css/font-awesome.css', null, '4.7.0', 'all' );

    wp_enqueue_style( 'mistercorporate-ultra-css', 'https://fonts.googleapis.com/css?family=Ultra', null, null, 'all' );

    wp_enqueue_style( 'mistercorporate-stint-ultra-css', 'https://fonts.googleapis.com/css?family=Stint+Ultra+Expanded', null, null, 'all' );

    wp_enqueue_style( 'mistercorporate-slabo-css', 'https://fonts.googleapis.com/css?family=Slabo+13px', null, null, 'all' );

    wp_enqueue_style( 'mistercorporate-style', get_stylesheet_uri() );
    /* Mistercorporate generated Enqueue Styles End */

    }
    add_action( 'wp_enqueue_scripts', 'mistercorporate_enqueue_scripts' );
endif;

/*
 * Mistercorporate Walker menu.
 */

require_once get_template_directory() . '/inc/class/mistercorporate_bootstrap_navwalker.php';


/*
 * Additional Style.
 */
require_once get_template_directory() . '/inc/mrcorporate-additional-style.php';


/*
 * Raccomended plugin.
 */
require_once get_template_directory() . '/inc/mrcorporate-plugin-raccomended.php';



/*
 * Add smooth scroll class to menu.
 */
function mistercorporate_menuclass_add($ulclass) {
    return preg_replace('/<a /', '<a class="smooth-scroll" ', $ulclass);
}
add_filter('wp_nav_menu','mistercorporate_menuclass_add');



/*
 * Mistercorporate Comment.
 */
function mistercorporate_comm( $comment, $args, $depth ) {
    ?>
                    <!-- single comment -->
                    <div <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">                          

                          <p><?php comment_text(); ?></p>
                          <?php
                          $mrcorp_comment_author_url = get_comment_author_url();
                          if ($mrcorp_comment_author_url != '') {
                              $mistercorporate_print_comment_author = '<a href="'.get_comment_author_url().'">'.get_comment_author().'</a>';
                          }else{
                              $mistercorporate_print_comment_author = get_comment_author();
                          }
                          ?>
                          <p>
                            <img src="<?php echo esc_url(get_avatar_url($comment)); ?>" width="32px">
                            <?php esc_attr_e( 'Posted by:', 'mistercorporate' ); ?> <span><?php echo wp_kses($mistercorporate_print_comment_author, array('a' => array('href' => array(),'title' => array()))); ?></span> | <a href="#comment-<?php comment_ID(); ?>"><?php echo get_comment_date(); ?></a> <?php edit_comment_link(__('Edit', 'mistercorporate'),'| '); ?> | <?php echo wp_kses(get_comment_reply_link( array_merge( $args, array( 'add_below'  => 'li-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ), array('a' => array('href' => array(),'title' => array()))); ?> <?php esc_attr_e( 'to ', 'mistercorporate' ); ?> <?php comment_author(); ?>
                          </p>
                          <hr class="small-comments">
                    </div>
<?php
}

?>