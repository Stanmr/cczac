<?php 
/**
 * List View Single Event
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *
 * @package TribeEventsCalendar
 * @since  3.0
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); } ?>

<?php 

$swm_venue_name 				= wp_strip_all_tags( tribe_get_venue() );
$swm_tribe_get_address 			= tribe_get_address(get_the_ID(),0);
$swm_tribe_get_city 			= tribe_get_city();
$swm_tribe_get_stateprovince 	= tribe_get_stateprovince();
$swm_event_website 				= tribe_get_event_website_url();
$swm_event_list_date 			= tribe_events_event_schedule_details();
$swm_event_list_date 			= tribe_get_start_date($event = null, $displayTime = true, $dateFormat = 'jS F Y - l ');
$swm_event_list_img 			= tribe_event_featured_image( null, 'portfolio-3' );
$swm_event_list_meta_width 		= ( empty( $swm_event_list_img ) ) ? 'swm_event_meta_full' : '';
?>

<div class="swm-tribe-event-list block-left">

	<?php if ( !empty( $swm_event_list_img ) ) { ?>

		<div class="swm-tribe-event-list-img">
			<!-- Event Image -->
			<?php echo $swm_event_list_img; ?>
		</div>

	<?php } ?>

	<!-- Event Meta -->		
	<?php do_action( 'tribe_events_before_the_meta' ) ?>
	<div class="swm-tribe-event-list-meta <?php echo $swm_event_list_meta_width; ?>">		
		<ul>
			<li class="swm_event_list_date"><?php echo $swm_event_list_date; ?></li>
			<li class="swm_event_list_venue"><?php echo $swm_venue_name; ?></li>
			<li class="swm_event_list_location"><?php echo $swm_tribe_get_address.', '.$swm_tribe_get_city.', '.$swm_tribe_get_stateprovince; ?>.</li>
			<li class="swm_event_list_website"><a href="<?php echo $swm_event_website; ?>" title="" target="_blank"><?php echo $swm_event_website; ?></a></li>
					
		</ul>

	</div><!-- .tribe-events-event-meta -->
	<?php do_action( 'tribe_events_after_the_meta' ) ?>

	<div class="clear"></div>

</div>

<div class="swm-tribe-event-list block-right">

<!-- Event Title -->
<?php do_action( 'tribe_events_before_the_event_title' ) ?>
<h2 class="tribe-events-list-event-title summary">
	<a class="url" href="<?php echo tribe_get_event_link() ?>" title="<?php the_title() ?>" rel="bookmark">
		<?php the_title() ?>
	</a>
</h2>
<?php do_action( 'tribe_events_after_the_event_title' ) ?>

<!-- Event Cost -->
<?php if ( tribe_get_cost() ) : ?> 
	<div class="tribe-events-event-cost">
		<span><?php echo tribe_get_cost( null, true ); ?></span>
	</div>
<?php endif; ?>

<!-- Event Content -->
<?php do_action( 'tribe_events_before_the_content' ) ?>
<div class="tribe-events-list-event-description tribe-events-content description entry-summary">
	<?php the_excerpt() ?>
	<a href="<?php echo tribe_get_event_link() ?>" class="tribe-events-read-more" rel="bookmark"><?php echo esc_html__( 'Read more ', 'election' ) ?> <i class="fa fa-chevron-right"></i></a>
</div><!-- .tribe-events-list-event-description -->
<?php do_action( 'tribe_events_after_the_content' ) ?>

</div>

<div class="clear"></div>
