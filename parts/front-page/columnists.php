<?php
$args_query = array(
	'post_type' => array('column'),
	'post_status' => array('publish'),
	'posts_per_page' => 5,
	'order' => 'DESC',
);

$query = new WP_Query( $args_query );

$colors = [
    'red-accent',
    'yellow-accent',
    'green-accent',
    'blue-accent',
    'purple-accent'
]; // must be same number of colors as columns

shuffle($colors); // different color order each time
$quote = false;
$color_index = 0; // colors start at 0
?>

<section class="columns">

    <div class="columns-inner">

        <?php while ( $query->have_posts() ) { $query->the_post(); ?>

        <?php
        if( has_excerpt() && $quote !== true ) {
            $quote = true; // prevent another quote column from being made
            $classes = 'column-has-quote ' . $colors[$color_index]; // add has-quote class
            $title = '“' . get_field('homepage_excerpt') ?? get_field('subheadline') . '”'; // title is actually the quote with curly quotes
        } else {
            $classes = $colors[$color_index]; // the CSS classes are just the random accent color
            $title = get_the_title(); // the title is just the title
        }
        $color_index++; // increase color index so next color is different
        ?>

        <a href="<?php echo get_permalink(); ?>" class="column <?php echo $classes; ?>">
            <div style="background-image:url(<?php echo get_field( 'transparent_image', 'user_' . get_the_author_meta('ID') ); ?>)" class="column-image"></div>
            <div class="column-right">
                <h2 class="column-title"><?php echo esc_html( $title ); ?></h2>
                <h2 class="column-name"><?php echo get_the_author_meta( 'display_name' ); ?></h2>
            </div>
        </a>

        <?php } wp_reset_postdata(); ?>

    </div>

</section>