<?php
$params = get_query_var('params');

$args_query = array(
	'post_type' => $params['post_types'] ?? array('post'),
	'post_status' => array('publish'),
	'posts_per_page' => 5,
    'nopaging' => false,
    'order' => 'DESC',
    'category_name' => $params['category'] ?? '',
    'tag' => $params['tag'] ?? '',
    'offset' => $params['offset'] ?? 0
);
$query = new WP_Query( $args_query );
?>

<section class="row row-background blue-accent">

    <?php if($params['title']) { ?>
    <h2 class="section-header"><?php echo $params['title'] ?></h2>
    <?php } ?>

    <div class="row-wrapper">
    <?php while ( $query->have_posts() ) { $query->the_post(); ?>

        <div class="row-item">

            <a href="<?php echo get_permalink(); ?>">
                <?php the_post_thumbnail('small-three-two'); ?>
            </a>
            <a href="<?php echo get_permalink(); ?>"><h2 class="row-title"><?php echo get_the_title(); ?></h2></a>
            <span class="article-meta">By <?php coauthors_posts_links(); ?>, <?php echo get_the_date('F j'); ?></span>
            <p class="article-excerpt"><?php echo getExcerpt(); ?></p>

        </div>

    <?php } wp_reset_postdata(); ?>
    </div>

</section>