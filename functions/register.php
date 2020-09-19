<?php

/* add_action( 'init', 'create_syndication_taxonomy' );
 
function create_syndication_taxonomy() {
 
    register_taxonomy('syndication', ['post'], [
        'labels' => [
            'name' => 'Syndication Options',
            'singular_name' => 'Syndication Option'
        ],
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => false,
        'query_var' => true,
        'rewrite' => ['slug' => 'crimson-syndication'],
    ]);
 
} */

// COLUMN POST TYPE
function crimson_columns() {

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
add_action( 'init', 'crimson_columns', 0 );