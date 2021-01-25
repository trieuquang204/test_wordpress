<?php if( has_nav_menu( 'hidden_navigation' ) ){?>	
	<div id="hidden-area-widgets">
		<a href="#" class="close-button"><i class="la la-close"></i></a>
		<div class="widgets-side-bg">
			<div class="logo">
				<?php if(get_theme_mod('brookside_media_logo','') != "") { ?>
					<a href="<?php echo esc_url(home_url('/')); ?>" class="logo_main"><img src="<?php echo esc_url(get_theme_mod('brookside_media_logo')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" /></a>
				<?php } else { ?>
					<a href="<?php echo esc_url(home_url('/')); ?>" class="logo_text"><?php echo esc_attr(get_bloginfo('name')); ?></a>
				<?php } ?>
			</div>
		</div>
		<div class="widgets-side">
			
			<nav id="navigation">
				<ul id="nav" class="menu">
					<?php wp_nav_menu(array('theme_location' => 'hidden_navigation', 'container' => false, 'depth'=>1, 'menu_id' => 'nav', 'items_wrap'=>'%3$s', 'fallback_cb' => false)); ?>
				</ul>
			</nav>
		</div>
	</div>
<?php } ?>