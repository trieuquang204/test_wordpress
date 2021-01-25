<?php
get_header(); ?>

<?php $image_attributes = wp_get_attachment_image_src( get_theme_mod( 'mrcorp_header_bgk' ) ); ?>
<header class="intro-header mrcorp-add-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1><?php esc_attr_e( 'Search results for:', 'mistercorporate' ); ?></h1>
                    <hr class="small">
                    <span class="subheading"><?php echo esc_html( get_search_query( false ) ); ?></span>
                </div>
            </div>
        </div>
    </div>
</header>
<section id="gallery" class="gallery">
    <div class="container cont-gallery">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="underlined-title">
                    <a href="<?php echo esc_url( get_permalink() ); ?>"><h2><?php the_title(); ?></h2></a>
                    <?php the_excerpt( ); ?>
                    <hr class="small">
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <p><?php esc_attr_e( 'Sorry, no posts matched your criteria. Try another search', 'mistercorporate' ); ?></p>
            <?php get_search_form(); ?>
        <?php endif; ?>
    </div>
</section>            

<?php get_footer(); ?>