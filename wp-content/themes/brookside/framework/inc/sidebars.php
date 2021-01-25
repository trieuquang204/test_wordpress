<?php
/* ------------------------------------------------------------------------ */
/* Define Sidebars */
/* ------------------------------------------------------------------------ */
if(!function_exists('brookside_widgets_init')){
	add_action( 'widgets_init', 'brookside_widgets_init' );
	function brookside_widgets_init(){
		if (function_exists('register_sidebar')) {
			if (get_theme_mod( 'brookside_widgets_headings_separator', true ) ) 
				$separator = ' separator';
			else {
				$separator = '';
			}
			/* ------------------------------------------------------------------------ */
			/* Blog Widgets */
			register_sidebar(array(
				'name' => esc_html__('Blog Widgets','brookside'),
				'id'   => 'blog-widgets',
				'description'   => esc_html__( 'These are widgets for the Blog sidebar.','brookside' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title'.$separator.'"><span>',
				'after_title'   => '</span></h3>'
			));
			/* ------------------------------------------------------------------------ */
			/* ------------------------------------------------------------------------ */
			/* Hidden area widgets */
			register_sidebar(array(
				'name' => esc_html__('Hidden Area Widgets','brookside'),
				'id'   => 'hidden-widgets',
				'description'   => esc_html__( 'These are widgets for hidden area. To show it you need to click button in header.','brookside' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title'.$separator.'"><span>',
				'after_title'   => '</span></h3>'
			));

			/* ------------------------------------------------------------------------ */
			/* Blog Widgets */
			register_sidebar(array(
				'name' => esc_html__('Footer Widgets','brookside'),
				'id'   => 'footer-widgets',
				'description'   => esc_html__( 'These are widgets for footer section.','brookside' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>'
			));
		}
	}
}
    
?>