<?php
// let's create the function for the custom type
function testimonial_post_type() { 
	// creating (registering) the custom type 
	register_post_type( 'testimonial', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Testimonials', 'underscore' ), /* This is the Title of the Group */
			'singular_name' => __( 'Testimonial', 'underscore' ), /* This is the individual type */
			'all_items' => __( 'All Testimonials', 'underscore' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'underscore' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Testimonial', 'underscore' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'underscore' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Post Types', 'underscore' ), /* Edit Display Title */
			'new_item' => __( 'New Post Type', 'underscore' ), /* New Display Title */
			'view_item' => __( 'View Post Type', 'underscore' ), /* View Display Title */
			'search_items' => __( 'Search Post Type', 'underscore' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'underscore' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'underscore' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is the example custom post type', 'underscore' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 9, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => 'dashicons-format-quote', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'testimonial', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'false', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail')
		) /* end of options */
	); /* end of register post type */
	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'testimonial_post_type');