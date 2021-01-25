<?php
get_header(); ?>

<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <article>
            <header class="intro-header mrcorp-add-header">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                            <div class="site-heading">
                                <h1><?php the_title(); ?></h1>
                                <hr class="small">
                                <span><i class="fa fa-calendar" aria-hidden="true"></i> <?php the_date(); ?></span>
                                <span><i class="fa fa-user" aria-hidden="true"></i> <?php the_author(); ?></span>
                                <span><i class="fa fa-comments" aria-hidden="true"></i> <?php comments_number( '0 Comment', '1 Comment', '% Comments' ); ?></span>
                                <span><?php the_tags(__( '<i class="fa fa-tags" aria-hidden="true"></i> ', 'mistercorporate' ), ', ' , ''); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <section>
                <div class="container">
                    <div <?php post_class( 'underlined-title' ); ?>>
                        <?php the_post_thumbnail( 'large' ); ?>
                        <a href="<?php echo esc_url( get_permalink() ); ?>"></a>
                        <?php the_content(); ?>
                        <hr class="small">


                    <?php 
          the_post_navigation( array(
            'prev_text'                  => __( 'Prev post: %title', 'mistercorporate' ),
            'next_text'                  => __( 'Next post: %title', 'mistercorporate' ),
            'screen_reader_text' => __( 'Continue Reading', 'mistercorporate' ),
          ) );          
                    ?>
          <?php wp_link_pages( array(
            'before'      => '<div class="page-links"><span class="page-links-title">' . __( '<hr class="small">PAGES:', 'mistercorporate' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
            ) );
          ?>


                        <hr class="small">

                        <?php comments_template(); ?>
                    </div>
                </div>
            </section>
        </article>
        </div>
    <?php endwhile; ?>
<?php else : ?>
    <p><?php esc_attr_e( 'Sorry, no posts matched your criteria.', 'mistercorporate' ); ?></p>
<?php endif; ?>

<?php get_footer(); ?>