jQuery(function ($) {
    'use strict';
    // By binding them to both load and resize, it works on the window
    $(window).on('load resize', function () {
        var mqSupport = Modernizr.mq('only all');

        if (!mqSupport || Modernizr.mq('(min-width: 37.5em)')) {
            $('.thumbnail').addClass('fancybox');
        } else {
            $('.thumbnail').removeClass('fancybox');
        }
    });

    if (!Modernizr.svg) {
        $('.brand img').attr('src', '/images/logo.png');
    }
});
