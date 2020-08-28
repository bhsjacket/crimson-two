<?php get_header(); ?>

<?php

if( get_field('template') != 'full-bleed' && get_post_type() == 'post' && isShown('recommended_posts') ) {
    get_template_part('parts/single/recommended-slider');
}

?>

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

    <?php
    
    if( function_exists( 'get_coauthors' ) && count( get_coauthors() ) > 1 ) {
        get_template_part('parts/single/author-box');
    }
    
    if( !is_singular( 'page' ) ) {
        get_template_part( 'parts/single/comments' );
    }

    ?>


</main>

<?php endwhile; ?>
<?php get_footer(); ?>