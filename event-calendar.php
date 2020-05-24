<?php
/**
* Plugin Name: Event Calendar
* Plugin URI: @nandosant
* Description: made for the test
* Version: 0.1
* Author: Fernando Carvalho Santana
* Author URI:#
* Text Domain: event-calendar
**/

require 'vendor/autoload.php';


use EventCalendar\Submenu;
use EventCalendar\SubmenuPage;
use EventCalendar\FieldsAdmin;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
if ( ! defined( 'WPINC' ) ) {
    die;
}

function page_template($single_template) 
{
    global $post;
	
	if ($post->post_type == 'schedule') {
        $single_template = plugin_dir_path( __FILE__ )  . '/page.php' ;
    }
	//echo get_post_meta($post->ID, 'yourprefix_demo_textdate', true);
    return $single_template;
}
// return nineten twenty template page and content 
add_filter( 'single_template', 'page_template' );

// Load Custom CMB2 Stylesheet in Admin Post Edit Screen
add_action('admin_enqueue_scripts', 'pb_cmb2_custom_style');

function pb_cmb2_custom_style( $hook ) 
{	
    wp_enqueue_style('cmb2-custom', plugin_dir_url( __FILE__ ) .'css/cmb2-custom.css', '1.0.3', true );
}

add_action( 'plugins_loaded', 'add_submenu_admin_and_settings' );
function add_submenu_admin_and_settings() 
{
    
    $plugin = new Submenu( new SubmenuPage() );
    $plugin->init();

    $fields = new FieldsAdmin('Description','Start','End','Recurrence','Cost', 'Venue');
    $fields->fieldsAdminInit();

}

add_action('plugins_loaded', 'language_init');
function language_init() 
{
    $plugin_rel_path = basename( dirname( __FILE__ ) ) . '/languages'; /* Relative to WP_PLUGIN_DIR */
    load_plugin_textdomain( 'event-calendar', false, $plugin_rel_path );

}
