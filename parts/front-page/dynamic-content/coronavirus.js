$(document).ready( () => {

    function setData(data) {
        $('[data-stat="berkeley-total"]').text( data.berkeley.total.toLocaleString() );
        $('[data-stat="berkeley-new"]').text( data.berkeley.new.toLocaleString() + ' new' );
        $('[data-stat="alameda-total"]').text( data.alameda.total.toLocaleString() );
        $('[data-stat="alameda-new"]').text( data.alameda.new.toLocaleString() + ' new' );
        $('[data-stat="date"]').text( data.date );
        sparkline.sparkline( $('.berkeley-sparkline')[0], data.berkeley.cumulative );

        var expirationDate = new Date();
        expirationDate.setDate(new Date().getDate() + 1);
        expirationDate.setHours(0,0,0,0);

        if( !Cookies.get('coronavirus-cache') ) {
            Cookies.set( 'coronavirus-cache', JSON.stringify(data), {expires: expirationDate} );
        }

        $('.coronavirus-stat-dc').removeClass('loading');
    }

    if( Cookies.get('coronavirus-cache') ) {
        var data = Cookies.get('coronavirus-cache');
        data = JSON.parse(data);
        setData(data);
    } else {
        $.ajax({
            method: 'GET',
            url: 'https://multimedia.berkeleyhighjacket.com/2020/coronavirus/api.php',
            success: data => {
                setData(data);
            }
        })
    }

} )