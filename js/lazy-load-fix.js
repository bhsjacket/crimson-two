(function() {
    var images = document.querySelectorAll('img[width][height]');
    images.forEach(image => {
        var width = parseInt( getComputedStyle(image).width );
        var aspectRatio = parseInt( image.getAttribute('width') ) / parseInt( image.getAttribute('height') );
    
        image.style.width = width + 'px';
        image.style.height = width / aspectRatio + 'px';
    })
})()