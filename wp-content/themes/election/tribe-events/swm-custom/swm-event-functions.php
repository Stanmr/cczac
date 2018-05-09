<?php

// Single page event and organizer details, map etc. meta
if( !function_exists('swm_tribe_events_single_event_meta') ) {
	function swm_tribe_events_single_event_meta() {
			$swm_event_id = swm_get_id();
			$skeleton_mode = apply_filters( 'tribe_events_single_event_the_meta_skeleton', false, $swm_event_id ) ;
			$group_venue = apply_filters( 'tribe_events_single_event_the_meta_group_venue', false, $swm_event_id );
			$swm_event_venue_group = swm_event_venue_group();
			$html = '';

			if ( $skeleton_mode ) {

				// show all visible meta_groups in skeleton view
				$html .= tribe_get_the_event_meta();

			} else {
				$html .= '<div class="swm_event_single_meta_row swm_row" id="swm-item-entries">';				

				// Event Details			
				$html .= '<div class="swm_column3">';
				$html .= '<div class="swm_column_gap">';
				$html .= swm_event_single_details();
				$html .= '</div>';
				$html .= '</div>';

				// Organizer Details				
				if ( tribe_has_organizer( $swm_event_id ) ) {				
					$html .= '<div class="swm_column3">';
					$html .= '<div class="swm_column_gap">';	
					$html .= swm_event_multiple_organizer();				
					$html .= '</div>';
					$html .= '</div>';
				}	

				// Event Details			
				$html .= '<div class="swm_column3">';
				$html .= '<div class="swm_column_gap">';
				$html .= $swm_event_venue_group;
				
				$html .= '</div>';
				$html .= '</div>';		
				
				$html .= '</div>';

				$swm_te_venue_map = '';							

				// Event Map
				$swm_te_venue_map .= '<div class="clear"></div><div class="te_venue_map_title">'. esc_html__('VENUE MAP', 'election').'</div>';
				$swm_te_venue_map .= '<div class="te_venue_map_box">';
				$swm_te_venue_map .= tribe_get_embedded_map ( $swm_event_id );
				$swm_te_venue_map .= '</div>';		

				// When there is no map show the venue info up top
				if ( ! $group_venue && ! tribe_embed_google_map( $swm_event_id ) ) {
					// Venue Details
					
					$group_venue = false;
				} else if ( ! $group_venue && ! tribe_has_organizer( $swm_event_id ) && tribe_address_exists( $swm_event_id ) && tribe_embed_google_map( $swm_event_id ) ) {
					// Venue Map with Details
					$html .= $swm_te_venue_map;				
					
					$group_venue = false;
				} else {
					$group_venue = true;
				}
			}

			if ( ! $skeleton_mode && $group_venue ) {

				// Venue Map with Details
				$html .= $swm_te_venue_map;				
				
			}

			$html .= '<div class="clear"></div>';

			$html .= apply_filters( 'tribe_events_single_event_the_meta_addon', '', $swm_event_id );

			return $html;
			
	}
}

add_filter( 'tribe_events_single_event_meta', 'swm_tribe_events_single_event_meta' );


// Event Single Details

if( !function_exists('swm_event_single_details') ) {
	function swm_event_single_details() {

		$organizer_ids = tribe_get_organizer_ids();
		$multiple = count( $organizer_ids ) > 1;
		$swm_tribe_get_organizer_label = tribe_get_organizer_label();
		$output = '';

		$time_format = get_option( 'time_format', Tribe__Date_Utils::TIMEFORMAT );
		$time_range_separator = tribe_get_option( 'timeRangeSeparator', ' - ' );

		$start_datetime = tribe_get_start_date();
		$start_date = tribe_get_start_date( null, false );
		$start_time = tribe_get_start_date( null, false, $time_format );
		$start_ts = tribe_get_start_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );

		$end_datetime = tribe_get_end_date();
		$end_date = tribe_get_display_end_date( null, false );
		$end_time = tribe_get_end_date( null, false, $time_format );
		$end_ts = tribe_get_end_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );

		$time_formatted = null;
		if ( $start_time == $end_time ) {
			$time_formatted = esc_html( $start_time );
		} else {
			$time_formatted = esc_html( $start_time . $time_range_separator . $end_time );
		}

		$event_id = Tribe__Main::post_id_helper();
		$time_formatted = apply_filters( 'tribe_events_single_event_time_formatted', $time_formatted, $event_id );
		$time_title = apply_filters( 'tribe_events_single_event_time_title', esc_html__( 'Time:', 'election' ), $event_id );

		$cost = tribe_get_formatted_cost();
		$website = tribe_get_event_website_link();

		$output .= '<div class="tribe-events-meta-group tribe-events-meta-group-details">
						<h3 class="tribe-events-single-section-title">'.esc_html( 'Details', 'election' ).'</h3>
							<dl>';

		
		do_action( 'tribe_events_single_meta_details_section_start' );

		// All day (multiday) events
		if ( tribe_event_is_all_day() && tribe_event_is_multiday() ) :
			$output .= '<dt>' . esc_html( 'Start:', 'election' ) . '</dt>
			<dd class="swm_event_details_date_top"><abbr class="tribe-events-abbr tribe-events-start-datetime published dtstart" title="'.esc_attr( $start_ts ).'"> '.esc_html( $start_date ).'</abbr></dd>
			<dt>'.esc_html( 'End:', 'election' ).'</dt>
			<dd> <abbr class="tribe-events-abbr dtend" title="'.esc_attr( $end_ts ).' '.esc_html( $end_date ).' </abbr> </dd>';

		// All day (single day) events
		elseif ( tribe_event_is_all_day() ):
			$output .= '<dt>'.esc_html( 'Date:', 'election' ).'</dt>
			<dd class="swm_event_details_date_top"> <abbr class="tribe-events-abbr tribe-events-start-datetime published dtstart" title="'.esc_attr( $start_ts ).'"> '.esc_html( $start_date ).'</abbr> </dd>';

		// Multiday events
		elseif ( tribe_event_is_multiday() ) :
			$output .= '<dt>'.esc_html( 'Start:', 'election' ).'</dt>
			<dd class="swm_event_details_date_top"> <abbr class="tribe-events-abbr updated published dtstart" title="'.esc_attr( $start_ts ).'"> '.esc_html( $start_datetime ).' </abbr> </dd>
			<dt> '.esc_html( 'End:', 'election' ).'</dt>
			<dd> <abbr class="tribe-events-abbr dtend" title="'.esc_attr( $end_ts ).'"> '.esc_html( $end_datetime ).' </abbr> </dd>';

		// Single day events
		else :
			$output .= '<dt>'.esc_html( 'Date:', 'election' ).'</dt>
			<dd class="swm_event_details_date_top"> <abbr class="tribe-events-abbr tribe-events-start-date published dtstart" title="'.esc_attr( $start_ts ).'"> '.esc_html( $start_date ).'</abbr> </dd>
			<dt>'. esc_html( $time_title ).'</dt>
			<dd> <div class="tribe-events-abbr tribe-events-start-time published dtstart" title="'.esc_attr( $end_ts ).'"> '.$time_formatted.'</div> </dd>';

		endif;
		
		// Event Cost
		if ( ! empty( $cost ) ) :
			$output .= '<dt>'.esc_html( 'Cost:', 'election' ).'</dt>
			<dd class="tribe-events-event-cost"> '.esc_html( $cost ).'</dd>';
		endif;
		
		$output .= tribe_get_event_categories(
			get_the_id(), array(
				'before'       => '',
				'sep'          => ', ',
				'after'        => '',
				'label'        => esc_html( 'Categories', 'election' ),
				'label_before' => '<dt>',
				'label_after'  => '</dt>',
				'wrap_before'  => '<dd class="tribe-events-event-categories">',
				'wrap_after'   => '</dd>',
			)
		);
		
		$output .= tribe_meta_event_tags( sprintf( esc_html__( '%s Tags:', 'election' ), tribe_get_event_label_singular() ), ', ', false );

		// Event Website
		if ( ! empty( $website ) ) :
			$output .= '<dt>'.esc_html( 'Website:', 'election' ).'</dt>
			<dd class="tribe-events-event-url">'.$website.'</dd>';
		endif;

		do_action( 'tribe_events_single_meta_details_section_end' );

		$output .= '</dl><div class="clear"></div>';
		$output .= '</div>';

		return $output;	

	}
}




if( !function_exists('swm_event_venue_group') ) {
function swm_event_venue_group() {

	if ( ! tribe_address_exists() ) return;
	$swm_event_phone = tribe_get_phone();
	$swm_event_website = tribe_get_venue_website_link();
	$output = '';	

	$output .= '<div class="tribe-events-meta-group tribe-events-meta-group-venue">';
	$output .= '<h3 class="tribe-events-single-section-title">' . esc_html__('Venue', 'election' ) . '</h3>';
	$output .= '<dl>';
	$output .= '<dd class="author fn org">' . tribe_get_venue() . '</dd>';
	
	// Do we have an address?
	$swm_event_address = tribe_address_exists() ? '<address class="tribe-events-address">' . tribe_get_full_address() . '</address>' : '';

	// Do we have a Google Map link to display?
	$swm_gmap_link = tribe_show_google_map_link() ? tribe_get_map_link_html() : '';
	$swm_gmap_link = apply_filters( 'tribe_event_meta_venue_address_gmap', $swm_gmap_link );

	// Display if appropriate
	if ( ! empty( $swm_event_address ) ) {		
		$output .= '<dd class="location">' . $swm_event_address . ' ' . $swm_gmap_link . '</dd>';
	} 
	
	if ( ! empty( $swm_event_phone ) ) {
		$output .= '<dt>' . esc_html__( 'Phone:', 'election' ) . '</dt>';
		$output .= '<dd class="tel">' . $swm_event_phone . '</dd>';
	}

	if ( ! empty( $swm_event_website ) ) {
		$output .= '<dt>' . esc_html__( 'Website:', 'election' ) . '</dt>';
		$output .= '<dd class="url">' . $swm_event_website . '</dd>';
	}
	
	$output .= '</dl>';
	$output .= '</div>';

	return apply_filters( 'swm_event_venue_group', $output );
	}
}

// Event Organizers

if( !function_exists('swm_event_multiple_organizer') ) {
	function swm_event_multiple_organizer() {

		$organizer_ids = tribe_get_organizer_ids();
		$multiple = count( $organizer_ids ) > 1;
		$output = '';

		$output .= '<div class="tribe-events-meta-group tribe-events-meta-group-details">';
		$output .= '<h3 class="tribe-events-single-section-title">';
		$output .= tribe_get_organizer_label( );
		$output .= '</h3>';

		$output .= '<dl>';			

		foreach ( $organizer_ids as $organizer ) {
			if ( ! $organizer ) {
				continue;
			}

			$phone = tribe_get_organizer_phone( $organizer );
			$email = tribe_get_organizer_email( $organizer );
			$website = tribe_get_organizer_website_link( $organizer );
			
			$output .= '<dd class="fn org">';
			$output .= tribe_get_organizer( $organizer );
			$output .= '</dd>';			

			if ( ! empty( $phone ) ) {
				
				$output .= '<dt>';
				$output .= esc_html( 'Phone:', 'election' );
				$output .= '</dt>';
				$output .= '<dd class="tel">';
				$output .= $phone;
				$output .= '</dd>';
				
			}//end if

			if ( ! empty( $email ) ) {
				
				$output .= '<dt>';
				$output .= esc_html( 'Email:', 'election' );
				$output .= '</dt>';
				$output .= '<dd class="email">';
				$output .= $email;
				$output .= '</dd>';
				
			}//end if

			if ( ! empty( $website ) ) {
				
				$output .= '<dt>';
				$output .= esc_html( 'Website:', 'election' );
				$output .= '</dt>';
				$output .= '<dd class="url">';
				$output .= $website;
				$output .= '</dd>';
				
			}//end if

		}			
				
		$output .= '</dl>';
		$output .= '</div>';

		return $output;	

	}
}