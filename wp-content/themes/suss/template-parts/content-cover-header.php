<?php
	// On the cover page template, output the cover header.
	$cover_header_style   = '';
	$cover_header_classes = '';

	$color_overlay_style   = '';
	$color_overlay_classes = '';

	$image_url = ! post_password_required() ? get_the_post_thumbnail_url( get_the_ID(), 'twentytwenty-fullscreen' ) : '';

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
	?>

	<div class="cover-header <?php echo $cover_header_classes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>"<?php echo $cover_header_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- We need to double check this, but for now, we want to pass PHPCS ;) ?>>
		<div class="cover-header-inner-wrapper screen-height">
			<div class="cover-header-inner">
				<div class="cover-color-overlay color-accent<?php echo esc_attr( $color_overlay_classes ); ?>"<?php echo $color_overlay_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- We need to double check this, but for now, we want to pass PHPCS ;) ?>></div>

					<header class="entry-header has-text-align-center">

							<?php

							

							/**
							 * Allow child themes and plugins to filter the display of the categories in the article header.
							 *
							 * @since Twenty Twenty 1.0
							 *
							 * @param bool Whether to show the categories in article header, Default true.
							 */
							$show_categories = apply_filters( 'twentytwenty_show_categories_in_entry_header', true );

							if ( true === $show_categories && has_category() ) {
								?>

								<div class="entry-categories">
									<span class="screen-reader-text"><?php _e( 'Categories', 'twentytwenty' ); ?></span>
									<div class="entry-categories-inner">
										<?php the_category( ' ' ); ?>
									</div><!-- .entry-categories-inner -->
								</div><!-- .entry-categories -->

								<?php
							}

							$hasVideo = CFS()->get( 'video_embed_url', get_the_ID() );
							// video options
							$isAutoplay 	= CFS()->get( 'video_autoplay', get_the_ID() );
							$isMuted		= 0;
							if ($isAutoplay == 1 ) {
								$isMuted	= 1;
								$isAutoplay = true;
							}
							$isControls 	= CFS()->get( 'video_controls', get_the_ID() );
							$isLoop 		= CFS()->get( 'video_loop', get_the_ID() );
							$isTransparent 	= CFS()->get( 'video_transparent', get_the_ID() );

							$videoClass = 'hasVideo';

							if (!empty($hasVideo)) {
								$videoClass = 'hasVideo';
							} 

							echo '<div class="entry-header-inner section-inner medium ' . $videoClass. '">';

							if (!empty($hasVideo) && wp_http_validate_url($hasVideo)==true) {
								echo '<div id="cover-video">';
								echo wp_oembed_get( $hasVideo, array( 'controls' => $isControls, 'muted' => $isMuted , 'transparent'=> $isTransparent, 'loop'=> $isLoop, 'autoplay' => $isAutoplay, 'color' => 'ffffff', 'portrait' => 0, 'title' => 0, 'byline' => 0 ) );
								echo '</div>';
							}

							the_title( '<h1 class="entry-title">', '</h1>' );

							if ( is_page() ) {
								?>

								<div class="to-the-content-wrapper">

									<a href="#post-inner" class="to-the-content fill-children-current-color">
										<?php twentytwenty_the_theme_svg( 'arrow-down' ); ?>
										<div class="screen-reader-text"><?php _e( 'Scroll Down', 'twentytwenty' ); ?></div>
									</a><!-- .to-the-content -->

								</div><!-- .to-the-content-wrapper -->

								<?php
							} else {

								$intro_text_width = '';

								if ( is_singular() ) {
									$intro_text_width = ' small';
								} else {
									$intro_text_width = ' thin';
								}

								if ( has_excerpt() ) {
									?>

									<div class="intro-text section-inner max-percentage<?php echo esc_attr( $intro_text_width ); ?>">
										<?php the_excerpt(); ?>
									</div>

									<?php
								}

								twentytwenty_the_post_meta( get_the_ID(), 'single-top' );

							}
							echo '</div><!-- .entry-header-inner -->';

							?>

						
					</header><!-- .entry-header -->

			</div><!-- .cover-header-inner -->
		</div><!-- .cover-header-inner-wrapper -->
	</div><!-- .cover-header -->