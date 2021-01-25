<?php


class brookside_widget_category extends WP_Widget { 
	
	// Widget Settings
	public function __construct() {
		$widget_ops = array('description' => __('Display image with link', 'brookside-elements') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'link_page' );
		parent::__construct( 'link_page', __('brookside-Page link', 'brookside-elements'), $widget_ops, $control_ops );
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
		$page_link = $instance['link_url'];
		// ------
		echo ''.$before_widget;
		?>
			<div class="page_link_block">
				<?php if($instance['image']): ?>
				<div class="page-img">
					<?php if( $instance['image_id'] ){
						$image_tmp = wp_get_attachment_image_src($instance['image_id'], 'medium');
						$image_url = $image_tmp[0];
						if($image_url){
							echo '<img src="'.esc_url($image_url).'" alt="page-image">';
						}
					}?>
					<div class="overlay"></div>
					<?php echo '<a href="'.esc_url($page_link).'" class="link_page_title"><span class="arrow"></span>'.esc_html($title).'</a>'; ?> 
				</div>
				<?php endif; ?>
				
			</div>

		<?php
		echo ''.$after_widget;
		// ------
	}
	
	// Update
	function update( $new_instance, $old_instance ) {  
		$instance = $old_instance; 
		
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['link_url'] = sanitize_text_field($new_instance['link_url']);
		$instance['image'] = $new_instance['image'];
		$instance['image_id'] = $new_instance['image_id'];
		return $instance;
	}
	
	// Backend Form
	function form($instance) {
		
		$defaults = array('title' => '', 'image' => '', 'image_id' => '', 'page_title' => '', 'link_url' => '');
		$instance = wp_parse_args((array) $instance, $defaults); 
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:','brookside-elements'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('image')); ?>"><?php _e('Background Image:','brookside-elements'); ?></label>
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
function brookside_widget_category_init() {
	register_widget('brookside_widget_category');
}
add_action('widgets_init', 'brookside_widget_category_init');

?>