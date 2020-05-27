<?php

/*
carbon fields setup
*/

/*
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'suss_add_custom_fields' );
function suss_add_custom_fields() {
    
    Container::make( 'post_meta', __( 'Video Options' ) )
    ->where( 'post_type', '=', 'videostream' )
    ->add_fields( array(
        Field::make( 'text', '_video_stream_url', 'Video Stream URL' )
        ->set_required( true ),
        Field::make( 'text', '_vimeo_chat_embed', 'Video Chat embed' ),
        Field::make( 'radio', '_archived_video', __( 'Is this video archived?' ) )
        ->set_width(50)
        ->set_options( array(
            0 => 'No',
            1 => 'Yes',
        ) ),
        Field::make( 'date_time', '_event_date', 'Event Date' )
            ->set_attribute( 'placeholder', 'Date and time of event start' )
            ->set_width(50)
            ->set_required( true ),
        Field::make( 'association', '_related_ticket' )
            ->set_types( array(
                array(
                    'type' => 'post',
                    'post_type' => 'product',
                ),
            ) )
            ->set_max( 1 )
            ->set_required( true )
    ) );

}
*/

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

//* Loading editor styles for the block editor (Gutenberg)
function site_block_editor_styles() {
    // google fonts
    //wp_enqueue_style( 'editor-css-fonts', '//fonts.googleapis.com/css?family=Nunito+Sans:400,700,800|Open+Sans:400,700&display=swap' );
    // editor styles
    //wp_enqueue_style( 'suss-editor-style', get_stylesheet_directory_uri().'/assets/css/editor-style-block.css');
}
//add_action( 'enqueue_block_editor_assets', 'site_block_editor_styles' );

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


add_filter( 'tc_singular_nav_next_text' , 'suss_posts_buttons_text' );
add_filter( 'tc_singular_nav_previous_text' , 'suss_posts_buttons_text' );

function suss_posts_buttons_text() {
  switch ( current_filter() ) {
    case 'tc_singular_nav_previous_text':
      return 'previous post &larr;'; // <= your custom text here
    case 'tc_singular_nav_next_text':
      return '&rarr; next post'; // <= your custom text here
  }
}

/*
* Redirect on login or register to program list
*/
function suss_register_redirect( $redirect ) {
    if ( !is_checkout() ) {
        return wc_get_page_permalink( 'videostream' );
    }
}
 
add_filter( 'woocommerce_login_redirect', 'suss_register_redirect' );
add_filter( 'woocommerce_registration_redirect', 'suss_register_redirect' );


//add_filter('pre_get_posts', 'suss_query_post_type');
function suss_query_post_type($query) {
    if (!$query->is_admin) {
        // regular post archives
        if( ( is_category() || is_tag() ) && empty( $query->query_vars['suppress_filters'] ) ) {
            $query->set( 'post_type', array('nav_menu_item', 'post', 'videostream') );
            $query->set( 'post_status', 'publish' );   
            $query->set( 'orderby', 'meta_value' );
            $query->set( 'order', 'ASC' );
            $query->set( 'meta_key', 'event_date' );
            return $query;   

        }
        // CPT archive
        if ( $query->is_main_query() &&  is_post_type_archive( 'videostream' ) ) {
            $query->set( 'post_status', 'publish' );   
            $query->set( 'orderby', 'meta_value' );
            $query->set( 'order', 'ASC' );
            $query->set( 'meta_key', 'event_date' );   
            $query->set( 'category__not_in', array( 1 ) );   
            return $query;
        }
    }
    
}

/**
 * Category archive filters
 */
add_action( 'pre_get_posts', 'custom_post_type_archive' );

function custom_post_type_archive( $query ) {

    if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }

    if( is_post_type_archive( 'videostream' ) ) {
 
        $query->set( 'orderby', 'meta_value' );
        $query->set( 'order', 'ASC' );
        $query->set( 'meta_key', 'event_date' );  
        $query->set( 'category__not_in', array( 1 ) );
        
	} else if ( is_archive() ) {
        
        $query->set( 'post_type', array('nav_menu_item', 'post', 'videostream') );
        //$query->set( 'post_status', 'publish' );   
        $query->set( 'orderby', 'meta_value' );
        $query->set( 'order', 'ASC' );
        $query->set( 'meta_key', 'event_date' );
        
    }

    return $query;   
}


add_action( 'woocommerce_thankyou', 'suss_custom_redirect_after_purchase' );

function suss_custom_redirect_after_purchase( $order_id ){
    $order = wc_get_order( $order_id );
    $url = get_post_type_archive_link( 'videostream' );
    if ( ! $order->has_status( 'failed' ) ) {
        wp_safe_redirect( $url . "#myevents");
        exit;
    }
}

// define the woocommerce_review_order_after_submit callback 
function suss_woocommerce_review_order_after_submit() { 
    echo '<div id="overlay-order" class="hide"><div class="overlay-inner"><img width="16" height="16" src="' . get_stylesheet_directory_uri() . '/assets/images/ajax-loader.gif'. '">Please wait while your order is processed.</div></div>';
}; 
            
// add the action 
add_action( 'woocommerce_review_order_after_submit', 'suss_woocommerce_review_order_after_submit', 10, 0 ); 

/**
 * Redirect to checkout page on add to cart
 * Needs both options for 'add to cart' disabled /wp-admin/admin.php?page=wc-settings&tab=products
 */
add_filter( 'woocommerce_add_to_cart_redirect', 'suss_redirect_checkout_add_cart' );

function suss_redirect_checkout_add_cart() {
   return wc_get_checkout_url();
}

/**
 * Hide stepper for products where 'sold individually' is not checked
 */
function suss_default_no_quantities( $individually, $product ){
    $individually = true;
    return $individually;
}
add_filter( 'woocommerce_is_sold_individually', 'suss_default_no_quantities', 10, 2 );