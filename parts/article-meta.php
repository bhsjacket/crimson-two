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