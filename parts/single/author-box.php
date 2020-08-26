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

<?php } ?>