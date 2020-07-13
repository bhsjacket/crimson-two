<?php get_header(); ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/style-guide.css">

    <main id="style-guide">

        <div class="style-guide-title">

            <h1 class="style-guide-title">Berkeley High Jacket <span><?php echo get_the_title(); ?></span></h1>
            <h2 class="style-guide-byline">Site Design & Development by Jerome Paulos</h2>

        </div>

        <div class="style-guide-content">

            <?php while(have_posts()): the_post() ?>
                <?php the_content(); ?>
            <?php endwhile; ?>

        </div>

        <div class="style-guide-color-chips">

            <div class="style-guide-primary-colors">

                <div class="style-guide-color" data-color="red" data-text-color="light">
                    <span class="color-code">#800000</span>
                </div>

                <div class="style-guide-color" data-color="yellow">
                    <span class="color-code">#ffd53e</span>
                </div>

                <div class="style-guide-color" data-color="green" data-text-color="light">
                    <span class="color-code">#006d67</span>
                </div>

                <div class="style-guide-color" data-color="blue" data-text-color="light">
                    <span class="color-code">#14506e</span>
                </div>

                <div class="style-guide-color" data-color="purple" data-text-color="light">
                    <span class="color-code">#622956</span>
                </div>

                <div class="style-guide-color" data-color="gray" data-text-color="light">
                    <span class="color-code">#808080</span>
                </div>

            </div>

            <div class="style-guide-colors">

                <div class="style-guide-color" data-color="dark-red" data-text-color="light">
                    <span class="color-code">#670000</span>
                </div>
                <div class="style-guide-color" data-color="pale-red">
                    <span class="color-code">#fce1e1</span>
                </div>

                <div class="style-guide-color" data-color="dark-yellow">
                    <span class="color-code">#e6bc25</span>
                </div>
                <div class="style-guide-color" data-color="pale-yellow">
                    <span class="color-code">#fffadf</span>
                </div>

                <div class="style-guide-color" data-color="dark-green" data-text-color="light">
                    <span class="color-code">#00544e</span>
                </div>
                <div class="style-guide-color" data-color="pale-green">
                    <span class="color-code">#d7eaf3</span>
                </div>

                <div class="style-guide-color" data-color="dark-blue" data-text-color="light">
                    <span class="color-code">#003755</span>
                </div>
                <div class="style-guide-color" data-color="pale-blue">
                    <span class="color-code">#d7eaf3</span>
                </div>

                <div class="style-guide-color" data-color="dark-purple" data-text-color="light">
                    <span class="color-code">#49103d</span>
                </div>
                <div class="style-guide-color" data-color="pale-purple">
                    <span class="color-code">#e7cee1</span>
                </div>

                <div class="style-guide-color" data-color="dark-gray" data-text-color="light">
                    <span class="color-code">#5c5c5c</span>
                </div>
                <div class="style-guide-color" data-color="light">
                    <span class="color-code">#e7e7e7</span>
                </div>

            </div>

        </div>

        <div class="style-guide-fontbook">

            <h2 contenteditable="true" data-shuffle-font="true" class="display-font">Span is for headlines</h2>
            <h2 contenteditable="true" data-shuffle-font="true" class="display-alt-font">Span Condensed is to mix things up a bit</h2>
            <h2 contenteditable="true" data-shuffle-font="true" class="serif-font">PT Serif Pro is for body text and whatever</h2>
            <h2 contenteditable="true" data-shuffle-font="true" class="sans-font">PT Sans Pro should be used sparingly and for labels</h2>

            <div class="button-group">
                <a target="_blank" href="https://use.typekit.net/erm4tbu.css" class="button typekit-button"><i class="far fa-globe"></i>Typekit</a>
                <a target="_blank" href="https://www.dropbox.com/sh/ca3fkle2chjuekr/AADM-GngnxcOD_mRF2f3BivBa?dl=0" class="button"><i class="fab fa-dropbox"></i>Dropbox</a>
            </div>

        </div>

        <div class="style-guide-components">
            <blockquote contenteditable="true">It was a mistake to meddle in our affairs. I shall now have to dispose of you. Fortunately, I happen to be medical superintendent of a private mental institution: rather a special institution. Not all of my patients are insane when they are admitted.</blockquote>
            <p contenteditable="true" data-return="allowed">It is a truth universally acknowledged, that a <a>single man</a> in possession of a good fortune, must be in want of a wife. However little known the feelings or views of such a man may be on <a>his first entering a neighbourhood</a>, this truth is so well fixed in the minds of the surrounding families, that he is considered the rightful property of some one or other of their daughters.</p>

            <img class="zoom featured-image" src="<?php echo get_template_directory_uri(); ?>/assets/404-small.jpg">
            <div class="caption-group">
                <p contenteditable="true" class="caption-content">Call me Ishmael</p>
                <p contenteditable="true" class="caption-credit">Flickr</p>
            </div>
        </div>

        <div class="style-guide-examples">

            <h2 class="style-guide-section" data-shuffle-font="true" contenteditable="true">Design System in Use</h2>

            <div class="example-gallery">

                <img class="zoom" src="<?php echo get_template_directory_uri(); ?>/assets/style-guide/inspo1.png">
                <img class="zoom" src="<?php echo get_template_directory_uri(); ?>/assets/style-guide/inspo2.png">
                <img class="zoom" src="<?php echo get_template_directory_uri(); ?>/assets/style-guide/inspo3.png">
                <img class="zoom" src="<?php echo get_template_directory_uri(); ?>/assets/style-guide/inspo4.png">
                <img class="zoom" src="<?php echo get_template_directory_uri(); ?>/assets/style-guide/inspo5.png">

            </div>

        </div>

        <h2 class="style-guide-section" data-shuffle-font="true" contenteditable="true">“Class with some sass”</h2>

    </main>

<script src="<?php echo get_template_directory_uri(); ?>/js/style-guide.js"></script>
<?php get_footer(); ?>