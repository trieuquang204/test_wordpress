<?php


class brookside_widget_socials extends WP_Widget { 
	
	// Widget Settings
	public function __construct() {
		$widget_ops = array('description' => __('Display your Socials icons', 'brookside-elements') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'socials' );
		parent::__construct( 'socials', __('brookside-Socials', 'brookside-elements'), $widget_ops, $control_ops );
	}
	
	// Widget Output
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$format = $instance['socials_style'];
		// ------
		echo ''.$before_widget;
		if ( $title != '' ) echo ''.$before_title . $title . $after_title;
		?>
		<div class="social-icons">
			<ul class="unstyled">
			<?php 
			$output='';
			if($format == 'text'){
				if($instance['facebook'] != "") { 
					$output .= '<li class="social-facebook"><a href="'.esc_url($instance['facebook']).'" target="_blank" title="'.__( 'Facebook', 'brookside-elements').'">'.__( 'Facebook', 'brookside-elements').'</a></li>';
				}
				if($instance['twitter'] != "") { 
					$output .= '<li class="social-twitter"><a href="'.esc_url($instance['twitter']).'" target="_blank" title="'.__( 'Twitter', 'brookside-elements').'">'.__( 'Twitter', 'brookside-elements').'</a></li>';
				} 	 
				if($instance['instagram'] != '') { 
					$output .= '<li class="social-instagram"><a href="'.esc_url($instance['instagram']).'" target="_blank" title="'.__( 'Instagram', 'brookside-elements').'">'.__( 'Instagram', 'brookside-elements').'</a></li>';
				}
				if($instance['bloglovin'] != "") { 
					$output .= '<li class="social-bloglovin"><a href="'.esc_url($instance['bloglovin']).'" target="_blank" title="'.__( 'Bloglovin', 'brookside-elements').'">'.__( 'Bloglovin', 'brookside-elements').'</a></li>';
				}
				if($instance['pinterest'] != "") { 
					$output .= '<li class="social-pinterest"><a href="'.esc_url($instance['pinterest']).'" target="_blank" title="'.__( 'Pinterest', 'brookside-elements').'">'.__( 'Pinterest', 'brookside-elements').'</a></li>';
				}
				if($instance['googleplus'] != "") { 
					$output .= '<li class="social-googleplus"><a href="'.esc_url($instance['googleplus']).'" target="_blank" title="'.__( 'Google plus', 'brookside-elements').'">'.__( 'Google plus', 'brookside-elements').'</a></li>';
				}
				if($instance['forrst'] != "") { 
					$output .= '<li class="social-forrst"><a href="'.esc_url($instance['forrst']).'" target="_blank" title="'.__( 'Forrst', 'brookside-elements').'">'.__( 'Forrst', 'brookside-elements').'</a></li>';
				}
				if($instance['dribbble'] != "") { 
					$output .= '<li class="social-dribbble"><a href="'.esc_url($instance['dribbble']).'" target="_blank" title="'.__( 'Dribbble', 'brookside-elements').'">'.__( 'Dribbble', 'brookside-elements').'</a></li>';
				}
				if($instance['flickr'] != "") { 
					$output .= '<li class="social-flickr"><a href="'.esc_url($instance['flickr']).'" target="_blank" title="'.__( 'Flickr', 'brookside-elements').'">'.__( 'Flickr', 'brookside-elements').'</a></li>';
				}
				if($instance['linkedin'] != "") { 
					$output .= '<li class="social-linkedin"><a href="'.esc_url($instance['linkedin']).'" target="_blank" title="'.__( 'LinkedIn', 'brookside-elements').'">'.__( 'LinkedIn', 'brookside-elements').'</a></li>';
				}
				if($instance['skype'] != "") { 
					$output .= '<li class="social-skype"><a href="skype:'.esc_attr($instance['skype']).'" title="'.__( 'Skype', 'brookside-elements').'">'.__( 'Skype', 'brookside-elements').'</a></li>';
				}
				if($instance['digg'] != "") { 
					$output .= '<li class="social-digg"><a href="'.esc_url($instance['digg']).'" target="_blank" title="'.__( 'Digg', 'brookside-elements').'">'.__( 'Digg', 'brookside-elements').'</a></li>';
				}
				if($instance['vimeo'] != "") { 
					$output .= '<li class="social-vimeo"><a href="'.esc_url($instance['vimeo']).'" target="_blank" title="'.__( 'Vimeo', 'brookside-elements').'">'.__( 'Vimeo', 'brookside-elements').'</a></li>';
				}
				if($instance['yahoo'] != "") { 
					$output .= '<li class="social-yahoo"><a href="'.esc_url($instance['yahoo']).'" target="_blank" title="'.__( 'Yahoo', 'brookside-elements').'">'.__( 'Yahoo', 'brookside-elements').'</a></li>';
				}
				if($instance['tumblr'] != "") { 
					$output .= '<li class="social-tumblr"><a href="'.esc_url($instance['tumblr']).'" target="_blank" title="'.__( 'Tumblr', 'brookside-elements').'">'.__( 'Tumblr', 'brookside-elements').'</a></li>';
				}
				if($instance['youtube'] != "") { 
					$output .= '<li class="social-youtube"><a href="'.esc_url($instance['youtube']).'" target="_blank" title="'.__( 'YouTube', 'brookside-elements').'">'.__( 'YouTube', 'brookside-elements').'</a></li>';
				}
				if($instance['deviantart'] != "") { 
					$output .= '<li class="social-deviantart"><a href="'.esc_url($instance['deviantart']).'" target="_blank" title="'.__( 'DeviantArt', 'brookside-elements').'">'.__( 'DeviantArt', 'brookside-elements').'</a></li>';
				}
				if($instance['behance'] != "") { 
					$output .= '<li class="social-behance"><a href="'.esc_url($instance['behance']).'" target="_blank" title="'.__( 'Behance', 'brookside-elements').'">'.__( 'Behance', 'brookside-elements').'</a></li>';
				}
				if($instance['delicious'] != "") { 
					$output .= '<li class="social-delicious"><a href="'.esc_url($instance['delicious']).'" target="_blank" title="'.__( 'Delicious', 'brookside-elements').'">'.__( 'Delicious', 'brookside-elements').'</a></li>';
				}
			} elseif ($format == 'icon+text') {
				if($instance['facebook'] != "") { 
					$output .= '<li class="social-facebook"><a href="'.esc_url($instance['facebook']).'" target="_blank" title="'.__( 'Facebook', 'brookside-elements').'"><i class="fa fa-facebook"></i><span>'.__( 'Facebook', 'brookside-elements').'</span></a></li>';
				}
				if($instance['twitter'] != "") { 
					$output .= '<li class="social-twitter"><a href="'.esc_url($instance['twitter']).'" target="_blank" title="'.__( 'Twitter', 'brookside-elements').'"><i class="fa fa-twitter"></i><span>'.__( 'Twitter', 'brookside-elements').'</span></a></li>';
				} 	 
				if($instance['instagram'] != '') { 
					$output .= '<li class="social-instagram"><a href="'.esc_url($instance['instagram']).'" target="_blank" title="'.__( 'Instagram', 'brookside-elements').'"><i class="fa fa-instagram"></i><span>'.__( 'Instagram', 'brookside-elements').'</span></a></li>';
				}
				if($instance['bloglovin'] != "") { 
					$output .= '<li class="social-bloglovin"><a href="'.esc_url($instance['bloglovin']).'" target="_blank" title="'.__( 'Bloglovin', 'brookside-elements').'"><i class="fa fa-plus"></i><span>'.__( 'Bloglovin', 'brookside-elements').'</span></a></li>';
				}
				if($instance['pinterest'] != "") { 
					$output .= '<li class="social-pinterest"><a href="'.esc_url($instance['pinterest']).'" target="_blank" title="'.__( 'Pinterest', 'brookside-elements').'"><i class="fa fa-pinterest-p"></i><span>'.__( 'Pinterest', 'brookside-elements').'</span></a></li>';
				}
				if($instance['googleplus'] != "") { 
					$output .= '<li class="social-googleplus"><a href="'.esc_url($instance['googleplus']).'" target="_blank" title="'.__( 'Google plus', 'brookside-elements').'"><i class="fa fa-google-plus"></i><span>'.__( 'Google plus', 'brookside-elements').'</span></a></li>';
				}
				if($instance['forrst'] != "") { 
					$output .= '<li class="social-forrst"><a href="'.esc_url($instance['forrst']).'" target="_blank" title="'.__( 'Forrst', 'brookside-elements').'"><i class="fa icon-forrst"></i><span>'.__( 'Forrst', 'brookside-elements').'</span></a></li>';
				}
				if($instance['dribbble'] != "") { 
					$output .= '<li class="social-dribbble"><a href="'.esc_url($instance['dribbble']).'" target="_blank" title="'.__( 'Dribbble', 'brookside-elements').'"><i class="fa fa-dribbble"></i><span>'.__( 'Dribbble', 'brookside-elements').'</span></a></li>';
				}
				if($instance['flickr'] != "") { 
					$output .= '<li class="social-flickr"><a href="'.esc_url($instance['flickr']).'" target="_blank" title="'.__( 'Flickr', 'brookside-elements').'"><i class="fa fa-flickr"></i><span>'.__( 'Flickr', 'brookside-elements').'</span></a></li>';
				}
				if($instance['linkedin'] != "") { 
					$output .= '<li class="social-linkedin"><a href="'.esc_url($instance['linkedin']).'" target="_blank" title="'.__( 'LinkedIn', 'brookside-elements').'"><i class="fa fa-linkedin"></i><span>'.__( 'LinkedIn', 'brookside-elements').'</span></a></li>';
				}
				if($instance['skype'] != "") { 
					$output .= '<li class="social-skype"><a href="skype:'.esc_attr($instance['skype']).'" title="'.__( 'Skype', 'brookside-elements').'"><i class="fa fa-skype"></i><span>'.__( 'Skype', 'brookside-elements').'</span></a></li>';
				}
				if($instance['digg'] != "") { 
					$output .= '<li class="social-digg"><a href="'.esc_url($instance['digg']).'" target="_blank" title="'.__( 'Digg', 'brookside-elements').'"><i class="fa fa-digg"></i><span>'.__( 'Digg', 'brookside-elements').'</span></a></li>';
				}
				if($instance['vimeo'] != "") { 
					$output .= '<li class="social-vimeo"><a href="'.esc_url($instance['vimeo']).'" target="_blank" title="'.__( 'Vimeo', 'brookside-elements').'"><i class="fa fa-vimeo"></i><span>'.__( 'Vimeo', 'brookside-elements').'</span></a></li>';
				}
				if($instance['yahoo'] != "") { 
					$output .= '<li class="social-yahoo"><a href="'.esc_url($instance['yahoo']).'" target="_blank" title="'.__( 'Yahoo', 'brookside-elements').'"><i class="fa fa-yahoo"></i><span>'.__( 'Yahoo', 'brookside-elements').'</span></a></li>';
				}
				if($instance['tumblr'] != "") { 
					$output .= '<li class="social-tumblr"><a href="'.esc_url($instance['tumblr']).'" target="_blank" title="'.__( 'Tumblr', 'brookside-elements').'"><i class="fa fa-tumblr"></i><span>'.__( 'Tumblr', 'brookside-elements').'</span></a></li>';
				}
				if($instance['youtube'] != "") { 
					$output .= '<li class="social-youtube"><a href="'.esc_url($instance['youtube']).'" target="_blank" title="'.__( 'YouTube', 'brookside-elements').'"><i class="fa fa-youtube-play"></i><span>'.__( 'YouTube', 'brookside-elements').'</span></a></li>';
				}
				if($instance['deviantart'] != "") { 
					$output .= '<li class="social-deviantart"><a href="'.esc_url($instance['deviantart']).'" target="_blank" title="'.__( 'DeviantArt', 'brookside-elements').'"><i class="fa fa-deviantart"></i><span>'.__( 'DeviantArt', 'brookside-elements').'</span></a></li>';
				}
				if($instance['behance'] != "") { 
					$output .= '<li class="social-behance"><a href="'.esc_url($instance['behance']).'" target="_blank" title="'.__( 'Behance', 'brookside-elements').'"><i class="fa fa-behance"></i><span>'.__( 'Behance', 'brookside-elements').'</span></a></li>';
				}
				if($instance['delicious'] != "") { 
					$output .= '<li class="social-delicious"><a href="'.esc_url($instance['delicious']).'" target="_blank" title="'.__( 'Delicious', 'brookside-elements').'"><i class="fa fa-delicious"></i><span>'.__( 'Delicious', 'brookside-elements').'</span></a></li>';
				}
			} else {
				if($instance['facebook'] != "") { 
					$output .= '<li class="social-facebook"><a href="'.esc_url($instance['facebook']).'" target="_blank" title="'.__( 'Facebook', 'brookside-elements').'"><i class="fa fa-facebook"></i></a></li>';
				}
				if($instance['twitter'] != "") { 
					$output .= '<li class="social-twitter"><a href="'.esc_url($instance['twitter']).'" target="_blank" title="'.__( 'Twitter', 'brookside-elements').'"><i class="fa fa-twitter"></i></a></li>';
				} 	 
				if($instance['instagram'] != '') { 
					$output .= '<li class="social-instagram"><a href="'.esc_url($instance['instagram']).'" target="_blank" title="'.__( 'Instagram', 'brookside-elements').'"><i class="fa fa-instagram"></i></a></li>';
				}
				if($instance['bloglovin'] != "") { 
					$output .= '<li class="social-bloglovin"><a href="'.esc_url($instance['bloglovin']).'" target="_blank" title="'.__( 'Bloglovin', 'brookside-elements').'"><i class="fa fa-plus"></i></a></li>';
				}
				if($instance['pinterest'] != "") { 
					$output .= '<li class="social-pinterest"><a href="'.esc_url($instance['pinterest']).'" target="_blank" title="'.__( 'Pinterest', 'brookside-elements').'"><i class="fa fa-pinterest-p"></i></a></li>';
				}
				if($instance['googleplus'] != "") { 
					$output .= '<li class="social-googleplus"><a href="'.esc_url($instance['googleplus']).'" target="_blank" title="'.__( 'Google plus', 'brookside-elements').'"><i class="fa fa-google-plus"></i></a></li>';
				}
				if($instance['forrst'] != "") { 
					$output .= '<li class="social-forrst"><a href="'.esc_url($instance['forrst']).'" target="_blank" title="'.__( 'Forrst', 'brookside-elements').'"><i class="fa icon-forrst"></i></a></li>';
				}
				if($instance['dribbble'] != "") { 
					$output .= '<li class="social-dribbble"><a href="'.esc_url($instance['dribbble']).'" target="_blank" title="'.__( 'Dribbble', 'brookside-elements').'"><i class="fa fa-dribbble"></i></a></li>';
				}
				if($instance['flickr'] != "") { 
					$output .= '<li class="social-flickr"><a href="'.esc_url($instance['flickr']).'" target="_blank" title="'.__( 'Flickr', 'brookside-elements').'"><i class="fa fa-flickr"></i></a></li>';
				}
				if($instance['linkedin'] != "") { 
					$output .= '<li class="social-linkedin"><a href="'.esc_url($instance['linkedin']).'" target="_blank" title="'.__( 'LinkedIn', 'brookside-elements').'"><i class="fa fa-linkedin"></i></a></li>';
				}
				if($instance['skype'] != "") { 
					$output .= '<li class="social-skype"><a href="skype:'.esc_attr($instance['skype']).'" title="'.__( 'Skype', 'brookside-elements').'"><i class="fa fa-skype"></i></a></li>';
				}
				if($instance['digg'] != "") { 
					$output .= '<li class="social-digg"><a href="'.esc_url($instance['digg']).'" target="_blank" title="'.__( 'Digg', 'brookside-elements').'"><i class="fa fa-digg"></i></a></li>';
				}
				if($instance['vimeo'] != "") { 
					$output .= '<li class="social-vimeo"><a href="'.esc_url($instance['vimeo']).'" target="_blank" title="'.__( 'Vimeo', 'brookside-elements').'"><i class="fa fa-vimeo"></i></a></li>';
				}
				if($instance['yahoo'] != "") { 
					$output .= '<li class="social-yahoo"><a href="'.esc_url($instance['yahoo']).'" target="_blank" title="'.__( 'Yahoo', 'brookside-elements').'"><i class="fa fa-yahoo"></i></a></li>';
				}
				if($instance['tumblr'] != "") { 
					$output .= '<li class="social-tumblr"><a href="'.esc_url($instance['tumblr']).'" target="_blank" title="'.__( 'Tumblr', 'brookside-elements').'"><i class="fa fa-tumblr"></i></a></li>';
				}
				if($instance['youtube'] != "") { 
					$output .= '<li class="social-youtube"><a href="'.esc_url($instance['youtube']).'" target="_blank" title="'.__( 'YouTube', 'brookside-elements').'"><i class="fa fa-youtube-play"></i></a></li>';
				}
				if($instance['deviantart'] != "") { 
					$output .= '<li class="social-deviantart"><a href="'.esc_url($instance['deviantart']).'" target="_blank" title="'.__( 'DeviantArt', 'brookside-elements').'"><i class="fa fa-deviantart"></i></a></li>';
				}
				if($instance['behance'] != "") { 
					$output .= '<li class="social-behance"><a href="'.esc_url($instance['behance']).'" target="_blank" title="'.__( 'Behance', 'brookside-elements').'"><i class="fa fa-behance"></i></a></li>';
				}
				if($instance['delicious'] != "") { 
					$output .= '<li class="social-delicious"><a href="'.esc_url($instance['delicious']).'" target="_blank" title="'.__( 'Delicious', 'brookside-elements').'"><i class="fa fa-delicious"></i></a></li>';
				}
			}
			echo ''.$output;
			?>
			</ul>
		</div>
		<?php
		echo ''.$after_widget;
		// ------
	}
	
	// Update
	function update( $new_instance, $old_instance ) {  
		$instance = $old_instance; 
		
		$instance['title'] = $new_instance['title'];
		$instance['socials_style'] = $new_instance['socials_style'];
		$instance['facebook'] = $new_instance['facebook'];
		$instance['twitter'] = $new_instance['twitter'];
		$instance['bloglovin'] = $new_instance['bloglovin'];
		$instance['pinterest'] = $new_instance['pinterest'];
		$instance['instagram'] = $new_instance['instagram'];
		$instance['googleplus'] = $new_instance['googleplus'];
		$instance['forrst'] = $new_instance['forrst'];
		$instance['dribbble'] = $new_instance['dribbble'];
		$instance['flickr'] = $new_instance['flickr'];
		$instance['linkedin'] = $new_instance['linkedin'];
		$instance['skype'] = $new_instance['skype'];
		$instance['digg'] = $new_instance['digg'];
		$instance['vimeo'] = $new_instance['vimeo'];
		$instance['yahoo'] = $new_instance['yahoo'];
		$instance['tumblr'] = $new_instance['tumblr'];
		$instance['youtube'] = $new_instance['youtube'];
		$instance['deviantart'] = $new_instance['deviantart'];
		$instance['behance'] = $new_instance['behance'];
		$instance['vk'] = $new_instance['vk'];
		$instance['delicious'] = $new_instance['delicious'];

		return $instance;
	}
	
	// Backend Form
	function form($instance) {
		
		$defaults = array(
			'title' => '',
			'socials_style' => 'icons', 
			'facebook'=> '#', 
			'twitter'=>'#',
			'bloglovin'=>'', 
			'pinterest'=>'#', 
			'instagram'=>'#', 
			'googleplus'=>'', 
			'forrst'=>'', 
			'dribbble'=>'', 
			'flickr'=>'', 
			'linkedin'=>'', 
			'skype'=>'', 
			'digg'=>'', 
			'vimeo'=>'', 
			'yahoo'=>'', 
			'tumblr'=>'#', 
			'youtube'=>'', 
			'deviantart'=>'',
			'behance'=>'',
			'vk'=>'',
			'delicious'=>''
		);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:','brookside-elements'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		<p>
		<?php 
			$selected1 = $selected2 = $selected3 = '';

			if(isset($instance['socials_style'])){
				switch ($instance['socials_style']) {
					case '1':
						$selected1 = 'selected="selected"';
						break;
					case '2':
						$selected2 = 'selected="selected"';
						break;
					case '3':
						$selected3 = 'selected="selected"';
						break;
				}
			} ?>
			<label for="<?php echo esc_attr($this->get_field_id( 'socials_style' )); ?>">Display items as:</label>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'socials_style' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'socials_style' )); ?>">
				<option value="text" <?php echo esc_attr($selected1); ?>>Text</option>
				<option value="icon+text" <?php echo esc_attr($selected2); ?>>Icon+Text</option>
				<option value="icons" <?php echo esc_attr($selected2); ?>>Icons</option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('facebook')); ?>"><?php _e('Facebook url:','brookside-elements'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('facebook')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook')); ?>" value="<?php echo esc_attr($instance['facebook']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('twitter')); ?>"><?php _e('Twitter url:','brookside-elements'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter')); ?>" value="<?php echo esc_attr($instance['twitter']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('bloglovin')); ?>"><?php _e('Bloglovin profile url:','brookside-elements'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('bloglovin')); ?>" name="<?php echo esc_attr($this->get_field_name('bloglovin')); ?>" value="<?php echo esc_attr($instance['bloglovin']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('pinterest')); ?>"><?php _e('Pinterest url:','brookside-elements'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('pinterest')); ?>" name="<?php echo esc_attr($this->get_field_name('pinterest')); ?>" value="<?php echo esc_attr($instance['pinterest']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('instagram')); ?>"><?php _e('Instagram url:','brookside-elements'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('instagram')); ?>" name="<?php echo esc_attr($this->get_field_name('instagram')); ?>" value="<?php echo esc_attr($instance['instagram']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('googleplus')); ?>"><?php _e('Google plus url:','brookside-elements'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('googleplus')); ?>" name="<?php echo esc_attr($this->get_field_name('googleplus')); ?>" value="<?php echo esc_attr($instance['googleplus']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('forrst')); ?>"><?php _e('Forrst url:','brookside-elements'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('forrst')); ?>" name="<?php echo esc_attr($this->get_field_name('forrst')); ?>" value="<?php echo esc_attr($instance['forrst']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('dribbble')); ?>"><?php _e('Dribbble url:','brookside-elements'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('dribbble')); ?>" name="<?php echo esc_attr($this->get_field_name('dribbble')); ?>" value="<?php echo esc_attr($instance['dribbble']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('flickr')); ?>"><?php _e('Flickr url:','brookside-elements'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('flickr')); ?>" name="<?php echo esc_attr($this->get_field_name('flickr')); ?>" value="<?php echo esc_attr($instance['flickr']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('linkedin')); ?>"><?php _e('Linkedin url:','brookside-elements'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('linkedin')); ?>" name="<?php echo esc_attr($this->get_field_name('linkedin')); ?>" value="<?php echo esc_attr($instance['linkedin']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('skype')); ?>"><?php _e('Skype account:','brookside-elements'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('skype')); ?>" name="<?php echo esc_attr($this->get_field_name('skype')); ?>" value="<?php echo esc_attr($instance['skype']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('digg')); ?>"><?php _e('Digg url:','brookside-elements'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('digg')); ?>" name="<?php echo esc_attr($this->get_field_name('digg')); ?>" value="<?php echo esc_attr($instance['digg']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('vimeo')); ?>"><?php _e('Vimeo url:','brookside-elements'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('vimeo')); ?>" name="<?php echo esc_attr($this->get_field_name('vimeo')); ?>" value="<?php echo esc_attr($instance['vimeo']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('yahoo')); ?>"><?php _e('Yahoo url:','brookside-elements'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('yahoo')); ?>" name="<?php echo esc_attr($this->get_field_name('yahoo')); ?>" value="<?php echo esc_attr($instance['yahoo']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('tumblr')); ?>"><?php _e('Tumblr url:','brookside-elements'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('tumblr')); ?>" name="<?php echo esc_attr($this->get_field_name('tumblr')); ?>" value="<?php echo esc_attr($instance['tumblr']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('youtube')); ?>"><?php _e('Youtube url:','brookside-elements'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('youtube')); ?>" name="<?php echo esc_attr($this->get_field_name('youtube')); ?>" value="<?php echo esc_attr($instance['youtube']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('deviantart')); ?>"><?php _e('Deviantart url:','brookside-elements'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('deviantart')); ?>" name="<?php echo esc_attr($this->get_field_name('deviantart')); ?>" value="<?php echo esc_attr($instance['deviantart']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('behance')); ?>"><?php _e('Behance url:','brookside-elements'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('behance')); ?>" name="<?php echo esc_attr($this->get_field_name('behance')); ?>" value="<?php echo esc_attr($instance['behance']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('vk')); ?>"><?php _e('VKontakte url:','brookside-elements'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('vk')); ?>" name="<?php echo esc_attr($this->get_field_name('vk')); ?>" value="<?php echo esc_attr($instance['vk']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('delicious')); ?>"><?php _e('Delicious url:','brookside-elements'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('delicious')); ?>" name="<?php echo esc_attr($this->get_field_name('delicious')); ?>" value="<?php echo esc_attr($instance['delicious']); ?>" />
		</p>
    <?php }
}

// Add Widget
function brookside_widget_socials_init() {
	register_widget('brookside_widget_socials');
}
add_action('widgets_init', 'brookside_widget_socials_init');

?>