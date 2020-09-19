(()=>{

var images = document.querySelectorAll('img[width][height]');
images.forEach(image => {

    var width = parseInt( getComputedStyle(image).width );
    var aspectRatio = parseInt( image.getAttribute('width') ) / parseInt( image.getAttribute('height') );

    image.dataset.width = image.style.width;
    image.dataset.height = image.style.height;

    image.style.width = width + 'px';
    image.style.height = width / aspectRatio + 'px';

    var observer = new MutationObserver( () => {
        if( image.classList.contains('lazy-loaded') ) {
            image.style.width = image.dataset.width;
            image.style.height = image.dataset.height;
        }
    });
    observer.observe(image, {
        attributes: true, 
        attributeFilter: ['class'],
        childList: false,
        characterData: false
    });
    
})

})()