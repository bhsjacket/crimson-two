<div class="featured-image-outer <?php echo get_field('image_size') ?? 'align-normal'; ?>">
    <?php the_post_thumbnail('large', [
        'class' => 'featured-image zoom'
    ]) ?>
    <div class="caption-group">
        <p class="caption-content"><?php echo esc_html( get_field('featured_image_caption') ); ?></p>
        <p class="caption-credit"><?php echo esc_html( get_field('featured_image_author') ); ?></p>
    </div>
</div>