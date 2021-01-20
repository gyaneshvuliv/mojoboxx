(function($){

    "use strict";
    
    var filterString = one_page_opt.filterArray;
    var navType      = one_page_opt.navType;
    var speed        = one_page_opt.speed;
    var hash         = one_page_opt.hash;
    var offset       = one_page_opt.offset;

    if ($(window).outerWidth() < 1263) {
        offset = 0;
    }
    
    if(navType == "top"){
        $('ul#header-menu').singlePageNav({
            currentClass: 'one-page-active',
            speed: parseInt(speed),
            easing: "swing",
            updateHash: hash,
            filter:':not('+filterString+')',
            offset:offset
        });

        $('ul#header-menu-left').singlePageNav({
            currentClass: '',
            speed: parseInt(speed),
            easing: "swing",
            updateHash: hash,
            filter:':not('+filterString+')',
            offset:offset
        });

        $('ul#header-menu-right').singlePageNav({
            currentClass: '',
            speed: parseInt(speed),
            easing: "swing",
            updateHash: hash,
            filter:':not('+filterString+')',
            offset:offset
        });
        
    } else if(navType == "side") {
        $('ul#bullets').singlePageNav({
            currentClass: 'one-page-active',
            speed: parseInt(speed),
            easing: "swing",
            updateHash: hash,
            filter:':not('+filterString+')',
            offset:offset
        }); 
    } else if(navType == "sidebar") {
        $('ul#sidebar-menu').singlePageNav({
            currentClass: 'one-page-active',
            speed: parseInt(speed),
            easing: "swing",
            updateHash: hash,
            filter:':not('+filterString+')',
            offset:offset
        }); 
    }

})(jQuery);