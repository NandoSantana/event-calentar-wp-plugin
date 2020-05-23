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
if ( ! defined( 'WPINC' ) ) 
{
    die;
}

// require plugin_dir_path( __FILE__ ) . 'includes/source-fields-notices.php';

function page_template($single_template) 
{
    global $post;
	
	if ($post->post_type == 'schedule') 
	{
        $single_template = plugin_dir_path( __FILE__ )  . '/page.php' ;
    }
	//echo get_post_meta($post->ID, 'yourprefix_demo_textdate', true);
    return $single_template;
}
// return nineten twenty template page and content 
add_filter( 'single_template', 'page_template' );

//* Add Support for Testimonial Specific Custom Metaboxes (cmb2)
// if( !class_exists("CMB2") )
// {
// 	// require_once( plugin_dir_path(__FILE__)."includes/source-fields-metaboxes.php" );
// 	require_once( plugin_dir_path(__FILE__)."includes/source-fields-metaboxes-v2.php" );
// }

// Load Custom CMB2 Stylesheet in Admin Post Edit Screen
add_action('admin_enqueue_scripts', 'pb_cmb2_custom_style');

function pb_cmb2_custom_style( $hook ) 
{	
	wp_enqueue_style('cmb2-custom', plugin_dir_url( __FILE__ ) .'css/cmb2-custom.css', '1.0.3', true );

}


// If this file is called directly, abort.


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

    $fields = new FieldsAdmin('Description','Start','End','Recurrence','Cost', 'Venue');
    $fields->fieldsAdminInit();
   
}

add_action('admin_menu', 'event_calendar_admin'); 
function event_calendar_admin()
{
    add_menu_page( esc_html__('Event','event-calendar'), esc_html__('Event','event-calendar'), 'manage_options', 'event-calendar', 'admin_init' );         
}
add_action( 'init', 'lc_custom_post_calendar' );
 
// The custom function to register a movie post type
function lc_custom_post_calendar() {
 
  // Set the labels, this variable is used in the $args array
  $labels = array(
    'name'               => esc_html__('Schedules'),
    'singular_name'      => esc_html__('Schedule' ),
    'add_new'            => esc_html__('Create New Schedule' ),
    'add_new_item'       => esc_html__('Create New Schedule' ),
    'edit_item'          => esc_html__('Edit Schedule' ),
    'new_item'           => esc_html__('New Schedule' ),
    'all_items'          => esc_html__('All Schedules' ),
    'view_item'          => esc_html__('View Schedule' ),
    'search_items'       => esc_html__('Search Schedule' ),
    'featured_image'     => esc_html__('Image'),
    'set_featured_image' => esc_html__('Select Image')
  );
 
  // The arguments for our post type, to be entered as parameter 2 of register_post_type()
  $args = array(
    'labels'            => $labels,
    'description'       => '',
    'public'            => true,
    'menu_position'     => 5,
    'supports'          => array( 'title', 'thumbnail'), // array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ), 
    'has_archive'       => true,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'has_archive'       => true,
    'query_var'         => 'schedule',
    'taxonomies'          => array('topics', 'category' ),
  );
 
  // Call the actual WordPress function
  // Parameter 1 is a name for the post type
  // Parameter 2 is the $args array
  register_post_type('schedule', $args);
}

function admin_init()
{
    echo "<h2>First Menu</h2>";
}