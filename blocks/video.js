function newHeight(currentWidth, aspectRatio = 3/2) {
    return currentWidth / (aspectRatio);
}

var video = $('.video').find('iframe.video-embed-iframe');
var thumbnail = $('.video').find('.video-thumbnail');
$('.video').click(function(){
    video.attr('src', video.data('src'));
    video.removeAttr('data-src');
    video.css('display', 'block');
    $(this).find('.video-overlay').hide();
    thumbnail.hide();
});

var aspectRatio = thumbnail.width() / thumbnail.height();
$(window).on('resize load', function(){
    video.css('height', newHeight(video.width(), aspectRatio) + 'px');
})