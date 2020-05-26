<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( ! twentynineteen_can_show_post_thumbnail() ) : ?>
	<header class="entry-header">
		<?php get_template_part( 'template-parts/header/entry', 'header' ); ?>
	</header>
	<?php endif; ?>

	<div class="entry-content">
	<?php 
	global $post;
	if (has_post_thumbnail( $post->ID ) ): ?>
  	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
		<div id="custom-bg" style="background-image: url('<?php echo $image[0]; ?>')">
		</div>
	<?php endif; ?>
	<h2>Descrição</h2>
	<?php	echo get_post_meta($post->ID, 'yourprefix_demo_textarea',true)."<br/>"; ?>
	
	<h3>Event Start</h3>
	<?php echo  date('m/d/Y H:s', get_post_meta($post->ID, 'datetime_timestamp',true))."<br/>"; 
		echo  get_post_meta($post->ID, '_start_all_day',true)."<br/>"; ?>
	
	<h3> Event End</h3>
	<?php	echo  date('m/d/Y H:s',get_post_meta($post->ID, 'datetime_timestamp_end',true))."<br/>"; 
		echo  get_post_meta($post->ID, '_allday_end',true)."<br/>";?>
	
	<h3>Recurrency</h3>	
	<?php	echo  get_post_meta($post->ID, 'yourprefix_demo_select_Recurrence',true)."<br/>";?>
	
	<h3>Category</h3>	
	<?php
		$post_type = get_post_type(get_the_ID());   
		$taxonomies = get_object_taxonomies($post_type);   
		$taxonomy_names = wp_get_object_terms(get_the_ID(), $taxonomies,  array("fields" => "names")); 
		if(!empty($taxonomy_names)) :
		foreach($taxonomy_names as $tax_name) : ?>              
			<p><?php echo $tax_name; ?> </p>
		<?php endforeach;
		endif;
	?>
	<h3>Cost</h3>	
	<?php echo  get_post_meta($post->ID, 'yourprefix_demo_textmoney',true)."<br/>"; ?>
	
	<h3>Name/Address</h3>	
	<?php echo  get_post_meta($post->ID, 'yourprefix_demo_textmedium_venue',true)."<br/>";?>
		
		

	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Post title. Only visible to screen readers. */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'twentynineteen' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">' . //twentynineteen_get_icon_svg( 'edit', 16 ),
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
