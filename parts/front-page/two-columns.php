<?php
/*
optional:
'post_type'

expects:
'category' OR 'tag' (ID as int)
 */

$params = get_query_var('params');

$title = $params['title'];

$left_query = array(
	'post_type' => $params['post_types'] ?? array('post'),
	'post_status' => array('publish'),
	'posts_per_page' => 3,
    'nopaging' => false,
    'order' => 'DESC',
    'category_name' => $params['category_slug'] ?? '',
    'tag' => $params['tag'] ?? '',
    'offset' => $params['offset'] ?? 0
);

$left_query = new WP_Query( $left_query );

$right_query = array(
	'post_type' => $params['post_types'] ?? array('post'),
	'post_status' => array('publish'),
	'posts_per_page' => 1,
    'nopaging' => false,
    'order' => 'DESC',
    'category' => $params['category_slug'] ?? '',
    'tag' => $params['tag'] ?? '',
    'offset' => (int) $params['offset'] + 3 ?? '3'
);

$right_query = new WP_Query( $right_query ); ?>

<?php if($title) { ?>
<h2 class="section-header <?php echo $params['color'] ?? 'red-accent'; ?>"><?php echo $params['title']; ?></h2>
<?php } ?>

<section class="two-columns <?php echo $params['color'] ?? 'red-accent'; ?> <?php echo $params['position']; ?>">

    <div class="tc-left">
    <?php while ( $left_query->have_posts() ) { $left_query->the_post(); ?>

        <a href="<?php echo get_permalink(); ?>" class="tc-left-article">
            <img src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'three-two')[0]; ?>" class="tc-left-image">
            <div class="tc-left-meta">
                <h2 class="tc-left-title"><?php echo esc_html( get_the_title() ); ?></h2>
                <span class="article-meta">By <?php coauthors(); ?>, <?php echo get_the_date('F j'); ?></span>
            </div>
        </a>

    <?php } wp_reset_postdata(); ?>
    </div>

    <?php while ( $right_query->have_posts() ) { $right_query->the_post(); ?>   
    <a href="<?php echo get_permalink(); ?>" class="tc-right">
        <img src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'three-two')[0]; ?>">
        <div class="tc-right-meta">
            <h2 class="tc-right-title"><?php echo esc_html( get_the_title() ); ?></h2>
            <p class="article-excerpt" data-lines="5"><?php echo esc_html( get_the_excerpt() ); ?></p>
        </div>
    </a>
    <?php } wp_reset_postdata(); ?>

</section>