<?php
function mistercorporate_styles_method() {
	wp_enqueue_style(
		'mistercorporate-additional-style',
		get_template_directory_uri() . '/assets/css/mistercorporate-additional-style.css'
	);
        $mrcorporate_heade_image = get_theme_mod('header_image', '');
        if(isset($mrcorporate_heade_image) && $mrcorporate_heade_image != '' && $mrcorporate_heade_image != 'remove-header'){
                $mrcorporate_custom_css = "
                        .mrcorp-add-header{
                                background-image:url('".esc_url($mrcorporate_heade_image)."');
                        }";
        }
        else{
                $mrcorporate_custom_css = "
                        .mrcorp-add-header{
                                background-image:url('".get_template_directory_uri()."/assets/img/head-man.jpg');
                        }
                ";               
        }        
        wp_add_inline_style( 'mistercorporate-additional-style', $mrcorporate_custom_css );
}
add_action( 'wp_enqueue_scripts', 'mistercorporate_styles_method' );
?>