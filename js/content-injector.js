if(ad_html) {
    var ad_counter = [0];
    document.querySelectorAll('.article-content > *').forEach(element => {
        if( element.tagName === 'P' ) {
            ad_counter[ad_counter.length - 1]++;
        } else {
            ad_counter.push(0);
        }
    })

    var ad_max = Math.max(...ad_counter);
    if(ad_max >= 5) {
        var ad_count = 0;
        ad_counter.forEach(ad_item => {
            if(ad_item == ad_max) {
                ad_count += ad_max / 2 | 0;
            } else {
                ad_count += ad_item;
            }
        })
        var ad_placement = document.querySelector('.article-content > p:nth-child(' + ad_count + ')');
        ad_placement.insertAdjacentHTML('afterend', ad_html);
    }
}