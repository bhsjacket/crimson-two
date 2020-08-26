<?php get_header(); ?>

<?php if( get_field('template') != 'full-bleed' && get_post_type() == 'post' ) { ?>

<?php
    $query = new WP_Query([
        'post_type' => ['post'],
        'post_status' => ['publish'],
        'posts_per_page' => 8,
        'ignore_sticky_posts' => true,
        'nopaging' => false,
        'post__not_in' => [get_the_ID()],
    ]);
?>

<div class="recommended-slider-wrapper">
    <div class="recommended-slider at-start">
        <div class="recommended-prev recommended-control">
            <i class="far fa-chevron-left"></i>
        </div>

        <div class="slider-wrapper">
            <div class="recommended-slides">

                <?php while($query->have_posts()) { $query->the_post(); ?>
                <a class="recommended-article" href="<?php echo get_permalink(); ?>">
                    <?php the_post_thumbnail('thumbnail'); ?>
                    <h2 data-lines="3" class="article-title"><span class="article-category"><?php echo getSection(); ?></span><?php echo get_the_title(); ?></h2>
                </a>
                <?php } wp_reset_postdata(); ?>

            </div>
        </div>

        <div class="recommended-next recommended-control">
            <i class="far fa-chevron-right"></i>
        </div>
    </div>
</div>
<?php } ?>

<?php while(have_posts()): the_post() ?>

<main id="single" data-template="<?php echo get_field('template'); ?>">

    <?php

    if( get_field('template') == 'full-bleed' && has_post_thumbnail() ) {
        get_template_part('parts/single/full-bleed-header');
    } else {
        get_template_part('parts/single/standard-header');
    }

    ?>

    <div class="article-content">
        <?php the_content(); ?>
    </div>

    <?php get_template_part('parts/single/author-box'); ?>

    <?php
    
    if( !is_singular( 'page' ) ) {
        get_template_part( 'parts/single/comments' );
    }

    ?>


</main>

<?php endwhile; ?>
<?php get_footer(); ?>

