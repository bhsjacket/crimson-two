<?php
if( $block['align'] === '' ) {
    $alignment = 'align-center';
} else {
    $alignment = 'align-' . $block['align'];
}

if($is_preview) {
    echo '<link href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet">';
    echo '<link href="<?php echo get_template_directory_uri(); ?>/css/single.css" rel="stylesheet">';
}

if($alignment == 'align-full') {
    $imageUrl = get_field('image')['url'];
} else {
    $imageUrl = get_field('image')['sizes']['large'];
}
?>
<div class="image-outer <?php echo $alignment; ?>">
    <img class="image zoom" src="<?php echo esc_url( $imageUrl ); ?>">
    <div class="caption-group">
        <p class="caption-content"><?php echo get_field( 'caption' ); ?></p>
        <p class="caption-credit"><?php echo get_field( 'credit' ); ?></p>
    </div>
</div>