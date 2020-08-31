<div class="compact-article-meta">
    <div class="byline">
        <div class="avatars">
            <?php if( function_exists( 'get_coauthors') ) { ?>

            <?php foreach( get_coauthors() as $coauthor ) { ?>
            <img src="<?php echo get_avatar_url( $coauthor->ID ); ?>">
            <?php }} else { ?>

            <img src="<?php echo get_avatar_url( $post->post_author ); ?>">

            <?php } ?>
        </div>

        <span class="byline-authors">By <?php coauthors_posts_links(); ?></span>

    </div>
    <span class="post-date"><?php echo get_the_date(); ?></span>
</div>