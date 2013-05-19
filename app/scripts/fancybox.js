jQuery(function ($) {
    'use strict';
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
