
        </main>
        <footer class="footer-background" id="mr-footer-section">
            <div class="container">
                <?php if ( is_active_sidebar( 'mrcorp_footer_sidebar_1' ) ) : ?>
                    <div class="col-md-4">
                        <?php dynamic_sidebar( 'mrcorp_footer_sidebar_1' ); ?>
                    </div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'mrcorp_footer_sidebar_2' ) ) : ?>
                    <div class="col-md-4">
                        <?php dynamic_sidebar( 'mrcorp_footer_sidebar_2' ); ?>
                    </div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'mrcorp_footer_sidebar_3' ) ) : ?>
                    <div class="col-md-4">
                        <?php dynamic_sidebar( 'mrcorp_footer_sidebar_3' ); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="container cont-footer">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                        <ul class="list-inline text-center">
                            <li data-sr='wait 0.3s enter bottom move 20px'>
                                <?php if( get_theme_mod( 'mrcorp_footer_tw' ) ) : ?>
                                    <a href="<?php echo esc_url( get_theme_mod( 'mrcorp_footer_tw' ) ); ?>"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x fa-inverse"></i></span></a>
                                <?php endif; ?>
                            </li>
                            <li data-sr='wait 0.5s enter bottom move 20px'>
                                <?php if( get_theme_mod( 'mrcorp_footer_fb' ) ) : ?>
                                    <a href="<?php echo esc_url( get_theme_mod( 'mrcorp_footer_fb' ) ); ?>"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i></span></a>
                                <?php endif; ?>
                            </li>
                            <li data-sr='wait 0.7s enter bottom move 20px'>
                                <?php if( get_theme_mod( 'mrcorp_footer_g' ) ) : ?>
                                    <a href="<?php echo esc_url( get_theme_mod( 'mrcorp_footer_g' ) ); ?>"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-google-plus fa-stack-1x fa-inverse"></i></span></a>
                                <?php endif; ?>
                            </li>
                        </ul>
                        <p class="copyright">
                            <?php if( get_theme_mod( 'mrcorp_footer_copy' ) ){  ?>
                                <?php echo esc_attr(get_theme_mod( 'mrcorp_footer_copy')); ?>
                            <?php }else{ ?>
                                <?php printf(
                                    esc_html__( 'Copyright &copy; %1$s. Powered by %2$s WordPress Theme.', 'mistercorporate' ),
                                    date_i18n( 'Y' ),
                                    '<a href="https://profiles.wordpress.org/nsthemes">NsThemes</a>');
                                ?>
                            <?php } ?>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        <?php wp_footer(); ?>
    </body>
</html>
