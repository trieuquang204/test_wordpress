<header id="header" class="side-header <?php echo brookside_get_header_style(); ?>">
	<div class="logo">
		<?php if(get_theme_mod('brookside_media_logo', get_template_directory_uri().'/images/side-header-logo.png') != "") { ?>
			<a href="<?php echo esc_url(home_url('/')); ?>" class="logo_main"><img src="<?php echo esc_url(get_theme_mod('brookside_media_logo', get_template_directory_uri().'/images/side-header-logo.png')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" /></a>
		<?php } else { ?>
			<a href="<?php echo esc_url(home_url('/')); ?>" class="logo_text"><?php echo esc_attr(get_bloginfo('name')); ?></a>
		<?php } ?>
	</div>
	<?php
		if( has_nav_menu( 'side_navigation' ) ) { ?>
		<nav id="navigation" class="side-navigation">
			<ul id="nav" class="menu">
				<?php wp_nav_menu(array('theme_location' => 'side_navigation', 'container' => false, 'menu_id' => 'nav', 'items_wrap'=>'%3$s', 'fallback_cb' => false)); ?>
			</ul>
		</nav>
	<?php } ?>
	<div class="side-header-bottom">
		<div class="subscribe-button-block">
			<?php
				if( get_theme_mod('brookside_subscribe_enable', false) ){
					echo '<a href="#" class="button button-subscribe">'.esc_html__('Subscribe', 'brookside').'</a>';
				}
			?>
		</div>
	</div>
</header>