<style>

.full-bleed-header {
    background-image: url(<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', false)[0]; ?>)
}

</style>

<header class="full-bleed-header align-full">

    <div class="gradient-overlay">

        <div class="headline">
            <?php if( is_singular('column') ) { ?>
            <a href="<?php echo get_post_type_archive_link('column'); ?>" class="article-section">Column</a>
            <?php } else { ?>
            <a href="<?php echo esc_url(get_category_link( get_the_category()[0]->term_id )); ?>" class="article-section"><?php echo esc_html( getSection() ); ?></a>
            <?php } ?>
            <h1><?php echo esc_html( get_the_title() ); ?></h1>
            <?php if(!empty( get_field('subheadline') )) { ?>
            <h2 class="subheadline"><?php echo esc_html( get_field('subheadline') ); ?></h2>
            <?php } ?>
        </div>

    </div>

</header>

<div class="caption-group">
    <p class="caption-content"><?php echo esc_html( get_field('featured_image_caption') ); ?></p>
    <p class="caption-credit"><?php echo esc_html( get_field('featured_image_author') ); ?></p>
</div>

<?php if( !is_singular( 'page' ) ) { ?>
    <?php get_template_part('parts/single/article-meta'); ?>
<?php } ?>