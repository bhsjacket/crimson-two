<?php

add_action( 'init', 'jkt_taxonomies' );
function jkt_taxonomies() {
	// Special Issue Taxonomy
    register_taxonomy('special-issue', 'post', [
        'labels' => [
            'name' => 'Special Issues',
            'singular_name' => 'Special Issue',
            'edit_item' => 'Edit Issue',
            'add_new_item' => 'Add New Issue',
            'not_found' => 'No special issues found.',
            'search_items' => 'Search',
            'view_item' => 'View Special Issue'
        ],
        'hierarchical' => false,
        'show_ui' => true,
        'show_admin_column' => false,
        'query_var' => false,
        'rewrite' => [
            'slug' => 'special',
            'with_front' => false
        ],
    ]);
}

add_action( 'init', 'jkt_post_types' );
function jkt_post_types() {
	// Column Post Type
	register_post_type( 'column',  [
		'labels' => [
            'name' => 'Columns',
            'singular_name' => 'Column'
        ],
		'supports' => ['title', 'editor', 'revisions', 'custom-fields', 'author', 'excerpt'],
		'show_in_rest' => true,
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-admin-comments',
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => 'columns',
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'page',
    ] );
}