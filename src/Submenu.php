<?php

namespace EventCalendar;

class Submenu {
 

public $submenu_page;

  public function __construct( $submenu_page )
  {
    $this->submenu_page = $submenu_page;
  }


  public function init() 
  {
    add_action( 'admin_menu', array( $this, 'scheduler_admin_menus' ) );
  }



  public function scheduler_admin_menus() 
  {

    add_options_page(
        _x('Events Calendar Configuration', 'event-calendar'),
        _x('Events Calendar Configuration', 'event-calendar'),
        'manage_options',
        'custom-admin-page',
        array( $this->submenu_page, 'renderConfig' )
    );
    
    add_submenu_page('event-calendar', __('Edit Events', 'event-calendar'), __('Edit Events', 'event-calendar'), 'manage_options', 'edit-events',  array( $this->submenu_page, 'Edit' ) );
  }
}