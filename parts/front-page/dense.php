<?php
/**
 * This section expects a string with the path to the dynamic content template part.
 * Example: 'parts/front-page/dynamic-content/coronavirus'
 */

$params = get_query_var('params');

$small_query = array(
    'post_type' => array('post'),
	'post_status' => array('publish'),
    'posts_per_page' => 3,
    'meta_key' => '_thumbnail_id',
    'nopaging' => false,
    'tax_query' => array(
		array(
			'taxonomy' => 'syndication',
			'field' => 'slug',
			'terms' => array('front-feature'),
			'operator' => 'NOT IN',
		),
	),
);

$small_query = new WP_Query( $small_query );

$params = get_query_var('params');

$main_query = array(
    'post_type' => array('post'),
	'post_status' => array('publish'),
    'posts_per_page' => 1,
    'meta_key' => '_thumbnail_id',
    'nopaging' => false,
    'tax_query' => array(
		array(
			'taxonomy' => 'syndication',
			'field' => 'slug',
			'terms' => array('front-feature'),
		),
	),
);

$main_query = new WP_Query( $main_query );

?>

<section class="dense<?php if($params['reverse']) { echo ' reverse'; } ?>">

    <div class="dense-left">
        <div class="dense-left-top">
            <?php while ( $small_query->have_posts() ) { $small_query->the_post(); ?>

            <a class="small-item" href="<?php echo get_permalink(); ?>">
                <img src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail')[0]; ?>" class="small-item-image">
                <h2 data-lines="3" class="small-item-title"><span class="article-category"><?php echo esc_html( getSection() ); ?></span><?php echo esc_html( get_the_title() ); ?></h2>
            </a>

            <?php } wp_reset_postdata(); ?>
        </div>

        <?php while ( $main_query->have_posts() ) { $main_query->the_post(); ?>
        <a class="dense-left-bottom" href="<?php echo get_permalink(); ?>">
            <?php if( $slideshow = get_field('slideshow') ) { ?>
            <div class="slideshow">
                <?php $slideshow = array_slice($slideshow, 0, 5); // Only the first five images ?>
                <?php foreach($slideshow as $image) { ?>
                <img src="<?php echo $image['sizes']['three-two']; ?>" alt="">
                <?php } ?>
            </div>
            <?php } else { ?>
            <?php the_post_thumbnail('three-two'); ?>
            <?php } ?>
            <div class="dense-left-bottom-title">
                <span class="article-category"><?php echo esc_html( getSection() ); ?></span>
                <h2 class="dense-title"><?php echo esc_html( get_the_title() ); ?></h2>
                <p class="article-excerpt" data-lines="6"><?php echo esc_html( getExcerpt() ?? get_field('subheadline') ); ?></p>
            </div>
        </a>
        <?php } wp_reset_postdata(); ?>
    </div>

    <div class="dense-right dynamic-content" style="height:100%">

        <?php get_template_part('parts/front-page/dynamic-content/' . $params['dynamic_content']); ?>

    </div>

</section>