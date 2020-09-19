<?php

if( get_field('image_size') ?? 'align-normal' == 'align-normal' ) { // It sounds stupid but trust me you need it
    $sizes = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
    $width = $sizes[1];
    $height = $sizes[2];
}

?>

<div class="featured-image-outer <?php echo get_field('image_size') ?? 'align-normal'; echo $width / $height <= 0.8 ? ' vertical-image' : null; ?>">
    <?php the_post_thumbnail('large', [
        'class' => 'featured-image zoom'
    ]) ?>
    <div class="caption-group">
        <p class="caption-content"><?php echo esc_html( get_field('featured_image_caption') ); ?></p>
        <p class="caption-credit"><?php echo esc_html( get_field('featured_image_author') ); ?></p>
    </div>
</div>