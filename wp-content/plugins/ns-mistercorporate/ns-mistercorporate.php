<?php
/*
Plugin Name: NS Mistercorporate
Description: This plugin add theme options to Mistercorporate template
Version: 1.1.2
Author: NsThemes
Author URI: http://www.nsthemes.com
License: GNU General Public License v2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** 
 * @author        PluginEye
 * @copyright     Copyright (c) 2019, PluginEye.
 * @version         1.0.0
 * @license       https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
 * PLUGINEYE SDK
*/

require_once('plugineye/plugineye-class.php');
$plugineye = array(
    'main_directory_name'       => 'ns-mistercorporate',
    'main_file_name'            => 'ns-mistercorporate.php',
    'redirect_after_confirm'    => '',
    'plugin_id'                 => '219',
    'plugin_token'              => 'NWNmZTZkMzRiNWZkOWQxYjBiNzY4N2Y3YmNhOTJlZTM4OWNjMzk2Yzc3NTIzMTRmZDdkNjI2MWY2ZDUwOWZlODIyN2I3ZGM3Y2YwNzI=',
    'plugin_dir_url'            => plugin_dir_url(__FILE__),
    'plugin_dir_path'           => plugin_dir_path(__FILE__)
);

$plugineyeobj219 = new pluginEye($plugineye);
$plugineyeobj219->pluginEyeStart();      


/* *** define for import files *** */
if ( ! defined( 'MISTERCORPORATE_NS_PLUGIN_PATH' ) )
    define( 'MISTERCORPORATE_NS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

/* *** define for import css and js *** */
if ( ! defined( 'MISTERCORPORATE_NS_PLUGIN_URL' ) )
    define( 'MISTERCORPORATE_NS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/* *** add css for contact form *** */
if ( ! function_exists( 'mistercorporate_enqueue_contact_css' ) ) :
    function mistercorporate_enqueue_contact_css() {
		wp_enqueue_style( 'mistercorporate-contact-style', MISTERCORPORATE_NS_PLUGIN_URL . 'css/mistercorporate-contact-style.css', null, '1.0.0', 'all' );
	}
    add_action( 'wp_enqueue_scripts', 'mistercorporate_enqueue_contact_css' );
endif;

/* *** add customize *** */
require_once( MISTERCORPORATE_NS_PLUGIN_PATH . '/ns-mistercorporate-customize.php');

/* *** add map *** */
require_once( MISTERCORPORATE_NS_PLUGIN_PATH . '/ns-mistercorporate-map.php');

/* *** add widget contact *** */
require_once( MISTERCORPORATE_NS_PLUGIN_PATH . '/ns-mistercorporate-widget-contact.php');

/* *** override template *** */
function mistercorporate_ns_home_load_template( $template ) {
     global $post;
     $template_name = '/template/ns-mistercorporate-template-home.php';

     $home_template = plugin_dir_path( __FILE__ ) . $template_name;

     return $home_template;
}

add_filter( 'page_template', 'mistercorporate_ns_home_load_template' ) ;