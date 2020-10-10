<?php

$endpoint = 'https://anchor.fm/api/v3/profile/eafe278';
$data = file_get_contents($endpoint);
$data = json_decode($data, true);

$urls = $data['podcastUrlDictionary'];
$audio = $data['episodeAudios'][0]['audioUrl'];

$data = $data['episode'];

$duration = $data['duration'];
$date = new DateTime($data['publishOn']);
$description = $data['description'];
$title = $data['title'];
$image = $data['episodeImage'] ?? get_template_directory_uri() . '/assets/podcast-pattern.png';

?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/parts/front-page/dynamic-content/podcast.css">

<div class="podcast">

    <div class="podcast-header">
        <h2 class="section-header">Podcast</h2>
        <div class="podcast-levels">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <header class="grid two-three align-middle">
        <div class="podcast-cover">
            <img class="podcast-image" src="<?php echo $image; ?>">
            <i class="fas fa-play play-pause"></i>
            <svg class="play-progress" width="120" height="120" viewBox="0 0 120 120">
	            <circle stroke-width="5" fill="transparent" r="52" cx="60" cy="60" />
            </svg>
        </div>
        <div class="grid podcast-info">
            <h2 class="podcast-title" data-lines="2"><?php echo $title; ?></h2>
            <span class="podcast-date"><?php echo $date->format('F j, Y'); ?></span>
        </div>
    </header>

    <div class="podcast-description-wrapper">
        <div class="podcast-description">
            <?php echo $description; ?>
        </div>
    </div>

    <div class="podcast-buttons">
        <a target="_blank" href="<?php echo $urls['itunes']; ?>" class="podcast-button">
            <i class="far fa-podcast"></i>
            <span>Apple Podcasts</span>
        </a>
        <a target="_blank" href="<?php echo $urls['spotify']; ?>" class="podcast-button">
            <i class="fab fa-spotify"></i>
            <span>Spotify</span>
        </a>
        <a target="_blank" href="<?php echo $urls['googlePodcasts']; ?>" class="podcast-button">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/google-podcasts.svg">
            <span>Google Podcasts</span>
        </a>
    </div>

</div>

<script>
    var podcastAudioURL = '<?php echo $audio; ?>';
</script>
<script src="<?php echo get_template_directory_uri(); ?>/parts/front-page/dynamic-content/podcast.js"></script>