//-- Pictures should not be galleries
$('.thumbnail').fancybox({
    beforeLoad: function () {
        'use strict';
        var titleElement = $(this.element).next('.wp-caption-text');

        if (titleElement) {
            this.title = titleElement.html();
        }
    }
});

//-- Let's go through galleries and spruce them up separately
$('.gallery').each(function () {
    'use strict';
    $(this).find('a').attr('rel', this.id);
});
