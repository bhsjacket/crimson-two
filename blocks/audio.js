(() => {

function formatTime(seconds) {
    return new Date(seconds * 1000).toISOString().substr(14, 5);
}

var players = document.querySelectorAll('.audio-player');

players.forEach(player => {

    var audio = player.getElementsByTagName('audio')[0],
        progress = player.querySelector('.audio-progress'),
        playPause = player.querySelector('.play-pause'),
        timeLabel = player.querySelector('.audio-time');

    playPause.addEventListener('click', () => {
        if(audio.paused) {
            audio.play();
            players.forEach(subPlayer => {
                var subAudio = subPlayer.getElementsByTagName('audio')[0];
                if( subAudio !== audio ) {
                    subAudio.pause();
                }
            })
        } else {
            audio.pause();
        }
    })

    // Change icons when paused or played
    audio.addEventListener('play', function(){
        playPause.classList.remove('fa-play');
        playPause.classList.add('fa-pause');
    })
    audio.addEventListener('pause', function(){
        playPause.classList.remove('fa-pause');
        playPause.classList.add('fa-play');
    })

    audio.addEventListener('canplay', () => {
        setTimeout( () => {
            player.classList.remove('loading'); // Remove shimmer
        }, Math.random() * 750 )
        progress.max = String(audio.duration); // Set range input scale
    })

    audio.addEventListener('timeupdate', () => {
        progress.value = audio.currentTime; // Set slider value to current time
        var percentage = (audio.currentTime / audio.duration) * 100;
        progress.style.backgroundImage = `linear-gradient(90deg, var(--gray) ${percentage}%, rgba(0,0,0,0) ${percentage}%)`;

        timeLabel.innerText = formatTime(audio.currentTime);
    })

    progress.addEventListener('input', () => {
        audio.currentTime = progress.value; // Set time to slider value
        var percentage = (audio.currentTime / audio.duration) * 100;
        progress.style.backgroundImage = `linear-gradient(90deg, var(--gray) ${percentage}%, rgba(0,0,0,0) ${percentage}%)`;

        timeLabel.innerText = formatTime(progress.value);
    })

})

})()