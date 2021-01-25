		<footer id="footer" class="footer-blank">
			<?php if( get_theme_mod('brookside_footer_copyright', '') != '' || get_theme_mod('brookside_footer_socials', true) ) { ?>
				<div id="footer-bottom">
					<?php if( get_theme_mod('brookside_footer_copyright_border', false) ){ ?>
						<hr class="separator-border">
					<?php } ?>
					<div class="container">
						<div class="span4">
							<?php if( get_theme_mod('brookside_footer_copyright', '') != '' ) { ?>
								<div id="footer-copy-block">
									<div class="copyright-text"><?php echo get_theme_mod('brookside_footer_copyright', ''); ?></div>
								</div>
							<?php } ?>	
						</div>
						<div class="span4">
							<?php if( get_theme_mod('brookside_footer_logo', false) ){ ?>
								<h2 class="footer-logo">
									<?php if(get_theme_mod('brookside_footer_logo_img','') != "") { ?>
										<a href="<?php echo esc_url(home_url('/')); ?>" class="logo_main"><img src="<?php echo esc_url(get_theme_mod('brookside_footer_logo_img')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" /></a>
									<?php } else { ?>
										<a href="<?php echo esc_url(home_url('/')); ?>" class="logo_text"><?php echo esc_attr(get_bloginfo('name')); ?></a>
									<?php } ?>
								</h2>
							<?php } ?>
						</div>	
						<div class="span4">
							<?php if( get_theme_mod('brookside_footer_socials', true) && function_exists('brookside_get_social_links') && brookside_get_social_links(false) != '' ) { 
								brookside_get_social_links(true);
							} ?>
						</div>
					</div>
				</div>
			<?php } ?>
			</footer>
		</div> <!-- end boxed -->
	
	<?php wp_footer(); ?>
	</body>
</html>
