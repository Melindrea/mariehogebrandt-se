<article class="inner">
<?php get_template_part('templates/page', 'header'); ?>
<?php if (is_front_page()) {
    get_template_part('templates/content', 'home');
} else {
    get_template_part('templates/content', 'page');
} ?>
</article>
