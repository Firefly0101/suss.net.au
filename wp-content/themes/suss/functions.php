<?php

/**
 * Enqueue styles
 */
add_action( 'wp_enqueue_scripts', 'custom_child_enqueue_parent_styles' );

function custom_child_enqueue_parent_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );

    // google fonts
    wp_enqueue_style( 'css-fonts', '//fonts.googleapis.com/css?family=Nunito+Sans:400,700,800|Open+Sans:400,700&display=swap' );

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

    
    echo '<hr class="post-separator styled-separator is-style-wide section-inner ml-0 mr-0 w-100 aria-hidden="true" />';
    
    echo '<div class="has-text-align-left">';
    echo '<h4 class="mb-1">View events</h4>';
    //echo '<p><a href="' . get_post_type_archive_link( 'videostream' ). '">View all events</a></p>';

    echo '<div class="wp-block-buttons has-text-align-left">';
    if ( $order_total >= 1 ) {
        echo '<div id="has_tickets" class="mt-1 wp-block-button is-style-outline"><a href="' . get_post_type_archive_link( 'videostream' ). '#myevents" class="wp-block-button__link">My events</a></div>';
    }
    echo '<div id="all_tickets" class="mt-1 wp-block-button"><a href="' . get_post_type_archive_link( 'videostream' ) . '" class="wp-block-button__link">All events</a></div>
    </div>';

    echo '</div>';    
        
}
add_action( 'woocommerce_before_my_account', 'dashboard_get_customer_orders' );


function suss_set_mycomment_title( $defaults ){
 $defaults['title_reply'] = __('Add a comment', 'suss-child');
 return $defaults;
}
add_filter('comment_form_defaults', 'suss_set_mycomment_title', 20);
