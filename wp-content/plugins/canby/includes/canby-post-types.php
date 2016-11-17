<?php

/*
* register post types for swiam functionality
*/
add_action( 'init', 'canby_register_post_types', 5 );
function canby_register_post_types() {
	
	/*
	* Canby City
	*/
	$labels = array(
		'name' => __( 'Cities' ),
		'singular_name' => __( 'City' ),
		'add_new' =>  __( 'Add New City' )
		);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		//'rewrite' => array('slug' => '%canby_city%', 'with_front' => false),
		'capability_type' => 'page',
		'hierarchical' => false,
		'show_ui'		=> true,
		'menu_position' => 4,
		'supports' => array(
			'title',
			'editor',
			'custom-fields',
			'thumbnail'
		),
	);
	register_post_type( 'canby_city', $args);
	
	/*
	* Canby Hotel
	*/
	$labels = array(
		'name' => __( 'Hotels' ),
		'singular_name' => __( 'Hotel' ),
		'add_new' =>  __( 'Add New Hotel' )
		);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		// 'rewrite' => array('slug' => '%canby_city%/hotels', 'with_front' => true),
		'capability_type' => 'page',
		'hierarchical' => false,
		'show_ui'		=> true,
		'menu_position' => 4,
		'supports' => array(
			'title',
			'editor',
			'custom-fields',
			'thumbnail'
		),
		'taxonomies' => array( 'canby_cities_tax' )
	);
	register_post_type( 'canby_hotel', $args);

	/*
	* Canby Business
	*/
	$labels = array(
		'name' => __( 'Businesses' ),
		'singular_name' => __( 'Business' ),
		'add_new' =>  __( 'Add New Business' )
		);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => array('slug' => '%canby_city%/%canby_business_type%', 'with_front' => false),
		'capability_type' => 'page',
		'hierarchical' => false,
		'show_ui'		=> true,
		'menu_position' => 4,
		'supports' => array(
			'title',
			'editor',
			'custom-fields',
			'thumbnail'
		),
		'taxonomies' => array( 'canby_cities_tax', 'canby_business_type' )
	);
	register_post_type( 'canby_business', $args);
	
	/*
	* Canby Temples
	*/
	$labels = array(
		'name' => __( 'Temples' ),
		'singular_name' => __( 'Temple' ),
		'add_new' =>  __( 'Add New Temple' )
		);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'temples/', 'with_front' => false),
		'capability_type' => 'page',
		'hierarchical' => false,
		'show_ui'		=> true,
		'menu_position' => 4,
		'supports' => array(
			'title',
			'editor',
			'custom-fields',
			'thumbnail'
		),
		//'taxonomies' => array( 'canby_cities_tax', 'canby_business_type' )
	);
	register_post_type( 'canby_temple', $args);
}


/*
* register post taxonomies
*/
add_action( 'init', 'canby_register_post_taxonomies', 5 );
function canby_register_post_taxonomies () {
	
	$labels = array(
		'name'              => _x( 'Hotel Class', '' ),
		'singular_name'     => _x( 'Hotel Class', '' ),
	);
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true
	);
	register_taxonomy( 'canby_hotel_tax', array( 'canby_hotel' ), $args );
	
	
	$labels = array(
		'name'              => _x( 'Business Type', '' ),
		'singular_name'     => _x( 'Business Type', '' ),
	);
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => false,
		'show_admin_column' => true,
		'query_var'         => true
	);
	register_taxonomy( 'canby_business_type', array( 'canby_business' ), $args );
}



/*
* automagically populate the Canby Cities Tax
* with names from the CPT canby_city
*/
add_action('init', 'canby_populate_cities_tax', 5);
function canby_populate_cities_tax() {
	
	/*
	* get all canby_city posts
	*/
	$args = array(
		'post_type' => 'canby_city',
		'post_status' => 'publish',
		'posts_per_page' => -1
	);
	$cities = get_posts($args);
	foreach ($cities as $city) {
		wp_insert_term( $city->post_title , 'canby_cities_tax', array() );
	}
}
?>