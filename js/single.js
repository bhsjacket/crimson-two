var recommendedSlider = document.querySelector('.recommended-slider');
var sliderWrapper = recommendedSlider.querySelector('.slider-wrapper');

recommendedSlider.querySelectorAll('.recommended-control').forEach(control => {

    control.addEventListener('click', event => {

        var scrollPosition = sliderWrapper.scrollLeft;
        var controlButton = event.target.closest('.recommended-control');
        var articleWidth = recommendedSlider.querySelector('.recommended-article').offsetWidth + 15;

        if( controlButton.classList.contains('recommended-next') ) {
            recommendedSlider.querySelector('.slider-wrapper').scroll({
                left: scrollPosition + articleWidth,
                behavior: 'smooth'
            })
        } else if( controlButton.classList.contains('recommended-prev') ) {
            recommendedSlider.querySelector('.slider-wrapper').scroll({
                left: scrollPosition - articleWidth,
                behavior: 'smooth'
            })
        }

    })

})

sliderWrapper.onscroll = () => {

    if (sliderWrapper.scrollLeft === sliderWrapper.scrollWidth - sliderWrapper.offsetWidth) {
        recommendedSlider.classList.add('at-end');
        recommendedSlider.classList.remove('scrolling');
    } else if( sliderWrapper.scrollLeft === 0 ) {
        recommendedSlider.classList.add('at-start');
        recommendedSlider.classList.remove('scrolling');
    } else {
        recommendedSlider.classList.remove('at-start');
        recommendedSlider.classList.remove('at-end');
        recommendedSlider.classList.add('scrolling');
    }

}