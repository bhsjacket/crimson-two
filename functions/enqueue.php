<?php

/*
This file enqueues styles and scripts for the theme.
*/

function frontendAssets() {

    wp_enqueue_style( 'css-variables', get_template_directory_uri() . '/css/variables.css');
    wp_enqueue_style( 'style', get_stylesheet_uri(), [], filemtime( get_stylesheet_directory() . '/style.css' ) );

    wp_enqueue_style( 'typekit-fonts', 'https://use.typekit.net/erm4tbu.css' );

    wp_enqueue_style( 'fa-base', get_template_directory_uri() . '/assets/icons/css/fontawesome.min.css' );
    wp_enqueue_style( 'fa-regular', get_template_directory_uri() . '/assets/icons/css/regular.min.css' );
    wp_enqueue_style( 'fa-solid', get_template_directory_uri() . '/assets/icons/css/solid.min.css' );
    wp_enqueue_style( 'fa-brands', get_template_directory_uri() . '/assets/icons/css/brands.min.css' );
    
    wp_enqueue_script( 'jquery-3', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js' );
    wp_enqueue_script( 'cookie-js', 'https://cdn.jsdelivr.net/npm/js-cookie@2.2.1/src/js.cookie.min.js' );

    wp_enqueue_script( 'javascript', get_template_directory_uri() . '/js/javascript.js', [], false, true );
    wp_enqueue_script( 'medium-zoom', 'https://cdn.jsdelivr.net/npm/medium-zoom@1.0.6/dist/medium-zoom.min.js', [], false, true );
    // wp_enqueue_script( 'vue-js', 'https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.min.js', [], false, true );
    // wp_enqueue_script( 'lazy-load-fix', get_template_directory_uri() . '/js/lazy-load-fix.js', [], false, true );
    
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

add_action( 'wp_enqueue_scripts', 'frontendAssets'); // Frontend
add_action( 'admin_enqueue_scripts', 'backendAssets' ); // Backend