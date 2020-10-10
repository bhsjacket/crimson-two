<?php

$title = get_field('title');
$description = get_field('description');

?>

<noscript>JavaScript is required for this audio player to function.</noscript>

<div class="audio-player loading">
    <div class="audio-meta">
        <?php if( $title || $description ) { ?>
        <div class="text">
            <?php if( $title ) { ?>
            <h2 class="audio-title"><?php echo $title; ?></h2>
            <?php } ?>
            <?php if( $description ) { ?>
            <p class="audio-description"><?php echo $description; ?></p>
            <?php } ?>
        </div>
        <?php } ?>
        <?php if( $image = get_field('image') ) { ?>
        <div class="audio-image">
            <img src="<?php echo $image['sizes']['thumbnail']; ?>">
        </div>
        <?php } ?>
    </div>        
    <div class="audio">
        <audio src="<?php echo get_field('audio'); ?>"></audio>
        <i class="fas fa-play play-pause"></i>
        <input type="range" class="audio-progress" value="0">
        <span class="audio-time">00:00</span>
    </div>
</div>