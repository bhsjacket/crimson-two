var slideshowContainer = document.querySelector('.slideshow-container');

if( slideshowContainer ) {

    var slideshowWrapper = slideshowContainer.querySelector('.slideshow-wrapper'),
    slideshow = slideshowWrapper.querySelector('.slideshow');

    function nextSlide() {
        var activeSlide = slideshow.querySelector('.active-slide');
        var nextSlide = slideshow.querySelector('.active-slide').nextElementSibling;

        if( nextSlide ) {

            activeSlide.classList.remove('active-slide');
            activeSlide.classList.add('slide-left');

            nextSlide.classList.remove('slide-right');
            nextSlide.classList.add('active-slide');

            var scrollWidth = parseInt( getComputedStyle(nextSlide).width ) + parseInt( getComputedStyle(nextSlide).marginRight );
            scrollWidth *= -1;
            scrollWidth += parseInt( slideshow.dataset.translate ?? 0 );

            var viewWidth = parseInt( getComputedStyle( slideshowContainer.querySelector('.caption-group') ).width ),
                slideWidth = parseInt( getComputedStyle(nextSlide).width );
            scrollWidth -= (viewWidth - slideWidth) / 2;

            slideshow.style.transform = 'translateX(' + scrollWidth + 'px)';
            slideshow.dataset.translate = scrollWidth;

        }
    }

    function prevSlide() {
        var activeSlide = slideshow.querySelector('.active-slide');
        var prevSlide = slideshow.querySelector('.active-slide').previousElementSibling;

        if( prevSlide ) {

            activeSlide.classList.remove('active-slide');
            activeSlide.classList.add('slide-right');
    
            prevSlide.classList.remove('slide-left');
            prevSlide.classList.add('active-slide');
    
            var scrollWidth = parseInt( getComputedStyle(activeSlide).width ) + parseInt( getComputedStyle(activeSlide).marginRight );
            scrollWidth += parseInt( slideshow.dataset.translate ?? 0 );

            var viewWidth = parseInt( getComputedStyle( slideshowContainer.querySelector('.caption-group') ).width ),
                slideWidth = parseInt( getComputedStyle(prevSlide).width );
            scrollWidth += (viewWidth - slideWidth) / 2;
    
            slideshow.style.transform = 'translateX(' + scrollWidth + 'px)';
            slideshow.dataset.translate = scrollWidth;

        }
    }

    function changeSlide(event) {
        if( event.target.closest('.slide').classList.contains('slide-right') ) {
            nextSlide();
        } else if( event.target.closest('.slide').classList.contains('slide-left') ) {
            prevSlide();
        }
    }

    function moveSlide(direction) {

        var viewWidth = parseInt( getComputedStyle( slideshowContainer.querySelector('.caption-group') ).width ),

            // prevSlide = slideshow.querySelector('.active-slide').previousElementSibling,
            // prevSlideWidthMarginless = parseInt( getComputedStyle(prevSlide).width ),
            // prevSlideWidth = prevSlideWidthMarginless + parseInt( getComputedStyle(prevSlideWidth).marginRight ),

            currentSlide = slideshow.querySelector('.active-slide'),
            currentSlideWidthMarginless = parseInt( getComputedStyle(currentSlide).width ),
            currentSlideWidth = currentSlideWidthMarginless + parseInt( getComputedStyle(currentSlide).marginRight ),

            nextSlide = slideshow.querySelector('.active-slide').nextElementSibling,
            nextSlideWidthMarginless = parseInt( getComputedStyle(nextSlide).width ),
            nextSlideWidth = nextSlideWidthMarginless + parseInt( getComputedStyle(nextSlide).marginRight ),
            
            scrollWidth = 0;

        if( direction == 'next' ) {

            scrollWidth -= nextSlideWidth;
            // scrollWidth -= (viewWidth - prevSlideWidthMarginless) / 2;
            // scrollWidth += (viewWidth - nextSlideWidthMarginless) / 2;
            
        }

        slideshow.style.transform = 'translateX(' + scrollWidth + 'px)';
        slideshow.dataset.translate = scrollWidth;

    }

    function slideshowWidth() {
        var width = 0;

        slideshow.querySelectorAll('.slide').forEach( slide => {
            width += parseInt( getComputedStyle(slide).marginRight );
            width += slide.offsetWidth;
        } )

        width += 1;

        slideshow.style.width = width + 'px';
    }

    slideshow.querySelectorAll('.slide').forEach( slide => {
        slide.addEventListener( 'click', changeSlide );
    } )

    document.addEventListener( 'keydown', event => {
        if( event.keyCode == 39 ) {
            nextSlide();
        } else if( event.keyCode == 37 ) {
            prevSlide();
        }
    } );

}