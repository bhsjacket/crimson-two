<?php

$excludedPosts = [];

function getPosts(int $posts, string $category = null, $tag = null) {
    global $excludedPosts;

    $query = new WP_Query([
        'post_type' => ['post'],
        'post_status' => ['publish'],
        'posts_per_page' => $posts,
        'nopaging' => false,
        'category_name' => $category,
        'tag' => $tag,
        'post__not_in' => $excludedPosts,
    ]);

    while( $query->have_posts() ) {
        $query->the_post();
        $excludedPosts[] = get_the_ID();
    }

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

$s1_2 = getPosts(1);
$s1_1 = getPosts(3);

$s2_1 = getPosts(1);
$s2_2 = getPosts(2);
$s2_3 = getColumns(5);

$s3_1 = getPosts(1, 'features');
$s3_2 = getColumns(2, 5);
$s3_3 = getPosts(3, 'features');

$s4_1 = getPosts(1);
$s4_2 = getPosts(1);
$s4_3 = getPosts(2);

$rowSections = [
    [
        'title' => false,
        'category' => 'news',
        'class' => 'no-border'
    ],
    [
        'title' => 'Coronavirus Coverage',
        'tag' => 'coronavirus',
        'class' => 'highlighted no-border'
    ],
    [
        'title' => 'Election Corner',
        'class' => 'highlighted gray-highlight no-border'
    ],
    [
        'title' => false,
        'category' => 'sports'
    ],
];

?>

<?php get_header(); ?>

<main id="front-page">

    <section class="top-story">

        <div class="top-story__left">
            <div class="top-story__left-top">
                <?php while($s1_1->have_posts()) { $s1_1->the_post(); ?>

                <a class="small-item" href="<?php echo get_permalink(); ?>">
                    <img src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail')[0]; ?>" class="small-item-image">
                    <h2 data-lines="3" class="small-item-title"><span class="article-category"><?php echo esc_html( getSection() ); ?></span><?php echo esc_html( get_the_title() ); ?></h2>
                </a>

                <?php } wp_reset_postdata(); ?>
            </div>

            <?php while($s1_2->have_posts()) { $s1_2->the_post(); ?>
            <div class="top-story__left-bottom the-doug-border">
                <?php if( $slideshow = get_field('slideshow') ) { ?>
                <a href="<?php echo get_permalink(); ?>" class="slideshow">
                    <?php $slideshow = array_slice($slideshow, 0, 5); // Only the first five images ?>
                    <?php foreach($slideshow as $image) { ?>
                    <img src="<?php echo $image['sizes']['small-three-two']; ?>">
                    <?php } ?>
                </a>
                <?php } else { ?>
                <a href="<?php echo get_permalink(); ?>">
                    <?php the_post_thumbnail('small-three-two'); ?>
                </a>
                <?php } ?>
                <a href="<?php echo get_permalink(); ?>" class="top-story__left-bottom-title">
                    <span class="article-category"><?php echo esc_html( getSection() ); ?></span>
                    <h2 class="top-story__title"><?php echo esc_html( get_the_title() ); ?></h2>
                    <p class="article-excerpt" data-lines="6"><?php echo esc_html( getExcerpt() ?? get_field('subheadline') ); ?></p>
                </a>
            </div>
            <?php } wp_reset_postdata(); ?>
        </div>

        <div class="top-story__right dynamic-content" style="height:100%">

            <?php $dynamicContent = get_field('dynamic_content_image', 'option') ? 'image' : get_field('dynamic_content', 'option') ?? 'podcast';
            get_template_part('parts/front-page/dynamic-content/' . $dynamicContent); ?>

        </div>

    </section>

    <section class="grid two-one-one double-gap borders no-border">

        <?php while($s2_1->have_posts()) { $s2_1->the_post(); ?>
        <a class="centered" href="<?php echo get_permalink(); ?>">
            <?php the_post_thumbnail('small-three-two'); ?>
            <span class="article-category"><?php echo getSection(); ?></span>
            <h1 class="article-title"><?php echo get_the_title(); ?></h1>
            <p class="article-excerpt"><?php echo getExcerpt(); ?></p>
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
                    <span class="article-category"><?php echo getSection(); ?></span>
                    <h1 class="article-title"><?php echo get_the_title(); ?></h1>
                    <p class="article-excerpt"><?php getExcerpt(); ?></p>
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

        <?php $rowQuery = getPosts(4, $section['category'], $section['tag']); ?>

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
                    <p class="article-excerpt"><?php echo getExcerpt(); ?></p>
                </article>
            </a>
            <?php } wp_reset_postdata(); ?>

        </div>
    </section>
    <?php } ?>

    <section class="grid four-three borders double-gap heap">

        <?php while( $s4_1->have_posts() ) { $s4_1->the_post() ?>
        <a class="centered" href="<?php echo get_permalink(); ?>">
            <?php the_post_thumbnail('three-two'); ?>
            <h2 class="article-title"><?php echo get_the_title(); ?></h2>
            <p class="article-excerpt"><?php echo getExcerpt(); ?></p>
        </a>
        <?php } ?>

        <div class="grid one-one double-stack borders double-gap">

            <?php while( $s4_2->have_posts() ) { $s4_2->the_post() ?>
            <a class="stack-item grid one-one align-middle horizontal-item double-gap" href="<?php echo get_permalink(); ?>">
                <?php the_post_thumbnail('small-three-two'); ?>
                <div>
                    <span class="article-category"><?php echo getSection(); ?></span>
                    <h2 class="article-title"><?php echo get_the_title(); ?></h2>
                </div>
            </a>
            <?php } ?>

            <?php while( $s4_3->have_posts() ) { $s4_3->the_post() ?>
            <a class="stack-item" href="<?php echo get_permalink(); ?>">
                <?php the_post_thumbnail('small-three-two'); ?>
                <h2 class="article-title"><?php echo get_the_title(); ?></h2>
                <p class="article-excerpt" data-lines="5"><?php echo getExcerpt(); ?></p>
            </a>
            <?php } ?>

        </div>

    </section>

</main>

<script src="<?php echo get_template_directory_uri(); ?>/js/front-page.js"></script>
<?php get_footer(); ?>