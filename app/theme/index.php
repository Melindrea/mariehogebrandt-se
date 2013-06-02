<div class="inner">
    <?php get_template_part('templates/page', 'header'); ?>

    <?php if (!have_posts()) : ?>
      <div class="alert">
        <?php _e('Sorry, no results were found.', 'roots'); ?>
      </div>
      <?php get_search_form(); ?>
    <?php endif; ?>

        <ul class="entry-list">
    <?php
    $i = 0;
    while (have_posts()) : the_post();
        $format = get_post_format();

        if ( ! in_array($format, array('aside', 'status'))) :
    ?>
            <li>
      <?php get_template_part('templates/content', get_post_format()); ?>
             </li>
    <?php
        $i++;
        endif;
    endwhile; ?>
        </ul>

    <?php if (function_exists('wp_pagenavi')) {
        wp_pagenavi();
    } else {
    if ($wp_query->max_num_pages > 1) : ?>
      <nav class="post-nav">
        <ul class="pager">
          <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
          <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
        </ul>
      </nav>
    <?php endif;
    } ?>
</div>
