$(document).ready(function(){
    var done = false;
    var page = $('.articles').data('page') + 1;
    $(document).scroll(function(){
        if( $(document).height() - $(document).scrollTop() < 1000 && done === false ) {
            done = true;
            var url = location.href + '?offset=' + (page * 10);
            setTimeout(function(){
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(data){
                        var source = $('' + data + '').find('.articles').html();
                        if(source.includes('no-posts')) {
                            $('.search-loader').remove();
                            $('.articles').append('<p style="margin-bottom:30px;margin-top:45px;" class="no-results">No more results</p>');
                        } else {
                            $('.search-loader').remove();
                            $('.articles').append( source );
                            $('.articles').attr('data-page', page);
                            page++;
                            done = false;
                        }
                    }
                });
            }, 750);
        }
    })
})