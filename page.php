<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

get_header();
?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main">
			
			<?php

				echo get_post_meta($post->ID, 'yourprefix_demo_textdate',true);
				
				include plugin_dir_path(__FILE__) .'/content-page.php';

				// // If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			?>

		</main><!-- #main -->

	</div><!-- #primary -->

<?php
get_footer();
