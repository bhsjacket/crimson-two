$(document).ready(function(){
    var done = false;
    var page = $('.results').data('page') + 1;
    var query = $('.results').data('query');
    $(document).scroll(function(){
        if( $(document).height() - $(document).scrollTop() < 1000 && done === false ) {
            done = true;
            var url = document.location.origin + '/page/' + page + '/?s=' + query;
            setTimeout(function(){
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(data){
                        var source = $('' + data + '');
                        $('.search-loader').remove();
                        $('.results').append( source.find('.results').html() );
                        $('.results').attr('data-page', page);
                        page++;
                        done = false;
                    },
                    error: function(data) {
                        $('.search-loader').remove();
                        $('.results').append('<p style="margin-bottom:30px;margin-top:45px;" class="no-results">No more results</p>');
                    }
                });
            }, 750);
        }
    })
})