<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



if ( ! function_exists( 'mistercorporate_plugin_customize_register' ) ) :

function mistercorporate_plugin_customize_register( $wp_customize ) {

	/* *** Quote section *** */
    $wp_customize->add_setting( 'mrcorp_quote_show', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( 'mrcorp_quote_show', array(
        'label' => __( 'Show/Hide Section', 'mistercorporate' ),
        'type' => 'checkbox',
        'section' => 'mrcorp_quote_section'
    ));

    $wp_customize->add_section( 'mrcorp_quote_section', array(
        'panel' => 'mistercoporate_panel',
        'title' => __( 'Quote Section', 'mistercorporate' )
    ));

    $wp_customize->add_setting( 'mrcorp_quote_text', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => 'Cum sociis natoque penatibus et magnis montes, nascetur ridiculus mus.'
    ));

    $wp_customize->add_control( 'mrcorp_quote_text', array(
        'label' => __( 'Quote Text', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_quote_section'
    ));


    /* *** Tryit section *** */
    $wp_customize->add_setting( 'mrcorp_tryit_show', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( 'mrcorp_tryit_show', array(
        'label' => __( 'Show/Hide Section', 'mistercorporate' ),
        'type' => 'checkbox',
        'section' => 'mrcorp_tryit_section'
    ));

    $wp_customize->add_section( 'mrcorp_tryit_section', array(
        'panel' => 'mistercoporate_panel',
        'title' => __( 'Try It Section', 'mistercorporate' )
    ));

    $wp_customize->add_setting( 'mrcorp_tryit_big_text', array(
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'default' => 'Cum sociis natoque'
    ));

    $wp_customize->add_control( 'mrcorp_tryit_big_text', array(
        'label' => __( 'Big Text', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_tryit_section'
    ));

    $wp_customize->add_setting( 'mrcorp_tryit_small_text', array(
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'default' => 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.'
    ));

    $wp_customize->add_control( 'mrcorp_tryit_small_text', array(
        'label' => __( 'Small Text', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_tryit_section'
    ));

    $wp_customize->add_setting( 'mrcorp_tryit_button1_label', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => 'Try free'
    ));

    $wp_customize->add_control( 'mrcorp_tryit_button1_label', array(
        'label' => __( 'Button Label 1', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_tryit_section'
    ));

    $wp_customize->add_setting( 'mrcorp_tryit_button1_href', array(
        'sanitize_callback' => 'esc_url_raw',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( 'mrcorp_tryit_button1_href', array(
        'label' => __( 'Button Link 1', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_tryit_section'
    ));

    $wp_customize->add_setting( 'mrcorp_tryit_button1_sh', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( 'mrcorp_tryit_button1_sh', array(
        'label' => __( 'Show Hide Button 1', 'mistercorporate' ),
        'type' => 'checkbox',
        'section' => 'mrcorp_tryit_section'
    ));

    $wp_customize->add_setting( 'mrcorp_tryit_button2_label', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => 'Buy now'
    ));

    $wp_customize->add_control( 'mrcorp_tryit_button2_label', array(
        'description' => __( 'Button Label 2', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_tryit_section'
    ));

    $wp_customize->add_setting( 'mrcorp_tryit_button2_href', array(
        'sanitize_callback' => 'esc_url_raw',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( 'mrcorp_tryit_button2_href', array(
        'label' => __( 'Button Link 2', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_tryit_section'
    ));

    $wp_customize->add_setting( 'mrcorp_tryit_button2_sh', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( 'mrcorp_tryit_button2_sh', array(
        'label' => __( 'Show Hide Button 2', 'mistercorporate' ),
        'type' => 'checkbox',
        'section' => 'mrcorp_tryit_section'
    ));

    $wp_customize->add_setting( 'mrcorp_tryit_button3_label', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => 'Contact us'
    ));

    $wp_customize->add_control( 'mrcorp_tryit_button3_label', array(
        'label' => __( 'Button Label 3', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_tryit_section'
    ));

    $wp_customize->add_setting( 'mrcorp_tryit_button3_href', array(
        'sanitize_callback' => 'esc_url_raw',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        //'default' => '#MistercorporateModal'
    ));

    $wp_customize->add_control( 'mrcorp_tryit_button3_href', array(
        'label' => __( 'Button Link 3', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_tryit_section',
        'description' => 'Put #MistercorporateModal for display contact form modal'        
    ));

    $wp_customize->add_setting( 'mrcorp_tryit_button3_sh', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( 'mrcorp_tryit_button3_sh', array(
        'label' => __( 'Show Hide Button 3', 'mistercorporate' ),
        'type' => 'checkbox',
        'section' => 'mrcorp_tryit_section'
    ));

    $wp_customize->add_setting( 'mrcorp_tryit_right_image', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'mrcorp_tryit_right_image', array(
        'label' => __( 'Right Image', 'mistercorporate' ),
        'type' => 'media',
        'mime_type' => 'image',
        'section' => 'mrcorp_tryit_section'
    ) ) );


	/* *** Newsletter section *** */
    $wp_customize->add_setting( 'mrcorp_newsletter_show', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( 'mrcorp_newsletter_show', array(
        'label' => __( 'Show/Hide Section', 'mistercorporate' ),
        'type' => 'checkbox',
        'section' => 'mrcorp_newsletter_section'
    ));

    $wp_customize->add_section( 'mrcorp_newsletter_section', array(
        'panel' => 'mistercoporate_panel',
        'title' => __( 'Newsletter Section', 'mistercorporate' )
    ));

    $wp_customize->add_setting( 'mrcorp_newsletter_text', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => 'Sign-up to receive our newsletter'
    ));

    $wp_customize->add_control( 'mrcorp_newsletter_text', array(
        'label' => __( 'Newsletter Text', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_newsletter_section'
    ));

    $wp_customize->add_setting( 'mrcorp_shortcode_mailchimp', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( 'mrcorp_shortcode_mailchimp', array(
        'label' => __( 'Mailchimp for WP Shortcode', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_newsletter_section'
    ));


    /* *** Adv section *** */
    $wp_customize->add_setting( 'mrcorp_adv_show', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( 'mrcorp_adv_show', array(
        'label' => __( 'Show/Hide Section', 'mistercorporate' ),
        'type' => 'checkbox',
        'section' => 'mrcorp_adv_section'
    ));

    $wp_customize->add_section( 'mrcorp_adv_section', array(
        'panel' => 'mistercoporate_panel',
        'title' => __( 'Adv Section', 'mistercorporate' )
    ));

    $wp_customize->add_setting( 'mrcorp_adv_img', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'mrcorp_adv_img', array(
        'label' => __( 'Adv Image', 'mistercorporate' ),
        'description' => __( '728 x 90', 'mistercorporate' ),
        'type' => 'media',
        'mime_type' => 'image',
        'section' => 'mrcorp_adv_section'
    ) ) );

    $wp_customize->add_setting( 'mrcorp_adv_href', array(
        'sanitize_callback' => 'esc_url_raw',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( 'mrcorp_adv_href', array(
        'label' => __( 'Adv Link', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_adv_section'
    ));


    /* *** Price section *** */
    $wp_customize->add_setting( 'mrcorp_price_show', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( 'mrcorp_price_show', array(
        'label' => __( 'Show/Hide Section', 'mistercorporate' ),
        'type' => 'checkbox',
        'section' => 'mrcorp_price_section'
    ));

    $wp_customize->add_section( 'mrcorp_price_section', array(
        'panel' => 'mistercoporate_panel',
        'title' => __( 'Price Section', 'mistercorporate' )
    ));

    $wp_customize->add_setting( 'mrcorp_price_big_text', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => 'Choose what you want'
    ));

    $wp_customize->add_control( 'mrcorp_price_big_text', array(
        'label' => __( 'Big Text', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_small_text', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => 'It cost less than you think'
    ));

    $wp_customize->add_control( 'mrcorp_price_small_text', array(
        'label' => __( 'Small Text', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_section'
    ));

    $wp_customize->add_section( 'mrcorp_price_1_section', array(
        'panel' => 'mistercoporate_panel',
        'title' => __( 'First Table Price Section', 'mistercorporate' )
    ));

    $wp_customize->add_setting( 'mrcorp_price_1_name', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => 'Bronze'
    ));

    $wp_customize->add_control( 'mrcorp_price_1_name', array(
        'label' => __( 'Price Name', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_1_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_1_price', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => '&#36;10'
    ));

    $wp_customize->add_control( 'mrcorp_price_1_price', array(
        'label' => __( 'Price', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_1_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_1_period', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => '/mo'
    ));

    $wp_customize->add_control( 'mrcorp_price_1_period', array(
        'label' => __( 'Period', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_1_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_1_small_text', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => '1 month FREE trial'
    ));

    $wp_customize->add_control( 'mrcorp_price_1_small_text', array(
        'label' => __( 'Secondary Text', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_1_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_1_text_1', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => '1 Account'
    ));

    $wp_customize->add_control( 'mrcorp_price_1_text_1', array(
        'label' => __( 'Text 1', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_1_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_1_text_2', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => '1 Project'
    ));

    $wp_customize->add_control( 'mrcorp_price_1_text_2', array(
        'label' => __( 'Text 2', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_1_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_1_text_3', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => '100K API Access'
    ));

    $wp_customize->add_control( 'mrcorp_price_1_text_3', array(
        'label' => __( 'Text 3', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_1_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_1_text_4', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => '100MB Storage'
    ));

    $wp_customize->add_control( 'mrcorp_price_1_text_4', array(
        'label' => __( 'Text 4', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_1_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_1_text_5', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => 'Custom Cloud Services'
    ));

    $wp_customize->add_control( 'mrcorp_price_1_text_5', array(
        'label' => __( 'Text 5', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_1_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_1_text_6', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => 'Weekly Reports'
    ));

    $wp_customize->add_control( 'mrcorp_price_1_text_6', array(
        'label' => __( 'Text 6', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_1_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_1_button_label', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => 'Sign Up'
    ));

    $wp_customize->add_control( 'mrcorp_price_1_button_label', array(
        'label' => __( 'Button Label', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_1_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_1_button_link', array(
        'sanitize_callback' => 'esc_url_raw',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( 'mrcorp_price_1_button_link', array(
        'label' => __( 'Button Link', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_1_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_1_text_bottom', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => '1 month FREE trial'
    ));

    $wp_customize->add_control( 'mrcorp_price_1_text_bottom', array(
        'label' => __( 'Text Bottom', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_1_section'
    ));

    $wp_customize->add_section( 'mrcorp_price_2_section', array(
        'panel' => 'mistercoporate_panel',
        'title' => __( 'Second Table Price Section', 'mistercorporate' )
    ));

    $wp_customize->add_setting( 'mrcorp_price_2_ribbon', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => 'MOST<br> POPULR'
    ));

    $wp_customize->add_control( 'mrcorp_price_2_ribbon', array(
        'label' => __( 'Ribbon Text', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_2_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_2_name', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => 'Silver'
    ));

    $wp_customize->add_control( 'mrcorp_price_2_name', array(
        'label' => __( 'Price Name', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_2_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_2_price', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => '&#36;20'
    ));

    $wp_customize->add_control( 'mrcorp_price_2_price', array(
        'label' => __( 'Price', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_2_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_2_period', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => '/mo'
    ));

    $wp_customize->add_control( 'mrcorp_price_2_period', array(
        'label' => __( 'Period', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_2_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_2_small_text', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => '1 month FREE trial'
    ));

    $wp_customize->add_control( 'mrcorp_price_2_small_text', array(
        'label' => __( 'Secondary Text', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_2_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_2_text_1', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => '2 Account'
    ));

    $wp_customize->add_control( 'mrcorp_price_2_text_1', array(
        'label' => __( 'Text 1', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_2_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_2_text_2', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => '5 Project'
    ));

    $wp_customize->add_control( 'mrcorp_price_2_text_2', array(
        'label' => __( 'Text 2', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_2_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_2_text_3', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => '100K API Access'
    ));

    $wp_customize->add_control( 'mrcorp_price_2_text_3', array(
        'label' => __( 'Text 3', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_2_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_2_text_4', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => '200MB Storage'
    ));

    $wp_customize->add_control( 'mrcorp_price_2_text_4', array(
        'label' => __( 'Text 4', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_2_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_2_text_5', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => 'Custom Cloud Services'
    ));

    $wp_customize->add_control( 'mrcorp_price_2_text_5', array(
        'label' => __( 'Text 5', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_2_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_2_text_6', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => 'Weekly Reports'
    ));

    $wp_customize->add_control( 'mrcorp_price_2_text_6', array(
        'label' => __( 'Text 6', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_2_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_2_button_label', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => 'Sign Up'
    ));

    $wp_customize->add_control( 'mrcorp_price_2_button_label', array(
        'label' => __( 'Button Label', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_2_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_2_button_link', array(
        'sanitize_callback' => 'esc_url_raw',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( 'mrcorp_price_2_button_link', array(
        'label' => __( 'Button Link', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_2_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_2_text_bottom', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => '1 month FREE trial'
    ));

    $wp_customize->add_control( 'mrcorp_price_2_text_bottom', array(
        'label' => __( 'Text Bottom', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_2_section'
    ));

    $wp_customize->add_section( 'mrcorp_price_3_section', array(
        'panel' => 'mistercoporate_panel',
        'title' => __( 'Third Table Price Section', 'mistercorporate' )
    ));

    $wp_customize->add_setting( 'mrcorp_price_3_name', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => 'Gold'
    ));

    $wp_customize->add_control( 'mrcorp_price_3_name', array(
        'label' => __( 'Price Name', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_3_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_3_price', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => '&#36;35'
    ));

    $wp_customize->add_control( 'mrcorp_price_3_price', array(
        'label' => __( 'Price', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_3_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_3_period', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => '/mo'
    ));

    $wp_customize->add_control( 'mrcorp_price_3_period', array(
        'label' => __( 'Period', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_3_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_3_small_text', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => '1 month FREE trial'
    ));

    $wp_customize->add_control( 'mrcorp_price_3_small_text', array(
        'label' => __( 'Secondary Text', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_3_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_3_text_1', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => '5 Account'
    ));

    $wp_customize->add_control( 'mrcorp_price_3_text_1', array(
        'label' => __( 'Text 1', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_3_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_3_text_2', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => '20 Project'
    ));

    $wp_customize->add_control( 'mrcorp_price_3_text_2', array(
        'label' => __( 'Text 2', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_3_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_3_text_3', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => '300K API Access'
    ));

    $wp_customize->add_control( 'mrcorp_price_3_text_3', array(
        'label' => __( 'Text 3', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_3_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_3_text_4', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => '500MB Storage'
    ));

    $wp_customize->add_control( 'mrcorp_price_3_text_4', array(
        'label' => __( 'Text 4', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_3_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_3_text_5', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => 'Custom Cloud Services'
    ));

    $wp_customize->add_control( 'mrcorp_price_3_text_5', array(
        'label' => __( 'Text 5', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_3_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_3_text_6', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => 'Weekly Reports'
    ));

    $wp_customize->add_control( 'mrcorp_price_3_text_6', array(
        'label' => __( 'Text 6', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_3_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_3_button_label', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => 'Sign Up'
    ));

    $wp_customize->add_control( 'mrcorp_price_3_button_label', array(
        'label' => __( 'Button Label', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_3_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_3_button_link', array(
        'sanitize_callback' => 'esc_url_raw',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( 'mrcorp_price_3_button_link', array(
        'label' => __( 'Button Link', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_3_section'
    ));

    $wp_customize->add_setting( 'mrcorp_price_3_text_bottom', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => '1 month FREE trial'
    ));

    $wp_customize->add_control( 'mrcorp_price_3_text_bottom', array(
        'label' => __( 'Text Bottom', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_price_3_section'
    ));


    /* *** Partner section *** */
    $wp_customize->add_setting( 'mrcorp_partner_show', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( 'mrcorp_partner_show', array(
        'label' => __( 'Show/Hide Section', 'mistercorporate' ),
        'type' => 'checkbox',
        'section' => 'mrcorp_partner_section'
    ));

    $wp_customize->add_section( 'mrcorp_partner_section', array(
        'panel' => 'mistercoporate_panel',
        'title' => __( 'Partner Section', 'mistercorporate' )
    ));

    $wp_customize->add_setting( 'mrcorp_partner_1_img', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'mrcorp_partner_1_img', array(
        'label' => __( 'Image 1', 'mistercorporate' ),
        'type' => 'media',
        'mime_type' => 'image',
        'section' => 'mrcorp_partner_section'
    ) ) );

    $wp_customize->add_setting( 'mrcorp_partner_2_img', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'mrcorp_partner_2_img', array(
        'label' => __( 'Image 2', 'mistercorporate' ),
        'type' => 'media',
        'mime_type' => 'image',
        'section' => 'mrcorp_partner_section'
    ) ) );

    $wp_customize->add_setting( 'mrcorp_partner_3_img', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'mrcorp_partner_3_img', array(
        'label' => __( 'Image 3', 'mistercorporate' ),
        'type' => 'media',
        'mime_type' => 'image',
        'section' => 'mrcorp_partner_section'
    ) ) );

    $wp_customize->add_setting( 'mrcorp_partner_4_img', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'mrcorp_partner_4_img', array(
        'label' => __( 'Image 4', 'mistercorporate' ),
        'type' => 'media',
        'mime_type' => 'image',
        'section' => 'mrcorp_partner_section'
    ) ) );

    $wp_customize->add_setting( 'mrcorp_partner_5_img', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'mrcorp_partner_5_img', array(
        'label' => __( 'Image 5', 'mistercorporate' ),
        'type' => 'media',
        'mime_type' => 'image',
        'section' => 'mrcorp_partner_section'
    ) ) );

    $wp_customize->add_setting( 'mrcorp_partner_6_img', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'mrcorp_partner_6_img', array(
        'label' => __( 'Image 6', 'mistercorporate' ),
        'type' => 'media',
        'mime_type' => 'image',
        'section' => 'mrcorp_partner_section'
    ) ) );


    /* *** Map section *** */
    $wp_customize->add_setting( 'mrcorp_map_show', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( 'mrcorp_map_show', array(
        'label' => __( 'Show/Hide Section', 'mistercorporate' ),
        'type' => 'checkbox',
        'section' => 'mrcorp_map_section'
    ));

    $wp_customize->add_setting( 'mrcorp_map_google_api', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( 'mrcorp_map_google_api', array(
        'label' => __( 'Google Map API', 'mistercorporate' ),
        'description' => __( '<a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">Obtaining an API key</a>', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_map_section'
    ));

    $wp_customize->add_setting( 'mrcorp_marker_center_lat', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( 'mrcorp_marker_center_lat', array(
        'label' => __( 'Center Map Lat', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_map_section'
    ));

    $wp_customize->add_setting( 'mrcorp_marker_center_lng', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( 'mrcorp_marker_center_lng', array(
        'label' => __( 'Center Map Lng', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_map_section'
    ));

    $wp_customize->add_section( 'mrcorp_map_section', array(
        'panel' => 'mistercoporate_panel',
        'title' => __( 'Map Section', 'mistercorporate' )
    ));

    $wp_customize->add_setting( 'mrcorp_marker_pos_lat', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( 'mrcorp_marker_pos_lat', array(
        'label' => __( 'Marker Position Lat', 'mistercorporate' ),
        'description' => __( 'eg. 51.5368169', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_map_section'
    ));

    $wp_customize->add_setting( 'mrcorp_marker_pos_lng', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( 'mrcorp_marker_pos_lng', array(
        'label' => __( 'Marker Position Lng', 'mistercorporate' ),
        'description' => __( 'eg. -0.1851698', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_map_section'
    ));

    $wp_customize->add_setting( 'mrcorp_marker_img', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'mrcorp_marker_img', array(
        'label' => __( 'Marker Image', 'mistercorporate' ),
        'type' => 'media',
        'mime_type' => 'image',
        'section' => 'mrcorp_map_section'
    ) ) );


    /* *** Contact section *** */
    $wp_customize->add_section( 'mrcorp_contact_section', array(
        'panel' => 'mistercoporate_panel',
        'title' => __( 'Contact Section Modal', 'mistercorporate' )
    ));

    $wp_customize->add_setting( 'mrcorp_modal_tit', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod',
        'default' => 'Contact us!'
    ));

    $wp_customize->add_control( 'mrcorp_modal_tit', array(
        'label' => __( 'Modal Title', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_contact_section'
    ));

    $wp_customize->add_setting( 'mrcorp_modal_short', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'   => 'refresh',
        'type' => 'theme_mod'
    ));

    $wp_customize->add_control( 'mrcorp_modal_short', array(
        'label' => __( 'CF7 Shortcode', 'mistercorporate' ),
        'type' => 'text',
        'section' => 'mrcorp_contact_section'
    ));
}


add_action( 'customize_register', 'mistercorporate_plugin_customize_register' );
endif;// mistercorporate_plugin_customize_register
?>