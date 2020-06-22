<?php
/**
 * Plugin Name: WooCommerce - Firefly customisations
 * Plugin URI: http://www.woocommerce.com/
 * Description: Use this snippet to change functionality within woocommerce outside theme
 * Version: 1.0.1
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
 * Hide stepper for products where 'sold individually' is not checked
 */
function suss_default_no_quantities( $individually, $product ){
    $individually = true;
    return $individually;
}
add_filter( 'woocommerce_is_sold_individually', 'suss_default_no_quantities', 10, 2 );


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


/**
* Add new register fields for WooCommerce registration.
*
* @return string Register fields HTML.
*/

function suss_extra_register_fields() {	
	
	$first_name = '';
	if (!empty($_POST['billing_first_name'])){
		$first_name = esc_attr_e($_POST['billing_first_name']);
	}
	$last_name = '';
	if (!empty($_POST['billing_last_name'])){
		$last_name = esc_attr_e($_POST['billing_last_name']);
	}
	$phone = '';
	if (!empty($_POST['billing_phone'])){
		$phone = esc_attr_e($_POST['billing_phone']);
	}
	/*
	$address_1 = '';
	if (!empty($_POST['billing_address_1'])){
		$first_name = esc_attr_e($_POST['billing_address_1']);
	}
	*/
	$city = '';
	if (!empty($_POST['billing_city'])){
		$first_name = esc_attr_e($_POST['billing_city']);
	}
	$postcode = '';
	if (!empty($_POST['billing_postcode'])){
		$first_name = esc_attr_e($_POST['billing_postcode']);
	}

	?>
	<p class="form-row form-row-first">
		<label for="billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?><span class="required">*</span></label>
		<input type="text" class="input-text" name="billing_first_name" id="billing_first_name" value="<?php $first_name ?>" placeholder="Firstname" required />
	</p>
	<p class="form-row form-row-last">
		<label for="billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?><span class="required">*</span></label>
		<input type="text" class="input-text" name="billing_last_name" id="billing_last_name" value="<?php $last_name ?>" placeholder="Lastname" required />
	</p>
	<p class="form-row form-row-wide">
		<label for="billing_phone"><?php _e( 'Mobile', 'woocommerce' ); ?><span class="required">*</span></label>
		<input type="tel" class="input-text" name="billing_phone" id="billing_phone" value="<?php $phone ?>" placeholder="0400123123" minlength="10" maxlength="10" required pattern="[0-9]{10}"/>
	</p>
	<!--
	<p class="form-row form-row-wide">
		<label for="billing_address_1"><?php _e( 'Address', 'woocommerce' ); ?></label>
		<input type="text" class="input-text" name="billing_address_1" id="billing_address_1" value="<?php $billing_address_1 ?>" />
	</p>
	-->

	<p class="form-row form-row-first">
		<label for="billing_city"><?php _e( 'Town / City', 'woocommerce' ); ?></label>
		<input type="text" class="input-text" name="billing_city" id="billing_city" value="<?php $city ?>" />
	</p>
	<p class="form-row form-row-last">
		<label for="billing_postcode"><?php _e( 'Postcode', 'woocommerce' ); ?><span class="required">*</span></label>
		<input type="text" class="input-text" name="billing_postcode" id="billing_postcode" value="<?php $postcode ?>" placeholder="1234" required />
	</p>

		<?php
			// init country fields
			wp_enqueue_script('wc-country-select');
			woocommerce_form_field('billing_country',array(
				'type'        => 'country',
				'class'       => array('suss-country-drop form-row form-row-first'),
				'label'       => __('Country'),
				'placeholder' => __('Choose your country.'),
				'required'    => true,
				'clear'       => true,
				'default'     => 'AU'
			));

			// init state fields
			woocommerce_form_field('billing_state',array(
				'type'        => 'state',
				'class'       => array('suss-state-drop form-row form-row-last'),
				'label'       => __('State'),
				'placeholder' => __('Choose your state.'),
				'required'    => true,
				'default'     => '',
			));

			do_action('edit_user_avatar');
		?>

	<div class="clear"></div>
	<?php
}
add_action( 'woocommerce_register_form_start', 'suss_extra_register_fields' );

/**
* Save the extra register fields.
* @param string $customer_id	Current user ID.
*/

function suss_save_extra_register_fields( $customer_id ) {
    if ( isset( $_POST['billing_phone'] ) ) {
		// Phone input filed which is used in WooCommerce
		update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
	}
	if ( isset( $_POST['billing_first_name'] ) ) {
		//First name field which is by default
		update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
		// First name field which is used in WooCommerce
		update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
	}
	if ( isset( $_POST['billing_last_name'] ) ) {
		// Last name field which is by default
		update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
		// Last name field which is used in WooCommerce
		update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
	}

	// ADDRESS DETAILS
	if ( isset( $_POST['billing_address_1'] ) ) {
		update_user_meta( $customer_id, 'billing_address_1', sanitize_text_field( $_POST['billing_address_1'] ) );
	}

	if ( isset( $_POST['billing_city'] ) ) {
		update_user_meta( $customer_id, 'billing_city', sanitize_text_field( $_POST['billing_city'] ) );
	}
	if ( isset( $_POST['billing_postcode'] ) ) {
		update_user_meta( $customer_id, 'billing_postcode', sanitize_text_field( $_POST['billing_postcode'] ) );
	}

	if ( isset( $_POST['billing_state'] ) ) {
		update_user_meta( $customer_id, 'billing_state', sanitize_text_field( $_POST['billing_state'] ) );
	}
	if ( isset( $_POST['billing_country'] ) ) {
		update_user_meta( $customer_id, 'billing_country', sanitize_text_field( $_POST['billing_country'] ) );
	}
}
add_action( 'woocommerce_created_customer', 'suss_save_extra_register_fields' );

/*
* Reduce the strength requirement for woocommerce registration password.
* Strength Settings:
* 0 = Nothing = Anything
* 1 = Weak
* 2 = Medium
* 3 = Strong (default)
*/

add_filter( 'woocommerce_min_password_strength', 'wpglorify_woocommerce_password_filter', 10 );

function wpglorify_woocommerce_password_filter() {
	return 1; // medium strength password
} 

/**
 * CHECKOUT OVERLAY 
 */
// define the woocommerce_review_order_after_submit callback 
function suss_woocommerce_review_order_after_submit() { 
    echo '<div id="overlay-order" class="hide"><div class="overlay-inner"><img width="16" height="16" src="' . get_stylesheet_directory_uri() . '/assets/images/ajax-loader.gif'. '">Please wait while your order is processed.</div></div>';
}; 
            
// add the action 
add_action( 'woocommerce_review_order_after_submit', 'suss_woocommerce_review_order_after_submit', 10, 0 ); 

/**
 * REDIRECT to checkout page on add to cart
 * Needs both options for 'add to cart' disabled /wp-admin/admin.php?page=wc-settings&tab=products
 */
add_filter( 'woocommerce_add_to_cart_redirect', 'suss_redirect_checkout_add_cart' );

function suss_redirect_checkout_add_cart() {
   return wc_get_checkout_url();
}

/*
* Redirect on login to program list
*/
function suss_login_redirect( $redirect ) {
    if ( !is_checkout() ) {
        return home_url('/videostream');
    }
}
 
add_filter( 'woocommerce_login_redirect', 'suss_login_redirect' );
//add_filter( 'woocommerce_registration_redirect', 'suss_register_redirect' );


function suss_registration_redirect( $redirect_to ) {     // prevents the user from logging in automatically after registering their account
	wp_logout();
    //wp_redirect( '/verify/?n=');               // redirects to a confirmation message
    return '/verify/?n=';                        // redirects to a confirmation message
    //exit;
}

function suss_authenticate_user( $userdata ) {            // when the user logs in, checks whether their email is verified
    $has_activation_status = get_user_meta($userdata->ID, 'is_activated', false);
    if ($has_activation_status) {                           // checks if this is an older account without activation status; skips the rest of the function if it is
        $isActivated = get_user_meta($userdata->ID, 'is_activated', true);
        if ( !$isActivated ) {
            suss_user_register( $userdata->ID );              // resends the activation mail if the account is not activated
            $userdata = new WP_Error(
                'my_theme_confirmation_error',
                __( '<p><strong>Error:</strong> Your account has to be activated before you can login. Please click the link in the activation email that has been sent to you.<br /> If you do not receive the activation email within a few minutes, check your spam folder or <a href="/verify/?u='.$userdata->ID.'">click here to resend it</a>.</p>' )
            );
        }
    }
    return $userdata;
}

function suss_user_register($user_id) {               // when a user registers, sends them an email to verify their account
    $user_info = get_userdata($user_id);                                            // gets user data
    $code = md5(time());                                                            // creates md5 hash to verify later
    $string = array('id'=>$user_id, 'code'=>$code);                                 // make OTP to email to user
	
	update_user_meta($user_id, 'is_activated', 0);                                  // creates activation code and activation status in the database
	update_user_meta($user_id, 'activationcode', $code);
	
	
    $url = get_site_url(). '/verify/?p=' .base64_encode( serialize($string));       // creates the activation url
    //$html = ( 'Please click <a href="'.$url.'">here</a> to verify your email address and complete the registration process.' ); // This is the html template for your email message body
	
	
	$html = ('<p>Hi,</p>
			<p>Thanks for creating an account on Sydney Underground Streaming Sessions. You can access your account area to view orders, change your password, and more at: https://suss.fireflydigital.dev/my-account/</p>
			<p>Please click <a href="'.$url.'">here</a> to verify your email address and activate your account.</p>
			<p>We look forward to seeing you soon.</p>');

	wc_mail($user_info->user_email, __( 'Activate your Sydney Underground Streaming Sessions account' ), $html);          // sends the email to the user
}

function suss_verification_init(){      // handles all this verification stuff
	$videoUrl 	= home_url('/videostream');
	$accountUrl = home_url('/my-account');
	                           			
    if(isset($_GET['p'])){                                                  // If accessed via an authentification link
        $data = unserialize(base64_decode($_GET['p']));
        $code = get_user_meta($data['id'], 'activationcode', true);
        $isActivated = get_user_meta($data['id'], 'is_activated', true);    // checks if the account has already been activated. Prevents logins with an outdated confirmation link
        if( $isActivated ) {                                                // generates an error message if the account was already active
            wc_add_notice( __( '<p>This account has already been activated. Please <a href="' . $accountUrl . '">login</a> with your username and password.</p>' ), 'notice' );
        }
        else {
            if($code == $data['code']){                                     // checks whether the decoded code given is the same as the one in the data base
                update_user_meta($data['id'], 'is_activated', 1);           // updates the database upon successful activation
                $user_id = $data['id'];                                     // logs the user in
                $user = get_user_by( 'id', $user_id ); 
                if( $user ) {
                    wp_set_current_user( $user_id, $user->user_login );
                    wp_set_auth_cookie( $user_id );
                    do_action( 'wp_login', $user->user_login, $user );
				}
				

				wc_add_notice( __( '<p><strong>Success:</strong> Your account has been activated! You have been logged in. <a href="'. $videoUrl .'">View events.</a></p>' ), 'notice' );
				
            } else {
                wc_add_notice( __( '<p><strong>Error:</strong> Account activation failed. <br/><br/>Please try again in a few minutes or <a href="/verify/?u='.$userdata->ID.'">resend the activation email</a>.<br />Please note that any activation links previously sent lose their validity as soon as a new activation email gets sent.<br />If the verification fails repeatedly, please contact our administrator.</p>' ), 'notice' );
            }
        }
    }
    if(isset($_GET['u'])){ 
		// If resending confirmation mail
        suss_user_register($_GET['u']);
        wc_add_notice( __( '<p>Your activation email has been resent. Please check your email and your spam folder.</p>' ), 'notice' );
    }
    if(isset($_GET['n'])){
		// If account has been freshly created
        wc_add_notice( __( '<p>Thank you for creating your account. You will need to confirm your email address in order to activate your account.<br/><br/>An email containing the activation link has been sent to your email address. If the email does not arrive within a few minutes, check your spam folder.</p>' ), 'notice' );
	}

}

// the hooks to make it all work
add_action( 'init', 'suss_verification_init' );
add_filter('woocommerce_registration_redirect', 'suss_registration_redirect');
add_filter('wp_authenticate_user', 'suss_authenticate_user',10,2);
add_action('user_register', 'suss_user_register',10,2);

//[show_wc_notices]
function suss_show_wc_notices( $atts ){
	$notices = "";
	if(!is_admin()) {
		$notices = wc_print_notices();
	}
	
	return $notices;
}

add_shortcode( 'show_wc_notices', 'suss_show_wc_notices' );
