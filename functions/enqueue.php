<?php

/*
This file enqueues styles and scripts for the theme.
*/

function frontendAssets() {

    wp_enqueue_style('css-variables', get_template_directory_uri() . '/css/variables.css');
    wp_enqueue_style( 'style', get_stylesheet_uri() );

    wp_enqueue_style( 'typekit-fonts', 'https://use.typekit.net/erm4tbu.css' );

    wp_enqueue_style( 'fa-base', get_template_directory_uri() . '/assets/icons/css/fontawesome.min.css' );
    wp_enqueue_style( 'fa-regular', get_template_directory_uri() . '/assets/icons/css/regular.min.css' );
    wp_enqueue_style( 'fa-solid', get_template_directory_uri() . '/assets/icons/css/solid.min.css' );
    wp_enqueue_style( 'fa-brands', get_template_directory_uri() . '/assets/icons/css/brands.min.css' );
    
    wp_enqueue_script( 'jquery-3', get_template_directory_uri() . '/js/jquery.min.js' );

    wp_enqueue_script( 'javascript', get_template_directory_uri() . '/js/javascript.js', [], false, true );
    wp_enqueue_script( 'cookie-js', get_template_directory_uri() . '/js/js.cookie.min.js', [], false, true );
    wp_enqueue_script( 'medium-zoom', get_template_directory_uri() . '/js/medium-zoom.min.js', [], false, true );
    // wp_enqueue_script( 'lazy-load-fix', get_template_directory_uri() . '/js/lazy-load-fix.js' );
    
    if( is_singular('post') ) {
        wp_enqueue_script( 'menu-script', get_template_directory_uri() . '/js/single.js', [], false, true );
    }

}

function backendAssets() {

    wp_enqueue_style('css-variables', get_template_directory_uri() . '/css/variables.css');

    wp_enqueue_style( 'typekit-fonts', 'https://use.typekit.net/erm4tbu.css' );

    wp_enqueue_style( 'fa-base', get_template_directory_uri() . '/assets/icons/css/fontawesome.min.css' );
    wp_enqueue_style( 'fa-regular', get_template_directory_uri() . '/assets/icons/css/regular.min.css' );
    wp_enqueue_style( 'fa-solid', get_template_directory_uri() . '/assets/icons/css/solid.min.css' );
    wp_enqueue_style( 'fa-brands', get_template_directory_uri() . '/assets/icons/css/brands.min.css' );
    
}

add_action('wp_enqueue_scripts', 'frontendAssets'); // Frontend
add_action( 'admin_enqueue_scripts', 'backendAssets' ); // Backend