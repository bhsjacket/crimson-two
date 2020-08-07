<style>

.full-bleed-header {
    background-image: url(<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', false)[0]; ?>)
}

<?php if( $slideshow = get_field('slideshow') ) { ?>
.full-bleed-header {
    animation-name: slideshowBackground;
    animation-duration: <?php echo count($slideshow) * 3; ?>s;
    animation-iteration-count: infinite;
    animation-timing-function: cubic-bezier(0.645, 0.045, 0.355, 1);
    animation-delay: 1s;
}

<?php
$content = '';
foreach($slideshow as $slide) { $content .= 'url(' . $slide['url'] . ') '; }
$content = rtrim($content);
?>

/* Preload images for slideshow */
.full-bleed-header:after {
   position:absolute; width:0; height:0; overflow:hidden; z-index:-1;
   content: <?php echo $content ?>;
}

@keyframes slideshowBackground {
    <?php
    foreach($slideshow as $index => $slide) {
        $percentage = ($index / count($slideshow)) * 100;
        $url = $slide['url'] ?>

    <?php echo $percentage ?>% {
        background-image: url(<?php echo $url; ?>)
    }

    <?php } ?>
}
<?php } ?>


</style>

<header class="full-bleed-header align-full">

    <div class="gradient-overlay">

        <div class="headline">
            <?php if( is_singular('column') ) { ?>
            <a href="<?php echo get_post_type_archive_link('column'); ?>" class="article-section">Column</a>
            <?php } else { ?>
            <a href="<?php echo esc_url(get_category_link( get_the_category()[0]->term_id )); ?>" class="article-section"><?php echo esc_html( get_the_category()[0]->name ); ?></a>
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