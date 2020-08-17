var podcastDescription = document.querySelector('.podcast-description');
var podcastDescriptionText = podcastDescription.querySelector('p');
podcastDescription.onscroll = event => {
    if( podcastDescription.scrollTop + Number( getComputedStyle(podcastDescription, null).height.replace('px', '') ) == Number( getComputedStyle(podcastDescriptionText, null).height.replace('px', '') ) ) {
        document.querySelector('.podcast-description-wrapper').classList.add('scrolled');
    } else {
        document.querySelector('.podcast-description-wrapper').classList.remove('scrolled');
    }
}

// Progress Circle (https://css-tricks.com/building-progress-ring-quickly/)
var circle = document.querySelector('.play-progress > circle');
var radius = circle.r.baseVal.value;
var circumference = radius * 2 * Math.PI;

circle.style.strokeDasharray = `${circumference} ${circumference}`;
circle.style.strokeDashoffset = `${circumference}`;

function setCircleProgress(percent) {
    const offset = circumference - (percent / 100) * circumference;
    circle.style.strokeDashoffset = offset;
}

// Animated Sound Levels
var barInterval;
function barAnimation(state) {
    if(state == 'pause') {
        clearInterval(barInterval);
        document.querySelectorAll('.podcast-levels > div').forEach(element => {
            element.style.transform = 'scaleY(0)';
        })
    } else {
        barInterval = setInterval( () => {
            document.querySelectorAll('.podcast-levels > div').forEach(element => {
                element.style.transform = 'scaleY(' + Math.random() * 25 + ')';
            })
        }, 200)
    }
}

var podcast = new Audio(podcastAudioURL); // Passed from script tag
var podcastButton = document.querySelector('.podcast .play-pause');

podcast.addEventListener('canplay', () => {
    
    document.addEventListener('click', event => {
        if( document.querySelector('.podcast-cover').contains( event.target ) ) {
            if( podcast.paused ) {
                podcast.play();
            } else {
                podcast.pause();
            }
        }
    })

    podcast.onplay = () => {
        podcastButton.classList.remove('fa-play');
        podcastButton.classList.add('fa-pause');
        barAnimation('play');
    }

    podcast.onpause = () => {
        podcastButton.classList.remove('fa-pause');
        podcastButton.classList.add('fa-play');
        barAnimation('pause');
    }
    
    podcast.addEventListener('timeupdate', event => {
        setCircleProgress( (podcast.currentTime / podcast.duration) * 100 );
    })

})