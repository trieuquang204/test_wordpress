<?php
/**
 * Template Name: Mistercorporate Home
 *
 */
get_header();
?>

<header class="intro-header mrcorp-add-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1>
                        <?php if( get_theme_mod( 'mrcorp_header_big_text' ) && get_theme_mod( 'mrcorp_header_big_text' ) != ''){ ?>
                            <?php echo esc_attr(get_theme_mod( 'mrcorp_header_big_text')); ?>
                        <?php } else { ?>
                            <?php _e( 'Mr. Corporate', 'mistercorporate' ); ?>
                        <?php } ?>    
                    </h1>
                    <hr class="small">
                    <span class="subheading">
                        <?php if( get_theme_mod( 'mrcorp_header_small_text' ) && get_theme_mod( 'mrcorp_header_small_text' ) != '') { ?>
                            <?php echo esc_attr(get_theme_mod( 'mrcorp_header_small_text')); ?>
                        <?php } else { ?>
                            <?php _e( 'An Elegant Corporate Theme by NsThemes', 'mistercorporate' ); ?>
                        <?php } ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>
<?php if ( get_theme_mod( 'mrcorp_gallery_show' ) ) : ?>
    <section id="gallery" class="gallery">
        <div class="container cont-gallery">
            <div class="underlined-title">
                <h2>
                    <?php if( get_theme_mod( 'mrcorp_gallery_big_text' ) && get_theme_mod( 'mrcorp_gallery_big_text' ) != '') { ?>
                        <?php echo esc_attr(get_theme_mod( 'mrcorp_gallery_big_text')); ?>
                    <?php } else { ?>
                        <?php _e( 'A selection of our work', 'mistercorporate' ); ?>
                    <?php } ?>   
                </h2>
                <hr class="small">
                <h3>
                    <?php if( get_theme_mod( 'mrcorp_gallery_small_text' ) && get_theme_mod( 'mrcorp_gallery_small_text' ) != '') { ?>
                        <?php echo esc_attr(get_theme_mod( 'mrcorp_gallery_small_text')); ?>
                    <?php } else { ?>
                        <?php _e( 'Hand-picked just for you', 'mistercorporate' ); ?>
                    <?php } ?> 
                </h3>
            </div>
            <div class="row">
                <?php
                    global $post;
                    $args = array( 'posts_per_page' => 6 );  
                    $mistercorpposts = get_posts( $args );
                ?>
                <?php if ( $mistercorpposts != '' ) : ?>
                    <?php $item_number = 0; ?>
                    <?php foreach ( $mistercorpposts as $ns_key =>$post ) : setup_postdata( $post ); ?>
                        <div class="grid col-md-4 col-sm-6 col-xs-12">
                            <a href="<?php echo esc_url( get_permalink() ); ?>">
                                <figure class="effect-hovimg">
                                    <?php the_post_thumbnail( array(410,300) ); ?>
                                    <figcaption>
                                        <h2><?php the_title(); ?></h2>
                                    </figcaption>                                             
                                </figure>
                            </a>    
                        </div>
                        <?php $item_number++; ?>
                        <?php if( $item_number % 3 == 0 ) echo '<div class="clearfix visible-md-block visible-lg-block"></div>'; ?>
                        <?php if( $item_number % 2 == 0 ) echo '<div class="clearfix visible-sm-block"></div>'; ?>
                        <?php if( $item_number % 1 == 0 ) echo '<div class="clearfix visible-xs-block"></div>'; ?>
                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); ?>
                    

                <?php else : ?>
                    <p><?php esc_attr_e( 'Sorry, no posts matched your criteria.', 'mistercorporate' ); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>