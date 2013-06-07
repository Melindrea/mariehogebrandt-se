<?php if (is_front_page()) : ?>
<h3><?php echo __('What&rsquo;s up', 'roots'); ?>?</h3>
<?php mh_latest_status(); ?>
<?php dynamic_sidebar('sidebar-frontpage'); ?>
<?php elseif (is_single()) : ?>
<h3><?php echo __('Inspiration', 'roots'); ?></h3>
<ul class="entry-navigation">
    <?php previous_post_link('<li class="previous-entry">%link</li>'); ?>
    <?php next_post_link('<li class="next-entry">%link</li>'); ?>
    <li class="random-entry"><a href="/random/">Random Entry</a></li>
</ul>
<h3><?php echo __('Categories', 'roots'); ?></h3>
<?php the_category(); ?>

<h3><?php echo __('Tags', 'roots'); ?></h3>
<?php the_tags('<ul><li>','</li><li>','</li></ul>'); ?>
<?php dynamic_sidebar('sidebar-posts'); ?>
<?php elseif (is_page('contact')) : ?>

<?php else : ?>
<?php dynamic_sidebar('sidebar-primary'); ?>
<?php endif; ?>
