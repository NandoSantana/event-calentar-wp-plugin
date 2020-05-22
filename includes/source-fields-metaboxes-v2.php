<?php

//**********************************************
//* Security
//**********************************************

//* Blocking direct access to the plugin PHP file
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


//**********************************************
//* Repeatable Source Fields
//**********************************************
// https://github.com/WebDevStudios/CMB2/wiki/Field-Types#group

add_action( 'cmb2_admin_init', 'pb_cmb2_source_metaboxes' );
/**
 * Define the metabox and field configurations.
 */
function pb_cmb2_source_metaboxes() 
{

// Start with an underscore to hide fields from custom fields list
$prefix = '_cmb2_source_metaboxes_';

   $cmb = new_cmb2_box( array(
      'id'            => 'source_metabox',
      'title'         => __( 'Schedule', 'cmb2' ),
      'object_types'  => array( 'schedule', ), // Post type
      'context'       => 'advanced', //  'normal', 'advanced', or 'side'
      'priority'      => 'core', //  'high', 'core', 'default' or 'low'
      'show_names'    => true, // Show field names on the left
      'cmb_styles'    => false, // false to disable the CMB stylesheet
      // 'closed'     => true, // Keep the metabox closed by default
   ),10, 5 );


 

   $cmb->add_field( array(
      'name' => esc_html__( 'Test Text Medium', 'cmb2' ),
      'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
      'id'   => 'yourprefix_demo_textmedium',
      'type' => 'text_medium',
   ));
   
   $cmb->add_field( array(
      'name'       => esc_html__( 'Read-only Disabled Field', 'cmb2' ),
      'desc'       => esc_html__( 'field description (optional)', 'cmb2' ),
      'id'         => 'yourprefix_demo_readonly',
      'type'       => 'text_medium',
      'default'    => esc_attr__( 'Hey there, I\'m a read-only field', 'cmb2' ),
      'save_field' => false, // Disables the saving of this field.
      'attributes' => array(
         'disabled' => 'disabled',
         'readonly' => 'readonly',
      ),
   ));
   
   $cmb->add_field( array(
      'name' => esc_html__( 'Custom Rendered Field', 'cmb2' ),
      'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
      'id'   => 'yourprefix_demo_render_row_cb',
      'type' => 'text',
      'render_row_cb' => 'yourprefix_render_row_cb',
   ) );
   
   $cmb->add_field( array(
      'name' => esc_html__( 'Website URL', 'cmb2' ),
      'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
      'id'   => 'yourprefix_demo_url',
      'type' => 'text_url',
      // 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
      // 'repeatable' => true,
   ) );
   
   $cmb->add_field( array(
      'name' => esc_html__( 'Test Text Email', 'cmb2' ),
      'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
      'id'   => 'yourprefix_demo_email',
      'type' => 'text_email',
      // 'repeatable' => true,
   ) );
   
   $cmb->add_field( array(
      'name' => esc_html__( 'Test Time', 'cmb2' ),
      'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
      'id'   => 'yourprefix_demo_time',
      'type' => 'text_time',
      // 'time_format' => 'H:i', // Set to 24hr format
   ) );
   
   $cmb->add_field( array(
      'name' => esc_html__( 'Time zone', 'cmb2' ),
      'desc' => esc_html__( 'Time zone', 'cmb2' ),
      'id'   => 'yourprefix_demo_timezone',
      'type' => 'select_timezone',
   ) );
   
   $cmb->add_field( array(
      'name' => esc_html__( 'Test Date Picker', 'cmb2' ),
      'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
      'id'   => 'yourprefix_demo_textdate',
      'type' => 'text_date',
      // 'date_format' => 'Y-m-d',
   ) );
   
   $cmb->add_field( array(
      'name' => esc_html__( 'Test Date Picker (UNIX timestamp)', 'cmb2' ),
      'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
      'id'   => 'yourprefix_demo_textdate_timestamp',
      'type' => 'text_date_timestamp',
      // 'timezone_meta_key' => 'yourprefix_demo_timezone', // Optionally make this field honor the timezone selected in the select_timezone specified above
   ) );
   
   $cmb->add_field( array(
      'name' => esc_html__( 'Test Date/Time Picker Combo (UNIX timestamp)', 'cmb2' ),
      'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
      'id'   => 'yourprefix_demo_datetime_timestamp',
      'type' => 'text_datetime_timestamp',
   ) );
   
   $cmb->add_field( array(
      'name'       => 'Public Quiz',
      'id'         => '_is_public',
      'type'       => 'checkbox'
  ) );

   $cmb->add_field( array(
      'name' => esc_html__( 'Test Text Area', 'cmb2' ),
      'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
      'id'   => 'yourprefix_demo_textarea',
      'type' => 'textarea',
   ) );

}


function repair_fix_layout()
{

	$cmb = new_cmb2_box( array(
		'id'           => 'feat-image-fields',
		'object_types' => array( 'schedule' ),
	) );

}
add_action( 'cmb2_admin_init', 'repair_fix_layout' );

function yourprefix_feat_img_output_fields( $content, $post_id, $thumbnail_id ) 
{
	$cmb = cmb2_get_metabox( 'feat-image-fields' );

   if ( $cmb && in_array( get_post_type(), $cmb->prop( 'object_types' ), 1 ) ) 
   {
		ob_start();
		$cmb->show_form();
		// grab the data from the output buffer and add it to our $content variable
		$content .= ob_get_clean();
	}

	return $content;
}
add_filter( 'admin_post_thumbnail_html', 'yourprefix_feat_img_output_fields', 10, 3 );
