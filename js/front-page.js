var currentSlide = 0,
    slideshow = document.querySelector('.slideshow'),
    slides = slideshow.querySelectorAll('img');

setInterval( () => {

    slides.forEach( img => {
        img.style.opacity = 0;
    } )

    currentSlide = (currentSlide != slides.length - 1) ? currentSlide + 1 : 0;
    slides[currentSlide].style.opacity = 1;

}, 3000 )

function setSlideshowSize() {
    slideshow.style.height = getComputedStyle( slides[currentSlide] ).height;
}

window.addEventListener( 'resize', setSlideshowSize );
window.addEventListener( 'load', setSlideshowSize );