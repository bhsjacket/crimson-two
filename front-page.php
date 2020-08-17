<?php

$excludedPosts = [];

$main_query = new WP_Query([
    'post_type' => ['post'],
    'post_status' => ['publish'],
    'posts_per_page' => 1,
    'meta_key' => '_thumbnail_id',
    'nopaging' => false,
    'tax_query' => [
        [
            'taxonomy' => 'syndication',
            'field' => 'slug',
            'terms' => ['front-feature'],
        ],
    ],
]);

while($main_query->have_posts()) { $main_query->the_post();
    $excludedPosts[] = get_the_ID();
}

$small_query = new WP_Query([
    'post_type' => ['post'],
	'post_status' => ['publish'],
    'posts_per_page' => 3,
    'meta_key' => '_thumbnail_id',
    'nopaging' => false,
    'post__not_in' => $excludedPosts,
]);

while($small_query->have_posts()) { $small_query->the_post();
    $excludedPosts[] = get_the_ID();
}

function getPosts(int $offset, int $posts, string $category = null, $tag = null) {
    global $excludedPosts;

    $query = new WP_Query([
        'post_type' => ['post'],
        'post_status' => ['publish'],
        'posts_per_page' => $posts,
        'nopaging' => false,
        'category_name' => $category,
        'tag' => $tag,
        'offset' => $offset,
        'post__not_in' => $excludedPosts,
    ]);

    while( $query->has_posts() ): $query->the_post();
        $excludedPosts[] = get_the_ID();
    endwhile;

    return $query;
}

function getColumns(int $posts, int $offset = 0) {
    return new WP_Query([
        'post_type' => ['column'],
        'post_status' => ['publish'],
        'posts_per_page' => $posts,
        'nopaging' => false,
        'offset' => $offset
    ]);
}

$s2_1 = getPosts(0, 1);
$s2_2 = getPosts(1, 2);
$s2_3 = getColumns(5);

$s3_1 = getPosts(1, 1, 'features');
$s3_2 = getColumns(2, 5);
$s3_3 = getPosts(2, 3, 'features');

$rowSections = [
    [
        'title' => false,
        'category' => 'news'
    ],
    [
        'title' => 'Coronavirus Coverage',
        'tag' => 'coronavirus',
        'class' => 'highlighted'
    ],
    [
        'title' => false,
        'category' => 'sports'
    ],
];

?>

<?php get_header(); ?>

<main id="front-page">

    <section class="dense">

        <div class="dense-left">
            <div class="dense-left-top">
                <?php while($small_query->have_posts()) { $small_query->the_post(); ?>

                <a class="small-item" href="<?php echo get_permalink(); ?>">
                    <img src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail')[0]; ?>" class="small-item-image">
                    <h2 data-lines="3" class="small-item-title"><span class="article-category"><?php echo esc_html( getSection() ); ?></span><?php echo esc_html( get_the_title() ); ?></h2>
                </a>

                <?php } wp_reset_postdata(); ?>
            </div>

            <?php while($main_query->have_posts()) { $main_query->the_post(); ?>
            <a class="dense-left-bottom" href="<?php echo get_permalink(); ?>">
                <?php if( $slideshow = get_field('slideshow') ) { ?>
                <div class="slideshow">
                    <?php $slideshow = array_slice($slideshow, 0, 5); // Only the first five images ?>
                    <?php foreach($slideshow as $image) { ?>
                    <img src="<?php echo $image['sizes']['three-two']; ?>" alt="">
                    <?php } ?>
                </div>
                <?php } else { ?>
                <?php the_post_thumbnail('three-two'); ?>
                <?php } ?>
                <div class="dense-left-bottom-title">
                    <span class="article-category"><?php echo esc_html( getSection() ); ?></span>
                    <h2 class="dense-title"><?php echo esc_html( get_the_title() ); ?></h2>
                    <p class="article-excerpt" data-lines="6"><?php echo esc_html( get_field('homepage_excerpt') ?? get_field('subheadline') ); ?></p>
                </div>
            </a>
            <?php } wp_reset_postdata(); ?>
        </div>

        <div class="dense-right dynamic-content" style="height:100%">

            <?php

            $timeZone = new DateTimeZone('America/Los_Angeles');
            $currentTime = new DateTime('now', $timeZone);
            $morningStart = DateTime::createFromFormat('H:i a', '6:30 am', $timeZone);
            $morningEnd = DateTime::createFromFormat('H:i a', '10:30 am', $timeZone);
            $eveningStart = DateTime::createFromFormat('H:i a', '5:00 pm', $timeZone);
            $nightEnd = DateTime::createFromFormat('H:i a', '10:00 pm', $timeZone);
            if ($currentTime > $morningStart && $currentTime < $morningEnd || $currentTime > $eveningStart && $currentTime < $nightEnd) {
                get_template_part('parts/front-page/dynamic-content/weather');
            } else {
                if( rand(0, 7) == 7 ) {
                    get_template_part('parts/front-page/dynamic-content/podcast');
                } else {
                    get_template_part('parts/front-page/dynamic-content/coronavirus');
                }
            }

            ?>

        </div>

    </section>

    <section class="grid three-two-three double-gap borders no-border">

        <?php while($s2_1->have_posts()) { $s2_1->the_post(); ?>
        <a class="centered" href="<?php echo get_permalink(); ?>">
            <?php the_post_thumbnail('small-three-two'); ?>
            <span class="article-category"><?php echo getSection(); ?></span>
            <h1 class="article-title"><?php echo get_the_title(); ?></h1>
            <p class="article-excerpt"><?php echo get_field('homepage_excerpt'); ?></p>
        </a>
        <?php } wp_reset_postdata(); ?>

        <div class="stack">

            <?php while($s2_2->have_posts()) { $s2_2->the_post(); ?>
            <a href="<?php echo get_permalink(); ?>" class="stack-item grid">
                <h2 class="article-title"><?php echo get_the_title(); ?></h2>
                <?php the_post_thumbnail('small-three-two'); ?>
            </a>
            <?php } wp_reset_postdata(); ?>

        </div>

        <div class="columnist-stack grid">

            <?php $hasDisplayedThumbnail = false; ?>
            <?php while($s2_3->have_posts()) { $s2_3->the_post(); ?>
            <a href="<?php echo get_permalink(); ?>" class="item">
                <?php if( has_post_thumbnail() && $hasDisplayedThumbnail === false ) { ?>
                <?php the_post_thumbnail('thumbnail', ['class' => 'article-image']); ?>
                <?php $hasDisplayedThumbnail = true; ?>
                <?php } else { ?>
                <img src="<?php echo get_avatar_url( get_the_author_meta('email') ); ?>" class="avatar">
                <?php } ?>
                <div class="column-info">
                    <h2 class="columnist"><?php echo get_the_author_meta('display_name'); ?></h2>
                    <h2 class="article-title"><?php echo get_the_title(); ?></h2>
                </div>
            </a>
            <?php } wp_reset_postdata(); ?>

        </div>

    </section>

    <section class="ad-container"></section>

    <section class="grid two-one double-gap borders">

        <div class="grid double-gap">

            <?php while($s3_1->have_posts()) { $s3_1->the_post(); ?>
            <div class="standard grid one-two align-middle">
                
                <a href="<?php echo get_permalink(); ?>" class="article-info">
                    <span class="article-category"><?php echo get_categories()[0]->cat_name; ?></span>
                    <h1 class="article-title"><?php echo get_the_title(); ?></h1>
                    <p class="article-excerpt"><?php get_field('homepage_excerpt'); ?></p>
                </a>

                <a href="<?php echo get_permalink(); ?>">
                    <?php the_post_thumbnail('small-three-two'); ?>
                </a>

            </div>
            <?php } wp_reset_postdata(); ?>

            <div class="columnist-stack grid one-one double-gap borders">

                <?php while($s3_2->have_posts()) { $s3_2->the_post(); ?>
                <a href="<?php echo get_permalink(); ?>" class="item">
                    <img src="<?php echo get_avatar_url( get_the_author_meta('email') ); ?>" class="avatar">
                    <div class="column-info">
                        <h2 class="columnist"><?php echo get_the_author_meta('display_name'); ?></h2>
                        <h2 class="article-title"><?php echo get_the_title(); ?></h2>
                    </div>
                </a>
                <?php } wp_reset_postdata(); ?>

            </div>
            
        </div>
        
        <div class="stack">
            
            <?php while($s3_3->have_posts()) { $s3_3->the_post(); ?>
            <a href="<?php echo get_permalink(); ?>" class="stack-item grid two-three">
                <div>
                    <span class="article-category"><?php echo get_categories()[0]->cat_name; ?></span>
                    <h2 class="article-title"><?php echo get_the_title(); ?></h2>
                </div>
                <?php the_post_thumbnail('small-three-two'); ?>
            </a>
            <?php } wp_reset_postdata(); ?>

        </div>

    </section>

    <?php foreach( $rowSections as $section ) { ?>
    <section class="row <?php echo $section['class'] ? ' ' . $section['class'] : ''; ?>">

        <?php $rowQuery = getPosts(0, 4, $section['category'], $section['tag']); ?>

        <?php if($section['title']) { ?>
        <h2 class="section-header"><?php echo $section['title']; ?></h2>
        <?php } ?>

        <div class="inner grid one-one-one-one borders double-gap" data-section="<?php echo $section['slug']; ?>">

            <?php while( $rowQuery->have_posts() ) { $rowQuery->the_post(); ?>
            <a class="grid row-item" href="<?php echo get_permalink(); ?>">
                <article class="grid">
                    <?php the_post_thumbnail('three-two'); ?>
                    <span class="article-category"><?php echo getSection(); ?></span>
                    <h2 class="article-title"><?php echo get_the_title(); ?></h2>
                    <p class="article-excerpt"><?php echo get_field('homepage_excerpt'); ?></p>
                </article>
            </a>
            <?php } wp_reset_postdata(); ?>

        </div>
    </section>
    <?php } ?>





</main>

<script src="<?php echo get_template_directory_uri(); ?>/js/front-page.js"></script>
<?php get_footer(); ?>