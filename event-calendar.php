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
use EventCalendar\view\Front;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
if ( ! defined( 'WPINC' ) ) {
    die;
}

add_action( 'plugins_loaded', 'add_submenu_admin_and_settings' );
function add_submenu_admin_and_settings() 
{
    
    $plugin = new Submenu( new SubmenuPage() );
    $plugin->init();

    $fields = new FieldsAdmin('Description','Start','End','Recurrence','Cost', 'Venue');
    $fields->fieldsAdminInit();

    $front = new Front();
    $front->templateInit();

}
