<footer id="footer">
	<?php if( get_theme_mod('brookside_footer_map', false) ){ ?>
	<div id="map-block">
		<div class="map-container">
			<div class="map-image">
				<img src="<?php echo get_template_directory_uri().'/images/map-image.png'; ?>" alt="map_image">
				<?php 
					$markers = get_theme_mod('brookside_footer_map_markers', '');
					if( $markers == '' ){
						$markers = "37%:70%\n16%:40%\n59%:29%";
					}
					if( $markers != ''){
						$markers = explode("\n", $markers);
						foreach ($markers as $marker) {
							$marker_data = explode('|', $marker);
							$description = $url = '';
							if( isset($marker_data[1]) && isset($marker_data[2])){
								list($position, $description, $url) = $marker_data;
							} elseif( isset($marker_data[1]) ){
								list($position, $description) = $marker_data;
							} else {
								list($position) = $marker_data;
							}
							list($x, $y) = explode(':', $position);
							$description = $description != '' ? $description : '';
							$url = $url != '' ? $url : '#';
							echo '<div class="map-marker" style="top:'.esc_attr($y).';left:'.esc_attr($x).';">';
							if( $description != '' ){
								echo '<a class="description" href="'.esc_url($url).'">'.esc_html($description).'</a>';
							}
							echo '<img src="'.esc_url(get_theme_mod('brookside_footer_map_marker_image', get_template_directory_uri().'/images/map-marker.png')).'" alt="map_image"></div>';
						}
					}
				?>
			</div>
		</div>
	</div>
	<?php } ?>
	<?php if( is_active_sidebar('footer-widgets') ){ ?>
		<div id="footer-widgets">
			<div class="container">
				<div class="span12">
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Widgets') ); ?>
				</div>
			</div>
		</div>
	<?php } ?>

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
<div class="clear"></div>
