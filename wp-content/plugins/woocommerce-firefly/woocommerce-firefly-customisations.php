<?php
/**
 * Plugin Name: WooCommerce - Firefly customisations
 * Plugin URI: http://www.woocommerce.com/
 * Description: Use this snippet to change functionality within woocommerce outside theme
 * Version: 1.0
 * Author: Firefly
 * Author URI: http://www.fi.net.au/
 * Developer: Firefly
 *
 * Requires at least: 4.6
 * Tested up to: 4.8
 *
 * Copyright: � 2017 Firefly (info@fi.net.au).
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

/**
 * Alters the output of the homepage product categories on the Storefront theme
 * Affects the storefront_product_categories_args filter in /inc/storefront-template-functions.php
 */

function ff_display_all_product_categories( $args ) {

	// Sets the maximum product categories to 50, you can increase this to display more if need be.
	$args['limit'] = 12;
	
	// Displays the child categories in the output as by default only parent categories display.
	$args['child_categories'] = 0;

	// Output
	return $args;

}
add_filter( 'storefront_product_categories_args', 'ff_display_all_product_categories' );

/*
* Adding CSS inline style to an existing CSS stylesheet
*/
function ff_add_inline_css() {
	
	wp_enqueue_style(
		'custom-style',
		get_stylesheet_directory_uri() . '/css/custom.css'
	);
	
	//All the user input CSS settings as set in the plugin settings
	$shop_custom_css = "
	    
	";
  	//Add the above custom CSS via wp_add_inline_style
  	wp_add_inline_style( 'custom-style', $shop_custom_css ); //Pass the variable into the main style sheet ID
}
//add_action( 'wp_enqueue_scripts', 'ff_add_inline_css' ); //Enqueue the CSS style

/**
 * Display category image on category archive
 */
function ff_woocommerce_category_image() {
    if ( is_product_category() ){
	    global $wp_query;
	    $cat = $wp_query->get_queried_object();
	    $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
	    //$image = wp_get_attachment_url( $thumbnail_id );
	    $image = wp_get_attachment_image_url($thumbnail_id, 'category-image'); 
	    if ( $image ) {
		    echo '<p id="category-image"><img src="' . $image . '" alt="' . $cat->name . '" /></p>';
		}
	}
}
//add_action( 'woocommerce_archive_description', 'ff_woocommerce_category_image', 2 );

/**
 * Change empty price label.
 **/

function ff_custom_call_for_price() {
     return '';
}

add_filter('woocommerce_empty_price_html', 'ff_custom_call_for_price');

add_filter( 'woocommerce_get_price_html', 'ff_price_free_zero_empty', 100, 2 );
   
function ff_price_free_zero_empty( $price, $product ){
    if ( '' === $product->get_price() || 0 == $product->get_price() ) {
        $price = '<span class="woocommerce-Price-amount amount">FREE</span>';
    }  
    return $price;
}

// Hide most reviewed products
remove_action( 'homepage', 'storefront_popular_products', 10 );

// add image size for categories
//add_image_size( 'category-image', 1200, 600, true );

// Hide COMPANY field on checkout
//add_filter( 'woocommerce_checkout_fields' , 'ff_override_checkout_fields' );
 
function ff_override_checkout_fields( $fields ) {
	unset($fields['billing']['billing_company']);
	return $fields;
}

/**
 * Auto Complete all WooCommerce orders.
 */
add_action( 'woocommerce_thankyou', 'custom_woocommerce_auto_complete_order' );
function custom_woocommerce_auto_complete_order( $order_id ) { 
    if ( ! $order_id ) {
        return;
    }

    $order = wc_get_order( $order_id );
    $order->update_status( 'completed' );
}

/**
 * Change the default state and country on the checkout page
 */
add_filter( 'default_checkout_billing_country', 'change_default_checkout_country' );
//add_filter( 'default_checkout_billing_state', 'change_default_checkout_state' );

function change_default_checkout_country() {
  return 'AU'; // country code
}

function change_default_checkout_state() {
  return 'NSW'; // state code
}

// Change add to cart text on archives depending on product type
add_filter( 'woocommerce_product_add_to_cart_text' , 'custom_woocommerce_product_add_to_cart_text' );
add_filter( 'woocommerce_product_single_add_to_cart_text' , 'custom_woocommerce_product_add_to_cart_text' );

function custom_woocommerce_product_add_to_cart_text() {
	global $product;
	
	$product_type = $product->get_type();
	
	if ( is_product() ) {
		switch ( $product_type ) {
			case 'external':
				return __( 'Purchase', 'woocommerce' );
			break;
			case 'grouped':
				return __( 'View', 'woocommerce' );
			break;
			case 'simple':
				return __( 'Reserve Ticket', 'woocommerce' );
			break;
			case 'variable':
				return __( 'Reserve Ticket', 'woocommerce' );
			break;
			default:
				return __( 'View', 'woocommerce' );
		}
	} else{
		return __( 'View', 'woocommerce' );
	}
	
}