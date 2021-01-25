<?php


class brookside_widget_bannerspot extends WP_Widget { 
	
	// Widget Settings
	public function __construct() {
		$widget_ops = array('description' => __('Display block with banner and Title over it.', 'brookside-elements') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'bannerspot' );
		parent::__construct( 'bannerspot', __('brookside-BannerSpot', 'brookside-elements'), $widget_ops, $control_ops );
		add_action('admin_enqueue_scripts', array($this, 'admin_setup'));
	}
	/**
	 * Enqueue all the javascript.
	 */
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
		$title = apply_filters('widget_title', $instance['title']);
		$link_url = (! empty( $instance['link_url'] )) ? $instance['link_url'] : '';
		// ------
		echo ''.$before_widget;
		if($title != '') {
			echo ''.$before_title . $title . $after_title;
		} ?>
			<div class="banner-spot">
				<?php if($link_url != ''){ ?>
					<a href="<?php echo esc_url($link_url); ?>" target="_blank">
				<?php } ?>
				<div class="content">
					<?php if($instance['image']){
						$image_tmp = wp_get_attachment_image_src($instance['image_id'], 'medium');
						$image_url = $image_tmp[0];
					?>
						<div class="bg-image">
							<img src="<?php echo esc_url($image_url); ?>" alt="banner spot image">
						</div>
				<?php } ?>
				</div>
				<?php if($link_url != ''){ ?>
					</a>
				<?php } ?>
			</div>

		<?php
		echo ''.$after_widget;
		// ------
	}
	
	// Update
	function update( $new_instance, $old_instance ) {  
		$instance = $old_instance; 
		
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['image'] = $new_instance['image'];
		$instance['image_id'] = $new_instance['image_id'];
		$instance['link_url'] = $new_instance['link_url'];
		return $instance;
	}
	
	// Backend Form
	function form($instance) {
		
		$defaults = array('title' => '', 'image' => '', 'link_url' => '', 'textcolor' => '#ffffff', 'image_id' => '');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:','brookside-elements'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('image')); ?>"><?php _e('Banner image:','brookside-elements'); ?></label>
			<input type="text" class="widefat widget-image-input" id="<?php echo esc_attr($this->get_field_id('image')); ?>_media_url" name="<?php echo esc_attr($this->get_field_name('image')); ?>" value="<?php echo esc_attr($instance['image']); ?>" />
			<input type="hidden" class="widefat widget-image-id" id="<?php echo esc_attr($this->get_field_id('image')); ?>_media_id" name="<?php echo esc_attr($this->get_field_name('image_id')); ?>" value="<?php echo esc_attr($instance['image_id']); ?>" />
			<br><br>
			<a href="#" class="upload_image_button button button-pbrooksidery" id="<?php echo esc_attr($this->get_field_id('image')); ?>"><?php _e('Upload image', 'brookside-elements'); ?></a>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('link_url')); ?>"><?php _e('URL:','brookside-elements'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('link_url')); ?>" name="<?php echo esc_attr($this->get_field_name('link_url')); ?>" value="<?php echo esc_attr($instance['link_url']); ?>" />
		</p>

		
    <?php }
}

// Add Widget
function brookside_widget_bannerspot_init() {
	register_widget('brookside_widget_bannerspot');
}
add_action('widgets_init', 'brookside_widget_bannerspot_init');

?>