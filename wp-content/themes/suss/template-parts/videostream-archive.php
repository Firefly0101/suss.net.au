<?php
/**
 * Displays the content for Videostream Archives
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>

<?php
	$archive_title    = '';
	$archive_subtitle = '';

	if ( is_search() ) {
		global $wp_query;

		$archive_title = sprintf(
			'%1$s %2$s',
			'<span class="color-accent">' . __( 'Search:', 'twentytwenty' ) . '</span>',
			'&ldquo;' . get_search_query() . '&rdquo;'
		);

		if ( $wp_query->found_posts ) {
			$archive_subtitle = sprintf(
				/* translators: %s: Number of search results. */
				_n(
					'We found %s result for your search.',
					'We found %s results for your search.',
					$wp_query->found_posts,
					'twentytwenty'
				),
				number_format_i18n( $wp_query->found_posts )
			);
		} else {
			$archive_subtitle = __( 'We could not find any results for your search. You can give it another try through the search form below.', 'twentytwenty' );
		}
	} elseif ( ! is_home() ) {
		$archive_title    = get_the_archive_title();
		$archive_subtitle = get_the_archive_description();
	}

	if ( $archive_title || $archive_subtitle ) {
		?>

		<header class="archive-header has-text-align-center header-footf<hr
		er-group">

			<div class="archive-header-inner section-inner medium">

				<?php if ( $archive_title ) { ?>
					<h1 class="archive-title"><?php echo wp_kses_post( $archive_title ); ?></h1>
				<?php } ?>
								
			</div><!-- .archive-header-inner -->

		</header><!-- .archive-header -->

		<?php
	}
	
	if ( have_posts() ) {

		echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
		echo '<div class="wp-block-buttons has-text-align-center"><div id="has_tickets" class="wp-block-button is-style-outline"><a href="#" onclick="show_events(true); return false;" class="wp-block-button__link">My events</a></div><div id="all_tickets" class="wp-block-button"><a href="#" onclick="show_events(false); return false;" class="wp-block-button__link">All events</a></div></div>';
		//echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
		echo '<div id="user-message"><span class="loggedin">You have no active events.</span> <span class="loggedout">Please <a href="' . get_permalink( get_option('woocommerce_myaccount_page_id') ) . '">login</a> to see if you have any active events.</span></div>';

		$i = 0;

		echo '<div class="article-wrapper">';

		while ( have_posts() ) {
			$i++;
			$tickets = 0;
			if ( $i > 1 ) {
				//echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
			}
			the_post();

			$relatedTicket	= CFS()->get( 'related_ticket', get_the_ID() );
			$relatedTicket = $relatedTicket[0]; // get item ID
			$productURL = get_permalink( $relatedTicket );

			$current_user = wp_get_current_user();
			$msg = custom_user_product_purchased($relatedTicket);
			
			$eventDate	= CFS()->get( 'event_date', get_the_ID() );
			$eventHour	= CFS()->get( 'event_hour', get_the_ID() );
			$eventMin	= CFS()->get( 'event_minutes', get_the_ID() );

			if (empty($eventMin) || $eventMin == 0) {
				$eventMin = '00';
			}

			echo '<article' . (($msg=="true")?' class="has_ticket"' : ' class="no_ticket"') . '>';
			
			include( locate_template( 'template-parts/entry-header.php', false, false ) ); 
			//get_template_part( 'template-parts/entry-header' );
			
			//if ( ! is_search() ) {
				
				get_template_part( 'template-parts/featured-image' );
				
			//}
			if ($msg == 'true'){
				$tickets ++;
				echo '<div class="badge-purchased">&hearts; Watch</div>';
			} else {
				echo '<div class="badge-buy"><a href="'. $productURL .'">&hearts; Get ticket</a></div>';
			}
			if (!empty($eventDate) && !empty($eventHour)){
				$date = new DateTime($eventDate . ' ' . $eventHour . ':' . $eventMin .':00');
 
				//Convert it into the 12 hour time using the format method.
				echo '<div class="event-date'. (($msg == "true")? ' has-ticket' : ' no-ticket') . '">' . $date->format('D jS M Y g:ia')  . '</div>';
			}
			//get_template_part( 'template-parts/content' , get_post_type() );
			
			echo '</article>';
		}
		echo '</div>'; // end article-wrapper		

	} else {
		?>

		<div class="no-search-results-form section-inner thin">

			<?php
			get_search_form(
				array(
					'label' => __( 'search again', 'twentytwenty' ),
				)
			);
			?>

		</div><!-- .no-search-results -->

		<?php
		}
		?>