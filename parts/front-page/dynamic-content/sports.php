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
?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/parts/front-page/dynamic-content/sports.css">

<div class="sports-dc sport-<?php echo strtolower( trim( preg_replace( '/[^A-Za-z0-9-]+/', '-', $data['sport']['origName'] ), '-' ) ); ?>">

    <span class="sports-date"><?php echo $data['formattedDate']; ?></span>

    <div class="final-score">

        <div class="score rival-score">

            <h1 class="score-text"><?php echo $data['score']['rival']; ?></h1>

        </div>

        <div class="score home-score">

            <h1 class="score-text"><?php echo $data['score']['bhs']; ?></h1>

        </div>

    </div>

    <div class="rival">
        <h2 class="rival-name"><?php echo $data['rival']['name']; ?></h2>
        <span class="sports-location"><?php echo $data['rival']['location'] ?></span>
    </div>
    <span class="sports-vs">vs</span>
    <div class="home">
        <h2 class="home-name">Berkeley High School</h2>
        <span class="sports-location">Berkeley, CA</span>
    </div>
    <a target="_blank" href="<?php echo $data['url']; ?>" class="sports-button">More Information</a>

</div>