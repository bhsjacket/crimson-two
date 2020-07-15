<?php

require_once('../custom-functions.php');

$years = range('2015', date('Y'), 1);
foreach($years as &$year) {
    $year = $year . '-' . ($year + 1);
}
$years = array_reverse($years);
if( $years[0] !== academicYear( new DateTime() ) ) {
    unset( $years[0] );
}
$years = array_reverse($years);

echo implode('<br>', $years);