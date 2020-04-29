<?php

/**
 * Enqueue styles
 */
add_action( 'wp_enqueue_scripts', 'custom_child_enqueue_parent_styles' );

function custom_child_enqueue_parent_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

/** 
 * Add parameters for Vimeo embeds
*/
function my_oembed_fetch_url( $provider, $url, $args ) {

	if ( strpos( $provider, 'vimeo.com' ) !== false)  {

		if ( isset( $args['autoplay'] ) ) {
			$provider = add_query_arg( 'autoplay', absint( $args['autoplay'] ), $provider );
			$provider = add_query_arg( 'muted', '1', $provider );
		}
		if ( isset( $args['color'] ) && preg_match( '/^[a-f0-9]{6}$/i', $args['color'] ) ) {
			$provider = add_query_arg( 'color', $args['color'], $provider );
		}
		if ( isset( $args['portrait'] ) ) {
			$provider = add_query_arg( 'portrait', absint( $args['portrait'] ), $provider );
		}
		if ( isset( $args['title'] ) ) {
			$provider = add_query_arg( 'title', absint( $args['title'] ), $provider );
		}
		if ( isset( $args['byline'] ) ) {
			$provider = add_query_arg( 'byline', absint( $args['byline'] ), $provider );
		}
		if ( isset( $args['loop'] ) ) {
			$provider = add_query_arg( 'loop', absint( $args['loop'] ), $provider );
		}
		if ( isset( $args['controls'] ) ) {
			$provider = add_query_arg( 'controls', absint( $args['controls'] ), $provider );
		}
		if ( isset( $args['transparent'] ) ) {
			$provider = add_query_arg( 'transparent', absint( $args['transparent'] ), $provider );
		}

	}

	return $provider;

}

add_filter( 'oembed_fetch_url', 'my_oembed_fetch_url', 10, 3 );

function custom_user_product_purchased($pid) {
    global $product;

    $purchased = 'false';

    $current_user = wp_get_current_user();

    if ( wc_customer_bought_product( $current_user->user_email, $current_user->ID, $pid ) ) {
        $purchased = 'true';
        //echo '<div class="user-bought">&hearts; Hey ' . $current_user->first_name . ', you\'ve purchased this ticket</div>';
    } 
    
    return $purchased;
}