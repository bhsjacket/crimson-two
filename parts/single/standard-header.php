<header class="article-header">

    <?php if( is_singular('column') ) { ?>
    <a href="<?php echo get_post_type_archive_link('column'); ?>" class="article-section">Column</a>
    <?php } else { ?>
    <a href="<?php echo esc_url(get_category_link( get_the_category()[0]->term_id )); ?>" class="article-section"><?php echo esc_html( getSection() ); ?></a>
    <?php } ?>

    <div class="headline">
        <h1><?php echo esc_html( get_the_title() ); ?></h1>
        <h2 class="subheadline"><?php echo esc_html( get_field('subheadline') ); ?></h2>
    </div>

    <?php if( get_field('slideshow') && isShown('slideshow') ) { ?>
        <?php get_template_part('parts/single/slideshow'); ?>
    <?php } else if( has_post_thumbnail() && ( !get_field('slideshow') || !isShown('slideshow') ) ) { ?>
        <?php get_template_part('parts/single/featured-image'); ?>
    <?php } ?>

    <?php if( !is_singular('page') ) { ?>
        <?php get_template_part('parts/single/article-meta'); ?>
    <?php } ?>

</header>