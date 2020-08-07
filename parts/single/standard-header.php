<header class="article-header<?php if( empty( get_field('subheadline') ) ) { echo ' has-subheadline'; }; ?>">

    <?php if( is_singular('column') ) { ?>
    <a href="<?php echo get_post_type_archive_link('column'); ?>" class="article-section">Column</a>
    <?php } else { ?>
    <a href="<?php echo esc_url(get_category_link( get_the_category()[0]->term_id )); ?>" class="article-section"><?php echo esc_html( get_the_category()[0]->name ); ?></a>
    <?php } ?>

    <div class="headline">
        <h1><?php echo esc_html( get_the_title() ); ?></h1>
        <?php if(!empty( get_field('subheadline') )) { ?>
        <h2 class="subheadline"><?php echo esc_html( get_field('subheadline') ); ?></h2>
        <?php } ?>
    </div>

    <?php if( !is_singular( 'page' ) && empty( get_field('subheadline') ) ) { ?>
        <?php get_template_part('parts/single/compact-article-meta'); ?>
    <?php } ?>

    <?php if( has_post_thumbnail() ) { ?>
    <div class="featured-image-outer <?php echo get_field('image_size') ?? 'align-normal'; ?>">
        <?php the_post_thumbnail('large', [
            'class' => 'featured-image zoom'
        ]) ?>
        <div class="caption-group">
            <p class="caption-content"><?php echo esc_html( get_field('featured_image_caption') ); ?></p>
            <p class="caption-credit"><?php echo esc_html( get_field('featured_image_author') ); ?></p>
        </div>
    </div>
    <?php } ?>

    <?php if( !is_singular( 'page' ) && !empty( get_field('subheadline') ) ) { ?>
        <?php get_template_part('parts/single/article-meta'); ?>
    <?php } ?>

</header>