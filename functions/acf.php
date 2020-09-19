<?php

/* add_filter('acf/settings/save_json', 'jkt_acf_json_save_path');
function jkt_acf_json_save_path($path) {
    $path = get_template_directory() . '/includes/acf-json';
    return $path;
}

add_filter('acf/settings/load_json', 'jkt_acf_json_load_path');
function jkt_acf_json_load_path($paths) {
    unset($paths[0]);
    $paths[] = get_template_directory() . '/includes/acf-json';
    return $paths;
} */

// REGISTER SITE OPTIONS PAGE

acf_add_options_page([
    'page_title' => 'Site Options',
    'menu_title' => 'Site Options',
    'menu_slug' => 'site-options',
    'capability' => 'edit_posts',
    'position' => '2.1',
    'parent_slug' => '',
    'icon_url' => 'dashicons-laptop',
    'redirect' => true,
    'post_id' => 'options',
    'autoload' => false,
    'update_button' => 'Update',
    'updated_message' => 'Updated',
]);