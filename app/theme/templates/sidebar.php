<?php if (is_front_page()) : ?>
<h3>What&rsquo;s up?</h3>
<?php mh_latest_status(); ?>
<?php $widget = new GlobalActivityWidget(); ?>
<section class="widget widget-global-activity">
<?php $widget->render(); ?>
</section>
<?php dynamic_sidebar('sidebar-frontpage'); ?>
<?php endif; ?>
<?php dynamic_sidebar('sidebar-primary'); ?>
