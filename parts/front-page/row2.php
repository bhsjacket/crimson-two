<?php
/*
optional:
'post_types' (array)
'title' (string)
'style_options' (array)
    - row-background
    - alert-background
'offset' (int)

expects:
'category' OR 'tag' (ID as int)
'posts' (int)
'color' (string)
*/


/* require_once('../../../../../wp-load.php');
echo '<style>section.row{max-width:1140px;margin:0 auto}</style>'; */
$params = get_query_var('params');
/* $params = [
    'category' => 'news',
    'posts' => '4',
    'color' => 'red-accent'
]; */

$args_query = array(
	'post_type' => $params['post_types'] ?? array('post'),
	'post_status' => array('publish'),
	'posts_per_page' => $params['posts'] ?? 1,
    'nopaging' => false,
    'order' => 'DESC',
    'category_name' => $params['category'] ?? '',
    'tag' => $params['tag'] ?? '',
    'offset' => $params['offset'] ?? 0
);

if( $params['posts'] == 3 ) {
    $columns = 'three-columns';
} else if( $params['posts'] == 4 ) {
    $columns = 'four-columns';
} else if( $params['posts'] == 5 ) {
    $columns = 'five-columns';
} else {
    $columns = 'four-columns'; // fallback
}

@$classes = implode( ' ', $params['style_options'] ); // supressed b/c is whiny when no styles set

$query = new WP_Query( $args_query ); ?>

<section class="row <?php echo $columns; ?> <?php echo $classes; ?> <?php echo $params['color']; ?>">

    <?php if( !empty( $params['title'] ) ) { ?>
    <h2 class="section-header"><?php echo esc_html( $params['title'] ); ?></h2>
    <?php } ?>

    <div class="row-inner">
        <?php while ( $query->have_posts() ) { $query->the_post(); ?>
        
        <a href="<?php echo get_permalink(); ?>" class="row-item">
            <img src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'three-two')[0]; ?>" class="row-image">
            <h2 class="row-title">Lorem ipsum, dolor sit amet</h2>
            <span class="article-meta">By <?php coauthors(); ?>, <?php echo get_the_date('F j') ?></span>
            <p class="article-excerpt" data-lines="7"><?php echo esc_html( getExcerpt() ?? get_field('subheadline') ) ?></p>
        </a>

        <?php } wp_reset_postdata(); ?>
    </div>

</section>