<?php
if($is_preview) { echo '<style>.call-to-action{pointer-events:none}</style>'; }

$type = get_field('cta');
if($type == 'podcast') { ?>

<div class="call-to-action podcast-cta">
    <h2 class="cta-top-title">Subscribe to the</h2>
    <h2 class="cta-title">Berkeley High Jacket  <span class="podcast-cta-label">Podcast</span></h2>
    <div class="podcast-buttons">
        <a target="_blank" href="https://podcasts.apple.com/us/podcast/the-berkeley-high-jacket-podcast/id1483162201">
            <img class="apple-podcasts" src="<?php echo get_template_directory_uri() ?>/assets/apple-podcasts.jpg" title="Apple Podcasts">
        </a>
        <a target="_blank" href="https://open.spotify.com/show/1L86dooKMWUFeU6wcmKgoJ">
            <img class="spotify" src="<?php echo get_template_directory_uri() ?>/assets/spotify.jpg" title="Spotify">
        </a>
        <a target="_blank" href="https://www.google.com/podcasts?feed=aHR0cHM6Ly9hbmNob3IuZm0vcy9lYWZlMjc4L3BvZGNhc3QvcnNz">
            <img class="google-podcasts" src="<?php echo get_template_directory_uri() ?>/assets/google-podcasts.jpg" title="Google Podcasts">
        </a>
        <a target="_blank" href="https://pca.st/6ej7c7wz">
            <img class="pocket-casts" src="<?php echo get_template_directory_uri() ?>/assets/pocket-casts.jpg" title="Pocket Casts">
        </a>
        <a target="_blank" href="https://anchor.fm/bhsjacket">
            <img class="anchor-fm" src="<?php echo get_template_directory_uri() ?>/assets/anchor.jpg" title="Anchor (more options)">
        </a>
    </div>
</div>

<?php } else if($type == 'newsletter') { ?>

<p style="background-color:var(--pale-red);padding:var(--gap);">Do not use this block externally yet.</p>

<div class="call-to-action newsletter-cta">
    <i class="far fa-envelope-open"></i>
    <h2 class="cta-top-title">Subscribe to our</h2>
    <h2 class="cta-title">Biweekly Newsletter</h2>
    <form class="newsletter-cta-form" action="https://bhsjacket.us20.list-manage.com/subscribe/post?u=cd770a9475cd688fc6dcac8f1&id=43ce4620e7" method="POST" target="_blank">
        <input placeholder="Enter your email..." type="email" name="EMAIL">
        <button>Sign Up</button>
    </form>
</div>

<script>
    jQuery('.newsletter-cta-form > button').hover(function(){
        jQuery('.call-to-action.newsletter-cta > i').toggleClass('fa-envelope-open');
        jQuery('.call-to-action.newsletter-cta > i').toggleClass('fa-heart');
    })
</script>

<?php } else if($type == 'donate') { ?>

    <p style="background-color:var(--pale-red);padding:var(--gap);">This layout is not available yet. Do not use this block.</p>

<?php } else if($type == 'subscribe') { ?>

    <p style="background-color:var(--pale-red);padding:var(--gap);">This layout is not available yet. Do not use this block.</p>

<?php } else { ?>

    <p style="background-color:var(--pale-red);padding:var(--gap);">Oops! Something isn't right! Make sure that a valid call to action is selected.</p>
    
<?php } ?>