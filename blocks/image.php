<?php
if( $block['align'] === '' ) {
    $alignment = 'align-center';
} else {
    $alignment = 'align-' . $block['align'];
}

if($alignment == 'align-full') {
    $imageUrl = get_field('image')['url'];
} else {
    $imageUrl = get_field('image')['sizes']['large'];
}
?>
<div class="image-outer <?php echo $alignment; ?>">
    <img alt="<?php echo get_field( 'caption' ); ?>" class="image zoom" src="<?php echo esc_url( $imageUrl ); ?>">
    <div class="caption-group">
        <p class="caption-content"><?php echo get_field( 'caption' ); ?></p>
        <p class="caption-credit"><?php echo get_field( 'credit' ); ?></p>
    </div>
</div>