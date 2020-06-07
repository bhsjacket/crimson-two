<?php get_header(); ?>
<?php while(have_posts()): the_post() ?>

<main id="single">
    <header class="article-header">
        <div class="headline">
            <h1><?php echo get_the_title(); ?></h1>
        </div>
        <div class="article-meta">
            <div class="byline">
                <div class="avatars">
                    <?php if( function_exists( 'get_coauthors') ) { ?>

                    <?php foreach( get_coauthors() as $coauthor ) { ?>
                    <img src="<?php echo get_avatar_url( $coauthor->ID ); ?>">
                    <?php }} else { ?>

                    <img src="<?php echo get_avatar_url( $post->post_author ); ?>">

                    <?php } ?>
                </div>
                <?php if( function_exists( 'get_coauthors') ) { ?>

                <span class="byline-authors">By <?php if(empty(get_field('custom_byline'))) { coauthors_posts_links(); } else { echo '<a href="#authors">' . get_field('custom_byline') . '</a>'; }; ?><span class="byline-in"> in</span>
                <a class="byline-section" href="<?php echo esc_url(get_category_link( get_the_category()[0]->term_id )); ?>">
                    <?php echo esc_html( get_the_category()[0]->name ); ?></a>
                </span>

                <?php } else { ?>

                <span class="byline-authors">By <a href="<?php echo get_author_posts_url($post->$post_author); ?>"><?php echo get_the_author_meta( 'display_name' ); ?></a><span class="byline-in"> in</span>
                <a class="byline-section" href="<?php echo esc_url(get_category_link( get_the_category()[0]->term_id )); ?>">
                    <?php echo esc_html( get_the_category()[0]->name ); ?></a>
                </span>

                <?php } ?>
            </div>
            <span class="post-date" aria-label="Published at <?php echo get_the_date('g:i A T'); ?>" data-balloon-pos="down-right"><?php echo get_the_date(); ?></span>
        </div>
        <?php if( has_post_thumbnail() ) { ?>
        <div class="featured-image-outer">
            <img class="featured-image zoom" src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'large', false)[0]; ?>">
            <div class="caption-group">
                <p class="caption-content"><?php echo wp_get_attachment_caption( get_post_thumbnail_id() ); ?></p>
                <p class="caption-credit"><?php echo get_field( 'credit', get_post_thumbnail_id() ); ?></p>
            </div>
        </div>
        <?php } ?>
    </header>
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
    <div class="recommended-posts">
        <?php
        $args_recommended_posts = array(
            'post_type' => array( 'post', 'gallery' ),
            'post_status' => array( 'publish' ),
            'posts_per_page' => 3,
            'nopaging' => true,
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
        <?php }} wp_reset_postdata(); ?>
    </div>
    <?php get_template_part( 'parts/comments' ); ?>
</main>

<?php endwhile; ?>
<?php get_footer(); ?>

