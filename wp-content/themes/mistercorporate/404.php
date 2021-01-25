<?php
get_header(); ?>

<header class="intro-header mrcorp-add-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1><?php esc_attr_e( 'Sorry, no posts matched your criteria.', 'mistercorporate' ); ?></h1>
                    <hr class="small">
                    <span class="subheading"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_attr_e( 'Go back Home', 'mistercorporate' ); ?></a></span>
                </div>
            </div>
        </div>
    </div>
</header>            

<?php get_footer(); ?>