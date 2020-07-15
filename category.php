<?php
$topQuery = new WP_Query([
    'post_type' => ['post'],
    'post_status' => ['publish'],
    'posts_per_page' => 4,
    'offset' => 0,
    'order' => 'DESC',
    'cat' => $wp_query->get_queried_object_id()
]);

$bottomQuery = new WP_Query([
    'post_type' => ['post'],
    'post_status' => ['publish'],
    'posts_per_page' => 6,
    'offset' => 4,
    'order' => 'DESC',
    'cat' => $wp_query->get_queried_object_id()
]);
?>

<?php get_header(); ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/section.css">

<?php if($topQuery->have_posts()): ?>

<main id="section-archive">

    <div class="section-top">

    <?php while($topQuery->have_posts()): $topQuery->the_post(); ?>

        <div class="section-top-item">
            <a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
            <a href="<?php echo get_permalink(); ?>"><h2 class="article-title"><?php echo get_the_title(); ?></h2></a>
            <p class="article-meta">By <?php coauthors_posts_links(); ?> on <?php echo get_the_date(); ?></p>
            <p class="article-excerpt"><?php echo esc_html( get_field('homepage_excerpt') ); ?></p>
        </div>

    <?php endwhile; wp_reset_postdata(); ?>

    </div>

    <div class="article-stream">

        <?php while($bottomQuery->have_posts()): $bottomQuery->the_post(); ?>
        <article class="article-stream-item">
            <a href="<?php echo get_permalink(); ?>">
                <?php the_post_thumbnail('small-three-two'); ?>
            </a>
            <div class="article-info">
                <a href="<?php echo get_permalink(); ?>">
                    <h2 class="article-title"><?php echo get_the_title(); ?></h2>
                </a>
                <p class="article-meta">By <?php coauthors_posts_links(); ?> on <?php echo get_the_date(); ?></p>
                <p class="article-excerpt" data-lines="3"><?php echo esc_html( get_field('homepage_excerpt') ); ?></p>
            </div>
        </article>
        <?php endwhile; ?>

    </div>
    
</main>

<?php else: ?>

    <p style="background-color:var(--pale-red);padding:var(--gap);max-width:var(--normal);margin:100px auto;">Something went very wrong. Please contact us if this problem persists.</p>

<?php endif; ?>

<?php get_footer(); ?>