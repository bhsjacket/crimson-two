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
?>

<link rel="stylesheet" href="https://bhsjacket.local/wp-content/themes/crimson/assets/icons/css/regular.min.css">
<link rel="stylesheet" href="https://bhsjacket.local/wp-content/themes/crimson/assets/icons/css/fontawesome.min.css">
<link rel="stylesheet" href="https://bhsjacket.local/wp-content/themes/crimson/assets/icons/css/solid.min.css">
<link rel="stylesheet" href="https://use.typekit.net/erm4tbu.css">
<link rel="stylesheet" href="https://bhsjacket.local/wp-content/themes/crimson/style.css">
<style>.podcast-player{margin-top:100px!important}html{background:none;}</style>

<style>

    .podcast-player {
        max-width: var(--normal);
        border-top: solid 1px var(--light);
        border-bottom: solid 1px var(--light);
        padding: var(--gap) 0;
        margin: 0 auto;
    }
    
    .podcast-player img { width: 100%; }

    .podcast-title {
        margin: 0;
        padding: 0;
        font-size: 24px;
        font-family: var(--sans);
    }

    .podcast-date {
        font-family: var(--sans);
        color: var(--gray);
        font-size: 15px;
        display: block;
        margin-top: 2px;
    }
    
    .podcast-label {
        font-family: var(--sans);
        font-size: 15px;
        display: block;
        margin-bottom: 2px;
    }

    .podcast-label > i { margin-right: 6px; }

    .podcast-left {
        display: grid;
        align-items: center;
    }
    
    .podcast-top {
        display: grid;
        grid-template-columns: 1fr 100px;
        align-items: center;
    }

    .podcast-bottom {
        user-select: none; 
        display: flex;
        align-items: center;
    }

    .podcast-bottom-left {
        white-space: nowrap;
        display: grid;
        align-items: center;
        grid-template-columns: 2fr 3fr 2fr;
        grid-gap: 6px;
    }

    .podcast-bottom-left i {
        cursor: pointer;
        transition: color 0.2s;
    }

    .podcast-bottom-left .fa-play,
    .podcast-bottom-left .fa-pause {
        text-align: center;
        font-size: 20px;
    }

    .podcast-bottom-left i:hover { color: var(--accent); }

    .podcast-bottom-right {
        margin-left: 10px;
        display: flex;
        align-items: center;
        width: 100%;
    }

    .podcast-time {
        font-family: var(--sans);
        margin-right: 10px;
        white-space: nowrap;
    }

    .seek {
        width: 100%;
        -webkit-appearance: none;
        background-color: #c7c7c7;
        height: 3px;
        vertical-align: middle;
        outline: none;
        background-image: linear-gradient(90deg, var(--gray) 0%, rgb(0,0,0,0) 0%);
        cursor: pointer;
    }

    .seek:hover::-webkit-slider-thumb {
        transform: scale(1.5);
        border-radius: 50%;
    }

    .seek::-webkit-slider-thumb {
        -webkit-appearance: none;
        background-color: var(--accent);
        width: 9px;
        height: 9px;
        margin-top: 1px;
        transform: scale(0.33);
        transition: all 0.2s;
        margin-left: -3px;
    }
    
</style>

<div class="podcast-player">
    <div class="podcast-top">
        <div class="podcast-top-left">
            <span class="podcast-label"><i class="far fa-podcast"></i>Podcast</span>
            <h2 class="podcast-title"><?php echo $podcast['title']; ?></h2>
            <span class="podcast-date"><?php echo $podcast['date']; ?></span>
        </div>
        <img src="https://bhsjacket.local/wp-content/themes/crimson/assets/podcast.png">
    </div>
    <div class="podcast-bottom">
        <div class="podcast-bottom-left">
            <i class="far fa-undo"></i>
            <i class="fas fa-play"></i>
            <i class="far fa-redo"></i>
        </div>
        <div class="podcast-bottom-right">
            <span class="podcast-time">XX:XX / XX:XX</span>
            <input type="range" value="0" class="seek">
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

    function secondsToTime(e){
        var h = Math.floor(e / 3600).toString().padStart(2,'0'),
            m = Math.floor(e % 3600 / 60).toString().padStart(2,'0'),
            s = Math.floor(e % 60).toString().padStart(2,'0');
        
        if(h == '00') {
            return m + ':' + s;
        } else if(m == '00') {
            return '00:' + s;
        } else {
            return Number(h) + ':' + m + ':' + s;
        }
    }

    url = '<?php echo $podcast['audio']; ?>';
    var podcast = new Audio(url);

    $(document).on('click', '.fa-play', function(){ podcast.play(); }); // play
    $(document).on('click', '.fa-pause', function(){ podcast.pause(); }); // pause

    // Change icons when paused or played
    podcast.addEventListener('play', function(){
        $('.fa-play').addClass('fa-pause');
        $('.fa-play').removeClass('fa-play');
    })
    podcast.addEventListener('pause', function(){
        $('.fa-pause').addClass('fa-play');
        $('.fa-pause').removeClass('fa-pause');
    })

    // Skip forwards or backwards
    $('.fa-undo').click(function(){ podcast.currentTime = (podcast.currentTime - 10); })
    $('.fa-redo').click(function(){ podcast.currentTime = (podcast.currentTime + 10); })

    // Change seek bar
    podcast.addEventListener('timeupdate', function(event){
        var currentTime = parseInt(podcast.currentTime);
        $('.podcast-time').text(secondsToTime(currentTime) + ' / ' + secondsToTime(podcast.duration));
        $('.seek').attr('max', Math.round(podcast.duration));
        $('.seek').val(currentTime);
    })

    podcast.addEventListener('canplay', function(){
        $('.seek').attr('max', Math.round(podcast.duration));
        $('.podcast-time').text( secondsToTime(podcast.currentTime) + ' / ' + secondsToTime(podcast.duration) );
    })

    $('.seek').on('input', function(){
        var progress = ($(this).val() / $(this).attr('max')) * 100;
        podcast.currentTime = $(this).val();
        $(this).css('background-image', 'linear-gradient(90deg, var(--gray) ' + progress + '%, rgb(0,0,0,0) ' + progress + '%)');
        $('.podcast-time').text( secondsToTime(podcast.currentTime) + ' / ' + secondsToTime(podcast.duration) );
    })

</script>