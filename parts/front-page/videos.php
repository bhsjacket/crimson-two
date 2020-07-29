<?php
const ApiKey = 'AIzaSyAC427s1d19T8WpNgy_uYiGeOSmvuPXsm4';
$videoId = 'ymRqYz-Mxnw';

$url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&id=' . $videoId . '&key=' . apiKey;
$data = file_get_contents($url);
$data = json_decode($data, true);
$data = $data['items'][0];

$duration = new DateTime('@0');
$duration->add( new DateInterval( $data['contentDetails']['duration'] ) );
$duration = $duration->format('H:i:s');

$date = new DateTime($data['snippet']['publishedAt']);
$date = $date->format('F j, Y');

$data = [
    'title' => $data['snippet']['title'],
    'date' => $date,
    'duration' => $duration,
    'thumbnail' => $data['snippet']['thumbnails']['maxres']['url'],
    'statistics' => [
        'views' => (integer)$data['statistics']['viewCount'],
        'likes' => (integer)$data['statistics']['likeCount'],
        'dislikes' => (integer)$data['statistics']['dislikeCount'],
        'comments' => (integer)$data['statistics']['commentCount']
    ],
    'hasCaptions' => (boolean)$data['contentDetails']['caption']
];

header('content-type: text/json');
$data = json_encode($data);
print_r($data);