<?php
$url = 'https://anchor.fm/bhsjacket/episodes/The-Jewish-Experience-ear3vh';
$url = 'https://anchor.fm/dkmh/episodes/Not-to-Fall-e4i35i';
if( substr($url, -7, -6) !== '-') {
    die('Please check that the URL is formatted properly. It should end in 6 random characters. Try removing the trailing slash from the URL.');
}
$url = substr($url, -6);
$url = 'https://anchor.fm/api/v3/episodes/' . $url;

$data = file_get_contents($url);
$data = json_decode($data, true);

header('content-type: text/plain');
print_r($data);
die;

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

header('content-type: text/plain');
print_r($podcast);