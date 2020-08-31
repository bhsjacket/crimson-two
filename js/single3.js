function nextSlide2() {

    var viewWidth = parseInt( getComputedStyle( slideshowContainer.querySelector('.caption-group') ).width ),

    currentSlide = slideshow.querySelector('.active-slide'),
    currentSlideWidthMarginless = parseInt( getComputedStyle(currentSlide).width ),
    currentSlideWidth = currentSlideWidthMarginless + parseInt( getComputedStyle(currentSlide).marginRight ),
    
    scrollWidth = parseInt( slideshow.dataset.translate ?? 0 );

    var prevSlide = slideshow.querySelector('.active-slide').previousElementSibling;
    if( prevSlide ) {
        var prevSlideWidthMarginless = parseInt( getComputedStyle(prevSlide).width ),
        prevSlideWidth = prevSlideWidthMarginless + parseInt( getComputedStyle(prevSlide).marginRight );
    } else {
        var prevSlideWidthMarginless = 0,
        prevSlideWidth = 0;
    }

    var nextSlide = slideshow.querySelector('.active-slide').nextElementSibling;
    if( nextSlide ) {
        var nextSlideWidthMarginless = parseInt( getComputedStyle(nextSlide).width ),
        nextSlideWidth = nextSlideWidthMarginless + parseInt( getComputedStyle(nextSlide).marginRight );
    } else {
        var nextSlideWidthMarginless = 0,
        nextSlideWidth = 0;
    }

    //---------------------------------------------//

    if( nextSlide ) {

        scrollWidth -= currentSlideWidth;
        scrollWidth -= (viewWidth - nextSlideWidthMarginless) / 2;
        // scrollWidth += (viewWidth - prevSlideWidthMarginless) / 2;

    //---------------------------------------------//

        currentSlide.classList.add('slide-left');
        currentSlide.classList.remove('active-slide');

        nextSlide.classList.add('active-slide');
        nextSlide.classList.remove('slide-right');
        moveSlideshow( scrollWidth );

    }
}

function moveSlideshow(distance) {
    slideshow.style.transform = 'translateX(' + distance + 'px)';
    slideshow.dataset.translate = distance;
}