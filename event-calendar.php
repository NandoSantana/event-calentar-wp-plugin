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


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) 
{
    die;
}

add_action('plugins_loaded', 'language_init');
function language_init() {
    $plugin_rel_path = basename( dirname( __FILE__ ) ) . '/languages'; /* Relative to WP_PLUGIN_DIR */
    load_plugin_textdomain( 'event-calendar', false, $plugin_rel_path );
}


add_action( 'plugins_loaded', 'add_submenu_admin_and_settings' );
function add_submenu_admin_and_settings() 
{
    
    $plugin = new Submenu( new SubmenuPage() );

    $plugin->init();
}

add_action('admin_menu', 'event_calendar_admin'); 
function event_calendar_admin()
{
    add_menu_page( __('Event','event-calendar'), __('Event','event-calendar'), 'manage_options', 'event-calendar', 'admin_init' );         
}


function admin_init()
{
    
    defined( 'ABSPATH' ) or die( 'Doesnt work without base url' );
    echo __("Hello World!", 'event-calendar');

}
 

