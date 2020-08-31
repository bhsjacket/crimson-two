<?php

// REGISTER MENUS
add_action( 'init', function(){

    register_nav_menus( [
        'sections' => 'Sections'
    ] );

} );

// THEME FEATURES
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption'] );
add_theme_support( 'title-tag' );

// CO-AUTHORS PLUS
function cap_cap() {
	return 'read'; // Add all users to dropdown
}
add_filter('coauthors_edit_author_cap', 'cap_cap');

// https://github.com/Automattic/Co-Authors-Plus/blob/221e4df88d65b1ba2eb4467d16e4ba74d82f37c9/co-authors-plus.php#L337
function cap_context() {
	return 'side'; // change position
}
add_filter('coauthors_meta_box_context', 'cap_context');

// REGISTER IMAGE SIZES
add_image_size( 'three-two', 1200, 800, true ); // 3:2 ratio
add_image_size( 'small-three-two', 600, 400, true ); // smaller 3:2 ratio

remove_image_size('1536x1536');
remove_image_size('2048x2048');