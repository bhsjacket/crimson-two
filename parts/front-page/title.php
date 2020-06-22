<?php
/*
optional:
'color'

expects:
'text'
*/

$params = get_query_var('params');
?>

<h2 class="section-header <?php echo $params['color'] ?>"><?php echo esc_html( $params['text'] ); ?></h2>