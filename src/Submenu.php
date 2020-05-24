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
        add_action( 'init', array($this,'lc_custom_post_calendar') );
        add_action('admin_menu', array($this,'event_calendar_admin') ); 
        add_action( 'admin_menu', array( $this, 'scheduler_admin_menus' ) );    

      }

 
      public function lc_custom_post_calendar() {
      
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
      
        register_post_type('schedule', $args);
      }

      public function event_calendar_admin()
      {
        add_menu_page( esc_html__('Event','event-calendar'), esc_html__('Event','event-calendar'), 'manage_options', 'event-calendar', array($this->submenu_page,'admin_init'));         
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
