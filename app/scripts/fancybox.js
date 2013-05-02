$(function () {
    'use strict';

    // By binding them to both load and resize, it works on the window
    $(window).on('load resize', function () {
        // !Modernizr.mq('only all') is true if there is no support for mediaqueries
        if (!Modernizr.mq('only all') || Modernizr.mq('(min-width: 37.5em)')) {
            $('.thumbnail').addClass('fancybox');
        } else {
            $('.thumbnail').removeClass('fancybox');
        }
    });

    $('.fancybox').fancybox({
        beforeLoad: function () {
            var titleElement = $(this.element).next('.wp-caption-text');

            if (titleElement) {
                this.title = titleElement.html();
            }
        },
        helpers : {
            title: {
                type: 'outside'
            }
        },
        padding: 18
    });

    //-- Let's go through galleries and spruce them up separately
    $('.gallery').each(function () {
        $(this).find('a').attr('rel', this.id);
    });
});
