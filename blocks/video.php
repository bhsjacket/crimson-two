<?php
if($is_preview) {
    echo '<style>.video{pointer-events:none!important;}</style>';
}

const ApiKey = 'AIzaSyAC427s1d19T8WpNgy_uYiGeOSmvuPXsm4';

$url = get_field('video_url');
if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $url, $match)) {
    $videoId = $match[1];
} else {
    echo '<p style="padding:15px;background-color:var(--pale-red)">There was an issue with the YouTube URL provided.</p>';
}

$url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails&id=' . $videoId . '&key=' . ApiKey;
$data = file_get_contents($url);
$data = json_decode($data, true);
$data = $data['items'][0];

$duration = new DateTime('@0');
$duration->add( new DateInterval( $data['contentDetails']['duration'] ) );
if( $duration->format('H') == 00 ) {
    $duration = $duration->format('i:s');
} else {
    $duration = $duration->format('H:i:s');
}
$duration = ltrim($duration, 0);

$date = new DateTime($data['snippet']['publishedAt']);
$date = $date->format('F j, Y');

$data = [
    'title' => $data['snippet']['title'],
    'date' => $date,
    'duration' => $duration,
    'thumbnail' => $data['snippet']['thumbnails']['maxres']['url'],
    'hasCaptions' => (boolean)$data['contentDetails']['caption'],
    'videoId' => $videoId
];

?>

<div class="video">
    <img class="video-thumbnail" src="<?php echo get_field('video_thumbnail')['sizes']['three-two'] ?? $data['thumbnail']; ?>">
    <div class="video-overlay">
        <div class="video-play">
            <button></button>
        </div>
        <div class="video-info">
            <div class="video-meta">
                <span class="video-duration"><?php echo $data['duration']; ?></span>
                <?php if($data['hasCaptions']) { ?>
                <i class="far fa-closed-captioning"></i>
                <time class="video-date"><?php echo $data['date']; ?></time>
                <?php } ?>
            </div>
            <h2 class="video-title"><?php echo get_field('video_title') ? get_field('video_title') : $data['title']; ?></h2>
        </div>
    </div>
    <div class="video-embed">
        <iframe class="video-embed-iframe" data-src="https://www.youtube-nocookie.com/embed/<?php echo $data['videoId']; ?>?autoplay=1&modestbranding=1&rel=0&cc_load_policy=1&color=white" allowfullscreen frameborder="0"></iframe>
    </div>
</div>