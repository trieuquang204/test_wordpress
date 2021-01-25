<?php
function brookside_subscribe_block() {
	// Scripts.
	wp_register_script(
		'brookside-subscribe-block-script', // Handle.
		BROOKSIDE_PLUGIN_URL.'inc/gutenberg/blocks/subscribe/block.js', // Block.js: We register the block here.
		array( 'wp-blocks', 'wp-editor', 'wp-element', 'wp-i18n' ) // Dependencies, defined above.
	);

	register_block_type( 'brookside/subscribe', array(
		'editor_script' => 'brookside-subscribe-block-script',
		'attributes'      => array(
			'title' => array(
				'type' => 'string',
				'default' => 'Subscribe'
			)
		),
		'render_callback' => 'BrooksideSubscribeBlock',
	) );

}
add_action( 'init', 'brookside_subscribe_block' );
function BrooksideSubscribeBlock($attributes){
	$id = rand(0, 9999);
	$out = '';
	$title = isset($attributes['title']) ? $attributes['title'] : esc_html__('Subscribe', 'brookside-elements');
	$text = isset($attributes['text']) ? $attributes['text'] : '';
	if('POST' == $_SERVER['REQUEST_METHOD'] && isset($_POST['brookside_submit_subscription'])) {
		if( filter_var($_POST['subscriber_email'], FILTER_VALIDATE_EMAIL) ){
			
			$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
			 
			$subject = sprintf(esc_html__('New Subscription on %s','brookside-elements'), $blogname);
			 
			$to = get_option('admin_email'); 
			 
			$headers = 'From: '. sprintf(esc_html__('%s Admin', 'brookside-elements'), $blogname) .' <no-repy@'.$_SERVER['SERVER_NAME'] .'>' . PHP_EOL;
			 
			$message  = sprintf(esc_html__('Hi ,', 'brookside-elements')) . PHP_EOL . PHP_EOL;
			$message .= sprintf(esc_html__('You have a new subscription on your %s website.', 'brookside-elements'), $blogname) . PHP_EOL . PHP_EOL;
			$message .= esc_html__('Email Details', 'brookside-elements') . PHP_EOL;
			$message .= esc_html__('-----------------') . PHP_EOL;
			$message .= esc_html__('User E-mail: ', 'brookside-elements') . stripslashes($_POST['subscriber_email']) . PHP_EOL;
			$message .= esc_html__('Regards,', 'brookside-elements') . PHP_EOL . PHP_EOL;
			$message .= sprintf(esc_html__('Your %s Team', 'brookside-elements'), $blogname) . PHP_EOL;
			$message .= trailingslashit(get_option('home')) . PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL;
		
			if (wp_mail($to, $subject, $message, $headers)){
				$out .= '<p class="subscribe-notice success">'.esc_html__('Your e-mail', 'brookside-elements').' (' . $_POST['subscriber_email'] . ') '.esc_html__('has been added to our mailing list!', 'brookside-elements').'</p>';
				brookside_save_subscriber_to_list($_POST['subscriber_email']);				
			} else {
				$out .= '<p class="subscribe-notice error">'.esc_html__('There was a problem with your e-mail', 'brookside-elements').' (' . $_POST['subscriber_email'] . ') </p>';
			}
		} else {
		   $out .= '<p class="subscribe-notice error">'.esc_html__('There was a problem with your e-mail', 'brookside-elements').' (' . $_POST['subscriber_email'] . ') </p>';
		}
	}

	$out .= '<div class="subscribe-block">';
		$out .= '<div class="subscribe-col1"><div class="inner-padding">';
			if( $title != ''){
				$out .= '<h3 class="subscribe-block-title">'.$title.'</h3>';
			}
			if( $text != ''){
				$out .= '<div class="subscribe-block-text">'.$text.'</div>';
			}
		$out .= '</div></div>';
		$out .= '<div class="subscribe-col2">';
			$out .= '<div class="newsletter-form">';
				$out .= '<form id="newsletter-block-'.esc_attr($id).'" method="POST">';			
				
					$out .= '<div class="newsletter-email">';
						$out .= '<input type="email" name="subscriber_email" placeholder="'.esc_attr__('Email Address', 'brookside-elements').'">';
					$out .= '</div>';
					$out .= '<div class="newsletter-submit">';
						$out .= '<input type="hidden" name="brookside_submit_subscription" value="Submit"><button type="submit" class="button-subscribe" name="submit_form"><i class="la la-paper-plane"></i></button>';					
					$out .= '</div>';
				$out .= '</form>';
			$out .= '</div>';
		$out .= '</div>';
	$out .= '</div>';

	return $out;	
}