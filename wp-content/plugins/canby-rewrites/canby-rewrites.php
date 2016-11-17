<?php

/**
 * Plugin Name: Canby Rewrites
 * Plugin URI:  http://canbypublications.com
 * Description: Rewrite rules for Canby web site
 * Author:      Robert Starkweather
 * Author URI:  http://www.k4media.com
 * Version:     0.0.1
 */

function canby_add_rewrite_rules() {
	
	/*
	* list of canby cities, hotel classes and business types
	*/
	$cities_list = canby_cities_list();
	$business_types = canby_business_types_list();
	$hotel_classes = canby_hotel_tax_list();

	
	/* business category archives */
	add_rewrite_rule(
        '^(' . $cities_list. ')/(' . $business_types . ')/?$',
        'index.php?post_type=canby_business&canby_cities_tax=$matches[1]&canby_business_type=$matches[2]',
        'top'
    );
	/* hotel category archives */
	add_rewrite_rule(
        '^(' . $cities_list. ')/hotels/(' . $hotel_classes . ')/?$',
        'index.php?post_type=canby_hotel&canby_cities_tax=$matches[1]&canby_hotel_tax=$matches[2]',
        'top'
    );
	/* hotel single */
	add_rewrite_rule(
        '^(' . $cities_list. ')/hotels/([^/]*)/?$',
        'index.php?canby_hotel=$matches[2]',
        'top'
    );
	/* hotel archive */
	add_rewrite_rule(
        '^(' . $cities_list. ')/hotels/?$',
        'index.php?post_type=canby_hotel&canby_cities_tax=$matches[1]',
        'top'
    );
	
}
add_action( 'init', 'canby_add_rewrite_rules', 10 );

/*
* make pretty permalinks for our custom post types
*/
add_filter('post_type_link', 'canby_filter_post_type_link', 10, 2);
function canby_filter_post_type_link( $post_link, $post, $leavename='', $sample='' ) {
	
	if ( 'canby_hotel' == $post->post_type  ) {
		$city = get_post( get_post_meta( $post->ID, 'hcity', true) );
		$front = $city->post_name . "/hotels" ;
		$post_link = str_replace( 'canby_hotel', $front, $post_link );
		return $post_link;
	}
	if ( 'canby_business' == $post->post_type  ) {
		// %canby_business_type% and %canby_business_type% set in register post type
		$city = get_post( get_post_meta( $post->ID, 'bcity', true) );
		$post_link = str_replace( '%canby_city%', $city->post_name, $post_link );
		$type = get_term( get_post_meta( $post->ID, 'btype', true) );
		$post_link = str_replace( '%canby_business_type%', $type->slug, $post_link );
		return $post_link;
	}
	if ( 'canby_city' == $post->post_type ) {
		$post_link = str_replace( '/canby_city/', '/', $post_link );
		return $post_link;
	}
    return $post_link;
}

/**
 * By default, core only accounts for posts and pages where the slug is /post-name/
 */
function canby_parse_request( $query ) {
    if ( ! $query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
        return;
    }
    if ( ! empty( $query->query['name'] ) ) {
        $query->set( 'post_type', array( 'post', 'page', 'canby_city', 'canby_hotel' ) );
    }
}
add_action( 'pre_get_posts', 'canby_parse_request' );

/*
* make sure that permalinks are set to %post_name%
*/
add_action( 'init', 'canby_permalinks' );
function canby_permalinks() {
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure( '/%postname%/' );
}

/*
* flush rewrites on de/activation
*/
register_deactivation_hook( __FILE__, 'canby_flush_rewrites' );
register_activation_hook( __FILE__, 'canby_flush_rewrites' );
function canby_flush_rewrites() {
	flush_rewrite_rules();
}


function canby_cities_list() {
	/*
	* return a list of canby cities for rewrite rules
	* ex: sihanoukville|phnom-pem|siem-reap
	*/
	$args = array(
		'post_type'			=> 'canby_city',
		'post_status'		=> 'publish',
		'posts_per_page'	=> -1,
	);
	$posts = get_posts($args);
	$canby_cities = array();
	foreach ( $posts as $city ) { $canby_cities[] = $city->post_name; }
	return implode("|", $canby_cities);
}
function canby_hotel_tax_list() {
	$terms = get_terms( array(
		'taxonomy' => 'canby_hotel_tax',
		'hide_empty' => true,
	));
	$classes = array();
	foreach ( $terms as $class ) { $classes[] = $class->slug; }
	return implode("|", $classes );	
}
function canby_business_types_list() {
	$terms = get_terms( array(
		'taxonomy' => 'canby_business_type',
		'hide_empty' => true,
	));
	$business_types = array();
	foreach ( $terms as $type ) { $business_types[] = $type->slug; }
	return implode("|", $business_types );	
}
?>