$('.select-academic-year').change(function() {
    $('.staff-boxes').css('opacity', '0.6');
    var url = location.href + '?academic_year=' + $(this).val();
    $.ajax({
        url: url,
        type: 'GET',
        success: function(data){
            $('.staff-boxes').css('opacity', '1');
            var html = $('' + data + '').find('.staff-boxes').html();
            $('.staff-boxes').html(html);
        }
    })
});