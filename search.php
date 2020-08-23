<?php
$count = (new WP_Query("s=$s&showposts=0"))->found_posts;
?>

<?php get_header(); ?>
<main id="search">

    <div class="search-form">
        <span class="search-result-count"><?php echo number_format($count); ?> results found for</span>
        <form action="<?php echo get_bloginfo('url'); ?>">
            <input type="text" name="s" value="<?php the_search_query(); ?>">
            <button><i class="far fa-search"></i></button>
        </form>
    </div>

    <div class="article-stream">

    <?php if( have_posts() ) { ?>
        <?php while( have_posts() ) { the_post(); ?>
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
    <?php } else { ?>
        <p>No results found.</p>
    <?php } ?>

    </div>

</main>
<?php get_footer(); ?>

<script src="<?php echo get_template_directory_uri(); ?>/js/search.js"></script>