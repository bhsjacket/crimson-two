<?php
$data = file_get_contents( 'https://api.berkeleyhighjacket.com/sports/' );
$data = json_decode( $data, true );
/*
formattedDate,
url,
rival name,
rival location,
rival colors (array),
rival acronym,
gameLocation map,
score bhs,
score rival,
sport name
sport origName
*/

$icons = [
    'soccer' => 'futbol',
    'football' => 'football-ball',
    'tennis' => 'tennis-ball',
    'swimming' => 'swimmer',
    'volleyball' => 'volleyball-ball',
    'basketball' => 'basketball-ball'
];

if($data['score']['rival'] > $data['score']['bhs']) {
    $winner = 'rival';
} else if($data['score']['rival'] == $data['score']['bhs']) {
    $winner = 'tie';
} else {
    $winner = 'bhs';
}

$backgroundImage = 'https://api.mapbox.com/styles/v1/bhsjacket/ckccs7yk20j4q1iqp7g4lmq86/static/' . $data['gameLocation']['long'] . ',' . $data['gameLocation']['lat'] . ',15,39/300x550?access_token=pk.eyJ1IjoiYmhzamFja2V0IiwiYSI6ImNrNnpyYzZpZTBkOWgzZW9ndXMybG01NXoifQ.dTHlIXLy2CKqQeNJyU-KWw';

?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/parts/front-page/dynamic-content/sports.css">

<style>
    .rival-abbr:before {
        background: linear-gradient(180deg, <?php echo $data['rival']['colors'][0] ?> 50%, <?php echo $data['rival']['colors'][1] ?> 50%);
    }
</style>

<div class="sports-scores" data-winner="<?php echo $winner; ?>" style="background-image:url('<?php echo $backgroundImage; ?>')">

    <div class="sports-scores-top">
        <span><?php echo $data['formattedDate']; ?></span>
        <i class="far fa-<?php echo $icons[$data['sport']['origName']] ?? 'no-icon'; ?>"></i>
        <span><?php echo $data['sport']['name']; ?></span>
    </div>

    <div class="scores">
        <div class="rival-score">
            <h3 class="rival-abbr"><?php echo $data['rival']['acronym']; ?></h3>
            <h2 class="rival-score-number"><?php echo $data['score']['rival']; ?></h2>
        </div>
        <div class="bhs-score">
            <h3 class="bhs-abbr">BHS</h3>
            <h2 class="bhs-score-number"><?php echo $data['score']['bhs']; ?></h2>
        </div>
    </div>

</div>