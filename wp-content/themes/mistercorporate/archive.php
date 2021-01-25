<?php
get_header(); ?>

<header class="intro-header mrcorp-add-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1><?php esc_attr_e( 'Archive', 'mistercorporate' ); ?></h1>
                    <hr class="small">
                    <span class="subheading"><?php the_archive_title(); ?></span>
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
                    <div class="col-md-12"><a href="<?php echo esc_url( get_permalink() ); ?>"><h2><?php the_title(); ?></h2></a></div>

                      <?php if ( has_post_thumbnail() ) {   ?>
                          <div class="col-md-12"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-thumbnail', array('class' => 'img-responsive')); ?></a></div>
                      <?php } ?>

                    <div class="col-md-12"><div class="col-md-8 col-md-offset-2"><?php the_excerpt( ); ?><p><a href="<?php the_permalink(); ?>"><div class="btn btn-default"><?php esc_attr_e( 'Continue reading...', 'mistercorporate' ); ?></div></a></p></div></div>
                    <div class="col-md-4">
                      <p><i class="fa fa-comments" aria-hidden="true"></i> <?php comments_number( '0', '1', '%' ); ?></p>
                    </div>
                    <div class="col-md-4">
                      <p><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo get_the_date(get_option( 'j M' )); ?></p>
                    </div>
                    <div class="col-md-4">
                      <p><i class="fa fa-user" aria-hidden="true"></i> <?php echo '<a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'">'.get_the_author().'</a>'; ?></p>
                    </div>
                    <div class="col-md-12">
                      <p><i class="fa fa-th-list" aria-hidden="true"></i> <?php the_category(' ') ?></p>
                    </div>
                    <div class="col-md-12">
                      <p><?php the_tags('<i class="fa fa-tags" aria-hidden="true"></i> ', ', ' , ''); ?></p>
                    </div>
                    <div class="col-md-12"><hr class="small"></div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <p><?php esc_attr_e( 'Sorry, no posts matched your criteria.', 'mistercorporate' ); ?></p>
        <?php endif; ?>

                <div class="col-md-6">
                    <?php previous_posts_link(__( '<div class="btn btn-default"><p><i class="fa fa-angle-double-left fa-3x" aria-hidden="true"></i></p></div>', 'mistercorporate' )) ?>
                </div>    
                <div class="col-md-6 text-right">
                    <?php next_posts_link(__( '<div class="btn btn-default"><p><i class="fa fa-angle-double-right fa-3x" aria-hidden="true"></i></p></div>', 'mistercorporate' )) ?>
                </div>
        
    </div>
</section>            

<?php get_footer(); ?>