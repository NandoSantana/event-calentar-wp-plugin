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

   // add_action( 'admin_menu', array( $this, 'scheduler_admin_menus' ) );
    add_action( 'admin_menu', array( $this,'custom_post_calendar') );
 
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
  public function custom_post_calendar() {
    
    // Set the labels, this variable is used in the $args array
    $labels = array(
        'name'               => __( 'Movie Reviews' ),
        'singular_name'      => __( 'Movie Review' ),
        'add_new'            => __( 'Add New Movie Review' ),
        'add_new_item'       => __( 'Add New Movie Review' ),
        'edit_item'          => __( 'Edit Movie Review' ),
        'new_item'           => __( 'New Movie Review' ),
        'all_items'          => __( 'All Movie Reviews' ),
        'view_item'          => __( 'View Movie Reviews' ),
        'search_items'       => __( 'Search Movie Reviews' )
    );
    
    // The arguments for our post type, to be entered as parameter 2 of register_post_type()
    $args = array(
        'labels'            => $labels,
        'description'       => 'Holds our movie reviews',
        'public'            => true,
        'menu_position'     => 6,
        'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ),
        'has_archive'       => true,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'has_archive'       => true
    );
    
    // Call the actual WordPress function
    // Parameter 1 is a name for the post type
    // $args array goes in parameter 2.
    register_post_type( 'event-calendar', $args);
    }


}