
<div id="header-main" class="<?php if( get_theme_mod('brookside_fixed_header', true) ) echo 'fixed_header'; ?>">
<header id="header" class="header1 <?php echo brookside_get_header_style(); ?> clearfix">
	<?php if( get_theme_mod('brookside_header_search_button', false) ) { get_template_part('templates/headers/header', 'search'); } ?>
	<div class="header-top">
		<div class="header-top-inner">
			<div class="subscribe-button-block">
				<?php
					if( get_theme_mod('brookside_subscribe_enable', false) ){
						echo '<a href="#" class="button button-subscribe">'.esc_html__('Subscribe', 'brookside').'</a>';
					}
				?>
			</div>
			<div class="logo">
				<?php if(get_theme_mod('brookside_media_logo','') != "") { ?>
					<a href="<?php echo esc_url(home_url('/')); ?>" class="logo_main"><img src="<?php echo esc_url(get_theme_mod('brookside_media_logo')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" /></a>
				<?php } else { ?>
					<a href="<?php echo esc_url(home_url('/')); ?>" class="logo_text"><?php echo esc_attr(get_bloginfo('name')); ?></a>
				<?php } ?>
			</div>
			<div class="search-and-open">
				<div class="socials">
					<?php if( get_theme_mod('brookside_header_socials', true) && function_exists('brookside_get_social_links') ) { brookside_get_social_links(); } ?>
				</div>
				<?php if( get_theme_mod('brookside_header_search_button', false) ) { ?>
					<div class="search-link">
						<a href="javascript:void(0);" class="search-button"><i class="la la-search"></i></a>
					</div>
				<?php } ?>
				<?php if( has_nav_menu( 'hidden_navigation' ) ) { ?>
					<div class="hidden-area-button">
						<a href="#" class="open-hidden-area">
							<span class="line-1"></span>
							<span class="line-2"></span>
							<span class="line-3"></span>
						</a>
					</div>
				<?php } ?>
				<?php if( get_theme_mod('brookside_header_shopping_cart', false) && class_exists('WooCommerce') ) { 
							$count = WC()->cart->cart_contents_count;
						?>
						<div class="cart-main menu-item cart-contents">
							<a class="my-cart-link" href="<?php echo wc_get_cart_url(); ?>"><i class="la la-shopping-cart"></i>
								<?php if ( $count > 0 ) {
							        ?>
							        <span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
							        <?php
							    } ?>
							</a>
						</div>
				<?php } ?>
			</div>
		</div>
	</div>
</header>
</div>