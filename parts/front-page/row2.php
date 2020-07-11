<?php require_once('../../../../../wp-load.php'); ?>
<link rel="stylesheet" href="../../css/front-page.css">
<link rel="stylesheet" href="../../css/variables.css">
<link rel="stylesheet" href="../../style.css">
<link rel="stylesheet" href="https://use.typekit.net/erm4tbu.css">
<style>section{max-width:1140px;margin:0 auto;}</style>

<?php
//$params = get_query_var('params');
$params = [
    'posts' => '5',
    'category' => 'news'
];

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
$query = new WP_Query( $args_query );
?>

<section class="row">

    <?php while ( $query->have_posts() ) { $query->the_post(); ?>

        <div class="row-item">
            <img src="<?php echo getFeaturedImageFile(); ?>" alt="<?php echo getFeaturedImageAlt(); ?>">
            <h2 class="row-title"><?php echo esc_html( get_the_title() ); ?></h2>
            <p class="article-excerpt"><?php echo getExcerpt(); ?></p>
            <span class="article-meta"><?php echo get_the_date('F j, Y'); ?></span>
        </div>

    <?php } wp_reset_postdata(); ?>

</section>