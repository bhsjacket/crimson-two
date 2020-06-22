<?php get_header(); ?>
<main id="search">

    <form class="search-form" action="<?php echo get_bloginfo( 'url' ); ?>">
        <input class="search-form-input" type="text" name="s" value="<?php the_search_query(); ?>">
        <button><i class="far fa-search"></i></button>
    </form>

    <div class="results" data-page="1" data-query="<?php the_search_query(); ?>">

    <?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>
        <?php if( get_post_type() !== 'page' ) { ?>

        <div class="search-result<?php if( !has_post_thumbnail() && get_post_type() == 'post' ) { echo ' no-image'; } ?>">

            <p class="result-date"><?php echo get_the_date( 'F j, Y' ); ?></p>

            <div class="result-article">
                <a href="<?php echo get_permalink(); ?>" class="result-title"><?php echo get_the_title(); ?></a>
                <?php if( get_post_type() == 'column' ) { ?>
                    <p class="result-meta">Column by <?php coauthors_posts_links(); ?></p>
                <?php } else { ?>
                <p class="result-meta">By <?php coauthors_posts_links(); ?> in <?php echo get_the_category()[0]->name; ?></p>
                <?php } ?>
            </div>

            <?php if( get_post_type() == 'column' ) { ?>
            <a href="<?php echo get_permalink(); ?>">
                <img class="columnist-image" src="<?php echo get_avatar_url( get_the_author_meta( 'ID' ) ); ?>">
            </a>
            <?php } else { ?>
            <a href="<?php echo get_permalink(); ?>">
                <?php the_post_thumbnail( 'small-three-two' ); ?>
            </a>
            <?php } ?>

        </div>
        
        <?php } ?>
    <?php endwhile; ?>

    <img src="<?php echo get_template_directory_uri(); ?>/assets/loader.svg" class="search-loader">

    <?php else: ?>
        <p class="no-results">No results found.</p>
    <?php endif; ?>

    </div>

</main>
<?php get_footer(); ?>

<script src="<?php echo get_template_directory_uri(); ?>/js/search.js"></script>