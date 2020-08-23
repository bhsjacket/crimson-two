<?php

require_once('custom-functions.php');

/**
 * INCLUDING STYLESHEETS & SCRIPTS
 */

function resources_to_include() {
	wp_enqueue_style('css-variables', get_template_directory_uri() . '/css/variables.css');
}
add_action('wp_enqueue_scripts', 'resources_to_include'); // frontend
add_action( 'admin_enqueue_scripts', 'resources_to_include' ); // backend

/**
 * FIXING THE MESS THAT IS GUTENBERG
 */

// Disable Colors
add_theme_support( 'editor-color-palette' );
add_theme_support( 'disable-custom-colors' );

// Disable Font Sizes
add_theme_support( 'editor-font-sizes', [] );
add_theme_support( 'disable-custom-font-sizes' );

// Add CSS & JavaScript
add_action('enqueue_block_editor_assets', 'gutenberg_css_js');
function gutenberg_css_js() {
    wp_enqueue_style( 'gutenberg_css', get_bloginfo('stylesheet_directory') . '/css/admin.css' );
	wp_enqueue_script('gutenberg_js', get_bloginfo('stylesheet_directory') . '/js/admin.js', [
		'wp-blocks',
		'wp-dom-ready',
		'wp-edit-post'
	] );
}

// Editor Theme
add_theme_support('editor-styles');
add_editor_style('css/editor.css');

// Add Wide & Full Sizes
add_theme_support( 'align-wide' );

// Hide Unwanted Blocks
add_filter( 'allowed_block_types', 'allowed_block_types' );
 
function allowed_block_types( $allowed_blocks ) {

	return array(
		'core/paragraph',
		'core/heading',
		'core/list',
		'acf/extended-image',
		'acf/embed',
		'acf/image-gallery',
		'acf/advertisement',
		'acf/podcast',
		'core-embed/twitter',
		'core-embed/reddit',
		'core-embed/instagram',
		'core-embed/facebook',
		'core/quote',
		'acf/cta',
		'acf/staff',
		'acf/video'
	);
 
}




// Register Menus
function crimson_menus() {

	$locations = array(
		'sections' => __( 'Sections', 'crimson' ),
	);
	register_nav_menus( $locations );

}
add_action( 'init', 'crimson_menus' );

// Co-Authors Plus
function cap_cap() {
	return 'read'; // Add all users to dropdown
}
add_filter('coauthors_edit_author_cap', 'cap_cap');

// https://github.com/Automattic/Co-Authors-Plus/blob/221e4df88d65b1ba2eb4467d16e4ba74d82f37c9/co-authors-plus.php#L337
function cap_context() {
	return 'side'; // change position
}
add_filter('coauthors_meta_box_context', 'cap_context');

// register image size
add_image_size( 'three-two', 1200, 800, true ); // 3:2 ratio
add_image_size( 'small-three-two', 600, 400, true ); // smaller 3:2 ratio

remove_image_size('1536x1536');
remove_image_size('2048x2048');

// Register Theme Features 
function custom_theme_features()  {

	// Add theme support for Automatic Feed Links
	add_theme_support( 'automatic-feed-links' );

	// Add theme support for Featured Images
	add_theme_support( 'post-thumbnails' );

	// Add theme support for HTML5 Semantic Markup
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	// Add theme support for document Title tag
	add_theme_support( 'title-tag' );

	// Add theme support for custom CSS in the TinyMCE visual editor
	add_editor_style( 'css/editor.css' );
}
add_action( 'after_setup_theme', 'custom_theme_features' );

// remove some meta tags from WordPress
remove_action('wp_head', 'wp_generator');
function remove_dns_prefetch( $hints, $relation_type ) {
    if ( 'dns-prefetch' === $relation_type ) {
        return array_diff( wp_dependencies_unique_hosts(), $hints );
    }
 
    return $hints;
}
remove_action ('wp_head', 'rsd_link');
remove_action( 'wp_head', 'wlwmanifest_link');
remove_action( 'wp_head', 'wp_shortlink_wp_head');
 
//remove json api capabilities
function remove_json_api () {
 
    // Remove the REST API lines from the HTML Header
    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
 
    // Remove the REST API endpoint.
    remove_action( 'rest_api_init', 'wp_oembed_register_route' );
 
    // Turn off oEmbed auto discovery.
    add_filter( 'embed_oembed_discover', '__return_false' );
 
    // Don't filter oEmbed results.
    remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
 
    // Remove oEmbed discovery links.
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
 
    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );

}
add_action( 'after_setup_theme', 'remove_json_api' );
 
//completely disable json api
function disable_json_api () {
 
  // Filters for WP-API version 1.x
  add_filter('json_enabled', '__return_false');
  add_filter('json_jsonp_enabled', '__return_false');
 
  // Filters for WP-API version 2.x
  add_filter('rest_enabled', '__return_false');
  add_filter('rest_jsonp_enabled', '__return_false');
 
}
add_action( 'after_setup_theme', 'disable_json_api' );
 
// Remove auto generated feed links
function my_remove_feeds() {
  remove_action( 'wp_head', 'feed_links_extra', 3 );
  remove_action( 'wp_head', 'feed_links', 2 );
}
add_action( 'after_setup_theme', 'my_remove_feeds' );
 
add_filter( 'wp_resource_hints', 'remove_dns_prefetch', 10, 2 );
 
//remove emoji scripts from head
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );


// Include Advanced Custom Fields
// Define path and URL to the ACF plugin.
define( 'ACF_PATH', get_stylesheet_directory() . '/includes/acf/' );
define( 'ACF_URL', get_stylesheet_directory_uri() . '/includes/acf/' );

// Include the ACF plugin.
include_once( ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'acf_settings_url');
function acf_settings_url( $url ) {
    return ACF_URL;
}

/* // (Optional) Hide the ACF admin menu item.
add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) {
    return false;
} */

// Register Syndication Taxonomy
add_action( 'init', 'create_syndication_taxonomy', 0 );
 
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

// Columns
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
		'taxonomies'            => array( 'issue' ),
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

// Add Issue Taxonomy
function create_issue_tax() {

	$labels = array(
		'name'              => 'Issues', 'taxonomy general name',
		'singular_name'     => 'Issue', 'taxonomy singular name',
		'search_items'      => 'Search Issues',
		'all_items'         => 'All Issues',
		'parent_item'       => 'Parent Issue',
		'parent_item_colon' => 'Parent Issue:',
		'edit_item'         => 'Edit Issue',
		'update_item'       => 'Update Issue',
		'add_new_item'      => 'Add New Issue',
		'new_item_name'     => 'New Issue Name',
		'menu_name'         => 'Issue',
	);
	$args = array(
		'labels' => $labels,
		'description' => 'Issues',
		'hierarchical' => true,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => false,
		'show_tagcloud' => false,
		'show_in_quick_edit' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
		'rewrite' => false,
	);
	register_taxonomy( 'issue', array('post', 'column'), $args );

}
add_action( 'init', 'create_issue_tax' );