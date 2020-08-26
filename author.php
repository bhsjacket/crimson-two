<?php get_header(); ?>

<?php

$author = get_userdata( get_queried_object_id() );

function stringToColorCode($str) {
    $code = dechex(crc32($str));
    $code = '#' . substr($code, 0, 6);
    return $code;
}

?>

<main id="search">

    <header class="author-info">
        
        <img class="avatar" src="<?php echo get_avatar_url( $author->ID ); ?>">
        <?php if( $gradYear = get_user_meta($author->ID, 'grad_year', true) ) { ?>
        <svg title="Class of <?php echo $gradYear; ?>" aria-hidden="true" class="grad-pennant" xmlns="http://www.w3.org/2000/svg" style="isolation:isolate" viewBox="-193.092 276.711 530.092 388.289">
            <path fill="#774D2D" d="M150.985864 344.53353l22.18948-11.368992 164.07108 320.22645-22.18948 11.368992z"/>
            <path class="grad-pennant-color" fill="<?php echo stringToColorCode($gradYear); ?>" d="M-193.092 553.103l421.414-111.827-84.215-164.565z"/>
            <text title="Class of <?php echo $gradYear; ?>" transform="matrix(.875 -.485 .485 .875 33.486 468.19)" font-family="span, pt-sans-pro, PT Sans, pt-serif-pro, PT Serif, sans-serif, serif" font-weight="400" font-size="77" fill="#fff"><?php echo $gradYear; ?></text>
        </svg>
        <?php } ?>

        <div class="author-bio">

            <?php
            if( $years = get_user_meta($author->ID, 'jacket_years', true) ) {
                $startYear = substr($years[0], 0, 4);
                $endYear = substr(array_reverse($years)[0], 0, 4);
                if($endYear == date('Y')) {
                    $durationText = 'On staff since ' . $startYear;
                } else {
                    $durationText = 'On staff ' . $startYear . '-' . $endYear;
                }
            } else {
                $durationText = false;
            }
            ?>

            <h2 class="author-name"><?php echo $author->display_name; ?></h2>
            <?php if( $position = get_user_meta($author->ID, 'position', true) ) { ?>
            <span class="author-position"><?php echo $position; ?></span>
                <?php if( $durationText ) { ?>
            <span class="author-position"><?php echo $durationText; ?></span>
                <?php } ?>
            <?php } ?>
            <div class="author-contact">
                <?php
                    if( empty( get_user_meta($author->ID, 'links_email', true) ) ) {
                        $email = get_the_author_meta('email');
                    } else {
                        $email = get_user_meta($author->ID, 'links_email', true);
                    }
                ?>
                <a href="mailto:<?php echo $email; ?>"><i class="fas fa-envelope"></i></a>
                <?php if($twitter = get_user_meta($author->ID, 'links_twitter', true)) { ?>
                <a target="_blank" href="<?php echo $twitter; ?>"><i class="fab fa-twitter"></i></a>
                <?php } ?>
                <?php if($instagram = get_user_meta($author->ID, 'links_instagram', true)) { ?>
                <a target="_blank" href="<?php echo $instagram; ?>"><i class="fab fa-instagram"></i></a>
                <?php } ?>
                <?php if($facebook = get_user_meta($author->ID, 'links_facebook', true)) { ?>
                <a target="_blank" href="<?php echo $facebook; ?>"><i class="fab fa-facebook"></i></a>
                <?php } ?>
                <?php if($website = get_user_meta($author->ID, 'links_website', true)) { ?>
                <a target="_blank" href="<?php echo $website; ?>"><i class="far fa-link"></i></a>
                <?php } ?>
            </div>
            <p class="author-bio"><?php echo get_the_author_meta('description'); ?></p>

        </div>

    </header>

    <div class="article-stream">

    <?php if( have_posts() ) { ?>
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
    <?php } else { ?>
        <p>No results found.</p>
    <?php } ?>
    <p style="font-family: 'pt-sans-pro', 'PT Sans', sans-serif;font-style:italic;background-color:#e7e7e7;padding:15px;">We are currently experiencing issues with our attribution system. If you don't see an article you were expecting, please search our website with the button in the top right.</p>

</main>

<?php get_footer(); ?>