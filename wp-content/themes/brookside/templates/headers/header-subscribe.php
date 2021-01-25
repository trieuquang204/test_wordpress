<div id="subscribe-popup" class="subscribe-popup">
	<div class="subscribe-popup-inner">
		<a href="#" class="close-button"><i class="la la-close"></i></a>
		<div class="flex-grid flex-grid-2">
			<div class="flex-column">
				<div class="subscribe-bg"></div>
			</div>
			<div class="flex-column">
				<div class="form-wrap">
					<h3><?php echo get_theme_mod('brookside_subscribe_popup_title', 'Subscribe') ?></h3>
					<h5 class="subtitle"><?php echo get_theme_mod('brookside_subscribe_popup_subtitle', 'Get updates on my travels') ?></h5>
					<?php do_action('brookside_email_subscription', 'subscribe-header'); ?>
				</div>
			</div>
		</div>
	</div>
</div>