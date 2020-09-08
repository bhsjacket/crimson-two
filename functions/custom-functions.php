<?php

/**
 * academicYear()
 * 
 * Get the academic year a date falls into
 *
 * @param DateTime $userDate
 * @return string The academic year as a string, eg: '2019-2020'
 */
function academicYear(DateTime $userDate) {
    $currentYear = $userDate->format('Y');
    $cutoff = new DateTime($userDate->format('Y') . '/07/16 23:59:59');
    if ($userDate < $cutoff) {
        return ($currentYear - 1) . '-' . $currentYear;
    }
    return $currentYear . '-' . ($currentYear+1);
}

/**
 * Get post section
 * 
 * Gets the kicker for a post based on what fields are available
 *
 * @param int $post
 * @return string
 */
function getSection($post = \false) {
    if( get_post_type($post) == 'column' ) {
        return get_the_author_meta('display_name');
    }
    
    if(empty( get_field('kicker', $post) )) {
        return get_the_category($post)[0]->cat_name;
    } else {
        return get_field('kicker', $post);
    }
}

/**
 * Get post excerpt
 * 
 * Gets the excerpt, just here so I can do some backwards compatability stuff in the future
 *
 * @param int $post
 * @return string
 */
function getExcerpt($post = \false) {
    if(empty( get_field('homepage_excerpt', $post) )) {
        return get_field('subheadline');
    } else {
        return get_field('homepage_excerpt', $post);
    }
}

/**
 * Display the column image
 * 
 * Displays the correct (square) column based on if it has a featured image or not
 *
 * @param int $post
 * @return void
 */
function theColumnImage($post = \false) {
    if( has_post_thumbnail() ) {
        the_post_thumbnail('thumbnail');
    } else {
        echo '<img class="columnist-image" src="' . get_avatar_url( get_the_author_meta( 'ID', get_post_field( 'post_author', $post ) ) ) . '">';
    }
}

/**
 * Checks if the component is shown
 *
 * @param string $component The name of the component set in the custom field dropdown
 * @param int $post
 * @return boolean
 */
function isShown( $component, $post = \false ) {
    return @!in_array( $component, get_field('hide_elements', $post) );
}