$('.slideshow > img:not(:first-child)').hide();
setInterval(function() {
    $('.slideshow > img:first-child').fadeOut().next('img').fadeIn().end().appendTo('.slideshow');
}, 2500);