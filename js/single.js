// FEATURED SLIDESHOW

var slideshowWrapper = document.querySelector('.slideshow-wrapper');

if( slideshowWrapper ) {

    var featuredSlideshow = slideshowWrapper.querySelector('.slideshow'),
        slides = featuredSlideshow.querySelectorAll('.slide'),
        prevButton = document.querySelector('.slideshow-wrapper .prev-button'),
        nextButton = document.querySelector('.slideshow-wrapper .next-button'),
        slideCount = 0; // Zero-Indexed Slide Number
    
    function setSlideshowHeights() {
        var height = Number( getComputedStyle(featuredSlideshow).width.replace('px', '') ) / 1.5;
    
        slides.forEach( slide => {
            var slideImage = slide.querySelector('.slide-image');
            slideImage.style.height = height + 'px';
        } )
    
        prevButton.style.top = height / 2 + 'px';
        nextButton.style.top = height / 2 + 'px';
    
        if( slides[slideCount] !== undefined ) {
            featuredSlideshow.style.height = getComputedStyle( slides[slideCount] ).height;
        }
    }
    
    function slideClasses() {
        if( slideCount > slides.length - 1 ) {
            slideCount = slides.length - 1;
        }
    
        if( slideCount < 0 ) {
            slideCount = 0;
        }
    
        if( slideCount == slides.length - 1 ) {
            slideshowWrapper.classList.add('at-end');
        } else {
            slideshowWrapper.classList.remove('at-end');
        }
    
        if( slideCount == 0 ) {
            slideshowWrapper.classList.add('at-start');
        } else {
            slideshowWrapper.classList.remove('at-start');
        }
    }
    
    function prevSlide() {
        var currentSlide = featuredSlideshow.querySelector('.active-slide');
    
        if( currentSlide.previousElementSibling != null ) {
            currentSlide.previousElementSibling.classList.remove('hidden-slide-left');
            currentSlide.previousElementSibling.classList.add('active-slide');
        
            currentSlide.classList.add('hidden-slide-right');
            currentSlide.classList.remove('active-slide');
    
        }
        
        slideCount--;
        slideClasses();
        setSlideshowHeights();
    }
    
    function nextSlide() {
        var currentSlide = featuredSlideshow.querySelector('.active-slide');
    
        if( currentSlide.nextElementSibling != null ) {
            currentSlide.nextElementSibling.classList.remove('hidden-slide-right');
            currentSlide.nextElementSibling.classList.add('active-slide');
    
            currentSlide.classList.add('hidden-slide-left');
            currentSlide.classList.remove('active-slide');
    
        }
        
        slideCount++;
        slideClasses();
        setSlideshowHeights();
    }
    
    window.addEventListener( 'resize', setSlideshowHeights );
    window.addEventListener( 'load', setSlideshowHeights );
    
    prevButton.addEventListener( 'click', prevSlide );
    nextButton.addEventListener( 'click', nextSlide );
    
    document.addEventListener( 'keydown', event => {
        if( event.keyCode == 39 ) {
            nextSlide();
        } else if( event.keyCode == 37 ) {
            prevSlide();
        }
    } );

}

// RECOMMENDED POSTS SLIDER
var recommendedSlider = document.querySelector('.recommended-slider');

if( recommendedSlider ) {
    
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

}
