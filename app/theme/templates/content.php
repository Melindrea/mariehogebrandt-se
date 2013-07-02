<article <?php post_class(); ?>>
  <header>
    <?php if (has_post_thumbnail()) :
        global $i;

        $alignment = ($i%2 == 0) ? 'left' : 'right';
        the_post_thumbnail('thumbnail', mh_get_post_thumbnail_classes('thumbnail', 'align'.$alignment));
    endif; ?>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php get_template_part('templates/entry-meta'); ?>
  </header>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div>
</article>
