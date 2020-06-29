<?php
$url = 'https://anchor.fm/bhsjacket/episodes/The-Jewish-Experience-ear3vh';
if( substr($url, -7, -6) !== '-') {
    die('Please check that the URL is formatted properly. It should end in 6 random characters. Try removing the trailing slash from the URL.');
}
$url = substr($url, -6);
$url = 'https://anchor.fm/api/v3/episodes/' . $url;

$data = file_get_contents($url);
$data = json_decode($data, true);

$audio = $data['episodeAudios'][0]['audioUrl'];
$date = date('F j, Y', $data['episode']['publishOnUnixTimestamp']);
$title = $data['episode']['title'];
$description = $data['episode']['descriptionPreview'];

$podcast = [
    'title' => $title,
    'date' => $date,
    'audio' => $audio,
    'description' => $description
];

header('content-type: text/plain');
print_r($podcast);