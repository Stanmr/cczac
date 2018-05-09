<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 * 
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @since  2.1
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); }

$swm_event_id = swm_get_id();


?>

<div id="tribe-events-content" class="tribe-events-single">	

	<!-- Notices -->
	<?php tribe_the_notices(); ?>

	<?php while ( have_posts() ) :  the_post(); 
		$swm_venue_name = wp_strip_all_tags( tribe_get_venue() );
	?>
		
		<div id="post-<?php the_ID(); ?>" <?php post_class('vevent'); ?>>

			<div class="swm_te_single_title_meta_section">				
				<div class="swm_te_single_meta">
					<ul class="swm_row" id="swm-item-entries">
						<li class="swm_column4">
							<div class="swm_column_gap">
								<div class="swm_te_meta_bar">
									<span class="event_bar_icon"><i class="fa fa-calendar"></i></span>
									<p><span><?php echo esc_html__('START', 'election'); ?></span><?php echo tribe_get_start_date($event = null, $displayTime = true, $dateFormat = 'M jS - g:ia'); ?></p>
								</div>
								<div class="clear"></div>								
							</div>
						</li>
						<li class="swm_column4">
							<div class="swm_column_gap"> 
								<div class="swm_te_meta_bar">
									<span class="event_bar_icon"><i class="fa fa-clock-o"></i></span>
									<p><span><?php echo esc_html__('END', 'election'); ?></span><?php echo tribe_get_end_date($event = null, $displayTime = true, $dateFormat = 'M jS - g:ia'); ?></p>
								</div>	
								<div class="clear"></div>							
							</div>
						</li>
						<li class="swm_column4">
							<div class="swm_column_gap">
								<div class="swm_te_meta_bar">
									<span class="event_bar_icon"><i class="fa fa-map-marker"></i></span>
									<p class="venuefix"><span><?php echo esc_html__('VENUE', 'election'); ?></span><?php echo $swm_venue_name; ?></p>
								</div>	
								<div class="clear"></div>							
							</div>
						</li>
						<?php if ( tribe_get_cost() ) { ?>
							<li class="swm_column4">
								<div class="swm_column_gap">
									<div class="swm_te_meta_bar">
										<span class="event_bar_icon"><i class="fa fa-ticket"></i></span>
										<p><span><?php echo esc_html__('TICKET PRICE', 'election'); ?></span><?php if ( tribe_get_cost() ) { echo tribe_get_cost( null, true ); }?></p>
									</div>	
									<div class="clear"></div>							
								</div>
							</li>
						<?php } ?>
					</ul>				
				</div>	
				<div class="clear"></div>

				<div class="swm_te_single_image">
					<!-- Event featured image -->
					<?php echo tribe_event_featured_image(); ?>					
				</div>

				<div class="clear"></div>
			

			</div>	

			<div class="swm_te_single_title">
				<?php the_title( '<h2>', '</h2>' ); ?>					
			</div>		

			<!-- Event content -->
			<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
			<div class="tribe-events-single-event-description tribe-events-content entry-content description">
				<?php the_content(); ?>
			</div><!-- .tribe-events-single-event-description -->
			<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>			

			<!-- Event meta -->
			<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
				<?php echo swm_tribe_events_single_event_meta(); ?>
			<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
			</div><!-- .hentry .vevent -->
		<?php if( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
	<?php endwhile; ?>

	<!-- Event footer -->
    <div id="tribe-events-footer">
		<!-- Navigation -->
		<!-- Navigation -->
		<h3 class="tribe-events-visuallyhidden"><?php echo esc_html__( 'Event Navigation', 'election' ) ?></h3>
		<ul class="tribe-events-sub-nav">
			<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
			<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
		</ul><!-- .tribe-events-sub-nav -->
	</div><!-- #tribe-events-footer -->

	

</div><!-- #tribe-events-content -->