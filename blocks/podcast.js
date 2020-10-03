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

function updateProgressBar() {
    var progress = ($('.seek').val() / $('.seek').attr('max')) * 100;
    $('.seek').blur();
    $('.seek').css('background-image', 'linear-gradient(90deg, var(--gray) ' + progress + '%, rgb(0,0,0,0) ' + progress + '%)');
}

var podcast = new Audio(podcastAudioURL);

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
$('.fa-undo').click(function(){
    podcast.currentTime = (podcast.currentTime - 10);
    updateProgressBar();
})
$('.fa-redo').click(function(){
    podcast.currentTime = (podcast.currentTime + 10);
    updateProgressBar();
})

// Change seek bar
podcast.addEventListener('timeupdate', function(event){
    var currentTime = parseInt(podcast.currentTime);
    $('.podcast-time').text(secondsToTime(currentTime) + ' / ' + secondsToTime(podcast.duration));

    $('.seek').attr('max', Math.round(podcast.duration));
    $('.seek').val(currentTime);
    updateProgressBar();
})

podcast.addEventListener('canplay', function(){
    $('.seek').attr('max', Math.round(podcast.duration));
    $('.podcast-time').text( secondsToTime(podcast.currentTime) + ' / ' + secondsToTime(podcast.duration) );
})

$('.seek').on('input', function(){
    updateProgressBar();
    podcast.currentTime = $(this).val();
    $('.podcast-time').text( secondsToTime(podcast.currentTime) + ' / ' + secondsToTime(podcast.duration) );
})