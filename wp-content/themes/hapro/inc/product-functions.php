<?php
add_action( 'init', 'codex_banner_init' );
/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_banner_init() {
	$labels = array(
		'name'               => _x( 'banners', 'post type general name', 'whispli' ),
		'singular_name'      => _x( 'banner', 'post type singular name', 'whispli' ),
		'menu_name'          => _x( 'banners', 'admin menu', 'whispli' ),
		'name_admin_bar'     => _x( 'banner', 'add new on admin bar', 'whispli' ),
		'add_new'            => _x( 'Add New', 'book', 'whispli' ),
		'add_new_item'       => __( 'Add New banner', 'whispli' ),
		'new_item'           => __( 'New banner', 'whispli' ),
		'edit_item'          => __( 'Edit banner', 'whispli' ),
		'view_item'          => __( 'View banner', 'whispli' ),
		'all_items'          => __( 'All banners', 'whispli' ),
		'search_items'       => __( 'Search banners', 'whispli' ),
		'parent_item_colon'  => __( 'Parent banners:', 'whispli' ),
		'not_found'          => __( 'No banners found.', 'whispli' ),
		'not_found_in_trash' => __( 'No banners found in Trash.', 'whispli' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'whispli' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'banner' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'exclude_from_search' => true,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'revisions' ),
		'taxonomies'         => array( 'post_tag' )
	);

	register_post_type( 'banner', $args );
}