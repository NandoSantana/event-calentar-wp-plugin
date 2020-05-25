<?php

namespace EventCalendar\view;

class Front {


    public function templateInit()
    {
        // Load Custom CMB2 Stylesheet in Admin Post Edit Screen
        add_action('admin_enqueue_scripts', array($this, 'pb_cmb2_custom_style') );

        add_filter( 'single_template', array($this, 'page_template') );

        add_filter( 'archive_template', array($this, 'archive') );

        add_action('plugins_loaded', array($this, 'language_init') );
    }


    public function pb_cmb2_custom_style( $hook ) 
    {	
        wp_enqueue_style('cmb2-custom', plugin_dir_url( __FILE__ ) .'css/cmb2-custom.css', '1.0.3', true );
    }

    public function page_template($single_template) 
    {
    global $post;
	
        if ($post->post_type == 'schedule') {
            $single_template = plugin_dir_path( __FILE__ )  . 'parts/page.php' ;
        }
        //echo get_post_meta($post->ID, 'yourprefix_demo_textdate', true);
        return $single_template;
    }
    // return nineten twenty template page and content 

    public function archive($archive) 
    {
        return $archive = plugin_dir_path( __FILE__ )  . 'parts/archive.php' ;
    }

    public function language_init() 
    {
        $plugin_rel_path = basename( dirname( __FILE__ ) ) . '/languages'; /* Relative to WP_PLUGIN_DIR */
        load_plugin_textdomain( 'event-calendar', false, $plugin_rel_path );

    }

}
