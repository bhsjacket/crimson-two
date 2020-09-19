<?php get_header(); ?>

<header class="column-header">
    <h1 class="column-headline">Columns</h1>
    <a target="_blank" href="https://blogtrottr.com/?subscribe=https://<?php echo str_replace( '//', '/', $_SERVER['HTTP_HOST'] . strtok(strtok($_SERVER['REQUEST_URI'], '?'), '#') . '/feed' ); ?>" class="archive-button">Get email updates</a>
</header>

<main id="column-archive" class="grid double-gap one-one-one-one">

    <?php while( have_posts() ) { the_post(); ?>

    <a href="<?php echo get_permalink(); ?>" class="column">
        <div class="column-inner">
            <?php theColumnImage(); ?>
            <div>
                <h2 class="columnist"><?php echo get_the_author(); ?></h2>
                <h2 class="article-title"><?php echo get_the_title(); ?></h2>
            </div>
            <p class="article-excerpt" data-lines="3"><?php echo getExcerpt(); ?></p>
        </div>
    </a>

    <?php } ?>

</main>

<div class="navigation">
    <div class="previous-page"><?php previous_posts_link( '&laquo; Previous Page' ); ?></div>
    <div class="next-page"><?php next_posts_link( 'Next Page &raquo;', '' ); ?></div>
</div>

<?php get_footer(); ?>