<?php if (is_front_page()) : ?>
<h3>What&rsquo;s up?</h3>
<?php mh_latest_status(); ?>
<?php dynamic_sidebar('sidebar-frontpage'); ?>
<?php endif; ?>
<?php dynamic_sidebar('sidebar-primary'); ?>
