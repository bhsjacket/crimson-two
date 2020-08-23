<?php

$topArticle = new WP_Query([
    'cat' => $wp_query->get_queried_object_id(),
    'post_type' => ['post'],
    'post_status' => ['publish'],
    'posts_per_page' => 1,
    'nopaging' => false
]);

if( get_query_var('paged') === 0 ) {
    $articleStream = new WP_Query([
        'offset' => 1,
        'cat' => $wp_query->get_queried_object_id(),
        'posts_per_page' => 9
    ]);
} else {
    $articleStream = $wp_query;
}

?>

<?php get_header(); ?>

<main id="section-archive">

    <?php if( get_query_var('paged') === 0 ) { ?>

    <section class="top-article">
        <div class="top-article-inner">
            <?php while( $topArticle->have_posts() ) { $topArticle->the_post(); ?>
                <a href="<?php get_permalink(); ?>" class="grid four-three double-gap">
                    <?php the_post_thumbnail('three-two'); ?>
                    <div>
                        <h2 class="article-title"><?php echo get_the_title(); ?></h2>
                        <p class="article-excerpt">
                            <span class="article-date"><?php echo get_the_date('F j, Y'); ?></span>
                            <?php echo getExcerpt(); ?>
                        </p>
                    </div>
                </a>
            <?php } ?>
        </div>
    </section>

    <?php } ?>

    <div class="article-stream">
        <?php while( $articleStream->have_posts() ) { $articleStream->the_post(); ?>
            <a class="stream-item" data-type="<?php echo get_post_type(); ?>" href="<?php echo get_permalink(); ?>">
                <div class="article-info">
                    <span class="article-section"><?php echo getSection(); ?></span>
                    <h2 class="article-title"><?php echo get_the_title(); ?></h2>
                    <p class="article-excerpt">
                        <span class="article-date"><?php echo get_the_date(); ?></span>
                        <?php echo getExcerpt(); ?>
                    </p>
                </div>
                <?php get_post_type() == 'column' ? theColumnImage() : the_post_thumbnail('small-three-two'); ?>
            </a>
        <?php } ?>
        <div class="navigation">
            <div class="previous-page"><?php previous_posts_link( '&laquo; Previous Page' ); ?></div>
            <div class="next-page"><?php next_posts_link( 'Next Page &raquo;', '' ); ?></div>
        </div>
    </div>

</main>

<?php get_footer(); ?>