$(window).resize(function(){ $('.slideshow').css('height', $('.slideshow > img:first-child').height()); })
$(window).ready(function(){
    $('.slideshow').css('height', $('.slideshow > img:first-child').height());
    
    $('.slideshow > img:not(:first-child)').hide();
    setInterval(function() {
        $('.slideshow > img').stop(true, true);
        $('.slideshow > img:first-child').fadeOut().next('img').fadeIn().end().appendTo('.slideshow');
    }, 2500);
})