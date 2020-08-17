<?php

if( $is_preview ) {
    echo '<style>.podcast-player{pointer-events:none!important;}</style>';
}

$url = get_field('url');
if( substr($url, -7, -6) == '-') {

    $url = substr($url, -6);
    $url = 'https://anchor.fm/api/v3/episodes/' . $url;

    $data = file_get_contents($url);
    $data = json_decode($data, true);

    $audio = $data['episodeAudios'][0]['audioUrl'];
    $date = date('F j, Y', $data['episode']['publishOnUnixTimestamp']);
    $title = $data['episode']['title'];
    $description = $data['episode']['descriptionPreview'];

    if( empty($data['episode']['episodeImage']) ) {
        $image = $data['podcastMetadata']['podcastImage400'];
    } else {
        $image = $data['episode']['episodeImage'];
    }

    $podcast = [
        'title' => $title,
        'date' => $date,
        'audio' => $audio,
        'description' => $description,
        'image' => $image
    ];
?>

<div class="podcast-player">
    <div class="podcast-top">
        <div class="podcast-top-left">
            <span class="podcast-label"><i class="far fa-podcast"></i>Related Episode</span>
            <h2 class="podcast-title"><?php echo $podcast['title']; ?></h2>
            <span class="podcast-date"><?php echo $podcast['date']; ?></span>
        </div>
        <img src="<?php echo $podcast['image']; ?>">
    </div>
    <div class="podcast-bottom">
        <div class="podcast-bottom-left">
            <i title="-10 Seconds" alt="Skip Backwards 10 Seconds" class="far fa-undo"></i>
            <i title="Play/Pause" alt="Play/Pause" class="fas fa-play"></i>
            <i title="+10 Seconds" alt="Skip Forwards 10 Seconds" class="far fa-redo"></i>
        </div>
        <div class="podcast-bottom-right">
            <span class="podcast-time">XX:XX / XX:XX</span>
            <input type="range" value="0" class="seek">
        </div>
    </div>
</div>

<?php } else { ?>
<p style="background-color:var(--pale-red);padding:var(--gap);">Please check that the URL is formatted properly. It should end in 6 random characters that come after the episode name. Remember to remove the trailing slash from the URL as well.</p>
<?php } ?>

<script>
podcastAudioURL = '<?php echo $podcast['audio']; ?>'; // pass URL to podcast.js
</script>