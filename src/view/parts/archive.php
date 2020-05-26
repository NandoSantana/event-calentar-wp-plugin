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
    <script src="<?php echo $urlBase; ?>/assets/js/evo-calendar.js"></script>
	<?php

		$post = get_posts(
			array('posts_per_page' => '', 'post_type' => 'schedule', 'orderby' => 'post_date', 'order' => 'ASC', 'post_status'=> 'publish')
		);
		$i = 0;
		foreach($post as $last_post) {
			
			$ids[$i] = $last_post->ID;
			$titles[$i] = $last_post->post_title;
			$thumbnail[$i] = get_the_post_thumbnail_url( $last_post->ID );
			$link[$i] = get_permalink($last_post->ID , false);
			$date[$i] = get_post_meta($last_post->ID, 'datetime_timestamp', true);
			$start_all_day[$i] = get_post_meta($last_post->ID, '_start_all_day', true);
			$dateEnd[$i] = get_post_meta($last_post->ID, 'datetime_timestamp_end', true);
			$end_all_day[$i] = get_post_meta($last_post->ID, '_allday_end', true);

			$recurrence[$i] = get_post_meta($last_post->ID, 'yourprefix_demo_select_Recurrence', true);
			
			


			$descricao[$i] = get_post_meta($last_post->ID, 'datetime_timestamp_end', true);

			$array[$i] = array(
				'id'=>$ids[$i],
				'name' =>$titles[$i],
				'link' => $link[$i],
				'date' => date('m/d/Y',$date[$i]),
				'hour' => date('H:i ',$date[$i]),
				'start_all_day' => $start_all_day[$i],
				'dateEnd' => date('m/d/Y',$dateEnd[$i]),
				'hourEnd' => date('H:i',$dateEnd[$i]),

				'end_all_day' => $end_all_day[$i],
				'type' => 'event',
				'every' => $recurrence[$i]
				
			);
			$i++;
		}
	
		$receive = json_encode($array, JSON_UNESCAPED_SLASHES);

	?>
	<script language="javascript">
		var receiveData = <?=$receive;?>;
		var settingValue = [
	{
      // Event's ID (required)
		id: '1s',
      // Event name (required)
		name: "New Year",
      // Event date (required)
		date: "12/31/2020",
		dateEnd:'1/1/2020',
      // Event type (required)
		type: "event",
	  // Same event every year (optional)
		every: 'none',
	  
	},
	{ 
		  
		  id: '1s2s',
		  name: "Terminar front",
		  date: "4/10/2020",
		  dateEnd:'4/12/2020',
		  type: "event",
		  every: 'none',
		 
	},
	{ 
		  
		id: '1s2',
		name: "Vacation Leave",
		date: "2/11/2020",
		dateEnd:'2/16/2020',
		type: "event",
		every: 'monthly',
		
	},
	{ 
		  
		  id: '1s2d',
		  name: "Estudar",
		  date: "3/10/2020",
		  dateEnd:'3/30/2020',
		  type: "event",
		  every: 'daily',
		  
	  },

	  { 
		  
		  id: '1s2ds',
		  name: "Estudar Logica",
		  date: "1/10/2020",
		  dateEnd:'2/20/2020',
		  type: "event",
		  every: 'monthly',
		  
	  },

	  { 
		  
		  id: '1s2ds1',
		  name: "Comer sagu",
		  date: "1/21/2020",
		  dateEnd:'1/25/2020',
		  type: "holiday",
		  every: 'monthly',
		  
	  },
	
    ];
		$('#calendar').evoCalendar({
			language: 'en',// Supported language: en, es, de..
			calendarEvents: receiveData,//receiveData, //settingValue,
			// theme: 'Royal Navy',
			'todayHighlight': true, 
			'sidebarToggler': true,
			'sidebarDisplayDefault': true,
			'eventDisplayDefault': true,
			'eventListToggler': true,
			'format': 'mm/dd/yyyy',
			'todayHighlight': true
			
		});
		$('#calendar').on('selectEvent', function(event, activeEvent) {
		     // code here...
			// console.log(event);
			console.log(activeEvent.link);
			window.location.href = activeEvent.link;
			// alert('olá');
		});
		$('#calendar').on('selectDate', function(event, newDate, oldDate) {
     // code here...
			console.log(event);
			console.log(newDate);
			console.log(oldDate);

		});
			
	</script>
<?php

get_footer();
