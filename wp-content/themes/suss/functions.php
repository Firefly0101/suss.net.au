<?php

/**
 * Enqueue styles
 */
add_action( 'wp_enqueue_scripts', 'custom_child_enqueue_parent_styles' );

function custom_child_enqueue_parent_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );

    wp_enqueue_style( 'css-suss', get_stylesheet_directory_uri() . '/assets/css/style.css' );
    wp_enqueue_script( 'js-suss', get_stylesheet_directory_uri() . '/assets/js/custom.js', array(), '1.0.0', true );    
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


function dashboard_get_customer_orders() {
    
    // Get all customer orders
    $customer_orders = get_posts( array(
        'numberposts' => -1,
        'meta_key'    => '_customer_user',
        'meta_value'  => get_current_user_id(),
        'post_type'   => wc_get_order_types(),
        'post_status' => array_keys( wc_get_order_statuses() ),
    ) );
    
    $customer = wp_get_current_user();
    
    // Order count for a "loyal" customer
    $loyal_count = 5;
    
    // get order total
    $order_total = count( $customer_orders );

    
    echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
    
    // Display our notice if the customer has at least 5 orders
    if ( $order_total >= 1 ) {
        echo '<h3>Your Events</h3>';
        echo '<a href="' . get_post_type_archive_link( 'videostream' ). '#myevents">View your events</a>';
    } 
}
add_action( 'woocommerce_before_my_account', 'dashboard_get_customer_orders' );