<?php

namespace EventCalendar;

class SubmenuPage {
 
 /**
* This function renders the contents of the page associated with the Submenu
* that invokes the render method. In the context of this plugin, this is the
* Submenu class.
*/
    public function renderConfig() {

        echo _e('This is the basic submenu page.', '');
    }

    public function Edit(){

        echo "Edit";
       
    }
    
    // The custom function to register a movie post type
    public function lc_custom_post_calendar() {
 
    // Set the labels, this variable is used in the $args array
    $labels = array(
      'name'               => __( 'Movies' ),
      'singular_name'      => __( 'Movie' ),
      'add_new'            => __( 'Add New Movie' ),
      'add_new_item'       => __( 'Add New Movie' ),
      'edit_item'          => __( 'Edit Movie' ),
      'new_item'           => __( 'New Movie' ),
      'all_items'          => __( 'All Movies' ),
      'view_item'          => __( 'View Movie' ),
      'search_items'       => __( 'Search Movies' ),
      'featured_image'     => 'Poster',
      'set_featured_image' => 'Add Poster'
    );
   
    // The arguments for our post type, to be entered as parameter 2 of register_post_type()
    $args = array(
      'labels'            => $labels,
      'description'       => 'Holds our movies and movie specific data',
      'public'            => true,
      'menu_position'     => 5,
      'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ),
      'has_archive'       => true,
      'show_in_admin_bar' => true,
      'show_in_nav_menus' => true,
      'has_archive'       => true,
      'query_var'         => 'film'
    );
   
    // Call the actual WordPress function
    // Parameter 1 is a name for the post type
    // Parameter 2 is the $args array
    register_post_type('movie', $args);
  }
  
 

 

}