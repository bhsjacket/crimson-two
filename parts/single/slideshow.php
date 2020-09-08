<div class="slideshow-wrapper at-start">

    <div class="slideshow">

        <?php $slideshow = get_field('slideshow'); ?>

        <div class="slide active-slide">
            <div class="slide-image" style="background-image: url(<?php echo $slideshow[0]['sizes']['medium_large']; ?>)"></div>
            <div class="caption-group">
                <p class="caption-content"><?php echo $slideshow[0]['caption']; ?></p>
                <p class="caption-credit"><?php echo get_field( 'media_author', $slideshow[0]['id'] ); ?></p>
            </div>
        </div>

        <?php unset( $slideshow[0] ); // First item must be different because it needs active-slide class ?>

        <?php foreach( $slideshow as $image ) { ?>

        <div class="slide hidden-slide-right">
            <div class="slide-image" style="background-image: url(<?php echo $image['sizes']['medium_large']; ?>)"></div>
            <div class="caption-group">
                <p class="caption-content"><?php echo $image['caption']; ?></p>
                <p class="caption-credit"><?php echo get_field( 'media_author', $image['id'] ); ?></p>
            </div>
        </div>

        <?php } ?>

    </div>

    <button class="slideshow-button prev-button"><i class="far fa-chevron-left"></i></button>
    <button class="slideshow-button next-button"><i class="far fa-chevron-right"></i></button>

</div>