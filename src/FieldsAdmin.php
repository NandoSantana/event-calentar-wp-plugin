<?php
namespace EventCalendar;

class FieldsAdmin {
    
    public $description;
    public $start; // OR all day 
    public $end; // or all day
    public $recurrence ; // (none, daily, weekly, monthly, yearly, just simple recurrence rules here
    public $cost; // entrance fees
    public $veunue; // ( Name + address)

    public function __construct($description, $start, $end, $recurrence, $cost, $venue)
    {
       
        $this->description = $description;
        $this->start = $start;
        $this->end = $end;
        $this->recurrence = $recurrence;
        $this->cost = $cost;
        $this->venue = $venue;
    }

    public function fieldsAdminInit()
    {
        add_action('admin_notices', array( $this,'pb_source_fields_showAdminMessages'));
        add_action( 'cmb2_admin_init', array( $this,'custom_post_fields_admin') );
    }

    public function pb_source_fields_showAdminMessages()
    {

        $plugin_messages = array();
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

        // Check if CMB2 plugin is active
        if(!class_exists( 'cmb2' )){
        // Wraning message
            $plugin_messages[] = 'The <strong>Source Fields</strong> plugin requires you to install the <strong>CMB2</strong> plugin in order to fully use the plugins features. Please install and activate <strong>CMB2</strong> before activating this plugin</a>.';
        }
        // If not, display warning message
        if(count($plugin_messages) > 0){
            echo '<div id="message" class="error">';
                foreach($plugin_messages as $message){
                    echo '<p>'.$message.'</p>';
                }
            echo '</div>';
        }
    }


    public function custom_post_fields_admin()
    {

        $cmb = new_cmb2_box( array(
        'id'            => 'source_metabox',
        'title'         => __( 'Schedule', 'cmb2' ),
        'object_types'  => array( 'schedule', ), // Post type
        'context'       => 'advanced', //  'normal', 'advanced', or 'side'
        'priority'      => 'core', //  'high', 'core', 'default' or 'low'
        'show_names'    => true, // Show field names on the left
        'cmb_styles'    => true, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
        ) );

        $cmb->add_field( array(
            'name' => esc_html__( $this->description, 'cmb2' ),
            'desc' => esc_html__( 'field description', 'cmb2' ),
            'id'   => 'yourprefix_demo_textarea',
            'type' => 'textarea',
        ) );

        
        $cmb->add_field( array(
            'name' => esc_html__( $this->start, 'cmb2' ),
            'desc' => esc_html__( '', 'cmb2' ),
            'id'   => 'datetime_timestamp',
            'type' => 'text_datetime_timestamp',
            'time_format' => 'H:i',
        ) );
        
        $cmb->add_field( 
            array(
                'name'       => 'Start - All days',
                'id'         => '_is_public',
                'type'       => 'checkbox'
            ) 
        );

        $cmb->add_field( array(
            'name' => esc_html__( $this->end, 'cmb2' ),
            'desc' => esc_html__( '', 'cmb2' ),
            'id'   => 'datetime_timestamp_end',
            'type' => 'text_datetime_timestamp',
            'time_format' => 'H:i',
        ) );

        $cmb->add_field( 
            array(
                'name'       => 'End - All days',
                'id'         => '_alldays_end',
                'type'       => 'checkbox'
            ) 
        );

        $cmb->add_field( array(
            'name'             => esc_html__( $this->recurrence, 'cmb2' ),
            'desc'             => esc_html__( 'Recurrence', 'cmb2' ),
            'id'               => 'yourprefix_demo_select_Recurrence',
            'type'             => 'select',
            'show_option_none' => false,
            'options'          => array(              
                'none'     => esc_html__( 'None', 'cmb2' ),
                'daily' => esc_html__( 'daily', 'cmb2' ),
                'weekly' => esc_html__( 'weekly', 'cmb2' ),
                'monthly' => esc_html__( 'monthly', 'cmb2' ),
                'yearly' => esc_html__( 'yearly', 'cmb2' ),
            ),
        ) );

        $cmb->add_field( array(
            'name' => esc_html__( $this->cost, 'cmb2' ),
            'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
            'id'   => 'yourprefix_demo_textmoney',
            'type' => 'text_money',
            // 'before_field' => '£', // override '$' symbol if needed
            // 'repeatable' => true,
        ) );


    
        $cmb->add_field( array(
        'name' => esc_html__(  $this->venue , 'cmb2' ),
        'desc' => esc_html__( '(name + address)', 'cmb2' ),
        'id'   => 'yourprefix_demo_textmedium_venue',
        'type' => 'text_medium',
        ));

    }

}
