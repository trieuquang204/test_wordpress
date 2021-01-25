<footer id="footer" class="footer-blank">
<?php if( get_theme_mod('brookside_footer_copyright', '') != '' || get_theme_mod('brookside_footer_socials', true) ) { ?>
	<div id="footer-bottom">
		<?php if( get_theme_mod('brookside_footer_copyright_border', false) ){ ?>
			<hr class="separator-border">
		<?php } ?>
		<div class="container">
			<div class="span4">
				<?php if( get_theme_mod('brookside_footer_copyright', '2019 © All rights reserved') != '' ) { ?>
					<div id="footer-copy-block">
						<div class="copyright-text"><?php echo get_theme_mod('brookside_footer_copyright', '2019 © All rights reserved'); ?></div>
					</div>
				<?php } ?>	
			</div>
			
			<?php if( get_theme_mod('brookside_footer_logo', false) ){ ?>
				<div class="span4">
					<h2 class="footer-logo">
						<?php if(get_theme_mod('brookside_footer_logo_img','') != "") { ?>
							<a href="<?php echo esc_url(home_url('/')); ?>" class="logo_main"><img src="<?php echo esc_url(get_theme_mod('brookside_footer_logo_img')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" /></a>
						<?php } else { ?>
							<a href="<?php echo esc_url(home_url('/')); ?>" class="logo_text"><?php echo esc_attr(get_bloginfo('name')); ?></a>
						<?php } ?>
					</h2>
				</div>
			<?php } ?>	
			<div class="span4">
				<?php if( get_theme_mod('brookside_footer_socials', true) && function_exists('brookside_get_social_links') && brookside_get_social_links(false) != '' ) { 
					brookside_get_social_links(true);
				} ?>
			</div>
			<?php if( has_nav_menu( 'footer_navigation' ) ) {
				echo '<div class="span4 footer-menu">';
					wp_nav_menu(['theme_location' => 'footer_navigation', 'container' => false, 'depth' => 1, 'fallback_cb' => '']);
				echo '</div>';
			} ?>
		</div>
	</div>
<?php } ?>
</footer>
