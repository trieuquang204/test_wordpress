<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">
    <link rel="profile" href="http://gmpg.org/xfn/11">
  <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <?php endif; ?>  

    <?php wp_head(); ?>
</head>
    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top" <?php body_class(); ?>>
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only"><?php esc_attr_e( 'Toggle navigation', 'mistercorporate' ); ?></span>
                        <?php esc_attr_e( 'Menu', 'mistercorporate' ); ?> 
                        <i class="fa fa-bars"></i>
                    </button>
                <a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>">
                        <?php if ( get_theme_mod( 'custom_logo' ) ) : ?>
                            <?php $image_attributes = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), array(190,69) );
            if( $image_attributes ) : ?>
                            <img src="<?php echo esc_url($image_attributes[0]); ?>" class="brand-img img-responsive" width="<?php echo esc_attr($image_attributes[1]); ?>" height="<?php echo esc_attr($image_attributes[2]); ?>">
                        <?php endif; ?>
                    <?php else : ?>
                        <?php if (get_theme_mod('header_textcolor', '') != 'blank'){ ?>
                            <span><?php bloginfo( 'name' ); ?></span>
                            <p class="mistercorporatedesc"><?php bloginfo( 'description' ); ?></p>
                        <?php } ?>    
                    <?php endif; ?>
                    </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <?php wp_nav_menu( array(
                            'theme_location' => 'primary',
                            'depth' => 2,
                            'menu_class' => 'nav navbar-nav navbar-right',
                            'container' => '',
                            'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
                            'walker' => new wp_bootstrap_navwalker()
                    ) ); ?>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
        <main>