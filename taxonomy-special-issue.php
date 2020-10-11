<?php

$term = get_queried_object();
$termString = $term->taxonomy . '_' . $term->term_id; // Converts to string for ACF (Ex: special-issue_92)

$link = get_term_link( $term );
$name = $term->name;
$year = get_field('year', $termString);

$colors = get_field('color', $termString); // This is an array with three hex colors: ['accent'], ['logo'], and ['background']

?>

<?php get_header(); ?>

    <main id="special-issue-archive" style="--special-issue-accent:<?php echo $colors['accent']; ?>; --special-issue-background:<?php echo $colors['background']; ?>; --special-issue-logo:<?php echo $colors['logo']; ?>;">

        <header class="special-issue-header">
            <div class="special-issue-header-inner">
                <h2 class="special-issue-label">Special Issue<?php echo '<span class="special-issue-year">' . $year . '</span>'; ?></h3>
                <?php if( $name ) { ?>
                <h1 class="special-issue-name"><?php echo $name; ?></h3>
                <?php } ?>
            </div>
        </header>

        <div class="article-stream">
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
        </div>

    </main>

<?php get_footer(); ?>