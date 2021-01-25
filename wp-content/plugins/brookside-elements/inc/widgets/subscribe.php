<?php
class brookside_widget_subscribe extends WP_Widget { 
	
	// Widget Settings
	public function __construct() {
		$widget_ops = array('description' => esc_html__('Display subscribe form', 'brookside-elements') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'brooksidesubscribe' );
		parent::__construct( 'brooksidesubscribe', esc_html__('brookside-Subscribe', 'brookside-elements'), $widget_ops, $control_ops );
		add_action('admin_enqueue_scripts', array($this, 'admin_setup'));
	}
	public function admin_setup() {
		global $pagenow;

        if($pagenow !== 'widgets.php' && $pagenow !== 'customize.php') return;

		wp_enqueue_media();
        wp_enqueue_script(
			'about-me-widget',
			BROOKSIDE_PLUGIN_URL.'js/about-me-widget.js',
			array(),
			1.0
		);

	}
	// Widget Output
	function widget($args, $instance) {
		extract($args);
		$title = $text = $bg_image_style = '';
		if( isset($instance['title']) ){
			$title = apply_filters('widget_title', $instance['title']);
		}
		
		if( isset($instance['text']) ){
			$text = $instance['text'];
		}
		if( isset($instance['image']) && $instance['image']){
			$image_tmp = wp_get_attachment_image_src($instance['image_id'], 'medium');
			$image_url = $image_tmp[0];
			$bg_image_style = 'style="background-image:url('.esc_url($image_url).');"';
		}
		// ------
		$id = $this->id;
		echo ''.$before_widget;
		if ( $title !='' ) echo ''.$before_title . $title . $after_title;
		echo '<div class="form-title" '.$bg_image_style.'><h3>'.$text.'</h3></div>';
		echo '<div class="form-wrap">';
		do_action('brookside_email_subscription', $id);
		echo '</div>';
		echo ''.$after_widget;
		// ------
	}
	
	// Update
	function update( $new_instance, $old_instance ) {  
		$instance = $old_instance; 
		
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['text'] = sanitize_text_field($new_instance['text']);
		$instance['image'] = $new_instance['image'];
		$instance['image_id'] = $new_instance['image_id'];
		return $instance;
	}
	
	// Backend Form
	function form($instance) {
		
		$defaults = array('title' => '', 'image' => '', 'image_id' => '', 'text' => 'Join Us Today');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Widget Title:','brookside-elements'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php _e('Subscribe title:','brookside-elements'); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>"><?php echo esc_attr($instance['text']); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('image')); ?>"><?php _e('Background image:','brookside-elements'); ?></label>
			<input type="text" class="widefat widget-image-input" id="<?php echo esc_attr($this->get_field_id('image')); ?>_media_url" name="<?php echo esc_attr($this->get_field_name('image')); ?>" value="<?php echo esc_attr($instance['image']); ?>" />
			<input type="hidden" class="widefat widget-image-id" id="<?php echo esc_attr($this->get_field_id('image')); ?>_media_id" name="<?php echo esc_attr($this->get_field_name('image_id')); ?>" value="<?php echo esc_attr($instance['image_id']); ?>" />
			<br><br>
			<a href="#" class="upload_image_button button button-pbrooksidery" id="<?php echo esc_attr($this->get_field_id('image')); ?>"><?php _e('Upload image', 'brookside-elements'); ?></a>
		</p>
		
    <?php }
}

// Add Widget
function brookside_widget_subscribe_init() {
	register_widget('brookside_widget_subscribe');
}
add_action('widgets_init', 'brookside_widget_subscribe_init');

?>