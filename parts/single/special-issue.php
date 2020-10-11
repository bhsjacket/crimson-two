<?php

/*
Displays a special header for special issues. Everything in this file assumes
that this post has a spcial issue taxonomy, because it was checked in singular.php
before this file was loaded.

SCSS: _special-issue-banner.scss
JS: special-issue.js
*/

$postId = $post->ID; // Needed to determine current article in loop
$term = get_the_terms( $postId, 'special-issue' )[0]; // Get first term
$termString = $term->taxonomy . '_' . $term->term_id; // Converts to string for ACF (Ex: special-issue_92)

$link = get_term_link( $term );
$name = $term->name;

$colors = get_field('color', $termString); // This is an array with three hex colors: ['accent'], ['logo'], and ['background']

$issueQuery = new WP_Query([
    'tax_query' => [
        [
            'taxonomy' => 'special-issue',
            'terms' => $term->term_id
        ]
    ]
]);

?>

<?php if( $css = get_field( 'custom_css', $termString ) ) { ?>
<style>
<?php echo $css; ?>
</style>
<?php } ?>

<header class="special-issue-banner" style="--special-issue-accent:<?php echo $colors['accent']; ?>; --special-issue-background:<?php echo $colors['background']; ?>; --special-issue-logo:<?php echo $colors['logo']; ?>;">
    <div class="special-issue-inner">

        <div class="special-issue-info">
            <div class="special-issue-logo">
                <?php echo file_get_contents( get_template_directory() . '/assets/logos/logo-dark.svg' ); ?>
            </div>
            <a href="<?php echo $link; ?>" class="special-issue-name" data-lines="1"><?php echo $name; ?></a>
        </div>

        <div class="special-issue-articles-wrapper">
            <div class="special-issue-articles">
                <div class="special-issue-articles-inner">
                    <?php while( $issueQuery->have_posts() ) { $issueQuery->the_post(); ?>
                    <a href="<?php echo get_permalink(); ?>" class="special-issue-article<?php echo $post->ID == $postId ? ' current-article' : ''; ?>">
                        <?php the_post_thumbnail('thumbnail'); ?>
                        <span class="article-title" data-lines="2"><?php echo $post->ID == $postId ? '<span class="current-article-marker">➤</span>' : ''; // Add ➤ marker if is current article ?> <?php echo get_the_title(); ?></span>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="special-issue-next">
            <i class="far fa-chevron-right"></i>
        </div>
    
    </div>
</header>

<script src="<?php echo get_template_directory_uri(); ?>/js/special-issue.js"></script>