<?php
/* if( get_field('template') !== 'full-bleed' ) {
    get_header();
} else {
    get_template_part('load/head');
} */
get_header();
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

    <?php if( function_exists( 'get_coauthors' ) && count( get_coauthors() ) > 1 ) { ?>
    <div class="author-boxes">
        <?php foreach( get_coauthors() as $author ) { ?>
        <a href="<?php echo get_author_posts_url( $author->ID ); ?>" class="author-box">
            <img src="<?php echo get_avatar_url( $author->ID ) ?>">
            <div>
                <h2 class="author-box-name"><?php echo $author->display_name; ?></h2>
                <h2 class="author-box-position"><?php echo get_field( 'position', 'user_' . $author->ID ); ?></h2>
            </div>
        </a>
        <?php } ?>
    </div>
    <?php } ?>
    <div class="recommended-posts"<?php if( count( @get_coauthors() ) == 1 ) { echo ' style="border-top: solid 1px var(--light)"'; } ?>>
        <?php
        $args_recommended_posts = array(
            'post_type' => array( 'post', 'gallery' ),
            'post_status' => array( 'publish' ),
            'posts_per_page' => 2,
            'nopaging' => false,
            'ignore_sticky_posts' => true,
            'order' => 'DESC',
            'post__not_in' => array( get_the_ID() )
        );
        $recommended_posts = new WP_Query( $args_recommended_posts );
        while ( $recommended_posts->have_posts() ) { $recommended_posts->the_post(); ?>
        <a href="<?php echo get_permalink(); ?>" class="recommended-post">
            <div>
                <h1 class="recommended-post-title"><?php echo get_the_title(); ?></h1>
                <span class="recommended-post-date"><?php echo get_the_date(); ?></span>
            </div>
            <img src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'three-two', false)[0]; ?>">
        </a>
        <?php } wp_reset_postdata(); ?>
    </div>

    <?php
    
    if( !is_singular( 'page' ) ) {
        get_template_part( 'parts/single/comments' );
    }

    ?>


</main>

<?php endwhile; ?>
<?php get_footer(); ?>

