$(document).ready(function () {
    // Medium zoom
    mediumZoom('.zoom', {
        margin: 60,
        background: 'rgba(255, 255, 255, 0.75)'
    });

    // Animate Anchor Link Scroll
    $(document).on("click", 'a[href^="#"]', function (event) {
        event.preventDefault();
        $("html, body").animate({
            scrollTop: $( $.attr(this, "href") ).offset().top - 100,
        }, 1500, "swing");
    });
});

// Header
$(document).ready(function(){
    // Various toggles
    var dropdowns = [
        {
            trigger: '.sections-toggle',
            dropdown: '.sections-dropdown',
        },{
            trigger: '.header-button',
            dropdown: '.donation-dropdown',
        },{
            trigger: '.search-toggle',
            dropdown: '.search-dropdown',
            callback: function(){
                $('.search-field').focus();
            }
        },{
            trigger: '.mobile-menu-toggle',
            dropdown: '.mobile-menu-outer',
            type: 'mobile-menu'
        }
    ]

    $.each(dropdowns, function(){
        var dropdown = this;
        $(dropdown.trigger).click(function(){
            if(!dropdown.type) {
                if($('.header-dropdown:not(' + dropdown.dropdown + ')').is(":visible")) {
                    $('.header-dropdown:not(' + dropdown.dropdown + '):visible').fadeOut('fast', function(){
                        $(dropdown.dropdown).fadeIn('fast');
                    })
                } else {
                    $(dropdown.dropdown).slideToggle();
                }
                if(dropdown.callback) {
                    dropdown.callback();
                }
            } else {
                if(dropdown.type == 'mobile-menu') {
                    $(dropdown.dropdown).fadeToggle('fast');
                }
                if( typeof dropdown.callback == 'function' ) {
                    dropdown.callback();
                }
            }
        });
    })

    // Notification bar
    $(".notification-close").click(function(event) {
        event.preventDefault();
        $("#notification").slideUp("fast", function(){
            $(this).remove();
        });
        Cookies.set('notification', 'closed', { expires: 1 });
    });

    // Change header on scroll
    $(document).scroll(function () {
        if($('body').hasClass('single-post') || $('body').hasClass('single-column')) { // If Isn't Homepage
            if ($(window).width() > 925) {
                if ($(document).scrollTop() > 400) {
                    $(".header-left, .header-center").fadeOut("fast", function () {
                        $(".header-right, .default-header").hide();
                        $(".sticky-sections-left").fadeIn("fast");
                        $(".sticky-sections-right, .sticky-sections").show();
                    });
                    $('.sections-dropdown').slideUp();
                } else {
                    $(".sticky-sections-left").fadeOut("fast", function () {
                        $(".sticky-sections-right, .sticky-sections").hide();
                        $(".header-left, .header-center").fadeIn("fast");
                        $(".header-right, .default-header").show();
                    });
                }
            } else {
                $(".sticky-sections-left").fadeOut("fast", function () {
                    $(".sticky-sections-right, .sticky-sections").hide();
                    $(".header-left, .header-center").fadeIn("fast");
                    $(".header-right, .default-header").show();
                });
            }
        }
    });

    // Progress bar
    $(window).on("load resize scroll", function(){
        if($('.progress-bar').length) {
            var progress = (($(document).scrollTop() - $(".article-content").offset().top) / $(".article-content").height()) * $(window).width();
            $(".progress-bar").width(progress);
        }
    });
})