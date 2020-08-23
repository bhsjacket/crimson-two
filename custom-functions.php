<?php

function academicYear(DateTime $userDate) {
    $currentYear = $userDate->format('Y');
    $cutoff = new DateTime($userDate->format('Y') . '/07/16 23:59:59');
    if ($userDate < $cutoff) {
        return ($currentYear - 1) . '-' . $currentYear;
    }
    return $currentYear . '-' . ($currentYear+1);
}

function getSection($post = \false) {
    if( get_post_type($post) == 'column' ) {
        return 'Column - ' . get_the_author_meta('display_name');
    }
    
    if(empty( get_field('kicker', $post) )) {
        return get_the_category($post)[0]->cat_name;
    } else {
        return get_field('kicker', $post);
    }
}

function getExcerpt($post = \false) {
    return get_field('homepage_excerpt', $post);
}

function theColumnImage($post = \false) {
    if( has_post_thumbnail() ) {
        the_post_thumbnail('thumbnail');
    } else {
        echo '<img class="columnist-image" src="' . get_avatar_url(get_the_author_meta('ID')) . '">';
    }
}