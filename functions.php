<?php

require_once('functions/custom-functions.php'); // Custom Utility Functions
require_once('functions/enqueue.php'); // Enqueue Assets
require_once('functions/head.php'); // Cleanup Auto-Generated <head> Tag
require_once('functions/editors.php'); // Customize Editors
require_once('functions/register.php'); // Register Taxonomies & Custom Post Types
require_once('functions/misc.php'); // Miscellaneous Functions
require_once('functions/acf.php'); // Register ACF Fields

// ADVANCED CUSTOM FIELDS
define( 'ACF_PATH', get_stylesheet_directory() . '/includes/acf/' );
define( 'ACF_URL', get_stylesheet_directory_uri() . '/includes/acf/' );
include_once( ACF_PATH . 'acf.php' );

add_filter('acf/settings/url', 'acf_settings_url');
function acf_settings_url( $url ) {
    return ACF_URL;
}

/* // (Optional) Hide the ACF admin menu item.
add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) {
    return false;
} */