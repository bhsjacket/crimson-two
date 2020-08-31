<?php

add_action( 'init', 'create_syndication_taxonomy' );
 
function create_syndication_taxonomy() {
 
  $labels = array(
    'name' => _x( 'Syndication Options', 'taxonomy general names' ),
    'singular_name' => _x( 'Syndication Option', 'taxonomy singular names' ),
    'search_items' =>  __( 'Search Syndication Options' ),
    'all_items' => __( 'All Syndication Options' ),
    'parent_item' => __( 'Parent Syndication Option' ),
    'parent_item_colon' => __( 'Parent Syndication Option:' ),
    'edit_item' => __( 'Edit Syndication Option' ), 
    'update_item' => __( 'Update Syndication Option' ),
    'add_new_item' => __( 'Add New Syndication Option' ),
    'new_item_name' => __( 'New Syndication Option Name' ),
    'menu_name' => __( 'Syndication Options' ),
  );    
 
  register_taxonomy('syndication',array('post'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => false,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'crimson-syndication' ),
  ));
 
}

// COLUMN POST TYPE
function crimson_columns() {

	$labels = array(
		'name'                  => 'Columns', 'Post Type General Name',
		'singular_name'         => 'Column', 'Post Type Singular Name',
		'menu_name'             => 'Columns',
		'name_admin_bar'        => 'Column',
		'archives'              => 'Column Archives',
		'attributes'            => 'Column Attributes',
		'parent_item_colon'     => 'Parent Column:',
		'all_items'             => 'All Columns',
		'add_new_item'          => 'Add New Column',
		'add_new'               => 'Add New',
		'new_item'              => 'New Column',
		'edit_item'             => 'Edit Column',
		'update_item'           => 'Update Column',
		'view_item'             => 'View Column',
		'view_items'            => 'View Columns',
		'search_items'          => 'Search Column',
		'not_found'             => 'Not found',
		'not_found_in_trash'    => 'Not found in Trash',
		'featured_image'        => 'Featured Image',
		'set_featured_image'    => 'Set featured image',
		'remove_featured_image' => 'Remove featured image',
		'use_featured_image'    => 'Use as featured image',
		'insert_into_item'      => 'Insert into column',
		'uploaded_to_this_item' => 'Uploaded to this column',
		'items_list'            => 'Column list',
		'items_list_navigation' => 'Column list navigation',
		'filter_items_list'     => 'Filter column list',
	);
	$args = array(
		'label'                 => 'Column',
		'description'           => 'Columns',
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'revisions', 'custom-fields', 'author', 'excerpt' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-admin-comments',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'columns',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'column', $args );

}
add_action( 'init', 'crimson_columns', 0 );