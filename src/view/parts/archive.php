<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

get_header();
$urlBase =  WP_PLUGIN_URL."/event-calendar/src/view/parts";
?>

<link rel="stylesheet" type="text/css" href="<?php echo $urlBase; ?>/assets/css/evo-calendar.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $urlBase; ?>/assets/css/evo-calendar.midnight-blue.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $urlBase; ?>/assets/css/evo-calendar.royal-navy.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $urlBase; ?>/assets/css/evo-calendar.orange-coral.css"/>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<header class="page-header">
				
			</header><!-- .page-header -->
			<article id="post-">
				<header class="entry-header">
					
				</header><!-- .entry-header -->

				

				<div class="entry-content">
					<div class="container" id="calendar"></div>
				
				</div><!-- .entry-content -->

				<footer class="entry-footer">
					
				</footer><!-- .entry-footer -->
			</article>
			
			
		</main><!-- #main -->
	</div><!-- #primary -->
    <!-- jQuery -->
    <script src="<?php echo $urlBase; ?>/assets/js/jquery-1.12.4.min.js"></script>
    <script src="<?php echo $urlBase; ?>/assets/js/evo-calendar.min.js"></script>

	<script>
		var settingValue =[
      {
      // Event's ID (required)
      id: '1s',
      // Event name (required)
       name: "New Year",
      // Event date (required)
       date: "1/1/2020",
      // Event type (required)
       type: "holiday",
      // Same event every year (optional)
       everyYear: true
      },
      { id: '1s2',
       name: "Vacation Leave",
       date: "2/13/2020",
       type: "event"
       }
    ];
		$('#calendar').evoCalendar({
			language: 'en',// Supported language: en, es, de..
			calendarEvents: settingValue,
			// theme: 'Royal Navy',
			 'todayHighlight': true, 
			'sidebarToggler': true,
			 'eventDisplayDefault': true,
			'eventListToggler': true,
			'format': 'MM dd, yyyy'
			
		});
		$('#calendar').on('selectEvent', function(event, activeEvent) {
		     // code here...
			console.log(event);
			alert('olá');
		});
	</script>
<?php

get_footer();
