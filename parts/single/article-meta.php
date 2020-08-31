<div class="article-meta">

	<div class="meta-top">

		<div class="avatars">
            <?php foreach( get_coauthors() as $coauthor ) { ?>
            <img alt="The avatar of <?php echo $coauthor->display_name; ?>" src="<?php echo get_avatar_url( $coauthor->ID ); ?>">
            <?php } ?>
		</div>

		<p class="byline">By <?php coauthors_posts_links(); ?></p>

	</div>

	<div class="meta-bottom">

		<div class="meta-bottom-left">
			<time class="post-date"><?php echo get_the_date('F j, Y'); ?></time>
		</div>

		<div class="meta-bottom-right">
			<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_permalink()); ?>"><i class="fab fa-facebook"></i></a>
			<a target="_blank" href="https://twitter.com/intent/tweet?url=<?php echo esc_url(get_permalink()); ?>"><i class="fab fa-twitter"></i></a>
			<a href="mailto:?subject=<?php echo esc_html(get_the_title()); ?>&body=<?php echo esc_url(get_permalink()); ?>"><i class="fas fa-envelope"></i></a>
			<a href="#comments"><i class="fas fa-comment"></i></a>
		</div>

	</div>

</div>