<?php

/*
Fixing Gutenberg and the Classic Editor
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
    wp_enqueue_style( 'gutenberg_css', get_template_directory_uri() . '/css/admin.css' );
	wp_enqueue_script('gutenberg_js', get_template_directory_uri() . '/js/admin.js', [
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

	return [
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
		'acf/video',
		'acf/advanced-iframe'
	];
 
}