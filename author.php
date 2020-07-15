<?php get_header(); ?>
<?php
$author = get_userdata( get_queried_object_id() );

$query_args = array(
	'post_type' => array('post','column'),
	'post_status' => array('publish'),
    'posts_per_page' => 10,
    'offset' => (int)$_GET['offset'] ?? 0,
	'ignore_sticky_posts' => true,
	'order' => 'DESC',
    'author' => $author->ID,
);
$query = new WP_Query( $query_args );
?>

<main id="author">

    <header class="author-info">
        
        <img class="avatar" src="<?php echo get_avatar_url( $author->ID ); ?>">
        <?php if( $gradYear = get_user_meta($author->ID, 'grad_year', true) ) { ?>
        <script src="<?php echo get_template_directory_uri(); ?>/js/color-hash.min.js"></script>
        <script>
        var colorHash = new ColorHash({lightness: 0.5});
        colorHash = colorHash.hex('<?php echo $gradYear; ?>');
        $(document).ready(function(){
            $('.grad-pennant-color').attr('fill', colorHash);
        })
        </script>
        <svg title="Class of <?php echo $gradYear; ?>" aria-hidden="true" class="grad-pennant" xmlns="http://www.w3.org/2000/svg" style="isolation:isolate" viewBox="-193.092 276.711 530.092 388.289">
            <path fill="#774D2D" d="M150.985864 344.53353l22.18948-11.368992 164.07108 320.22645-22.18948 11.368992z"/>
            <path class="grad-pennant-color" fill="#800000" d="M-193.092 553.103l421.414-111.827-84.215-164.565z"/>
            <text title="Class of <?php echo $gradYear; ?>" transform="matrix(.875 -.485 .485 .875 33.486 468.19)" font-family="span, pt-sans-pro, PT Sans, pt-serif-pro, PT Serif, sans-serif, serif" font-weight="400" font-size="77" fill="#fff"><?php echo $gradYear; ?></text>
        </svg>
        <?php } ?>

        <div class="author-bio">

            <?php
            $years = get_user_meta($author->ID, 'jacket_years', true);
            $startYear = substr($years[0], 0, 4);
            $endYear = substr(array_reverse($years)[0], 0, 4);
            if($endYear == date('Y')) {
                $endYear = 'Present';
            }
            ?>

            <h2 class="author-name"><?php echo $author->display_name; ?></h2>
            <span class="author-position"><?php echo get_user_meta($author->ID, 'position', true); ?></span>
            <span class="author-position">On staff <?php echo $startYear; ?> to <?php echo $endYear; ?></span>
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

    <div class="articles" data-page="1">

    <?php if($query->have_posts()): while($query->have_posts()): $query->the_post(); ?>

        <a class="article" href="<?php echo get_permalink(); ?>">
            <?php the_post_thumbnail('small-three-two'); ?>
            <div class="article-info">
                <span class="article-section"><?php echo get_the_category()[0]->cat_name; ?></span>
                <h2 class="article-title"><?php echo get_the_title(); ?></h2>
                <span class="article-meta">By <?php coauthors(); ?> on <?php echo get_the_date('F j, Y'); ?></span>
            </div>
        </a>

    <?php endwhile; ?>
    <img src="<?php echo get_template_directory_uri(); ?>/assets/loader.svg" class="search-loader">
    <?php else: ?>
    <p class="no-posts">No results found.</p>
    <?php endif; wp_reset_postdata(); ?>

    </div>

</main>

<script src="<?php echo get_template_directory_uri(); ?>/js/author.js"></script>
<?php get_footer(); ?>