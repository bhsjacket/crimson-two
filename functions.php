<?php
// Register Menus
function crimson_menus() {

	$locations = array(
		'sections' => __( 'Sections', 'crimson' ),
		'secondary' => __( 'Secondary', 'crimson' ),
        'tertiary' => __( 'Tertiary', 'crimson' ),
        'columnists' => __('Columnists', 'crimson'),
	);
	register_nav_menus( $locations );

}
add_action( 'init', 'crimson_menus' );

// coauthors plus
function cap_callback() {
    return 'read'; // Add all users to dropdown
}
add_filter('coauthors_edit_author_cap', 'cap_callback');

// register image size
add_image_size('three-two', 900, 600, true);

// disable for posts
add_filter('use_block_editor_for_post', '__return_false', 10);

// disable for post types
add_filter('use_block_editor_for_post_type', '__return_false', 10);

// Register Theme Features
function custom_theme_features()  {

	// Add theme support for Automatic Feed Links
	add_theme_support( 'automatic-feed-links' );

	// Add theme support for Post Formats
	add_theme_support( 'post-formats', array( 'gallery' ) );

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