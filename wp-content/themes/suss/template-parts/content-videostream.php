<?php
/**
 * The template for displaying videostream content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php

	get_template_part( 'template-parts/entry-header' );

	if ( ! is_search() ) {
		// get_template_part( 'template-parts/featured-image' );
	}

	?>

	<div class="post-inner <?php echo is_page_template( 'templates/template-full-width.php' ) ? '' : 'thin'; ?> ">

		<div class="entry-content">

			<?php

				$relatedTicket	= CFS()->get( 'related_ticket', get_the_ID() );
				$relatedTicket = $relatedTicket[0]; // get item ID
				
				$hasVideo = CFS()->get( 'video_stream_url', get_the_ID() );

				// video options
				$isAutoplay 	= false;
				$isMuted		= 0;
				$isControls 	= 1;
				$isLoop 		= 0;
				$isTransparent 	= 1; 

				$productURL = get_permalink( $relatedTicket );
				$msg = 'no-session';

				if ( is_user_logged_in() ) {
					$msg = custom_user_product_purchased($relatedTicket);
					$current_user = wp_get_current_user();
				} 

				if (!empty($hasVideo) && wp_http_validate_url($hasVideo)==true) {
					switch($msg){
						case 'true':
							// show embed
							// start video wrapper
							echo '<div id="cover-video">';
							echo wp_oembed_get( $hasVideo, array( 'controls' => $isControls, 'muted' => $isMuted , 'transparent'=> $isTransparent, 'loop'=> $isLoop, 'autoplay' => $isAutoplay, 'color' => 'ffffff', 'portrait' => 0, 'title' => 0, 'byline' => 0 ) );
							// end video wrapper
							echo '</div>';
							break;
	
						case 'false':
							// show link to register
							echo '<p class="has-text-align-center">&hearts; Hey ' . $current_user->first_name . ', to watch this stream please reserve a ticket.</p>';

							echo '<div class="wp-block-buttons has-text-align-center"><div class="wp-block-button"><a href="' . $productURL . '" class="wp-block-button__link">Reserve Ticket</a></div></div>';
							break;
						case 'no-session':
							echo '<div class="wp-block-buttons has-text-align-center"><p>If you are already a subscriber, please login to check if you have a ticket for this event.</p><div class="wp-block-button is-style-outline"><a href="' . $productURL . '" class="wp-block-button__link">Reserve a Ticket</a></div>
						<div class="wp-block-button"><a href="'. wp_login_url(get_permalink(get_the_ID())) .'" class="wp-block-button__link">Subscriber Login</a></div></div>';
							break;
						
						default:
							echo 'oops';
							
					}
				}
				
				
				the_content( __( 'Continue reading', 'twentytwenty' ) );
				
			?>

		</div><!-- .entry-content -->

	</div><!-- .post-inner -->

	<div class="section-inner">
		<?php
		wp_link_pages(
			array(
				'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__( 'Page', 'twentytwenty' ) . '"><span class="label">' . __( 'Pages:', 'twentytwenty' ) . '</span>',
				'after'       => '</nav>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);

		if (is_single()) {
			edit_post_link();
		}

		// Single bottom post meta.
		twentytwenty_the_post_meta( get_the_ID(), 'single-bottom' );

		if ( is_single() ) {

			get_template_part( 'template-parts/entry-author-bio' );

		}
		?>

	</div><!-- .section-inner -->

	<?php

	if ( is_single() ) {

		get_template_part( 'template-parts/navigation' );

	}

	/**
	 *  Output comments wrapper if it's a post, or if comments are open,
	 * or if there's a comment number – and check for password.
	 * */
	if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() && $msg == 'true' ) {
		?>

		<div class="comments-wrapper section-inner">

			<?php comments_template(); ?>

		</div><!-- .comments-wrapper -->

		<?php
	}
	?>

</article><!-- .post -->
