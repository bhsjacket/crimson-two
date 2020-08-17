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
    return get_field('kicker') ?? get_the_category($post)[0]->cat_name;
}