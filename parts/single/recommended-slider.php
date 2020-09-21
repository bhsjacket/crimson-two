<?php
    $query = new WP_Query([
        'post_type' => ['post', 'column'],
        'post_status' => ['publish'],
        'posts_per_page' => 8,
        'ignore_sticky_posts' => true,
        'nopaging' => false,
        'post__not_in' => [get_the_ID()]
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
                    <?php if( get_post_type() == 'column' ) { ?>
                    <img class="avatar" src="<?php echo get_avatar_url( get_the_author_meta('ID'), 150 ); ?>" alt="">
                    <?php } else { ?>
                    <?php the_post_thumbnail('thumbnail'); ?>
                    <?php } ?>
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