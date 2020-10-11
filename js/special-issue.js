(()=>{

var banner = document.querySelector('.special-issue-banner');
var button = banner.querySelector('.special-issue-next');
var scrollArea = banner.querySelector('.special-issue-articles-wrapper');

window.addEventListener('scroll', () => {
    if( window.pageYOffset > 400 ) {
        banner.classList.add('shown');
    } else {
        banner.classList.remove('shown');
    }
})

button.addEventListener('click', () => {
    scrollArea.scroll({
        left: scrollArea.scrollLeft + 300,
        behavior: 'smooth'
    })
})

})()