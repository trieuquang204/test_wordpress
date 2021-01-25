<?php
/**
 * Template Name: Mistercorporate Home
 * Override template of Mistercorporate
 *
 */
get_header();
?>
<div id="MistercorporateModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-padding">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <?php _e( 'x', 'mistercorporate' ); ?>
                </button>
                <h3 id="myModalLabel"><?php echo get_theme_mod( 'mrcorp_modal_tit', __( 'Contact us!', 'mistercorporate' ) ); ?></h3>
            </div>
            <div>
                <?php echo do_shortcode(get_theme_mod( 'mrcorp_modal_short' )); ?>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

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
<?php if ( get_theme_mod( 'mrcorp_quote_show' ) ) : ?>
    <section class="text-adv">
        <div class="container text-center">
            <i class="fa fa-quote-left quote-color" aria-hidden="true"></i>
            <span><?php echo get_theme_mod( 'mrcorp_quote_text', __( 'Cum sociis natoque penatibus et magnis montes, nascetur ridiculus mus.', 'mistercorporate' ) ); ?></span> 
            <i class="fa fa-quote-right quote-color" aria-hidden="true"></i>
        </div>
    </section>
<?php endif; ?>
<?php if ( get_theme_mod( 'mrcorp_tryit_show' ) ) : ?>
    <section>
        <div class="container-full margin-bottom-img" id="tryit">
            <div class="container">
                <div class="row row-img-right">
                    <div class="col-md-12">
                        <div class="col-md-5 col-img-right">
                            <h2><?php echo get_theme_mod( 'mrcorp_tryit_big_text', __( 'Cum sociis natoque', 'mistercorporate' ) ); ?></h2>
                            <p><?php echo get_theme_mod( 'mrcorp_tryit_small_text', __( 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.', 'mistercorporate' ) ); ?></p>
                            <?php if ( get_theme_mod( 'mrcorp_tryit_button1_sh' ) ) : ?>
                                <a href="<?php echo esc_url( get_theme_mod( 'mrcorp_tryit_button1_href' ) ); ?>" class="btn btn-default btn-mini"><?php echo get_theme_mod( 'mrcorp_tryit_button1_label', __( 'Try free', 'mistercorporate' ) ); ?></a>
                            <?php endif; ?> 
                            <?php if ( get_theme_mod( 'mrcorp_tryit_button2_sh' ) ) : ?>
                                <a href="<?php echo esc_url( get_theme_mod( 'mrcorp_tryit_button2_href' ) ); ?>" class="btn btn-default btn-mini"><?php echo get_theme_mod( 'mrcorp_tryit_button2_label', __( 'Buy now', 'mistercorporate' ) ); ?></a>
                            <?php endif; ?> 
                            <?php if ( get_theme_mod( 'mrcorp_tryit_button3_sh' ) ) : ?>
                                <a href="<?php echo esc_url( get_theme_mod( 'mrcorp_tryit_button3_href' ) ); ?>" role="button" class="btn btn-default btn-mini" data-toggle="modal"><?php echo get_theme_mod( 'mrcorp_tryit_button3_label', __( 'Contact us', 'mistercorporate' ) ); ?></a>
                            <?php endif; ?>
                        </div>
                    <div class="col-md-7">
                            <?php $image_attributes = wp_get_attachment_image_src( get_theme_mod( 'mrcorp_tryit_right_image' ), 'large' );
if( $image_attributes ) : ?>
                            <img class="img-responsive height-max-ns" src="<?php echo $image_attributes[0]; ?>" alt="" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>">
                        <?php endif; ?> 
                        </div>
                    </div>
                </div>
            </div>                         
        </div>
    </section>
<?php endif; ?>
<?php if ( get_theme_mod( 'mrcorp_newsletter_show' ) ) : ?>
    <section class="section-newsletter">
        <div class="container cont-newsletter">
            <div class="col-md-7 pull-left">
                <h2><?php echo get_theme_mod( 'mrcorp_newsletter_text', __( 'Sign-up to receive our newsletter', 'mistercorporate' ) ); ?></h2>
            </div>
            <div class="col-md-5 pull-right col-newsletter">
                <?php if ( get_theme_mod( 'mrcorp_shortcode_mailchimp' ) ) : ?>
                    <div class="input-group mrcorp-input-class mrcorp-width-class">
                        <?php echo do_shortcode(get_theme_mod('mrcorp_shortcode_mailchimp')); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
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
<?php if ( get_theme_mod( 'mrcorp_adv_show' ) ) : ?>
    <div class="container-full pad-tp-bt-ns">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-center"><a href="<?php echo esc_url( get_theme_mod( 'mrcorp_adv_href' ) ); ?>">
                            <?php $image_attributes = wp_get_attachment_image_src( get_theme_mod( 'mrcorp_adv_img' ), array(728,90) );
if( $image_attributes ) : ?>
                            <img class="img-responsive height-max-ns cent-ban-ns" src="<?php echo $image_attributes[0]; ?>" alt="" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>">
                        <?php endif; ?>
                        </a></h3>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if ( get_theme_mod( 'mrcorp_price_show' ) ) : ?>
    <section id="price">
        <div class="container cont-price-list">
            <div class="underlined-title">
                <h2><?php echo get_theme_mod( 'mrcorp_price_big_text', __( 'Choose what you want', 'mistercorporate' ) ); ?></h2>
                <hr class="small">
                <h3><?php echo get_theme_mod( 'mrcorp_price_small_text', __( 'It cost less than you think', 'mistercorporate' ) ); ?></h3>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php if ( get_theme_mod( 'mrcorp_price_show' ) ) : ?>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo get_theme_mod( 'mrcorp_price_1_name', __( 'Bronze', 'mistercorporate' ) ); ?></h3>
                        </div>
                        <div class="panel-body">
                            <div class="the-price">
                                <h1><?php echo get_theme_mod( 'mrcorp_price_1_price', __( '&#36;10', 'mistercorporate' ) ); ?>
                                <span class="subscript"><?php echo get_theme_mod( 'mrcorp_price_1_period', __( '/mo', 'mistercorporate' ) ); ?></span>
                                </h1>
                                <small><?php echo get_theme_mod( 'mrcorp_price_1_small_text', __( '1 month FREE trial', 'mistercorporate' ) ); ?></small>
                            </div>
                            <table class="table">
                                <tr>
                                    <?php if( get_theme_mod( 'mrcorp_price_1_text_1' ) ) : ?>
                                        <td><?php echo get_theme_mod( 'mrcorp_price_1_text_1', __( '1 Account', 'mistercorporate' ) ); ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr class="active">
                                    <?php if( get_theme_mod( 'mrcorp_price_1_text_2' ) ) : ?>
                                        <td><?php echo get_theme_mod( 'mrcorp_price_1_text_2', __( '1 Project', 'mistercorporate' ) ); ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if( get_theme_mod( 'mrcorp_price_1_text_3' ) ) : ?>
                                        <td><?php echo get_theme_mod( 'mrcorp_price_1_text_3', __( '100K API Access', 'mistercorporate' ) ); ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr class="active">
                                    <?php if( get_theme_mod( 'mrcorp_price_1_text_4' ) ) : ?>
                                        <td><?php echo get_theme_mod( 'mrcorp_price_1_text_4', __( '100MB Storage', 'mistercorporate' ) ); ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if( get_theme_mod( 'mrcorp_price_1_text_5' ) ) : ?>
                                        <td><?php echo get_theme_mod( 'mrcorp_price_1_text_5', __( 'Custom Cloud Services', 'mistercorporate' ) ); ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr class="active">
                                    <?php if( get_theme_mod( 'mrcorp_price_1_text_6' ) ) : ?>
                                        <td><?php echo get_theme_mod( 'mrcorp_price_1_text_6', __( 'Weekly Reports', 'mistercorporate' ) ); ?></td>
                                    <?php endif; ?>
                                </tr>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <a href="<?php echo esc_url( get_theme_mod( 'mrcorp_price_1_button_link' ) ); ?>" class="btn btn-default" role="button"><?php echo get_theme_mod( 'mrcorp_price_1_button_label', __( 'Sign Up', 'mistercorporate' ) ); ?></a>
                            <br />
                            <span><?php echo get_theme_mod( 'mrcorp_price_1_text_bottom', __( '1 month FREE trial', 'mistercorporate' ) ); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="panel panel-success">
                        <div class="rib-on">
                            <div class="rib-on-inner">
                                <span class="rib-on-label"><?php echo get_theme_mod( 'mrcorp_price_2_ribbon', 'MOST<br> POPULR' ); ?></span>
                            </div>
                        </div>
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo get_theme_mod( 'mrcorp_price_2_name', __( 'Silver', 'mistercorporate' ) ); ?></h3>
                        </div>
                        <div class="panel-body">
                            <div class="the-price">
                                <h1><?php echo get_theme_mod( 'mrcorp_price_2_price', __( '&#36;20', 'mistercorporate' ) ); ?>
                                <span class="subscript"><?php echo get_theme_mod( 'mrcorp_price_2_period', __( '/mo', 'mistercorporate' ) ); ?></span>
                                </h1>
                                <small><?php echo get_theme_mod( 'mrcorp_price_2_small_text', __( '1 month FREE trial', 'mistercorporate' ) ); ?></small>
                            </div>
                            <table class="table">
                                <tr>
                                    <?php if( get_theme_mod( 'mrcorp_price_2_text_1' ) ) : ?>
                                        <td><?php echo get_theme_mod( 'mrcorp_price_2_text_1', __( '2 Account', 'mistercorporate' ) ); ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr class="active">
                                    <?php if( get_theme_mod( 'mrcorp_price_2_text_2' ) ) : ?>
                                        <td><?php echo get_theme_mod( 'mrcorp_price_2_text_2', __( '5 Project', 'mistercorporate' ) ); ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if( get_theme_mod( 'mrcorp_price_2_text_3' ) ) : ?>
                                        <td><?php echo get_theme_mod( 'mrcorp_price_2_text_3', __( '100K API Access', 'mistercorporate' ) ); ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr class="active">
                                    <?php if( get_theme_mod( 'mrcorp_price_2_text_4' ) ) : ?>
                                        <td><?php echo get_theme_mod( 'mrcorp_price_2_text_4', __( '200MB Storage', 'mistercorporate' ) ); ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if( get_theme_mod( 'mrcorp_price_2_text_5' ) ) : ?>
                                        <td><?php echo get_theme_mod( 'mrcorp_price_2_text_5', __( 'Custom Cloud Services', 'mistercorporate' ) ); ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr class="active">
                                    <?php if( get_theme_mod( 'mrcorp_price_2_text_6' ) ) : ?>
                                        <td><?php echo get_theme_mod( 'mrcorp_price_2_text_6', __( 'Weekly Reports', 'mistercorporate' ) ); ?></td>
                                    <?php endif; ?>
                                </tr>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <a href="<?php echo esc_url( get_theme_mod( 'mrcorp_price_2_button_link' ) ); ?>" class="btn btn-default" role="button"><?php echo get_theme_mod( 'mrcorp_price_2_button_label', __( 'Sign Up', 'mistercorporate' ) ); ?></a>
                            <br />
                            <span><?php echo get_theme_mod( 'mrcorp_price_2_text_bottom', __( '1 month FREE trial', 'mistercorporate' ) ); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo get_theme_mod( 'mrcorp_price_3_name', __( 'Gold', 'mistercorporate' ) ); ?></h3>
                        </div>
                        <div class="panel-body">
                            <div class="the-price">
                                <h1><?php echo get_theme_mod( 'mrcorp_price_3_price', __( '&#36;35', 'mistercorporate' ) ); ?>
                                <span class="subscript"><?php echo get_theme_mod( 'mrcorp_price_3_period', __( '/mo', 'mistercorporate' ) ); ?></span>
                                </h1>
                                <small><?php echo get_theme_mod( 'mrcorp_price_3_small_text', __( '1 month FREE trial', 'mistercorporate' ) ); ?></small>
                            </div>
                            <table class="table">
                                <tr>
                                    <?php if( get_theme_mod( 'mrcorp_price_3_text_1' ) ) : ?>
                                        <td><?php echo get_theme_mod( 'mrcorp_price_3_text_1', __( '5 Account', 'mistercorporate' ) ); ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr class="active">
                                    <?php if( get_theme_mod( 'mrcorp_price_3_text_2' ) ) : ?>
                                        <td><?php echo get_theme_mod( 'mrcorp_price_3_text_2', __( '20 Project', 'mistercorporate' ) ); ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if( get_theme_mod( 'mrcorp_price_3_text_3' ) ) : ?>
                                        <td><?php echo get_theme_mod( 'mrcorp_price_3_text_3', __( '300K API Access', 'mistercorporate' ) ); ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr class="active">
                                    <?php if( get_theme_mod( 'mrcorp_price_3_text_4' ) ) : ?>
                                        <td><?php echo get_theme_mod( 'mrcorp_price_3_text_4', __( '500MB Storage', 'mistercorporate' ) ); ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if( get_theme_mod( 'mrcorp_price_3_text_5' ) ) : ?>
                                        <td><?php echo get_theme_mod( 'mrcorp_price_3_text_5', __( 'Custom Cloud Services', 'mistercorporate' ) ); ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr class="active">
                                    <?php if( get_theme_mod( 'mrcorp_price_3_text_6' ) ) : ?>
                                        <td><?php echo get_theme_mod( 'mrcorp_price_3_text_6', __( 'Weekly Reports', 'mistercorporate' ) ); ?></td>
                                    <?php endif; ?>
                                </tr>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <a href="<?php echo esc_url( get_theme_mod( 'mrcorp_price_3_button_link' ) ); ?>" class="btn btn-default" role="button"><?php echo get_theme_mod( 'mrcorp_price_3_button_label', __( 'Sign Up', 'mistercorporate' ) ); ?></a>
                            <br /> 
                            <span><?php echo get_theme_mod( 'mrcorp_price_3_text_bottom', __( '1 month FREE trial', 'mistercorporate' ) ); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php if ( get_theme_mod( 'mrcorp_partner_show' ) ) : ?>
    <section id="partner">
        <div class="container cont-partner">
        <div class="col-md-2 col-sm-6 col-xs-12">
                <?php $image_attributes = wp_get_attachment_image_src( get_theme_mod( 'mrcorp_partner_1_img' ), array(140,79) );
if( $image_attributes ) : ?>
                <img src="<?php echo $image_attributes[0]; ?>" alt="img01" class="img-partner" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>" />
            <?php endif; ?>
            </div>
        <div class="col-md-2 col-sm-6 col-xs-12">
                <?php $image_attributes = wp_get_attachment_image_src( get_theme_mod( 'mrcorp_partner_2_img' ), array(140,79) );
if( $image_attributes ) : ?>
                <img src="<?php echo $image_attributes[0]; ?>" alt="img01" class="img-partner" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>" />
            <?php endif; ?>
            </div>
        <div class="col-md-2 col-sm-6 col-xs-12">
                <?php $image_attributes = wp_get_attachment_image_src( get_theme_mod( 'mrcorp_partner_3_img' ), array(140,79) );
if( $image_attributes ) : ?>
                <img src="<?php echo $image_attributes[0]; ?>" alt="img01" class="img-partner" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>" />
            <?php endif; ?>
            </div>
        <div class="col-md-2 col-sm-6 col-xs-12">
                <?php $image_attributes = wp_get_attachment_image_src( get_theme_mod( 'mrcorp_partner_4_img' ), array(140,79) );
if( $image_attributes ) : ?>
                <img src="<?php echo $image_attributes[0]; ?>" alt="img01" class="img-partner" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>" />
            <?php endif; ?>
            </div>
        <div class="col-md-2 col-sm-6 col-xs-12">
                <?php $image_attributes = wp_get_attachment_image_src( get_theme_mod( 'mrcorp_partner_5_img' ), array(140,79) );
if( $image_attributes ) : ?>
                <img src="<?php echo $image_attributes[0]; ?>" alt="img01" class="img-partner" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>" />
            <?php endif; ?>
            </div>
        <div class="col-md-2 col-sm-6 col-xs-12">
                <?php $image_attributes = wp_get_attachment_image_src( get_theme_mod( 'mrcorp_partner_6_img' ), array(140,79) );
if( $image_attributes ) : ?>
                <img src="<?php echo $image_attributes[0]; ?>" alt="img01" class="img-partner" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>" />
            <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php if ( get_theme_mod( 'mrcorp_map_show' ) ) : ?>
    <section>
        <div class="container-full">
            <div id="map"></div>
        </div>
    </section>
<?php endif; ?>
<?php get_footer(); ?>