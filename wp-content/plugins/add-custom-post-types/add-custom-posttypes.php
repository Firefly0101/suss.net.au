<?php
/**
 * Plugin Name: SUSS - Add custom post types
 * Plugin URI: http://www.woocommerce.com/
 * Description: Use this snippet to add custom post types
 * Version: 1.0
 * Author: Firefly
 * Author URI: http://www.fi.net.au/
 * Developer: cfrost
 *
 * Requires at least: 4.6
 * Tested up to: 5.4
 *
 * Copyright: � 2020 Firefly (info@fi.net.au).
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

/**
 * Alters the output of the homepage product categories on the Storefront theme
 * Affects the storefront_product_categories_args filter in /inc/storefront-template-functions.php
 */

if ( ! function_exists('add_stream_post_type') ) {

// Register Custom Post Type
function add_stream_post_type() {

	$labels_stream = array(
		'name'                  => _x( 'Video Streams', 'Post Type General Name', 'suss' ),
		'singular_name'         => _x( 'Video Stream', 'Post Type Singular Name', 'suss' ),
		'menu_name'             => __( 'Video Streams', 'suss' ),
		'name_admin_bar'        => __( 'Video Stream', 'suss' ),
		'archives'              => __( 'All Video Streams', 'suss' ),
		'attributes'            => __( 'Item Attributes', 'suss' ),
		'parent_item_colon'     => __( 'Parent Item:', 'suss' ),
		'all_items'             => __( 'All Items', 'suss' ),
		'add_new_item'          => __( 'Add New Item', 'suss' ),
		'add_new'               => __( 'Add New', 'suss' ),
		'new_item'              => __( 'New Item', 'suss' ),
		'edit_item'             => __( 'Edit Item', 'suss' ),
		'update_item'           => __( 'Update Item', 'suss' ),
		'view_item'             => __( 'View Item', 'suss' ),
		'view_items'            => __( 'View Items', 'suss' ),
		'search_items'          => __( 'Search Item', 'suss' ),
		'not_found'             => __( 'Not found', 'suss' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'suss' ),
		'featured_image'        => __( 'Featured Image', 'suss' ),
		'set_featured_image'    => __( 'Set featured image', 'suss' ),
		'remove_featured_image' => __( 'Remove featured image', 'suss' ),
		'use_featured_image'    => __( 'Use as featured image', 'suss' ),
		'insert_into_item'      => __( 'Insert into item', 'suss' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'suss' ),
		'items_list'            => __( 'Items list', 'suss' ),
		'items_list_navigation' => __( 'Items list navigation', 'suss' ),
		'filter_items_list'     => __( 'Filter items list', 'suss' ),
	);
	$args_stream = array(
		'label'                 => __( 'Video Stream', 'suss' ),
		'description'           => __( 'Video streaming content', 'suss' ),
		'labels'                => $labels_stream,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes' , 'comments'),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-admin-media',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => false,
		
	);
    register_post_type( 'videostream', $args_stream );
    
    $labels_sponsor = array(
		'name'                  => _x( 'Sponsors', 'Post Type General Name', 'suss' ),
		'singular_name'         => _x( 'Sponsor', 'Post Type Singular Name', 'suss' ),
		'menu_name'             => __( 'Sponsors', 'suss' ),
		'name_admin_bar'        => __( 'Sponsors', 'suss' ),
		'archives'              => __( 'All Sponsors', 'suss' ),
		'attributes'            => __( 'Item Attributes', 'suss' ),
		'parent_item_colon'     => __( 'Parent Item:', 'suss' ),
		'all_items'             => __( 'All Items', 'suss' ),
		'add_new_item'          => __( 'Add New Item', 'suss' ),
		'add_new'               => __( 'Add New', 'suss' ),
		'new_item'              => __( 'New Item', 'suss' ),
		'edit_item'             => __( 'Edit Item', 'suss' ),
		'update_item'           => __( 'Update Item', 'suss' ),
		'view_item'             => __( 'View Item', 'suss' ),
		'view_items'            => __( 'View Items', 'suss' ),
		'search_items'          => __( 'Search Item', 'suss' ),
		'not_found'             => __( 'Not found', 'suss' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'suss' ),
		'featured_image'        => __( 'Featured Image', 'suss' ),
		'set_featured_image'    => __( 'Set featured image', 'suss' ),
		'remove_featured_image' => __( 'Remove featured image', 'suss' ),
		'use_featured_image'    => __( 'Use as featured image', 'suss' ),
		'insert_into_item'      => __( 'Insert into item', 'suss' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'suss' ),
		'items_list'            => __( 'Items list', 'suss' ),
		'items_list_navigation' => __( 'Items list navigation', 'suss' ),
		'filter_items_list'     => __( 'Filter items list', 'suss' ),
	);
	$args_sponsor = array(
		'label'                 => __( 'Sponsor', 'suss' ),
		'description'           => __( 'Our sponsors', 'suss' ),
		'labels'                => $labels_sponsor,
		'supports'              => array( 'title', 'editor', 'revisions', 'custom-fields', 'page-attributes'),
		//'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-format-chat',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		//'has_archive'           => true,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => false
	);
	register_post_type( 'sponsors', $args_sponsor);

}
    add_action( 'init', 'add_stream_post_type', 0 );

}

function show_sponsors_shortcode( $atts = []) {
  
    // normalize attribute keys, lowercase
    $atts = array_change_key_case((array)$atts, CASE_LOWER);
    
    // override default attributes with user attributes
    $sponsor_atts = shortcode_atts([
        'type' => 'major',
        'title' => 'Major Sponsors',
        ], $atts);
    
    // get type
    $type = $sponsor_atts['type'];
    $title = $sponsor_atts['title'];

    // start output
    $o = '';

    // get posts
    $args = array(
        'post_type'      => 'sponsors',
        'post_status'    => 'publish',
        'orderby'        => 'rand',
        'meta_query' => array(
            array(
                'key'   => 'sponsor_type',
                'value' => $type,
            )
        )
    );

    $all_sponsors = get_posts( $args );

    if( $all_sponsors ) {
		// widget title
		$o .= '<h2 class="widget-title subheading heading-size-3">' . $title . '</h2>';
		
        // start box
        $o .= '<div class="sponsor-wrapper"><ul class="sponsor-list">';

        
    
        foreach ( $all_sponsors as $post ) {
            $img = CFS()->get( 'sponsor_logo', $post->ID );
            $url = CFS()->get( 'sponsor_url', $post->ID , array( 'format' => 'raw' ) );

            $urllink = $url['url'];
            $urltext = $url['text'];
            $urltarget = $url['target'];

            $o .= '<li class="sponsor-item"><a href="'. $urllink .'" target="'. $urltarget .'"><img src="' . $img . '" alt="'. $post->post_title .'">' . $urltext . '</a></li>';
        }
        
        // end box
        $o .= '</ul></div>';

    }

    // return output
    return $o;
}

add_shortcode('show-sponsors', 'show_sponsors_shortcode');