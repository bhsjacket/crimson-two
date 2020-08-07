<?php
function academicYear(DateTime $userDate) {
    $currentYear = $userDate->format('Y');
    $cutoff = new DateTime($userDate->format('Y') . '/07/16 23:59:59');
    if ($userDate < $cutoff) {
        return ($currentYear - 1) . '-' . $currentYear;
    }
    return $currentYear . '-' . ($currentYear+1);
}