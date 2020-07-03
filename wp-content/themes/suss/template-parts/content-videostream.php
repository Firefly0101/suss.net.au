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
		// On the cover page template, output the cover header.
		$cover_header_style   = '';
		$cover_header_classes = '';

		$color_overlay_style   = '';
		$color_overlay_classes = '';

		$image_url = get_stylesheet_directory_uri() . '/assets/images/video-bg.jpg';

		if ( $image_url ) {
			$cover_header_style   = ' style="background-image: url( ' . esc_url( $image_url ) . ' );"';
			$cover_header_classes = ' bg-image';
		}

		// Get the color used for the color overlay.
		$color_overlay_color = get_theme_mod( 'cover_template_overlay_background_color' );
		if ( $color_overlay_color ) {
			$color_overlay_style = ' style="color: ' . esc_attr( $color_overlay_color ) . ';"';
		} else {
			$color_overlay_style = '';
		}

		// Get the fixed background attachment option.
		if ( get_theme_mod( 'cover_template_fixed_background', true ) ) {
			$cover_header_classes .= ' bg-attachment-fixed';
		}

		// Get the opacity of the color overlay.
		$color_overlay_opacity  = get_theme_mod( 'cover_template_overlay_opacity' );
		$color_overlay_opacity  = ( false === $color_overlay_opacity ) ? 80 : $color_overlay_opacity;
		$color_overlay_classes .= ' opacity-' . $color_overlay_opacity;
		
		// INIT Video and User
		$relatedTicket	= CFS()->get( 'related_ticket', get_the_ID() );
		$relatedTicket = $relatedTicket[0]; // get item ID
		
		$hasVideo = CFS()->get( 'video_stream_url', get_the_ID() );
		$hasLiveChat = CFS()->get( 'vimeo_chat_embed', get_the_ID() );

		// video options
		$isAutoplay 	= false;
		$isMuted		= false;
		$isControls 	= true;
		$isLoop 		= false;
		$isTransparent 	= true; 

		$productURL = get_permalink( $relatedTicket );
		$msg = 'no-session';

		if ( is_user_logged_in() ) {
			$msg = custom_user_product_purchased($relatedTicket);
			$current_user = wp_get_current_user();
		} 

		$videoClass = '';

		if (!empty($hasVideo && $msg == 'true') ) {
			$videoClass = 'hasVideo';
		} 
	?>

	<div class="cover-header <?php echo $cover_header_classes; ?>"<?php echo $cover_header_style;  ?>>
		<div class="cover-header-inner-wrapper screen-height <?php echo $videoClass; ?>">
			<div class="cover-header-inner">
				<div class="cover-color-overlay color-accent<?php echo esc_attr( $color_overlay_classes ); ?>"<?php echo $color_overlay_style; ?>></div>

					<header class="entry-header has-text-align-center">
					<div class="post-inner <?php echo is_page_template( 'templates/template-full-width.php' ) ? '' : 'thin'; ?> ">

						
						<div class="entry-content">

							<?php

								
								if (!empty($hasVideo) && wp_http_validate_url($hasVideo)==true) {

									echo '<div class="isVideo ' . ($hasLiveChat ? 'hasChat' : '') . '">';

									switch($msg){
										case 'true':
											// show embed
											// start video wrapper
											echo '<div id="cover-video">';
											//echo wp_oembed_get( $hasVideo, array( 'controls' => $isControls , 'transparent'=> $isTransparent, 'loop'=> $isLoop, 'autoplay' => false, 'color' => 'ffffff',  'title' => false, 'byline' => false ) );
											
											echo wp_oembed_get( $hasVideo );
											
											// end video wrapper
											echo '</div>';
											break;

										case 'false':
											// show link to register
											echo '<p class="has-text-align-center">&hearts; Hey ' . $current_user->first_name . ', to watch this stream please reserve a ticket.</p>';

											echo '<div class="wp-block-buttons has-text-align-center"><div class="wp-block-button reversed"><a href="' . $productURL . '" class="wp-block-button__link">Reserve Ticket</a></div></div>';
											break;
										case 'no-session':
											echo '<div class="wp-block-buttons has-text-align-center"><p>If you are already a subscriber, please login to check if you have a ticket for this event.</p><div class="wp-block-button reversed is-style-outline"><a href="' . $productURL . '" class="wp-block-button__link">Reserve a Ticket</a></div>
										<div class="wp-block-button reversed"><a href="'. wp_login_url(get_permalink(get_the_ID())) .'" class="wp-block-button__link">Subscriber Login</a></div></div>';
											break;
										
										default:
											echo 'Oops, something has gone wrong.';
											
									}
								}
								
								if (!empty($hasLiveChat) && $msg == 'true') {
									echo '<div id="chat">';
									echo '<h3 class="chat-heading has-text-align-center"><span>Live chat</span> <span> <a onclick="toggleChat(); return false;" class="chat-show" href="#">open &Downarrow;</a> <a onclick="toggleChat(); return false;" class="chat-hide" href="#">close &Uparrow;</a></span></h3>';
									echo '';
									echo '<div class="chat-wrapper">';
									
									echo $hasLiveChat;
									echo '</div>';
									echo '</div>';
								}
								//the_title( '<h1 class="entry-title">', '</h1>' );
								
								//the_content( __( 'Continue reading', 'twentytwenty' ) );
								
							?>

						</div><!-- .entry-content -->

						<?php 
							
						?>

					</div><!-- .post-inner -->
					</header><!-- .entry-header -->

				</div><!-- .cover-header-inner -->
			</div><!-- .cover-header-inner-wrapper -->
	</div><!-- .cover-header -->

	<div class="section-inner">
		<?php

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

		//get_template_part( 'template-parts/navigation' );

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
